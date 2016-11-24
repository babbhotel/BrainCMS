<?php
	if(!defined('BRAIN_CMS')) 
	{ 
		die('Sorry but you cannot access this file!'); 
	}
	session_start();
	ob_start();
	$classPlace = $_SERVER['DOCUMENT_ROOT'].'/system/app/classes/';
	require_once $_SERVER['DOCUMENT_ROOT'].'/system/config/brain-config.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/system/content/languages/'.$config['lang'].'.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/system/app/functions.php';
	require_once $classPlace.'/class.db.php';
	require_once $classPlace.'/class.game.php';
	require_once $classPlace.'/class.user.php';
	require_once $classPlace.'/class.html.php';
	require_once $classPlace.'/class.admin.php';
	Html::loadPlugins();
	DB::Initialize($db);
?>