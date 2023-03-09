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

if (isset($_POST['delete'])) {

    $query = $db->Connect()->prepare("DELETE FROM herbergen WHERE ID = :inn_id");

    $innId = $_GET["ID"];

    $query->bindParam("inn_id", $innId);
    $query->execute();

    if ($query == TRUE) {
        StoreMsg('alert-danger', 'Item Deleted');
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