<?php
    require_once("pdo_connect.php");
    require_once("util.php");

    LoginCheck(2);

    $booking = $_GET["booking"] ?? -1;

    // Kijken of er een boeking ID is meegegeven.
    // Als dit niet gebeurd is, sturen we hem terug naar
    // de overzichtspagina.
    if ($booking === -1) {
        header("Location: index.php?page=Beheer/Bookings/Index");
    }

    // Verbinding maken met de database.
    $db = new Database();
    $connection = $db->Connect();

    // Alle pauzeplaatsen opvragen die al gekoppeld zijn aan deze
    // boeking.
    $query = $connection->prepare("SELECT *, pauzeplaatsen.ID AS pauzeplaatsID FROM pauzeplaatsen
                                   LEFT JOIN restaurants
                                   ON pauzeplaatsen.FKrestaurantsID = restaurants.ID
                                   LEFT JOIN statussen
                                   ON pauzeplaatsen.FKstatussenID = statussen.ID
                                   WHERE pauzeplaatsen.FKboekingenID = :id");
    $query->bindParam("id", $booking);
    $query->execute();

    $huidige_pauzeplaatsen = $query->fetchAll(PDO::FETCH_ASSOC);

    // Alle bestaande restaurants opvragen.
    $query = $connection->prepare("SELECT * FROM restaurants");
    $query->execute();

    $all_restaurants = $query->fetchAll(PDO::FETCH_ASSOC);

    // Een nieuwe array aanmaken. Hier komen alle restaurants in die
    // nog niet gekoppeld zijn aan deze boeking.
    $restaurants = array();

    // Over alle bestaande restaurants loopen.
    foreach ($all_restaurants as $restaurant) {
        $found = false;

        // Kijken of deze restaurant al gebruikt is. Zo ja, dan slaan we deze over.
        foreach ($huidige_pauzeplaatsen as $huidige_pauzeplaats) {
            if ($huidige_pauzeplaats["FKrestaurantsID"] == $restaurant["ID"]) {
                $found = true;

                break;
            }
        }

        if (!$found) {
            // Deze restaurant is nog niet gekoppeld aan deze boeking. We voegen
            // deze restaurant toe als beschikbare restaurant.
            array_push($restaurants, $restaurant);
        }
    }

    // Klant- en boekinginformatie opvragen om te tonen in de
    // tabel.
    $query = $connection->prepare("SELECT * FROM boekingen
                                   LEFT JOIN klanten
                                   ON boekingen.FKklantenID = klanten.ID
                                   LEFT JOIN statussen
                                   ON boekingen.FKstatussenID = statussen.ID
                                   LEFT JOIN tochten
                                   ON boekingen.FKtochtenID = tochten.ID
                                   WHERE boekingen.ID = :id");
    $query->bindParam("id", $booking);
    $query->execute();

    $bookingInfo = $query->fetch(PDO::FETCH_ASSOC);

    if (isset($_POST["Add"])) {
        // Deze pauzeplaats koppelen aan de boeking.

        $restaurantID = $_POST["Restaurant"];
        $statusID = 1;

        $query = $connection->prepare("INSERT INTO pauzeplaatsen (FKboekingenID, FKrestaurantsID, FKstatussenID) VALUES (:bookingID, :restaurantID, :statusID)");
        $query->bindParam("bookingID", $booking);
        $query->bindParam("restaurantID", $restaurantID);
        $query->bindParam("statusID", $statusID);
        $query->execute();

        // Pagina verversen.
        header("Location: #");
    }

    if (isset($_POST["Remove"])) {
        // Deze pauzeplaats ontkoppelen van deze boeking.

        $pauzeplaatsID = $_POST["Pauzeplaats"];

        $query = $connection->prepare("DELETE FROM pauzeplaatsen WHERE ID = :id");
        $query->bindParam("id", $pauzeplaatsID);
        $query->execute();

        // Pagina verversen.
        header("Location: #");
    }
?>