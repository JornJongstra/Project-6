<?php

if (!isset($_SESSION["UserLevel"]) && $_SESSION["UserLevel"] <= 1) {
    header("Location: index.php?page=home");
}

require_once("pdo_connect.php");
require_once("util.php");

$db = new Database();

//$inns = array();

$query = $db->Connect()->prepare("SELECT * FROM restaurants");

$query->execute();

$restaurants = $query->fetchAll(PDO::FETCH_ASSOC);

// echo '<pre>';
// print_r($_inns);
// echo '</pre>';
?>