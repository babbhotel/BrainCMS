<?php
	if(!defined('BRAIN_CMS')) 
	{ 
		die('Sorry but you cannot access this file!'); 
	}
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
			$sessionKey  = 'Brain-0.7.5-'.substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", 5)), 0, 25).'-SSO';
			DB::Fetch(DB::Query("UPDATE users SET auth_ticket = '".filter(DB::Escape($sessionKey))."' WHERE id = '".filter(DB::Escape($_SESSION['id'])."'")));
			DB::Fetch(DB::Query("UPDATE users SET last_online = '".filter(DB::Escape($timeNow))."' WHERE id = '".filter(DB::Escape($_SESSION['id'])."'")));
		}
		Public static function usersOnline()
		{
			$userCount =  DB::NumRows(DB::Query("SELECT * FROM users WHERE online = '1'"));
			return $userCount;
		}
		public static function homeRoom()
		{
			global $hotel;
			if (isset($_GET['room'])) {
				DB::Fetch(DB::Query("UPDATE users SET home_room = '".filter(DB::Escape($_GET['room']))."' WHERE id = '".filter(DB::Escape($_SESSION['id']))."'"));
			}
			else{
				DB::Fetch(DB::Query("UPDATE users SET home_room = '".$hotel['homeRoom']."' WHERE id = '".filter(DB::Escape($_SESSION['id']))."'"));
			}
		}
	} 
?>