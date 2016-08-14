<?php
	
	/* 
		Functions list Class Website.
		--------------- 
		
		userHome();	
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
			$userGet = $_GET['user'];
			$usersSql = DB::Fetch(DB::Query("SELECT id,username,motto,credits,vip_points,activity_points,look,account_created,last_online FROM users WHERE username = '" . DB::Escape($userGet) . "' LIMIT 1"));
			
			
			return $usersSql[$key];
			if ($usersSql->num_rows !== 1)
			{
				echo "User not found!";
				exit();
			}
		}
		public static function staffApplication()
		{
			Global $db;
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
				echo'<b><font color="green"> Jouw sollicitatie is verzonden!</b></font>';												
			}
		}
	}	
?>