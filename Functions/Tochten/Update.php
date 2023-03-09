<?php 

if (!isset($_SESSION["UserLevel"]) && $_SESSION["UserLevel"] <= 1) {
    header("Location: index.php?page=home");
}

require_once("pdo_connect.php");
require_once("util.php");

$db = new Database();

if (isset($_POST['cancel'])) {
    header('Location: index.php?page=Tochten/Tochten');
}

if (isset($_POST['update'])) {
    $tochtOmschrijving = $_POST['omschrijving'];
    $tochtRoute = $_POST['route'];
    $tochtAantalDagen = $_POST['aantalDagen'];

    $sql = "UPDATE tochten SET Omschrijving = :omschrijving, Route = :route, AantalDagen = :aantalDagen WHERE ID = :tochtID";

    $tochtID = $_GET['ID'];

    $query = $db->Connect()->prepare($sql);

    $query->bindParam('omschrijving', $tochtOmschrijving);
    $query->bindParam('route', $tochtRoute);
    $query->bindParam('aantalDagen', $tochtAantalDagen);
    $query->bindParam('tochtID', $tochtID);

    $query->execute();

    if ($query == TRUE) {
        StoreMsg('alert-success', 'Item Updated');
        header('Location: index.php?page=Tochten/Tochten');
    } else {
        echo "Error:" . $sql . "<br>" . $db->Connect()->error;
    }
}

if (isset($_GET["ID"])) {
    $tochtID = $_GET["ID"];

    $sql = "SELECT * FROM tochten WHERE ID = :tocht_id";

    $query = $db->Connect()->prepare($sql);
    $query->bindParam("tocht_id", $tochtID);
    $query->execute();

    $tocht = $query->fetch();

    $tocht_omschrijving = $tocht['Omschrijving'];
    $tocht_route = $tocht['Route'];
    $tocht_aantalDagen = $tocht['AantalDagen'];

}

?>