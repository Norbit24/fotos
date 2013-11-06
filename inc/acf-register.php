<?php

if(function_exists("register_field_group")){
	register_field_group(array (
		'id' => 'acf_fotos-page-gallery',
		'title' => 'Fotos Page Gallery',
		'fields' => array (
			array (
				'key' => 'field_52756312c4d3b',
				'label' => 'Fotos Page Gallery',
				'name' => 'fotos_page_gallery',
				'type' => 'gallery',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
