<?php
    require_once("pdo_connect.php");
    require_once("util.php");

    LoginCheck(2);

    $ID = $_GET["user"] ?? -1;

    if ($ID == -1) {
        // Redirect naar overzichtspagina als er geen ID is
        // meegegeven.
        header("Location: index.php?page=Beheer/Users/Index");
    }

    // Verbinding maken met de database.
    $db = new Database();
    $connection = $db->Connect();

    // Alle gegevens opvragen.
    $query = $connection->prepare("SELECT Naam, Email, Telefoon, Level FROM klanten WHERE ID = :id");
    $query->bindParam("id", $ID);
    $query->execute();

    $user = $query->fetch(PDO::FETCH_ASSOC);

    if (isset($_POST["Bewerken"])) {
        // Account bewerken.
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["telefoon"];
        $level = $_POST["level"];

        $query = $connection->prepare("UPDATE klanten SET Naam = :name, Email = :email, Telefoon = :phone, Level = :level WHERE ID = :id");
        $query->bindParam("name", $name);
        $query->bindParam("email", $email);
        $query->bindParam("phone", $phone);
        $query->bindParam("level", $level);
        $query->bindParam("id", $ID);
        $query->execute();

        // De melding
        StoreMsg('alert-success', 'Gebruiker bijgewerkt');

        // Redirect naar overzichtspagina.
        header("Location: index.php?page=Beheer/Users/Index");
    }
?>