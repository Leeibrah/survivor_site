<?php
/*
Template Name: Contact Page
*/
?>
<?php get_header(); ?>
<body>
<div id="header">
	<div class="center relative">
	<?php $sc_logo = get_option('ss_sitelogo');
	$sc_logo_margin = get_option('ss_sitelogomargin');
	$sc_banner_width = get_option('ss_banner_width'); ?>
	<a href="<?php echo get_option('home'); ?>/" title="<?php bloginfo('name'); ?>" class="ss_logo" style="<?php echo $sc_logo_margin; ?>">
		<img src="http://localhost/survivors/wp-content/uploads/2014/05/logo.jpg" alt="<?php bloginfo('name'); ?>" />
	</a>
<div id="nav_main">
	<?php
	if (function_exists('wp_nav_menu')) {
		wp_nav_menu(array('menu_class' => 'sf-menu','theme_location' => 'ss-main-menu', 'fallback_cb' => 'ss_default_menu'));
	}
	else {
		sjc_default_menu();
	}
	?>
</div><!-- end nav_main -->





<?php
if(function_exists('wp_nav_menu')) {
wp_nav_menu(array(
'theme_location' => 'top-nav',
'container' => '',
'container_id' => 'logo-inner',
'menu_id' => 'top-nav',
'fallback_cb' => 'topnav_fallback',
));
} else {
?>
<!-- Hard-coded menu -->
<ul id="top-nav" role="navigation">
<li><a href="#contact-us">Contact Us</a></li>
<li><a href="#log-in">Log In</a></li>
<li><a href="#about-us">About Us</a></li>
<li><a href="#home">Home</a></li>
</ul> <!-- #top-nav -->
<?php
}
?>


	</div><!-- end center -->
</div><!-- end header -->


<div id="interiorbanner"<?php $banner = get_option('ss_banner_height'); if ($banner != 'normal') { echo ' class="half-height"';} ?>>
	<div class="center">
		<h2 class="ptitle"><?php if(have_posts()) : while(have_posts()) : the_post(); ?><?php the_title(); ?><?php endwhile; endif; ?></h2>
		<div class="content_banner" <?php echo 'style="width:' . $sc_banner_width . ';">'; ?>
			<div class="ss_position">
				<div class="ss_content">
					<?php if(get_post_meta($post->ID, "_text_value", $single = true) != "") : echo get_post_meta($post->ID, "_text_value", $single = true); ?>
					<?php endif; ?>
				</div><!-- end ss_content -->
			</div><!-- end ss_position -->
		</div><!-- end content_banner -->
	</div><!-- end center -->
</div><!-- end interiorbanner -->





<div id="content_wrap" class="nobg">
<?php
$children = wp_list_pages('&child_of='.$post->parent.'&echo=0');
if(!$children) { $children = wp_list_pages('&child_of='.$post->ID.'&echo=0'); } 
if ($children) : ?>
<div class="center">
		<div id="horizontal_nav">
		<?php
		if($post->post_parent)
		$children = wp_list_pages("sort_column=menu_order&depth=1&title_li=&child_of=".$post->post_parent."&echo=0"); else
		$children = wp_list_pages("sort_column=menu_order&depth=1&title_li=&child_of=".$post->ID."&echo=0");
		if ($children) { ?>
		<ul>
		<?php echo $children; ?>
		</ul>
		<?php } ?>
		
		</div><!-- end horizontal_nav -->
	</div><!-- end center -->
<?php endif; ?>

	<div id="full_width" class="gradient">
		<div class="center">
			<div id="main_content_sidebar">
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
		<?php the_content(); ?>
		<?php endwhile; endif; ?>

		<?php $contact_success = get_option('ss_contactsuccess'); ?>
		<?
		$formname     = 'Your Name';
        $formemail    = 'Email Address';
        $formcomments  = 'Message';
		
        if(isset($_POST['contactus'])) {
        
		$formname     = $_POST['formname'];
        $formemail    = $_POST['formemail'];
        $formcomments  = $_POST['formcomments'];

		
        if(trim($formname) == '' || trim($formname) == 'Your Name') {
        	$error = '<div class="error_message"><p>Please enter your name.</p></div>';
			
	    } else if(!isEmail($formemail)) {
        	$error = '<div class="error_message"><p>Please enter a valid E-mail address.</p></div>';
        
		}
		
        if($error == '') {
        
			if(get_magic_quotes_gpc()) {
            	$comments = stripslashes($comments);
            }

         
		 // Enter the email address that you want to emails to be sent to.	 
          $address = get_option('ss_contactemail');
   
		 
         // Example, $e_subject = '$name . ' has contacted you via Your Website.';
         $e_subject = 'WordPress - Message from Your Website';

					
		 $e_body = "This information has been submitted from your website:<br><br>";
		 $e_content = "<b>Name:</b> $formname<br>
		 <b>Email Address:</b> <a href=\"mailto:$formemail\">$formemail</a><br>
		 <b>Comments:</b> $formcomments<br>";
				
         $msg = $e_body . $e_content;
         mail($address, $e_subject, $msg, "From: $formemail\nReply-To: $formemail\nReturn-Path: $formemail\nContent-Type: text/html\n");

		 // Email has sent successfully, echo a success page.				
		 echo "<div class=\"success_message\"><p>" . $contact_success ."</p></div>";
                      
		}
	}

         if(!isset($_POST['contactus']) || $error != '') // Do not edit.
         {
?>
            <? echo $error; ?>
            <br />
        
				<form method="post" action="" name="contactform">
				<p><input type="text" class="post_user_name" id="formname" name="formname" value="<?=$formname;?>" onfocus="this.value=(this.value=='Your Name') ? '' : this.value;" onblur="this.value=(this.value=='') ? 'Your Name' : this.value;"/></p>
				<p><input type="text" class="post_user_email" id="formemail" name="formemail" value="<?=$formemail;?>" onfocus="this.value=(this.value=='Email Address') ? '' : this.value;" onblur="this.value=(this.value=='') ? 'Email Address' : this.value;" /></p>
				<p><textarea class="post_user_message" rows="5" cols="10" id="formcomments" name="formcomments" onfocus="this.value=(this.value=='Message') ? '' : this.value;" onblur="this.value=(this.value=='') ? 'Message' : this.value;"><?=$formcomments;?></textarea></p>
				<p><input type="submit" value="Submit" name="contactus" id="contactus" class="contactsubmit" /></p>
				</form>
            
<? } 
	
function isEmail($email) { // Email address verification, do not edit.
return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i",$email));
}

?>
		</div><!-- end main_content_sidebar -->


		<!--
		<div id="sidebar">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Contact Sidebar") ) : ?><h3>CONTACT SIDEBAR</h3><p><a href='<?php bloginfo('siteurl')?>/wp-admin/widgets.php'>Widgetize this sidebar</a></p>
			<?php endif; ?>		
		</div> end sidebar -->
	</div><!-- end center -->
</div><!-- end full_width -->
</div><!-- end content_wrap -->

<?php get_footer(); ?>