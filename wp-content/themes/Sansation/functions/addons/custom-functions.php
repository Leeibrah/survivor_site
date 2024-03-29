<?php
/*
Plugin Name: Page Links To
Plugin URI: http://txfx.net/code/wordpress/page-links-to/
Description: Allows you to point WordPress pages or posts to a URL of your choosing.  Good for setting up navigational links to non-WP sections of your site or to off-site resources.
Version: 2.3
Author: Mark Jaquith
Author URI: http://coveredwebservices.com/
*/

/*  Copyright 2005-2008  Mark Jaquith (email: mark.gpl@txfx.net)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

// Compat functions for WP < 2.8
if ( !function_exists( 'esc_attr' ) ) {
	function esc_attr( $attr ) {
		return attribute_escape( $attr );
	}

	function esc_url( $url ) {
		return clean_url( $url );
	}
}

function txfx_get_post_meta_by_key( $key ) {
	global $wpdb;
	return $wpdb->get_results( $wpdb->prepare( "SELECT post_id, meta_value FROM $wpdb->postmeta WHERE meta_key = %s", $key ) );
}

function txfx_get_page_links_to_meta () {
	global $wpdb, $page_links_to_cache, $blog_id;

	if ( !isset( $page_links_to_cache[$blog_id] ) )
		$links_to = txfx_get_post_meta_by_key( '_links_to' );
	else
		return $page_links_to_cache[$blog_id];

	if ( !$links_to ) {
		$page_links_to_cache[$blog_id] = false;
		return false;
	}

	foreach ( (array) $links_to as $link )
		$page_links_to_cache[$blog_id][$link->post_id] = $link->meta_value;

	return $page_links_to_cache[$blog_id];
}

function txfx_get_page_links_to_targets () {
	global $wpdb, $page_links_to_target_cache, $blog_id;

	if ( !isset( $page_links_to_target_cache[$blog_id] ) )
		$links_to = txfx_get_post_meta_by_key( '_links_to_target' );
	else
		return $page_links_to_target_cache[$blog_id];

	if ( !$links_to ) {
		$page_links_to_target_cache[$blog_id] = false;
		return false;
	}

	foreach ( (array) $links_to as $link )
		$page_links_to_target_cache[$blog_id][$link->post_id] = $link->meta_value;

	return $page_links_to_target_cache[$blog_id];
}

function txfx_plt_add_meta_box( $page, $context ) {
	if ( ( 'page' === $page || 'post' === $page ) && 'advanced' === $context )
		add_meta_box( 'page-links-to', 'Page Links To', 'txfx_plt_meta_box', $page, 'advanced', 'low' );
}

function txfx_plt_meta_box() {
	global $post;
	echo '<p>';
	wp_nonce_field( 'txfx_plt', '_txfx_pl2_nonce', false, true );
	echo '</p>';
	$url = get_post_meta( $post->ID, '_links_to', true);
	if ( !$url )
		$url = 'http://';
?>
	<p>Point to this URL: <input name="txfx_links_to" type="text" style="width:75%" id="txfx_links_to" value="<?php echo attribute_escape( $url ); ?>" /></p>
	<p><label for="txfx_links_to_new_window"><input type="checkbox" name="txfx_links_to_new_window" id="txfx_links_to_new_window" value="_blank" <?php checked( '_blank', get_post_meta( $post->ID, '_links_to_target', true ) ); ?>> Open this link in a new window</label></p>
	<p><label for="txfx_links_to_302"><input type="checkbox" name="txfx_links_to_302" id="txfx_links_to_302" value="302" <?php checked( '302', get_post_meta( $post->ID, '_links_to_type', true ) ); ?>> Use a temporary <code>302</code> redirect (default is a permanent <code>301</code> redirect)</label></p>
<?php
}

function txfx_plt_save_meta_box( $post_ID ) {
	if ( wp_verify_nonce( $_REQUEST['_txfx_pl2_nonce'], 'txfx_plt' ) ) {
		if ( isset( $_POST['txfx_links_to'] ) && strlen( $_POST['txfx_links_to'] ) > 0 && $_POST['txfx_links_to'] !== 'http://' ) {
			$link = stripslashes( $_POST['txfx_links_to'] );
			if ( 0 === strpos( $link, 'www.' ) )
				$link = 'http://' . $link; // Starts with www., so add http://
			update_post_meta( $post_ID, '_links_to', $link );
			if ( isset( $_POST['txfx_links_to_new_window'] ) )
				update_post_meta( $post_ID, '_links_to_target', '_blank' );
			else
				delete_post_meta( $post_ID, '_links_to_target' );
			if ( isset( $_POST['txfx_links_to_302'] ) )
				update_post_meta( $post_ID, '_links_to_type', '302' );
			else
				delete_post_meta( $post_ID, '_links_to_type' );
		} else {
			delete_post_meta( $post_ID, '_links_to' );
			delete_post_meta( $post_ID, '_links_to_target' );
			delete_post_meta( $post_ID, '_links_to_type' );
		}
	}
	return $post_ID;
}


function txfx_filter_links_to_pages ($link, $post) {
	$page_links_to_cache = txfx_get_page_links_to_meta();

	// Really strange, but page_link gives us an ID and post_link gives us a post object
	$id = ( $post->ID ) ? $post->ID : $post;

	if ( $page_links_to_cache[$id] )
		$link = esc_url( $page_links_to_cache[$id] );

	return $link;
}

function txfx_redirect_links_to_pages() {
	if ( !is_single() && !is_page() )
		return;

	global $wp_query;

	$link = get_post_meta( $wp_query->post->ID, '_links_to', true );

	if ( !$link )
		return;

	$redirect_type = get_post_meta( $wp_query->post->ID, '_links_to_type', true );
	$redirect_type = ( $redirect_type = '302' ) ? '302' : '301';
	wp_redirect( $link, $redirect_type );
	exit;
}

function txfx_page_links_to_highlight_tabs( $pages ) {
	$page_links_to_cache = txfx_get_page_links_to_meta();
	$page_links_to_target_cache = txfx_get_page_links_to_targets();

	if ( !$page_links_to_cache && !$page_links_to_target_cache )
		return $pages;

	$this_url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	$targets = array();

	foreach ( (array) $page_links_to_cache as $id => $page ) {
		if ( isset( $page_links_to_target_cache[$id] ) )
			$targets[$page] = $page_links_to_target_cache[$id];

		if ( str_replace( 'http://www.', 'http://', $this_url ) == str_replace( 'http://www.', 'http://', $page ) || ( is_home() && str_replace( 'http://www.', 'http://', trailingslashit( get_bloginfo( 'home' ) ) ) == str_replace( 'http://www.', 'http://', trailingslashit( $page ) ) ) ) {
			$highlight = true;
			$current_page = esc_url( $page );
		}
	}

	if ( count( $targets ) ) {
		foreach ( $targets as  $p => $t ) {
			$p = esc_url( $p );
			$t = esc_attr( $t );
			$pages = str_replace( '<a href="' . $p . '" ', '<a href="' . $p . '" target="' . $t . '" ', $pages );
		}
	}

	if ( $highlight ) {
		$pages = preg_replace( '| class="([^"]+)current_page_item"|', ' class="$1"', $pages ); // Kill default highlighting
		$pages = preg_replace( '|<li class="([^"]+)"><a href="' . $current_page . '"|', '<li class="$1 current_page_item"><a href="' . $current_page . '"', $pages );
	}

	return $pages;
}

function txfx_plt_init() {
	if ( get_option( 'txfx_plt_schema_version' ) < 3 ) {
		global $wpdb;
		$wpdb->query( "UPDATE $wpdb->postmeta SET meta_key = '_links_to'        WHERE meta_key = 'links_to'        " );
		$wpdb->query( "UPDATE $wpdb->postmeta SET meta_key = '_links_to_target' WHERE meta_key = 'links_to_target' " );
		$wpdb->query( "UPDATE $wpdb->postmeta SET meta_key = '_links_to_type'   WHERE meta_key = 'links_to_type'   " );
		wp_cache_flush();
		update_option( 'txfx_plt_schema_version', 3 );
	}
}

add_filter( 'wp_list_pages',     'txfx_page_links_to_highlight_tabs', 9     );
add_action( 'template_redirect', 'txfx_redirect_links_to_pages'             );
add_filter( 'page_link',         'txfx_filter_links_to_pages',        20, 2 );
add_filter( 'post_link',         'txfx_filter_links_to_pages',        20, 2 );
add_action( 'do_meta_boxes',     'txfx_plt_add_meta_box',             10, 2 );
add_action( 'save_post',         'txfx_plt_save_meta_box'                   );
add_action( 'init',              'txfx_plt_init'                            );
?>
<?php
/*
Plugin Name: Exclude Pages from Navigation
Plugin URI: http://wordpress.org/extend/plugins/exclude-pages/
Description: Provides a checkbox on the editing page which you can check to exclude pages from the primary navigation. IMPORTANT NOTE: This will remove the pages from any "consumer" side page listings, which may not be limited to your page navigation listings.
Version: 1.9
Author: Simon Wheatley
Author URI: http://simonwheatley.co.uk/wordpress/

Copyright 2007 Simon Wheatley

This script is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This script is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.

*/

