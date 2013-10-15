<?php
/**
 	* Post Loop
 	*
 	* @package     Fotos Theme
 	* @subpackage  Functions
 	* @copyright   Copyright (c) 2013, Nick Haskins & CO
 	* @since       1.0
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class fotosPostLoop {

	function __construct(){

	}

	function post_header(){

 		$date 		= new baFotosPartials;

 		$cattxt		= pl_setting('ba_fotos_post_cat_text') ? pl_setting('ba_fotos_post_cat_text') : __('Filed under', 'fotos');
 		$tagtxt		= pl_setting('ba_fotos_post_tag_text') ? pl_setting('ba_fotos_post_tag_text') : __('Tagged width', 'fotos');

 		$ltwidth 	= pl_setting('ba_fotos_post_title_col') ? pl_setting('ba_fotos_post_title_col').'%' : '85%';
 		$rtwidth 	= pl_setting('ba_fotos_post_date_col') ? pl_setting('ba_fotos_post_date_col').'%' : '15%';
 		$align 		= pl_setting('ba_fotos_post_header_layout') ? pl_setting('ba_fotos_post_header_layout') : 'title-left';

 		$ltalign	= pl_setting('ba_fotos_post_title_align') ? pl_setting('ba_fotos_post_title_align') : false;
 		$rtalign	= pl_setting('ba_fotos_post_date_align') ? pl_setting('ba_fotos_post_date_align') : false;

 		$title      = (is_home()) ? sprintf('<h2 class="fotos-entry-title"><a href="%s">%s</a></h2>',get_permalink(),get_the_title()) : sprintf('<h2 class="fotos-entry-title">%s</h2>',get_the_title());

 		$meta		= sprintf('<p class="fotos-entry-cats">%s %s</p>',$cattxt,do_shortcode('[post_categories]'));

 		$left 		= sprintf('<div style="width:%s;" class="fotos-entry-title-wrap %s">%s%s</div>',$ltwidth,$ltalign,$title,$meta);
 		$right 		= sprintf('<div style="width:%s;" class="fotos-entry-date-wrap %s">%s</div>',$rtwidth,$rtalign,$date->date_markup());

 		$border 	= pl_setting('ba_fotos_post_header_border') ? 'fotos-border-bottom' : false;
 		$bgimg 		= pl_setting('ba_fotos_post_header_bg_img') ? sprintf('style="background-image:url(\'%s\');"',pl_setting('ba_fotos_post_header_bg_img')) : false;
 		
 		printf('<header class="fix fotos-post-header fotos-post-%s %s" %s>%s%s</header>',$align,$border,$bgimg,$left,$right);

	}

	function post_content(){

		$col = pl_setting('ba_fotos_post_content_cols') ? 'fotos-mag-col' : false;

 		printf('<section class="fotos-post-content %s">%s%s</section>',$col, apply_filters('the_content',get_the_content()),pledit(get_the_ID()) );

	}

	function post_footer(){

	}

	function post_social(){

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
		$mode 		= pl_setting('ba_fotos_social_mode') ? pl_setting('ba_fotos_social_mode') : 'icon';
		$layout 	= pl_setting('ba_fotos_social_align') ? pl_setting('ba_fotos_social_align') : 'tal';
		$sharetxt 	= (pl_setting('ba_fotos_social_share_txt')) ? sprintf('<span class="ba-fotos-social-share-txt">%s</span>',pl_setting('ba_fotos_social_share_txt')) : false;
		$shareimg	= pl_setting('ba_fotos_social_share_img');
		$author 	= get_the_author();

		?>
		<section class="fotos-social-share-wrap <?php echo $layout;?>">
			<?php

				if ($shareimg) {
					printf('<img src="%s" alt="share %s posts"/>',$shareimg, $author);
				} else {
					printf('%s',$sharetxt);
				}

				switch($mode):
					case 'plain':
						echo $this->plain_mode();
					break;
					case 'image':
						echo $this->img_mode();
					break;
					default:
						echo $this->icon_mode();
				endswitch;

			?>
		</section>
		<?php
	}
	
	function post_comments(){

		global $post, $withcomments,$wp_query;
		$withcomments = 1;
		$commnum = number_format_i18n( get_comments_number($post->ID) ); // this is right

		$showcommtxt = pl_setting('ba_fotos_post_comment_text') ? pl_setting('ba_fotos_post_comment_text') : __('Show Comments', 'fotos');
		$customcommtxt = pl_setting('ba_fotos_post_comm_custom_txt') ? pl_setting('ba_fotos_post_comm_custom_txt') : __('Comment', 'fotos');

		$customcommtxtplural = str_replace($customcommtxt, $customcommtxt.'s', $customcommtxt);

		$args = array('post_id' => $post->ID,'order'   => 'ASC');
		$wp_query->comments = get_comments( $args );

		if($commnum == 1)
			$commtext = sprintf('<i class="icon-comment"></i> 1 %s',$customcommtxt);
		if($commnum > 1)
			$commtext = sprintf('<i class="icon-comments"></i> %s %s',$commnum,$customcommtxtplural);
		if($commnum == 0)
			$commtext = false;


		?><footer class="ba-fotos-comment-main-wrap">
			<div class="ba-fotos-comment-trigger-wrap fix">
				<a class="fotos-comments-trigger" data-toggle="collapse" data-target="#fotos-comments-<?php echo $post->ID;?>"><?php echo $showcommtxt;?></a>
				<a class="fotos-comments-num fotos-comments-trigger" data-toggle="collapse" data-target="#fotos-comments-<?php echo $post->ID;?>"><?php echo $commtext;?></a>
			</div>
			<?php

			printf('<div id="fotos-comments-%s" class="ba-fotos-comments-wrap collapse">',$post->ID);

				if ( comments_open() ) {

					$this->get_fotos_comments();

				} else {

					echo 'Comments are closed for this post';
				}

		printf('</div></footer>');

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

		$twitimg 	= pl_setting('ba_fotos_twitter_img');
		$fbimg  	= pl_setting('ba_fotos_fb_img');
 		$pinimg 	= pl_setting('ba_fotos_pinterest_img');
 		$getsep 	= pl_setting('ba_fotos_social_separator');
 		$bttimg 	= pl_setting('ba_fotos_btt_img');
 		$bttalt 	= pl_setting('ba_fotos_btt_img_alt');
 		$sep 		= ($getsep) ? sprintf('<span class="ba-fotos-social-post-delimiter" style="background:url(\'%s\') no-repeat;height:15px;width:15px;overflow:hidden;display:inline-block;"></span>',$getsep) : false;

		$out 		= '';
		$out 		.= sprintf('<a href="http://twitter.com/home?status=%s %s via @%s"><img class="ba-fotos-social-twitter" src="%s" alt="%s" /></a>%s',$title,$perm,$handle,$twitimg,$title,$sep);
		$out 		.= sprintf('<a href="http://www.facebook.com/sharer/sharer.php?s=100&p[url]=%s&p[images][0]=%s&p[title]=%s&p[summary]=%s"><img class="ba-fotos-social-twitter" src="%s" alt="%s" /></a>%s',$perm,$thumb,$title,$excerpt,$fbimg,$title,$sep);
		$out 		.= sprintf('<a href="http://pinterest.com/pin/create/button/?url=%s&media=%s&description=%s"><img class="ba-fotos-social-twitter" src="%s" alt="%s" /></a>',$perm,$thumb,$excerpt,$pinimg, $title);
		$out 		.= sprintf('<a href="#" class="fotos-back-to-top"><img class="ba-fotos-back-to-top" src="%s" alt="%s" /></a>',$bttimg,$bttalt);
		
		return $out;
	}

	function icon_mode(){

		global $post;

		$excerpt 	= wp_strip_all_tags( pl_short_excerpt($post->ID, 10, '') );
		$perm 		= get_permalink($post->ID);
		$title 		= wp_strip_all_tags( get_the_title( $post->ID ) );
		$thumb 		= (has_post_thumbnail($post->ID)) ? pl_the_thumbnail_url( $post->ID ) : '';
		$handle		= pl_setting('twittername');
		$getsep 	= pl_setting('ba_fotos_social_separator');
 		$sep 		= ($getsep) ? printf('<span class="ba-fotos-social-post-delimiter">%s</span>',$getsep) : false;

		$out 		= '';
		$out 		.= sprintf('<a href="http://twitter.com/home?status=%s %s via @%s"><i class="icon-twitter icon-fotos icon-fotos-default"></i></a>%s',$title,$perm,$handle,$sep);
		$out 		.= sprintf('<a href="http://www.facebook.com/sharer/sharer.php?s=100&p[url]=%s&p[images][0]=%s&p[title]=%s&p[summary]=%s"><i class="icon-facebook icon-fotos icon-fotos-default"></i></a>%s',$perm,$thumb,$title,$excerpt,$sep);
		$out 		.= sprintf('<a href="http://pinterest.com/pin/create/button/?url=%s&media=%s&description=%s"><i class="icon-pinterest icon-fotos icon-fotos-default"></i></a>',$perm,$thumb,$excerpt);
		$out 		.= sprintf('<a href="#" class="fotos-back-to-top"><i class="icon-arrow-up icon-fotos icon-fotos-default"></i></a>');
		
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

	// Draw Custom Comments
	function fotos_comment_template( $comment, $args, $depth ) {

	    $GLOBALS['comment'] = $comment;
	    extract($args, EXTR_SKIP);

	    $comreply = get_comment_reply_link( array_merge( $args, array( 'reply_text' => 'reply', 'depth' => $depth, 'max_depth' => $args['max_depth'])));
	    $comdate = mysql2date('l jS F, Y, g:ia', get_comment_date() );

	    ?><li <?php comment_class('fotos-single-comment');?> id="li-comment-<?php echo get_comment_ID() ;?>"><?php

	    printf('<div id="comment-%s" class="row fotos-single-comment-pad">',get_comment_ID() );

			printf('<div class="span2 zmb"><span class="fotos-comment-author"><strong><a href="%s">%s</a></strong>: </span>',get_comment_author_url(),get_comment_author() );
				printf('</div><div class="span10 zmb"><p class="fotos-comment-content">%s</p>',get_comment_text() );
					printf('<p class="fotos-comment-date"><small>%s</small></p>',$comdate);
			printf('</div></div>');

	}

	// Draw the Comment Tray
	function get_fotos_comments() {

		global $post, $wp_query;
		$args = array('post_id' => $post->ID,'order'   => 'ASC');
		$wp_query->comments = get_comments( $args );
		$commnum = number_format_i18n( get_comments_number($post->ID) ); // this is right

		$nocommtxt = pl_setting('ba_fotos_post_no_comment_text') ? pl_setting('ba_fotos_post_no_comment_text') : __('No comments found.', 'fotos');

		printf('<div class="ba-fotos-comment-wrap"><div class="row ba-fotos-comment-drawer"><div class="span7 zmb">');

			printf('<ul class="unstyled fotos-comment-list">');

				if($commnum == 0) {
					printf('<p class="fotos-no-comments">%s</p>',$nocommtxt);
				} else {
					wp_list_comments( array( 'callback' => array($this,'fotos_comment_template') ) );
				}

			printf('</ul>');

			printf('</div><div class="span5 zmb">');

			$this->fotos_get_comment_form();

		printf('</div></div></div>');
	}

	// Draw Custom Comment Form
	function fotos_get_comment_form() {

		global $post;

		?>

		<form class="ba-fotos-commentform" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform-<?php echo $post->ID;?>">

			<div class="row">
				<div class="span6 zmb">
					<label class="fotos-label-control" for="author-<?php echo $post->ID;?>">Name</label>
					<input class="fotos-label-full" type="text" name="author" id="author-<?php echo $post->ID;?>" value="" size="22" tabindex="1" />
				</div>

				<div class="span6 zmb">
					<label class="fotos-label-control" for="email-<?php echo $post->ID;?>" >Email</label>
					<input class="fotos-label-full" type="email" required name="email" id="email-<?php echo $post->ID;?>" value="" size="22" tabindex="2" />
				</div>
			</div>

			<div class="row">
				<div class="span12 zmb">
					<label class="fotos-label-control" for="url-<?php echo $post->ID;?>">Website</label>
					<input class="fotos-label-full" type="url" name="url" id="url-<?php echo $post->ID;?>" value="" size="22" tabindex="3" />
				</div>
			</div>

			<label class="fotos-label-control" for="comment-<?php echo $post->ID;?>">Message</label>
			<textarea name="comment" id="comment-<?php echo $post->ID;?>" type="comment" required rows="2" tabindex="4"></textarea>

			<button class="btn btn-fotos fotos-form-submit" name="submit" type="submit" tabindex="4" value="Submit"> Submit</button>
			<?php comment_id_fields(); ?>

			<?php do_action('comment_form', $post->ID); ?>
		</form>

	<?php }
}
new fotosPostLoop;
