<main>
    <div class="container">
        <div class="card text-center">
            <div class="card-header">Info</div>
            <div class="card-body">
                <ul class="list-group list-group-flush ">
                    <li class="list-group-item">Naam: <?php echo $restaurant_naam; ?></li>
                    <li class="list-group-item">Adres: <?php echo $restaurant_adres; ?></li>
                    <li class="list-group-item">Email: <?php echo $restaurant_email; ?></li>
                    <li class="list-group-item">Telefoon: <?php echo $restaurant_telefoon; ?></li>
                    <li class="list-group-item">Coordinaten: <?php echo $restaurant_coordinaten; ?></li>
                </ul>
            </div>
            <div class="card-footer text-muted">
                <a href="index.php?page=Restaurants/Restaurants" class="btn btn-primary">Ga terug</a>
            </div>
        </div>
    </div>
</main>