<?php
/**
 	* Partial Template Functions Used Globally
 	*
 	* @package     Fotos Theme
 	* @subpackage  Functions
 	* @copyright   Copyright (c) 2013, Nick Haskins & CO
 	* @since       1.0
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class baFotosPartials {

	function date_markup(){

		$datestyle  = pl_setting('ba_fotos_post_date_style') ? pl_setting('ba_fotos_post_date_style') : 'fotos-date-default';
		$month 		= get_the_time('M');
        $day  		= ('fotos-date-stacked' == $datestyle) ? get_the_time('d') : get_the_time('j');
        $year 		= get_the_time('Y');

 		switch($datestyle):

 			case 'fotos-date-default':
 				$out = sprintf('<span class="fotos-entry-date">%s</span>',get_the_date());
 				break;
 			case 'fotos-date-block':
 				$out = sprintf('<div class="fotos-entry-date-block-style">
 								<div class="fotos-date-block-day">%s</div>
 								<div class="fotos-date-block-monthyear">
 									<div class="fotos-date-block-month">%s</div>
 									<div class="fotos-date-block-year">%s</div>
 								</div></div>',$day,$month,$year);
 				break;
 			case 'fotos-date-stacked':
 				$out = sprintf('<div class="fotos-entry-date-stack-style">
 									<div class="fotos-date-block-month">%s</div>
 									<div class="fotos-date-block-day">%s</div>
 									<div class="fotos-date-block-year">%s</div>
 									</div>',$month,$day,$year);
 				break;
 			case 'fotos-date-minimal':
 				$out = sprintf('<span class="fotos-entry-date">%s%s%s</span>',$month,$day,$year);
 				break;
 			default:
 			 	$out = sprintf('<span class="fotos-entry-date">%s</span>',get_the_date());

 		endswitch;

 		return $out;

	}
}
new baFotosPartials;