<?php require_once( '../../../wp-load.php' );
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
</Settings>




<Image Filename="image1.jpg">
    <Text>
      <headline>Description Text</headline>
      <break>Ӂ</break>
      <paragraph>Here you can add a description text for every single slide.</paragraph>
      <break>Ӂ</break>
      <inline>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eu quam dolor, a venenatis nisl. Praesent scelerisque iaculis fringilla. Sed congue placerat eleifend.</inline>
      Ӂ<a href="http://themes.5-squared.com/sansation/?style=cool_blue" target="_blank">hyperlinks</a>
    </Text>
  </Image>




  <Image Filename="image2.jpg">
    <Text>
      <headline>Description Text</headline>
      <break>Ӂ</break>
      <paragraph>Here you can add a description text for every single slide.</paragraph>
      <break>Ӂ</break>
      <inline>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eu quam dolor, a venenatis nisl. Praesent scelerisque iaculis fringilla. Sed congue placerat eleifend.</inline>
      Ӂ<a href="http://themes.5-squared.com/sansation/?style=cool_blue" target="_blank">hyperlinks</a>
    </Text>
  </Image>




  <Image Filename="image3.jpg">
    <Text>
      <headline>Description Text</headline>
      <break>Ӂ</break>
      <paragraph>Here you can add a description text for every single slide.</paragraph>
      <break>Ӂ</break>
      <inline>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eu quam dolor, a venenatis nisl. Praesent scelerisque iaculis fringilla. Sed congue placerat eleifend.</inline>
      Ӂ<a href="http://themes.5-squared.com/sansation/?style=cool_blue" target="_blank">hyperlinks</a>
    </Text>
  </Image>




  <Image Filename="image4.jpg">
    <Text>
      <headline>Description Text</headline>
      <break>Ӂ</break>
      <paragraph>Here you can add a description text for every single slide.</paragraph>
      <break>Ӂ</break>
      <inline>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eu quam dolor, a venenatis nisl. Praesent scelerisque iaculis fringilla. Sed congue placerat eleifend.</inline>
      Ӂ<a href="http://themes.5-squared.com/sansation/?style=cool_blue" target="_blank">hyperlinks</a>
    </Text>
  </Image>
</Piecemaker>';
?>