<?php
    require_once("pdo_connect.php");
    require_once("util.php");
    
    LoginCheckInReg();

    $email = $_POST["email"] ?? "";
    $password = $_POST["password"] ?? "";

    // Dit zijn classnames voor in de form. Dit is of is-valid of is-invalid.
    $status_email = "";
    $status_password = "";

    // Controleren of de gebruiker wilt inloggen, en zo ja, of hij alles wel heeft ingevuld.
    if (isset($_POST["Inloggen"]) && isset($_POST["email"]) && isset($_POST["password"])) {
        // Verbinden met de database.
        $db = new Database();
        $connection = $db->Connect();

        // Gegevens opvragen op basis van inloggegevens.
        $query = $connection->prepare("SELECT * FROM klanten WHERE Email = :email");
        $query->bindParam("email", $email);

        // Query uitvoeren.
        $query->execute();

        // Resultaten opvragen.
        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        // Er kan maar 1 account met deze gegevens zijn.
        // Als dit niet het geval is, dan kloppen de gegevens niet.
        if ($query->rowCount() == 1) {
            $userData = $results[0];

            // Kijken of het wachtwoord klopt.
            $password_correct = password_verify($password, $userData["Wachtwoord"]);

            // Controleren of het correcte wachtwoord is ingevuld.
            if ($password_correct) {
                // Gegevens in de session opslaan, zodat andere pagina's ook weten dat
                // deze gebruiker ingelogd is.
                $_SESSION["UserID"] = $userData["ID"];
                $_SESSION["UserLevel"] = $userData["Level"];

                $status_email = "is-valid";
                $status_password = "is-valid";

                // Redirect naar home.
                header("Location: index.php?page=home");
            } else {
                $status_email = "is-valid";
                $status_password = "is-invalid";
            }
        } else {
            $status_email = "is-invalid";
            $status_password = "";
        }

        $db->Close();
    }
?>