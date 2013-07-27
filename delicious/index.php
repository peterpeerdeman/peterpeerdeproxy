<?php
$output;
$ch = curl_init( $url );
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
switch($_GET['option']) {
	case 'tags':
		$url = 'http://feeds.delicious.com/v2/json/tags/peterpeerdeman';
        curl_setopt($ch, CURLOPT_URL, $url);
        $output = curl_exec($ch);
	break;
	
	case 'links':
		$url = 'http://feeds.delicious.com/v2/json/peterpeerdeman';
        curl_setopt($ch, CURLOPT_URL, $url);
        $output = curl_exec($ch);
	break;
	
	case 'userinfo':
		$url = 'http://feeds.delicious.com/v2/json/userinfo/peterpeerdeman';
        curl_setopt($ch, CURLOPT_URL, $url);
        $output = curl_exec($ch);
	break;
	
	
}
curl_close($ch);
header('Content-Type: text/json');
echo $output;
?>
