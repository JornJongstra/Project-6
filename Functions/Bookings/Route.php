<?php

require_once('pdo_connect.php');

if (!isset($_SESSION["UserLevel"])) {
    header("Location: index.php?page=Bookings/Index");
}

$db = new Database();

$bookingID = $_GET['booking'];

$sql = ("SELECT herbergen.Coordinaten FROM overnachtingen
JOIN herbergen
ON FKherbergenID = herbergen.ID
WHERE FKboekingenID = :id");

$query = $db->Connect()->prepare($sql);
$query->bindParam("id", $bookingID);
$query->execute();

$row = $query->fetchAll(PDO::FETCH_ASSOC);

$render = "";

foreach($row as $value){
    $render .= "L.latLng($value[Coordinaten]),";
}

?>