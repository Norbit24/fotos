<?php
/*
	Section: Blog Slider
	Description: A sliding content section that can use posts, or not, and can run full width.
	Class Name: baFotosBlogSlider
	Version: 1.0
	Filter: full-width
*/

class baFotosBlogSlider extends PageLinesSection{

	const version = '1.0';
	var $default_limit = 3;

	function before_section_template($clone_id = null) {

		if($this->opt('ba_fotos_blog_slider_full_width')):
			$this->wrapper_classes['background'] = 'fotos-full-width';
		else:
			$this->wrapper_classes['background'] = 'fotos-content-width';
		endif;
	}

	function section_scripts(){
		wp_enqueue_script('fotos-slider',$this->base_url.'/jquery.cycle2.min.js',array('jquery'), self::version, true);
	}

	function section_head(){ ?>
		<script>
			jQuery(document).ready(function(){
				jQuery('.fotos-blog-slider-show.fotos-blog-slider-show-<?php echo $this->get_the_id();?>').cycle();
			});
		</script>
	<?php }

	function section_template(){

		$type = $this->opt('ba_fotos_blog_slider_type');
		$id = $this->get_the_id();
		$contentwidth = ($this->opt('ba_fotos_blog_slider_full_width')) ? false : 'pl-content';
		$tran = $this->opt('ba_featured_transition') ? $this->opt('ba_featured_transition') : 'fade';
		$speed = $this->opt('ba_featured_speed') ? $this->opt('ba_featured_speed') : '6000';
		$showargs = sprintf('data-cycle="fx" data-cycle-timeout="%s" data-cycle-slides="> div" data-cycle-pause-on-hover="true" ',$speed);
		$height = $this->opt('ba_fotos_blog_slider_height') ? sprintf('style="min-height:%s;"',$this->opt('ba_fotos_blog_slider_height')) : false;

		$output = '';

		printf('<section class="fotos-blog-slider %s"><div class="fotos-blog-slider-show fotos-blog-slider-show-%s" %s %s>',$contentwidth,$id,$showargs,$height);

			$slide_array = $this->opt('fotos_blog_slider_array');

			if( is_array($slide_array) ){

				foreach( $slide_array as $slide ){
					$postimg 	=  pl_array_get('img', $slide);
					$output 	.= sprintf('<div class="fotos-blog-slider-item" style="background:url(\'%s\') no-repeat center center;background-size:cover"><div class="fotos-blog-slider-inner-wrap"></div></div>',$postimg);
				}

			} else {

				echo setup_section_notify($this);
			}

			printf('%s',$output);

		printf('</div></section>');
	}


	function do_defaults(){

		$items = $this->opt('ba_featured_slide_num') ? $this->opt('ba_featured_slide_num') : $this->default_limit;

		$output = '';

		for($i=1;$i<=$items;$i++):

			$images 	= array(PL_CHILD_URL.'/assets/img/img1.jpg',PL_CHILD_URL.'/assets/img/img2.jpg',PL_CHILD_URL.'/assets/img/img3.jpg');
			$link       = sprintf('<a class="fotos-blog-slider-link" href="#" title="Continue Reading"><i class="icon-angle-right"></i></a>');
			$desc       = sprintf('<p class="fotos-blog-slider-subtitle">Wow awesome</p>');
			$heading    = sprintf('<h2 class="fotos-blog-slider-title">That\'s what she said.</h2>');

			$output		.= sprintf('<div class="fotos-blog-slider-item" style="background:url(\'%s\') no-repeat center center;background-size:cover;"></div>',$images[array_rand($images)]);

		endfor;

		echo $output;

	}

	function recc_width(){

		$width = (pl_setting( 'content_width_px' ));
		$height = $this->opt('ba_fotos_blog_slider_height') ? $this->opt('ba_fotos_blog_slider_height') : '300px';

		$widthclean = str_replace('px', '', $width);
		$heightclean = str_replace('px', '', $height);

		$out = sprintf('Based on the width of your site, and the Slider Height below, your optimal image size is <strong>%s x %s</strong>.', $widthclean, $heightclean);

		return $out;
	}

	function section_opts(){

		$options = array(
			array(
				'key'				=> 'fotos_bs_hi',
				'type'				=> 'template',
				'title'				=> __('Optimal Image Size', 'fotos'),
				'template'			=> $this->recc_width()
			),
			array(
				'key'				=> 'fotos_blog_slider_array',
				'type'				=> 'accordion',
				'title'				=> __('Slide Images', 'fotos'),
				'col'				=> 4,
				'opts' 				=> array(
					array(
						'key'		=> 'img',
						'label'		=> __( 'Image', 'fotos' ),
						'type'		=> 'image_upload'
					)
				),
				'help'				=> __('Here you can add new images, and reorder existing images by dragging each individual item', 'fotos')
			),
			array(
				'title'             => __( 'Slider Height', 'fotos' ),
				'type'	            => 'text',
				'key'				=> 'ba_fotos_blog_slider_height',
				'help'				=> __('This default height for the slider is 420px. You can change this by supplying your own height such as <em>500px</em> as an example', 'fotos')
			),
			array(
				'title'             => __( 'Make Full Width', 'fotos' ),
				'type'	            => 'check',
				'key'				=> 'ba_fotos_blog_slider_full_width',
				'help'				=> __('If you check this box, the slider will stretch 100% across teh screen.','fotos')
			)
		);


		return $options;
	}

}