<?php
include_once('config.php');
$output;
$ch = curl_init( $url );
//curl_setopt( $ch, CURLOPT_HEADER, true );
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
switch($_GET['option']) {
	case 'getinfo':
        $url = 'http://ws.audioscrobbler.com/2.0/?method=user.getinfo&user=helmeester&api_key='.LASTFM_API_KEY;
        curl_setopt($ch, CURLOPT_URL, $url);
        $output = curl_exec($ch);
	break;
	
	case 'getrecenttracks':
        $url = 'http://ws.audioscrobbler.com/2.0/?method=user.getrecenttracks&limit=50&user=helmeester&api_key='.LASTFM_API_KEY;
        curl_setopt($ch, CURLOPT_URL, $url);
        $output = curl_exec($ch);
	break;
	
	case 'getevents':
        $url = 'http://ws.audioscrobbler.com/2.0/?method=user.getevents&user=helmeester&api_key='.LASTFM_API_KEY;
        curl_setopt($ch, CURLOPT_URL, $url);
        $output = curl_exec($ch);
	break;
	
	case 'getpastevents':
        $url = 'http://ws.audioscrobbler.com/2.0/?method=user.getpastevents&user=helmeester&api_key='.LASTFM_API_KEY;
        curl_setopt($ch, CURLOPT_URL, $url);
        $output = curl_exec($ch);
	break;
}
curl_close($ch);
header('Content-Type: text/xml');
echo $output;
?>
