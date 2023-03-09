<main>
    <div class="container mb-5 mt-5">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label class="form-label">Omschrijving</label>
                        <input type="text" class="form-control" id="omschrijving" name="omschrijving" value="<?php echo $tocht_omschrijving; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Route</label>
                        <input type="text" class="form-control" id="route" name="route" value="<?php echo $tocht_route; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Aantal Dagen</label>
                        <input type="number" class="form-control" id="aantalDagen" name="aantalDagen" value="<?php echo $tocht_aantalDagen; ?>">
                    </div>
                    <button type="submit" name="update" class="btn btn-primary mb-2">Update</button>
                    <button type="submit" name="cancel" class="btn btn-primary mb-2">Annuleer</button>
                </form>
            </div>
        </div>
    </div>
</main>