<?php
$output;
$ch = curl_init( $url );
//curl_setopt( $ch, CURLOPT_HEADER, true );
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
switch($_GET['option']) {
	case 'photos':
        $url = 'http://api.flickr.com/services/feeds/photos_public.gne?id=39259776@N04&lang=en-us&format=rss_200';
        curl_setopt($ch, CURLOPT_URL, $url);
        $output = curl_exec($ch);
	break;
}
curl_close($ch);
header('Content-Type: text/xml');
echo $output;
?>
