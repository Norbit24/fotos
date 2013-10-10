<?php
/*
Section: Post Content
Author: Nick Haskins
Author URI: http://nickhaskins.co
Version: 1.0
Description: Displays the content of the post
Class Name: fotosPostContent
Loading: active
*/

class fotosPostContent extends PageLinesSection {


 	public function section_template() {

 		?><article <?php post_class('fotos-article'); ?> id="post-<?php the_ID();?>"><?php
 			echo apply_filters('the_content',the_content());
 		?></article><?php

	}


	function section_opts( ){



	}

}