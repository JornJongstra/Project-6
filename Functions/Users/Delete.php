<?php
    require_once("pdo_connect.php");
    require_once("util.php");

    LoginCheck();

    // Verbinden met de database
    $db = new Database();
    $connection = $db->Connect();

    // De ID van het account dat is ingelogd.
    $UserID = $_SESSION["UserID"];

    // Deze worden later in de form gebruikt.
    $name = "";
    $email = "";
    $phone = "";

    if (isset($_POST["delete"])) {
        // Verwijderen is bevestigd. We verwijderen nu het account.

        // Account verwijderen.
        $query = $connection->prepare("DELETE FROM klanten WHERE ID = :id");
        $query->bindParam("id", $UserID);
        $query->execute();

        // Sessions leeghalen.
        session_destroy();

        // Redirect naar de registreer pagina. We zetten "Delete" in de GET van
        // de registreer pagina zodat er een "verwijderd" bericht getoond kan worden.
        header("Location: index.php?page=Auth/Register&Delete");
    } else {
        // Verwijderen is nog niet bevestigd. We vragen de gebruiker of hij het zeker weet.

        // Gegevens opvragen om in de form te tonen.
        $query = $connection->prepare("SELECT Naam, Telefoon, Email FROM klanten WHERE ID = :id");
        $query->bindParam("id", $UserID);
        $query->execute();

        $results = $query->fetch(PDO::FETCH_ASSOC);

        $name = $results["Naam"];
        $phone = $results["Telefoon"];
        $email = $results["Email"];
    }
?>