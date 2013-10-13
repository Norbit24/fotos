<?php
/*
Section: Bio Box
Author: Nick Haskins
Author URI: http://nickhaskins.co
Version: 1.0
Description: Displays a bio image, bio text, and configurable social links.
Class Name: fotosBioBox
Loading: active
Filter: component
*/

class fotosBioBox extends PageLinesSection {


 	function section_template() {

 		$ltwidth 	= $this->opt('ba_fotos_bio_txt_col') ? $this->opt('ba_fotos_bio_txt_col') : 8;
 		$rtwidth 	= $this->opt('ba_fotos_bio_img_col') ? $this->opt('ba_fotos_bio_img_col') : 4;
 		$align 		= $this->opt('ba_fotos_bio_layout') ? $this->opt('ba_fotos_bio_layout') : 'title-left';

 		$text 		= $this->opt('ba_fotos_bio_text') ? $this->opt('ba_fotos_bio_text') : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse dignissim augue risus, a euismod lacus laoreet sed. Morbi volutpat sapien at metus tempus euismod ultricies eget leo. Suspendisse iaculis augue in euismod mattis. Donec id gravida mauris, et consectetur augue.';
 		$img		= $this->opt('ba_fotos_bio_image') ? $this->opt('ba_fotos_bio_image') : PL_CHILD_URL.'/assets/img/fotos-default-dark.png';

 		$left 		= sprintf('<div class="span%s fotos-bio-txt-wrap">%s%s</div>',$ltwidth,$text,$this->links());
 		$right 		= sprintf('<div class="span%s fotos-bio-img-wrap"><img data-sync="ba_fotos_bio_image" class="fotos-bio-img" alt="" src="%s"></div>',$rtwidth,$img);

 		printf('<div class="row fotos-bio-box fotos-bio-box-%s">%s%s</div>',$align,$left,$right);
	}

	function links(){

		$output = '';
		$count = 1;
		$icon_array = $this->opt('ba_fotos_bio_link_array');

		if( is_array($icon_array) ){

			$icons = count($icon_array);

			foreach( $icon_array as $icon ){

				$link 		=  pl_array_get('link', $icon);
				$icon 		=  pl_array_get('icon', $icon);
				$output 	.= sprintf('<a href="%s"><i class="icon-%s icon-fotos icon-fotos-default"></i></a>',$link,$icon);
				$count++;
			}

		}

		ob_start();
			printf('<ul class="unstyled fotos-bio-link-list">%s</ul>',$output);
		return ob_get_clean();

	}

	function section_opts( ){

		$options = array();

		$options[] = array(
			'title'                   	=> __( 'Bio Text', 'fotos' ),
			'type'	                  	=> 'textarea',
			'key' 						=> 'ba_fotos_bio_text',
			'col'						=> 3,
		);

		$options[] = array(
			'title'                   	=> __( 'Bio Image', 'fotos' ),
			'type'	                  	=> 'image_upload',
			'key' 						=> 'ba_fotos_bio_image',
			'col'						=> 3,
		);

		$options[] = array(
			'key'			  	=> 'ba_fotos_bio_links_num',
			'type' 			  	=> 'count_select',
			'count_start'	  	=> 1,
			'count_number'	  	=> 10,
			'default'		  	=> 3,
			'label' 	      	=> __( 'Number of Social Links to Setup', 'fotos' ),
		);

		$options[] = array(
			'key'	=> 'ba_fotos_bio_link_array',
			'type'	=> 'accordion',
			'title'	=> 'Social Links Setup',
			'col'	=> 4,
			'opts' => array(
				array(
					'key'		=> 'link',
					'label'		=> __( 'Icon Link', 'fotos' ),
					'type'		=> 'text'
				),
				array(
					'key'		=> 'icon',
					'label'		=> __( 'Icon', 'fotos' ),
					'type'		=> 'select_icon'
				),
				array(
					'key'		=> 'img',
					'label'		=> __( 'Image (instead of icon)', 'fotos' ),
					'type'		=> 'image_upload'
				),
			),

		);

		$options[] = array(
			'title'                   	=> __( 'Bio Layout', 'fotos' ),
			'type'	                  	=> 'select',
			'key' 						=> 'ba_fotos_bio_layout',
			'default'					=> 'image-right',
			'col'						=> 4,
			'opts'						=> array(
				'image-right' 			=> array('name' => __( 'Text Left - Image Right', 'fotos' ) ),
				'image-left'			=> array('name' => __( 'Image Left - Text Right', 'fotos' ) ),
			),
		);

		$options[] = array(
			'title'                   => __( 'Bio Column Widths', 'fotos' ),
			'type'	                  => 'multi',
			'col'						=> 8,
			'opts'	                  => array(
				array(
					'key'			  => 'ba_fotos_bio_txt_col',
					'type' 			  => 'count_select',
					'count_start'	  => 1,
					'count_number'	  => 11,
					'default'		  => 8,
					'label' 	      => __( 'Text Column Span', 'fotos' ),
					'help'			  => __('How wide the title column shoudl be based on a 12-column grid.', 'fotos')
				),
				array(
					'key'			  => 'ba_fotos_bio_img_col',
					'type' 			  => 'count_select',
					'count_start'	  => 1,
					'count_number'	  => 11,
					'default'		  => 4,
					'label' 	      => __( 'Image Column Span', 'fotos' ),
					'help'			  => __('How wide the date column should be based on a 12-column grid.', 'fotos')
				),
			)

		);

		return $options;

	}

}





