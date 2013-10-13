<?php
/*
	Section: Boxes
	Description: Create boxes of images.
	Class Name: baFotosBoxes
	Version: 1.0
	Filter: component
*/

class baFotosBoxes extends PageLinesSection{

	const version = '1.0';

	function section_template(){

		$output 	= '';
		$count 		= 1;
		$box_array 	= $this->opt('fotos_box_array');
		$layout 	= $this->opt('fotos_box_col') ? $this->opt('fotos_box_col') : '3col';

		if( is_array($box_array) ){

			$boxes = count($box_array);

			foreach( $box_array as $box ){

		  		$last 		= ($count == $layout) ? 'last' : false;
				$getimg 	= pl_array_get('img', $box, 'http://placehold.it/50/50');
				$link		= pl_array_get('link',$box);

				$image 		= sprintf('<a href="%s"><img class="ba-fotos-box-img" alt="" src="%s" /></a>',$link,$getimg);
				$output    .= sprintf('<div class="ba-fotos-box-item %s">%s</div>',$last,$image);

				$count++;
			}

		} else {

			echo setup_section_notify($this);
		}

		printf('<div class="ba-fotos-box-wrap fix ba-fotos-box-%s">%s</div>',$layout,$output);

	}

	function section_opts(){

		$options = array();

		$options[] = array(
			'key'				=> 'fotos_box_col',
			'type' 				=> 'select',
			'title'				=> __('Box Columns', 'basiq'),
			'opts'				=> array(
				'2col'			=> array('name' => '2 Column'),
				'3col'			=> array('name' => '3 Column'),
				'4col'			=> array('name' => '4 Column'),
				'5col'			=> array('name' => '5 Column'),
			),
		);

		$options[] = array(
			'key'				=> 'fotos_box_array',
			'type'				=> 'accordion',
			'title'				=> 'Boxes Setup',
			'col'				=> 4,
			'opts' 				=> array(
				array(
					'key'		=> 'img',
					'label'		=> __( 'Image', 'fotos' ),
					'type'		=> 'image_upload'
				),
				array(
					'key'		=> 'link',
					'label'		=> __( 'Link', 'fotos' ),
					'type'		=> 'text'
				),
			),

		);


		return $options;
	}

}