<?php

if (!isset($_SESSION["UserLevel"]) && $_SESSION["UserLevel"] <= 1) {
    header("Location: index.php?page=home");
}

require_once("pdo_connect.php");
require_once("util.php");

$db = new Database();

if (isset($_POST['cancel'])) {
    header('Location: index.php?page=Statussen/Statussen');
}

if (isset($_POST['update'])) {
    $statusStatusCode = $_POST['statusCode'];
    $statusStatus = $_POST['status'];
    $statusVerwijderbaar = 0;
    $statusPINtoekennen = 0;
    if (isset($_POST['Verwijderbaar']))
    {
        $statusVerwijderbaar = 1;
    }
    if (isset($_POST['PINtoekennen']))
    {
        $statusPINtoekennen = 1;
    }


    $sql = "UPDATE statussen SET StatusCode = :statusCode, Status = :status, Verwijderbaar = :verwijderbaar, PINtoekennen = :PINtoekennen WHERE ID = :statusID";

    $statusID = $_GET['ID'];

    $query = $db->Connect()->prepare($sql);

    $query->bindParam('statusCode', $statusStatusCode);
    $query->bindParam('status', $statusStatus);
    $query->bindParam('verwijderbaar', $statusVerwijderbaar);
    $query->bindParam('PINtoekennen', $statusPINtoekennen);
    $query->bindParam('statusID', $statusID);

    $query->execute();

    if ($query == TRUE) {
        StoreMsg('alert-success', 'Item Updated');
        header('Location: index.php?page=Statussen/Statussen');
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