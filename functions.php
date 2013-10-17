<?php

// Load Framework //
require_once( dirname(__FILE__) . '/setup.php' );

class baFotosTheme {

	const version = '1.0';

	function __construct() {

		// Constants
		$this->url = sprintf('%s', PL_CHILD_URL);
		$this->dir = sprintf('/%s', PL_CHILD_DIR);

		// Includes
		include('libs/custom-meta-boxes/custom-meta-boxes.php' );
		include('inc/contact.php');
		include('inc/unset.php');
		include('inc/support-tab.php');
		include('inc/meta.php');
		include('inc/options.php');
		include('inc/post.php');
		include('inc/partials.php');
		include('inc/gallery.php');
		include('inc/fotos-shortcodes.php');

		$this->init();

	}

	// Initialize
	function init() {

		// bypass posix check
		add_filter( 'render_css_posix_', '__return_true' );

		// Fotos Utilities
		add_action( 'wp_enqueue_scripts',array($this,'scripts'));

	}


	function scripts(){

		wp_register_script('fotos', PL_CHILD_URL.'/assets/js/fotos.js', array('jquery'), self::version, true);
		wp_enqueue_script('fotos');
	}

}

new baFotosTheme;