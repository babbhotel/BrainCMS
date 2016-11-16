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
			$sessionKey  = 'BrainStorm-0.5.0-'.substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", 5)), 0, 25).'-SSO';
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
			global $hotel;
			if (isset($_GET['room'])) {
				DB::Query("UPDATE users SET home_room = '".DB::Escape($_GET['room'])."' WHERE id = '".DB::Escape($_SESSION['id'])."'");
			}
			else{
				DB::Query("UPDATE users SET home_room = '".DB::Escape($hotel['homeRoom'])."' WHERE id = '".DB::Escape($_SESSION['id'])."'");
			}
		}
	} 
?>