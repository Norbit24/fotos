<?php
/*
Section: Separator
Author: Nick Haskins
Author URI: http://nickhaskins.co
Version: 1.0
Description: A separator section providing options for a solid, double, dashed, or dotted line. Can be used full-width, or content-width.
Class Name: baFotosSeparator
Filter: component
*/

class baFotosSeparator extends PageLinesSection {

	const version = '1.0';

 	function section_template() {

 		$type = $this->opt('ba_fotos_break_type') ? $this->opt('ba_fotos_break_type') : 'solid';
 		printf('<div class="pl-content"><hr class="fotos-break fotos-break-%s"></div>',$type);

	}


	function section_opts( ){

		$options = array();

		$options[] = array(
			'title'                  	=> __( 'Separator Configuration', 'fotos' ),
			'type'	                  	=> 'multi',
			'opts'	                  	=> array(
				array(
					'key'			  	=> 'ba_fotos_break_type',
					'type' 			 	=> 'select',
					'default'		  	=> 'solid',
					'title' 	      	=> __( 'Type of Break', 'fotos' ),
					'opts'				=> array(
						'solid' 		=> array('name'	=> 'Solid'),
						'double' 		=> array('name'	=> 'Double'),
						'dashed' 		=> array('name'	=> 'Dashed'),
						'dotted' 		=> array('name'	=> 'Dotted'),
					),
				),
			)

		);

		return $options;

	}

}