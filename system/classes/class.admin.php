<?php
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
		public static function UpdateUser()
		{
			if (isset($_POST['update'])) {
				$username = DB::Escape($_POST['naam']);
				$motto = DB::Escape($_POST['motto']);
				$mail = DB::Escape($_POST['mail']);
				$credits = DB::Escape($_POST['credits']);
				$activity_points = DB::Escape($_POST['activity_points']);
				$vip_points = DB::Escape($_POST['vip_points']);
				$rank = DB::Escape($_POST['rank']);
				if ($updatesql = DB::Query("UPDATE users SET 
				motto='".DB::Escape($_POST['motto'])."' ,
				username='".DB::Escape($_POST['naam'])."',
				mail='".DB::Escape($_POST['mail'])."',
				credits='".DB::Escape($_POST['credits'])."',
				vip_points='".DB::Escape($_POST['vip_points'])."',
				activity_points='".DB::Escape($_POST['activity_points'])."',
				rank='".DB::Escape($_POST['rank'])."'
				WHERE username = '".$username."'")) {
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
				if(isset($_POST['zoek'])) {	
					$searchUser = DB::NumRows(DB::Query('SELECT * FROM users WHERE username = "'.$_POST['user'].'"'));
					if ($searchUser == 1)
					{
						Admin::gelukt('Gebruiker '.$_POST['user'].' gevonden! Klik <a href ="gebruiker.php?user='.$_POST['user'].'">hier</a> om naar zijn account te gaan.');
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
			Global $db;
			if (isset($_GET['look'])) {
				$user = DB::Escape($_GET['look']);
				if ($sql1 = $sql1 = DB::Query("SELECT * FROM staffApplication WHERE id='".DB::Escape($_GET['look'])."' LIMIT 1")) {
					if ($sql1->num_rows == 1) {
						$user = $sql1->FETCH_ASSOC();
						$datenow = date('d-m-Y', $user['date']);
						return $user[$variable];
						} else {
						echo "<script language='javascript' type='text/javascript'>window.location.href='/adminpan/sollie.php'</script>"; exit;
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
				if ($deletesql = $sql1 = DB::Query("DELETE FROM staffsollie WHERE id='$id'")) {
					Admin::gelukt('Sollicitatie verwijderd '.$id.'');
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