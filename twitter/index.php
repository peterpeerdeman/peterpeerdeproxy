<?php
/* Load required lib files. */
require_once('twitteroauth/twitteroauth.php');
require_once('config.php');

$access_token['oauth_token'] = ACCESS_TOKEN;
$access_token['oauth_token_secret'] = ACCESS_SECRET;

/* Create a TwitterOauth object with consumer/user tokens. */
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

$connection->host = "https://api.twitter.com/1.1/";

switch($_GET['option']) {
	case 'user':
		/* statuses/user_timeline */
		$content = $connection->get('statuses/user_timeline.json?count=10');
	break;
		
	case 'mentions':
		/* statuses/mentions */
		$content = $connection->get('statuses/mentions_timeline.json?count=10&trim_user=true');
	break; 
		
	case 'public_timeline':
    $connection->host = "https://stream.twitter.com/1.1/";
		$content = $connection->get('https://stream.twitter.com/1.1/statuses/sample.json');
	break; 
}

header('Content-Type: text/json');
echo json_encode($content);
?>
