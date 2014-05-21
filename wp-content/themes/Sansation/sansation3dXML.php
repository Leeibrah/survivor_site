<?php $fullpath = dirname(__FILE__);
$subpath  = split('wp-content', $fullpath);
require_once( $subpath[0] . '/wp-load.php' );
$segments = get_option('ss_segments');
$tweentime = get_option('ss_tween_time');
$tweendelay = get_option('ss_tween_delay');
$tweentype = get_option('ss_tween_type');
$zdistance = get_option('ss_z_distance');
$expand = get_option('ss_expand');
$innercolor = get_option('ss_inner_color');
$textbackground = get_option('ss_text_background');
$textdistance = get_option('ss_text_distance');
$shadow = get_option('ss_shadow_darkness');
$autoplay = get_option('ss_autoplay');
?>
<?php /* header("Content-type: text/xml"); gave back an error on my server */
echo '<?xml version="1.0" encoding="utf-8" ?>
<Piecemaker>
  <Settings>
	<imageWidth>830</imageWidth>
	<imageHeight>360</imageHeight>';
echo '<segments>'. $segments . '</segments>';
echo '<tweenTime>'. $tweentime . '</tweenTime>';
echo '<tweenDelay>'. $tweendelay . '</tweenDelay>';
echo '<tweenType>'. $tweentype . '</tweenType>';
echo '<zDistance>'. $zdistance . '</zDistance>';
echo '<expand>'. $expand . '</expand>';
echo '<innerColor>'. $innercolor . '</innerColor>';
echo '<textBackground>'. $textbackground . '</textBackground>';
echo '<textDistance>'. $textdistance . '</textDistance>';
echo '<shadowDarkness>' . $shadow . '</shadowDarkness>';
echo '<autoplay>' . $autoplay .  '</autoplay>'; 
echo '
</Settings>'
?>




<?php

	$image1 = get_option('ss_3dimage');
	$image2 = get_option('ss_3dimage2');
	$image3 = get_option('ss_3dimage3');
	$image4 = get_option('ss_3dimage4');
	$image5 = get_option('ss_3dimage5');
	$image6 = get_option('ss_3dimage6');
	$image7 = get_option('ss_3dimage7');
	$image8 = get_option('ss_3dimage8');
	$image9 = get_option('ss_3dimage9');
	$image10 = get_option('ss_3dimage10');


if ($image1 != '') {
	 	echo '<Image Filename="' . $image1 . '"></Image>';
		}

if ($image2 != '') {
	 	echo '<Image Filename="' . $image2 . '"></Image>';
		}

if ($image3 != '') {
	 	echo '<Image Filename="' . $image3 . '"></Image>';
		}

if ($image4 != '') {
	 	echo '<Image Filename="' . $image4 . '"></Image>';
		}

if ($image5 != '') {
	 	echo '<Image Filename="' . $image5 . '"></Image>';
		}

if ($image6 != '') {
	 	echo '<Image Filename="' . $image6 . '"></Image>';
		}

if ($image7 != '') {
	 	echo '<Image Filename="' . $image7 . '"></Image>';
		}

if ($image8 != '') {
	 	echo '<Image Filename="' . $image8 . '"></Image>';
		}

if ($image9 != '') {
	 	echo '<Image Filename="' . $image9 . '"></Image>';
		}

if ($image10 != '') {
	 	echo '<Image Filename="' . $image10 . '"></Image>';
		}


		?>


<?php echo '</Piecemaker>'; ?>