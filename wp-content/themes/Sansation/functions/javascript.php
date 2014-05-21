<?php
//function enqueue_theme_js () {
//wp_enqueue_script('jquery-1.2.6', get_bloginfo('stylesheet_directory') . '/js/jquery-1.2.6.min.js', array('jquery'), false);
wp_enqueue_script('jquerycycle', get_bloginfo('stylesheet_directory'). '/js/jquery.cycle.all.js', array('jquery'), false);
wp_enqueue_script('sansation', get_bloginfo('stylesheet_directory') . '/js/sansation_custom.js', array('jquery'), false);
wp_enqueue_script('cufon', get_bloginfo('stylesheet_directory') . '/js/cufon-yui.js', array('jquery'), false);
wp_enqueue_script('cufontext', get_bloginfo('stylesheet_directory') . '/js/Sansation_700.font.js', array('jquery'), false);
wp_enqueue_script('swfobject', get_bloginfo('stylesheet_directory') . '/js/swfobject/swfobject.js', array('jquery'), false);

//}
?>