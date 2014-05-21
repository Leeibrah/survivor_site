<?php get_header(); ?>
<body>
<div id="header">
	<div class="center relative">
	<?php $sc_logo = get_option('ss_sitelogo'); ?>
	<?php $sc_logo_margin = get_option('ss_sitelogomargin'); ?>
	<a href="<?php echo get_option('home'); ?>/" title="<?php bloginfo('name'); ?>" class="ss_logo" style="<?php echo $sc_logo_margin; ?>"><img src="<?php echo $sc_logo; ?>" alt="<?php bloginfo('name'); ?>" /></a>
	<div id="nav_main">
	<ul class="fourerror sf-menu">
	<?php wp_list_pages('title_li=&depth=2'); ?>
	</ul>
	</div><!-- end nav_main -->
	</div><!-- end center -->
</div><!-- end header -->


<div id="interiorbanner"<?php $banner = get_option('ss_banner_height'); if ($banner != 'normal') { echo ' class="half-height"';} ?>>
	<div class="center">
		<h2 class="ptitle">Search Results</h2>
		<p></p>
	</div><!-- end center -->
</div><!-- end interiorbanner -->



<div id="content_wrap" class="nobg">		
	<div id="full_width" class="gradient">
		<div class="center">
			<div id="main_content_sidebar">
			
<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
<?php $exclude = get_option('ss_blogexclude'); ?>
<?php query_posts('cat=' . $exclude .'&paged=' . $paged); ?>
<?php if (have_posts()) : ?> <h2>Search Results</h2><br /> <?php while (have_posts()) : the_post(); ?>

			<div <?php post_class() ?>>
				<h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
				<p><?php the_time('l, F jS, Y') ?></p>
				<p><?php the_tags('Tags: ', ', ', '<br />'); ?> Posted in <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
<hr />
			</div>

		<?php endwhile; ?>

			<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
	
	<?php else : ?>
		<h2>Nothing was found. Try a different search?</h2><br /><br />
		<?php get_search_form(); ?>
	<?php endif; ?>

			
			</div><!-- end main_content_sidebar -->

			<div id="sidebar">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Global Sidebar") ) : ?><h3>SIDEBAR</h3><p><a href='<?php bloginfo('siteurl')?>/wp-admin/widgets.php'>Widgetize this sidebar</a>Widgetize this sidebar</a>
<?php endif; ?>
			</div><!-- end sidebar -->
	</div><!-- end center -->
</div><!-- end full_width -->


</div><!-- end content_wrap -->



<?php get_footer(); ?>