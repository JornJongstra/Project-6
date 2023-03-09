<div class="container mb-5 mt-5">
    <?php ShowMsg(); ?>
    <h2>Beheer gebruikers</h2>
    <a class="btn btn-primary mb-3" href="index.php?page=Beheer/Users/Index">Verversen</a>
    <table class="table table-hover">
        <thead class="bg-primary text-light">
            <tr>
                <td>ID</td>
                <td>Naam</td>
                <td>E-mail</td>
                <td>Telefoonnummer</td>
                <td>Level</td>
                <td>Acties</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user["ID"]; ?></td>
                    <td><?php echo $user["Naam"]; ?></td>
                    <td><?php echo $user["Email"]; ?></td>
                    <td><?php echo $user["Telefoon"]; ?></td>
                    <td><?php echo $user["Level"]; ?></td>
                    <td>
                        <a class="btn btn-primary" href="index.php?page=Beheer/Users/Update&user=<?php echo $user["ID"]; ?>">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a class="btn btn-primary" href="index.php?page=Beheer/Users/Delete&user=<?php echo $user["ID"]; ?>">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
