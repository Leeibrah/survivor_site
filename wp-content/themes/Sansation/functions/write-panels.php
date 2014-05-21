<?php
/* ADDS WRITE PANELS TO PAGES */
$new_meta_boxes = 
array(
"image" => array(
"name" => "_text",
"std" => "<p></p>",
"title" => "This text will appear at the top of the page in the colored banner area.",
"description" => "<b>NOTE:</b> You need to use HTML code in this field.")
);






/* ADDS WRITE PANELS TO POSTS */
$new_meta_boxes_2 =
array(
"image2" => array(
"name" => "_portimage1",
"std" => "",
"title" => "URL for Thumbnail Image. (automatic resizing - simply enter URL to full-size image)",
"description" => "<b>EXAMPLE:</b> http://www.yourdomain.com/wp-content/uploads/2010/03/project1.jpg"),


"image3" => array(
"name"=>"_portimage2",
"std"=>"",
"title"=>"URL for Full Size Portfolio Item. (Flash Video, Full-size image, Youtube Content, etc.)",
"description"=>"<b>EXAMPLES:</b><br /><b>FLASH:</b> http://www.adobe.com/products/flashplayer/include/marquee/design.swf?width=792&amp;height=294<br />
<b>VIMEO:</b> http://vimeo.com/8245346<br />
<b>IFRAME:</b> http://www.apple.com?iframe=true&width=850&height=500<br />
<b>YOUTUBE:</b> http://www.youtube.com/watch?v=VKS08be78os<br />
<b>IMAGES:</b> http://www.yourwebsite.com/wp-content/uploads/2010/03/project1-big.jpg<br />
"),


"image4" => array(
"name"=>"_portimage",
"std"=>"",
"title"=>"Title of the Portfolio Item.",
"description"=>"<b>NOTE:</b> This description shows up in the JQuery pop-up."),


"image30" => array(
"name"=>"_testimonial",
"std"=>"<p></p>",
"title"=>"Client Testimonial (only valid for 'Portfolio' template)",
"description"=>"<b>NOTE:</b> Testimonials are to be used with the Portfolio Page template."),


"image40" => array(
"name"=>"_clientsname",
"std"=>"<p></p>",
"title"=>"Clients Name (only valid for 'Portfolio' template)",
"description"=>"<b>NOTE:</b> This will get displayed right under the testimonial. HTML is ok.")
);






function new_meta_boxes() {
global $post, $new_meta_boxes;
foreach($new_meta_boxes as $meta_box) {
$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);
if($meta_box_value == "")
$meta_box_value = $meta_box['std'];
echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
echo'<h2>'.$meta_box['title'].'</h2>';
echo'<textarea name="'.$meta_box['name'].'_value" style="width:95%;height:150px;"/>'.$meta_box_value.'</textarea><br /><br />';
echo'<p><label for="'.$meta_box['name'].'_value">'.$meta_box['description'].'</label></p>';
}
}




function new_meta_boxes_2() {
global $post, $new_meta_boxes_2;
foreach($new_meta_boxes_2 as $meta_box) {
$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);
if($meta_box_value == "")
$meta_box_value = $meta_box['std'];
echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
echo'<h3>'.$meta_box['title'].'</h3>';
echo'<input type="text" name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" style="width:100%;height:60px;"/><br />';
echo'<p style="color:#FF0000;"><label for="'.$meta_box['name'].'_value">'.$meta_box['description'].'</label></p><br /><br /><br />';
}
}







function create_meta_box() {

global $theme_name;
if ( function_exists('add_meta_box') ) {
add_meta_box( 'new-meta-boxes', 'Custom Banner Text', 'new_meta_boxes', 'page', 'normal', 'high' );
add_meta_box( 'new-meta-boxes', 'Gallery / Portfolio Details', 'new_meta_boxes_2', 'post', 'normal', 'high' );
}
}






function save_postdata( $post_id ) {



global $post, $new_meta_boxes, $new_meta_boxes_2;
if('post' == $_POST['post_type']){
          $new_meta_boxes = $new_meta_boxes_2;//just a little trick to use either array depending on the type of post.
}
foreach($new_meta_boxes as $meta_box) {
// Verify
if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {
return $post_id;
}




if ( 'page' == $_POST['post_type'] ) {
if ( !current_user_can( 'edit_page', $post_id ))
return $post_id;
} else {
if ( !current_user_can( 'edit_post', $post_id ))
return $post_id;
}



$data = $_POST[$meta_box['name'].'_value'];
if(get_post_meta($post_id, $meta_box['name'].'_value') == "")
add_post_meta($post_id, $meta_box['name'].'_value', $data, true);
elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))
update_post_meta($post_id, $meta_box['name'].'_value', $data);
elseif($data == "")
delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));
}
}



add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_postdata');
?>
<?php
/*CUSTOM PORTFOLIO CATEGORIES FUNCTIONS */
function add_portfolio_cat($post_id){
	/*
		*this function adds a list of the categories as a custom write pannel
		*to the pages section in the admin area. 
		*this will allow the user to specify different pages as portfolio pages.
	*/
	$categories = get_categories('orderby=name');
	global $post;
	echo "<br />";
	$n = get_post_meta($post->ID, '_multiple_portfolio_cat_id', true);
	?>
	<p>If this is a portfolio page, pick the category whose posts you want to be displayed. If this is not a portfolio page, you can simply ignore this section.</p>
	<?php
	echo "<select name='multiple_portfolio_cat_id'>";
	echo "<option value=''>Pick one</option>";
	foreach($categories as $category){
		$id = $category->cat_ID;
		if($id == $n){
			$checked = 'selected="selected"';
		}else{
			$checked  = '';
		}
		echo "<option $checked value='{$category->cat_ID}'>{$category->name}</option>";
	}
	echo "</select>";
}

function create_multiple_portfolio_pages(){
	add_meta_box( 'multiple-portfolio-pages', 'Portfolio/Gallery Category', 'add_portfolio_cat', 'page', 'normal', 'high' );
}

function save_multiple_portfolio_options($post_id){
	if('page' == $_POST['post_type']){
		$value = $_POST['multiple_portfolio_cat_id'];
		$key = '_multiple_portfolio_cat_id';
		$already_there = get_post_meta($post_id, $key, true);

		if(!is_numeric($value) && $value != ''){
			wp_die('WRONG portfolio category value.');
		}

		if(get_post_meta($post_id, $key) == ''){
			add_post_meta($post_id, $key, $value, $true);
		}else if($value != get_post_meta($post_id, $key, true)){
			update_post_meta($post_id, $key, $value);
		}else if($value == ''){
			delete_post_meta($post_id, $key);
		}
	}
}

add_action('save_post', 'save_multiple_portfolio_options');
add_action('admin_menu','create_multiple_portfolio_pages');
?>