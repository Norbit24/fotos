<?php
/*
Section: Blog Loop
Author: Nick Haskins
Author URI: http://nickhaskins.co
Version: 1.0
Description: Displays the posts for the blog page
Class Name: fotosBlogLoop
Filter: component

*/

class fotosBlogLoop extends PageLinesSection {

	function section_head(){

		global $post;

		?>
			<script>
				jQuery(document).ready(function(){
					jQuery('.fotos-back-to-top').click(function() {
						jQuery('body,html').animate({
							scrollTop: 0
						}, 800, 'easeOutExpo');
						return false;
					});
				});
			</script>
		<?php
	}


 	function section_template() {

 		$loop 	= new fotosPostLoop;
 		$artsep = pl_setting('ba_fotos_art_sep');

 		if(have_posts()): while(have_posts()) : the_post();

	 		?><article <?php post_class('fotos-article'); ?> id="post-<?php the_ID();?>"><?php
	 		 	$loop->post_header();
	 			$loop->post_content();
	 			$loop->post_social();
	 			$loop->post_comments();
	 		?></article><?php

	 		if($artsep && is_home()){
	 			echo $artsep;
	 		}

 		endwhile; else:
 			echo 'Sorry no posts found';
 		endif;

	}


	function section_opts( ){
		$options = array(
			array(
				'key' 		=> 'ba_fotos_blogloop_note',
				'title'		=> __('Blog Loop Options', 'fotos'),
				'type'		=> 'template',
				'template'	=> __('Options for the blog can be adjusted globally under the Theme tab.', 'fotos')
			)
		);
		return $options;
	}

}