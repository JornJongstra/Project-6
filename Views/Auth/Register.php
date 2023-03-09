<div class="container mb-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6">
            <section class="form">
                <?php if ($register_failed): ?>
                    <div class="alert alert-danger">
                        Er ging iets mis met een account aanmaken. Uw account is niet aangemaakt.
                    </div>
                <?php endif; ?>
                <?php if(isset($_GET["Delete"])): ?>
                    <div class="alert alert-danger">
                        Uw account is verwijderd.
                    </div>
                <?php endif; ?>

                <h2>Registreren</h2>
                <div class="card py-3 my-5">
                    <div class="card-body">
                        <form action="#" method="POST">
                            <div class="form-group">
                                <label class="form-label" for="naam">Naam:</label>
                                <input class="form-control <?php echo $name_status; ?>" type="text" name="naam" id="naam" required value="<?php echo $naam; ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="email">E-mail:</label>
                                <input class="form-control <?php echo $email_status; ?>" type="email" name="email" id="email" required value="<?php echo $email; ?>" aria-describedby="email-invalid">
                                <div id="email-invalid" class="invalid-feedback">
                                    Voer een geldig e-mailadres in. Dit e-mailadres is of al bij ons bekend, of niet geldig. Een e-mail moet een @-teken en een punt hebben.
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="telefoon">Telefoonnummer:</label>
                                <input class="form-control <?php echo $phone_status; ?>" type="text" name="telefoon" id="telefoon" required value="<?php echo $telefoon; ?>" aria-describedby="phone-invalid">
                                <div id="phone-invalid" class="invalid-feedback">
                                    Voer een geldig telefoonnummer in.
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="password">Wachtwoord:</label>
                                <input class="form-control <?php echo $password_status; ?>" type="password" name="password" id="password" required value="<?php echo $password; ?>" aria-describedby="password-invalid">
                                <div id="password-invalid" class="invalid-feedback">
                                    Voer een geldig wachtwoord in. Een wachtwoord moet uit minimaal 8 tekens bestaan.
                                </div>
                            </div>
                            <input class="btn btn-primary" type="submit" name="Registreren" value="Registreren">
                        </form>
                        <a href="index.php?page=Auth/Login">Heeft u al een account? Log dan hier in!</a>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
