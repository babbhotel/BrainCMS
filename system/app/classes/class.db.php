<?php
	if(!defined('BRAIN_CMS')) 
	{ 
		die('Sorry but you cannot access this file!'); 
	}
	try {
		$dbh = new PDO('mysql:host='.$db['host'].':'.$db['port'].';dbname='.$db['db'].'', $db['user'], $db['pass']);
	}
	catch (PDOException $e) {
		echo $e->getMessage();
		die();
	}
?>			