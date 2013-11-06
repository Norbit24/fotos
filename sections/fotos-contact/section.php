<?php
/*
	Section: Contact
	Description: A simple contact form.
	Class Name: baFotosContact
	Version: 1.0
	Filter: component
*/

class baFotosContact extends PageLinesSection{

	function section_persistent(){

	}

	function section_head(){
		?>
		<script>
		jQuery(document).ready(function(){

			// first check to see if teh "contact" class exists before we do anything else
			if(jQuery('.fotos-nav-menu li, .simplenav li').hasClass('contact')) {

				// add collapse class to the section
				jQuery('.section-fotos-contact').addClass('collapse');

				// get id from the contact section added to page
				getid = jQuery('.section-fotos-contact').attr('id');

				// format the id with a hash so it can be linked
				id = '#'+ getid +'';

				// get the target
				target = jQuery('.fotos-nav-menu .contact a, .simplenav .contact a');

				// set the target and atts to make it toggle
				jQuery(target).attr('href',id).attr('data-target',''+id+'').attr('data-toggle','collapse');

				// click function
				jQuery(target).click(function(e){
					e.preventDefault();
				});
			}
		});
		</script>
		<?php

	}

	function section_template(){

		$formclass = new fotosContact;
		$area 		= $this->opt('ba_fotos_contact_sb_area');
		$layout 	= $this->opt('ba_fotos_contact_form_layout') ? 'contact-align-swap' : false;

		?>
		<div class="ba-fotos-contact-form-wrap <?php echo $layout;?> row">
			<div class="span6 zmb ba-fotos-contact-has-sb">

			<?php

				if($area):
					pagelines_draw_sidebar($area);
				else:
					echo setup_section_notify($this);
				endif;

			?>

			</div>
			<div class="span6 zmb ba-fotos-contact-has-form">

			<?php echo $formclass->form(); ?>

			</div>
		</div>
		<?php

	}

	function section_opts(){

		$opts = array(
			array(
				'key'		=> 	'ba_fotos_contact_sb_area',
				'type'		=> 	'select',
				'opts'		=>	get_sidebar_select(),
				'title'		=> 	__('Select Widget Area', 'fotos'),
				'label'		=>	__('Select a widget area', 'fotos'),
				'help'		=>  __('Select the widget area you would like to use.', 'fotos')
			),
			array(
				'key'		=> 	'ba_fotos_contact_help',
				'type'		=> 	'link',
				'url'		=> 	admin_url( 'widgets.php' ),
				'title'		=> 	__('Widget Areas Help', 'fotos'),
				'label'		=>	__('<i class="icon-retweet"></i> Edit Widget Areas', 'fotos'),
				'help'		=> 	__('This section uses widgetized areas that are created and edited in inside your admin.', 'fotos'),
			),
			array(
				'key'		=> 	'ba_fotos_contact_form_layout',
				'type'		=> 	'check',
				'title'		=> 	__('Form Alignment', 'fotos'),
				'help'		=> 	__('Ticking this will make the form move to the left, with the widget area on the right.','fotos')
			)
		);

		if(!class_exists('CustomSidebars')){
			$opts[] = array(
				'key'		=> 'ba_fotos_contact_sb_custom_sidebars',
				'type'		=> 'link',
				'url'		=> 'http://wordpress.org/extend/plugins/custom-sidebars/',
				'title'		=> __('Get Custom Sidebars', 'fotos'),
				'label'		=> __('<i class="icon-external-link"></i> Check out plugin','fotos'),
				'help'		=> __('We have detected that you don\'t have the Custom Sidebars plugin installed. We recommend you install this plugin to create custom widgetized areas on demand.', 'fotos')
			);
		}

		return $opts;
	}
}