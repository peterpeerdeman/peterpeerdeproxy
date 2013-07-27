<?php
include_once('config.php');
$output;
$ch = curl_init( $url );
//curl_setopt( $ch, CURLOPT_HEADER, true );
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
switch($_GET['option']) {
	case 'photos':
        $url = 'https://api.500px.com/v1/photos?feature=user&username=peterpeerdeman&image_size=4&consumer_key='.FIVEHUNDREDPX_CONSUMER_KEY;
        curl_setopt($ch, CURLOPT_URL, $url);
        $output = curl_exec($ch);
	break;
}
curl_close($ch);
header('Content-Type: text/json');
echo $output;
?>
