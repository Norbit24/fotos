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
 		$margintop = $this->opt('ba_fotos_break_margin_top') ? $this->opt('ba_fotos_break_margin_top') : false;
 		$marginbottom = $this->opt('ba_fotos_break_margin_bottom') ? $this->opt('ba_fotos_break_margin_bottom') : false;
 		
 		printf('<div class="pl-content" style="margin-top:%s;margin-bottom:%s;"><hr class="fotos-break fotos-break-%s"></div>',$margintop,$marginbottom,$type);

	}


	function section_opts( ){

		$options = array();

		$options[] = array(
			'title'                  	=> __( 'Separator Configuration', 'fotos' ),
			'type'	                  	=> 'multi',
			'opts'	                  	=> array(
				array(
					'col'				=> 4,
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
				array(
					'col'				=> 4,
					'key'				=> 'ba_fotos_break_margin_top',
					'type'				=> 'text',
					'title'				=> __('Margin Top', 'fotos'),
					'help'				=> __('Acceptable values include 10% or 10px.', 'fotos')
				),
				array(
					'col'				=> 4,
					'key'				=> 'ba_fotos_break_margin_bottom',
					'type'				=> 'text',
					'title'				=> __('Margin Bottom', 'fotos'),
					'help'				=> __('Acceptable values include 10% or 10px.', 'fotos')
				)
			)

		);

		return $options;

	}

}