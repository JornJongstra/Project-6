<main>
    <div class="container mb-5 mt-5">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label class="form-label">Naam</label>
                        <input readonly type="text" class="form-control" id="naam" name="naam" value="<?php echo $inn_naam; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Adres</label>
                        <input readonly type="text" class="form-control" id="adres" name="adres" value="<?php echo $inn_adres; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input readonly type="email" class="form-control" id="email" name="email" value="<?php echo $inn_email; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Telefoon</label>
                        <input readonly type="text" class="form-control" id="telefoon" name="telefoon" value="<?php echo $inn_telefoon; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Coordinaten</label>
                        <input readonly type="text" class="form-control" id="coordinaten" name="coordinaten" value="<?php echo $inn_coordinaten; ?>">
                    </div>
                    <button type="submit" name="delete" class="btn btn-primary mb-2">Verwijderen</button>
                    <button type="submit" name="cancel" class="btn btn-primary mb-2">Annuleer</button>
                </form>
            </div>
        </div>
    </div>
</main>