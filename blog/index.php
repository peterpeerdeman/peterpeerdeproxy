<?php
$output;
$ch = curl_init( $url );
//curl_setopt( $ch, CURLOPT_HEADER, true );
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
switch($_GET['option']) {
	case 'feed':
        $url = 'http://www.nl.capgemini.com/onlineblog/feed/';
        curl_setopt($ch, CURLOPT_URL, $url);
        $output = curl_exec($ch);
	break;
	
	case 'author':
        $url = 'http://www.nl.capgemini.com/blog/online-solutions-blog/author/peter-peerdeman-941';
        curl_setopt($ch, CURLOPT_URL, $url);
        $output = curl_exec($ch);
	break;
	
}
curl_close($ch);
header('Content-Type: text/xml');
echo $output;
?>
