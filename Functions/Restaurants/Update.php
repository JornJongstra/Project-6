<?php

if (!isset($_SESSION["UserLevel"]) && $_SESSION["UserLevel"] <= 1) {
    header("Location: index.php?page=home");
}

require_once("pdo_connect.php");
require_once("util.php");

$db = new Database();

if (isset($_POST['cancel'])) {
    header('Location: index.php?page=Restaurants/Restaurants');
}

if (isset($_POST['update'])) {
    $restaurantNaam = $_POST['naam'];
    $restaurantAdres = $_POST['adres'];
    $restaurantEmail = $_POST['email'];
    $restaurantTelefoon = $_POST['telefoon'];
    $restaurantCoordinaten = $_POST['coordinaten'];

    $sql = "UPDATE restaurants SET Naam = :naam, Adres = :adres, Email = :email, Telefoon = :telefoon, Coordinaten = :coordinaten WHERE ID = :restaurantID";

    $restaurantID = $_GET['ID'];

    $query = $db->Connect()->prepare($sql);

    $query->bindParam('naam', $restaurantNaam);
    $query->bindParam('adres', $restaurantAdres);
    $query->bindParam('email', $restaurantEmail);
    $query->bindParam('telefoon', $restaurantTelefoon);
    $query->bindParam('coordinaten', $restaurantCoordinaten);
    $query->bindParam('restaurantID', $restaurantID);

    $query->execute();

    if ($query == TRUE) {
        StoreMsg('alert-success', 'Item Updated');
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