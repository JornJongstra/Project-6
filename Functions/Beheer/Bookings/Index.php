<?php
    require_once("pdo_connect.php");
    require_once("util.php");

    LoginCheck(2);

    // Verbinding maken met de database.
    $db = new Database();
    $connection = $db->Connect();

    // Boekingen, tochten en statussen ophalen uit de database.
    // Door de JOIN wordt dit als één tabel teruggegeven.
    $query = $connection->prepare("SELECT boekingen.ID, boekingen.StartDatum, boekingen.PINCode, tochten.ID AS TochtID, tochten.Route, tochten.AantalDagen, statussen.Status, statussen.Verwijderbaar, klanten.Naam AS KlantNaam
                                   FROM boekingen
                                   LEFT JOIN tochten
                                   ON boekingen.FKtochtenID = tochten.ID
                                   LEFT JOIN statussen
                                   ON boekingen.FKstatussenID = statussen.ID
                                   LEFT JOIN klanten
                                   ON boekingen.FKklantenID = klanten.ID
                                   ORDER BY boekingen.StartDatum ASC");
    $query->execute();

    $results = $query->fetchAll(PDO::FETCH_ASSOC);

    $boekingen = array();

    foreach ($results as $boeking) {
        // Einddatum uitrekenen op basis van de startdatum en
        // het aantal dagen dat de tocht duurt.

        $tochtDagen = $boeking["AantalDagen"];
        $EindDatum = BerekenEinddatum($boeking["StartDatum"], $tochtDagen);

        // De boeking met gegevens in de array zetten om later te tonen.
        $new_boeking = [
            "ID" => $boeking["ID"],
            "StartDatum" => $boeking["StartDatum"],
            "EindDatum" => $EindDatum,
            "PINCode" => $boeking["PINCode"],
            "Tocht" => $boeking["Route"],
            "Status" => $boeking["Status"],
            "Boeker" => $boeking["KlantNaam"],
            "ShowActions" => $boeking["Verwijderbaar"]
        ];

        // Als je geen index meegeeft, wordt het automatisch aan het einde
        // van de array gezet.
        $boekingen[] = $new_boeking;
    }

    $db->Close();
?>