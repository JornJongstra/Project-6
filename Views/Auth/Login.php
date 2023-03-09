<div class="container mb-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6">
            <section class="form">
                <h2>Inloggen</h2>
                <div class="card py-3 my-5">
                    <div class="card-body">
                        <form action="#" method="POST">
                            <div class="form-group">
                                <label class="form-label" for="email">E-mail:</label>
                                <input class="form-control <?php echo $status_email; ?>" type="email" name="email" id="email" required value="<?php echo $email; ?>" aria-describedby="email-invalid">
                                <span id="email-invalid" class="invalid-feedback">
                                    Voer een geldig e-mailadres in.
                                </span>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="password">Wachtwoord:</label>
                                <input class="form-control <?php echo $status_password; ?>" type="password" name="password" id="password" required value="<?php echo $password; ?>" aria-describedby="password-invalid">
                                <span id="password-invalid" class="invalid-feedback">
                                    Voer een geldig wachtwoord in.
                                </span>
                            </div>
                            <input class="btn btn-primary" style="width:100%" type="submit" name="Inloggen" value="Inloggen">
                        </form>
                        <a href="index.php?page=Auth/Register">Geen account? Maak er dan hier een!</a>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
