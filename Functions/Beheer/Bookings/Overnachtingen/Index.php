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

    // Alle overnachtingen opvragen die al gekoppeld zijn aan deze
    // boeking.
    $query = $connection->prepare("SELECT *, overnachtingen.ID AS overnachtingID FROM overnachtingen
                                   LEFT JOIN herbergen
                                   ON overnachtingen.FKherbergenID = herbergen.ID
                                   LEFT JOIN statussen
                                   ON overnachtingen.FKstatussenID = statussen.ID
                                   WHERE overnachtingen.FKboekingenID = :id");
    $query->bindParam("id", $booking);
    $query->execute();

    $huidige_overnachtingen = $query->fetchAll(PDO::FETCH_ASSOC);

    // Alle bestaande herbergen opvragen.
    $query = $connection->prepare("SELECT * FROM herbergen");
    $query->execute();

    $all_herbergen = $query->fetchAll(PDO::FETCH_ASSOC);

    // Een nieuwe array aanmaken. Hier komen alle herbergen in die
    // nog niet gekoppeld zijn aan deze boeking.
    $herbergen = array();

    // Over alle bestaande herbergen loopen.
    foreach ($all_herbergen as $herberg) {
        $found = false;

        // Kijken of deze herberg al gebruikt is. Zo ja, dan slaan we deze over.
        foreach ($huidige_overnachtingen as $huidige_overnachting) {
            if ($huidige_overnachting["FKherbergenID"] == $herberg["ID"]) {
                $found = true;

                break;
            }
        }

        if (!$found) {
            // Deze herberg is nog niet gekoppeld aan deze boeking. We voegen
            // deze herberg toe als beschikbare herberg.
            array_push($herbergen, $herberg);
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
        // Deze overnachting koppelen aan de boeking.

        $herbergID = $_POST["herberg"];
        $statusID = 1;

        $query = $connection->prepare("INSERT INTO overnachtingen (FKboekingenID, FKherbergenID, FKstatussenID) VALUES (:bookingID, :herbergID, :statusID)");
        $query->bindParam("bookingID", $booking);
        $query->bindParam("herbergID", $herbergID);
        $query->bindParam("statusID", $statusID);
        $query->execute();

        // Pagina verversen.
        header("Location: #");
    }

    if (isset($_POST["Remove"])) {
        // Deze overnachting ontkoppelen van deze boeking.

        $overnachtingID = $_POST["overnachting"];

        $query = $connection->prepare("DELETE FROM overnachtingen WHERE ID = :id");
        $query->bindParam("id", $overnachtingID);
        $query->execute();

        // Pagina verversen.
        header("Location: #");
    }
?>