// Full filesystem path to this dir
define('EP_PLUGIN_DIR', dirname(__FILE__));

// Option name for exclusion data
define('EP_OPTION_NAME', 'ep_exclude_pages');
// Separator for the string of IDs stored in the option value
define('EP_OPTION_SEP', ',');
// The textdomain for the WP i18n gear
define( 'EP_TD', 'exclude-pages' );

// Take the pages array, and return the pages array without the excluded pages
// Doesn't do this when in the admin area
function ep_exclude_pages( $pages ) {
	// If the URL includes "wp-admin", just return the unaltered list
	// This constant, WP_ADMIN, only came into WP on 2007-12-19 17:56:16 rev 6412, i.e. not something we can rely upon unfortunately.
	// May as well check it though.
	// Also check the URL... let's hope they haven't got a page called wp-admin (probably not)
	// SWTODO: Actually, you can create a page with an address of wp-admin (which is then inaccessible), I consider this a bug in WordPress (which I may file a report for, and patch, another time).
	$bail_out = ( ( defined( 'WP_ADMIN' ) && WP_ADMIN == true ) || ( strpos( $_SERVER[ 'PHP_SELF' ], 'wp-admin' ) !== false ) );
	$bail_out = apply_filters( 'ep_admin_bail_out', $bail_out );
	if ( $bail_out ) return $pages;
	$excluded_ids = ep_get_excluded_ids();
	$length = count($pages);
	// Ensure we catch all descendant pages, so that if a parent
	// is hidden, it's children are too.
	for ( $i=0; $i<$length; $i++ ) {
		$page = & $pages[$i];
		// If one of the ancestor pages is excluded, add it to our exclude array
		if ( ep_ancestor_excluded( $page, $excluded_ids, $pages ) ) {
			// Can't actually delete the pages at the moment, 
			// it'll screw with our recursive search.
			// For the moment, just tag the ID onto our excluded IDs
			$excluded_ids[] = $page->ID;
		}
	}

	// Ensure the array only has unique values
	$delete_ids = array_unique( $excluded_ids );
	
	// Loop though the $pages array and actually unset/delete stuff
	for ( $i=0; $i<$length; $i++ ) {
		$page = & $pages[$i];
		// If one of the ancestor pages is excluded, add it to our exclude array
		if ( in_array( $page->ID, $delete_ids ) ) {
			// Finally, delete something(s)
			unset( $pages[$i] );
		}
	}

	// Reindex the array, for neatness
	// SWFIXME: Is reindexing the array going to create a memory optimisation problem for large arrays of WP post/page objects?
	if ( ! is_array( $pages ) ) $pages = (array) $pages;
	$pages = array_values( $pages );

	return $pages;
}

