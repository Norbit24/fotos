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
		$perm = get_permalink($post->ID);
		$title = wp_strip_all_tags( get_the_title( $post->ID ) );
		$thumb = (has_post_thumbnail($post->ID)) ? pl_the_thumbnail_url( $post->ID ) : '';

		$desc = wp_strip_all_tags( pl_short_excerpt($post->ID, 10, '') );

		$out = '';


		$out .= self::twitter(array('permalink' => $perm, 'title' => $title));
		$out .= self::facebook(array('permalink' => $perm));
		$out .= self::pinterest(array('permalink' => $perm, 'image' => $thumb, 'desc' => $desc));

		echo $out;
	}

	/**
	 *
	 * Pinterest Button
	 *
	 */
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



	}

}