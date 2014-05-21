<?php
$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array();
foreach ($categories as $category_list ) {
$wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}
array_unshift($wp_cats, "Choose a category");
$tween_types = array("linear","easeInSine","easeOutSine", "easeInOutSine", "easeInCubic", "easeOutCubic", "easeInOutCubic", "easeOutInCubic", "easeInQuint", "easeOutQuint", "easeInOutQuint", "easeOutInQuint", "easeInCirc", "easeOutCirc", "easeInOutCirc", "easeOutInCirc", "easeInBack", "easeOutBack", "easeInOutBack", "easeOutInBack", "easeInQuad", "easeOutQuad", "easeInOutQuad", "easeOutInQuad", "easeInQuart", "easeOutQuart", "easeInOutQuart", "easeOutInQuart", "easeInExpo", "easeOutExpo", "easeInOutExpo", "easeOutInExpo", "easeInElastic", "easeOutElastic", "easeInOutElastic", "easeOutInElastic", "easeInBounce", "easeOutBounce", "easeInOutBounce", "easeOutInBounce");


$options = array (

array( "name" => $themename." Options",
"type" => "title"),

array( "name" => "General Settings",
"type" => "section"),
array( "type" => "open"),

array( "name" => "Color Scheme",
"desc" => "Select the color scheme for your website.",
"id" => $shortname."_color_scheme",
"type" => "select",
"options" => array("army_green", "blue_smoke", "cool_blue", "jet_black", "keylime_green", "mocha_brown", "modern_red", "plum_red", "purple_rain", "sand_sea", "sky_blue", "teal"),
"std" => ""),

array( "name" => "Logo URL",
"desc" => "Enter the URL of your logo file.<br /><strong>(EXAMPLE: http://www.yourwebsite.com/wp-content/uploads/logo.jpg)</strong>",
"id" => $shortname."_sitelogo",
"type" => "text",
"std" => ""),

array( "name" => "Logo Margin",
"desc" => "Modify the margin of your logo to better suite your needs.<br /><strong>MARGIN GUIDE:</strong><br />margin: top right bottom left; ",
"id" => $shortname."_sitelogomargin",
"type" => "text",
"std" => "margin: 20px 0 25px 0;"),

array( "name" => "Sub-Page Banner Height",
"desc" => "Please select which height banner you would like on your sub-pages. Half height is 100px tall and normal is around 190px tall.",
"id" => $shortname."_banner_height",
"type" => "select",
"options" => array("half-height","normal"),
"std" => ""),

array( "name" => "Sub-Page Banner Text Width (right side)",
"desc" => "Set the width of the text that appears on the right side of the banner area on all sub pages.",
"id" => $shortname."_banner_width",
"type" => "text",
"std" => "550px"),

array( "name" => "Twitter ID for Latest Tweet",
"desc" => "Enter your Twitter ID to display your latest tweet on the homepage, otherwise just leave the field blank.<br /><strong>(EXAMPLE: seanmc5)</strong>",
"id" => $shortname."_latesttweet",
"type" => "text",
"std" => ""),

array( "name" => "Footer Copyright info",
"desc" => "Enter the copyright info to be displayed in the bottom of your footer.<br /><strong>(Must use HTML code here)</strong>",
"id" => $shortname."_footertext",
"type" => "textarea",
"std" => "<p></p>"),

array( "name" => "Google Analytics Code",
"desc" => "You can paste your Google Analytics or other tracking code in this box. This will be automatically added to your site's code before the closing &lt;body&gt; tag.",
"id" => $shortname."_ga_code",
"type" => "textarea",
"std" => ""),

array( "name" => "Custom CSS",
"desc" => "Use this space if you'd like to add custom CSS code to your website.",
"id" => $shortname."_css_code",
"type" => "textarea",
"std" => ""),	

array( "type" => "close"),









array( "name" => "Homepage 3D Settings",
"type" => "section"),
array( "type" => "open"),


array( "name" => "Segments",
"desc" => "Number of segments in which the image will be sliced.",
"id" => $shortname."_segments",
"type" => "text",
"std" => "15"),

array( "name" => "Tween Time",
"desc" => "Number of seconds for each element to be turned.",
"id" => $shortname."_tween_time",
"type" => "text",
"std" => "2.5"),

array( "name" => "Tween Delay",
"desc" => "Number of seconds from one element starting to turn to the next element starting.",
"id" => $shortname."_tween_delay",
"type" => "text",
"std" => "0.1"),

array( "name" => "Tween Type",
"desc" => "Type of animation transition.",
"id" => $shortname."_tween_type",
"type" => "select",
"options" => $tween_types,
"std" => "Choose a category"),

array( "name" => "Z Distance",
"desc" => "to which extend are the cubes moved on z axis when being tweened. Negative values bring the cube closer to the camera, positive values take it further away. A good range is roughly between -200 and 700.",
"id" => $shortname."_z_distance",
"type" => "text",
"std" => "100"),

array( "name" => "Expand",
"desc" => "To which etxend are the cubes moved away from each other when tweening.",
"id" => $shortname."_expand",
"type" => "text",
"std" => "9"),

array( "name" => "Inner Color",
"desc" => "Color of the sides of the elements in hex values (e.g. 0x000000 for black)",
"id" => $shortname."_inner_color",
"type" => "text",
"std" => "0x000000"),

array( "name" => "Shadow Darkness",
"desc" => "To which extend are the sides shadowed, when the elements are tweening and the sided move towards the background. 100 is black, 0 is no darkening.",
"id" => $shortname."_shadow_darkness",
"type" => "text",
"std" => "25"),

array( "name" => "Auto Play",
"desc" => "Number of seconds to the next image when autoplay is on. Set 0, if you don't want autoplay.",
"id" => $shortname."_autoplay",
"type" => "text",
"std" => "2"),

array( "type" => "close"),










array( "name" => "Homepage 3D Images",
"type" => "section"),
array( "type" => "open"),

array( "name" => "Enter Your Upload Path",
"desc" => "Enter the upload path where files are stored on your server. <strong>EXAMPLE: </strong>http://www.yourwebsite.com/wp-content/uploads/",
"id" => $shortname."_3dupload",
"type" => "text",
"std" => "http://www.yourwebsite.com/wp-content/uploads/"),


array( "name" => "Image 1",
"desc" => "Enter the name of the image you uploaded into your media library",
"id" => $shortname."_3dimage",
"type" => "text",
"std" => "banner1.jpg"
),

array( "name" => "Image 2",
"desc" => "Enter the name of the image you uploaded into your media library",
"id" => $shortname."_3dimage2",
"type" => "text",
"std" => ""),

array( "name" => "Image 3",
"desc" => "Enter the name of the image you uploaded into your media library",
"id" => $shortname."_3dimage3",
"type" => "text",
"std" => ""),

array( "name" => "Image 4",
"desc" => "Enter the name of the image you uploaded into your media library",
"id" => $shortname."_3dimage4",
"type" => "text",
"std" => ""),

array( "name" => "Image 5",
"desc" => "Enter the name of the image you uploaded into your media library",
"id" => $shortname."_3dimage5",
"type" => "text",
"std" => ""),

array( "name" => "Image 6",
"desc" => "Enter the name of the image you uploaded into your media library",
"id" => $shortname."_3dimage6",
"type" => "text",
"std" => ""),

array( "name" => "Image 7",
"desc" => "Enter the name of the image you uploaded into your media library",
"id" => $shortname."_3dimage7",
"type" => "text",
"std" => ""),

array( "name" => "Image 8",
"desc" => "Enter the name of the image you uploaded into your media library",
"id" => $shortname."_3dimage8",
"type" => "text",
"std" => ""),

array( "name" => "Image 9",
"desc" => "Enter the name of the image you uploaded into your media library",
"id" => $shortname."_3dimage9",
"type" => "text",
"std" => ""),

array( "name" => "Image 10",
"desc" => "Enter the name of the image you uploaded into your media library",
"id" => $shortname."_3dimage10",
"type" => "text",
"std" => ""),

array( "type" => "close"),












array( "name" => "Homepage JQuery Settings",
"type" => "section"),
array( "type" => "open"),

array( "name" => "Total # of Items to display",
"desc" => "Enter the amount of items you would like to display in your homepage slider.<br /><strong>(NOTE: we recommend 4 items max.)</strong>",
"id" => $shortname."_homeitems",
"type" => "text",
"std" => ""),

array( "name" => "Slider Feature Category",
"desc" => "Choose the post category that the Homepage slider should pull from.",
"id" => $shortname."_feathome_cat",
"type" => "select",
"options" => $wp_cats,
"std" => "Choose a category"),

array( "name" => "Slider Timeout",
"desc" => "Enter the amount of time you would like between slides.<br /><strong>(NOTE: the number must be in milliseconds. 5500 = 5.5 seconds, 1000 = 1 second, etc.)</strong>",
"id" => $shortname."_hometimeout",
"type" => "text",
"std" => "5500"),

array( "type" => "close"),











array( "name" => "Portfolio Settings",
"type" => "section"),
array( "type" => "open"),

array( "name" => "Total Items to display",
"desc" => "Enter the amount of items you would like to display on your Portfolio/Gallery pages.<br /><strong>(IMPORTANT: To keep things looking pretty we recommend using multiples of (3). 3, 6, 9, 12, 15, 18, 21, etc)</strong>",
"id" => $shortname."_portitems",
"type" => "text",
"std" => ""),

array( "type" => "close"),











array( "name" => "Blog Settings",
"type" => "section"),
array( "type" => "open"),


array( "name" => "Blog Banner Title<br />(left side)",
"desc" => "Enter the title you would like to be displayed in the colored banner area on the blog pages.",
"id" => $shortname."_blogtitle",
"type" => "text",
"std" => "Blog"),



array( "name" => "Blog Banner Text<br />(right side)",
"desc" => "Enter the text you would like to be displayed in the colored banner area on the blog pages. <strong>Must be in HTML</strong>",
"id" => $shortname."_blogtext",
"type" => "textarea",
"std" => "<p></p>"),


array( "name" => "Post Categories to Exclude",
"desc" => "Enter the post categories you'd like to exclude from all blog pages.<br /><strong>(EXAMPLE: -6,-5,-4)</strong>",
"id" => $shortname."_blogexclude",
"type" => "text",
"std" => "-100"),
array( "type" => "close"),








array( "name" => "Contact Page Settings",
"type" => "section"),
array( "type" => "open"),


array( "name" => "Your Email Address",
"desc" => "Enter the email address where you'd like the contact form sent.<br /><strong>(EXAMPLE: info@5-squared.com)</strong>",
"id" => $shortname."_contactemail",
"type" => "text",
"std" => ""),



array( "name" => "Contact Form Success Message",
"desc" => "Enter the message you would like users to see after they submit the form.",
"id" => $shortname."_contactsuccess",
"type" => "textarea",
"std" => "Thanks for submitting the form. We will get in touch with you shortly."),


array( "type" => "close")
);















