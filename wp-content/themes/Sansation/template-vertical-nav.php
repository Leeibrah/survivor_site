<?php
/*
Template Name: Vertical Sub-Nav
*/
?>
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
		<h2 class="ptitle"><?php if(have_posts()) : while(have_posts()) : the_post(); ?><?php the_title(); ?><?php endwhile; endif; ?></h2>
		<div class="content_banner" <?php echo 'style="width:' . $sc_banner_width . ';">'; ?>
			<div class="ss_position">
				<div class="ss_content">
					<?php if(get_post_meta($post->ID, "_text_value", $single = true) != "") : echo get_post_meta($post->ID, "_text_value", $single = true); ?>
					<?php endif; ?>
				</div><!-- end ss_content -->
			</div><!-- end ss_position -->
		</div><!-- end content_banner -->
	</div><!-- end center -->
</div><!-- end interiorbanner -->


<div id="content_wrap" class="nobg">
	<div class="center">
		<div id="vertical_nav">
		<?php



if ($post->post_parent)	{

	$ancestors=get_post_ancestors($post->ID);

	$root=count($ancestors)-1;

	$parent = $ancestors[$root];

} else {

	$parent = $post->ID;

}



$children = wp_list_pages("title_li=&child_of=". $parent ."&echo=0");



if ($children) { ?>

<ul>

<?php echo $children; ?>

</ul>

<?php } ?>
		</div><!-- end vertical_nav -->

		<div id="main_content">
		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
		<?php the_content(); ?>
		<?php endwhile; endif; ?>
		</div><!-- end main_content -->
	</div><!-- end center -->
</div><!-- end content_wrap -->




<?php get_footer(); ?>