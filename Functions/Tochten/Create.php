<?php

if (!isset($_SESSION["UserLevel"]) || $_SESSION["UserLevel"] <= 1) {
    header("Location: index.php?page=home");
}

require_once("pdo_connect.php");
require_once("util.php");

$db = new Database();

if (isset($_POST['cancel'])) {
    header('Location: index.php?page=Inns/Inns');
}

if (isset($_POST['submit'])) {
    $omschrijving = $_POST['omschrijving'];
    $route = $_POST['route'];
    $aantalDagen = $_POST['aantalDagen'];

    $sql = "INSERT INTO tochten (Omschrijving, Route, AantalDagen) VALUES (?, ?, ?)";

    $query = $db->Connect()->prepare($sql);
    // $query->bindParam("naam", $naam);
    // $query->bindParam("adres", $adres);
    // $query->bindParam("email", $email);

    $query->execute([$omschrijving, $route, $aantalDagen]);


    if ($query == TRUE) {
        StoreMsg('alert-success', 'Item Created');
        header('Location: index.php?page=Tochten/Tochten');
    } else {

        echo "Error:" . $sql . "<br>" . $db->Connect()->error;
    }
}

?>