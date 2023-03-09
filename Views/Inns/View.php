<main>
    <div class="container">
        <div class="card text-center">
            <div class="card-header">Info</div>
            <div class="card-body">
                <ul class="list-group list-group-flush ">
                    <li class="list-group-item">Naam: <?php echo $inn_naam; ?></li>
                    <li class="list-group-item">Adres: <?php echo $inn_adres; ?></li>
                    <li class="list-group-item">Email: <?php echo $inn_email; ?></li>
                    <li class="list-group-item">Telefoon: <?php echo $inn_telefoon; ?></li>
                    <li class="list-group-item">Coordinaten: <?php echo $inn_coordinaten; ?></li>
                </ul>
            </div>
            <form method="POST" action="">
            <div class="card-footer text-muted">
                <button type="submit" name="back" class="btn btn-primary mb-3">Ga terug</button>
            </div>
            </form>
        </div>
    </div>
</main>