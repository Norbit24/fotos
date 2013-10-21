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

	function section_head(){
		// Widget Titles
		if($this->opt('ba_fotos_box_cap_font'))
			echo load_custom_font( $this->opt('ba_fotos_box_cap_font'),'.ba-fotos-box-cap');

	}

	function section_template(){

		$output 	= '';
		$count 		= 1;
		$box_array 	= $this->opt('fotos_box_array');
		$layout 	= $this->opt('fotos_box_col') ? $this->opt('fotos_box_col') : '3col';

		$captxtcolor = pl_hashify($this->opt('ba_fotos_box_cap_text'));
		$capbgcolor = pl_hashify($this->opt('ba_fotos_box_cap_back'));

		$capstyle 	= ($captxtcolor || $capbgcolor) ? sprintf('style="background:%s;color:%s;"',$capbgcolor,$captxtcolor) : false;

		if ( is_array($box_array) ){

			$boxes = count($box_array);

			foreach( $box_array as $box ){

		  		$last 		= ($count == $layout) ? 'last' : false;
				$getimg 	= pl_array_get('img', $box, 'http://placehold.it/50/50');
				$link		= pl_array_get('link',$box);
				$cap 		= pl_array_get('caption', $box);

				if ($link) {

					if ($cap){
						$image 		= sprintf('<a class="ba-fotos-box-link-wrap" href="%s"><img class="ba-fotos-box-img" alt="" src="%s" /><span class="ba-fotos-box-cap" %s>%s</span></a>',$link,$getimg,$capstyle,$cap);
					} else {
						$image 		= sprintf('<a class="ba-fotos-box-link-wrap" href="%s"><img class="ba-fotos-box-img" alt="" src="%s" /></a>',$link,$getimg);
					}

				} else {

					$image 		= sprintf('<img class="ba-fotos-box-img" alt="" src="%s" />',$getimg);

				}

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
			'post_type'			=> __('Box','fotos'),
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
				array(
					'key'		=> 'caption',
					'label'		=> __( 'Link Caption (optional if using link)', 'fotos' ),
					'type'		=> 'text'
				)
			)

		);

		$options[] = array(
			'key'				=> 'ba_fotos_box_design',
			'type'				=> 'multi',
			'title'				=> __('Box Captions Design','fotos'),
			'opts'				=> array(
				array(
					'key'		=> 'ba_fotos_box_cap_back',
					'type'		=> 'color',
					'default'	=> '#0077CC',
					'title'		=> __('Box Caption Background','fotos')
				),
				array(
					'key'		=> 'ba_fotos_box_cap_text',
					'type'		=> 'color',
					'default'	=> '#FFF',
					'title'		=> __('Box Caption Text','fotos')
				),
				array(
					'title'   	=> __('Box Caption Font', 'fotos'),
				    'type'    	=> 'fonts',
				    'default'	=> 'open_sans',
				    'key'		=> 'ba_fotos_box_cap_font',
					'help' 		=> __('This controls the box caption font for this section.' , 'fotos'),
				)
			),
			'help'				=> __('This','fotos')
		);


		return $options;
	}

}