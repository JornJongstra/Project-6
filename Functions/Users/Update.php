<?php
    require_once("pdo_connect.php");
    require_once("util.php");

    LoginCheck();

    // We passen alleen gegevens aan als de gebruiker dat ook echt wilt.
    if (isset($_POST["Aanpassen"])) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];

        // TODO: Controleer of e-mail al in gebruik is.

        $db = new Database();
        $connection = $db->Connect();

        $UserID = $_SESSION["UserID"];

        $query = $connection->prepare("SELECT Email FROM klanten WHERE Email = :email AND ID != :id");
        $query->bindParam("email", $email);
        $query->bindParam("id", $UserID);
        $query->execute();

        if ($query->rowCount() == 0) {
            if (ValideerEmail($email)) {
                // Gegevens wijzigen met de nieuwe gegevens.
                $query = $connection->prepare("UPDATE klanten SET Naam = :naam, Email = :email, Telefoon = :phone WHERE ID = :id");
                $query->bindParam("naam", $name);
                $query->bindParam("email", $email);
                $query->bindParam("phone", $phone);
                $query->bindParam("id", $UserID);

                $query->execute();

                EmailGewijzigd($name, $email, $phone);
                header("Location: index.php?page=Users/Index&Aangepast");
            } else {
                header("Location: index.php?page=Users/Index&EmailInvalid");
            }
        } else {
            header("Location: index.php?page=Users/Index&EmailBestaatAl");
        }


        $db->Close();
    } else {
        header("Location: index.php?page=Users/Index");
    }
?>
