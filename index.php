<?php
session_start();

if (!isset($_GET['page']) || empty($_GET['page'])) {
    header('Location: index.php?page=home');
}

//includes logic
if (file_exists('./Functions/' . $_GET['page'] . '.php')) {
    require_once('./Functions/' . $_GET['page'] . '.php');
} else {
    // die('Function not founded');
}


function renderUserInfo($result)
{ ?>
    <li><b>Ingelogged als: </b><?php echo $result['Naam']; ?></li>
    <li><b>Email: </b> <?php echo $result['Email']; ?></li>
    <li><b>Telefoon: </b> <?php echo $result['Telefoon']; ?></li>
<?php }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donkey Travel</title>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />

    <link rel="stylesheet" href="assets/vendor/datatables-1.11.5/datatables.min.css">
    <link rel="stylesheet" href="assets/vendor/fontawesome-free-6.1.1-web/css/all.min.css">

    <link rel="stylesheet" href="assets/style/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.php?page=home"><img class="Logo" src="assets/images/logo.svg"></a>

            <div class="navbar-toggler collapsed" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <svg>
                    <line x1="33%" y1="50%" x2="67%" y2="50%" />
                    <line x1="33%" y1="50%" x2="67%" y2="50%" />
                    <line x1="33%" y1="50%" x2="67%" y2="50%" />
                </svg>
            </div>

            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- TODO if logged, show another menu -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo $_GET['page'] == 'home' ? 'active' : '' ?>" aria-current="page" href="index.php?page=home">Home</a>
                    </li>
                    <?php if (isset($_SESSION["UserID"])) : ?>
                        <?php if (isset($_SESSION["UserLevel"]) && $_SESSION["UserLevel"] > 1) : ?>
                            <li class="nav-item">
                                <div class="dropdown">
                                    <a id="dropdown-toggle-button" class="nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown">Beheer</a>
                                    <ul class="dropdown-menu" aria-describedby="dropdown-toggle-button">
                                        <li><a class="text-black dropdown-item nav-link" href="index.php?page=Beheer/Bookings/Index">Boekingen</a></li>
                                        <li><a class="text-black dropdown-item nav-link" href="index.php?page=Beheer/Users/Index">Gebruikers</a></li>
                                        <li><a class="text-black dropdown-item nav-link" href="index.php?page=Statussen/Statussen">Statussen</a></li>
                                        <li><a class="text-black dropdown-item nav-link" href="index.php?page=Inns/Inns">Herbergen</a></li>
                                        <li><a class="text-black dropdown-item nav-link" href="index.php?page=Restaurants/Restaurants">Restaurants</a></li>
                                        <li><a class="text-black dropdown-item nav-link" href="index.php?page=Tochten/Tochten">Tochten</a></li>
                                    </ul>
                                </div>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $_GET['page'] == 'Bookings/Index' ? 'active' : '' ?>" href="index.php?page=Bookings/Index">Boekingen</a> <!-- TODO: Add link -->
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $_GET['page'] == 'Users/Index' ? 'active' : '' ?>" href="index.php?page=Users/Index">Mijn profiel</a> <!-- TODO: Add link -->
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $_GET['page'] == 'Auth/Login' ? 'active' : '' ?>" href="index.php?page=Auth/Login">Inloggen</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $_GET['page'] == 'Auth/Register' ? 'active' : '' ?>" href="index.php?page=Auth/Register">Registreren</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $_GET['page'] == 'contact' ? 'active' : '' ?>" href="index.php?page=contact">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- If user is logged -->
    <?php if (isset($_SESSION["UserID"])) : ?>
        <?php
        require_once("pdo_connect.php");

        $id = $_SESSION["UserID"];

        // Verbinden met de database.
        $db = new Database();
        $connection = $db->Connect();

        // Gegevens opvragen op basis van inloggegevens.
        $query = $connection->prepare("SELECT Naam, Telefoon, Email FROM klanten WHERE ID = ?");

        // Query uitvoeren.
        $query->execute([$id]);

        $result = $query->fetch(PDO::FETCH_ASSOC);

        $db->Close();
        ?>

        <div class="logged">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col">
                        <h1>Mijn donkey travel</h1>
                    </div>
                    <div class="col">
                        <ul>
                            <?php renderUserInfo($result); ?>
                        </ul>
                    </div>
                    <div class="col">
                        <a class="float-end btn btn-danger" href="index.php?page=Auth/Logout">Uitloggen</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <main>
        <?php if (file_exists('./Views/' . $_GET['page'] . '.php')) : ?>
            <?php require_once('./Views/' . $_GET['page'] . '.php') ?>
        <?php else : ?>
            <div class="container">
                <h1>Pagina niet gevonden</h1>
            </div>
        <?php endif; ?>
    </main>

    <!-- Footer -->
    <footer class="text-center text-lg-start">

        <!-- Section: Links  -->
        <section id="top">
            <div class="container text-center text-md-start mt-5">
                <!-- Grid row -->
                <div class="row mt-3" style="text-align: center;">
                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Useful links
                        </h6>
                        <p>
                            <a class="text-reset" href="index.php?page=home" style="text-decoration: none;">Home</a>
                        </p>
                        <?php if (isset($_SESSION["UserID"])) : ?>
                            <?php if (isset($_SESSION["UserLevel"]) && $_SESSION["UserLevel"] > 1) : ?>
                                <p>
                                    <a class="text-reset" href="index.php?page=Beheer/Bookings/Index" style="text-decoration: none;">Overzichten</a>
                                </p>
                            <?php endif; ?>
                            <p>
                                <a class="text-reset" href="index.php?page=Bookings/Index" style="text-decoration: none;">Boekingen</a> <!-- TODO: Add link -->
                            </p>
                            <p>
                                <a class="text-reset" href="index.php?page=Users/Index" style="text-decoration: none;">Mijn profiel</a> <!-- TODO: Add link -->
                            </p>
                        <?php else : ?>
                            <p>
                                <a class="text-reset" href="index.php?page=Auth/Login" style="text-decoration: none;">Inloggen</a>
                            </p>
                            <p>
                                <a class="text-reset" href="index.php?page=Auth/Register" style="text-decoration: none;">Registreren</a>
                            </p>
                        <?php endif; ?>
                        <p>
                            <a class="text-reset" href="index.php?page=contact" style="text-decoration: none;">Contact</a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Contact
                        </h6>
                        <p><i class="fas fa-home me-3"></i>muntelaar 10, veghel, nederland</p>
                        <p>
                            <i class="fas fa-envelope me-3"></i>
                            dondkey@doney.com
                        </p>
                        <p><i class="fas fa-phone me-3"></i> +31 6 12345612</p>
                    </div>
                    <!-- Grid column -->
                </div>
                <!-- Grid row -->
            </div>
        </section>
        <!-- Section: Links  -->

        <!-- Copyright -->
        <div class="text-center p-4" id="bottom">
            &copy; 2022 <b>Donkey travel</b>
        </div>
        <!-- Copyright -->
    </footer>

    <!-- <script src="./assets/vendor/bootstrap-5.2.0/js/bootstrap.min.js"></script>
        <script src="./assets/vendor/bootstrap-5.2.0/js/bootstrap.bundle.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <script src="./assets/vendor/jquery-3.6.0-dist/jquery-min.js"></script>
    <script src="./assets/vendor/datatables-1.11.5/datatables.min.js"></script>
    <script src="./assets/js/contact.js"></script>

    <script>
        jQuery(document).ready(function() {
            jQuery('.table').DataTable();
            jQuery('#table').DataTable();
        });
    </script>

</html>