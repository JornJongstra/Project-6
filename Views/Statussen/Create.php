<main>
    <div class="container mb-5 mt-5">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label class="form-label">StatusCode</label>
                        <input type="number" class="form-control" id="statusCode" name="statusCode">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <input type="text" class="form-control" id="status" name="status">
                    </div>
                    <div class="mb-3">
                        <input type="checkbox" class="me-2 form-check-input" id="Verwijderbaar" name="Verwijderbaar">
                        <label class="form-label">Verwijderbaar</label>
                    </div>
                    <div class="mb-3">
                        <input type="checkbox" class="me-2 form-check-input" id="PINtoekennen" name="PINtoekennen">
                        <label class="form-label">PIN toekennen</label>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary mb-3">Bewaren</button>
                    <button type="submit" name="cancel" class="btn btn-primary mb-3">Annuleren</button>
                </form>
            </div>
        </div>
    </div>
</main>