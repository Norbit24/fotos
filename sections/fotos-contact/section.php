<?php
/*
	Section: Contact
	Description: A simple contact form.
	Class Name: baFotosContact
	Version: 1.0
	Filter: component
*/

class baFotosContact extends PageLinesSection{

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

		$form = new fotosContact;

		printf('<div class="ba-fotos-contact-form-wrap">%s</div>',$form->form());

	}

}