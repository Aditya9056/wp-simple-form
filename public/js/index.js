const successMessage = () => {
  jQuery('.main-container').css("display", "flex");
}
const submitHandler  = () => {
	jQuery( ".simple-form" ).on(
		'submit',
		( e ) => {
        e.preventDefault()

			if ( jQuery( "#form_honeypot" ).val().length !== 0 ) {
				return false;
			}

			const formData = {
				date_time: jQuery( "#date-time" ).val(),
				wp_nonce: jQuery( "#wp_nonce" ).val(),
				name: jQuery( "#name" ).val(),
				phone_number: jQuery( "#phone-number" ).val(),
				email: jQuery( "#email" ).val(),
				budget: jQuery( "#budget" ).val(),
				message: jQuery( "#message" ).val(),
			};
        jQuery.ajax(
			{
				url : simpleForm.ajaxUrl,
				method: "POST",
				data:{
					action: 'my_action',
					mode: 'POST',
					data: formData,
				},
				success : ( response ) => {
					jQuery( ".wp-simple-form.message.success" ).css( "display", "block" );
					console.log( response )
          successMessage();
				},
				error: ( error ) => {
					console.log( error )
				},
				}
		);
		}
);
}

jQuery( document ).ready(
	() => {
		submitHandler();
	}
);
