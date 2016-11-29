<?php
	if(!defined('BRAIN_CMS')) 
	{ 
		die('Sorry but you cannot access this file!'); 
	}
	session_start();
	ob_start();
	
	define('Z', $_SERVER['DOCUMENT_ROOT'].'/');
	define('A', Z . 'system/');
	define('B', 'app/');
	define('C', 'classes/');
	define('D', 'config/');
	define('E', 'languages/');
	define('G', 'content/');
	define('H', 'theme/');
	define('I', 'maintenance/');
	define('J', Z . 'adminpan/');
	define('K', 'plugins/');
	
	require_once A . D . '/brain-config.php';
	require_once A . G . E . '/'.$config['lang'].'.php';
	require_once A . B . '/functions.php';
	require_once A . B . C . '/class.db.php';
	require_once A . B . C . '/class.game.php';
	require_once A . B . C . '/class.user.php';
	require_once A . B . C . '/class.html.php';
	require_once A . B . C . '/class.admin.php';
	
	define('S', $config['skin']);
	
	Html::loadPlugins();
	DB::Initialize($db);
?>