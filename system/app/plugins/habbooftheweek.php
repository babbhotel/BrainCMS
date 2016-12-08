<?php
	if(!defined('BRAIN_CMS')) 
	{ 
		die('Sorry but you cannot access this file!'); 
	}
	function userOfTheWeek()
	{
		global $dbh,$lang;
		$getUOTW = $dbh->prepare("SELECT userid,text FROM uotw");
		$getUOTW->execute();
		$getUOTWData = $getUOTW->fetch();
		$getUser = $dbh->prepare("SELECT id,look,username,motto FROM users WHERE id = :id");
		$getUser->bindParam(':id', $getUOTWData['userid']);
		$getUser->execute();
		$getUserData = $getUser->fetch();
		echo '<div class="userNew" style="height: 110px;  background: url(https://avatar-retro.com/habbo-imaging/avatarimage?figure='.filter($getUserData['look']).'&direction=2&head_direction=3&action=crr=667&gesture=sml);float: left;background-repeat: no-repeat;"></div>';
		echo '<div style="">'.$lang["Hname"].'  <b>'.filter($getUserData['username']).'</b></div>';
		echo '<div style="">'.$lang["Hmotto"].'  <b>'.filter($getUserData['motto']).'</b></div>';
		echo '<div style=""><h4>'.filter($getUOTWData['text']).'</h4></div>';		
	}
?>