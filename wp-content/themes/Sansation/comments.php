<?php
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
	<?php
		return;
	}
?>



<!-- You can start editing here. -->
<?php if ( have_comments() ) : ?>
	<h2><?php comments_number('No Comments', 'One Comment', '% Comments' );?></h2>

	<div class="comment_outside_wrap">
	<?php wp_list_comments('callback=cust_comment'); ?>
	</div><!-- end comment_outside_wrap -->

 <?php else : // this is displayed if there are no comments so far ?>
	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->
	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments">Comments are closed.</p>
	<?php endif; ?>
<?php endif; ?>








<?php if ( comments_open() ) : ?>
<h2><?php comment_form_title( 'Leave a Reply' ); ?></h2>

<div class="cancel-comment-reply">
	<small><?php cancel_comment_reply_link(); ?></small>
</div>

<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
<p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged in</a> to post a comment.</p>
<?php else : ?>




<div class="post_reply_wrap">
		<div class="post_reply_form_wrap">
		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" name="commentform">
		
		<?php if ( is_user_logged_in() ) : ?>
		<p class="userlogged">Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>
		<?php else : ?>
		
		
		
		<p><strong>Your Name:</strong> <small>(required)</small><br /><input type="text" class="post_user_name" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" tabindex="1" /></p>

		<p><strong>Your Email:</strong> <small>(will not be published) (required)</small><br /><input type="text" class="post_user_email" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" /></p>

		<p><strong>Your Website:</strong><br /><input type="text" class="post_user_website" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" /></p>	
		<?php endif; ?>
		
		<p><strong>Your Message:</strong><br /><textarea class="post_user_message" rows="5" cols="10" name="comment" id="comment" tabindex="4"></textarea></p>
		<p><a class="button" onclick="document.commentform.submit(); return false"><span>submit comment</span></a></p>
		<?php comment_id_fields(); ?>
		<?php do_action('comment_form', $post->ID); ?>
		
		</form>
		</div><!-- end post_reply_form_wrap -->
</div><!-- end post_reply_wrap -->

<?php endif; // If registration required and not logged in ?>


<?php endif; // if you delete this the sky will fall on your head ?>