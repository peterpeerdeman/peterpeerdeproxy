<?php
include_once('config.php');
require('../vendor/simpleCache.php');

$cache = new SimpleCache();
$cache->cache_path = '../cache/';
$cache->cache_time = 60;

$output;
$ch = curl_init( $url );
$baseUrl = 'http://drammer.com/api/';

curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
switch($_GET['option']) {
	case 'usercollection':
        $url = $baseUrl . 'UserCollection' . '?api_key='.DRAMMER_API_KEY;
        $output = $cache->get_data('drammerusercollection', $url);
	break;
	
	case 'userreviews':
        $url = $baseUrl . 'UserReviews' . '?api_key='.DRAMMER_API_KEY;
        $output = $cache->get_data('drammeruserreviews', $url);
	break;
	
	case 'usertimeline':
        $url = $baseUrl . 'UserTimeline' . '?api_key='.DRAMMER_API_KEY;
        $output = $cache->get_data('drammerusertimeline', $url);
        break;

        case 'userwishlist':
        $url = $baseUrl . 'UserWishlist' . '?api_key='.DRAMMER_API_KEY;
        $output = $cache->get_data('drammeruserwishlist', $url);
        break;
}
curl_close($ch);
header('Content-Type: text/json');
echo $output;
?>
