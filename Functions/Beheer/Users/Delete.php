<?php
    require_once("pdo_connect.php");
    require_once("util.php");

    LoginCheck(2);

    $ID = $_GET["user"] ?? -1;

    // Verbinding maken met de database.
    $db = new Database();
    $connection = $db->Connect();

    if ($ID !== -1) {
        // Gegevens opvragen van de gebruiker.
        $query = $connection->prepare("SELECT * FROM klanten WHERE ID = :id");
        $query->bindParam("id", $ID);
        $query->execute();

        $user = $query->fetch(PDO::FETCH_ASSOC);
    } else {
        // We hebben geen ID meegegeven, we sturen de gebruiker terug
        // naar de overzichtspagina.
        header("Location: index.php?page=Beheer/Users/Index");
    }

    if (isset($_POST["Verwijderen"])) {
        // Account verwijderen.
        $query = $connection->prepare("DELETE FROM klanten WHERE ID = :id");
        $query->bindParam("id", $ID);
        $query->execute();

        // De melding
        StoreMsg('alert-success', 'Gebruiker verwijderd');

        // Redirect naar overzichtspagina.
        header("Location: index.php?page=Beheer/Users/Index");
    }
?>