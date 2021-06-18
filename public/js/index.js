jQuery( document ).ready(
	jQuery(".simple-form").on(
		'submit',
		( e ) => {
      e.preventDefault()

      if( jQuery("#form_honeypot").val().length !== 0 ){
          return false;
      }

      let formData = {
        date_time: jQuery("#date-time").val(),
        wp_nonce: jQuery("#wp_nonce").val(),
        name: jQuery("#name").val(),
        phone_number: jQuery("#phone-number").val(),
        email: jQuery("#email").val(),
        budget: jQuery("#budget").val(),
        message: jQuery("#message").val(),
      };
      // let form = jQuery( ".simple-form" ).serialize();

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

// function($) {
// $( '.simple-form' ).on(
// 'submit',
// function(e) {
// e.preventDefault();
//
// let form = $( this );
//
// $.post(
// form.attr( 'action' ),
// form.serialize(),
// function(data) {
// alert( 'This is data returned from the server ' + data );
// },
// 'json'
// );
// }
// );
//
// }

