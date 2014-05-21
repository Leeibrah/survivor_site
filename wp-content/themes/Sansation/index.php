<?php get_header(); ?>
<body>
<div id="header">
	<div class="center relative">
	<?php $sc_logo = get_option('ss_sitelogo');
	$sc_logo_margin = get_option('ss_sitelogomargin');
	$sc_banner_width = get_option('ss_banner_width'); ?>
	<a href="<?php echo get_option('home'); ?>/" title="<?php bloginfo('name'); ?>" class="ss_logo" style="<?php echo $sc_logo_margin; ?>">
		<img src="http://localhost/survivors/wp-content/uploads/2014/05/logo.jpg" alt="<?php bloginfo('name'); ?>" />
	</a>
	<div id="nav_main">
	<?php
	if (function_exists('wp_nav_menu')) {
		wp_nav_menu(array('menu_class' => 'sf-menu','theme_location' => 'ss-main-menu', 'fallback_cb' => 'ss_default_menu'));
	}
	else {
		sjc_default_menu();
	}
	?>
</div><!-- end nav_main -->
	</div><!-- end center -->
</div><!-- end header -->


<div id="interiorbanner"<?php $banner = get_option('ss_banner_height'); if ($banner != 'normal') { echo ' class="half-height"';} ?>>
	<div class="center">
		<h2 class="ptitle"><?php echo get_option('ss_blogtitle'); ?></h2>
		<div class="content_banner" <?php echo 'style="width:' . $sc_banner_width . ';">'; ?>
			<div class="ss_position">
				<div class="ss_content">
					<?php echo stripslashes(get_option('ss_blogtext')); ?>
				</div><!-- end ss_content -->
			</div><!-- end ss_position -->
		</div><!-- end content_banner -->
	</div><!-- end center -->
</div><!-- end interiorbanner -->






<div id="content_wrap" class="gradient">
	<div class="center">
		<div id="main_content_sidebar">

<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
<?php $exclude = get_option('ss_blogexclude'); ?>
<?php query_posts('cat=' . $exclude .'&paged=' . $paged); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>




			<div class="post_wrap">
				<div class="post_top">
					<div class="post_date_wrap">
					<p class="post_date"><?php the_time('j'); ?></p>
					<p class="post_month"><?php echo strtoupper(get_the_time('M')); ?></p>
					</div><!-- end post_date_wrap -->
					<h2 class="ielinkfix"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>"><?php the_title(); ?></a></h2>
					<p class="wp_ss_tags"><strong>Posted by:</strong> <?php the_author_posts_link(); ?> <?php if (get_the_tags()) : ?> &nbsp;/&nbsp; <strong>Tags:</strong> <?php the_tags('', ', '); ?><?php endif; ?>  <?php $comment_count = get_comment_count($post->ID); ?><?php if ($comment_count['approved'] > 0) : ?> &nbsp;/&nbsp; <strong>Comments:</strong> <?php comments_number('0', '1', '%'); ?><?php endif; ?></p>
				</div><!-- end post_top -->

				<div class="post_content">
					<?php if ( has_post_thumbnail() ) : ?>
					<div class="post_image_wrap">
					<a href="<?php the_permalink() ?>"><?php the_post_thumbnail(); ?></a>
					</div><!-- end post_image_wrap -->
					<?php endif; ?>
					<?php the_content('<span class="read_more_link">Continue Reading &rarr;</span>'); ?>
			</div><!-- end post_content -->
			</div><!-- end post_wrap -->
<?php endwhile; else: ?>
<h2>Nothing Found</h2>
<p>Sorry, it appears there is no content in this section.</p>
<?php endif; ?>
		

		<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
		</div><!-- end main_content_sidebar -->
		



		<div id="sidebar">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Blog Sidebar") ) : ?><h3>BLOG SIDEBAR</h3><p><a href='<?php bloginfo('siteurl')?>/wp-admin/widgets.php'>Widgetize this sidebar</a>Widgetize this sidebar</a>
<?php endif; ?>
		

		</div><!-- end sidebar -->
	</div><!-- end center -->
</div><!-- end content_wrap -->



<?php get_footer(); ?>
