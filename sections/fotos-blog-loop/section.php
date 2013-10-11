<?php
/*
Section: Blog Loop
Author: Nick Haskins
Author URI: http://nickhaskins.co
Version: 1.0
Description: Displays the posts for the blog page
Class Name: fotosBlogLoop
Loading: active
*/

class fotosBlogLoop extends PageLinesSection {

	function section_head(){

		global $post;

		?>
			<script>
				jQuery(document).ready(function(){
					txt = jQuery('.post-<?php echo $post->ID;?> .fotos-comments-trigger');
					jQuery(txt).click(function(e){
						e.preventDefault();
						jQuery(this).text(jQuery(this).text() == 'Hide Comments' ? 'Show Comments' : 'Hide Comments');
					});
				});
			</script>
		<?php
	}


 	function section_template() {
 		$content = new fotosPostContent;
 		$title = new fotosPostTitle;
 		$break = new baFotosSeparator;
 		$social = new fotosPostSocial;
 		$comm = new fotosPostComments;

 		if(have_posts()): while(have_posts()) : the_post();

	 		?><article <?php post_class('fotos-article'); ?> id="post-<?php the_ID();?>"><?php
	 		 	$title->section_template();
 				$break->section_template();
	 			echo apply_filters('the_content',the_content());
	 			$social->section_template();
	 			$comm->section_template();
	 		?></article><?php


 		endwhile; else:
 			echo 'Sorry no posts found';
 		endif;

	}


	function section_opts( ){}

}