<?php
// SOCIAL WIDGET
class Socialwidget extends WP_Widget {

	function Socialwidget() {
		$widget_ops = array('classname' => 'social_widget', 'description' => __('Link to your RSS feed and social media accounts.'));
		$this->WP_Widget('social_networks', __('SS - Social'), $widget_ops, $control_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$title_link = strip_tags($instance['title_link']);		
    if (!empty( $title_link) ) { $title_page = get_post($title_link); }
		
		$networks['RSS'] = $instance['rss'];
		$networks['Twitter'] = $instance['twitter'];
		$networks['Facebook'] = $instance['facebook'];
		$networks['Flickr'] = $instance['flickr'];

		$display = $instance['display'];
		

		// echo $before_widget;
		echo $before_title;
		echo "<span class=\"socialheader\">";
		if (!empty( $title_link) ) { echo "<a href=\"" . get_permalink($title_page->ID) . "\">"; } 
		  if (empty( $title) ) { echo $title_page->post_title;}
		  else { echo strtolower($title); }
		if (!empty( $title_link) ) { echo "</a>"; } 
		echo "</span>";
		?>
		<?php echo $after_title; ?>
		



<div id="sidebar_social_wrap">
<ul>
<?php if (empty($networks['RSS'])) : ?>
<li><a href="<?php bloginfo('rss2_url'); ?>" target="_blank" class="rss">rss</a></li>
<?php else : ?>
<li><a href="<?= $networks['RSS'] ?>" target="_blank" class="rss">rss</a></li>
<?php endif; ?>	
<?php foreach(array("Twitter", "Facebook", "Flickr") as $network) : ?>
<?php if (!empty($networks[$network])) : ?>
<li><a href="<?= $networks[$network] ?>" target="_blank" class="<?php echo strtolower($network); ?>"><?php echo $network; ?></a></li>
<?php endif; ?>
<?php endforeach; ?>
</ul>
</div><!-- end sidebar_social_wrap -->
<br />


		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['title_link'] = $new_instance['title_link'];
		$instance['rss'] = $new_instance['rss'];
		$instance['twitter'] = $new_instance['twitter'];
		$instance['facebook'] = $new_instance['facebook'];
		$instance['flickr'] = $new_instance['flickr'];

		$instance['display'] = $new_instance['display'];

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '', 'title_link' => '' ) );
		$title = strip_tags($instance['title']);
		$title_link = strip_tags($instance['title_link']);		
		$rss = $instance['rss'];
		$twitter = $instance['twitter'];		
		$facebook = $instance['facebook'];	
		$flickr = $instance['flickr'];	

		$display = $instance['display'];		


		$text = format_to_edit($instance['text']);
?>
		

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

    	<p><label for="<?php echo $this->get_field_id('title_link'); ?>"><?php _e('Title link:'); ?></label>     
    	<?php wp_dropdown_pages(array('selected' => $title_link, 'name' => $this->get_field_name('title_link'), 'show_option_none' => __('None'), 'sort_column'=> 'menu_order, post_title'));?>
   		 </p>
		
		<p><label for="<?php echo $this->get_field_id('rss'); ?>"><?php _e('RSS URL: (leave empty for default feed)'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('rss'); ?>" name="<?php echo $this->get_field_name('rss'); ?>" type="text" value="<?php echo esc_attr($rss); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('Facebook URL:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo esc_attr($facebook); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Twitter URL:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo esc_attr($twitter); ?>" /></p>


		<p><label for="<?php echo $this->get_field_id('flickr'); ?>"><?php _e('Flickr URL:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('flickr'); ?>" name="<?php echo $this->get_field_name('flickr'); ?>" type="text" value="<?php echo esc_attr($flickr); ?>" /></p>

    
<?php
	}
}

add_action('widgets_init', create_function('', 'return register_widget("Socialwidget");'));

















class show_recent extends WP_Widget {
//UPdated to use the WP_Widget class, basically to allow multi-instanciating. May 25 2010. <--BUZU /._.\!
	function show_recent() {
		$widget_ops = array('classname' => 'show_recent', 'description' => __('Show your recent posts.'));
		$this->WP_Widget('show_recent', __('SS - Recent Posts'), $widget_ops, $control_ops);
	}

	function widget($args, $instance){
		extract($args);

		//$options = get_option('custom_recent');
		$title = $instance['title'];
		$posts = $instance['posts'];

		//GET the posts
		global $post;
		$exclude = get_option('ss_blogexclude');//Lets exclude the posts ^-^!
		$myposts = get_posts('numberposts='.$posts.'&offset=0&category='.$exclude);
		
		echo $before_widget . $before_title . $title . $after_title;


		//SHOW the posts
		foreach($myposts as $post){
			setup_postdata($post);
//added strip_tags to solve a problem with code being displayed improperly.
			?>

				<h4><?php the_title(); ?></h4>
				<p class="footer_post"><a href="<?php the_permalink() ?>"><?php echo substr(strip_tags($post->post_content), 0, 150); ?>...</a></p>
			<?php
		}
		echo $after_widget;
	}

	function update($newInstance, $oldInstance){
		$instance = $oldInstance;
		$instance['title'] = strip_tags($newInstance['title']);
		$instance['posts'] = $newInstance['posts'];

		return $instance;
	}

	function form($instance){
		echo '<p style="text-align:right;"><label for="'.$this->get_field_id('title').'">' . __('Title:') . ' <input style="width: 200px;" id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.$instance['title'].'" /></label></p>';

		echo '<p style="text-align:right;"><label for="'.$this->get_field_id('posts').'">' . __('Number of Posts:', 'widgets') . ' <input style="width: 50px;" id="'.$this->get_field_id('posts').'" name="'.$this->get_field_name('posts').'" type="text" value="'.$instance['posts'].'" /></label></p>';

		echo '<input type="hidden" id="custom_recent" name="custom_recent" value="1" />';
	}
}

add_action('widgets_init', create_function('', 'return register_widget("show_recent");'));
?>
