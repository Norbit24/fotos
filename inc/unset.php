<?php
/**
 	* Mask Functions
 	*
 	* @package     Fotos Theme
 	* @subpackage  Functions
 	* @copyright   Copyright (c) 2013, Nick Haskins & CO
 	* @since       1.0
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
	* Unsets the store tab
	* Unsets the Available Themes sub-panel inside the Theme tab
	* Unsets the Account tab
	*
	* @since version 1.0
	* @param $toolbar
	* @return null
*/
add_filter('pl_toolbar_config','fotos_mask_mode',14);
function fotos_mask_mode($toolbar){

	unset($toolbar['pl-extend']);
	unset($toolbar['account']);

	unset($toolbar['add-new']['panel']['more_sections']);

	unset($toolbar['theme']['panel']['avail_themes']);
	unset($toolbar['theme']['panel']['more_themes']);
	unset($toolbar['theme']['panel']['export_themes']);

	//plprint($toolbar);
	return $toolbar;
}


/**
	* Unsets core PageLines sections that are PRO
	* Unsets core sections that do not pertain to blogging
	*
	* @since version 1.0
	* @param $sections
	* @return null
*/
add_filter('pagelines_section_admin','fotos_remove_core_sections');
function fotos_remove_core_sections($sections){


	unset($sections['parent']['PageLinesFlipper']);
	unset($sections['parent']['PLICallout']);
	unset($sections['parent']['PLMasthead']);
	unset($sections['parent']['PLPopThumbs']);
	unset($sections['parent']['PLProPricing']);
	unset($sections['parent']['PLRapidTabs']);
	unset($sections['parent']['PageLinesStarBars']);
	unset($sections['parent']['ScrollSpy']);
	unset($sections['parent']['plRevSlider']);
	unset($sections['parent']['PageLinesQuickSlider']);

	//plprint($sections);
	return $sections;
}


/**
	* Removes the notice telling users to upgrade to PRo
	*
	* @since version 1.0
	* @param $note
	* @return null
*/
add_filter( 'pagelines_global_notification', 'fotos_folder_check_remove');
function fotos_folder_check_remove($note){
	$note = '';
	return $note;
}
