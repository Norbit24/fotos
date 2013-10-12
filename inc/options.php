<?php
/**
 	* Global Options
 	*
 	* @package     Fotos Theme
 	* @subpackage  Functions
 	* @copyright   Copyright (c) 2013, Nick Haskins & CO
 	* @since       1.0
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class fotosGlobalOptions {

	function __construct(){

		$this->theme_options();

		add_filter('pless_vars',array($this,'fotos_less'));
	}

	function fotos_less($less){

		$less['fotos-post-meta'] 		= pl_setting('ba_fotos_post_meta_color') ? pl_hashify(pl_setting('ba_fotos_post_meta_color')) : '@pl-text';
		$less['fotos-post-date'] 		= pl_setting('ba_fotos_post_date_color') ? pl_hashify(pl_setting('ba_fotos_post_date_color')) : '@pl-text';
		$less['fotos-post-comm-bg'] 	= pl_setting('ba_fotos_post_comm_bg') ? pl_hashify(pl_setting('ba_fotos_post_comm_bg')) : '@pl-base';
		$less['fotos-post-comm-txt'] 	= pl_setting('ba_fotos_post_comm_txt') ? pl_hashify(pl_setting('ba_fotos_post_comm_txt')) : '@pl-text';

		return $less;
	}

	function theme_options(){

		$options = array();

		$options[] = array(
			'pos'            					=> 20,
			'key'								=> 'fotos_skins_setup',
		   	'name'           					=> __('Fotos - Skins','fotos'),
		   	'icon'           					=> 'icon-circle',
	        'type'      						=> 'multi',
	        'opts'          					=> array(
	        	array(
	        		'key' 						=> 'fotos_theme_skins',
	        		'type' 						=> 'template',
	        		'template'					=> 'coming soon!',
	        		'title' 					=> 'Available Skins',
		        ),
	        ),
	       	'help'         						=> 'Choose a skin for your site.'
	    );

		$options[] = array(
		   	'name'           					=> __('Fotos - Nav Options','fotos'),
		   	'icon'           					=> 'icon-circle',
			'type' 								=> 'multi',
	        'pos'   							=> 21,
	        'opts'  							=> array(
	        	array(
	            	'title' 					=> __('Navigation Options', 'fotos'),
	            	'key'						=> 'ba_fotos_nav_colors',
	            	'type'						=> 'multi',
	            	'opts'						=> array(
	            		array(
	            			'key'				=> 'ba_fotos_nav_font_color',
	            			'title'				=> __('Font Color', 'fotos'),
	            			'type'				=> 'color',
	            			'default'			=> '#F8F8F8',
	            			'help'				=> __('Set a font color.', 'fotos')
	            		),
	            		array(
	            			'key'				=> 'ba_fotos_nav_base_color',
	            			'title'				=> __('Base Color', 'fotos'),
	            			'type'				=> 'color',
	            			'default'			=> '#333',
	            			'help'				=> __('Set a base color.', 'fotos')
	            		),
	            	),
	            ),
	        	array(
	            	'title' 					=> __('Nav Font Options', 'fotos'),
	            	'key'						=> 'ba_fotos_nav_options',
	            	'type'						=> 'multi',
	            	'opts'						=> array(
	            		array(
	            			'key'				=> 'ba_fotos_nav_font_size',
	            			'title'				=> __('Font Size', 'fotos'),
	            			'type'				=> 'text',
	            			'help'				=> __('Set a font size.', 'fotos')
	            		),
	            		array(
	            			'key'				=> 'ba_fotos_nav_font_family',
	            			'title'				=> __('Font Family', 'fotos'),
	            			'default'			=> 'open_sans',
	            			'type'				=> 'type',
	            			'help'				=> __('Set a base color.', 'fotos')
	            		),
	            	),
	            ),
	        )
		);

		$options[] = array(
		   	'name'           					=> __('Fotos - Post Header','fotos'),
		   	'icon'           					=> 'icon-circle',
			'type' 								=> 'multi',
	        'pos'   							=> 22,
	        'opts'  							=> array(
				array(
					'title'                   	=> __( 'Post Header Layout', 'fotos' ),
					'type'	                  	=> 'select',
					'key' 						=> 'ba_fotos_post_header_layout',
					'default'					=> 'title-left',
					'opts'						=> array(
						'title-left' 			=> array('name' => __( 'Title Left - Date Right', 'fotos' ) ),
						'title-right'			=> array('name' => __( 'Date Left - Title Right', 'fotos' ) ),
						'title-center'			=> array('name' => __( 'Title & Date Centered', 'fotos' ) ),
					),
				),
				array(
					'key'			  			=> 'ba_fotos_post_title_col',
					'type' 			  			=> 'count_select',
					'count_start'	  			=> 1,
					'count_number'	  			=> 99,
					'default'		  			=> 85,
					'suffix'					=> '%',
					'label' 	      			=> __( 'Post Title Width', 'fotos' ),
					'help'			  			=> __('How wide should the title column be?', 'fotos')
				),
				array(
					'key'						=> 'ba_fotos_post_title_align',
					'type'						=> 'select',
					'default'					=> 'align-left',
					'title'						=> 'Post Title Alignment',
					'opts'						=> array(
						'align-left' 			=> array('name' => __( 'Align Left', 'fotos' ) ),
						'align-right'			=> array('name' => __( 'Align Right', 'fotos' ) ),
						'center'				=> array('name' => __( 'Centered', 'fotos' ) ),
					),
				),
				array(
					'key'			  			=> 'ba_fotos_post_date_col',
					'type' 			  			=> 'count_select',
					'count_start'	  			=> 1,
					'count_number'	  			=> 99,
					'default'		  			=> 15,
					'suffix'					=> '%',
					'label' 	      			=> __( 'Post Date Width', 'fotos' ),
					'help'			  			=> __('How wide should the date column be?', 'fotos')
				),
				array(
					'key'						=> 'ba_fotos_post_date_align',
					'type'						=> 'select',
					'default'					=> '',
					'title'						=> 'Post Date Alignment',
					'opts'						=> array(
						'pull-left' 			=> array('name' => __( 'Align Left', 'fotos' ) ),
						'pull-right'			=> array('name' => __( 'Align Right', 'fotos' ) ),
						'center'				=> array('name' => __( 'Centered', 'fotos' ) ),
					),
				),
				array(
					'title'                   	=> __( 'Post Date Format', 'fotos' ),
					'type'	                  	=> 'select',
					'key' 						=> 'ba_fotos_post_date_style',
					'default'					=> 'fotos-date-default',
					'opts'						=> array(
						'fotos-date-default' 	=> array('name' => __( 'Full Date', 'fotos' ) ),
						'fotos-date-block'		=> array('name' => __( 'Block Style Date', 'fotos' ) ),
						'fotos-date-stacked'	=> array('name' => __( 'Stacked', 'fotos' ) ),
						'fotos-date-minimal'	=> array('name' => __( 'Minimal Style Date', 'fotos' ) ),
					),
				),
				array(
					'title'                   	=> __( 'Post Categories Text', 'fotos' ),
					'type'	                  	=> 'text',
					'key' 						=> 'ba_fotos_post_cat_text',
					'help'						=> __('Here you can replace the text underneath the post title. By default it says <em>Filed under</em>, but you can change that here.', 'fotos')
				),
				array(
					'title'                   	=> __( 'Post Tags Text', 'fotos' ),
					'type'	                  	=> 'text',
					'key' 						=> 'ba_fotos_post_tag_text',
					'help'						=> __('Here you can replace the text underneath the post title. By default it says <em>Tagged with</em>, but you can change that here.', 'fotos')
				)
	        )
		);

		$options[] = array(
		   	'name'           					=> __('Fotos - Post Content','fotos'),
		   	'icon'           					=> 'icon-circle',
			'type' 								=> 'multi',
	        'pos'   							=> 23,
	        'opts'  							=> array(
				array(
					'title'                   	=> __( 'Post Content Columns', 'fotos' ),
					'type'	                  	=> 'check',
					'key' 						=> 'ba_fotos_',
					'help'						=> __('Toggling this will split your post content into magazine style columns.','fotos'),
				),
	        )
		);
		
		$options[] = array(
			'pos'            					=> 24,
		   	'name'           					=> __('Fotos - Post Social','fotos'),
		   	'icon'           					=> 'icon-circle',
			'type' 								=> 'multi',
			'opts' 								=> array(
				array(
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
					'title'						=> __('Separator Images (optional)', 'fotos'),
					'type'						=> 'image_upload',
					'key'						=> 'ba_fotos_social_separator',
				),
				array(
					'title'						=> __('Custom Social Images', 'fotos'),
					'type'						=> 'multi',
					'key'						=> 'ba_fotos_custom_social',
					'opts'						=> array(
						array(
							'type' 				=> 'image_upload',
							'key'				=> 'ba_fotos_twitter_img',
							'title'				=> 'Custom Twitter Button'
						),
						array(
							'type' 				=> 'image_upload',
							'key'				=> 'ba_fotos_fb_img',
							'title'				=> 'Custom Facebook Button'
						),
						array(
							'type' 				=> 'image_upload',
							'key'				=> 'ba_fotos_pinterest_img',
							'title'				=> 'Custom Pinterest Button'
						),
					)

				)
			),
			'help' => ''
		);

		$options[] = array(
			'pos'            					=> 25,
		   	'name'           					=> __('Fotos - Colors','fotos'),
		   	'icon'           					=> 'icon-circle',
			'type' 								=> 'multi',
			'opts' 								=> array(
				array(
					'title'   					=> __('Post Meta', 'fotos'),
				    'type'    					=> 'color',
				    'default'					=> '#777',
				    'key'						=> 'ba_fotos_post_meta_color',
					'help' 						=> __('This is the text that shows what categories the post is in.' , 'fotos'),
				),
				array(
					'title'   					=> __('Post Date', 'fotos'),
				    'type'    					=> 'color',
				    'default'					=> '#777',
				    'key'						=> 'ba_fotos_post_date_color',
					'help' 						=> __('Optionally change the color of the post date. By default it will match the color you have chosen under Global Options-->Color & Style.' , 'fotos'),
				),
				array(
					'title'   					=> __('Post Comments Background', 'fotos'),
				    'type'    					=> 'color',
				    'default'					=> '#fff',
				    'key'						=> 'ba_fotos_post_comm_bg',
					'help' 						=> __('Optionally set a background color for the post comments. By default it will take whatever color you have chosen under Global Options-->Color & Style.' , 'fotos'),
				),
				array(
					'title'   					=> __('Post Comments Text', 'fotos'),
				    'type'    					=> 'color',
				    'default'					=> '#333',
				    'key'						=> 'ba_fotos_post_comm_txt',
					'help' 						=> __('Optionally change the color of the text for teh post comments. By default it will match the color you have chosen under Global Options-->Color & Style.' , 'fotos'),
				),
			),
			'help' => ''
		);

		pl_add_theme_tab($options);
	}
}
new fotosGlobalOptions;














