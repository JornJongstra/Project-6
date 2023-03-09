<div class="container mb-5 mt-5">
    <div class="row mb-3">
        <div class="col">
            <h2>overnachtingen</h2>
        </div>
        <div class="col">
            <div class="form-group">
                <label class="form-label" for="startdatum">Startdatum:</label>
                <input class="form-control" type="text" id="startdatum" readonly value="<?php echo $bookingInfo["StartDatum"] ?>">
            </div>
            <div class="form-group">
                <label class="form-label" for="einddatum">Einddatum:</label>
                <input class="form-control" type="text" id="einddatum" readonly value="<?php echo BerekenEinddatum($bookingInfo["StartDatum"], $bookingInfo["AantalDagen"]); ?>">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label class="form-label" for="klant">Klant:</label>
                <input class="form-control" type="text" id="klant" readonly value="<?php echo $bookingInfo["Naam"] ?>">
            </div>
            <div class="form-group">
                <label class="form-label" for="email-telefoon">E-mail / Telefoon:</label>
                <input class="form-control" type="text" id="email-telefoon" readonly value="<?php echo $bookingInfo["Email"] . " / " . $bookingInfo["Telefoon"]; ?>">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label class="form-label" for="boekingstatus">Boekingstatus:</label>
                <input class="form-control" type="text" id="boekingstatus" readonly value="<?php echo $bookingInfo["Status"]; ?>">
            </div>
            <div class="form-group">
                <label class="form-label" for="route">Route:</label>
                <input class="form-control" type="text" id="route" readonly value="<?php echo $bookingInfo["Route"] ?>">
            </div>
        </div>
    </div>
    <hr class="mb-3" />
    <div class="row mb-3">
        <div class="col">
            <h3>Huidige overnachtingen:</h3>
            <table class="table table-hover">
                <thead class="bg-primary text-light">
                    <tr>
                        <th>Herberg</th>
                        <th>Adres</th>
                        <th>Status</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($huidige_overnachtingen as $overnachting): ?>
                            <?php if ($overnachting["FKboekingenID"] == $booking): ?>
                                <tr>
                                    <td><?php echo $overnachting["Naam"]; ?></td>
                                    <td><?php echo $overnachting["Adres"]; ?></td>
                                    <td><?php echo $overnachting["Status"]; ?></td>
                                    <td>
                                        <form action="#" method="POST">
                                            <input type="hidden" name="overnachting" value="<?php echo $overnachting["overnachtingID"]; ?>">
                                            <input class="btn btn-primary" type="submit" name="Remove" value="-">
                                            <a class="btn btn-primary" href="index.php?page=Beheer/Bookings/Overnachtingen/Update&overnachting=<?php echo $overnachting["overnachtingID"]; ?>&booking=<?php echo $booking; ?>">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        </form>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="col">
            <h3>Beschikbare overnachtingen:</h3>
            <table class="table table-hover">
                <thead class="bg-primary text-light">
                    <tr>
                        <th>Herberg</th>
                        <th>Adres</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($herbergen as $herberg): ?>
                        <tr>
                            <td><?php echo $herberg["Naam"]; ?></td>
                            <td><?php echo $herberg["Adres"]; ?></td>
                            <td>
                                <form action="#" method="POST">
                                    <input type="hidden" name="herberg" value="<?php echo $herberg["ID"]; ?>">
                                    <input class="btn btn-primary" type="submit" name="Add" value="+">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <a class="btn btn-primary mb-3" href="index.php?page=Beheer/Bookings/Index">Terug</a>
</div>
