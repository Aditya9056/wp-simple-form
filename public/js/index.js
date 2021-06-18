jQuery( document ).ready(
	jQuery(".simple-form").on(
		'submit',
		( e ) => {
      e.preventDefault()

      if( jQuery("#form_honeypot").val().length !== 0 ){
          return false;
      }

      const formData = {
        date_time: jQuery("#date-time").val(),
        wp_nonce: jQuery("#wp_nonce").val(),
        name: jQuery("#name").val(),
        phone_number: jQuery("#phone-number").val(),
        email: jQuery("#email").val(),
        budget: jQuery("#budget").val(),
        message: jQuery("#message").val(),
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
					// beforeSend: ( xhr ) => {
					// xhr.setRequestHeader( 'X-WP-Nonce', 'aNonce' );
					// },
					success : ( response ) => {
					  alert(response);
						console.log( response )
					},
					error: ( error ) => {
						console.log( error )
					},
				}
			);
		}
	),
);
