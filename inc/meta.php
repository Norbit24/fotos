<?php
/**
 	* Post Meta Boxes
 	*
 	* @package     Fotos Theme
 	* @subpackage  Functions
 	* @copyright   Copyright (c) 2013, Nick Haskins & CO
 	* @since       1.0
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

add_filter( 'cmb_meta_boxes', 'fotos_sample_metaboxes' );
function fotos_sample_metaboxes( array $meta_boxes ) {

	$opts = array(
		array(
			'id' => 'fotos_gallery_opts_title',
			'name' => '',
			'type' => 'title',
			'desc'	=> '<strong style="color:#f00;">To Add a Gallery</strong> <br /> 1. Click Add Media <br /> 2. On the left, click Create New Gallery. <br /> 3. Under Media Library, using the dropdown, select <u>"Uploaded to this post"</u>. <br />4. Upload your images, then click "Create a new gallery" using the button on the bottom right. <br />5. Insert the gallery into the post where you want the gallery to show. <br />6. Configure with optional settings below.'
		),
		array(
			'id' => 'fotos_gallery_type',
			'name' => 'Gallery Style',
			'type' => 'select',
			'default'	=> 'standard',
			'options' => array(
				'standard' => 'Thumbnail Gallery',
				'photoset' => 'Photoset Grid',
				'slideshow' => 'Full Screen Slideshow'
			),
			'allow_none' => false
		),
		array(
			'id' => 'fotos_gallery_opts_title',
			'name' => 'Gallery Options',
			'type' => 'title'
		),
		array(
			'id' => 'fotos_hide_thumbs',
			'name' => 'Hide Thumbnails',
			'title'	=> 'this',
			'type' => 'checkbox',
		),
		array(
			'id' => 'fotos_enable_lb',
			'name' => 'Enable Lightbox',
			'title'	=> 'this',
			'type' => 'checkbox',
		),
		array(
			'id' => 'fotos_enable_captions',
			'name' => 'Enable Captions',
			'type' => 'checkbox',
		),
		array(
			'id' => 'fotos_ps_title',
			'name' => 'Photoset Options',
			'type' => 'title'
		),
		array(
			'id' => 'fotos_photoset_layout',
			'name' => '',
			'type' => 'text_small',
			'desc'	=> __('If you have 5 images, enter 131. That is 1 image on row 1, 3 images in middle, 1 image on last row.','fotos')
		),
		array(
			'id' => 'fotos_ss_title',
			'name' => 'Slideshow Options',
			'type' => 'title'
		),
		array(
			'id' => 'fotos_slideshow_title',
			'name' => 'Title (uses post title as default if none specified)',
			'type' => 'text',
			'cols' => 6
		),
		array(
			'id' => 'fotos_slideshow_subtitle',
			'name' => 'Subtitle (optional)',
			'type' => 'text',
			'cols' => 6
		),
		array(
			'id' => 'fotos_slideshow_cover',
			'name' => 'Slideshow Cover (optional)',
			'type' => 'image',
			'cols' => 3
		),
		array(
			'id' => 'fotos_slideshow_ratio',
			'name' => 'Slideshow Image Ratio',
			'type' => 'text_small',
			'desc'	=> __('Default is 800/600. Acceptable values include 800/600, 4/3, or 1.33333333333','fotos'),
			'cols' => 3
		),
		array(
			'id'	=> 'fotos_slideshow_overlay_color',
			'name'	=> 'Overlay Background Color',
			'type'	=> 'colorpicker',
			'cols' => 3
		),
		array(
			'id'	=> 'fotos_slideshow_overlay_text_color',
			'name'	=> 'Overlay Text Color',
			'type'	=> 'colorpicker',
			'cols' => 3
		),
	);

	$meta_boxes[] = array(
		'title' => __('Fotos - Post Gallery', 'fotos'),
		'pages' => 'post',
		'fields' => $opts
	);


	////
	////
	/////
	////
	//////
	/////

	$fields = array(

		array( 'id' => 'field-1',  'name' => 'Text input field', 'type' => 'text' ),
		array( 'id' => 'field-2', 'name' => 'Read-only text input field', 'type' => 'text', 'readonly' => true, 'default' => 'READ ONLY' ),
 		array( 'id' => 'field-3', 'name' => 'Repeatable text input field', 'type' => 'text', 'desc' => 'Add up to 5 fields.', 'repeatable' => true, 'repeatable_max' => 5 ),

		array( 'id' => 'field-4',  'name' => 'Small text input field', 'type' => 'text_small' ),
		array( 'id' => 'field-5',  'name' => 'URL field', 'type' => 'url' ),

		array( 'id' => 'field-6',  'name' => 'Radio input field', 'type' => 'radio', 'options' => array( 'Option 1', 'Option 2' ) ),
		array( 'id' => 'field-7',  'name' => 'Checkbox field', 'type' => 'checkbox' ),

		array( 'id' => 'field-8',  'name' => 'WYSIWYG field', 'type' => 'wysiwyg', 'options' => array( 'editor_height' => '100' ) ),

		array( 'id' => 'field-9',  'name' => 'Textarea field', 'type' => 'textarea' ),
		array( 'id' => 'field-10',  'name' => 'Code textarea field', 'type' => 'textarea_code' ),

		array( 'id' => 'field-11', 'name' => 'File field', 'type' => 'file', 'file_type' => 'image', 'repeatable' => 1, 'sortable' => 1 ),
		array( 'id' => 'field-12', 'name' => 'Image upload field', 'type' => 'image', 'repeatable' => false ),

		array( 'id' => 'field-13', 'name' => 'Select field', 'type' => 'select', 'options' => array( 'option-1' => 'Option 1', 'option-2' => 'Option 2', 'option-3' => 'Option 3' ), 'allow_none' => true ),
		array( 'id' => 'field-14', 'name' => 'Select field', 'type' => 'select', 'options' => array( 'option-1' => 'Option 1', 'option-2' => 'Option 2', 'option-3' => 'Option 3' ), 'multiple' => true ),
		array( 'id' => 'field-15', 'name' => 'Select taxonomy field', 'type' => 'taxonomy_select',  'taxonomy' => 'category' ),
		array( 'id' => 'field-15b', 'name' => 'Select taxonomy field', 'type' => 'taxonomy_select',  'taxonomy' => 'category',  'multiple' => true ),
		array( 'id' => 'field-16', 'name' => 'Post select field', 'type' => 'post_select', 'use_ajax' => false, 'query' => array( 'cat' => 1 ) ),
		array( 'id' => 'field-17', 'name' => 'Post select field (AJAX)', 'type' => 'post_select', 'use_ajax' => true ),
		array( 'id' => 'field-17b', 'name' => 'Post select field (AJAX)', 'type' => 'post_select', 'use_ajax' => true, 'query' => array( 'posts_per_page' => 8 ), 'multiple' => true  ),

		array( 'id' => 'field-18', 'name' => 'Date input field', 'type' => 'date' ),
		array( 'id' => 'field-19', 'name' => 'Time input field', 'type' => 'time' ),
		array( 'id' => 'field-20', 'name' => 'Date (unix) input field', 'type' => 'date_unix' ),
		array( 'id' => 'field-21', 'name' => 'Date & Time (unix) input field', 'type' => 'datetime_unix' ),

		array( 'id' => 'field-22', 'name' => 'Color', 'type' => 'colorpicker' ),
		array( 'id' => 'field-23', 'name' => 'Oembed field', 'type' => 'oembed' ),

		array( 'id' => 'field-24', 'name' => 'Title Field', 'type' => 'title' ),

	);

	$meta_boxes[] = array(
		'title' => 'CMB Test - all fields',
		'pages' => 'post',
		'fields' => $fields
	);

		$groups_and_cols = array(
		array( 'id' => 'gac-1',  'name' => 'Text input field', 'type' => 'text', 'cols' => 4 ),
		array( 'id' => 'gac-2',  'name' => 'Text input field', 'type' => 'text', 'cols' => 4 ),
		array( 'id' => 'gac-3',  'name' => 'Text input field', 'type' => 'text', 'cols' => 4 ),
		array( 'id' => 'gac-4', 'name' => 'Group (4 columns)', 'type' => 'group', 'cols' => 4, 'fields' => array(
			array( 'id' => 'gac-4-f-1',  'name' => 'Textarea field', 'type' => 'textarea' )
		) ),
		array( 'id' => 'gac-5', 'name' => 'Group (8 columns)', 'type' => 'group', 'cols' => 8, 'fields' => array(
			array( 'id' => 'gac-4-f-1',  'name' => 'Text input field', 'type' => 'text' ),
			array( 'id' => 'gac-4-f-2',  'name' => 'Text input field', 'type' => 'text' ),
		) ),
	);

	$meta_boxes[] = array(
		'title' => 'Groups and Columns',
		'pages' => 'post',
		'fields' => $groups_and_cols
	);

	// Example of repeatable group. Using all fields.
	// For this example, copy fields from $fields, update I
	$group_fields = $fields;
	foreach ( $group_fields as &$field ) {
		$field['id'] = str_replace( 'field', 'gfield', $field['id'] );
	}

	$meta_boxes[] = array(
		'title' => 'CMB Test - group (all fields)',
		'pages' => 'post',
		'fields' => array(
			array(
				'id' => 'gp',
				'name' => 'Repeatable Group',
				'type' => 'group',
				'repeatable' => true,
				'sortable' => true,
				'fields' => $group_fields
			)
		)
	);

	return $meta_boxes;

}