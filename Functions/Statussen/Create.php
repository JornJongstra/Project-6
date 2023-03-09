<?php

if (!isset($_SESSION["UserLevel"]) || $_SESSION["UserLevel"] <= 1) {
    header("Location: index.php?page=dashboard");
}

require_once("pdo_connect.php");
require_once("util.php");

$db = new Database();

if (isset($_POST['cancel'])) {
    header('Location: index.php?page=Statussen/Statussen');
}

if (isset($_POST['submit'])) {
    $statusCode = $_POST['statusCode'];
    $status = $_POST['status'];
    $verwijderbaar = 0;
    $PINtoekennen = 0;
    if (isset($_POST['Verwijderbaar']))
    {
        $verwijderbaar = 1;
    }
    if (isset($_POST['PINtoekennen']))
    {
        $PINtoekennen = 1;
    }

    $sql = "INSERT INTO statussen (StatusCode, Status, Verwijderbaar, PINtoekennen) VALUES (:statusCode, :status, :verwijderbaar, :PINtoekennen)";

    $query = $db->Connect()->prepare($sql);
    $query->bindParam("statusCode", $statusCode);
    $query->bindParam("status", $status);
    $query->bindParam("verwijderbaar", $verwijderbaar);
    $query->bindParam("PINtoekennen", $PINtoekennen);

    $query->execute();

    
    //print_r($verwijderbaar);
    if ($query == TRUE) {
        StoreMsg('alert-success', 'Item Created');
        header('Location: index.php?page=Statussen/Statussen');
    } else {
        echo "Error:" . $sql . "<br>" . $db->Connect()->error;
    }
}

?>