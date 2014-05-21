<?php

// add menu support and fallback menu if menu doesn't exist
add_action('init', 'ss_register_menu');
function ss_register_menu() {
	if (function_exists('register_nav_menu')) {
		register_nav_menu('ss-main-menu', __('Main Menu'));
	}
}
function ss_default_menu() {
	echo '<ul class="sf-menu">';
	if ('page' != get_option('show_on_front')) {
		echo '<li><a href="'. get_option('home') . '/">Home</a></li>';
	}
	wp_list_pages('title_li=&depth=2');
	echo '</ul>';
}






// remove nav container
function my_wp_nav_menu_args( $args = '' )
{
	$args['container'] = false;
	return $args;
} // function

add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' );
?>