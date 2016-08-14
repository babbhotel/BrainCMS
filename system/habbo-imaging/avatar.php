<?php
	header('Content-Type: image/png');
	function safe($value){ 
        $value = stripslashes($value);
        $value = strip_tags($value);
        $value = trim($value);
		if(get_magic_quotes_gpc())
        {
            $value = stripslashes($value);
		}
	return $value; } 
	require_once '../../system/main.conf.php';
	$mysqli = new mysqli($db['host'], $db['user'], $db['pass'], $db['db']);
	$username = safe($_GET["username"]);
	$getlook = $mysqli->query("SELECT look FROM users WHERE username = '". safe($username) ."'");
    while ($record = mysqli_fetch_assoc($getlook))
    {
        $look = $record["look"];
	}
	$map = './avatars';
	if (!is_dir($map)) 
    {
        if (!mkdir($map, 0, true)) 
		{
			die('Cant make the folder chmod this folder');
		}
	}
	if(isset($_GET['size'])){
		$size = $_GET['size'];
		} else { 
		$size= 'b';
	}
	if(isset($_GET['direction'])){
		$direction = $_GET['direction'];
		} else { 
		$direction = '2';
	}
	if(isset($_GET['head_direction'])){
		$head = $_GET['head_direction'];
		} else { 
		$head = '2'; 
	}
	if(isset($_GET['gesture'])){
		$gesture = $_GET['gesture'];
		} else { 
		$gesture = '';
	}
	$lookhash = md5("$look$size$direction$head$gesture");
	if (file_exists("$map/$lookhash.png")) {
		$finalavatar = require("$map/$lookhash.png");
		} else {
		function downloadavatar($image_url, $image_file){
			$fp = fopen ($image_file, 'w+');
			$ch = curl_init($image_url);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
			curl_setopt($ch, CURLOPT_FILE, $fp);         
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_TIMEOUT, 1000);      
			curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
			curl_exec($ch);
			curl_close($ch);                              
			fclose($fp);                                  
		}
		downloadavatar("https://avatar-retro.com/habbo-imaging/avatarimage?figure=".$look."&size=".$size."&direction=".$direction."&head_direction=".$head."&gesture=".$gesture."", "$map/$lookhash.png");
		$finalavatar = require("$map/$lookhash.png");
	}
	echo $finalavatar; 
?>