function mytheme_add_admin() {

global $themename, $shortname, $options;

if ( $_GET['page'] == basename(__FILE__) ) {

if ( 'save' == $_REQUEST['action'] ) {

foreach ($options as $value) {
update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

foreach ($options as $value) {
if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }

header("Location: admin.php?page=custom-admin-menu.php&saved=true");
die;

}
else if( 'reset' == $_REQUEST['action'] ) {

foreach ($options as $value) {
delete_option( $value['id'] ); }

header("Location: admin.php?page=custom-admin-menu.php&reset=true");
die;

}
}

add_menu_page($themename, $themename, 'administrator', basename(__FILE__), 'mytheme_admin');
}

function mytheme_add_init() {
$file_dir=get_bloginfo('template_directory');
wp_enqueue_style("admin", $file_dir."/functions/admin.css", false, "1.0", "all");
wp_enqueue_script("ss_script", $file_dir."/functions/ss_script.js", false, "1.0"); 
}











function mytheme_admin() {

global $themename, $shortname, $options;
$i=0;

if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';

?>
<div class="wrap rm_wrap">
<h2><?php echo $themename; ?> Settings</h2>

<div class="rm_opts">
<form method="post">












<?php foreach ($options as $value) {
switch ( $value['type'] ) {

case "open":
?>

<?php break;

case "close":
?>

</div>
</div>
<br />

<?php break;

case "title":
?>
<p>Enter your settings for <?php echo $themename;?> below. If you have any questions please refer to the user manual.</p>

<?php break;

case 'text':
?>

<div class="rm_input rm_text">
<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>

</div>
<?php
break;

case 'textarea':
?>

<div class="rm_input rm_textarea">
<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea>
<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>

</div>

<?php
break;

case 'select':
?>

<div class="rm_input rm_select">
<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>

<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
<option <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?>
</select>

<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
</div>
<?php
break;

case "checkbox":
?>

<div class="rm_input rm_checkbox">
<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>

<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />

<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
</div>
<?php break;

case "section":

$i++;

?>

<div class="rm_section">
<div class="rm_title"><h3><img src="<?php bloginfo('template_directory')?>/functions/images/trans.gif" class="inactive" alt="""><?php echo $value['name']; ?></h3><span class="submit"><input name="save<?php echo $i; ?>" type="submit" value="Save changes" />
</span><div class="clearfix"></div></div>
<div class="rm_options">

<?php break;

}
}
?>

<input type="hidden" name="action" value="save" />
</form>
</div>
</div> 

<?php
}
add_action('admin_init', 'mytheme_add_init');
add_action('admin_menu', 'mytheme_add_admin');
?>