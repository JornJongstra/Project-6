<?php
    require_once("pdo_connect.php");
    require_once("util.php");

    LoginCheck(2);

    // Verbinding maken met de database.
    $db = new Database();
    $connection = $db->Connect();

    // Alle klanten opvragen.
    $query = $connection->prepare("SELECT * FROM klanten");
    $query->execute();

    $users = $query->fetchAll(PDO::FETCH_ASSOC);
?>