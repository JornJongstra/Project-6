<?php

if (!isset($_SESSION["UserLevel"]) || $_SESSION["UserLevel"] <= 1) {
    header("Location: index.php?page=home");
}

require_once("pdo_connect.php");
require_once("util.php");

$db = new Database();

if (isset($_POST['cancel'])) {
    header('Location: index.php?page=Statussen/Statussen');
}

if (isset($_POST["delete"])) {

    $query = $db->Connect()->prepare("DELETE FROM statussen WHERE ID = :status_id");

    $statusId = $_GET["ID"];

    $query->bindParam("status_id", $statusId);
    $query->execute();

    if ($query == true) {
        StoreMsg('alert-danger', 'Item Deleted');
        header('Location: index.php?page=statussen/statussen');
    } else {
        echo "Error:" . $sql . "<br>" . $db->Connect()->error;
    }
}

if (isset($_GET["ID"])) {
    $statusID = $_GET["ID"];

    $sql = "SELECT * FROM statussen WHERE ID = :status_id";

    $query = $db->Connect()->prepare($sql);
    $query->bindParam("status_id", $statusID);
    $query->execute();

    $status = $query->fetch();

    $status_statusCode = $status['StatusCode'];
    $status_status = $status['Status'];
    $status_verwijderbaar = $status['Verwijderbaar'];
    $status_PINtoekennen = $status['PINtoekennen'];
}
?>