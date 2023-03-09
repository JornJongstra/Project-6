<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <section class="form">
                <h2>Boeking aanmaken</h2>
                <form action="#" method="POST">
                    <div class="form-group">
                        <label class="form-label" for="startDate">Startdatum:</label>
                        <input class="form-control" value="<?php echo date('Y-m-d') ?>" type="date" name="startDate" id="startDate" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="route">Tocht:</label>
                        <select class="form-select" name="route" id="route" required>
                            <?php
                                foreach ($routes as $route) {
                                    $ID = $route["ID"];
                                    $routeName = $route["Route"];

                                    echo "<option value=$ID>$routeName</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <input class="btn btn-primary" type="submit" name="Boeken" value="Boeken">
                    <a class="btn btn-danger" href="index.php?page=Bookings/Index">Annuleren</a>
                </form>
            </section>
        </div>
    </div>
</div>
