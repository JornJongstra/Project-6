jQuery(document).ready(function() {
	// On contact form submit
	jQuery('form#contact-form').on('submit', function (e) {
		if (jQuery('form#contact-form')[0].checkValidity() == false) {
			e.preventDefault();
			jQuery('form#contact-form').addClass('was-validated');
		} else{
			e.preventDefault();
			submit_contact_form();
			
		}
	});
});

/***************************************
 * Submit contact form
 ***************************************/
function submit_contact_form(e) {
	jQuery('.submit').addClass('btn-loading');

	//Create data object
	var data = jQuery('form#contact-form').serialize();

	// Post data with ajax to php
	jQuery.post('./ajax/send.php', data, onComplete_submit_contact_form);
}

function onComplete_submit_contact_form(response) {
	jQuery('form#contact-form')[0].reset();

	jQuery('#contact-form-response .form-response-title').text(response.response_title);
	jQuery('#contact-form-response .form-response-message').text(response.response_message);

	jQuery('#contact-form').slideUp(400, function() {
		jQuery('#contact-form').detach();
	});
	jQuery('#contact-form-response').slideDown(400, function() {
		jQuery('html, body').animate({
			scrollTop: jQuery('#contact-form-response').offset().top
		}, 400);
	});
}