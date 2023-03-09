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
    $naam = $_POST['naam'];
    $adres = $_POST['adres'];
    $email = $_POST['email'];
    $telefoon = $_POST['telefoon'];
    $coordinaten = $_POST['coordinaten'];

    $sql = "INSERT INTO herbergen (Naam, Adres, Email, Telefoon, Coordinaten) VALUES (:naam, :adres, :email, :telefoon, :coordinaten)";

    $query = $db->Connect()->prepare($sql);
    $query->bindParam("naam", $naam);
    $query->bindParam("adres", $adres);
    $query->bindParam("email", $email);
    $query->bindParam("telefoon", $telefoon);
    $query->bindParam("coordinaten", $coordinaten);

    $query->execute();


    if ($query == TRUE) {
        StoreMsg('alert-success', 'Item Created');
        header('Location: index.php?page=Inns/Inns');
    } else {
        echo "Error:" . $sql . "<br>" . $db->Connect()->error;
    }
}

?>