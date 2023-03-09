<main>
    <div class="container mb-5 mt-5">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label class="form-label">StatusCode</label>
                        <input type="text" class="form-control" id="statusCode" name="statusCode" value="<?php echo $status_statusCode; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <input type="text" class="form-control" id="status" name="status" value="<?php echo $status_status; ?>">
                    </div>
                    <div class="mb-3">
                        <input type="checkbox" class="me-2 form-check-input" id="Verwijderbaar" name="Verwijderbaar" <?php if ($status_verwijderbaar == 1){ ?> checked <?php } ?>>
                        <label class="form-label">Verwijderbaar</label>
                    </div>
                    <div class="mb-3">
                        <input type="checkbox" class="me-2 form-check-input" id="PINtoekennen" name="PINtoekennen" <?php if ($status_PINtoekennen == 1){ ?> checked <?php } ?>>
                        <label class="form-label">PIN toekennen</label>
                    </div>
                    <button type="submit" name="update" class="btn btn-primary mb-2">Update</button>
                    <button type="submit" name="cancel" class="btn btn-primary mb-2">Annuleer</button>
                </form>
            </div>
        </div>
    </div>
</main>
