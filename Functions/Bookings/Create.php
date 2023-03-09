<?php
    require_once("pdo_connect.php");
    require_once("util.php");

    LoginCheck();

    // Verbinding maken met de database.
    $db = new Database();
    $connection = $db->Connect();

    // Alle tochten opvragen. Dit moet ook als niet op de submit knop,
    // gedrukt is, omdat dit weergeven wordt in de select-element.
    $query = $connection->prepare("SELECT ID, Route FROM tochten");
    $query->execute();

    $routes = $query->fetchAll(PDO::FETCH_ASSOC);

    // Alleen een boeking maken als de submit knop is ingedrukt.
    if (isset($_POST["Boeken"])) {
        $startDate = $_POST["startDate"];
        $pin = 0;
        $routeID = $_POST["route"];
        $userID = $_SESSION["UserID"];
        $statusID = 1;

        // De boeking in de database zetten.
        $query = $connection->prepare("INSERT INTO boekingen (StartDatum, PINCode, FKtochtenID, FKklantenID, FKstatussenID)
                                       VALUES (:startDate, :pin, :routeID, :userID, :statusID)");
        $query->bindParam("startDate", $startDate);
        $query->bindParam("pin", $pin);
        $query->bindParam("routeID", $routeID);
        $query->bindParam("userID", $userID);
        $query->bindParam("statusID", $statusID);

        $query->execute();

        StoreMsg('alert-success','Uw boeking is aangemaakt.');

        // Redirect naar de overzichtspagina.
        header("Location: index.php?page=Bookings/Index");
    }

    $db->Close();
?>