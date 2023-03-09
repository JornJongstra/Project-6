<?php

// if (!isset($_SESSION["Level"]) && $_SESSION["Level"] <= 1) {
//     header("Location: index.php?page=home");
// }

require_once("pdo_connect.php");

$db = new Database();

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