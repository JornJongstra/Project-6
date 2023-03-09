<?php
    require_once("pdo_connect.php");
    require_once("util.php");

    LoginCheck();

    // De boeking ID opvragen.
    $booking = $_GET["booking"] ?? -1;

    if ($booking !== -1) {
        // Verbinding maken met de database.
        $database = new Database();
        $connection = $database->Connect();

        // Startdatum en aantal dagen opvragen uit de database.
        $query = $connection->prepare("SELECT boekingen.StartDatum, tochten.AantalDagen
                                       FROM boekingen
                                       LEFT JOIN tochten
                                       ON boekingen.FKtochtenID = tochten.ID
                                       LEFT JOIN statussen
                                       ON boekingen.FKstatussenID = statussen.ID
                                       WHERE boekingen.ID = :id");
        $query->bindParam("id", $booking);
        $query->execute();

        $bookingInfo = $query->fetch(PDO::FETCH_ASSOC);

        if (isset($_GET["Create"])) {
            // Alle pincodes opvragen.
            $query = $connection->prepare("SELECT PINCode FROM boekingen");
            $query->execute();

            $pins = $query->fetchAll(PDO::FETCH_ASSOC);

            // Pincode generen die uniek is.
            $pin = 0;

            while (true) {
                $pin = rand(1000, 9999);

                foreach ($pins as $pinEntry) {
                    if ($pinEntry["PINCode"] == $pin) {
                        continue;
                    }
                }
                
                break;
            }

            // Pincode in de database zetten.
            $query = $connection->prepare("UPDATE boekingen SET PINCode = :pin WHERE ID = :id");
            $query->bindParam("pin", $pin);
            $query->bindParam("id", $booking);
            $query->execute();

            //the message
            StoreMsg('alert-success','Pin toegewezen');
        } else if (isset($_GET["Delete"])) {
            // Pincode resetten (naar 0 zetten)
            $query = $connection->prepare("UPDATE boekingen SET PINCode = 0 WHERE ID = :id");
            $query->bindParam("id", $booking);
            $query->execute();

            //the message
            StoreMsg('alert-success','Pin verwijderd');
        }

        // $db->Close();
    }

    // Redirect naar overzichtspagina.
    header("Location: index.php?page=Bookings/Index");
?>
