<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <section class="form">
            <h2>Gebruiker bewerken</h2>
            <form action="#" method="POST">
                <div class="form-group">
                    <label class="form-label" for="name">Naam:</label>
                    <input class="form-control" type="text" name="name" id="name" value="<?php echo $user["Naam"]; ?>" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="email">E-mail:</label>
                    <input class="form-control" type="text" name="email" id="email" value="<?php echo $user["Email"]; ?>" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="telefoon">Telefoonnummer:</label>
                    <input class="form-control" type="text" name="telefoon" id="telefoon" value="<?php echo $user["Telefoon"]; ?>" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="level">Level:</label>
                    <input class="form-control" type="number" name="level" id="level" value="<?php echo $user["Level"]; ?>" required>
                </div>
                <input class="btn btn-primary" type="submit" value="Bewerken" name="Bewerken">
                <a class="btn btn-primary" href="index.php?page=Beheer/Users/Index">Annuleren</a>
            </form>
        </div>
    </div>
</div>
