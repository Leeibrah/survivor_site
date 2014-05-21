<?php
//Prepare the database in case it's a new installation and the latest tweet hasn't been saved yet.
if(!get_option('ss_latesttweettext')){
	add_option('ss_latesttweettext', 'No data yet');
}

// Your twitter username.
$username = get_option('ss_latesttweet');
// Prefix - some text you want displayed before your latest tweet.
// (HTML is OK, but be sure to escape quotes with backslashes: for example href=\"link.html\")
$prefix = "<p>";
// Suffix - some text you want display after your latest tweet. (Same rules as the prefix.)
$suffix = "</p>";
$feed = "http://search.twitter.com/search.atom?q=from:" . $username . "&rpp=1";
function parse_feed($feed) {
$stepOne = explode("<content type=\"html\">", $feed);
$stepTwo = explode("</content>", $stepOne[1]);
$tweet = $stepTwo[0];
$tweet = str_replace("&lt;", "<", $tweet);
$tweet = str_replace("&gt;", ">", $tweet);
//$tweet = html_entity_decode($tweet);

//Twitter doesn't return anything if the last tweet is too old. Lets save the last tweet so we can retrieve it from the database in case twitter doesn't send anything back.
if($tweet == ''){
	$tweet = get_option('ss_latesttweettext');
}else{
	update_option( 'ss_latesttweettext', $tweet );
}

return html_entity_decode($tweet);
}
//$twitterFeed = file_get_contents($feed);
//CURL was added by Buzu to solve a bug where some servers would disable remote file access with this function. This is for security reasons.
$curl_socket = curl_init();
curl_setopt($curl_socket, CURLOPT_URL, $feed);
curl_setopt($curl_socket, CURLOPT_RETURNTRANSFER, 1);
$twitterFeed = curl_exec($curl_socket);
curl_close($curl_socket);

echo stripslashes($prefix) . parse_feed($twitterFeed) . stripslashes($suffix);
?>
