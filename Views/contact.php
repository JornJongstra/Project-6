<div class="container">
    <section id="contact">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="card py-3 my-5">
                    <div class="card-body">
                        <form id="contact-form" novalidate>
                            <h2>Contact</h2>
                            <div class="form-group">
                                <label for="name" class="col-form-label">Naam</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                                <div class="invalid-feedback">Vul a.u.b. uw naam in</div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                                <div class="invalid-feedback">Vul een geldig e-mailadres in</div>
                            </div>
                            <div class="form-group">
                                <label for="message" class="col-form-label">Bericht</label>
                                <textarea rows="5" class="form-control" id="message" name="message" required></textarea>
                                <div class="invalid-feedback">Geef een bericht a.u.b</div>
                            </div>
                            <div class="form-buttons">
                                <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
                                <button type="submit" class="btn btn-primary submit">Verzenden</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="form-response" id="contact-form-response">
                    <h2 class="form-response-title"></h2>
                    <p class="form-response-message"></p>
                </div>
            </div>
        </div>
    </section>
</div>
