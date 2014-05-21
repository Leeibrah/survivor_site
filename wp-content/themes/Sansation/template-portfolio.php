<?php
/*
Template Name: Gallery
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




	<div id="full_width" class="gradient">
		<div class="center">

		<?php
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$category_id = get_post_meta($post->ID, '_multiple_portfolio_cat_id', true);
		$posts_p_p = stripslashes(get_settings( $shortname."_portitems" ) );
		$query_string ="posts_per_page=$item_count&cat=$category_id&posts_per_page=$posts_p_p&paged=$paged";
		query_posts($query_string);
		
		$count = 0;
		$col = 0;
		
		if (have_posts()) : while (have_posts()) : the_post();
		
			$count++;
				$col ++;
				$mod = ($count % 3 == 0) ? 0 : 3 - $count % 3;
		?>




<div class="threecol<?php if($col == 3){  echo '_last'; $col = 0; } ?>">
<?php if ( get_post_meta($post->ID, '_portimage1_value', true) ) { ?>
	<div class="img_frame_port">
	<div class="fade"><a href="<?php echo get_post_meta($post->ID, "_portimage2_value", $single = true); ?>" class="attachment-fadeIn" title="<?php if(get_post_meta($post->ID, "_portimage_value", $single = true) != "") : echo get_post_meta($post->ID, "_portimage_value", $single = true); ?><?php endif; ?>" rel="prettyPhoto[g1]"><img src="<?php echo bloginfo('template_directory'); ?>/i_global/new-load.png" style="position:absolute; display: none;" /><img src="<?php bloginfo('template_directory'); ?>/php/thumbs.php?src=<?php echo get_post_meta($post->ID, "_portimage1_value", $single = true); ?>&amp;h=169&amp;w=278&amp;zc=1" alt="<?php the_title(); ?>" width="278" height="169" /></a></div><!-- end fade -->
</div><!-- end img_frame_port -->
<?php } ?>
<h3><?php echo strtoupper(get_the_title()); ?></h3>
<?php the_content(); ?>
</div><!-- end threecol -->


<?php
	if ( $mod == 0 ){
            echo '<br class="clear" />';
        }
endwhile; endif;
?>
	<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
	</div><!-- end center -->
</div><!-- end full_width -->
</div><!-- end content_wrap -->



<?php get_footer(); ?>
