<div class="container mb-5 mt-5">
    <?php ShowMsg(); ?>
    <h2>
        Beheer boekingen
    </h2>
    <a class="mb-3 btn btn-primary" href="index.php?page=Beheer/Bookings/Index">Verversen</a>
    <div class="table-responsive">
    <table class="table table-hover">
        <thead class="bg-primary text-light">
            <tr>
                <th>Geboekt door</th>
                <th>Startdatum</th>
                <th>Einddatum</th>
                <th>PIN Code</th>
                <th>Tocht</th>
                <th>Status</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($boekingen as $boeking):
                    $Boeker = $boeking["Boeker"];
                    $ID = $boeking["ID"];
                    $StartDatum = date("Y-m-d", strtotime($boeking["StartDatum"]));
                    $EindDatum = date("Y-m-d", strtotime($boeking["EindDatum"]));
                    $PINCode = $boeking["PINCode"];
                    $Tocht = $boeking["Tocht"];
                    $Status = $boeking["Status"];
                    $ShowActions = $boeking["ShowActions"];

                    if ($PINCode === 0) {
                        $PINCode = "";
                    } ?>

                    <tr>
                        <td><?php echo $Boeker; ?></td>
                        <td><?php echo $StartDatum; ?></td>
                        <td><?php echo $EindDatum; ?></td>
                        <td><?php echo $PINCode; ?></td>
                        <td><a class="btn btn-primary" href="index.php?page=Bookings/Route&booking=<?php echo $ID; ?>"><?php echo $Tocht; ?></a></td>
                        <td><?php echo $Status; ?></td>
                        <td>
                            <a class="btn btn-primary" href="index.php?page=Bookings/Update&booking=<?php echo $ID; ?>&return=Beheer/Bookings/Index">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a class="btn btn-primary" href="index.php?page=Bookings/Delete&booking=<?php echo $ID; ?>&return=Beheer/Bookings/Index">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                            <a class="btn btn-primary" href="index.php?page=Beheer/Bookings/Pauzeplaatsen/Index&booking=<?php echo $ID; ?>">
                                <i class="fa-solid fa-umbrella-beach"></i>
                            </a>
                            <a class="btn btn-primary" href="index.php?page=Beheer/Bookings/Overnachtingen/Index&booking=<?php echo $ID; ?>">
                                <i class="fa-solid fa-house"></i>
                            </a>
                        </td>
                    </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</div>
