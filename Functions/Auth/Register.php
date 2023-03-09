<?php
    require_once("./pdo_connect.php");
    require_once("util.php");
    
    LoginCheckInReg();

    $naam = $_POST["naam"] ?? "";
    $email = $_POST["email"] ?? "";
    $telefoon = $_POST["telefoon"] ?? "";
    $password = $_POST["password"] ?? "";

    // Dit zijn classnames die gebruikt worden in de form.
    $name_status = "";
    $email_status = "";
    $phone_status = "";
    $password_status = "";
    $register_failed = false;

    if (isset($_POST["Registreren"])) {
        // Kijken of de gegevens aan de eisen voldoen.

        $info_valid = true;

        // Kijk of de e-mail een @-teken heeft en een punt heeft.
        if (ValideerEmail($email)) {
            $email_status = "is-valid";
        } else {
            $info_valid = false;
            $email_status = "is-invalid";
        }

        // Kijk of het wachtwoord aan de eisen voldoet.
        if (ValideerWachtwoord($password)) {
            $password_status = "is-valid";
        } else {
            $info_valid = false;
            $password_status = "is-invalid";
        }

        if ($info_valid) {
            // We controleren deze (nog) niet, dus we zetten deze voor nu standaard op geldig als de andere gegevens ook geldig zijn.
            $name_status = "is-valid";
            $phone_status = "is-valid";

            // We kunnen er nu vanuit gaan dat de gegevens correct zijn.
            // We voegen ze toe aan de database.
            $db = new Database();
            $connection = $db->Connect();

            // Kijken of dit account al bestaat.
            $query = $connection->prepare("SELECT * FROM klanten WHERE Email = :email");
            $query->bindParam("email", $email);
            $query->execute();

            // Er is niks gevonden met deze gegevens.
            // Dit account bestaat dus nog niet.
            if ($query->rowCount() == 0) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // We maken het account aan door de gegeevens in de database te zetten.
                $query = $connection->prepare("INSERT INTO klanten (Naam, Email, Telefoon, Wachtwoord) VALUES (:naam, :email, :phonenumber, :password)");
                $query->bindParam("naam", $naam);
                $query->bindParam("email", $email);
                $query->bindParam("phonenumber", $telefoon);
                $query->bindParam("password", $hashed_password);

                if ($query->execute()) {
                    // We halen nu de ID en de Level op uit de database van het zojuist gemaakte account.
                    // Doordat een e-mail maar één keer gebruikt mag worden, kunnen we hierop filteren.
                    // We doen dit met een query, en niet hardcoden omdat de ID door de database wordt aangemaakt.
                    $query = $connection->prepare("SELECT ID, Level FROM klanten WHERE Email = :email");
                    $query->bindParam("email", $email);
                    $query->execute();

                    $results = $query->fetch(PDO::FETCH_ASSOC);

                    // Het systeem controleert of je ingelogd bent door
                    // naar deze twee sessions te kijken. Hierdoor ben je nu ingelogd.
                    $_SESSION["UserID"] = $results["ID"];
                    $_SESSION["UserLevel"] = $results["Level"];

                    // We sluiten de verbinding hier omdat als we geredirect worden, de rest van de code niet
                    // aangeroepen wordt. De verbinding blijft anders open.
                    $db->Close();

                    Email($naam, $email, $telefoon, $password);
                    // Redirect naar home.
                    header("Location: index.php?page=home");
                } else {
                    $register_failed = true;
                }
            } else {
                $email_status = "is-invalid";
            }

            $db->Close();
        }
    }
?>
