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


 	function section_template() {
 		$content = new fotosPostContent();
 		$title = new fotosPostTitle();
 		$break = new baFotosSeparator();

 		if(have_posts()): while(have_posts()) : the_post();

 			$title->section_template();
 			$break->section_template();
 			$content->section_template();

 		endwhile; else:
 			echo 'Sorry no posts found';
 		endif;

	}


	function section_opts( ){}

}