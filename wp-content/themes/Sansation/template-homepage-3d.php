<?php
/*
Template Name: Homepage 3D
*/
?>
<?php get_header(); ?>
<body>
<div id="header">
	<div class="center relative">
	<?php $sc_logo = get_option('ss_sitelogo');
	$sc_logo_margin = get_option('ss_sitelogomargin');
	$upload = get_option('ss_3dupload'); ?>
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
	<div class="center"></div><!-- end center -->
</div><!-- end flashbanner -->


<div id="flashcontent">
	<p class="flasherror">You need to <a href="http://www.adobe.com/products/flashplayer/" target="_blank">upgrade your Flash Player</a> to version 10 or newer.</p>
	</div><!-- end flashcontent -->
<script type="text/javascript">
		var flashvars = {};
		flashvars.xmlSource = "<?php bloginfo('template_url'); ?>/sansation3dXML.php";
		flashvars.cssSource = "<?php bloginfo('template_url'); ?>/sansation3d.css";
		flashvars.imageSource = "<?php echo $upload; ?>";
		var attributes = {};
		attributes.wmode = "transparent";
		swfobject.embedSWF("<?php bloginfo('template_url'); ?>/sansation3d.swf", "flashcontent", "960", "610", "10", "<?php bloginfo('template_url'); ?>/swfobject/expressInstall.swf", flashvars, attributes);
</script>



<div id="content_wrap" class="home_shadow">
	<div class="center flashhome threedcontent">
		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
		<?php the_content(); ?>
		<?php endwhile; endif; ?>




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