/**
 * Recurse down an ancestor chain, checking if one is excluded
 *
 * @param  
 * @return boolean|int The ID of the "nearest" excluded ancestor, otherwise false
 * @author Simon Wheatley
 **/
function ep_ancestor_excluded( $page, $excluded_ids, $pages ) {
	$parent = & ep_get_page( $page->post_parent, $pages );
	// Is there a parent?
	if ( ! $parent )
		return false;
	// Is it excluded?
	if ( in_array( $parent->ID, $excluded_ids ) )
		return (int) $parent->ID;
	// Is it the homepage?
	if ( $parent->ID == 0 )
		return false;
	// Otherwise we have another ancestor to check
	return ep_ancestor_excluded( $parent, $excluded_ids, $pages );
}

/**
 * {no description}
 *
 * @param int $page_id The ID of the WP page to search for
 * @param array $pages An array of WP page objects
 * @return boolean|object the page from the $pages array which corresponds to the $page_id
 * @author Simon Wheatley
 **/
function ep_get_page( $page_id, $pages ) {
	// PHP 5 would be much nicer here, we could use foreach by reference, ah well.
	$length = count($pages);
	for ( $i=0; $i<$length; $i++ ) {
		$page = & $pages[$i];
		if ( $page->ID == $page_id ) return $page;
	}
	// Unusual.
	return false;
}

