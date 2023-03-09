<div class="container mb-5 mt-5">
    <?php ShowMsg(); ?>
    <h2>
        Boekingen
        <a class="btn btn-primary" href="index.php?page=Bookings/Create">
            <i class="fa-solid fa-plus"></i>
        </a>
    </h2>
<div class="table-responsive">
    <table class="table table-hover">
        <thead class="bg-primary text-light">
            <tr>
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
                    $ID = $boeking["ID"];
                    $StartDatum = date("Y-m-d", strtotime($boeking["StartDatum"]));
                    $EindDatum = date("Y-m-d", strtotime($boeking["EindDatum"]));
                    $PINCode = $boeking["PINCode"];
                    $Tocht = $boeking["Tocht"];
                    $TochtID = $boeking["TochtID"];
                    $Status = $boeking["Status"];
                    $ShowActions = $boeking["ShowActions"];
                    $PINToekennen = $boeking["PINtoekennen"];

                    // Alleen een pincode generen als er geen pincode is, en de status definitief is.
                    if ($PINCode == 0 && $PINToekennen === 1) {
                        $Today = date("Y-m-d");

                        // Kijken of de datum na de startdatum is, maar voor de einddatum.
                        if ($Today >= $StartDatum && $Today <= $EindDatum) {
                            $PINCode = "<a class=\"btn btn-primary\" href=\"index.php?page=Bookings/Pin&booking=$ID&Create\">
                                            <i class=\"fa-solid fa-plus\"></i>
                                        </a>";
                        } else {
                            $PINCode = "";
                        }
                    } else if ($PINCode === 0) {
                        // Er is geen pincode, en de status is niet definitief.
                        // We tonen dus geen genereer knop.
                        $PINCode = "";
                    } else {
                        // Pincode tonen en een delete knop.
                        $PINCode = "<span style=\"display: inline-block; width: 50px\">$PINCode</span>
                                    <a class=\"btn btn-danger\" href=\"index.php?page=Bookings/Pin&booking=$ID&Delete\">
                                        <i class=\"fa-solid fa-trash-can\"></i>
                                    </a>";
                    } ?>

                    <tr>
                        <td><?php echo $StartDatum; ?></td>
                        <td><?php echo $EindDatum; ?></td>
                        <td><?php echo $PINCode; ?></td>
                        <td><a class="btn btn-primary" href="index.php?page=Bookings/Route&booking=<?php echo $ID; ?>"><?php echo $Tocht; ?></a></td>
                        <td><?php echo $Status; ?></td>
                        <td>
                            <?php if ($ShowActions === 1): ?>
                                <a class="btn btn-primary" href="index.php?page=Bookings/Update&booking=<?php echo $ID ?>">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a class="btn btn-primary" href="index.php?page=Bookings/Delete&booking=<?php echo $ID ?>">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</div>
