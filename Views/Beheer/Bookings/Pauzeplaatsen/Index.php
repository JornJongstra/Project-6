<div class="container mb-5 mt-5">
    <div class="row mb-3">
        <div class="col">
            <h2>Pauzeplaatsen</h2>
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
            <h3>Huidige pauzeplaatsen:</h3>
            <table class="table table-hover">
                <thead class="bg-primary text-light">
                    <tr>
                        <th>Restaurant</th>
                        <th>Adres</th>
                        <th>Status</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($huidige_pauzeplaatsen as $pauzeplaats): ?>
                            <?php if ($pauzeplaats["FKboekingenID"] == $booking): ?>
                                <tr>
                                    <td><?php echo $pauzeplaats["Naam"]; ?></td>
                                    <td><?php echo $pauzeplaats["Adres"]; ?></td>
                                    <td><?php echo $pauzeplaats["Status"]; ?></td>
                                    <td>
                                        <form action="#" method="POST">
                                            <input type="hidden" name="Pauzeplaats" value="<?php echo $pauzeplaats["pauzeplaatsID"]; ?>">
                                            <input class="btn btn-primary" type="submit" name="Remove" value="-">
                                            <a class="btn btn-primary" href="index.php?page=Beheer/Bookings/Pauzeplaatsen/Update&pauzeplaats=<?php echo $pauzeplaats["pauzeplaatsID"]; ?>&booking=<?php echo $booking; ?>">
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
            <h3>Beschikbare pauzeplaatsen:</h3>
            <table class="table table-hover">
                <thead class="bg-primary text-light">
                    <tr>
                        <th>Restaurant</th>
                        <th>Adres</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($restaurants as $restaurant): ?>
                        <tr>
                            <td><?php echo $restaurant["Naam"]; ?></td>
                            <td><?php echo $restaurant["Adres"]; ?></td>
                            <td>
                                <form action="#" method="POST">
                                    <input type="hidden" name="Restaurant" value="<?php echo $restaurant["ID"]; ?>">
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
