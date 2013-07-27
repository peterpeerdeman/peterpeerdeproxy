<?php
include_once('config.php');
$output;
$ch = curl_init( $url );
//curl_setopt( $ch, CURLOPT_HEADER, true );
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
switch($_GET['option']) {
	case 'checkins':
        $url = 'https://api.foursquare.com/v2/users/5827574/checkins?v=20111020&oauth_token='.FOURSQUARE_OAUTH_TOKEN;
        curl_setopt($ch, CURLOPT_URL, $url);
        $output = curl_exec($ch);
	break;
	
	case 'users':
        $url = 'https://api.foursquare.com/v2/users/5827574?v=20111020&oauth_token='.FOURSQUARE_OAUTH_TOKEN;
        curl_setopt($ch, CURLOPT_URL, $url);
        $output = curl_exec($ch);
	break;
	
}
curl_close($ch);
header('Content-Type: text/json');
echo $output;
?>
