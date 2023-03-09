<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6">
            <section class="form">
                <h2>Account verwijderen</h2>
                <form action="#" method="POST">
                    <div class="form-group">
                        <label class="form-label" for="name">Naam:</label>
                        <input class="form-control" type="text" name="name" id="name" readonly value="<?php echo $name; ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="email">E-mail:</label>
                        <input class="form-control" type="email" name="email" id="email" readonly value="<?php echo $email; ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="phone">Telefoonnummer:</label>
                        <input class="form-control" type="text" name="phone" id="phone" readonly value="<?php echo $phone; ?>">
                    </div>
                    <input class="btn btn-danger" type="submit" value="Account verwijderen" name="delete">
                    <a class="btn btn-primary" href="index.php?page=Users/Index">Annuleren</a>
                </form>
            </section>
        </div>
    </div>
</div>
