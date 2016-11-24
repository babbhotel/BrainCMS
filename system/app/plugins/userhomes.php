<?php
	if(!defined('BRAIN_CMS')) 
	{ 
		die('Sorry but you cannot access this file!'); 
	}
	function userHome($key)
	{
		if (!isset($_GET['user']))
		{
			echo "Profiel bestaat niet.";
			exit();
		}
		$usersSql = DB::Fetch(DB::Query("SELECT id,username,motto,credits,vip_points,activity_points,look,account_created,last_online FROM users WHERE username = '" . filter(DB::Escape($_GET['user'])) . "' LIMIT 1"));
		if($usersSql['credits'] == "") {
			echo "Profiel bestaat niet.";
			exit();
		}
		return DB::Escape($usersSql[$key]);
	}
?>