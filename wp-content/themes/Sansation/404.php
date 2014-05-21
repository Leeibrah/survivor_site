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
		<h2 class="ptitle">Page Not Found</h2>
		<p></p>
	</div><!-- end center -->
</div><!-- end interiorbanner -->



<div id="content_wrap" class="nobg">		
	<div id="full_width" class="gradient">
		<div class="center">
			<div id="main_content_sidebar">
			<h2>404 Error - Page not found</h2>
			<p>Sorry, but the page you are looking for could not be found. The page may have been deleted or the link you followed may have been outdated.</p><br />
			<ul>
			<?php wp_list_pages('title_li='); ?>
			</ul>
			</div><!-- end main_content_sidebar -->

			<div id="sidebar">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Global Sidebar") ) : ?><h3>SIDEBAR</h3><p><a href='<?php bloginfo('siteurl')?>/wp-admin/widgets.php'>Widgetize this sidebar</a>Widgetize this sidebar</a>
<?php endif; ?>
			</div><!-- end sidebar -->
	</div><!-- end center -->
</div><!-- end full_width -->


</div><!-- end content_wrap -->



<?php get_footer(); ?>