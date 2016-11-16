<?php
	if(!defined('BRAIN_CMS')) 
	{ 
		die('Sorry but you cannot access this file!'); 
	}
	/* 
		Functions list Class Website.
		--------------- 
		userHome();	
		staffApplication();
		userOfTheWeak();
	*/
	class Website 
	{
		public static function userHome($key)
		{
			if (!isset($_GET['user']))
			{
				echo "Profiel bestaat niet.";
				exit();
			}
			$userGet = DB::Escape($_GET['user']);
			$usersSql = DB::Fetch(DB::Query("SELECT id,username,motto,credits,vip_points,activity_points,look,account_created,last_online FROM users WHERE username = '" . DB::Escape($userGet) . "' LIMIT 1"));
			if($usersSql['credits'] == "") {
				echo "Profiel bestaat niet.";
				exit();
			}
			return DB::Escape($usersSql[$key]);
		}
		public static function staffApplication()
		{
			Global $db,$lang;
			if (isset($_POST['addsollie']))
			{
				$realname = DB::Escape($_POST['realname']);
				$skype = DB::Escape($_POST['skype']);
				$age = DB::Escape($_POST['age']);
				$functie = DB::Escape($_POST['functie']);
				$onlinetime = DB::Escape($_POST['onlinetime']);
				$knowing = DB::Escape($_POST['knowing']);
				$quarrel = DB::Escape($_POST['quarrel']);
				$serious = DB::Escape($_POST['serious']);
				$improve = DB::Escape($_POST['improve']);
				$microphone = DB::Escape($_POST['microphone']);
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
				$AddSollie = DB::Fetch(DB::Query("INSERT INTO staffApplication (username, realname, skype, age, functie, onlinetime,knowing,quarrel,serious,improve,microphone,ip,date) VALUES ('".User::userData('username')."', '" .$realname. "', '".$skype."', '".$age."' ,'".$functieName."','".$onlinetime."','".$knowing."','".$quarrel."','".$serious."','".$improve."' ,'".$microphone."'  ,'".$_SERVER['REMOTE_ADDR']."','". time() ."')"));
				;
				echo'<b><font color="green"> '.$lang["Ssend"].'</b></font>';												
			}
		}
		public static function userOfTheWeak()
		{
			global $lang;
			$getUOTW = DB::Fetch(DB::Query("SELECT userid,text FROM uotw"));
			$getUserData = DB::Fetch(DB::Query("SELECT id,look,username,motto FROM users WHERE id = '" . DB::Escape($getUOTW['userid']) . "'"));
			echo '<div class="userNew" style="height: 110px;  background: url(https://avatar-retro.com/habbo-imaging/avatarimage?figure='.$getUserData['look'].'&direction=2&head_direction=3&action=crr=667&gesture=sml);float: left;background-repeat: no-repeat;"></div>';
			echo '<div style="">'.$lang["Hname"].'  <b>'.filter($getUserData['username']).'</b></div>';
			echo '<div style="">'.$lang["Hmotto"].'  <b>'.filter($getUserData['motto']).'</b></div>';
		echo '<div style=""><h4>'.filter($getUOTW['text']).'</h4></div>';		}
	}
?>