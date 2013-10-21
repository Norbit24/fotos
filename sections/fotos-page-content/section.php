<?php
/*
Section: Page Content
Author: Nick Haskins
Author URI: http://nickhaskins.co
Version: 1.0
Description: Displays page content
Class Name: fotosPageContent
Filter: component
Loading: active
*/

class fotosPageContent extends PageLinesSection {

	const version = '1.0';

 	function section_template() {

 		$content = apply_filters('the_content', get_the_content());

 		printf('<div class="fotos-page-content">%s%s</div>',$content, pledit(get_the_ID()));


	}

}