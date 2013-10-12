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

	return $meta_boxes;

}