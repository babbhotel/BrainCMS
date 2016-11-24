<?php
	if(!defined('BRAIN_CMS')) 
	{ 
		die('Sorry but you cannot access this file!'); 
	}
	function userOfTheWeek()
	{
		global $lang;
		$getUOTW = DB::Fetch(DB::Query("SELECT userid,text FROM uotw"));
		$getUserData = DB::Fetch(DB::Query("SELECT id,look,username,motto FROM users WHERE id = '" . filter(DB::Escape($getUOTW['userid'])) . "'"));
		echo '<div class="userNew" style="height: 110px;  background: url(https://avatar-retro.com/habbo-imaging/avatarimage?figure='.filter($getUserData['look']).'&direction=2&head_direction=3&action=crr=667&gesture=sml);float: left;background-repeat: no-repeat;"></div>';
		echo '<div style="">'.$lang["Hname"].'  <b>'.filter($getUserData['username']).'</b></div>';
		echo '<div style="">'.$lang["Hmotto"].'  <b>'.filter($getUserData['motto']).'</b></div>';
		echo '<div style=""><h4>'.filter($getUOTW['text']).'</h4></div>';		
	}
	
?>