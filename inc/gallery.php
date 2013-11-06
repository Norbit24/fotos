<?php
/**
 	* Gallery Shortcode Class
 	*
 	* @package     Fotos Theme
 	* @subpackage  Gallery Shortcode [gallery]
 	* @copyright   Copyright (c) 2013, Nick Haskins & CO
 	* @since       1.0
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class baFotosGallery {

	function __construct(){

		remove_shortcode('gallery', array($this,'gallery_shortcode'));
		add_shortcode('gallery',	array($this,'fotos_gallery_shortcode'));
	}

	function fotos_gallery_shortcode($atts) {

		// Get Meta Opts
	  	global $post;
	 	$output 	= apply_filters('post_gallery','', $atts);
	 	$id 		= get_the_ID();
	 	$thumbs 	= get_field('hide_thumbnails', $id);
	 	$lb 		= get_field('enable_lightbox', $id);
	 	$type 		= get_field('gallery_style', $id);
	 	$ratio 		= get_field('slideshow_image_ratio',$id);

	 	// Photoset Opts
	 	$gutter = '0px';
		$speed = '350';
		$opacity = '0.85';
		$transition = 'elastic';

	 	// Enqueue flexslider
	 	if ('photoset' == $type) {

        	wp_enqueue_script( 'fotos-fotoset',  PL_CHILD_URL.'/assets/js/jquery.photoset-grid.min.js', array('jquery'),true);
        	wp_enqueue_script( 'fotos-swipe',  PL_CHILD_URL.'/assets/js/jquery.touchSwipe.min.js', array('jquery'),true);

	 	} elseif ('standard' == $type) {

	 		wp_enqueue_script('fotos-gallery',PL_CHILD_URL.'/assets/js/jquery.flexslider-min.js',array('jquery'),true);

	 	} elseif ('slideshow' == $type) {

       		wp_enqueue_script('fotos-slideshow', PL_CHILD_URL.'/assets/js/fotorama.js', array('jquery'), true );
        	wp_enqueue_style('fotos-slideshow-css',PL_CHILD_URL.'/assets/js/fotorama.min.css', true );
        }

	 	// Enqueue Colorbox
	 	if ($lb) {
	 		wp_enqueue_script('fotos-lightbox',PL_CHILD_URL.'/libs/colorbox/jquery.colorbox-min.js',array('jquery'),true);
	 	}

	 	if ('photoset' == $type) { ?>

	 		<!-- Fotos Photoset -->
			<script>
			jQuery(window).load(function(){

				jQuery('#post-<?php echo $id;?> .fotos-photoset').photosetGrid({
				  	gutter: '<?php echo $gutter;?>',
				  	rel: 'fotos-photoset',
					<?php if($lb) { ?>
				  	highresLinks:true,
				  	onComplete: function(){
					    jQuery('#post-<?php echo $id;?> .fotos-photoset').attr('style', '');
					    jQuery('#post-<?php echo $id;?> .fotos-photoset a').colorbox({
					      	photo: true,
					      	scalePhotos: true,
					      	maxHeight:'90%',
					      	maxWidth:'90%',
					      	className: 'fotos-photoset-lb-bg',
					      	transition:'<?php echo $transition;?>',
					      	speed: '<?php echo $speed;?>',
					      	opacity: '<?php echo $opacity;?>',
					    });
					    <?php if($captions) { ?>
						    jQuery(".fotos-photoset img").each(function(){
								caption = jQuery(this).attr('alt');
								title = jQuery(this).attr('data-title');
								jQuery(this).after('<span class="ba-gridly-caption"><span class="ba-gridly-caption-title">' + title + '</span><span class="ba-gridly-caption-caption">' + caption +'</span></span>');
								jQuery('.ba-gridly-caption').hide().fadeIn();
							});
						<?php } ?>
					}
				  	<?php } ?>
				});

				<?php if($lb) { ?>
				    jQuery("#colorbox").swipe( {
				        //Generic swipe handler for all directions
				        swipeLeft:function(event, direction, distance, duration, fingerCount) {
				           jQuery.colorbox.prev();
				        },
				        swipeRight:function(event, direction, distance, duration, fingerCount) {
				           jQuery.colorbox.next();
				        },
				        //Default is 75px, set to 0 for demo so any distance triggers swipe
				       threshold:0
				    });
			    <?php } ?>

			});
			</script>

	 	<?php } elseif('standard' == $type) { ?>
			<!-- Fotos Gallery -->
			<script>
				jQuery(window).load(function() {

					<?php if(!$thumbs) { ?>
					  	jQuery('#fotos-gallery-thumbs-<?php echo $id;?>').flexslider({
						    animation: "slide",
						    controlNav: false,
						    directionNav:true,
						    animationLoop: true,
						    slideshow: false,
						    itemWidth: 125,
						    itemMargin: 5,
						    asNavFor: '#fotos-gallery-deck-<?php echo $id;?>',
						    namespace: "gall-",
					  	});
					<?php } ?>

				  	jQuery('#fotos-gallery-deck-<?php echo $id;?>').flexslider({
					    animation: 'fade',
					    controlNav: false,
					    directionNav:true,
					    smoothHeight: true,
					    animationSpeed: 400,
					    animationLoop: true,
					    slideshow: false,
					    slideshowSpeed: 5000,
					    sync: "#fotos-gallery-thumbs-<?php echo $id;?>",
					    namespace: "gall-",
				  	});

				  	jQuery('.no-js .slides').removeClass('li:first-child');

				  	// if lightbox do colorbox instantiation
				  	<?php if ($lb) { ?>

				  		jQuery('#fotos-gallery-deck-<?php echo $id;?> .fotos-lb-gallery').colorbox({
				  			rel: '#photo-group-<?php echo $id;?>'
				  		});

				  	<?php } ?>

				});
			</script>

		<?php } elseif('slideshow' == $type) { ?>

			<!-- Fotos Slideshow -->
			<script>
				jQuery(window).load(function() {
					var fotorama = jQuery('#post-<?php echo $id;?> .fotorama').data('fotorama');
					var height = jQuery('#post-<?php echo $id;?> .fotorama').height();
					jQuery('.fotos-fotorama-play').on('click', function (e) {
						e.preventDefault();
					  	fotorama.startAutoplay(3000);
					  	jQuery('#post-<?php echo $id;?> .fotos-fotorama-overlay-inner').fadeOut(800);
					  	jQuery('#post-<?php echo $id;?> .fotorama__fullscreen-icon').fadeIn(800);
					});
					jQuery('.fotos-fotorama-fs').on('click', function (e) {
						e.preventDefault();
					  	fotorama.requestFullScreen();
					  	jQuery('#post-<?php echo $id;?> .fotos-fotorama-overlay-inner').fadeOut(800);
					  	jQuery('#post-<?php echo $id;?> .fotorama__fullscreen-icon').fadeIn(800);
					});
					<?php if(get_field('fotos_slideshow_cover',$id)) { ?>
						jQuery('#post-<?php echo $id;?> .fotos-fotorama-overlay-outer').css({'min-height':height});
					<?php } ?>
				});
			</script>

		<?php }

		$shortcode_args = shortcode_parse_atts($this->get_match('/\[gallery\s(.*)\]/isU', $post->post_content));

		$ids = $shortcode_args["ids"];

		$args = array(
			'include' 			=> $ids,
	        'post_status' 		=> 'inherit',
	        'post_type' 		=> 'attachment',
        	'post_mime_type' 	=> 'image',
        	'order' 			=> 'menu_order ID',
        	'orderby' 			=> 'post__in', //required to order results based on order specified the "include" param
        );

		$images = get_posts($args);

		ob_start();

		switch($type) {
			case 'photoset';
				$this->do_photoset($images);
				break;
			case 'standard';
				$this->do_standard($images);
				break;
			case 'slideshow';
				$this->do_slideshow($images);
				break;
			default;
				$this->do_standard($images);
				break;
		}

		return ob_get_clean();
	}

	// Draw Photoset
	function do_photoset($images){

		$id 			= get_the_ID();

		$photosetlayout = get_field('photoset_layout', $id);

		?><div class="fotos-photoset-wrap"><div class="fotos-photoset" data-layout="<?php echo $photosetlayout;?>"><?php

			foreach($images as $image){

				$pic 	= wp_get_attachment_thumb_url($image->ID, 'medium', false, '');
				$hires 	= wp_get_attachment_url($image->ID, 'full', false,'');
				$alt 	= get_post_meta($image->ID, '_wp_attachment_image_alt', true);
				$title 	= $image->post_title;
				$image 	= sprintf('<img src="%s" data-highres="%s" data-title="%s" alt="%s">',$pic,$hires,$title,$alt);

				printf('%s',$image);

			}

		?></div></div><?php
	}

	// Draw Standard Gallery
	function do_standard($images){

		$id 		= get_the_ID();
	 	$thumbs 	= get_field('hide_thumbnails', $id);
	 	$lb 		= get_field('enable_lightbox', $id);

		?>
		<div id="fotos-gallery-deck-<?php echo $id;?>" class="gallslider">
			<ul class="slides">
				<?php foreach($images as $image) {

					$getimg = wp_get_attachment_url($image->ID, 'full', false,'');
					$getimgalt = get_post_meta($image->ID, '_wp_attachment_image_alt', true);

					if($lb) {
						printf('<li><a rel="#photo-group-%s" class="fotos-lb-gallery" href="%s"><img src="%s" alt="%s" /></a></li>',$id,$getimg,$getimg,$getimgalt);
					} else {
						printf('<li><img src="%s" alt="%s" /></li>',$getimg,$getimgalt);
					}

				} ?>
			</ul>
		</div>

		<?php if(!$thumbs) { ?>
			<div id="fotos-gallery-thumbs-<?php echo $id;?>" class="gallslider thumbs">
				<ul class="slides">
					<?php foreach($images as $image) {
					    printf(
							'<li><img src="%s" alt="%s"/></li>',
							wp_get_attachment_thumb_url($image->ID, 'thumbnail', false, ''),
							get_post_meta($image->ID, '_wp_attachment_image_alt', true)
						);
					} ?>
				</ul>
			</div>
		<?php }
	}

	// Draw Full Screen Slideshow
	function do_slideshow($images){

		$id 		= get_the_ID();
		$ratio 		= get_field('slideshow_image_ratio',$id);
		?>
		<div class="fotos-fotorama-wrap">

		<?php

			$getsstitle = get_field('slideshow_title',$id);
			$getsssub 	= get_field('slideshow_subtitle',$id);
			$getcover 	= get_field('slideshow_cover',$id);
			$getbgcolor = get_field('slideshow_overlay_background_color',$id) ? get_field('slideshow_overlay_background_color',$id) : false;
			$txtcolor 	= get_field('slideshow_overlay_text_color',$id) ? get_field('slideshow_overlay_text_color',$id) : false;

			$sstitle 	= ($getsstitle) ? sprintf('<h3 class="fotos-fotorama-title">%s</h3>',$getsstitle) : sprintf('<h3 class="fotos-fotorama-title">%s</h3>',get_the_title());
			$sssub 		= ($getsssub) ? sprintf('<p class="fotos-fotorama-subtitle">%s</p>',$getsssub) : sprintf('<p class="fotos-fotorama-subtitle">At the beautiful mansion on the beach!</p>');

			$cover 		= $getcover ? sprintf('style="background:url(\'%s\') center center no-repeat;background-size:cover;"',$getcover) : false;

			$fs 		= sprintf('<a href="#" class="fotos-fotorama-fs"><i class="icon-resize-full"></i></a>');
			$play 		= sprintf('<a href="#" class="fotos-fotorama-play"><i class="icon-play"></i></a>');

			$heading 	= sprintf('<div class="fotos-fotorama-info span10 zmb">%s%s</div>',$sstitle,$sssub);
			$controls 	= sprintf('<div class="fotos-fotorama-controls span2 zmb">%s%s</div>',$play,$fs);

			$styles 	= ($getbgcolor || $txtcolor) ? sprintf('background:%s;color:%s;',$getbgcolor,$txtcolor) : false;

			printf('<div class="fotos-fotorama-overlay-outer" %s ><div class="fotos-fotorama-overlay-inner row" style="%s" >%s%s</div>',$cover,$styles,$heading,$controls);

		?>

        <div class="fotorama" data-width="100%" data-ratio="3/2" data-keyboard="true" data-allow-full-screen="native" data-click="true" data-nav="false" data-arrows="false" data-autoplay="false" data-ratio="<?php echo $ratio;?>"><?php
            foreach($images as $image) {

                $full    =  wp_get_attachment_url($image->ID, 'full', false,'');
                $alt     =  get_post_meta($image->ID, '_wp_attachment_image_alt', true);
                $caption =  $image->post_excerpt;
                $desc    =  $image->post_content;

                if($caption) {

               		?><img src="<?php echo $full;?>" data-caption="<?php $caption;?>" alt="<?php $alt;?>"><?php

                } else {

                    ?><img src="<?php echo $full;?>" alt="<?php $alt;?>"><?php
                }
            }
        ?></div></div><?php
	}

	// regex helper
	function get_match( $regex, $content ) {
	    preg_match($regex, $content, $matches);
	    return $matches[1];
	}

}
new baFotosGallery;