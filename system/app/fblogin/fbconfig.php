<?php
	define('BRAIN_CMS', 1);
	include_once $_SERVER['DOCUMENT_ROOT'].'/system/global.php';
	// added in v4.0.0
	require_once 'autoload.php';
	use Facebook\FacebookSession;
	use Facebook\FacebookRedirectLoginHelper;
	use Facebook\FacebookRequest;
	use Facebook\FacebookResponse;
	use Facebook\FacebookSDKException;
	use Facebook\FacebookRequestException;
	use Facebook\FacebookAuthorizationException;
	use Facebook\GraphObject;
	use Facebook\Entities\AccessToken;
	use Facebook\HttpClients\FacebookCurlHttpClient;
	use Facebook\HttpClients\FacebookHttpable;
	// init app with app id and secret
	FacebookSession::setDefaultApplication($config['facebookAPPID'],$config['facebookAPPSecret']);
	// login helper with redirect_uri
    $helper = new FacebookRedirectLoginHelper($config['hotelUrl'].'/system/app/fblogin/fbconfig.php');
	try {
		$session = $helper->getSessionFromRedirect();
		} catch( FacebookRequestException $ex ) {
		// When Facebook returns an error
		} catch( Exception $ex ) {
		// When validation fails or other local issues
	}
	// see if we have a session
	if ( isset( $session ) ) {
		// graph api request for user data
		$request = new FacebookRequest( $session, 'GET', '/me?fields=first_name,email');
		$response = $request->execute();
		// get response
		$graphObject = $response->getGraphObject();
     	$fbid = $graphObject->getProperty('id');              // To Get Facebook ID
 	    $fbfullname = $graphObject->getProperty('first_name'); // To Get Facebook full name
	    $femail = $graphObject->getProperty('email');    // To Get Facebook email ID
		/* ---- Session Variables -----*/
	    $_SESSION['FBID'] = $fbid;           
        $_SESSION['FULLNAME'] = $fbfullname;
	    $_SESSION['EMAIL'] =  $femail;
		/* ---- header location after session ----*/
		if ($config['facebookLogin'] == true)
		{
			if (DB::NumRowsQuery("SELECT fbid FROM users WHERE fbid = '".$_SESSION['FBID']."'") == 0)
			{
				DB::Fetch(DB::Query("
				INSERT INTO
				users
				(username, rank, look, motto, account_created, mail, ip_last, ip_reg, credits, activity_points, vip_points, fbid, fbenable)
				VALUES
				(
				'FB_".DB::Escape(filter($_SESSION['FBID']))."',  
				'1',
				'hr-3163-1035.hd-3092-2.ch-215-63.lg-3320-1189-62.sh-3089-1408.ca-3219-110.wa-2001-0',
				'".$config['startMotto']."', 
				'".strtotime("now")."', 
				'".DB::Escape(filter($_SESSION['EMAIL']))."', 
				'".checkCloudflare()."', 
				'".checkCloudflare()."', 
				'".$config['credits']."',
				'".$config['duckets']."',
				'".$config['diamonds']."',
				'".DB::Escape(filter($_SESSION['FBID']))."',
				'0'
				)
				"));
				$newUser = DB::Query("SELECT * FROM `users` WHERE username='FB_".DB::Escape(filter($_SESSION['FBID']))."' && mail = '".filter(DB::Escape($_SESSION['EMAIL']))."' LIMIT 1");
				while ($User = DB::Fetch($newUser))
				{
					$_SESSION['id'] = filter(DB::Escape($User['id']));
					header('Location: '.$config['hotelUrl'].'/changename');
				}
			}
			else{
				$loadUser = DB::Query("SELECT * FROM `users` WHERE fbid='".DB::Escape(filter($_SESSION['FBID']))."' LIMIT 1");
				while ($User = DB::Fetch($loadUser))
				{
					$_SESSION['id'] = filter(DB::Escape($User['id']));
					header('Location: '.$config['hotelUrl'].'/me');
				}
			}
		}
		else{
			header('Location: '.$config['hotelUrl'].'/index');
			exit;
		}
		} else {
		$loginUrl = $helper->getLoginUrl(array('scope' => 'email'));
		header("Location: ".$loginUrl);
	}
?>	