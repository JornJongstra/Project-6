<main>
    <div class="container mb-5 mt-5">
    <?php ShowMsg(); ?>
    <div class="fs-2 text-center">Tochten</div>
        <a href="index.php?page=Tochten/Create" class="btn btn-primary mb-3">Maken</a>
        <div class="table-responsive">
        <table id="table" class="table table-hover">
            <thead class="bg-primary text-light">
                <tr>
                    <th>Omschrijving</th>
                    <th>Route</th>
                    <th>Aantal Dagen</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <?php foreach ($tochten as $tocht) : ?>
                <tr>
                    <td><?php echo $tocht['Omschrijving']; ?></td>
                    <td><?php echo $tocht['Route']; ?></td>
                    <td><?php echo $tocht['AantalDagen']; ?></td>
                    <td><a href="index.php?page=Tochten/Delete&ID=<?php echo $tocht['ID']; ?>"><i class="fa-solid fa-trash"></i></a>
                        <a href="index.php?page=Tochten/Update&ID=<?php echo $tocht['ID']; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="index.php?page=Tochten/View&ID=<?php echo $tocht['ID']; ?>"><i class="fa-solid fa-map"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        </div>
    </div>
</main>
