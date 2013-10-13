<?php
/*
Section: Grid Loop
Author: Nick Haskins
Author URI: http://nickhaskins.co
Version: 1.0
Description: Displays the posts for the blog page
Class Name: fotosGridBlogLoop
Loading: active
Filter: component
*/

class fotosGridBlogLoop extends PageLinesSection {

	const version = '1.0';

	function section_scripts(){

		wp_enqueue_script('fotos-wookmark', PL_CHILD_URL.'/assets/js/jquery.wookmark.min.js',  array('jquery'), self::version, true);
		wp_enqueue_script('fotos-wookmark-images-loaded', PL_CHILD_URL.'/assets/js/jquery.imagesloaded.js', array('jquery'), self::version, true);

	}

	function section_head(){
		?>
		<script>
			jQuery(document).ready(function(){
			      jQuery('.ba-fotos-grid-loop-list').imagesLoaded(function() {
			        // Prepare layout options.
			        var options = {
			          autoResize: true, // This will auto-update the layout when the browser window is resized.
			          container: jQuery('.ba-fotos-grid-loop-list'), // Optional, used for some extra CSS styling
			          offset: 20, // Optional, the distance between grid items
			          flexibleWidth: 340 // Optional, the width of a grid item
			        };

			        // Get a reference to your grid items.
			        var handler = jQuery('.ba-fotos-grid-loop-list li');

			        // Call the layout function.
			        jQuery(handler).wookmark(options);
			    });
			});
		</script><?php

	}

 	function section_template() {

 		printf('<div class="ba-fotos-grid-loop-wrap"><ul class="ba-fotos-grid-loop-list fix">');

	 		if(have_posts()): while(have_posts()) : the_post();

	 			$header = sprintf('<h5 class="ba-fotos-grid-loop-title"><a class="ba-fotos-grid-loop-link" href="%s" title="%s">%s</a></h5>',get_permalink(),get_the_title(),get_the_title());

	 			$html = '';

		 		$html .= printf('<li>');

		 			$img = sprintf('<a class="ba-fotos-grid-loop-link" href="%s" title="%s">%s</a>',get_permalink(),get_the_title(),get_the_post_thumbnail(get_the_ID(), 'medium'));
			 		$html .= printf('<header class="ba-fotos-grid-loop-header">%s%s</header>',$img,$header);
			 		$html .= printf('<section class="ba-fotos-grid-loop-entry">%s</section>',pl_short_excerpt(get_the_ID(), 40, '...'));
			 		$html .= printf('<footer class="ba-fotos-grid-loop-footer"></footer>');

			 	$html .= printf('</li>');

	 		endwhile; else:
	 			echo 'Sorry no posts found';
	 		endif;

 		printf('</ul></div>');

	}


	function section_opts( ){}

}