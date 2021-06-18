jQuery( document ).ready(
	function($) {

		$( '.simple-form' ).on(
			'submit',
			function(e) {
				e.preventDefault();

				let $form = $( this );

				$.post(
					$form.attr( 'action' ),
					$form.serialize(),
					function(data) {
						alert( 'This is data returned from the server ' + data );
					},
					'json'
				);
			}
		);

	}
);
