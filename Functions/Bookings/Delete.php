<?php
    require_once("pdo_connect.php");
    require_once("util.php");

    LoginCheck();

    // Return url
    $return = $_GET["return"] ?? "Bookings/Index";

    $db = new Database();
    $connection = $db->Connect();

    $bookingID = $_GET["booking"] ?? -1;

    if ($bookingID != -1) {
        // Huidige boeking opvragen
        $query = $connection->prepare("SELECT StartDatum, FKtochtenID FROM boekingen WHERE ID = :id");
        $query->bindParam("id", $bookingID);
        $query->execute();

        $booking = $query->fetch(PDO::FETCH_ASSOC);

        $query = $connection->prepare("SELECT ID, Route FROM tochten WHERE ID = :id");
        $query->bindParam("id", $booking["FKtochtenID"]);
        $query->execute();

        $route = $query->fetch(PDO::FETCH_ASSOC);
    } else {
        header("Location: index.php?page=$return");
    }

    if (isset($_POST["Verwijderen"])) {
        // Verwijder de boeking.
        $query = $connection->prepare("DELETE FROM boekingen WHERE ID = :id");
        $query->bindParam("id", $bookingID);
        $query->execute();

        $db->Close();

        StoreMsg('alert-success','Uw boeking is verwijderd.');

        header("Location: index.php?page=$return");
    }
?>