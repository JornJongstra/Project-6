<?php
    require_once("pdo_connect.php");
    require_once("util.php");

    LoginCheck();

    // Deze gegevens worden gebruikt zodat
    // we ze in de form kunnen weergeven.
    $name = "";
    $email = "";
    $phone = "";

    $userID = $_SESSION["UserID"];

    // Gegevens opvragen om te tonen in de form.

    $db = new Database();
    $connection = $db->Connect();

    $query = $connection->prepare("SELECT Naam, Email, Telefoon FROM klanten WHERE ID = :id LIMIT 1");
    $query->bindParam("id", $userID);

    $query->execute();

    $data = $query->fetch(PDO::FETCH_ASSOC);

    $name = $data["Naam"];
    $email = $data["Email"];
    $phone = $data["Telefoon"];

    $db->Close();
?>