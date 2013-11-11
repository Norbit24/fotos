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

		$type 			= $this->opt('ba_fotos_blog_slider_type');
		$id 			= $this->get_the_id();
		$contentwidth 	= $this->opt('ba_fotos_blog_slider_full_width') ? false : 'pl-content';
		$tran 			= $this->opt('ba_fotos_blog_slider_transition') ? $this->opt('ba_fotos_blog_slider_transition') : 'fade';
		$speed 			= $this->opt('ba_fotos_blog_slider_speed') ? $this->opt('ba_fotos_blog_slider_speed') : '6000';
		$showargs 		= sprintf('data-cycle="fx" data-cycle-timeout="%s" data-cycle-slides="> div" data-cycle-pause-on-hover="true" ',$speed);
		$getheight 		= $this->opt('ba_fotos_blog_slider_height');
		$height 		= ($getheight) ? sprintf('style="min-height:%s;"',$getheight) : false;

		// Get Styles
		$overbgcolor 	= $this->opt('ba_fotos_blog_slider_overlay_bg_color') ? sprintf('background:%s;',pl_hashify($this->opt('ba_fotos_blog_slider_overlay_bg_color'))) : false;
		$overtxtcolor 	= $this->opt('ba_fotos_blog_slider_overlay_text_color') ? sprintf('color:%s;',pl_hashify($this->opt('ba_fotos_blog_slider_overlay_text_color'))) : false;
		$overpad 		= $this->opt('ba_fotos_blog_slider_overlay_padding') ? sprintf('padding:%s;',$this->opt('ba_fotos_blog_slider_overlay_padding')) : false;
		$overwidth 		= $this->opt('ba_fotos_blog_slider_overlay_width') ? sprintf('width:%s;',$this->opt('ba_fotos_blog_slider_overlay_width')) : false;

		// Crop Mode
		$bgcrop			= $this->opt('ba_fotos_blog_slider_crop') ? $this->opt('ba_fotos_blog_slider_crop') : 'cover';

		// Combine styles
		$overlaystyles = ($overbgcolor || $overtxtcolor || $overpad || $overwidth) ? sprintf('style="%s%s%s%s"',$overbgcolor,$overtxtcolor,$overpad,$overwidth) : false;

		// Get Position
		$overposition 	= $this->opt('ba_fotos_blog_slider_overlay_position') ? $this->opt('ba_fotos_blog_slider_overlay_position') : 'left';

		// Do Overlay, Content, Position, and Styles
		$overlayhtml 	= $this->opt('ba_fotos_blog_slider_overlay_html');
		$overlay 		= ($overlayhtml) ? sprintf('<div class="fotos-blog-slider-overlay %s" %s>%s</div>',$overposition,$overlaystyles,$overlayhtml) : false;


		$output = '';

		printf('<section class="fotos-blog-slider %s">%s<div class="fotos-blog-slider-show fotos-blog-slider-show-%s" %s %s>',$contentwidth,$overlay,$id,$showargs,$height);

			$slide_array = $this->opt('ba_fotos_blog_slider_array');

			if( is_array($slide_array) ){

				foreach( $slide_array as $slide ){
					$postimg 	=  pl_array_get('img', $slide);
					$output 	.= sprintf('<div class="fotos-blog-slider-item" style="background:url(\'%s\') no-repeat center center;background-size:%s;min-height:%s;"><div class="fotos-blog-slider-inner-wrap"></div></div>',$postimg,$bgcrop,$getheight);
				}

			} else {

				$this->do_defaults();
			}

			printf('%s',$output);

		printf('</div></section>');
	}


	function do_defaults(){

		$output = '';

		for($i=1;$i<=3;$i++):

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

		$out = sprintf(__('Based on the width of your site, and the Slider Height below, your optimal image size is <strong>%s x %s</strong>.','fotos'), $widthclean, $heightclean);

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
				'post_type'					=> __('Image','fotos'),
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
				'help'						=> __('If you check this box, the slider will stretch 100% across the screen.','fotos')
			),
			array(
				'title'						=> __('Blog Slider Overlay HTML', 'fotos'),
				'type'						=> 'textarea',
				'key'						=> 'ba_fotos_blog_slider_overlay_html',
				'help'						=> __('Anything you place in here will activate the overlay. You can put anything here, including HTML (don\'t be scared)!','fotos')
			),
			array(
				'title'						=> __('Blog Slider Overlay Colors', 'fotos'),
				'type'						=> 'multi',
				'key'						=> 'ba_fotos_blog_slider_overlay_colors',
				'opts'						=> array(
					array(
						'key'				=> 'ba_fotos_blog_slider_overlay_bg_color',
						'type'				=> 'color',
						'title'				=> __('Overlay Background Color', 'fotos')
					),
					array(
						'key'				=> 'ba_fotos_blog_slider_overlay_text_color',
						'type'				=> 'color',
						'color'				=> '#333',
						'title'				=> __('Overlay Text Color', 'fotos')
					)
				)
			),
			array(
				'title'						=> __('Blog Slider Overlay Design', 'fotos'),
				'type'						=> 'multi',
				'key'						=> 'ba_fotos_blog_slider_overlay_design',
				'opts'						=> array(
					array(
						'key'				=> 'ba_fotos_blog_slider_overlay_width',
						'type'				=> 'text',
						'title'				=> __('Overlay Width', 'fotos')
					),
					array(
						'key'				=> 'ba_fotos_blog_slider_overlay_position',
						'type'				=> 'select',
						'title'				=> __('Overlay Position', 'fotos'),
						'default'			=> 'left',
						'opts'				=> array(
							'left'			=> array('name' => __('Left', 'fotos')),
							'right'			=> array('name' => __('Right', 'fotos')),
							'center'		=> array('name' => __('Centered', 'fotos')),
							'quart-left'	=> array('name' => __('1/4 Left', 'fotos')),
							'quart-right'	=> array('name' => __('1/4 Right', 'fotos'))
						)
					),
					array(
						'key'				=> 'ba_fotos_blog_slider_overlay_padding',
						'type'				=> 'text',
						'title'				=> __('Overlay Outer Padding', 'fotos')
					)
				)
			),
			array(
				'title'						=> __('Blog Slider Options', 'fotos'),
				'type'						=> 'multi',
				'key'						=> 'ba_fotos_blog_slider_opts',
				'opts'						=> array(
					array(
						'key'				=> 'ba_fotos_blog_slider_speed',
						'type'				=> 'text',
						'title'				=> __('Transition Speed', 'fotos')
					),
					array(
						'key'				=> 'ba_fotos_blog_slider_transition',
						'type'				=> 'select',
						'title'				=> __('Slider Transition Type', 'fotos'),
						'default'			=> 'fade',
						'opts'				=> array(
							'fade'			=> array('name' => __('Fade', 'fotos')),
							'fadeOut'		=> array('name' => __('Fade Out', 'fotos')),
							'scrollHorz'	=> array('name' => __('Scroll Horizontally', 'fotos'))
						)
					)
				)
			),
			array(
				'key'				=> 'ba_fotos_blog_slider_crop',
				'type'				=> 'select',
				'title'				=> __('Blog Slider Crop Options', 'fotos'),
				'default'			=> 'cover',
				'opts'				=> array(
					'cover'			=> array('name' => __('Cover', 'fotos')),
					'contain'		=> array('name' => __('Contain', 'fotos'))
				),
				'desc'				=> __('Cover will fit any size image and scale across the size of the slider. Contain will constrain your image to the size of the slider, but will respect your image aspect ratio.', 'fotos')
			)
		);


		return $options;
	}

}