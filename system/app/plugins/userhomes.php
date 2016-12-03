<?php
	if(!defined('BRAIN_CMS')) 
	{ 
		die('Sorry but you cannot access this file!'); 
	}
	function userHome($key)
	{
		global $dbh;
		if (!isset($_GET['user']))
		{
			echo "Profiel bestaat niet.";
			exit();
		}
		$getUser = $dbh->prepare("SELECT id,username,motto,credits,vip_points,activity_points,look,account_created,last_online,mail FROM users WHERE username = :user LIMIT 1");
		$getUser->bindParam(':user',$_GET['user']);
		$getUser->execute();
		$usersSql = $getUser->fetch();
		if($usersSql['credits'] == "") {
			exit();
		}
		return filter($usersSql[$key]);
	}
?>