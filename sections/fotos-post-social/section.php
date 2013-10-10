<?php
/*
Section: Post Social
Author: Nick Haskins
Author URI: http://nickhaskins.co
Version: 1.0
Description: Displays social links
Class Name: fotosPostSocial
Loading: active
*/

class fotosPostSocial extends PageLinesSection {


 	function section_template() {

		global $post;

		if( ! is_object( $post ) )
			return;
		$perm 		= get_permalink($post->ID);
		$title 		= wp_strip_all_tags( get_the_title( $post->ID ) );
		$thumb 		= (has_post_thumbnail($post->ID)) ? pl_the_thumbnail_url( $post->ID ) : '';

		$desc 		= wp_strip_all_tags( pl_short_excerpt($post->ID, 10, '') );

		$twitter 	= self::twitter(array('permalink' => $perm, 'title' => $title));
		$fb 		= self::facebook(array('permalink' => $perm));
		$pinterest 	= self::pinterest(array('permalink' => $perm, 'image' => $thumb, 'desc' => $desc));
		$mode 		= $this->opt('ba_fotos_social_mode') ? $this->opt('ba_fotos_social_mode') : 'icon';
		$layout 	= $this->opt('ba_fotos_social_align') ? $this->opt('ba_fotos_social_align') : 'tal';

		?>
		<div class="fotos-social-share-wrap <?php echo $layout;?>">
			<?php

				if('plain' == $mode) {
					echo $this->plain_mode();
				} elseif ('image' == $mode) {
					echo $this->img_mode();
				} else {
					echo $this->icon_mode();
				}

			?>
		</div>
		<?php
	}


	function plain_mode(){

		$out	= '';
		$out 	.= self::twitter(array('permalink' => $perm, 'title' => $title));
		$out 	.= self::facebook(array('permalink' => $perm));
		$out 	.= self::pinterest(array('permalink' => $perm, 'image' => $thumb, 'desc' => $desc));

		return $out;
	}

	function img_mode(){

		global $post;

		$excerpt 	= wp_strip_all_tags( pl_short_excerpt($post->ID, 10, '') );
		$perm 		= get_permalink($post->ID);
		$title 		= wp_strip_all_tags( get_the_title( $post->ID ) );
		$thumb 		= (has_post_thumbnail($post->ID)) ? pl_the_thumbnail_url( $post->ID ) : '';
		$handle		= pl_setting('twittername');

		$twitimg 	= $this->opt('ba_fotos_twitter_img');
		$fbimg  	= $this->opt('ba_fotos_fb_img');
 		$pinimg 	= $this->opt('ba_fotos_pinterest_img');
 		$getsep 	= $this->opt('ba_fotos_social_separator');
 		$sep 		= ($getsep) ? printf('<span class="ba-fotos-social-post-delimiter">%s</span>',$getsep) : false;

		$out 		= '';
		$out 		.= sprintf('<a href="http://twitter.com/home?status=%s %s via @%s"><img class="ba-fotos-social-twitter" src="%s" alt="%s" /></a>%s',$title,$perm,$handle,$twitimg,$title,$sep);
		$out 		.= sprintf('<a href="http://www.facebook.com/sharer/sharer.php?s=100&p[url]=%s&p[images][0]=%s&p[title]=%s&p[summary]=%s"><img class="ba-fotos-social-twitter" src="%s" alt="%s" /></a>%s',$perm,$thumb,$title,$excerpt,$fbimg,$title,$sep);
		$out 		.= sprintf('<a href="http://pinterest.com/pin/create/button/?url=%s&media=%s&description=%s"><img class="ba-fotos-social-twitter" src="%s" alt="%s" /></a>',$perm,$thumb,$excerpt,$pinimg, $title);

		return $out;
	}

	function icon_mode(){

		global $post;

		$excerpt 	= wp_strip_all_tags( pl_short_excerpt($post->ID, 10, '') );
		$perm 		= get_permalink($post->ID);
		$title 		= wp_strip_all_tags( get_the_title( $post->ID ) );
		$thumb 		= (has_post_thumbnail($post->ID)) ? pl_the_thumbnail_url( $post->ID ) : '';
		$handle		= pl_setting('twittername');
		$getsep 	= $this->opt('ba_fotos_social_separator');
 		$sep 		= ($getsep) ? printf('<span class="ba-fotos-social-post-delimiter">%s</span>',$getsep) : false;

		$out 		= '';
		$out 		.= sprintf('<a href="http://twitter.com/home?status=%s %s via @%s"><i class="icon-twitter icon-fotos icon-fotos-default"></i></a>%s',$title,$perm,$handle,$sep);
		$out 		.= sprintf('<a href="http://www.facebook.com/sharer/sharer.php?s=100&p[url]=%s&p[images][0]=%s&p[title]=%s&p[summary]=%s"><i class="icon-facebook icon-fotos icon-fotos-default"></i></a>%s',$perm,$thumb,$title,$excerpt,$sep);
		$out 		.= sprintf('<a href="http://pinterest.com/pin/create/button/?url=%s&media=%s&description=%s"><i class="icon-pinterest icon-fotos icon-fotos-default"></i></a>',$perm,$thumb,$excerpt);

		return $out;

	}

