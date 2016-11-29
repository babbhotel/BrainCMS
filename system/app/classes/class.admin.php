<?php
	if(!defined('BRAIN_CMS')) 
	{ 
		die('Sorry but you cannot access this file!'); 
	}
	/* 
		Functions list Class Admin.
		--------------- 
		error();
		gelukt();
		CheckRank();
		staffpin();
		staffCheck();
		UpdateUser();
		UpdateUserOfTheWeek();
		UpdateNews();
		searchUser();
		searchUserOfTheWeek();
		EditUser();
		EditUserOfTheWeek();
		EditNews();
		LookSollie();
		DeleteNews();
		DeleteSollie();
		DeleteBans();
		PostNews();
	*/
	
	Class Admin
	{
		public static function error($errorName)
		{
			echo "<div class=\"alert alert-block alert-danger \"><strong>" . $errorName . "</div>";
		}
		public static function gelukt($errorName)
		{
			echo "<div class=\"alert alert-block alert-success \"><strong>" . $errorName . "</div>";
		}
		public static function CheckRank($rank)
		{
		global $config;
			{
				if (User::userData('rank') <= $rank)
				{
					header('Location: '.$config['hotelUrl'].'/index');	
					exit();
				}
			}
		}
		public static function UpdateUser()
		{
			if (isset($_POST['update'])) {
				if ($updatesql = DB::Query("UPDATE users SET 
				motto='".filter(DB::Escape($_POST['motto']))."' ,
				username='".filter(DB::Escape($_POST['naam']))."',
				mail='".filter(DB::Escape($_POST['mail']))."',
				credits='".filter(DB::Escape($_POST['credits']))."',
				vip_points='".filter(DB::Escape($_POST['vip_points']))."',
				activity_points='".filter(DB::Escape($_POST['activity_points']))."',
				teamrank='".filter(DB::Escape($_POST['teamrank']))."',
				rank='".filter(DB::Escape($_POST['rank']))."'
				WHERE username = '".filter(DB::Escape($_POST['naam']))."'")) {
					Admin::gelukt("De gebruiker is opgeslagen!");
					} else {
					Admin::error("Niet gelukt!");
				}  
			}
		}
		public static function UpdateUserOfTheWeek()
		{
			if (isset($_POST['update'])) {
				$getUserData = DB::Fetch(DB::Query("SELECT id,username FROM users WHERE username = '" . filter(DB::Escape($_POST['naam']) . "'")));
				if ($updatesql = DB::Query("UPDATE uotw SET 
				userid='".filter(DB::Escape($getUserData['id']))."',
				text='".filter(DB::Escape($_POST['uftwtext']))."'
				")) {
					Admin::gelukt("De gebruiker is opgeslagen!");
					} else {
					Admin::error("Niet gelukt!");
				}  
			}
		}
		public static function UpdateNews()
		{
			if (isset($_POST['update'])) {
				if ($updateNews = DB::Query("UPDATE cms_news SET 
				id='".filter(DB::Escape($_POST['id']))."',
				title='".filter(DB::Escape($_POST['title']))."',
				shortstory='".filter(DB::Escape($_POST['shortstory']))."',
				longstory='".filter(DB::Escape($_POST['longstory']))."',
				image='".filter(DB::Escape($_POST['topstory']))."'
				WHERE id = '".filter(DB::Escape($_POST['id']))."'")) {
					Admin::gelukt("Nieuws bericht aangepast!");
					} else {
					Admin::error("Niet gelukt!");
				}  
			}
		}
		public static function searchUser()
		{
		global $config;
			if(isset($_POST['zoek'])) {	
				$searchUser = DB::NumRows(DB::Query('SELECT * FROM users WHERE username = "'.filter(DB::Escape($_POST['user'])).'"'));
				if ($searchUser == 1)
				{
					Admin::gelukt('Gebruiker '.$_POST['user'].' gevonden! Klik <a href ="'.$config['hotelUrl'].'/adminpan/gebruiker/'.$_POST['user'].'">hier</a> om naar zijn account te gaan.');
				}
				else
				{
					Admin::error("Gebruiker ".$_POST['user']." niet gevonden!");
				}
			}
		}
		
		public static function searchUserOfTheWeek()
		{
		global $config;
			if(isset($_POST['zoek'])) {	
				$searchUser = DB::NumRows(DB::Query('SELECT * FROM users WHERE username = "'.filter(DB::Escape($_POST['user'])).'"'));
				if ($searchUser == 1)
				{
					Admin::gelukt(''.$_POST['user'].' gevonden! Klik <a href ="'.$config['hotelUrl'].'/adminpan/giveuseroftheweek/'.$_POST['user'].'">hier</a> om deze gebruiker Brain van de week te geven!');
				}
				else
				{
					Admin::error("Gebruiker ".$_POST['user']." niet gevonden!");
				}
			}
		}

		public static function EditUser($variable)
		{
			if (isset($_GET['user'])) {
				if ($getUser = DB::Query("SELECT * FROM users WHERE username='".filter(DB::Escape($_GET['user']))."' LIMIT 1")) {
					if (DB::NumRows($getUser) == 1) {
						$user = DB::Fetch($getUser);
						return $user[$variable];
						} else {
						Admin::error("Gebruiker niet gevonden!"); exit;
					}
				}
			}
		}
		public static function EditUserOfTheWeek($variable)
		{
			if (isset($_GET['user'])) {
				if ($getUser = DB::Query("SELECT * FROM users WHERE username='".filter(DB::Escape($_GET['user']))."' LIMIT 1")) {
					if (DB::NumRows($getUser) == 1) {
						$user = DB::Fetch($getUser);
						return $user[$variable];
						} else {
						Admin::error("Gebruiker niet gevonden!"); exit;
					}
				}
			}
		}
		public static function EditNews($variable)
		{
			if (isset($_GET['news'])) {
				if ($getNews = DB::Query("SELECT * FROM cms_news WHERE id='".filter(DB::Escape($_GET['news']))."' LIMIT 1")) {
					if (DB::NumRows($getNews) == 1) {
						$news = DB::Fetch($getNews);
						return $news[$variable];
						} else {
						Admin::error("Geen nieuws gevonden!"); exit;
					}
				}
			}
		}
		public static function LookSollie($variable)
		{
			Global $db,$config;
			if (isset($_GET['look'])) {
				$user = DB::Escape($_GET['look']);
				if ($sql1 = $sql1 = DB::Query("SELECT * FROM staffApplication WHERE id='".filter(DB::Escape($_GET['look']))."' LIMIT 1")) {
					if ($sql1->num_rows == 1) {
						$user = $sql1->FETCH_ASSOC();
						$datenow = date('d-m-Y', $user['date']);
						return $user[$variable];
						} else {
						echo "<script language='javascript' type='text/javascript'>window.location.href='".$config['hotelUrl']."/adminpan/sollie'</script>"; exit;
					}
				}
			}
		}
		public static function DeleteNews()
		{
			Global $db;
			if(isset($_GET['delete'])) { 
				$id = DB::Escape($_GET['delete']);
				if ($deletesql = $sql1 = DB::Query("DELETE FROM cms_news WHERE id='".filter(DB::Escape($id))."'")) {
					Admin::gelukt('Het nieuws bericht is verwijderd');
					} else {
					error();
				}
			}
		}
		public static function DeleteSollie()
		{
			Global $db;
			if(isset($_POST['DeleteSollieNow'])) { 
				$id = DB::Escape($_POST['DeleteSollieNow']);
				if ($deletesql = $sql1 = DB::Query("DELETE FROM staffApplication WHERE id='".filter(DB::Escape($id))."'")) {
					Admin::gelukt('Sollicitatie verwijderd '.$id.'');
					} else {
					error();
				}
			}
		}
		public static function DeleteBans()
		{
			Global $db;
			if(isset($_GET['delete'])) { 
				$id = DB::Escape($_GET['delete']);
				if ($deletesql = $sql1 = DB::Query("DELETE FROM bans WHERE id='".filter(DB::Escape($id))."'")) {
					Admin::gelukt('De ban verwijderd '.$id.'');
					} else {
					error();
				}
			}
		}
		public static function PostNews()
		{
			global $db;
			if (isset($_POST['postnews']))
			{
				$_SESSION['title'] = $_POST['title'];
				$_SESSION['news'] = $_POST['news'];
				if (!empty($_POST['title']))
				{
					if (!empty($_POST['news']))
					{
						$title = filter(DB::Escape($_POST['title']));
						$kort = filter(DB::Escape($_POST['kort']));
						$news = filter(DB::Escape($_POST['news']));
						$topstory = filter(DB::Escape($_POST['topstory']));
						$newsplaats = DB::Query("
						INSERT INTO cms_news
						(
						title,
						image,
						shortstory,
						longstory,
						author,
						date,
						type,
						roomid,
						updated
						)
						VALUES
						(
						'".$title."',
						'".$topstory."', 
						'".$kort."',
						'".$news."',
						'".User::userData('id')."',
						'" . time() . "',
						'1',
						'1',
						'1'
						)
						");
						$_SESSION['title'] = '';
						$_SESSION['kort'] = '';
						$_SESSION['news'] ='';
						Admin::gelukt("Nieuws bericht geplaatst!");
					}
					else
					{
						Admin::error("Nieuws bericht is leeg!");
						return;
					}
				}
				else
				{
					Admin::error("Er is geen titel!");
					return;
				}
			}
			else
			{
				//Login niet verstuurd!
			}
		}
	}
?>			