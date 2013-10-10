<?php
/**
 	* Fotos Shortcodes
 	*
 	* @package     Fotos Theme
 	* @subpackage  Gallery Shortcode [gallery]
 	* @copyright   Copyright (c) 2013, Nick Haskins & CO
 	* @since       1.0
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class baFotosShortcodes {

	function __construct(){

		add_shortcode('fotos_icon',		array($this,'fotos_icon_sc'));
		add_shortcode('fotos_dropcap',	array($this,'fotos_dropcap_sc'));

	}

	/**
		* Creates a styled icon
		*
		* @since version 1.0
		* @example [fotos_icon link="" type=""]
		* @param twitter, facebook, pinterest, google-plus, linkedin, instagram, github, tumblr, youtube
	*/
	function fotos_icon_sc($atts,$content = null) {

		$defaults = array( 'link' => '#','type' => 'twitter');
		$atts = shortcode_atts($defaults, $atts);
		$out = sprintf('<a href="%s"><i class="icon-%s icon-fotos icon-fotos-%s"></i></a>', $atts['link'],$atts['type'],$atts['type']);

		return $out;
	}

	/**
		* Creates a styled dropcap
		*
		* @since version 1.0
		* @example [fotos_dropcap size="" color=""]
		* @param size accepts numerical value
		* @param accepts hex color code
	*/
	function fotos_dropcap_sc( $atts, $content = null ) {

		$defaults = array( 'size' => 5 ,'color' => '');
		$atts = shortcode_atts($defaults,$atts);
		$em = $atts['size'] * 0.5 . 'em';
        $out = sprintf( '<span class="fotos-dropcap" style="font-size:%s;color:%s">%s</span>', $em, $atts['color'], $content );

		return $out;
	}

}
new baFotosShortcodes;