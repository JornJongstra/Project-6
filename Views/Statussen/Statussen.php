<main>
    <div class="container mb-5 mt-5">
    <?php ShowMsg(); ?>
    <div class="fs-2 text-center">Statussen</div>
        <a href="index.php?page=Statussen/Create" class="btn btn-primary mb-3">Maken</a>
        <table class="table table-hover">
            <thead class="bg-primary text-light">
                <tr>
                    <th>StatusCode</th>
                    <th>Status</th>
                    <th>Verwijderbaar</th>
                    <th>PINtoekennen</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <?php foreach ($statussen as $status) : ?>
                <tr>
                    <td><?php echo $status['StatusCode']; ?></td>
                    <td><?php echo $status['Status']; ?></td>
                    <td><?php if ($status['Verwijderbaar'] == 0) {echo "Nee";}else{echo "Ja";} ?></td>
                    <td><?php if ($status['PINtoekennen'] == 0) {echo "Nee";}else{echo "Ja";} ?></td>
                    <td><a href="index.php?page=Statussen/Delete&ID=<?php echo $status['ID']; ?>"><i class="fa-solid fa-trash"></i></a>
                        <a href="index.php?page=Statussen/Update&ID=<?php echo $status['ID']; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</main>
