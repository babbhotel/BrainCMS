<?php
	if(!defined('BRAIN_CMS')) 
	{ 
		die('Sorry but you cannot access this file!'); 
	}
	function staffApplication()
	{
		Global $lang;
		if (isset($_POST['addsollie']))
		{
			$realname = filter(DB::Escape($_POST['realname']));
			$skype = filter(DB::Escape($_POST['skype']));
			$age = filter(DB::Escape($_POST['age']));
			$functie = filter(DB::Escape($_POST['functie']));
			$onlinetime = filter(DB::Escape($_POST['onlinetime']));
			$knowing = filter(DB::Escape($_POST['knowing']));
			$quarrel = filter(DB::Escape($_POST['quarrel']));
			$serious = filter(DB::Escape($_POST['serious']));
			$improve = filter(DB::Escape($_POST['improve']));
			$microphone = filter(DB::Escape($_POST['microphone']));
			switch ($functie) {
				case 1:
				$functieName = "Junior Moderator";
				break;
				case 2:
				$functieName = "Eventteam";
				break;
				case 3:
				$functieName = "Spamteam";
				break;
				case 4:
				$functieName = "Bouwteam";
				break;
				case 5:
				$functieName = "Proef DJ";
				break;
				case 6:
				$functieName = "Pixelaar";
				break;
			}
			$AddSollie = DB::Fetch(DB::Query("INSERT INTO staffApplication (username, realname, skype, age, functie, onlinetime,knowing,quarrel,serious,improve,microphone,ip,date) VALUES ('".User::userData('username')."', '" .$realname. "', '".$skype."', '".$age."' ,'".filter($functieName)."','".$onlinetime."','".$knowing."','".$quarrel."','".$serious."','".$improve."' ,'".$microphone."'  ,'".checkCloudflare()."','". time() ."')"));
			;
			echo'<b><font color="green"> '.$lang["Ssend"].'</b></font>';												
		}
	}
?>