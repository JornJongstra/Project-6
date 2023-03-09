<main>
    <div class="container mb-5 mt-5">
    <?php ShowMsg(); ?>
    <div class="fs-2 text-center">Restaurants</div>
        <a href="index.php?page=Restaurants/Create" class="btn btn-primary mb-3">Maken</a>
        <div class="table-responsive">
        <table class="table table-hover">
            <thead class="bg-primary text-light">
                <tr>
                    <th>Naam</th>
                    <th>Adres</th>
                    <th>Email</th>
                    <th>Telefoon</th>
                    <th>Coordinaten</th>
                    <th>Gemaakt op</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <?php foreach ($restaurants as $restaurant) : ?>
                <tr>
                    <td><?php echo $restaurant['Naam']; ?></td>
                    <td><?php echo $restaurant['Adres']; ?></td>
                    <td><?php echo $restaurant['Email']; ?></td>
                    <td><?php echo $restaurant['Telefoon']; ?></td>
                    <td><?php echo $restaurant['Coordinaten']; ?></td>
                    <td><?php echo $restaurant['Gewijzigd']; ?></td>
                    <td><a href="index.php?page=Restaurants/Delete&ID=<?php echo $restaurant['ID']; ?>" class="me-1"><i class="fa-solid fa-trash"></i></a>
                        <a href="index.php?page=Restaurants/Update&ID=<?php echo $restaurant['ID']; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        </div>
    </div>
</main>
