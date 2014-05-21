<?php
/*
Template Name: Sidebar
*/
?>
<?php get_header(); ?>
<body>
<div id="header">
	<div class="center relative">
	<?php $sc_logo = get_option('ss_sitelogo');
	$sc_logo_margin = get_option('ss_sitelogomargin');
	$sc_banner_width = get_option('ss_banner_width'); ?>
	<a href="<?php echo get_option('home'); ?>/" title="<?php bloginfo('name'); ?>" class="ss_logo" style="<?php echo $sc_logo_margin; ?>"><img src="<?php echo $sc_logo; ?>" alt="<?php bloginfo('name'); ?>" /></a>
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
<?php
$children = wp_list_pages('&child_of='.$post->parent.'&echo=0');
if(!$children) { $children = wp_list_pages('&child_of='.$post->ID.'&echo=0'); } 
if ($children) : ?>
<div class="center">
		<div id="horizontal_nav">
		<ul>
		<?php
		if($post->post_parent)
		$children = wp_list_pages("sort_column=menu_order&depth=1&title_li=&child_of=".$post->post_parent."&echo=0"); else
		$children = wp_list_pages("sort_column=menu_order&depth=1&title_li=&child_of=".$post->ID."&echo=0");
		if ($children) { ?>
		<?php echo $children; ?>
		<?php } ?>
		</ul>
		</div><!-- end horizontal_nav -->
</div><!-- end center -->
<?php endif; ?>



		
	<div id="full_width" class="gradient">
		<div class="center">
			<div id="main_content_sidebar">
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
			<?php the_content(); ?>
			<?php endwhile; endif; ?>
			</div><!-- end main_content_sidebar -->

			<div id="sidebar">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Global Sidebar") ) : ?><h3>SIDEBAR</h3><p><a href='<?php bloginfo('siteurl')?>/wp-admin/widgets.php'>Widgetize this sidebar</a></p>
<?php endif; ?>
			</div><!-- end sidebar -->
	</div><!-- end center -->
</div><!-- end full_width -->


</div><!-- end content_wrap -->



<?php get_footer(); ?>