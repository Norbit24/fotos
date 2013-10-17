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

// add a suppor tab
add_filter('pl_toolbar_config','fotos_support_tab',15);
function fotos_support_tab($toolbar){

    $toolbar['fotos-support'] = array(
        'name'        		=> 'Fotos Help',
        'icon'        		=> 'icon-ambulance',
        'pos'        		=> 70,
        'panel'      		=> array(
        	'heading'       => __( 'Fotos Support', 'fotos' ),
            'store'         => array(
                'name'      => __( 'Videos', 'fotos' ),
               	'type'      => 'call',
                'call'      => 'ba_fotos_vids_call',
                'icon'      => 'icon-film'
            ),
            'featured'      => array(
                'name'      => __( 'Docs', 'fotos' ),
                'icon'      => 'icon-folder-close',
                'type'		=> 'call',
             	'call'		=> 'ba_fotos_docs_call'
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
	?><p>Docs bitch</p><?php
}