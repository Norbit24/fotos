<?php

// Load Framework //
require_once( dirname(__FILE__) . '/setup.php' );

class baFotosTheme {

	const version = '1.0';


	function __construct() {

		// Constants
		$this->url = sprintf('%s', PL_CHILD_URL);
		$this->dir = sprintf('/%s', PL_CHILD_DIR);

		$this->init();

	}

	// Initialize
	function init() {

		// bypass posix check
		add_filter( 'render_css_posix_', '__return_true' );

		require_once( 'libs/custom-meta-boxes/custom-meta-boxes.php' );
		include('inc/unset.php');
		include('inc/meta.php');
		include('inc/partials.php');
		include('inc/gallery.php');
		include('inc/fotos-shortcodes.php');

		// Make DMS Pro
		add_action( 'wp_enqueue_scripts',array($this,'scripts' ));

		// Run Theme Options
		$this->theme_options();


	}

	function scripts(){

		wp_register_script('fotos', PL_CHILD_URL.'/assets/js/fotos.js', array('jquery'), self::version, true);

		wp_enqueue_script('fotos');
	}

	// Theme Options
	function theme_options(){

		$options = array();


		$options[] = array(
			'pos'            => 20,
		   	'name'           => __('Fotos Setup','fotos'),
		   	'icon'           => 'icon-rocket',
            'type'      	=> 'select',
            'opts'          => array(
            	array(
            		'key' => 'fw_theme_layout',
            		'type' => 'select',
            		'label' => 'Theme Layout',
            		'opts' => array(
		            	'fw-theme-default'    => array('name' => 'Default'),
		                'fw-theme-menuleft'   => array('name' => 'Side Menu'),
		                'fw-theme-fullwidth'  => array('name' => 'Full Width'),
		            ),
		        ),
            ),
           'help'         => ''
        );


        $options[] = array(
			'pos'            					=> 21,
		   	'name'           					=> __('Fotos - Blog Options','fotos'),
		   	'icon'           					=> 'icon-rocket',
			'type' 								=> 'multi',
			'opts' 								=> array(
				array(
					'col'						=> 8,
					'title'   					=> __('Social Links Mode', 'fotos'),
				    'type'    					=> 'select',
				    'key'						=> 'ba_fotos_social_mode',
				    'default'					=> 'icon',
				    'opts'						=> array(
				    	'icon' 					=> array('name' => __('Icons','fotos')),
				    	'image' 				=> array('name' => __('Custom Image','fotos')),
				    	'plain' 				=> array('name' => __('Plain Button','fotos')),
				    ),
					'help' 						=> __('' , 'fotos'),
				),
				array(
					'col'						=> 8,
					'title'   					=> __('Social Links Alignment', 'fotos'),
				    'type'    					=> 'select',
				    'key'						=> 'ba_fotos_social_align',
				    'opts'						=> array(
				    	'tal' 					=> array('name' => __('Align Left','fotos')),
				    	'center' 				=> array('name' => __('Centered','fotos')),
				    	'tar' 					=> array('name' => __('Align Right','fotos')),
				    ),
					'help' 						=> __('' , 'fotos'),
				),
				array(
					'col'		 	=> 4,
					'title'			=> __('Custom Social Images', 'fotos'),
					'type'			=> 'multi',
					'opts'			=> array(
						array(
							'type' => 'image_upload',
							'key'	=> 'ba_fotos_twitter_img',
							'title'	=> 'Custom Twitter Button'
						),
						array(
							'type' => 'image_upload',
							'key'	=> 'ba_fotos_fb_img',
							'title'	=> 'Custom Facebook Button'
						),
						array(
							'type' => 'image_upload',
							'key'	=> 'ba_fotos_pinterest_img',
							'title'	=> 'Custom Pinterest Button'
						),
					)

				),
				array(
					'col'		 	=> 8,
					'title'			=> __('Separator Images (optional)', 'fotos'),
					'type'			=> 'image_upload',
					'key'			=> 'ba_fotos_social_separator'

				),
				array(
					'title'                   	=> __( 'Date Format', 'fotos' ),
					'type'	                  	=> 'select',
					'key' 						=> 'ba_fotos_post_date_style',
					'default'					=> 'fotos-date-default',
					'col'						=> 4,
					'opts'						=> array(
						'fotos-date-default' 	=> array('name' => __( 'Full Date', 'fotos' ) ),
						'fotos-date-block'		=> array('name' => __( 'Block Style Date', 'fotos' ) ),
						'fotos-date-minimal'	=> array('name' => __( 'Minimal Style Date', 'fotos' ) ),
					),
				)
			),
			'help' => ''
		);


		$options[] = array(
		   	'name'           					=> __('Fotos - Nav Options','fotos'),
		   	'icon'           					=> 'icon-rocket',
			'type' 								=> 'multi',
            'pos'   					=> 22,
            'opts'  					=> array(
            	array(
	            	'title' 			=> __('Navigation Options', 'fotos'),
	            	'type'				=> 'multi',
	            	'col'				=> 4,
	            	'opts'				=> array(
	            		array(
	            			'key'		=> 'ba_fotos_nav_font_color',
	            			'title'		=> __('Font Color', 'fotos'),
	            			'type'		=> 'color',
	            			'default'	=> '#F8F8F8',
	            			'help'		=> __('Set a font color.', 'fotos')
	            		),
	            		array(
	            			'key'		=> 'ba_fotos_nav_base_color',
	            			'title'		=> __('Base Color', 'fotos'),
	            			'type'		=> 'color',
	            			'default'	=> '#333',
	            			'help'		=> __('Set a base color.', 'fotos')
	            		),
	            	),
	            ),
            	array(
	            	'title' 			=> __('Nav Font Options', 'fotos'),
	            	'type'				=> 'multi',
	            	'col'				=> 4,
	            	'opts'				=> array(
	            		array(
	            			'key'		=> 'ba_fotos_nav_font_size',
	            			'title'		=> __('Font Size', 'fotos'),
	            			'type'		=> 'text',
	            			'help'		=> __('Set a font size.', 'fotos')
	            		),
	            		array(
	            			'key'		=> 'ba_fotos_nav_font_family',
	            			'title'		=> __('Font Family', 'fotos'),
	            			'default'	=> 'open_sans',
	            			'type'		=> 'type',
	            			'help'		=> __('Set a base color.', 'fotos')
	            		),
	            	),
	            ),
            )
		);

		pl_add_theme_tab($options);
	}
}

new baFotosTheme;