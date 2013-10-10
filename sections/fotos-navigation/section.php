<?php
/*
Section: Fotos Advanced Nav
Author: Nick Haskins
Author URI: http://nickhaskins.co
Version: 1.0
Description: A full-featured navigation system with horizontal, vertical, fixed top, fixed bottom, and unlimited sub-menus.
Class Name: fotosNav
*/

class fotosNav extends PageLinesSection {

	const version = '1.0';

	function section_persistent(){

        add_filter( 'pless_vars', array($this,'fotos_nav_less_vars'));
        add_filter('pl_settings_array', array($this,'fotos_nav_global_opts'));
	}

	function fotos_nav_less_vars($less){

		$less['fotos-nav-height'] 	= pl_setting('ba_fotos_nav_height')  ? pl_setting('ba_fotos_nav_height') : '64px';
		$less['fotos-nav-font-color'] = pl_setting('ba_fotos_nav_font_color')  ? pl_hashify(pl_setting('ba_fotos_nav_font_color')) : '#eaeaea';
		$less['fotos-nav-font-size'] 	= pl_setting('ba_fotos_nav_font_size' )  ? pl_setting('ba_fotos_nav_font_size') : '14px';

		return $less;
	}

	function section_scripts() {
		wp_enqueue_script('fotos-nav',$this->base_url.'/jquery.yams.min.js',array('jquery'),self::version,true);
	}

	function section_head() {

		$fixpos = $this->opt('ba_fotos_nav_nav_mode');
		$dropup = ('fotos-nav-fixed-bott' == $fixpos) ? true : 0;
		$id = $this->get_the_id();

		?><script>
			jQuery(window).load(function(){

				jQuery('.fotos-nav-menu.fotos-nav-menu-<?php echo $this->get_the_id();?>').smartmenus({
					bottomToTopSubMenus:<?php echo $dropup;?>
				});

				<?php if('fotos-nav-fixed-top' == $fixpos) { ?>
					adminbar = jQuery('#wpadminbar').height();
					jQuery('#fotos-nav<?php echo $id;?>').css({'top':adminbar});
				<?php } elseif('fotos-nav-fixed-bott' == $fixpos) { ?>
					toolbar = jQuery('#PageLinesToolbox').height();
					jQuery('#fotos-nav<?php echo $id;?>').css({'bottom':toolbar});
				<?php } else { ?>
					return false;
				<?php  } ?>
			});
		</script><?php
		
		if($fixpos) {

			$top = ('fotos-nav-fixed-top' == $fixpos) ? 'fotos-nav-fixed fotos-nav-fixed-top' : false;
			$top .= ('fotos-nav-fixed-bott' == $fixpos) ? 'fotos-nav-fixed fotos-nav-fixed-bottom' : false;

			pagelines_add_bodyclass($top);
		}

	}


 	function section_template() {

 		$menu 	= $this->opt( 'ba_fotos_nav_menu' );
 		$fixpos = $this->opt('ba_fotos_nav_nav_mode');
 		$mode 	= ('fotos-nav-vert-mode' == $fixpos) ? 'sm-vertical' : false;
 		$id 	= $this->get_the_id();
 		$align  = ($this->opt('ba_fotos_nav_align_right')) ? 'pull-right' : false;

		echo '<nav class="fotos-nav" role="navigation">';

			$args = array(
				'menu_class'  	=> 'sm '.$mode.' fotos-nav-menu '.$align.' fotos-nav-menu-'.$id,
				'menu'			=> $menu,
				'depth' 		=> 10,
			);
			wp_nav_menu( $args );

		echo '</nav>';

	}


	// Global Message
	function welcome_global(){

        ob_start();
        ?>
            <div style="color:#444;">
                <p style="border-bottom:1px solid #ccc;margin:0 0 0.75em;"><strong><?php _e('Instructions','fotos');?></strong></p>
                <ul class="unstyled" style="font-size:12px;line-height:14px;">
                    <li style="margin-bottom:7px;"><?php _e('These are the global options for Basiq Nav. Due to the way PageLines sections are handled in DMS, these options have to be global instead of in the section. Options for the individual section can be found by editing the actual section itself on the page.','fotos');?></li>
                </ul>
            </div>
        <?php
        return ob_get_clean();
	}

	// Global Options
 	function fotos_nav_global_opts($settings){

       	$settings[ $this->id ] = array(
            'name'  					=> $this->name,
            'icon'  					=> 'icon-asterisk',
            'pos'   					=> 5,
            'opts'  					=> array(
            	array(
		            'key'               => 'ba_fotos_nav_welcome_global',
		            'type'              => 'template',
		            'title'             => __('Basiq Nav Global Options','fotos'),
		            'template'          => $this->welcome_global()
		        ),
            	array(
	            	'title' 			=> __('Design Options', 'fotos'),
	            	'type'				=> 'multi',
	            	'opts'				=> array(
	            		array(
	            			'key'		=> 'ba_fotos_nav_font_color',
	            			'title'		=> __('Font Color', 'fotos'),
	            			'type'		=> 'color',
	            			'default'	=> '#333',
	            			'help'		=> __('Set a font color.', 'fotos')
	            		),
	            	),
	            ),
            	array(
	            	'title' 			=> __('Font Options', 'fotos'),
	            	'type'				=> 'multi',
	            	'opts'				=> array(
	            		array(
	            			'key'		=> 'ba_fotos_nav_font_size',
	            			'title'		=> __('Font Size', 'fotos'),
	            			'type'		=> 'text',
	            			'help'		=> __('Set a font size.', 'fotos')
	            		),
	            		array(
	            			'key'		=> 'ba_fotos_nav_font_family',
	            			'title'		=> __('Font Family', 'fotos'),
	            			'default'	=> 'open_sans',
	            			'type'		=> 'type',
	            			'help'		=> __('Set a base color.', 'fotos')
	            		),
	            	),
	            ),
            )
        );

        return $settings;
 	}

	function section_opts( ){

		$options = array();

		$options[] = array(
			'col'						=> 8,
			'title'   					=> __('Choose a Menu', 'fotos'),
		    'type'    					=> 'select_menu',
		    'key' 						=> 'ba_fotos_nav_menu',
			'help' 						=> __('Select a menu to use.' , 'fotos'),
		);

		$options[] = array(
			'col'						=> 2,
			'title'   					=> __('Align Right', 'fotos'),
		    'type'    					=> 'check',
		    'key' 						=> 'ba_fotos_nav_align_right',
			'help' 						=> __('Align the menu to the right.' , 'fotos'),
		);

		$options[] = array(
			'col'						=> 8,
			'title'   					=> __('Nav Modes', 'fotos'),
		    'type'    					=> 'select',
		    'key'						=> 'ba_fotos_nav_nav_mode',
		    'opts'						=> array(
		    	'fotos-nav-fixed-top' 	=> array('name' => __('Fixed Top','fotos')),
		    	'fotos-nav-fixed-bott' 	=> array('name' => __('Fixed Bottom','fotos')),
		    	'fotos-nav-vert-mode' 	=> array('name' => __('Vertical Mode','fotos'))
		    ),
			'help' 						=> __('Choose a fixed position for the nav. If "Fixed Bottom" is chosen, sub-menus will drop-up, instead of down. Vertical Mode will run the menu as a vertical menu.' , 'fotos'),
		);

		return $options;

	}

}