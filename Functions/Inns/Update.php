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

if (isset($_POST['update'])) {
    $innNaam = $_POST['naam'];
    $innAdres = $_POST['adres'];
    $innEmail = $_POST['email'];
    $innTelefoon = $_POST['telefoon'];
    $innCoordinaten = $_POST['coordinaten'];

    $sql = "UPDATE herbergen SET Naam = :naam, Adres = :adres, Email = :email, Telefoon = :telefoon, Coordinaten = :coordinaten WHERE ID = :innID";

    $innID = $_GET['ID'];

    $query = $db->Connect()->prepare($sql);

    $query->bindParam('naam', $innNaam);
    $query->bindParam('adres', $innAdres);
    $query->bindParam('email', $innEmail);
    $query->bindParam('telefoon', $innTelefoon);
    $query->bindParam('coordinaten', $innCoordinaten);
    $query->bindParam('innID', $innID);

    $query->execute();

    if ($query == TRUE) {
        StoreMsg('alert-success', 'Item Updated');
        header('Location: index.php?page=Inns/Inns');
    } else {
        echo "Error:" . $sql . "<br>" . $db->Connect()->error;
    }
}

if (isset($_GET["ID"])) {
    $innID = $_GET["ID"];

    $sql = "SELECT * FROM herbergen WHERE ID = :inn_id";

    $query = $db->Connect()->prepare($sql);
    $query->bindParam("inn_id", $innID);
    $query->execute();

    $inn = $query->fetch();

    $inn_naam = $inn['Naam'];
    $inn_adres = $inn['Adres'];
    $inn_email = $inn['Email'];
    $inn_telefoon = $inn['Telefoon'];
    $inn_coordinaten = $inn['Coordinaten'];
}

?>