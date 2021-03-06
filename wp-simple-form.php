<?php
/**
 * Plugin Name: WP Simple Form
 * Plugin URI:  #none
 * Description: A simple form plugin for WordPress, tailored for Elegant themes.
 * Version:     0.1.0
 * Author:      Aditya Jain
 * Author URI:  http://adityaj.ml
 * License:     MIT
 * License URI: https://www.gnu.org/licenses/gpl-3.0.en.html
 * Text Domain: wp-simple-form
 * Domain Path: /languages
 * php version 7.4
 */

require_once __DIR__ . '/src/class-fastformphp.php';

if ( ! class_exists( 'WPSimpleForm' ) ) {

	/**
	 * Class WpSimpleForm
	 */
	class WpSimpleForm {

		/**
		 * Calling assets loading function.
		 */
		public function __construct() {
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			add_shortcode( 'wp-simple-form', array( $this, 'form' ) );
			add_action( 'wp_ajax_my_action', array( $this, 'form_handler' ) );
			add_action( 'wp_ajax_nopriv_my_action', array( $this, 'form_handler' ) );
		}

		/**
		 * Loading assets and initialization.
		 */
		public function enqueue_scripts() {
			wp_enqueue_style(
				'main-style',
				plugins_url( 'public/css/style.css', __FILE__ ),
				array(),
				'1.2.4',
				false
			);

			wp_enqueue_script(
				'main-script',
				plugins_url( 'public/js/index.js', __FILE__ ),
				array( 'wp-i18n', 'jquery' ),
				filemtime( plugin_dir_path( __FILE__ ) . 'public/js/index.js' ),
				true
			);

			wp_localize_script( 'main-script', 'simpleForm', array( 'ajaxUrl' => admin_url( 'admin-ajax.php' ) ) );
		}

		/**
		 * Form code.
		 *
		 * @param WpSimpleForm $atts is for defining the attributes for the form.
		 */
		public function form( $atts ) {
			$atts = shortcode_atts(
				array(
					'add_honeypot'  => false,
					'name_label'    => __( 'Name', 'wp-simple-form' ),
					'phone_label'   => __( 'Phone Number', 'wp-simple-form' ),
					'email_label'   => __( 'Email', 'wp-simple-form' ),
					'budget_label'  => __( 'Desired Budget', 'wp-simple-form' ),
					'message_label' => __( 'Message', 'wp-simple-form' ),
					'maxlength'     => '50',
					'msg_maxlength' => '400',
					'rows'          => '30',
					'cols'          => '50',
				),
				$atts,
				'simple-short-code'
			);

			// Instantiate form class.
			$form = new FastFormPHP();

			// Set form options.
			$form->set_att( 'action', esc_url( admin_url( 'admin-ajax.php' ) ) );
			$form->set_att( 'add_honeypot', true );
			$form->set_att( 'class', 'simple-form' );

			// Add form inputs.
			$form->add_input(
				'action',
				array(
					'type'  => 'hidden',
					'value' => 'simple-form',
				),
				'action'
			);

			// wp_nonce.
			$form->add_input(
				'wp_nonce',
				array(
					'type'  => 'hidden',
					'value' => wp_create_nonce( 'submit-simple-form' ),
				),
				'wp_nonce'
			);

			// date and time.
			$form->add_input(
				'date-time',
				array(
					'type'  => 'hidden',
					'value' => current_time( 'Y-m-d' ) . ' - ' . get_the_time(),
				),
				'date-time'
			);

			// Name.
			$form->add_input(
				$atts['name_label'],
				array(
					'type'        => 'text',
					'placeholder' => __( 'Enter your name', 'wp-simple-form' ),
					'required'    => true,
					'max'         => $atts['maxlength'],
					'autofocus'   => true,

				),
				'name'
			);

			// Phone Number.
			$form->add_input(
				$atts['phone_label'],
				array(
					'type'        => 'text',
					'placeholder' => __( 'Enter your phone number', 'wp-simple-form' ),
					'required'    => true,
					'max'         => $atts['maxlength'],
				),
				'phone-number'
			);

			// Email.
			$form->add_input(
				$atts['email_label'],
				array(
					'type'        => 'email',
					'placeholder' => __( 'Enter your email address', 'wp-simple-form' ),
					'required'    => true,
					'max'         => $atts['maxlength'],
				),
				'email'
			);

			// Desired Budget.
			$form->add_input(
				$atts['budget_label'],
				array(
					'type'        => 'text',
					'placeholder' => __( 'Enter your desired budget', 'wp-simple-form' ),
					'required'    => true,
					'max'         => $atts['maxlength'],
				),
				'budget'
			);

			// Message.
			$form->add_input(
				$atts['message_label'],
				array(
					'type'        => 'textarea',
					'placeholder' => __( 'Enter your message', 'wp-simple-form' ),
					'required'    => true,
					'rows'        => '45',
					'cols'        => '45',
					'max'         => $atts['msg_maxlength'],
				),
				'message'
			);

			// Shortcodes should not output data directly.
			ob_start();

			// Status message.
			$status = filter_input( INPUT_GET, 'status', FILTER_VALIDATE_INT );

			printf(
				'<div class="wp-simple-form message success"><p>%s</p></div> <div class="main-container"><div class="check-container">
		<div class="check-background">
			<svg viewBox="0 0 65 51" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M7 25L27.3077 44L58.5 7" stroke="white" stroke-width="13" stroke-linecap="round" stroke-linejoin="round" />
			</svg>
		</div>
		<div class="check-shadow"></div>
	</div>
</div>',
				__( 'Submitted successfully!', 'wp-simple-form' )
			);

			// Build the form.
			$form->build_form();

			// Return and clean buffer contents.
			return ob_get_clean();
		}

		/**
		 * Handles the form submissions.
		 */
		public function form_handler() {
			$post = wp_unslash( $_POST );

			// A default response holder, which will have data for sending back to our js file.
			$response = array(
				'error' => false,
			);

			// Verify nonce.
			if ( ! isset( $post['data']['wp_nonce'] ) || ! wp_verify_nonce( $post['data']['wp_nonce'], 'submit-simple-form' ) ) {
				wp_die( __( 'No dirty tricks! ;-)', 'wp-simple-form' ) );
			}

			// Verify required fields.
			$required_fields = array( 'name', 'phone_number', 'email', 'budget', 'message' );

			foreach ( $required_fields as $field ) {
				if ( empty( $post['data'][ $field ] ) ) {
					wp_die( __( 'Name, phone-number, email, budget and message fields are required.', 'wp-simple-form' ) );
				}
			}

			// Build post arguments.
			$postarr = array(
				'post_author'  => 1,
				'post_title'   => sanitize_text_field( $post['data']['name'] ),
				'post_content' => sanitize_textarea_field( $post['data']['message'] ),
				'post_type'    => 'customer',
				'post_status'  => 'private',
				'meta_input'   => array(
					'simple_form_email'        => sanitize_email( $post['data']['email'] ),
					'simple_form_phone_number' => sanitize_text_field( $post['data']['phone_number'] ),
					'simple_form_budget'       => sanitize_text_field( $post['data']['budget'] ),
					'simple_form_date_time'    => sanitize_text_field( $post['data']['date_time'] ),
				),
			);

			// Insert the post.
			$postid = wp_insert_post( $postarr, true );

			if ( is_wp_error( $postid ) ) {
				wp_die( __( 'There was problem with your submission. Please try again.', 'wp-simple-form' ) );
			} else {
				$success = "<div class='wp-simpleform message success'><p>%s</p></div>', __( 'Submitted successfully!', 'wp-simple-form' )";
				wp_die( $success );
			}

		}
	}
}

new WpSimpleForm();
