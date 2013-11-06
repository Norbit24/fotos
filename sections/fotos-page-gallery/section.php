<?php
/*
	Section: Page Gallery
	Author: Nick Haskins
	Author URI: http://nickhaskins.co
	Description: Creates a gallery with multiple layouts
	Class Name: fwGallery
	Workswith: templates, main
*/

class fwGallery extends PageLinesSection {

	const version = '1.0';

	function section_scripts(){
		wp_enqueue_script('fotos_gallery',PL_CHILD_URL.'/assets/js/jquery.flexslider-min.js',array('jquery'),self::version, true);
	}

	function section_head(){

		$images = get_field('fotos_page_gallery', get_the_ID());

		if($images):
			?><script>
				jQuery(window).load(function() {
					<?php if ($this->opt('fw_defgallery_dothumbs')){?>
					  jQuery('#default-gallery-thumbs').flexslider({
					    animation: "slide",
					    controlNav: false,
					    animationLoop: true,
					    slideshow: false,
					    itemWidth: 100,
					    itemMargin: 0,
					    asNavFor: '#default-gallery-deck',
					    namespace: "gall-",
					  });
				  	<?php } ?>
					  jQuery('#default-gallery-deck').flexslider({
					    animation: 'fade',
					    controlNav: false,
					    smoothHeight: true,
					    animationSpeed: 400,
					    animationLoop: true,
					    slideshow: false,
					    slideshowSpeed: 5000,
					    <?php if ($this->opt('fw_defgallery_dothumbs')){ ?>
					    sync: "#default-gallery-thumbs",
					    <?php } ?>
					    namespace: "gall-",
					  });

				  jQuery('.no-js .slides').removeClass('li:first-child');

				});
		    </script><?php
		endif;
	}

   	function section_template() {


		$images = get_field('fotos_page_gallery', get_the_ID());

		if(!$images){

			echo setup_section_notify($this);

		} else {
			?><div id="default-gallery-deck" class="gallslider"><ul class="unstyled slides"><?php

				foreach($images as $image) {

					$getlink  = $image['description'];
		            $getimg	  = $image['sizes']['thumbnail'];
		            $getlgimg = $image['sizes']['large'];
		            $getalt   = $image['alt'];
		            $getcap   = $image['caption'];

					printf('<li><img src="%s" alt="%s" /></li>',$getlgimg,$getalt);

				} ?></ul></div><?php

			if($this->opt('fw_defgallery_dothumbs')) {
				?><div id="default-gallery-thumbs" class="gallslider"><ul class="unstyled slides"><?php

					foreach($images as $image) {

						$getlink  = $image['description'];
		            	$getimg	  = $image['sizes']['thumbnail'];
		            	$getlgimg = $image['sizes']['large'];
		            	$getalt   = $image['alt'];
		            	$getcap   = $image['caption'];

					    printf('<li><img src="%s" alt="%s" /></li>',$getimg,$getalt);

					}

				?></ul></div>
			<?php }
		}
	}

	function section_opts(){

		$opts = array(
          	array(
                'key'       	=> 'fw_edit_post_content',
                'type'      	=> 'edit_post',
                'title'     	=> __( 'Create Gallery', 'fotos' ),
                'label'     	=> __( '<i class="icon-edit"></i> Upload Images', 'fotos' ),
                'help'      	=> __( 'Create a gallery by uploading some images.', 'fotos' ),
                'classes'   	=> 'btn-primary'
            ),
			array(
				'key' 			=> 'fw_defgallery_config',
				'title'   		=> __('Simple Gallery Options', 'fotos'),
				'type'    		=> 'multi',
				'col'			=> 6,
				'opts' 			=> array(
					array(
						'key' 	=> 'fw_defgallery_dothumbs',
						'type'  => 'check',
						'label' => __('Show Thumbnails', 'fotos')
					)
				)
			)
		);

		return $opts;
	}

}