// Is this page we're editing (defined by global $post_ID var) 
// currently NOT excluded (i.e. included),
// returns true if NOT excluded (i.e. included)
// returns false is it IS excluded.
// (Tricky this upside down flag business.)
function ep_this_page_included() {
	global $post_ID;
	// New post? Must be included then.
	if ( ! $post_ID ) return true;
	$excluded_ids = ep_get_excluded_ids();
	// If there's no exclusion array, we can return true
	if ( empty($excluded_ids) ) return true;
	// Check if our page is in the exclusion array
	// The bang (!) reverses the polarity [1] of the boolean
	return ! in_array( $post_ID, $excluded_ids );
	// fn1. (of the neutron flow, ahem)
}

// Check the ancestors for the page we're editing (defined by 
// global $post_ID var), return the ID if the nearest one which
// is excluded (if any);
function ep_nearest_excluded_ancestor() {
	global $post_ID, $wpdb;
	// New post? No problem.
	if ( ! $post_ID ) return false;
	$excluded_ids = ep_get_excluded_ids();
	// Manually get all the pages, to avoid our own filter.
	$sql = "SELECT ID, post_parent FROM $wpdb->posts WHERE post_type = 'page'";
	$pages = $wpdb->get_results( $sql );
	// Start recursively checking the ancestors
	$parent = ep_get_page( $post_ID, $pages );
	return ep_ancestor_excluded( $parent, $excluded_ids, $pages );
}

function ep_get_excluded_ids() {
	$exclude_ids_str = get_option( EP_OPTION_NAME );
	// No excluded IDs? Return an empty array
	if ( empty($exclude_ids_str) ) return array();
	// Otherwise, explode the separated string into an array, and return that
	return explode( EP_OPTION_SEP, $exclude_ids_str );
}

