<main>
    <div class="container mb-5 mt-5">
        <?php ShowMsg(); ?>
        <div class="fs-2 text-center">Herbergen</div>
        <a href="index.php?page=Inns/Create" class="btn btn-primary mb-3">Maken</a>
        <div class="table-responsive">
        <table id="table" class="table table-hover">
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
            <?php foreach ($inns as $inn) : ?>
                <tr>
                    <td><?php echo $inn['Naam']; ?></td>
                    <td><?php echo $inn['Adres']; ?></td>
                    <td><?php echo $inn['Email']; ?></td>
                    <td><?php echo $inn['Telefoon']; ?></td>
                    <td><?php echo $inn['Coordinaten']; ?></td>
                    <td><?php echo $inn['Gewijzigd']; ?></td>
                    <td><a href="index.php?page=Inns/Delete&ID=<?php echo $inn['ID']; ?>"><i class="fa-solid fa-trash"></i></a>
                        <a href="index.php?page=Inns/Update&ID=<?php echo $inn['ID']; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        </div>
    </div>
</main>
