<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <section class="form">
                <h2>Boeking wijzigen</h2>
                <form action="#" method="POST">
                    <div class="form-group">
                        <label class="form-label" for="startDate">Startdatum:</label>
                        <input class="form-control" type="date" name="startDate" id="startDate" required value="<?php echo $booking["StartDatum"]; ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="route">Tocht:</label>
                        <select class="form-select" name="route" id="route" required>
                            <?php
                                foreach ($routes as $route) {
                                    $ID = $route["ID"];
                                    $routeName = $route["Route"];

                                    echo "<option value=\"$ID\" ";

                                    if ($booking["FKtochtenID"] == $ID) {
                                        echo "selected";
                                    }

                                    echo ">$routeName</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <?php if ($return == "Beheer/Bookings/Index"): ?>
                        <div class="form-group">
                            <label class="form-label" for="status">Status:</label>
                            <select class="form-select" name="status" id="status" required>
                                <?php
                                    foreach ($statussen as $status) {
                                        $ID = $status["ID"];
                                        $statusName = $status["Status"];

                                        echo "<option value=\"$ID\" ";

                                        if ($booking["FKstatussenID"] == $ID) {
                                            echo "selected";
                                        }

                                        echo ">$statusName</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    <?php endif; ?>
                    <input class="btn btn-primary" type="submit" name="Wijzigen" value="Wijzigen">
                    <?php
                        if (isset($_GET["return"])) {
                            $return = $_GET["return"];
                            echo "<a class=\"btn btn-danger\" href=\"index.php?page=$return\">Annuleren</a>";
                        } else {
                            echo "<a class=\"btn btn-danger\" href=\"index.php?page=Bookings/Index\">Annuleren</a>";
                        }
                    ?>
                </form>
            </section>
        </div>
    </div>
</div>
