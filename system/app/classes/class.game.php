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
			global $dbh;
			$timeNow = strtotime("now");
			$sessionKey  = 'Brain-1.1.1-'.substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", 5)), 0, 25).'-SSO';
			$stmt = $dbh->prepare("UPDATE users SET auth_ticket = :sso , last_online = :timenow WHERE id = :id");
			$stmt->bindParam(':timenow', $timeNow);
			$stmt->bindParam(':id', $_SESSION['id']);
			$stmt->bindParam(':sso', $sessionKey);
			$stmt->execute();
		}
		Public static function usersOnline()
		{
			global $dbh;
			$userCount = $dbh->prepare("SELECT * FROM users WHERE online = '1'");
			$userCount->execute();
			return $userCount->RowCount();
		}
		public static function homeRoom()
		{
			global $dbh, $hotel;
			$stmt = $dbh->prepare("UPDATE users SET home_room = :homeroom WHERE id = :id");
			$stmt->bindParam(':homeroom', $hotel['homeRoom']);
			$stmt->bindParam(':id', $_SESSION['id']);
			$stmt->execute();
		}
	} 
?>