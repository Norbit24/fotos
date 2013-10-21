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

		$datestyle  	= pl_setting('ba_fotos_post_date_style') ? pl_setting('ba_fotos_post_date_style') : 'fotos-date-default';
		$month 			= ('fotos-date-minimal' == $datestyle) ? get_the_time('m') : get_the_time('M');
        $day  			= ('fotos-date-stacked' == $datestyle || 'fotos-date-minimal' == $datestyle) ? get_the_time('d') : get_the_time('j');
        $year 			= get_the_time('Y');

        $date 			= get_the_date('F jS, Y');

        // margin styles
        $getmargin 		= pl_setting('ba_fotos_post_date_margin');

       	//date styles
 		$datebgimg 		= pl_setting('ba_fotos_post_date_bg_img');

 		$datebgimghorz 	= pl_setting('ba_fotos_post_date_bg_img_horz') ? pl_setting('ba_fotos_post_date_bg_img_horz') : 'center';
 		$datebgimgvert 	= pl_setting('ba_fotos_post_date_bg_img_vert') ? pl_setting('ba_fotos_post_date_bg_img_vert') : 'center';

 		$styles 		= ($datebgimg || $getmargin) ? sprintf('style="background:url(\'%s\') %s %s no-repeat;margin-top:%s;"',$datebgimg,$datebgimghorz,$datebgimgvert,$getmargin) : false;


 		switch($datestyle):

 			case 'fotos-date-default':
 				$out = sprintf('<time class="fotos-entry-date" datetime="%s" itemprop="datePublished" pubdate>%s</time>',$date,get_the_date());
 			break;
 			case 'fotos-date-block':
 				$out = sprintf('<time class="fotos-entry-date-block-style" %s>
 								<div class="fotos-date-block-day">%s</div>
 								<div class="fotos-date-block-monthyear">
 									<div class="fotos-date-block-month">%s</div>
 									<div class="fotos-date-block-year">%s</div>
 								</div></time>',$styles,$day,$month,$year);
 			break;
 			case 'fotos-date-stacked':
 				$out = sprintf('<div class="fotos-entry-date-stack-style" %s>
 									<div class="fotos-date-block-month">%s</div>
 									<div class="fotos-date-block-day">%s</div>
 									<div class="fotos-date-block-year">%s</div>
 									</div>',$styles,$month,$day,$year);
 			break;
 			case 'fotos-date-minimal':
 				$out = sprintf('<time class="fotos-entry-date" %s>%s.%s.%s</time>',$styles,$month,$day,$year);
 			break;
 			default:
 			 	$out = sprintf('<time class="fotos-entry-date" %s>%s</time>',$styles,get_the_date());

 		endswitch;

 		return $out;

	}
}
new baFotosPartials;