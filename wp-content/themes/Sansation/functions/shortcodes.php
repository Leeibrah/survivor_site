<?php


/* RAW TEXT   [raw] [/raw]*/
function my_formatter($content) {
	$new_content = '';
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

	foreach ($pieces as $piece) {
		if (preg_match($pattern_contents, $piece, $matches)) {
			$new_content .= $matches[1];
		} else {
			$new_content .= wptexturize(wpautop($piece));
		}
	}

	return $new_content;
}

remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');

add_filter('the_content', 'my_formatter', 1);//changed 99 for 1 to fire the filter earlier and avoid converting raw text that was not entered by the user, but by a plugin.






/* SEND TO TWITTER   [twitter] */
function twitt() {
  return '<div id="twitit"><a href="http://twitter.com/home?status=Currently reading '.get_permalink($post->ID).'" title="Click to send this page to Twitter!" target="_blank">Share on Twitter</a></div>';
}

add_shortcode('twitter', 'twitt');







/* OBFUSCATE AN EMAIL ADDRESS      [mailto]email@yourdomain.com[/mailto] */
function munge_mail_shortcode( $atts , $content=null ) {
 
	for ($i = 0; $i < strlen($content); $i++) $encodedmail .= "&#" . ord($content[$i]) . ';'; 
 
    return '<a href="mailto:'.$encodedmail.'">'.$encodedmail.'</a>';
 
}
add_shortcode('mailto', 'munge_mail_shortcode');











/* DISPLAY RELATED POSTS      [related_posts] */
function related_posts_shortcode( $atts ) {
	extract(shortcode_atts(array(
	    'limit' => '5',
	), $atts));

	global $wpdb, $post, $table_prefix;

	if ($post->ID) {
		$retval = '<ul>';
 		// Get tags
		$tags = wp_get_post_tags($post->ID);
		$tagsarray = array();
		foreach ($tags as $tag) {
			$tagsarray[] = $tag->term_id;
		}
		$tagslist = implode(',', $tagsarray);

		// Do the query
		$q = "SELECT p.*, count(tr.object_id) as count
			FROM $wpdb->term_taxonomy AS tt, $wpdb->term_relationships AS tr, $wpdb->posts AS p WHERE tt.taxonomy ='post_tag' AND tt.term_taxonomy_id = tr.term_taxonomy_id AND tr.object_id  = p.ID AND tt.term_id IN ($tagslist) AND p.ID != $post->ID
				AND p.post_status = 'publish'
				AND p.post_date_gmt < NOW()
 			GROUP BY tr.object_id
			ORDER BY count DESC, p.post_date_gmt DESC
			LIMIT $limit;";

		$related = $wpdb->get_results($q);
 		if ( $related ) {
			foreach($related as $r) {
				$retval .= '<li><a title="'.wptexturize($r->post_title).'" href="'.get_permalink($r->ID).'">'.wptexturize($r->post_title).'</a></li>';
			}
		} else {
			$retval .= '
	<li>No related posts found</li>';
		}
		$retval .= '</ul>';
		return $retval;
	}
	return;
}
add_shortcode('related_posts', 'related_posts_shortcode');









/* GOOGLE DOCS PDF VIEWER     [pdf href="http://yoursite.com/linktoyour/file.pdf"]View PDF[/pdf]  */
function pdflink($attr, $content) {
	return '<a class="pdf" target="_blank" href="http://docs.google.com/viewer?url=' . $attr['href'] . '">'.$content.'</a>';
}
add_shortcode('pdf', 'pdflink');

?>
