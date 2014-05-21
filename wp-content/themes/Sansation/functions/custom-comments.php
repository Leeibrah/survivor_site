<?php
function cust_comment($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; ?>
<div class="comment_inside_wrap">
<div class="comment_user_wrap">
	<div class="comment_user_gravatar"><?php echo get_avatar($comment,$size='78'); ?></div><!-- end comment_user_gravatar -->
	<p class="comment_user"><?php printf(__('%s'), get_comment_author_link()) ?></p>
	<p class="comment_date"><?php printf(__('%1$s'), get_comment_date()) ?></p>
</div><!-- end comment_user_wrap -->

<div class="comment_message_wrap">
<img src="<?php bloginfo('template_url'); ?>/i/img_arrow.gif" class="comment_arrow" alt="arrow"/>
<div class="comment_message">
<?php comment_text() ?>
</div><!-- end comment_message -->
</div><!-- end comment_message_wrap -->
</div><!-- end comment_inside_wrap -->
	<?php if ($comment->comment_approved == '0') : ?>
	<p class="clear moderation"><em><?php _e('Your comment is awaiting moderation.') ?></em></p>
	<?php endif; ?>
<?php } ?>