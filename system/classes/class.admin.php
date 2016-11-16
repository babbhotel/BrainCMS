<?php
	if(!defined('BRAIN_CMS')) 
	{ 
		die('Sorry but you cannot access this file!'); 
	}
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
			$getRank = DB::Fetch(DB::Query("SELECT * FROM users WHERE id = '".$_SESSION['id']."' LIMIT 1"));
			{
				if ($getRank['rank'] < $rank)
				{
					echo "<meta http-equiv='refresh' content='0; url=/index'>";
					exit();
				}
			}
		}
		public static function staffPin()
		{
			global $config, $lang;
			if (isset($_POST['loginPin']))
			{
				if (!empty($_POST['PINbox']))
				{
					$query = DB::Fetch(DB::Query("SELECT pin FROM users WHERE id = '" . DB::Escape($_SESSION['id']) . "'"));
					if ($_POST['PINbox'] == $query['pin'])
					{
						$_SESSION['staffCheckHk'] = '1';
						header('Location: '.$config['hotelUrl'].'/adminpan/dash');
					}
					else{
						echo $lang["Ppinwrong"];
					}
				}
				else{
					echo $lang["Pnopin"];
				}
			}
		}
		Public static function staffCheck()
		{
			global $config,$hotel;
			if($config['staffCheckHk'] == true)
			{
				if (user::userData('rank') > $config['staffCheckHkMinimumRank '])
				{
					if (empty($_SESSION['staffCheckHk'])) 
					{ 
						header('Location: '.$config['hotelUrl'].'/adminpan/pin');
						exit;
					}
				}
			}
		}
		public static function UpdateUser()
		{
			if (isset($_POST['update'])) {
				if ($updatesql = DB::Query("UPDATE users SET 
				motto='".DB::Escape($_POST['motto'])."' ,
				username='".DB::Escape($_POST['naam'])."',
				mail='".DB::Escape($_POST['mail'])."',
				credits='".DB::Escape($_POST['credits'])."',
				vip_points='".DB::Escape($_POST['vip_points'])."',
				activity_points='".DB::Escape($_POST['activity_points'])."',
				teamrank='".DB::Escape($_POST['teamrank'])."',
				rank='".DB::Escape($_POST['rank'])."'
				WHERE username = '".DB::Escape($_POST['naam'])."'")) {
					Admin::gelukt("De gebruiker is opgeslagen!");
					} else {
					Admin::error("Niet gelukt!");
				}  
			}
		}
		public static function UpdateUserOfTheWeek()
		{
			if (isset($_POST['update'])) {
				$getUserData = DB::Fetch(DB::Query("SELECT id,username FROM users WHERE username = '" . DB::Escape($_POST['naam']) . "'"));
				if ($updatesql = DB::Query("UPDATE uotw SET 
				userid='".DB::Escape($getUserData['id'])."',
				text='".DB::Escape($_POST['uftwtext'])."'
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
				id='".DB::Escape($_POST['id'])."',
				title='".DB::Escape($_POST['title'])."',
				shortstory='".DB::Escape($_POST['shortstory'])."',
				longstory='".DB::Escape($_POST['longstory'])."',
				image='".DB::Escape($_POST['topstory'])."'
				WHERE id = '".DB::Escape($_POST['id'])."'")) {
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
				$searchUser = DB::NumRows(DB::Query('SELECT * FROM users WHERE username = "'.DB::Escape($_POST['user']).'"'));
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
				$searchUser = DB::NumRows(DB::Query('SELECT * FROM users WHERE username = "'.DB::Escape($_POST['user']).'"'));
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
				if ($getUser = DB::Query("SELECT * FROM users WHERE username='".DB::Escape($_GET['user'])."' LIMIT 1")) {
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
				if ($getUser = DB::Query("SELECT * FROM users WHERE username='".DB::Escape($_GET['user'])."' LIMIT 1")) {
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
				if ($getNews = DB::Query("SELECT * FROM cms_news WHERE id='".DB::Escape($_GET['news'])."' LIMIT 1")) {
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
				if ($sql1 = $sql1 = DB::Query("SELECT * FROM staffApplication WHERE id='".DB::Escape($_GET['look'])."' LIMIT 1")) {
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
				if ($deletesql = $sql1 = DB::Query("DELETE FROM cms_news WHERE id='$id'")) {
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
				if ($deletesql = $sql1 = DB::Query("DELETE FROM staffApplication WHERE id='$id'")) {
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
				if ($deletesql = $sql1 = DB::Query("DELETE FROM bans WHERE id='$id'")) {
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
						$title = DB::Escape($_POST['title']);
						$kort = DB::Escape($_POST['kort']);
						$news = DB::Escape($_POST['news']);
						$topstory = DB::Escape($_POST['topstory']);
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