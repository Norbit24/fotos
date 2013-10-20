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
		add_filter('body_class',array($this,'body_class'));
		add_filter('wp_head',array($this,'font_head'));
	}

	// Custom Fonts Init
	function font_head(){

		// Widget Titles
		if(pl_setting('ba_fotos_widget_font'))
			echo load_custom_font( pl_setting('ba_fotos_widget_font'),'.widgettitle');
	}

	// Conditional Body Classes
	function body_class($classes){

		if(pl_setting('ba_fotos_content_shadow'))
			$classes[] = 'fotos-content-shadow';
		if(pl_setting('ba_fotos_post_header_bg_img'))
			$classes[] = 'fotos-postheader-hasbg';
		if(pl_setting('ba_fotos_post_social_txt_color'))
			$classes[] = 'fotos-postsocial-hascolor';
		else
			$classes[] = '';

		return $classes;
	}

	// Custom LESS Vars
	function fotos_less($less){

		$less['fotos-header-bg-color']   = pl_setting('ba_fotos_post_header_bg_color') ? pl_hashify(pl_setting('ba_fotos_post_header_bg_color')) : '@pl-base';
		$less['fotos-post-title'] 		 = pl_setting('ba_fotos_post_title_color') ? pl_hashify(pl_setting('ba_fotos_post_title_color')) : '@pl-text';
		$less['fotos-post-meta'] 		 = pl_setting('ba_fotos_post_meta_color') ? pl_hashify(pl_setting('ba_fotos_post_meta_color')) : '@pl-text';
		$less['fotos-post-date'] 		 = pl_setting('ba_fotos_post_date_color') ? pl_hashify(pl_setting('ba_fotos_post_date_color')) : '@pl-text';
		$less['fotos-post-social-txt'] 	 = pl_setting('ba_fotos_post_social_txt_color') ? pl_hashify(pl_setting('ba_fotos_post_social_txt_color')) : '@pl-text';
		$less['fotos-post-comm-bg'] 	 = pl_setting('ba_fotos_post_comm_bg') ? pl_hashify(pl_setting('ba_fotos_post_comm_bg')) : '@pl-base';
		$less['fotos-post-comm-bg-dr'] 	 = pl_setting('ba_fotos_post_comm_drawer_bg') ? pl_hashify(pl_setting('ba_fotos_post_comm_drawer_bg')) : '@pl-base';
		$less['fotos-post-comm-txt'] 	 = pl_setting('ba_fotos_post_comm_txt') ? pl_hashify(pl_setting('ba_fotos_post_comm_txt')) : '@pl-text';

		$less['fotos-box-shadow-color']  = pl_setting('ba_fotos_box_shadow_color') ? pl_hashify(pl_setting('ba_fotos_box_shadow_color')) : '#111';

		return $less;
	}

	// Load Skins Row
	function skins_screen(){
		ob_start();

		$skins = $this->skins_array();

		?>

		<div class="fotos-admin-skins row">
			<div class="span9">
				<ul class="fotos-admin-skins-list fix">
					<?php
						foreach($skins as $skin):

							$name 	= $skin['name'];
							$img 	= $skin['img'];
							$desc 	= $skin['desc'];
							$demo 	= $skin['demo'];
							$dl 	= $skin['download'];

							?><li>
								<img class="fotos-admin-skins-img" src="<?php echo $img;?>">
								<p class="fotos-admin-skins-name"><?php echo $name;?><a class="fotos-admin-skins-linkout" href="<?php echo $demo;?>"><i class="icon-globe"></i> Demo</a></p>
								<p class="fotos-admin-skins-desc"><?php echo $desc;?></p>
							</li><?php

						endforeach;
					?>
				</ul>
			</div>
			<div class="span3">
				<p class="zmt"><strong>How to install Fotos skins</strong></p>
				<ul class="fotos-install-step-list">
					<li><span>1</span> click Settings-->Import/Export</li>
					<li><span>2</span> click the green button that reads <em>Select config file</em></li>
					<li><span>3</span> navigate to your theme folder, and into your skins directory</li>
					<li><span>4</span> select a skin and import</li>
				</ul>
			</div>
		</div>

		<?php
		return ob_get_clean();


	}

	// Skins Array
	function skins_array(){

		$skins_array = array(
			array(
				'name'		=> 'Dapper',
				'img'		=> PL_CHILD_URL.'/assets/admin/dapper-thumb.png',
				'desc'		=> 'An awesome skin yo',
				'demo'		=> 'http://dapper.fotostheme.com',
				'download'	=> '#importexport'
			),
			array(
				'name'		=> 'Another',
				'img'		=> 'http://placehold.it/247x185',
				'desc'		=> 'An awesome skin yo',
				'demo'		=> 'http://google.com',
				'download'	=> 'http://here.com'
			),
			array(
				'name'		=> 'A third',
				'img'		=> 'http://placehold.it/247x185',
				'desc'		=> 'An awesome skin yo',
				'demo'		=> 'http://google.com',
				'download'	=> 'http://here.com'
			)
		);

		return $skins_array;
	}

	// Global Theme Options
	function theme_options(){

		$options = array();

		$options[] = array(
			'pos'            					=> 20,
			'key'								=> 'fotos_skins_setup',
		   	'name'           					=> __('Fotos - Skins','fotos'),
		   	'icon'           					=> 'icon-bullseye',
	        'type'      						=> 'multi',
	        'opts'          					=> array(
	        	array(
	        		'key' 						=> 'fotos_theme_skins',
	        		'type' 						=> 'template',
	        		'template'					=> $this->skins_screen(),
	        		'title' 					=> 'Available Skins',
		        ),
	        ),
	       	'help'         						=> 'Choose a skin for your site.'
	    );

		$options[] = array(
		   	'name'           					=> __('Fotos - Nav Options','fotos'),
		   	'icon'           					=> 'icon-bullseye',
			'type' 								=> 'multi',
	        'pos'   							=> 21,
	        'opts'  							=> array(
	        	array(
					'title'   					=> __('Site Logo', 'fotos'),
				    'type'    					=> 'image_upload',
				    'key'						=> 'ba_fotos_global_logo',
					'help' 						=> __('This shows when you use the logo box, and in some nav sections.' , 'fotos'),
				),
	        	array(
	            	'title' 					=> __('Navigation Design', 'fotos'),
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
	            		array(
	            			'key'				=> 'ba_fotos_nav_minimal',
	            			'title'				=> __('Minimal Nav Style', 'fotos'),
	            			'type'				=> 'check',
	            			'help'				=> __('By default the navigation has a background color and active page colors. Toggling this will remove most of the colors (except the dropdowns).', 'fotos')
	            		),
	            		array(
	            			'key'				=> 'ba_fotos_nav_bg_img',
	            			'title'				=> __('Background Pattern (optional)', 'fotos'),
	            			'type'				=> 'image_upload',
	            			'help'				=> __('Upload a pattern or texture to use on the nav.', 'fotos')
	            		)
	            	)
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
	            		)
	            	)
	            ),
	        	array(
	            	'title' 					=> __('Nav Placement Options', 'fotos'),
	            	'key'						=> 'ba_fotos_nav_options',
	            	'type'						=> 'multi',
	            	'opts'						=> array(
	            		array(
	            			'key'				=> 'ba_fotos_nav_margin',
	            			'title'				=> __('Navigation Margin', 'fotos'),
	            			'type'				=> 'text',
	            			'help'				=> __('Optionally set a margin for the nav. Enter using css shorthand like <em>20px 10px 5px 10px</em>.', 'fotos')
	            		)
	            	)
	            )
	        )
		);

		$options[] = array(
		   	'name'           					=> __('Fotos - Post Header','fotos'),
		   	'icon'           					=> 'icon-bullseye',
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
					'key'						=> 'ba_fotos_post_date_margin',
					'type'						=> 'text',
					'title'						=> 'Post Date Margin Top',
					'help'						=> __('Acceptable values include 20px or 20%.','fotos')
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
				),
				array(
					'title'                   	=> __( 'Post Header Border', 'fotos' ),
					'type'	                  	=> 'check',
					'key' 						=> 'ba_fotos_post_header_border',
					'help'						=> __('Add a border below the post title and date.', 'fotos')
				)
	        )
		);

		$options[] = array(
		   	'name'           					=> __('Fotos - Post Content','fotos'),
		   	'icon'           					=> 'icon-bullseye',
			'type' 								=> 'multi',
	        'pos'   							=> 23,
	        'opts'  							=> array(
				array(
					'title'                   	=> __( 'Content Shadow', 'fotos' ),
					'type'	                  	=> 'check',
					'key' 						=> 'ba_fotos_content_shadow',
					'help'						=> __('Add a shadow to the boxed wrap area.','fotos'),
				),
				array(
					'title'						=> __('Article Separator', 'fotos'),
					'type'						=> 'textarea',
					'key'						=> 'ba_fotos_art_sep',
					'help'						=> __('Whatever you put here will be placed in between the articles on the home page of the posts. You can enter HTML here as well.', 'fotos')
				)
	        )
		);
		
		$options[] = array(
		   	'name'           					=> __('Fotos - Post Comments','fotos'),
		   	'icon'           					=> 'icon-bullseye',
			'type' 								=> 'multi',
	        'pos'   							=> 24,
	        'opts'  							=> array(
	        	array(
					'title'                   	=> __( 'Comments Text', 'fotos' ),
					'type'	                  	=> 'text',
					'key' 						=> 'ba_fotos_post_comm_custom_txt',
					'help'						=> __('By default this reads "Comment" but you can change this here. Fotos will automatically apply the plural version for you.','fotos'),
				),
				array(
					'title'                   	=> __( 'Show Comments Text', 'fotos' ),
					'type'	                  	=> 'text',
					'key' 						=> 'ba_fotos_post_comment_text',
					'help'						=> __('By default this reads "Show Comments" but you can change this here.','fotos'),
				),
				array(
					'title'                   	=> __( 'No Comments Found Text', 'fotos' ),
					'type'	                  	=> 'text',
					'key' 						=> 'ba_fotos_post_no_comment_text',
					'help'						=> __('By default this reads "No comments found." but you can change this here.','fotos'),
				),
	        )
		);

		$options[] = array(
			'pos'            					=> 25,
		   	'name'           					=> __('Fotos - Post Social','fotos'),
		   	'icon'           					=> 'icon-bullseye',
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
				    	'text' 					=> array('name' => __('Plain Text','fotos'))
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
					'help'						=> __('This will be placed between the social sharing links.', 'fotos')
				),
				array(
					'title'						=> __('Social Sharing Text', 'fotos'),
					'type'						=> 'text',
					'key'						=> 'ba_fotos_social_share_txt',
					'help'						=> __('Use this option to add some text before the sharing icons. Maybe something like "share this post" would be fitting ya? You can also use an image instead. Check out the next option over!', 'fotos')
				),
				array(
					'title'						=> __('Social Sharing Image (instead of text)', 'fotos'),
					'type'						=> 'image_upload',
					'key'						=> 'ba_fotos_social_share_img',
					'help'						=> __('Upload an image to use <strong>in place</strong> of the text that reads "Share Post."', 'fotos')
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
			'pos'            					=> 26,
		   	'name'           					=> __('Fotos - Contact Form','fotos'),
		   	'icon'           					=> 'icon-bullseye',
			'type' 								=> 'multi',
			'opts' 								=> array(
				array(
					'key' 						=> 'ba_fotos_contact_email',
					'type'						=> 'text',
					'label'						=> __( 'Default email send address', 'fotos' ),
					'help'						=> __( 'Email address to send for To. Leave blank to use admin email', 'fotos' )
				),
				array(
					'key' 						=> 'ba_fotos_contact_enable_extra',
					'type'						=> 'check',
					'default'					=> false,
					'label'						=> __( 'Enable extra custom field', 'fotos' )
				),
				array(
					'key' 						=> 'ba_fotos_contact_extra_field',
					'type'						=> 'text',
					'default'					=> '',
					'label'						=> __( 'Extra field text', 'fotos' )
				),
				array(
					'key' 						=> 'ba_fotos_contact_enable_captcha',
					'type'						=> 'check',
					'default'					=> true,
					'label'						=> __( 'Enable simple antispam question', 'fotos' )
				),
				array(
					'key' 						=> 'ba_fotos_contact_captcha_question',
					'type'						=> 'text',
					'default'					=> '2 + 5',
					'label'						=> __( 'Antispam question', 'fotos' )
				),
				array(
					'key' 						=> 'ba_fotos_contact_captcha_answer',
					'type'						=> 'text',
					'default'					=> '7',
					'label'						=> __( 'Antispam answer', 'fotos' )
				),
				array(
					'key' 						=> 'ba_fotos_contact_email_layout',
					'type'						=> 'text',
					'label'						=> __( 'Format for email subject. Possible values: %name% %blog%<br />Defaults: [%blog%] New message from %name%.', 'fotos' ), 
				)
			)
		);

		$options[] = array(
			'pos'            					=> 27,
		   	'name'           					=> __('Fotos - Design','fotos'),
		   	'icon'           					=> 'icon-bullseye',
			'type' 								=> 'multi',
			'opts' 								=> array(
				array(
					'title'   					=> __('Post Title', 'fotos'),
				    'type'    					=> 'color',
				    'default'					=> '#333',
				    'key'						=> 'ba_fotos_post_title_color',
					'help' 						=> __('This controls the color for the post title. By default, it uses the same color you have set under Global Options-->Color & Style' , 'fotos'),
				),
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
				    'default'					=> '#333',
				    'key'						=> 'ba_fotos_post_date_color',
					'help' 						=> __('Optionally change the color of the post date. By default it will match the color you have chosen under Global Options-->Color & Style.' , 'fotos'),
				),
				array(
					'title'   					=> __('Post Header Background', 'fotos'),
				    'type'    					=> 'color',
				    'default'					=> '#FFF',
				    'key'						=> 'ba_fotos_post_header_bg_color',
					'help' 						=> __('Controls the background color of the post header.' , 'fotos'),
				),
				array(
					'title'   					=> __('Post Header Background Image', 'fotos'),
				    'type'    					=> 'image_upload',
				    'key'						=> 'ba_fotos_post_header_bg_img',
					'help' 						=> __('Use a background image for the post header, instead of teh color above.' , 'fotos'),
				),
				array(
					'title'   					=> __('Post Social Text', 'fotos'),
				    'type'    					=> 'color',
				    'default'					=> '#333',
				    'key'						=> 'ba_fotos_post_social_txt_color',
					'help' 						=> __('Applies color to the social text or icons. Does not apply if you are using images in place of icons or text for social sharing.' , 'fotos'),
				),
				array(
					'title'   					=> __('Post Comments Bar', 'fotos'),
				    'type'    					=> 'color',
				    'default'					=> '#fff',
				    'key'						=> 'ba_fotos_post_comm_bg',
					'help' 						=> __('Optionally set a background color for the post comments bar. By default it will take whatever Base color you have chosen under Global Options-->Color & Style.' , 'fotos'),
				),
				array(
					'title'   					=> __('Post Comments Drawer', 'fotos'),
				    'type'    					=> 'color',
				    'default'					=> '#fff',
				    'key'						=> 'ba_fotos_post_comm_drawer_bg',
					'help' 						=> __('Optionally set a background color for the post comments drawer. By default it will take whatever Base color you have chosen under Global Options-->Color & Style.' , 'fotos'),
				),
				array(
					'title'   					=> __('Post Comments Text', 'fotos'),
				    'type'    					=> 'color',
				    'default'					=> '#333',
				    'key'						=> 'ba_fotos_post_comm_txt',
					'help' 						=> __('Optionally change the color of the text for teh post comments. By default it will match the color you have chosen under Global Options-->Color & Style.' , 'fotos'),
				),
				array(
					'title'   					=> __('Content Shadow Color', 'fotos'),
				    'type'    					=> 'color',
				    'default'					=> '#111',
				    'key'						=> 'ba_fotos_box_shadow_color',
					'help' 						=> __('Optionally change the color of the box shadow around the main content column. This only takes effect if you have the option checked under Fotos-->Post Content.' , 'fotos'),
				),
			),
			'help' => ''
		);
		$options[] = array(
			'pos'            					=> 28,
		   	'name'           					=> __('Fotos - Typography','fotos'),
		   	'icon'           					=> 'icon-bullseye',
			'type' 								=> 'multi',
			'opts' 								=> array(
				array(
					'title'   					=> __('Widget Headings', 'fotos'),
				    'type'    					=> 'fonts',
				    'default'					=> 'open_sans',
				    'key'						=> 'ba_fotos_widget_font',
					'help' 						=> __('This controls the font family for Widget headings.' , 'fotos'),
				)
			),
			'help' => ''
		);
		pl_add_theme_tab($options);
	}
}
new fotosGlobalOptions;














