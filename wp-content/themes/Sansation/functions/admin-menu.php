<?php 

// create custom plugin settings menu
add_action('admin_menu', 'ss_create_menu');

function ss_create_menu() {

	//create new top-level menu
	add_menu_page('Google Analytics Settings', 'Analytics Settings', 'administrator', __-FILE__, 'ss_settings_page', 'favicon.ico');

	//call register settings function
	add_action( 'admin_init', 'register_mysettings' );
}





function register_mysettings() {
	//register our settings
	register_setting( 'ss-settings-group', 'ss_tracking_code' );
}







function ss_settings_page() {
?>



<div class="wrap">
<h2>Google Analytics Settings</h2>

<form method="post" action="options.php">

    <?php settings_fields('ss-settings-group'); ?>
    <table class="form-table">

        <tr valign="top">
        <th scope="row"><strong>Tracking Code:</strong></th>
        <td><textarea name="ss_tracking_code"><?php echo get_option('ss_tracking_code'); ?></textarea></td>
        </tr>

		<tr valign="top">
        <th scope="row">&nbsp;</th>
        <td><strong>Example:</strong> UA-13246800-2
		<br><br>Need Help Finding your tracking code? <a href="http://www.google.com/support/googleanalytics/bin/answer.py?hl=en&answer=55603" target="_blank">Click here</a>.
		<br><br>(just leave the field blank to disable google analytics)
		</td>
        </tr>

    </table>

    <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    </p>

</form>
</div>
<?php } ?>