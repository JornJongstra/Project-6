<div class="container mb-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6">
            <section class="form">
                <?php if (isset($_GET["Aangepast"])): ?>
                    <div class="alert alert-success">
                        Uw gegevens zijn aangepast.
                    </div>
                <?php endif; ?>
                <?php if (isset($_GET["EmailBestaatAl"])): ?>
                    <div class="alert alert-danger">
                        Het e-mailadres dat u heeft ingevoerd is al bij ons in gebruik.
                    </div>
                <?php endif; ?>
                <div class="card py-3 my-5">
                    <div class="card-body">
                        <form action="index.php?page=Users/Update" method="POST">
                            <h2>Account wijzigen</h2>
                            <div class="form-group">
                                <label class="form-label" for="name">Naam:</label>
                                <input class="form-control" type="text" name="name" id="name" required value="<?php echo $name; ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="email">E-mail:</label>
                                <input class="form-control <?php if (isset($_GET["EmailInvalid"])) echo "is-invalid"; ?>" type="email" name="email" id="email" required value="<?php echo $email; ?>">
                                <div id="email-invalid" class="invalid-feedback">
                                    Voer een geldig e-mailadres in. Dit e-mailadres is of al bij ons bekend, of niet geldig. Een e-mail moet een @-teken en een punt hebben.
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="phone">Telefoonnummer:</label>
                                <input class="form-control" type="tel" name="phone" id="phone" required value="<?php echo $phone; ?>">
                            </div>
                            <input class="btn btn-primary" type="submit" value="Aanpassen" name="Aanpassen">
                            <a class="btn btn-primary" href="#">Annuleren</a> <!-- TODO: Boekingen link toevoegen -->
                        </form>
                    <a class="btn btn-danger" href="index.php?page=Users/Delete">Account verwijderen</a>
                </div>
            </section>
        </div>
    </div>
</div>
