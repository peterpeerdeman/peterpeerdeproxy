<?php
    session_start();

    $config['base_url']             =   'http://peterpeerdeman.nl/proxy/linkedin/auth.php';
    $config['callback_url']         =		'http://peterpeerdeman.nl/proxy/linkedin/index.php';
    $config['linkedin_access']      =   '************';
    $config['linkedin_secret']      =   '****************';
		
		$tokendbhandle = new PDO('linkedin_tokens.db');

    include_once "linkedin.php";
    
    # First step is to initialize with your consumer key and secret. We'll use an out-of-band oauth_callback
    $linkedin = new LinkedIn($config['linkedin_access'], $config['linkedin_secret'], $config['callback_url'] );
    //$linkedin->debug = true;

   if (isset($_REQUEST['oauth_verifier'])){
        $_SESSION['oauth_verifier']     = $_REQUEST['oauth_verifier'];
        $linkedin->request_token    =   unserialize($_SESSION['requestToken']);
        $linkedin->oauth_verifier   =   $_SESSION['oauth_verifier'];
        $linkedin->getAccessToken($_REQUEST['oauth_verifier']);

        $token = serialize($linkedin->access_token);
        $_SESSION['oauth_access_token'] = $token;

				//store token in sqlite db
				$stm = "INSERT into Tokens(token,datetime) values ('$token', DATETIME('now'))";
				$result = $tokendbhandle->query($stm);

        header("Location: " . $config['callback_url']);
        exit;
   }
   else{
				//retrieve token from db

				$stm = "select token from Tokens order by datetime desc LIMIT 1";
				$result = $tokendbhandle->query($stm);
				foreach ($result as $row) {
						$serializedToken = $row['token'];
				}

        $linkedin->access_token     =   unserialize($serializedToken);

				//retrieve token from session and request
        /*$linkedin->request_token    =   unserialize($_SESSION['requestToken']);
        $linkedin->oauth_verifier   =   $_SESSION['oauth_verifier'];
        $linkedin->access_token     =   unserialize($_SESSION['oauth_access_token']);
				*/
   }


    # You now have a $linkedin->access_token and can make calls on behalf of the current member
    $json_response = $linkedin->getProfile("~:(id,first-name,last-name,picture-url,headline,summary,specialties,positions,skills,recommendations-received)?format=json");

    header('Content-Type: text/json');
    echo $json_response;

/*    $search_response = $linkedin->search("?company-name=facebook&count=10");
    //$search_response = $linkedin->search("?title=software&count=10");

    //echo $search_response;
    $xml = simplexml_load_string($search_response);

    echo '<pre>';
    echo 'Look people who worked in facebook';
    print_r($xml);
    echo '</pre>';*/
?>