// This function gets all the exclusions out of the options
// table, updates them, and resaves them in the options table.
// We're avoiding making this a postmeta (custom field) because we
// don't want to have to retrieve meta for every page in order to
// determine if it's to be excluded. Storing all the exclusions in
// one row seems more sensible.
function ep_update_exclusions( $post_ID ) {
	// Bang (!) to reverse the polarity of the boolean, turning include into exclude
	$exclude_this_page = ! (bool) $_POST['ep_this_page_included'];
	// SWTODO: Also check for a hidden var, which confirms that this checkbox was present
	// If hidden var not present, then default to including the page in the nav (i.e. bomb out here rather
	// than add the page ID to the list of IDs to exclude)
	$ctrl_present = (bool) @ $_POST['ep_ctrl_present'];
	if ( ! $ctrl_present ) return;
	
	$excluded_ids = ep_get_excluded_ids();
	// If we need to EXCLUDE the page from the navigation...
	if ( $exclude_this_page ) {
		// Add the post ID to the array of excluded IDs
		array_push( $excluded_ids, $post_ID );
		// De-dupe the array, in case it was there already
		$excluded_ids = array_unique( $excluded_ids );
	}
	// If we need to INCLUDE the page in the navigation...
	if ( ! $exclude_this_page ) {
		// Find the post ID in the array of excluded IDs
		$index = array_search( $post_ID, $excluded_ids );
		// Delete any index found
		if ( $index !== false ) unset( $excluded_ids[$index] );
	}
	$excluded_ids_str = implode( EP_OPTION_SEP, $excluded_ids );
	ep_set_option( EP_OPTION_NAME, $excluded_ids_str, __( "Comma separated list of post and page IDs to exclude when returning pages from the get_pages function.", "exclude-pages" ) );
}

// Take an option, delete it if it exists, then add it.
function ep_set_option( $name, $value, $description ) {
	// Delete option	
	delete_option($name);
	// Insert option
	add_option($name, $value, $description);
}

/**
 * Callback function for the metabox on the page edit screen.
 *
 * @return void
 * @author Simon Wheatley
 **/
function ep_admin_sidebar_wp25() {
	$nearest_excluded_ancestor = ep_nearest_excluded_ancestor();
	echo '	<div id="excludepagediv" class="new-admin-wp25">';
	echo '		<div class="outer"><div class="inner">';
	echo '		<p><label for="ep_this_page_included" class="selectit">';
	echo '		<input ';
	echo '			type="checkbox" ';
	echo '			name="ep_this_page_included" ';
	echo '			id="ep_this_page_included" ';
	if ( ep_this_page_included() ) 
		echo 'checked="checked"';
	echo ' />';
	echo '			'.__( 'Include this page in lists of pages', EP_TD ).'</label>';
	echo '		<input type="hidden" name="ep_ctrl_present" value="1" /></p>';
	if ( $nearest_excluded_ancestor !== false ) {
		echo '<p class="ep_exclude_alert"><em>';
		printf( __( 'N.B. An ancestor of this page is excluded, so this page is too (<a href="%1$s" title="%2$s">edit ancestor</a>).', EP_TD), "post.php?action=edit&amp;post=$nearest_excluded_ancestor", __( 'edit the excluded ancestor', EP_TD ) );
		echo '</em></p>';
	}
	// If there are custom menus (WP 3.0+) then we need to clear up some
	// potential confusion here.
	if ( ep_has_menu() ) {
		echo '<p id="ep_custom_menu_alert"><em>';
		if ( current_user_can( 'edit_theme_options' ) )
			printf( __( 'N.B. This page can still appear in explicitly created <a href="%1$s">menus</a> (<a id="ep_toggle_more" href="#ep_explain_more">explain more</a>)', EP_TD),
				"nav-menus.php" );
		else
			_e( 'N.B. This page can still appear in explicitly created menus (<a id="ep_toggle_more" href="#ep_explain_more">explain more</a>)', EP_TD);
		echo '</em></p>';
		echo '<div id="ep_explain_more"><p>';
		if ( current_user_can( 'edit_theme_options' ) )
			printf( __( 'WordPress provides a simple function for you to maintain your site <a href="%1$s">menus</a>. If you create a menu which includes this page, the checkbox above will not have any effect on the visibility of that menu item.', EP_TD),
				"nav-menus.php" );
		else
			_e( 'WordPress provides a simple function for you to maintain the site menus, which your site administrator is using. If a menu includes this page, the checkbox above will not have any effect on the visibility of that menu item.', EP_TD);
		echo '</p><p>';
		echo _e( 'If you think you no longer need the Exclude Pages plugin you should talk to your WordPress administrator about disabling it.', EP_TD );
		echo '</p></div>';
	}
	echo '		</div><!-- .inner --></div><!-- .outer -->';
	echo '	</div><!-- #excludepagediv -->';
}

