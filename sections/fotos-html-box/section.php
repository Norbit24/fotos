<?php
/*
Section: HTML Box
Author: Nick Haskins
Author URI: http://nickhaskins.co
Version: 1.0
Description: Displays html content.
Class Name: fotosHTMLBox
Filter: component
Loading: active
*/

class fotosHTMLBox extends PageLinesSection {

	const version = '1.0';

	function section_scripts(){
		
		if($this->opt('ba_fotos_html_box_fat'))
		wp_enqueue_script('fotos-slabtext',PL_CHILD_URL.'/assets/js/jquery.slabtext.min.js',array('jquery'), self::version, true);

	}

	function section_head(){
		if($this->opt('ba_fotos_html_box_fat')) { ?>
			<script>
			jQuery(document).ready(function(){

				jQuery('.fotos-html-box.fotos-html-box-<?php echo $this->get_the_id();?>').slabText();

			});
			</script>
		<?php }
	}

 	function section_template() {

 		$content = $this->opt('ba_fotos_html_box_content') ? $this->opt('ba_fotos_html_box_content') : 'Hi! Add some text yo!';

 		printf('<div class="fotos-html-box fotos-html-box-%s">%s</div>',$this->get_the_id(),$content);

	}

	function section_opts(){
		$options = array(
			array(
				'key'	=> 'ba_fotos_html_box_content',
				'title'	=> __('Content', 'basiq'),
				'type'	=> 'textarea'
			),
			array(
				'key'	=> 'ba_fotos_html_box_fat',
				'title'	=> __('Enable Fat Text', 'basiq'),
				'type'	=> 'check'
			)
		);

		return $options;
	}

}