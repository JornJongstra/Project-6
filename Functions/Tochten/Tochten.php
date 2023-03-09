<?php

if (!isset($_SESSION["UserLevel"]) || $_SESSION["UserLevel"] <= 1) {
    header("Location: index.php?page=home");
}

require_once("pdo_connect.php");
require_once("util.php");

$db = new Database();

$query = $db->Connect()->prepare("SELECT * FROM tochten");

$query->execute();

$tochten = $query->fetchAll(PDO::FETCH_ASSOC);

?>