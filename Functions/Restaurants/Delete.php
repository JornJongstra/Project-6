<?php

if (!isset($_SESSION["UserLevel"]) || $_SESSION["UserLevel"] <= 1) {
    header("Location: index.php?page=home");
}

require_once("pdo_connect.php");
require_once("util.php");

$db = new Database();

if (isset($_POST['cancel'])) {
    header('Location: index.php?page=Restaurants/Restaurants');
}

if (isset($_POST["delete"])) {

    $query = $db->Connect()->prepare("DELETE FROM restaurants WHERE ID = :restaurant_id");

    $restaurantId = $_GET["ID"];

    $query->bindParam("restaurant_id", $restaurantId);
    $query->execute();

    if ($query == true) {
        StoreMsg('alert-danger', 'Item Deleted');
        header('Location: index.php?page=Restaurants/Restaurants');
    } else {
        echo "Error:" . $sql . "<br>" . $db->Connect()->error;
    }
}

if (isset($_GET["ID"])) {
    $restaurantID = $_GET["ID"];

    $sql = "SELECT * FROM restaurants WHERE ID = :restaurant_id";

    $query = $db->Connect()->prepare($sql);
    $query->bindParam("restaurant_id", $restaurantID);
    $query->execute();

    $restaurant = $query->fetch();

    $restaurant_naam = $restaurant['Naam'];
    $restaurant_adres = $restaurant['Adres'];
    $restaurant_email = $restaurant['Email'];
    $restaurant_telefoon = $restaurant['Telefoon'];
    $restaurant_coordinaten = $restaurant['Coordinaten'];
}

?>