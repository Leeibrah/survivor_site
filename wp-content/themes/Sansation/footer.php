<div id="footer">
<div class="center">
	<div class="fourcol">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column 1") ) : ?><h3>FOOTER COLUMN 1</h3><p><a href='<?php bloginfo('siteurl')?>/wp-admin/widgets.php'>Widgetize this sidebar</a></p
<?php endif; ?>
	</div><!-- end fourcol -->



	<div class="fourcol">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column 2") ) : ?><h3>FOOTER COLUMN 2</h3><p><a href='<?php bloginfo('siteurl')?>/wp-admin/widgets.php'>Widgetize this sidebar</a></p>
<?php endif; ?>
	</div><!-- end fourcol -->



	<div class="fourcol">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column 3") ) : ?><h3>FOOTER COLUMN 3</h3><p><a href='<?php bloginfo('siteurl')?>/wp-admin/widgets.php'>Widgetize this sidebar</a></p>
<?php endif; ?>
	</div><!-- end fourcol -->



	<div class="fourcol_last">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column 4") ) : ?><h3>FOOTER COLUMN 4</h3><p><a href='<?php bloginfo('siteurl')?>/wp-admin/widgets.php'>Widgetize this sidebar</a></p>
<?php endif; ?>
	</div><!-- end fourcol_last -->



	<div id="copyright">
	<?php echo stripslashes(get_option('ss_footertext')); ?>
	</div><!-- end copyright -->
</div><!-- end center -->
<a href="#" id="toTop">Scroll to Top</a>
</div><!-- end footer -->
<script type="text/javascript">
//<![CDATA[
		jQuery(function(){
			jQuery('ul.sf-menu').superfish();
		});
//]]>
</script>

<!--[if lt IE 9]>
<script type="text/javascript">
//<![CDATA[
		jQuery(function(){
			jQuery('ul.sf-menu').superfish({
			speed : 1
			});
		});
//]]>
</script>
<![endif]-->

<script type="text/javascript">jQuery(function() { jQuery("#toTop").scrollToTop({speed:1400,ease:"easeOutBack",start:700}); }); </script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.cycle.all.js"></script>
<script type="text/javascript">
//<![CDATA[
jQuery(function() {
    jQuery('#home_slider').after('<ul id="home_slider_nav">').cycle({
        fx:      'fade',
        timeout:  <?php echo get_option('ss_hometimeout'); ?>,
        pager:   '#home_slider_nav',
        pagerAnchorBuilder: pagerFactory,
		pause:  true
    });

    function pagerFactory(idx, slide) {
        return '<li><a href="#">'+(idx+1)+'</a></li>';
    }; 
});
//]]>
</script>
<script type="text/javascript" charset="utf-8">
//<![CDATA[
	jQuery(document).ready(function(){
		jQuery("a[rel^='prettyPhoto']").prettyPhoto();
	});
//]]>
</script>
<script type="text/javascript"> Cufon.now(); </script>
<?php echo stripslashes(get_option('ss_ga_code')); ?>
<?php wp_footer(); ?>
</body>
</html>
