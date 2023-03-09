<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <section class="form">
                <h2>Boeking verwijderen</h2>
                <form action="#" method="POST">
                    <div class="form-group">
                        <label class="form-label" for="startDate">Startdatum:</label>
                        <input class="form-control" type="date" name="startDate" id="startDate" required readonly value="<?php echo $booking["StartDatum"]; ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="route">Tocht:</label>
                        <select class="form-select" disabled>
                            <?php
                                $routeID = $route["ID"];
                                $routeName = $route["Route"];

                                echo "<option value=\"$routeID\">$routeName</option>";
                            ?>
                        </select>
                    </div>
                    <input class="btn btn-danger" type="submit" name="Verwijderen" value="Verwijderen">
                    <?php
                        if (isset($_GET["return"])) {
                            $return = $_GET["return"];
                            echo "<a class=\"btn btn-primary\" href=\"index.php?page=$return\">Annuleren</a>";
                        } else {
                            echo "<a class=\"btn btn-primary\" href=\"index.php?page=Bookings/Index\">Annuleren</a>";
                        }
                    ?>
                </form>
            </section>
        </div>
    </div>
</div>
