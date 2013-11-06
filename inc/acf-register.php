<?php

if(function_exists("register_field_group")){
	register_field_group(array (
		'id' => 'acf_fotos-page-gallery',
		'title' => 'Fotos Page Gallery',
		'fields' => array (
			array (
				'key' => 'field_527a66aa87dc8',
				'label' => 'Fotos Page Gallery',
				'name' => 'fotos_page_gallery',
				'type' => 'gallery',
				'instructions' => 'Upload a few images to display a gallery.',
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
	register_field_group(array (
		'id' => 'acf_fotos-post-gallery-options',
		'title' => 'Fotos Post Gallery Options',
		'fields' => array (
			array (
				'key' => 'field_527a69006c844',
				'label' => 'Gallery Style',
				'name' => 'gallery_style',
				'type' => 'select',
				'instructions' => 'Choose a gallery style for this specific post.',
				'choices' => array (
					'standard' => 'Thumbnail Gallery',
					'photoset' => 'Photoset Grid',
					'slideshow' => 'Full Screen Slideshow',
				),
				'default_value' => 'standard',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_527a6a8a6c846',
				'label' => 'Enable Lightbox',
				'name' => 'enable_lightbox',
				'type' => 'true_false',
				'instructions' => 'Enable lightbox.',
				'message' => 'Enable Lightbox',
				'default_value' => 0,
			),
			array (
				'key' => 'field_527a6a5b6c845',
				'label' => 'Hide Thumbnails',
				'name' => 'hide_thumbnails',
				'type' => 'true_false',
				'instructions' => 'Hide the gallery thumbnails',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_527a69006c844',
							'operator' => '==',
							'value' => 'standard',
						),
					),
					'allorany' => 'all',
				),
				'message' => 'Hide thumbnails',
				'default_value' => 0,
			),
			array (
				'key' => 'field_527a6aa36c847',
				'label' => 'Photoset Layout',
				'name' => 'photoset_layout',
				'type' => 'text',
				'instructions' => 'If you have 5 images, enter 131. That is 1 image on row 1, 3 images in middle, 1 image on last row.',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_527a69006c844',
							'operator' => '==',
							'value' => 'photoset',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => 131,
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_527a6ba6b2b32',
				'label' => 'Slideshow Title',
				'name' => 'slideshow_title',
				'type' => 'text',
				'instructions' => 'Enter a title for the slideshow. By default it uses the title of the post if none specified.',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_527a69006c844',
							'operator' => '==',
							'value' => 'slideshow',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_527a6c28b2b33',
				'label' => 'Slideshow Subtitle',
				'name' => 'slideshow_subtitle',
				'type' => 'text',
				'instructions' => 'Enter an optional subtitle for the slideshow.',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_527a69006c844',
							'operator' => '==',
							'value' => 'slideshow',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_527a6c4ab2b34',
				'label' => 'Slideshow Cover',
				'name' => 'slideshow_cover',
				'type' => 'image',
				'instructions' => 'Choose an optional cover for the slideshow.',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_527a69006c844',
							'operator' => '==',
							'value' => 'slideshow',
						),
					),
					'allorany' => 'all',
				),
				'save_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_527a6c6fb2b35',
				'label' => 'Slideshow Image Ratio',
				'name' => 'slideshow_image_ratio',
				'type' => 'text',
				'instructions' => 'Enter a ratio for the slideshow. This helps to accommodate all image sizes.',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_527a69006c844',
							'operator' => '==',
							'value' => 'slideshow',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '4/3',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_527a6ca1b2b36',
				'label' => 'Slideshow Overlay Background Color',
				'name' => 'slideshow_overlay_background_color',
				'type' => 'color_picker',
				'instructions' => 'Choose a color for the overlay background.',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_527a69006c844',
							'operator' => '==',
							'value' => 'slideshow',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '#ffffff',
			),
			array (
				'key' => 'field_527a6cc7b2b37',
				'label' => 'Slideshow Overlay Text Color',
				'name' => 'slideshow_overlay_text_color',
				'type' => 'color_picker',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_527a69006c844',
							'operator' => '==',
							'value' => 'slideshow',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '#333333',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
