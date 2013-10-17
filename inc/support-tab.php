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
	        'name'        		=> 'Fotos Help',
	        'icon'        		=> 'icon-bullseye',
	        'pos'        		=> 70,
	        'panel'      		=> array(
	        	'heading'       => __( 'Fotos Support', 'fotos' ),
	            'videos'         => array(
	                'name'      => __( 'Videos', 'fotos' ),
	               	'type'      => 'call',
	                'call'      => array($this,'ba_fotos_vids_call'),
	                'icon'      => 'icon-film'
	            ),
	            'docs'      => array(
	                'name'      => __( 'Docs', 'fotos' ),
	                'icon'      => 'icon-folder-close',
	                'type'		=> 'call',
	             	'call'		=> array($this,'ba_fotos_docs_call')
	            ),
	            'support'      => array(
	                'name'      => __( 'Support', 'fotos' ),
	                'icon'      => 'icon-ambulance',
	                'type'		=> 'call',
	             	'call'		=> array($this,'ba_fotos_docs_call')
	            )
	        )
	    );

		return $toolbar;
	}

	// Video Panel Callback
	function ba_fotos_vids_call(){

		?>

		<div class="row">
			<div class="span3">
				<iframe src="//player.vimeo.com/video/76342353?title=0&amp;byline=0&amp;portrait=0" width="300" height="184" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
			</div>
			<div class="span3">
				<iframe src="//player.vimeo.com/video/61810658?title=0&amp;byline=0&amp;portrait=0" width="300" height="184" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
			</div>
			<div class="span3">
				<iframe src="//player.vimeo.com/video/61810658?title=0&amp;byline=0&amp;portrait=0" width="300" height="184" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
			</div>
			<div class="span3">
				<iframe src="//player.vimeo.com/video/61810658?title=0&amp;byline=0&amp;portrait=0" width="300" height="184" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
			</div>
		</div>

		<?php

	}

	// Docs Panel Callback
	function ba_fotos_docs_call(){
		?>
		<div class="row">
			<div class="span6">
				<p>				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean vitae viverra dui, sit amet tincidunt lorem. Cras semper porttitor euismod. Vestibulum accumsan neque fringilla est placerat, et bibendum sapien tempus. Nunc massa dolor, varius eget dignissim ac, tempor sit amet justo. Pellentesque blandit lectus sed erat cursus egestas. Pellentesque porta urna sit amet interdum viverra. Aenean porta sem turpis, ut eleifend arcu mollis vel. Quisque condimentum dolor ac nisi semper, et imperdiet nisi sodales. In ultrices nibh lectus, at molestie mi tempor non. In interdum lacus ut mi molestie cursus. Pellentesque elementum sit amet justo eget tristique. Suspendisse potenti.</p>	
			</div>
			<div class="span6">
				<p>				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean vitae viverra dui, sit amet tincidunt lorem. Cras semper porttitor euismod. Vestibulum accumsan neque fringilla est placerat, et bibendum sapien tempus. Nunc massa dolor, varius eget dignissim ac, tempor sit amet justo. Pellentesque blandit lectus sed erat cursus egestas. Pellentesque porta urna sit amet interdum viverra. Aenean porta sem turpis, ut eleifend arcu mollis vel. Quisque condimentum dolor ac nisi semper, et imperdiet nisi sodales. In ultrices nibh lectus, at molestie mi tempor non. In interdum lacus ut mi molestie cursus. Pellentesque elementum sit amet justo eget tristique. Suspendisse potenti.</p>
			</div>
		</div>
		<?php
	}


}
new fotosSupportTab;






