<?php
/*
	Section: Icons
	Description: Automatically create icons or images with links with ease!
	Class Name: baFotosIcons
	Version: 1.0
	Loading: active
	Filter: social
*/

class baFotosIcons extends PageLinesSection{


	function section_template(){

		$fotocons 	= $this->opt('fotos_box_array');
		$align 		= $this->opt('fotos_icon_align') ? $this->opt('fotos_icon_align') : 'align-left';
		$output = '';

		if( is_array($fotocons) ){

			foreach( $fotocons as $fotocon ){

				$getlink	= pl_array_get('link', $fotocon);
				$geticon 	= pl_array_get('icon', $fotocon);
				$getimg		= pl_array_get('img', $fotocon);
				$getalt		= pl_array_get('alt', $fotocon);

				$image 		= sprintf('<img src="%s" alt="%s">',$getimg,$getalt);
				$type		= $getimg ? $image : sprintf('<i class="icon-%s icon-fotos icon-fotos-default"></i>',$geticon);

				$output    .= sprintf('<a class="fotos-icon-link" href="%s">%s</a>',$getlink,$type);
			}

		} else {

			echo $this->defaults();
		}

		printf('<div class="ba-fotos-icon-wrap %s">%s</div>',$align,$output);

	}

	function defaults(){

		$out = '';
		for($i=1;$i<=3;$i++):
			$out .= sprintf('<a class="fotos-icon-link" href="#"><i class="icon-circle icon-fotos icon-fotos-default"></i></a>');
		endfor;

		return '<div class="ba-fotos-icon-wrap">'.$out.'</div>';
	}

	function section_opts(){

		$options = array(
			array(
				'key'				=> 'fotos_icon_align',
				'type'				=> 'select',
				'default'			=> 'align-left',
				'title'				=> __('Icon Alignment','fotos'),
				'opts'				=> array(
					'align-left'	=> array('name' => __('Align Left', 'fotos')),
					'align-right'	=> array('name' => __('Align Right', 'fotos')),
					'center'		=> array('name' => __('Centered', 'fotos'))
				)
			),
			array(
				'key'				=> 'fotos_box_array',
				'type'				=> 'accordion',
				'title'				=> __('Fotos Icons Setup', 'fotos'),
				'col'				=> 4,
				'opts' 				=> array(
					array(
						'key'		=> 'link',
						'label'		=> __( 'Link', 'fotos' ),
						'type'		=> 'text'
					),
					array(
						'key'		=> 'icon',
						'label'		=> __( 'Icon', 'fotos' ),
						'type'		=> 'select_icon'
					),
					array(
						'key'		=> 'img',
						'label'		=> __( 'Image (instead of icon)', 'fotos' ),
						'type'		=> 'image_upload'
					),
					array(
						'key'		=> 'alt',
						'label'		=> __( 'Image ALT (if using image)', 'fotos' ),
						'type'		=> 'text'
					),
				),

			)
		);


		return $options;
	}

}