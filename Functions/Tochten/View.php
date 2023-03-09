<?php

require_once('pdo_connect.php');

$db = new Database();

$sql = 'SELECT * FROM herbergen';

$query = $db->Connect()->prepare($sql);

$query->execute();

$row = $query->fetchAll(PDO::FETCH_ASSOC);

$render = "";

foreach($row as $value){
    $render .= "L.latLng($value[Coordinaten]),";
}


?>