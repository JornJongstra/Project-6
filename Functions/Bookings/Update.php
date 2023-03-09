<?php
    require_once("pdo_connect.php");
    require_once("util.php");

    LoginCheck();

    // Return url
    $return = $_GET["return"] ?? "Bookings/Index";

    // Verbinding maken met de database.
    $db = new Database();
    $connection = $db->Connect();

    $bookingID = $_GET["booking"] ?? -1;

    // Alle tochten opvragen. Dit moet ook als niet op de submit knop,
    // gedrukt is, omdat dit weergeven wordt in de select-element.
    $query = $connection->prepare("SELECT ID, Route FROM tochten");
    $query->execute();

    // Alle routes opvragen. Hierdoor kan een lijst met routes getoond worden.
    $routes = $query->fetchAll(PDO::FETCH_ASSOC);

    // Vraag alle statussen op.
    $query = $connection->prepare("SELECT ID, Status FROM statussen");
    $query->execute();

    // Alle statussen opvragen. Hierdoor kan een lijst met routes getoond worden.
    $statussen = $query->fetchAll(PDO::FETCH_ASSOC);

    if ($bookingID != -1) {
        // De huidige boeking opvragen. Hierdoor kunnen we de huidige gegevens tonen.
        $query = $connection->prepare("SELECT StartDatum, FKtochtenID, FKstatussenID, PINCode FROM boekingen WHERE ID = :id");
        $query->bindParam("id", $bookingID);
        $query->execute();

        $booking = $query->fetch(PDO::FETCH_ASSOC);
    } else {
        // Redirect naar overzicht als er geen boeking geselecteerd is.
        header("Location: index.php?page=$return");
    }

    if (isset($_POST["Wijzigen"])) {
        $startDate = $_POST["startDate"] ?? -1;
        $route = $_POST["route"] ?? -1;

        if ($startDate != -1 && $route != -1) {
            // Boeking wijzigen.
            $query = $connection->prepare("UPDATE boekingen SET StartDatum = :startDate, FKtochtenID = :routeID WHERE ID = :bookingID");
            $query->bindParam("startDate", $startDate);
            $query->bindParam("routeID", $route);
            $query->bindParam("bookingID", $bookingID);
            $query->execute();

            if ($return == "Beheer/Bookings/Index") {
                $status = $_POST["status"];
                $pin = $booking["PINCode"];

                if ($status != 2) {
                    $pin = 0;
                }

                $query = $connection->prepare("UPDATE boekingen SET FKstatussenID = :statusID, PINCode = :pin WHERE ID = :bookingID");
                $query->bindParam("statusID", $status);
                $query->bindParam("pin", $pin);
                $query->bindParam("bookingID", $bookingID);
                $query->execute();
            }
        }

        StoreMsg('alert-success','Uw boeking is aangepast.');

        header("Location: index.php?page=$return");
    }
?>