<?php
include_once('config.php');
$ch = curl_init();
//curl_setopt( $ch, CURLOPT_HEADER, true );
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
switch($_GET['option']) {
	case 'publicgamercardfeed':
   		$url = 	'http://feeds.xbox.com/publicgamercardfeed.ashx?GamerTag=HelmeesterNL';
	break;
	
	case 'publicpresencefeed':
   		$url = 	'http://feeds.xbox.com/publicpresencefeed.ashx?GamerTag=HelmeesterNL';
	break;
}
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_REFERER, XCDP_GUID);
$output = curl_exec($ch);
	
curl_close($ch);
header('Content-Type: text/xml');
echo $output;
?>
