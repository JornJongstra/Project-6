<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <section class="form">
                <h2>Overnachting aanpassen</h2>
                <form action="#" method="POST">
                    <div class="form-group">
                        <label class="form-label" for="status">Status:</label>
                        <select class="form-select" name="status" id="status">
                            <?php foreach ($statussen as $status): ?>
                                <option value="<?php echo $status["ID"]; ?>">
                                    <?php echo $status["Status"]; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <input class="btn btn-primary" type="submit" value="Aanpassen" name="Aanpassen">
                    <a class="btn btn-primary" href="index.php?page=Beheer/Bookings/Overnachtingen/Index&booking=<?php echo $booking; ?>">Annuleren</a>
                </form>
            </section>
        </div>
    </div>
</div>
