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
			global $config;
			$timeNow = strtotime("now");
			$sessionKey  = 'BrainStorm-'.substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", 5)), 0, 25).'-SSO';
			$Query = DB::Query("UPDATE users SET auth_ticket = '".DB::Escape($sessionKey)."' WHERE id = '".DB::Escape($_SESSION['id'])."'");
			$Query2 = DB::Query("UPDATE users SET last_online = '".DB::Escape($timeNow)."' WHERE id = '".DB::Escape($_SESSION['id'])."'");
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
				$Query = DB::Query("UPDATE users SET home_room = '".DB::Escape($_GET['room'])."' WHERE id = '".DB::Escape($_SESSION['id'])."'");
			}
			else{
				$Query = DB::Query("UPDATE users SET home_room = '".$config['homeRoom']."' WHERE id = '".DB::Escape($_SESSION['id'])."'");
			}
		}
	}	
?>