<?php
/*
	Section: Blog Slider
	Description: A sliding content section that can use posts, or not, and can run full width.
	Class Name: baFotosBlogSlider
	Version: 1.0
	Filter: full-width, slider
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
		$tran = $this->opt('ba_fotos_blog_slider_transition') ? $this->opt('ba_fotos_blog_slider_transition') : 'fade';
		$speed = $this->opt('ba_fotos_blog_slider_speed') ? $this->opt('ba_fotos_blog_slider_speed') : '6000';
		$showargs = sprintf('data-cycle="fx" data-cycle-timeout="%s" data-cycle-slides="> div" data-cycle-pause-on-hover="true" ',$speed);
		$getheight = $this->opt('ba_fotos_blog_slider_height');
		$height = ($getheight) ? sprintf('style="min-height:%s;"',$this->opt('ba_fotos_blog_slider_height')) : false;

		$output = '';

		printf('<section class="fotos-blog-slider %s"><div class="fotos-blog-slider-show fotos-blog-slider-show-%s" %s %s>',$contentwidth,$id,$showargs,$height);

			$slide_array = $this->opt('ba_fotos_blog_slider_array');

			if( is_array($slide_array) ){

				foreach( $slide_array as $slide ){
					$postimg 	=  pl_array_get('img', $slide);
					$output 	.= sprintf('<div class="fotos-blog-slider-item" style="background:url(\'%s\') no-repeat center center;background-size:cover;min-height:%s;"><div class="fotos-blog-slider-inner-wrap"></div></div>',$postimg,$getheight);
				}

			} else {

				$this->do_defaults();
			}

			printf('%s',$output);

		printf('</div></section>');
	}


	function do_defaults(){

		$output = '';

		for($i=1;$i<=$this->default_limit;$i++):

			$images 	= array(PL_CHILD_URL.'/assets/img/img1.jpg',PL_CHILD_URL.'/assets/img/img2.jpg',PL_CHILD_URL.'/assets/img/img3.jpg');

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
				'key'						=> 'ba_fotos_bs_hi',
				'type'						=> 'template',
				'title'						=> __('Optimal Image Size', 'fotos'),
				'template'					=> $this->recc_width()
			),
			array(
				'key'						=> 'ba_fotos_blog_slider_array',
				'type'						=> 'accordion',
				'title'						=> __('Slide Images', 'fotos'),
				'opts' 						=> array(
					array(
						'key'				=> 'img',
						'label'				=> __( 'Image', 'fotos' ),
						'type'				=> 'image_upload'
					)
				),
				'help'						=> __('Here you can add new images, and reorder existing images by dragging each individual item', 'fotos')
			),
			array(
				'title'             		=> __( 'Slider Height', 'fotos' ),
				'type'	            		=> 'text',
				'key'						=> 'ba_fotos_blog_slider_height',
				'help'						=> __('This default height for the slider is 300px. You can change this by supplying your own height such as <em>500px</em> as an example', 'fotos')
			),
			array(
				'title'             		=> __( 'Make Full Width', 'fotos' ),
				'type'	            		=> 'check',
				'key'						=> 'ba_fotos_blog_slider_full_width',
				'help'						=> __('If you check this box, the slider will stretch 100% across teh screen.','fotos')
			),
			array(
				'title'						=> __('Blog Slider Options', 'fotos'),
				'type'						=> 'multi',
				'key'						=> 'ba_fotos_blog_slider_opts',
				'opts'						=> array(
					array(
						'key'				=> 'ba_fotos_blog_slider_speed',
						'type'				=> 'text',
					),
					array(
						'key'				=> 'ba_fotos_blog_slider_transition',
						'type'				=> 'select',
						'title'				=> __('Slider Transition Type', 'fotos'),
						'opts'				=> array(
							'fade'			=> array('name' => __('Fade', 'fotos')),
							'fadeOut'		=> array('name' => __('Fade Out', 'fotos')),
							'scrollHorz'	=> array('name' => __('Scroll Horizontally', 'fotos'))
						)
					)
				)
			)
		);


		return $options;
	}

}