	function pinterest( $args ){

		$defaults = array(
			'permalink'	=> '',
			'width'		=> '80',
			'title'		=> '',
			'image'		=> '',
			'desc'		=> ''
		);

		$a = wp_parse_args($args, $defaults);
		ob_start();
		?>

		<div class="pin_wrap"><a href="http://pinterest.com/pin/create/button/?url=<?php echo $a['permalink'];?>&media=<?php echo urlencode($a['image']);?>&description=<?php echo urlencode($a['desc']);?>" class="pin-it-button" count-layout="none"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></div>
		<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
		<?php

		return ob_get_clean();


	}


	function twitter( $args ){

		$defaults = array(
			'permalink'	=> '',
			'width'		=> '80',
			'hash'		=> pl_setting('site-hashtag'),
			'handle'	=> pl_setting('twittername'),
			'title'		=> '',
		);

		$a = wp_parse_args($args, $defaults);

		ob_start();

			// Twitter
			printf(
				'<a href="https://twitter.com/share" class="twitter-share-button" data-url="%s" data-text="%s" data-via="%s" data-hashtags="%s">Tweet</a>',
				$a['permalink'],
				$a['title'],
				$a['handle'],
				$a['hash']
			);

		?>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

		<?php

		return ob_get_clean();

	}

	function facebook( $args ){

		$defaults = array(
			'permalink'	=> '',
			'width'		=> '200',
		);

		$a = wp_parse_args($args, $defaults);

		$app_id = '';
		if( pl_setting( 'facebook_app_id' ) )
			$app_id = sprintf( '&appId=%s', pl_setting( 'facebook_app_id' ) );

		ob_start();
			// Facebook
			?>
			<script>(function(d, s, id) {
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) return;
					js = d.createElement(s); js.id = id;
					js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1<?php echo $app_id; ?>";
					fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));
			</script>
			<?php
			printf(
				'<div class="fb-like" data-href="%s" data-send="false" data-layout="button_count" data-width="%s" data-show-faces="false" data-font="arial" style="vertical-align: top"></div>',
				$a['permalink'],
				$a['width']);

		return ob_get_clean();

	}

	function section_opts( ){

		$options = array();

		$options[] = array(
			'col'						=> 8,
			'title'   					=> __('Social Links Mode', 'fotos'),
		    'type'    					=> 'select',
		    'key'						=> 'ba_fotos_social_mode',
		    'default'					=> 'icon',
		    'opts'						=> array(
		    	'icon' 					=> array('name' => __('Icons','fotos')),
		    	'image' 				=> array('name' => __('Custom Image','fotos')),
		    	'plain' 				=> array('name' => __('Plain Button','fotos')),
		    ),
			'help' 						=> __('' , 'fotos'),
		);

		$options[] = array(
			'col'						=> 8,
			'title'   					=> __('Social Links Alignment', 'fotos'),
		    'type'    					=> 'select',
		    'key'						=> 'ba_fotos_social_align',
		    'opts'						=> array(
		    	'tal' 					=> array('name' => __('Align Left','fotos')),
		    	'center' 				=> array('name' => __('Centered','fotos')),
		    	'tar' 					=> array('name' => __('Align Right','fotos')),
		    ),
			'help' 						=> __('' , 'fotos'),
		);

		$options[] = array(
			'col'		 	=> 4,
			'title'			=> __('Custom Social Images', 'fotos'),
			'type'			=> 'multi',
			'opts'			=> array(
				array(
					'type' => 'image_upload',
					'key'	=> 'ba_fotos_twitter_img',
					'title'	=> 'Custom Twitter Button'
				),
				array(
					'type' => 'image_upload',
					'key'	=> 'ba_fotos_fb_img',
					'title'	=> 'Custom Facebook Button'
				),
				array(
					'type' => 'image_upload',
					'key'	=> 'ba_fotos_pinterest_img',
					'title'	=> 'Custom Pinterest Button'
				),
			)

		);

		$options[] = array(
			'col'		 	=> 8,
			'title'			=> __('Separator Images (optional)', 'fotos'),
			'type'			=> 'image_upload',
			'key'			=> 'ba_fotos_social_separator'

		);

		return $options;

	}

}