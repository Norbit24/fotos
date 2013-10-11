<?php
/*
Section: Post Comments
Author: Nick Haskins
Author URI: http://nickhaskins.co
Version: 1.0
Description: Displays the content of the post
Class Name: fotosPostComments
Loading: active
*/

class fotosPostComments extends PageLinesSection {

	function section_head(){

		global $post;

		?>
		<script>
		jQuery(document).ready(function(){
			txt = jQuery('.postid-<?php echo $post->ID;?> .fotos-comments-trigger');
			jQuery(txt).click(function(e){
				e.preventDefault();
				jQuery(this).text(jQuery(this).text() == 'Hide Comments' ? 'Show Comments' : 'Hide Comments');
			});
		});
		</script>
		<?php
	}


 	function section_template() {

		global $post, $withcomments,$wp_query;
		$withcomments = 1;
		$commnum = number_format_i18n( get_comments_number($post->ID) ); // this is right

		$args = array('post_id' => $post->ID,'order'   => 'ASC');
		$wp_query->comments = get_comments( $args );

		if($commnum == 1)
			$commtext = '<i class="icon-comment"></i> 1 Note';
		if($commnum > 1)
			$commtext = sprintf('<i class="icon-comment"></i> %s Notes',$commnum);
		if($commnum == 0)
			$commtext = false;


		?><div class="ba-fotos-comment-trigger-wrap fix">
			<a class="fotos-comments-trigger" data-toggle="collapse" data-target="#fotos-comments-<?php echo $post->ID;?>">Show Comments</a>
			<a class="fotos-comments-num fotos-comments-trigger" data-toggle="collapse" data-target="#fotos-comments-<?php echo $post->ID;?>"><?php echo $commtext;?></a>
		</div>
		<?php

		printf('<div id="fotos-comments-%s" class="ba-fotos-comments-wrap collapse">',$post->ID);

			if ( comments_open() ) {

				$this->get_fotos_comments();

			} else {

				echo 'Comments are closed for this post';
			}

		printf('</div>');
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

		printf('<div class="ba-fotos-comment-wrap"><div class="row ba-fotos-comment-drawer"><div class="span7 zmb">');

			printf('<ul class="unstyled fotos-comment-list">');

				if($commnum == 0) {
					printf('<p class="fotos-no-comments">No Notes Found</p>');
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

