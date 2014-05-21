<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php if (is_front_page() ) {
    bloginfo('name');
} elseif ( is_category() ) {
    single_cat_title(); echo ' - ' ; bloginfo('name');
} elseif (is_single() ) {
    single_post_title();
} elseif (is_page() ) {
    single_post_title(); echo ' - '; bloginfo('name');
} else {
    wp_title('',true);
} ?></title>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/<?php echo get_option('ss_color_scheme'); ?>.css" type="text/css" media="screen" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<!--[if IE 6]><script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/warning.js"></script><![endif]-->
<!--[if IE 7]><link href="<?php bloginfo('template_url'); ?>/css/ie7.css" rel="stylesheet" type="text/css" /><![endif]-->
<!--[if IE 8]><link href="<?php bloginfo('template_url'); ?>/css/ie8.css" rel="stylesheet" type="text/css" /><![endif]-->
<?php
$customcss = get_option('ss_css_code');
if ($customcss != '') {
echo '<style type="text/css">';
echo $customcss;
echo '</style>';
}
?>
<?php wp_head(); ?>
<?php include (TEMPLATEPATH . '/functions/javascript.php'); ?>
</head>
