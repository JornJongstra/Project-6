<?php
    require_once("pdo_connect.php");
    require_once("util.php");

    LoginCheck(2);

    $overnachting = $_GET["overnachting"] ?? -1;
    $booking = $_GET["booking"] ?? -1;

    if ($overnachting === -1 || $booking === -1) {
        header("Location: index.php?page=Beheer/Bookings/Index");
    }

    // Verbinding maken met de database.
    $db = new Database();
    $connection = $db->Connect();

    // Alle statussen opvragen om later te tonen.
    $query = $connection->prepare("SELECT * FROM statussen");
    $query->execute();

    $statussen = $query->fetchAll(PDO::FETCH_ASSOC);

    if (isset($_POST["Aanpassen"])) {
        // Status veranderen.
        $query = $connection->prepare("UPDATE overnachtingen SET FKstatussenID = :statusID WHERE ID = :id");
        $query->bindParam("statusID", $_POST["status"]);
        $query->bindParam("id", $overnachting);
        $query->execute();

        // De melding
        StoreMsg('alert-success', 'Boeking is bijgewerkt');

        // Redirect naar overzichtpagina.
        header("Location: index.php?page=Beheer/Bookings/Overnachtingen/Index&booking=$booking");
    }
?>
