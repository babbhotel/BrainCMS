<?php
	if(!defined('BRAIN_CMS')) 
	{ 
		die('Sorry but you cannot access this file!'); 
	}
	function deleteCommand()
	{
		global $lang;
		if (isset($_POST['deletecommand']))
		{
			$getCommandUserId = DB::Fetch(DB::Query("SELECT userid FROM cms_news_message WHERE userid = ".User::userData('id').""));
			if (User::userData('id') == filter(DB::Escape($getCommandUserId['userid'])) ||  User::userData('rank') >= 3)
			{
				$sql1 = DB::Query("DELETE FROM cms_news_message WHERE hash='".filter(DB::Escape($_POST['hashid']))."'AND newsid = '".filter(DB::Escape($_GET['id']))."'");
				return Html::errorSucces("Nieuws reactie verwijderd");
			}
			else
			{
				return Html::error("Er is iets mis gegaan!");
			}
		}
	}
?>	