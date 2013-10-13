<?php
/**
 	* Contact Form Class
 	*
 	* @package     Fotos Theme
 	* @subpackage  Functions
 	* @copyright   Copyright (c) 2013, Nick Haskins & CO
 	* @since       1.0
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class fotosContact {

	var $version = 1.3;
	function __construct() {

		$this->base_dir	= plugin_dir_path( __FILE__ );
		$this->base_url = plugins_url( '', __FILE__ );
		$this->icon		= plugins_url( '/icon.png', __FILE__ );
		add_action( 'wp_enqueue_scripts', array( $this, 'hooks_with_activation' ) );
		add_action( 'wp_ajax_nopriv_ajaxcontact_send_mail', array( $this, 'ajaxcontact_send_mail' ) );
		add_action( 'wp_ajax_ajaxcontact_send_mail', array( $this, 'ajaxcontact_send_mail' ) );
	}


	function hooks_with_activation() {
		wp_enqueue_script( 'fotosmail', PL_CHILD_URL.'/assets/js/fotosmail.js', array( 'jquery' ), $this->version, true);
		wp_localize_script( 'fotosmail', 'fotosmail', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

		if( ! function_exists( 'pl_detect_ie' ) )
			return;
		$ie_ver = pl_detect_ie();
		if( $ie_ver < 10 )
			wp_enqueue_script( 'formalize', PL_CHILD_URL.'/assets/js/formalize.js', array( 'jquery' ), $this->version, true );
	}

	function form() {
		ob_start();
		$email		= __( 'Email Address', 'fotos' );
		$name		= __( 'Name', 'fotos' );
		$message	= __( 'Your Message...', 'fotos' );
		$send		= __( 'Send Message', 'fotos' );
	?>

		<div class="fotos-contact-response"></div>
		<form class="fotos-contact-form" id="ajaxcontactform" action="" method="post" enctype="multipart/form-data">
			<fieldset>
				<div class="control-group">
					<div class="controls form-inline">
						<?php
						printf( '<input class="fotos-contact-input fotos-contact-name" placeholder="%1$s" id="ajaxcontactname" type="text" name="%1$s">', $name );
						printf( '<input class="fotos-contact-input fotos-contact-email" placeholder="%1$s" id="ajaxcontactemail" type="text" name="%1$s">',$email );
						if ( pl_setting( 'ba_fotos_contact_enable_extra' ) && '' != pl_setting( 'ba_fotos_contact_extra_field' ) )
							printf( '<input class="fotos-contact-input fotos-contact-custom" placeholder="%1$s" id="ajaxcontactcustom" type="text" name="%1$s">', stripslashes( pl_setting( 'ba_fotos_contact_extra_field' ) ) );
						?>
					</div>
				</div>
			<div class="control-group">
				<div class="controls">
					<div class="textarea">
						<?php printf( '<textarea class="fotos-contact-msg" row="8" placeholder="%s" id="ajaxcontactcontents" name="%s"></textarea>', $message, $message ); ?>
					</div>
				</div>
			</div>

			<?php if ( pl_setting( 'ba_fotos_contact_enable_captcha' ) ) $this->captcha(); ?>

			<div class="controls">
				<?php printf( '<a class="btn btn-fotos btn-fotos-default send-fotos">%s</a>', $send ); ?>
			</div>
			</fieldset>
		</form>

		<?php
		$form = ob_get_clean();
		echo $form;
	}


	function captcha() {

		$code = sprintf( '<div class="control-group">
		<label class="control-label">Captcha</label>
		<div class="controls">
			<input class="span2 fotos-contact-captcha" placeholder="%s" id="ajaxcontactcaptcha" type="text" name="ajaxcontactcaptcha" />
		</div>
	</div>', stripslashes( pl_setting( 'ba_fotos_contact_captcha_question' ) ) );
	echo $code;
	}


	function ajaxcontact_send_mail(){

		$data = stripslashes_deep( $_POST );

		$defaults = array(
			'name'	=> '',
			'email'	=> '',
			'custom'=> '',
			'msg'	=> '',
			'cap'	=> '',
			'width'	=> '',
			'height'=> '',
			'agent' => ''
		);

		$data = wp_parse_args($data, $defaults);

		$name			= $data['name'];
		$email			= $data['email'];
		$custom			= $data['custom'];
		$custom_field	= ( pl_setting( 'ba_fotos_contact_enable_extra' ) ) ? pl_setting( 'ba_fotos_contact_extra_field' ) : '';
		$contents		= $data['msg'];
		$admin_email	= ( pl_setting( 'ba_fotos_contact_email' ) ) ? pl_setting( 'ba_fotos_contact_email' ) : get_option( 'admin_email' );
		$captcha		= $data['cap'];
		$captcha_ans	= pl_setting( 'ba_fotos_contact_captcha_answer' );
		$width			= $data['width'];
		$height			= $data['height'];
		$ip				= $_SERVER['REMOTE_ADDR'];
		$agent			= $data['agent'];

		if ( pl_setting( 'ba_fotos_contact_enable_captcha' ) ){
			if( '' == $captcha )
				die( __( 'Captcha cannot be empty!', 'fotos' ) );
			if( $captcha !== $captcha_ans )
				die( __( 'Captcha does not match.', 'fotos' ) );
		}

		if ( ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
			die( __( 'Email address is not valid.', 'fotos' ) );
		} elseif( strlen( $name ) == 0 ) {
			die( __( 'Name cannot be empty.', 'fotos' ) );
		} elseif( strlen( $contents ) == 0 ) {
			die( __( 'Content cannot be empty.', 'fotos' ) );
		}

		// create an email.
		$subject_template	= ( '' != pl_setting( 'ba_fotos_contact_email_layout' ) ) ? pl_setting( 'ba_fotos_contact_email_layout' ) : '[%blog%] New message from %name%.';
		$subject			= str_replace( '%blog%', get_bloginfo( 'name' ), str_replace( '%name%', $name, $subject_template ) );
		$custom 			= ( $custom_field ) ? sprintf( '%s: %s', $custom_field, $custom ) : '';
		$fields = 'Name: %s %7$sEmail: %s%7$sContents%7$s=======%7$s%s %7$s%7$sUser Info.%7$s=========%7$sIP: %s %7$sScreen Res: %s %7$sAgent: %s %7$s%7$s%8$s';

		$template = sprintf( $fields,
			$name,
			$email,
			$contents,
			$ip,
			sprintf( '%sx%s', $width, $height ),
			$agent,
			"\n",
			$custom
			);
			
		if( true === ( $result = wp_mail( $admin_email, $subject, $template ) ) )
			die( 'ok' );
		
		if ( ! $result ) {

			global $phpmailer;
		
			if( isset( $phpmailer->ErrorInfo ) ) {
				die( sprintf( 'Error: %s', $phpmailer->ErrorInfo ) );
			} else {
				die( __( 'Unknown wp_mail() error.', 'fotos' ) );
			}
		}		
	}
}
new fotosContact;
