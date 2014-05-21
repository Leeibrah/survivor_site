<?php
$themename = "Sansation";
$shortname = "ss";
automatic_feed_links();



/* LOAD CUSTOM ADMIN OPTIONS */
require_once (TEMPLATEPATH . '/functions/custom-admin-menu.php');


/* LOAD CUSTOM SHORTCODES */
require_once (TEMPLATEPATH . '/functions/shortcodes.php');


/* LOAD CUSTOM WRITE PANELS */
require_once (TEMPLATEPATH . '/functions/write-panels.php');


/* LOAD CUSTOM COMMENTS */
require_once (TEMPLATEPATH . '/functions/custom-comments.php');


/* LOAD CUSTOM WIDGETS */
require_once (TEMPLATEPATH . '/functions/widgets.php');


/* LOAD JAVASCRIPT */
require_once (TEMPLATEPATH . '/functions/javascript.php');


/* LOAD WP 3.0 FUNCTIONS */
require_once (TEMPLATEPATH . '/functions/wpthree.php');


/* LOAD CUSTOM FUNCTIONS */
require_once (TEMPLATEPATH . '/functions/addons/custom-functions.php'); 




/* WORDPRESS TWEAKS */
remove_action ('wp_head', 'rsd_link');
remove_action ('wp_head', 'wlwmanifest_link');
remove_action ('wp_head', 'wp_generator');
add_filter('widget_text', 'do_shortcode');




/* ACTIVATE POST THUMBNAILS */
if ( function_exists( 'add_theme_support' ) ){
add_theme_support( 'post-thumbnails' , array( 'post' ) );
set_post_thumbnail_size(625, 225, true);
}




/* CUSTOM WIDGET AREAS */
if ( function_exists('register_sidebar') )
{
    register_sidebar(array(
		'name' => 'Blog Sidebar',
        'before_widget' => '',
        'after_widget' => '<hr />',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
register_sidebar(array(
		'name' => 'Contact Sidebar',
        'before_widget' => '',
        'after_widget' => '<hr />',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
register_sidebar(array(
		'name' => 'Global Sidebar',
        'before_widget' => '',
        'after_widget' => '<hr />',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
register_sidebar(array(
		'name' => 'Footer Column 1',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
register_sidebar(array(
		'name' => 'Footer Column 2',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
register_sidebar(array(
		'name' => 'Footer Column 3',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
register_sidebar(array(
		'name' => 'Footer Column 4',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
register_sidebar(array(
		'name' => 'Homepage Widget Area',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));

	
}
?>
