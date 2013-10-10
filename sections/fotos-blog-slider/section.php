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

		printf('<section class="fotos-blog-slider %s"><div class="fotos-blog-slider-show fotos-blog-slider-show-%s" %s>',$contentwidth,$id,$showargs);

			if ('posts' == $type){
				$this->posts();
			} elseif ('slides' == $type){
				$this->slides();
			} else {
				$this->do_defaults();
			}

		echo '</div></section>';
	}

	function slides(){

		$output = '';
		$count = 1;
		$items = $this->opt('ba_featured_slide_num') ? $this->opt('ba_featured_slide_num') : $this->default_limit;

		$slide_array = $this->opt('fotos_blog_slider_array');

		if( is_array($slide_array) ){

			$slides = count($slide_array);

			foreach( $slide_array as $slide ){
				$postimg 	=  pl_array_get('img', $slide);
				$output 	.= sprintf('<div class="fotos-blog-slider-item" style="background:url(\'%s\') no-repeat center center;background-size:cover"><div class="fotos-blog-slider-inner-wrap">=</div></div>',$postimg);
			
				$count++;
			}

		}

		printf('%s',$output);

	}

	function posts(){

		global $post;
		$theids = $this->opt('ba_fotos_blog_slider_post_ids');
		$ids = array_map('intval',explode(',',$theids));
		$contentwidth = ($this->opt('ba_fotos_blog_slider_full_width')) ? '' : 'pl-content';

		$args = array(
			'post__in' => $ids,
			'posts_per_page' => 3,
			'orderby' => 'post__in'
		);
		$q = new wp_query($args);

		if($q->have_posts()):

			while($q->have_posts()) : $q->the_post();

				$postimg 	= wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
				$link       = sprintf('<a class="fotos-blog-slider-link" href="%s" title="Continue Reading"><i class="icon-angle-right"></i></a>',get_permalink());
				$desc       = sprintf('<p class="fotos-blog-slider-subtitle">%s%s</p>',get_the_excerpt(),$link);
				$heading    = sprintf('<h2 class="fotos-blog-slider-title">%s</h2>',get_the_title());

				?>
					<div class="fotos-blog-slider-item" style="background:url('<?php echo $postimg[0];?>') no-repeat center center;background-size:cover">
						<?php printf('<div class="fotos-blog-slider-inner-wrap"></div>');?>
					</div>
				<?php

				endwhile;

				wp_reset_query();

		else:
			echo 'Please provide a few post ID\'s to start the show';

		endif;

	}

	function do_defaults(){

		$items = $this->opt('ba_featured_slide_num') ? $this->opt('ba_featured_slide_num') : $this->default_limit;

		$output = '';

		for($i=1;$i<=$items;$i++):

			$images 	= array(PL_CHILD_URL.'/assets/img/img1.jpg',PL_CHILD_URL.'/assets/img/img2.jpg',PL_CHILD_URL.'/assets/img/img3.jpg');
			
			$link       = sprintf('<a class="fotos-blog-slider-link" href="#" title="Continue Reading"><i class="icon-angle-right"></i></a>');
			$desc       = sprintf('<p class="fotos-blog-slider-subtitle">Wow awesome</p>');
			$heading    = sprintf('<h2 class="fotos-blog-slider-title">That\'s what she said.</h2>');

			$output		.= sprintf('<div class="fotos-blog-slider-item" style="background:url(\'%s\') no-repeat center center;background-size:cover;"><div class="fotos-blog-slider-inner-wrap"></div></div>',$images[array_rand($images)]);

		endfor;

		echo $output;

	}

	function section_opts(){

		$type = $this->opt('ba_fotos_blog_slider_type');
		$options = array();

		$options[] = array(
			'key' 					=> 'ba_fotos_blog_slider_type',
			'title' 				=> __('Slider Mode','fotos'),
			'type' 					=> 'select',
			'default'				=> 'slides',
			'opts'					=> array(
				'slides' 			=> array('name' => __('Slider Mode','fotos')),
				'posts'				=> array('name'	=> __('Posts Mode','fotos'))
			),
		);

		if ('posts' == $type){

			$options[] = array(
				'key' 				=> 'ba_fotos_blog_slider_post_ids',
				'title' 			=> __('Posts Mode','fotos'),
				'type' 				=> 'text',
				'label'				=> __('Post ID\'s','fotos'),
				'help'				=> __('Enter the IDs of the posts you wish to show. Posts will be shown in the order entered.', 'fotos')
			);

		} else {

			$items = $this->opt('ba_featured_slide_num') ? $this->opt('ba_featured_slide_num') : $this->default_limit;

			$options[] = array(
				'key'			  	=> 'ba_featured_slide_num',
				'type' 			  	=> 'count_select',
				'count_start'	  	=> 1,
				'count_number'	  	=> 10,
				'default'		  	=> 3,
				'label' 	      	=> __( 'Number of Slides to Configure', 'fotos' ),
			);

			$options[] = array(
				'key'	=> 'fotos_blog_slider_array',
				'type'	=> 'accordion',
				'title'	=> 'Slides Setup',
				'col'	=> 4,
				'opts' => array(
					array(
						'key'		=> 'img',
						'label'		=> __( 'Image', 'fotos' ),
						'type'		=> 'image_upload'
					),

				),

			);

		}


		$options[] = array(
			'title'             	=> __( 'Width Options', 'fotos' ),
			'type'	            	=> 'multi',
			'opts'	            	=> array(
				array(
					'key'			=> 'ba_fotos_blog_slider_full_width',
					'type' 			=> 'check',
					'title' 		=> __( 'Enable Full Width', 'fotos' ),
				),
			)
		);


		return $options;
	}

}