/**
 * A conditional function to determine whether there are any menus
 * defined in this WordPress installation.
 *
 * @return bool Indicates the presence or absence of menus
 * @author Simon Wheatley
 **/
function ep_has_menu() {
	if ( ! function_exists( 'wp_get_nav_menus' ) )
		return false;
	$menus = wp_get_nav_menus();
	foreach ( $menus as $menu_maybe ) {
		if ( $menu_items = wp_get_nav_menu_items($menu_maybe->term_id) )
			return true;
	}
}

/**
 * Hooks the WordPress admin_head action to inject some CSS.
 *
 * @return void
 * @author Simon Wheatley
 **/
function ep_admin_css() {
	echo <<<END
<style type="text/css" media="screen">
	.ep_exclude_alert { font-size: 11px; }
	.new-admin-wp25 { font-size: 11px; background-color: #fff; }
	.new-admin-wp25 .inner {  padding: 8px 12px; background-color: #EAF3FA; border: 1px solid #EAF3FA; -moz-border-radius: 3px; -khtml-border-bottom-radius: 3px; -webkit-border-bottom-radius: 3px; border-bottom-radius: 3px; }
	#ep_admin_meta_box .inner {  padding: inherit; background-color: transparent; border: none; }
	#ep_admin_meta_box .inner label { background-color: none; }
	.new-admin-wp25 .exclude_alert { padding-top: 5px; }
	.new-admin-wp25 .exclude_alert em { font-style: normal; }
</style>
END;
}

/**
 * Hooks the WordPress admin_head action to inject some JS.
 *
 * @return void
 * @author Simon Wheatley
 **/
function ep_admin_js() {
	echo <<<END
<script type="text/javascript">
//<![CDATA[
	jQuery( '#ep_explain_more' ).hide();
	jQuery( '#ep_toggle_more' ).click( function() {
		jQuery( '#ep_explain_more' ).toggle();
		return false;
	} );
//]]>
</script>
END;
}

// Add our ctrl to the list of controls which AREN'T hidden
function ep_hec_show_dbx( $to_show ) {
	array_push( $to_show, 'excludepagediv' );
	return $to_show;
}

// PAUSE & RESUME FUNCTIONS

function pause_exclude_pages() {
	remove_filter('get_pages','ep_exclude_pages');
}

function resume_exclude_pages() {
	add_filter('get_pages','ep_exclude_pages');
}

// INIT FUNCTIONS

function ep_init() {
	// Call this function on the get_pages filter
	// (get_pages filter appears to only be called on the "consumer" side of WP,
	// the admin side must use another function to get the pages. So we're safe to
	// remove these pages every time.)
	add_filter('get_pages','ep_exclude_pages');
	// Load up the translation gear
	$locale = get_locale();
	$folder = rtrim( basename( dirname( __FILE__ ) ), '/' );
	$mo_file = trailingslashit( WP_PLUGIN_DIR ) . "$folder/locale/" . EP_TD . "-$locale.mo";
	load_textdomain( EP_TD, $mo_file );
}

function ep_admin_init() {
	// Add panels into the editing sidebar(s)
	global $wp_version;
	add_meta_box('ep_admin_meta_box', __( 'Exclude Pages', EP_TD ), 'ep_admin_sidebar_wp25', 'page', 'side', 'low');

	// Set the exclusion when the post is saved
	add_action('save_post', 'ep_update_exclusions');

	// Add the JS & CSS to the admin header
	add_action('admin_head', 'ep_admin_css');
	add_action('admin_footer', 'ep_admin_js');

	// Call this function on our very own hec_show_dbx filter
	// This filter is harmless to add, even if we don't have the 
	// Hide Editor Clutter plugin installed as it's using a custom filter
	// which won't be called except by the HEC plugin.
	// Uncomment to show the control by default
	// add_filter('hec_show_dbx','ep_hec_show_dbx');
}

// HOOK IT UP TO WORDPRESS

add_action( 'init', 'ep_init' );
add_action( 'admin_init', 'ep_admin_init' )

?>