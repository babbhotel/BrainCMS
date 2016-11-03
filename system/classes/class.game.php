<?php
	
	/* 
		Functions list Class Game.
		--------------- 
		
		sso();
		usersOnline();
		homeRoom();
	*/
	
	class Game 
	{
		public static function sso()
		{
			global $version;
			$timeNow = strtotime("now");
			$sessionKey  = 'BrainStorm-0.4.0-'.substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", 5)), 0, 25).'-SSO';
			DB::Query("UPDATE users SET auth_ticket = '".DB::Escape($sessionKey)."' WHERE id = '".DB::Escape($_SESSION['id'])."'");
			DB::Query("UPDATE users SET last_online = '".DB::Escape($timeNow)."' WHERE id = '".DB::Escape($_SESSION['id'])."'");
		}
		Public static function usersOnline()
		{
			$userCount =  DB::NumRows(DB::Query("SELECT * FROM users WHERE online = '1'"));
			return $userCount;
		}
		public static function homeRoom()
		{
			global $config;
			if (isset($_GET['room'])) {
				DB::Query("UPDATE users SET home_room = '".DB::Escape($_GET['room'])."' WHERE id = '".DB::Escape($_SESSION['id'])."'");
			}
			else{
				DB::Query("UPDATE users SET home_room = '".$config['homeRoom']."' WHERE id = '".DB::Escape($_SESSION['id'])."'");
			}
		}
	}	
?>