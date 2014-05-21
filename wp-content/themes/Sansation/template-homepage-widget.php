<?php
/*
Template Name: Homepage Jquery (Widget)
*/
?>
<?php get_header(); ?>
<body>
<div id="header">
	<div class="center relative">
	<?php $sc_logo = get_option('ss_sitelogo'); ?>
	<?php $sc_logo_margin = get_option('ss_sitelogomargin'); ?>
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


<div id="flashbanner">
	<div class="center">
	<div id="home_slider" style="position:relative;overflow:hidden;height:346px;">
	<?php
	$feathome = get_option('ss_feathome_cat');
	$item_count_home = get_option('ss_homeitems');
	$home_category_id = get_cat_id($feathome);
	$query_string ="posts_per_page=$item_count_home&cat=$home_category_id";
	
	query_posts($query_string);
	
	if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<?php if ( has_post_thumbnail() ) : ?>
		<div class="slider-container">
		<div class="home_slider_thumbnail_content">
		<?php the_content(); ?>
		</div><!-- end home_slider_thumbnail_content -->

		<div class="home_slider_thumbnail"><?php the_post_thumbnail('Homefeatimg'); ?>
		<div class="home_slider_bottom">&nbsp;</div><!-- end bottom -->
		</div><!-- end home_slider_thumbnail -->
		</div>
		<?php else : ?>
		

		<div class="slider-container">
		<div class="home_slider_thumbnail_content_wide">
		<?php the_content(); ?>
		</div><!-- end home_slider_thumbnail_content_wide -->
		</div>

		<?php endif; ?>

		<?php endwhile; endif; ?>
		<?php wp_reset_query(); ?>

		</div><!-- end home_slider -->
	</div><!-- end center -->
</div><!-- end flashbanner -->


<div id="content_wrap" class="gradient">
	<div class="center flashhome">
		
		<div id="home_widget_main">
		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
		<?php the_content(); ?>
		<?php endwhile; endif; ?>
		</div><!-- end home_widget_main -->

		<div id="home_widget_sub">
			<div id="home_widget_sub_top"></div><!-- end home_widget_sub_top -->
				<div id="home_widget_sub_content">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Homepage Widget Area") ) : ?><h3>Homepage Widget Area</h3><p><a href='<?php bloginfo('siteurl')?>/wp-admin/widgets.php'>Widgetize this area</a></p>
					<?php endif; ?>
				</div><!-- end home_widget_sub_content -->
			<div id="home_widget_sub_bottom"></div><!-- end home_widget_sub_bottom -->
		</div><!-- end home_widget_sub -->


<?php
$displaytwitter = get_option('ss_latesttweet');
if ($displaytwitter != '') { ?>
	<div id="quotes_wrap">
		<div id="quotes">
			<?php include( TEMPLATEPATH . '/php/homepage-twitter.php' ); ?>
		</div><!-- end quotes -->
		<p class="name"><a href="http://twitter.com/<?php echo get_option('ss_latesttweet'); ?>" target="_blank">@<?php echo get_option('ss_latesttweet'); ?></a></p>
	</div><!-- end quotes_wrap -->
<?php } ?>

</div><!-- end center -->
</div><!-- end content_wrap -->
<?php get_footer(); ?>