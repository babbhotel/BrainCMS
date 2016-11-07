<?php
	session_start();
	ob_start();
	require_once $_SERVER['DOCUMENT_ROOT'].'/system/config/brain-config.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/system/languages/'.$config['lang'].'.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/system/classes/class.db.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/system/classes/class.game.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/system/classes/class.user.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/system/classes/class.website.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/system/functions.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/system/classes/class.html.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/system/classes/class.admin.php';
	DB::Initialize($db);
?>