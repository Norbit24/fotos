<?php
/*
Section: Post Header
Author: Nick Haskins
Author URI: http://nickhaskins.co
Version: 1.0
Description: Displays the title and date of the post.
Class Name: fotosPostTitle
Loading: active
*/

class fotosPostTitle extends PageLinesSection {


 	function section_template() {

 		$ltwidth 	= $this->opt('ba_fotos_post_title_col') ? $this->opt('ba_fotos_post_title_col') : 8;
 		$rtwidth 	= $this->opt('ba_fotos_post_date_col') ? $this->opt('ba_fotos_post_date_col') : 4;
 		$align 		= $this->opt('ba_fotos_post_header_layout') ? $this->opt('ba_fotos_post_header_layout') : 'title-left';
 		$title      = (is_home()) ? sprintf('<h2 class="fotos-entry-title"><a href="%s">%s</a></h2>',get_permalink(),get_the_title()) : sprintf('<h2 class="fotos-entry-title">%s</h2>',get_the_title());

 		$meta		= sprintf('<span class="fotos-entry-cats">%s</span>',do_shortcode('[post_categories]'));

 		$left 		= sprintf('<div class="span%s fotos-entry-title-wrap">%s</div>',$ltwidth,$title);
 		$right 		= sprintf('<div class="span%s fotos-entry-meta-wrap"><span class="fotos-entry-date">%s</span>%s</div>',$rtwidth,get_the_date(),$meta);

 		printf('<div class="row fotos-post-header fotos-post-%s">%s%s</div>',$align,$left,$right);

	}


	function section_opts( ){

		$options = array(
			array(
				'title'                   	=> __( 'Post Header Layout', 'fotos' ),
				'type'	                  	=> 'select',
				'key' 						=> 'ba_fotos_post_header_layout',
				'default'					=> 'title-left',
				'col'						=> 4,
				'opts'						=> array(
					'title-left' 			=> array('name' => __( 'Title Left - Date Right', 'fotos' ) ),
					'title-right'			=> array('name' => __( 'Date Left - Title Right', 'fotos' ) ),
					'title-center'			=> array('name' => __( 'Title & Date Centered', 'fotos' ) ),
				),
			),
			array(
				'title'                   => __( 'Post Header Column Widths', 'fotos' ),
				'type'	                  => 'multi',
				'col'						=> 8,
				'opts'	                  => array(
					array(
						'key'			  => 'ba_fotos_post_title_col',
						'type' 			  => 'count_select',
						'count_start'	  => 1,
						'count_number'	  => 11,
						'default'		  => 9,
						'label' 	      => __( 'Title Column Span', 'fotos' ),
						'help'			  => __('How wide the title column shoudl be based on a 12-column grid.', 'fotos')
					),
					array(
						'key'			  => 'ba_fotos_post_date_col',
						'type' 			  => 'count_select',
						'count_start'	  => 1,
						'count_number'	  => 11,
						'default'		  => 3,
						'label' 	      => __( 'Date Column Span', 'fotos' ),
						'help'			  => __('How wide the date column should be based on a 12-column grid.', 'fotos')
					),
				)

			),
		);

		return $options;

	}

}