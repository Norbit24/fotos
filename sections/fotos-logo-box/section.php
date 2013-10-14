<?php
/*
Section: Logo Box
Author: Nick Haskins
Author URI: http://nickhaskins.co
Version: 1.0
Description: Displays logo with optional link to home
Class Name: fotosLogoBox
Filter: component
Loading: active
*/

class fotosLogoBox extends PageLinesSection {

 	function section_template() {

 		$logo = pl_setting('ba_fotos_global_logo') ? pl_setting('ba_fotos_global_logo') : PL_CHILD_URL.'/assets/img/fotos-logo.png';
 		$alt = get_bloginfo('description');
 		$link = get_bloginfo('wpurl');

 		$out = $this->opt('ba_fotos_logo_gohome') ? sprintf('<a href="%s"><img class="ba-basiq-logo" src="%s" alt="%s" /></a>',$link,$logo,$alt) : sprintf('<img src="%s" alt="%s" />',$logo,$alt);

 		echo $out;
	}

	function section_opts(){
		$options = array(
			array(
				'key'	=> 'ba_fotos_logo_gohome',
				'title'	=> __('Link to Home', 'basiq'),
				'type'	=> 'check'
			),
		);

		return $options;
	}

}