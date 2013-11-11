<?php
/**
 	* Toolbar Support Tab
 	*
 	* @package     Fotos Theme
 	* @subpackage  Functions
 	* @copyright   Copyright (c) 2013, Nick Haskins & CO
 	* @since       1.0
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
	* Adds a tab to the toolbar with videos and docs
	*
	* @since version 1.0
	* @param $toolbar
	* @return null
*/

class fotosSupportTab {

	const version = '1.0';

	function __construct(){
		// add a suppor tab
		add_filter('pl_toolbar_config',array($this,'support_tab'),15);
	}


	function support_tab($toolbar){

	    $toolbar['fotos-support'] = array(
	        'name'        		=> __('Fotos Hub', 'fotos'),
	        'icon'        		=> 'icon-bullseye',
	        'pos'        		=> 50,
	        'panel'      		=> array(
	        	'heading'       => __( 'Fotos Support', 'fotos' ),
	        	'docs'      => array(
	                'name'      => __( 'Get Help', 'fotos' ),
	                'icon'      => 'icon-ambulance',
	                'type'		=> 'call',
	             	'call'		=> array($this,'fotos_help_call')
	            ),
	            'market'      => array(
	                'name'      => __( 'Fotos Market', 'fotos' ),
	                'icon'      => 'icon-shopping-cart',
	                'type'		=> 'call',
	             	'call'		=> array($this,'fotos_market_call')
	            )
	        )
	    );

		return $toolbar;
	}


	function fotos_help_call(){
		?>
		<div class="fotos-docs-row row">
			<div class="span3">
				<p class="zmt" style="margin-bottom:7px;"><?php _e('Stuck and need some help? Check out the videos on your right, or hit the docs link below. If all else fails, hit us up on the forum!','fotos');?></p>

				<a class="btn btn-info" href="http://nickhaskins.co/forum/fotos-support/" target="_blank"><i class="icon-user"></i> &nbsp;<?php _e('Support Forum','fotos');?></a>
				<a class="btn btn-info" href="http://docs.fotostheme.com" target="_blank"><i class="icon-folder-close"></i> &nbsp;<?php _e('Docs','fotos');?></a>

				<p style="margin-bottom:7px;"><?php _e('We\'re also on those social places!','fotos');?></p>
				<a href="http://twitter.com/fotostheme" target="_blank" class="btn btn-info"><i class="icon-twitter-sign"></i> &nbsp;<?php _e('Follow Us','fotos');?></a>
				<a href="http://facebook.com/fotostheme" target="_blank" class="btn btn-info"><i class="icon-facebook-sign"></i> &nbsp;<?php _e('Be a Fan','fotos');?></a>

			</div>
			<div class="span9">
				<div class="row">
					<div class="span4 fotos-help-vid">
						<p class="zmt fotos-help"><strong><?php _e('Getting started with Fotos','fotos');?></strong></p>
						<div class="fitvids"><iframe src="//player.vimeo.com/video/79112855?title=0&amp;byline=0&amp;portrait=0" width="412" height="232" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
					</div>
					<div class="span4 fotos-help-vid">
						<p class="zmt fotos-help"><strong><?php _e('Working with options','fotos');?></strong></p>
						<div class="fitvids"><iframe src="//player.vimeo.com/video/71111070?title=0&amp;byline=0&amp;portrait=0" width="412" height="232" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
					</div>
					<div class="span4 fotos-help-vid">
						<p class="zmt fotos-help"><strong><?php _e('Setting up the contact form','fotos');?></strong></p>
						<div class="fitvids"><iframe src="//player.vimeo.com/video/79117858?title=0&amp;byline=0&amp;portrait=0" width="412" height="232" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
					</div>
				</div>
				<div class="row">
					<div class="span4 fotos-help-vid">
						<p class="zmt fotos-help"><strong><?php _e('Creating Galleries','fotos');?></strong></p>
						<div class="fitvids"><iframe src="//player.vimeo.com/video/79121995?title=0&amp;byline=0&amp;portrait=0" width="412" height="232" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
					</div>
					<div class="span4 fotos-help-vid">
						<!--
						<p class="zmt fotos-help"><strong><?php _e('How to install skins','fotos');?></strong></p>
						<img src="http://placehold.it/300x184">
						-->
					</div>
					<div class="span4 fotos-help-vid">
						<!--
						<p class="zmt fotos-help"><strong><?php _e('Installing Fotos plugins','fotos');?></strong></p>
						<img src="http://placehold.it/300x184">
						-->
					</div>
				</div>
			</div>
		</div><?php
	}


	function fotos_market_call(){
		?>
		<p class="span12"><?php _e('The <a href="http://nickhaskins.co/fotos" target="_blank">Fotos Market</a> is where you can find cool plugins and amazing skins to compliment your site with. We\'re going to display those products here soon, but in the mean time head on over and <a href="http://nickhaskins.co/products/category/fotos/" target="_blank">check out</a> the market!','fotos');?></p>
		<p><?php _e('P.S. - Want to be a Fotos Author and earn a nice little recurring income? <a href="http://authors.fotostheme.com" target="_blank">Apply here</a>.','fotos');?></p>
		<?php
	}


}
new fotosSupportTab;






