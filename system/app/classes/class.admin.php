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
			global $dbh;
			if (isset($_POST['update'])) 
			{
				$upateUser = $dbh->prepare("UPDATE users SET 
				motto=:motto,
				username=:name,
				mail=:mail,
				credits=:credits,
				vip_points=:vip_points,
				activity_points=:activity_points,
				teamrank=:teamrank,
				rank=:rank
				WHERE username = :name");
				$upateUser->bindParam(':motto', $_POST['motto']); 
				$upateUser->bindParam(':name', $_POST['naam']); 
				$upateUser->bindParam(':mail', $_POST['mail']); 
				$upateUser->bindParam(':credits', $_POST['credits']); 
				$upateUser->bindParam(':vip_points', $_POST['vip_points']); 
				$upateUser->bindParam(':activity_points', $_POST['activity_points']); 
				$upateUser->bindParam(':teamrank', $_POST['teamrank']); 
				$upateUser->bindParam(':rank', $_POST['rank']); 
				$upateUser->execute(); 
				Admin::gelukt("De gebruiker is opgeslagen!");
			}	
		}
		public static function UpdateUserOfTheWeek()
		{
			global $dbh;
			if (isset($_POST['update'])) 
			{
				$getUserData = $dbh->prepare("SELECT id,username FROM users WHERE username = :name");
				$getUserData->bindParam(':name', $_POST['naam']); 
				$getUserData->execute(); 
				$upateUser2 = $getUserData->fetch();
				if ($upateUser = $dbh->prepare("UPDATE uotw SET userid=:userdata,text=:txt"))
				{
					$upateUser->bindParam(':userdata', $upateUser2['id']); 
					$upateUser->bindParam(':txt', $_POST['uftwtext']); 
					$upateUser->execute();
					Admin::gelukt("De gebruiker heeft nu UOTW");
				}
				else 
				{
					Admin::error("Niet gelukt!");
				}  
			}
		}
		public static function UpdateNews()
		{
			global $dbh;
			if (isset($_POST['update'])) 
			{
				$editNews = $dbh->prepare("UPDATE cms_news SET 
				id=:id,
				title=:title,
				shortstory=:shortstory,
				longstory=:longstory,
				image=:topstory
				WHERE id = :id");
				$editNews->bindParam(':title', $_POST['title']);
				$editNews->bindParam(':shortstory', $_POST['shortstory']);
				$editNews->bindParam(':topstory', $_POST['topstory']);
				$editNews->bindParam(':longstory', $_POST['longstory']);
				$editNews->bindParam(':id', $_POST['id']);
				$editNews->execute();
				Admin::gelukt("Nieuws bericht aangepast!");
			}
		}
		public static function searchUser()
		{
			global $dbh,$config;
			if(isset($_POST['zoek'])) {	
				$searchUser = $dbh->prepare("SELECT * FROM users WHERE username = :user");
				$searchUser->bindParam(':user', $_POST['user']); 
				$searchUser->execute();
				if ($searchUser->RowCount() == 1)
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
			global $dbh,$config;
			if(isset($_POST['zoek'])) {	
				$searchUser = $dbh->prepare("SELECT * FROM users WHERE username = :user");
				$searchUser->bindParam(':user', $_POST['user']); 
				$searchUser->execute();
				if ($searchUser->RowCount() == 1)
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
			global $dbh;
			if (isset($_GET['user'])) {
				$getUser = $dbh->prepare("SELECT * FROM users WHERE username=:username LIMIT 1");
				$getUser->bindParam(':username', $_GET['user']);
				$getUser->execute();
				if ($getUser->RowCount() == 1) 
				{
					$user = $getUser->fetch();
					return filter($user[$variable]);
				} 
				else 
				{
					Admin::error("Gebruiker niet gevonden!"); exit;
				}
			}
		}
		public static function EditUserOfTheWeek($variable)
		{
			global $dbh;
			if (isset($_GET['user'])) {
				$getUser = $dbh->prepare("SELECT * FROM users WHERE username=:username LIMIT 1");
				$getUser->bindParam(':username', $_GET['user']);
				$getUser->execute();
				if ($getUser->RowCount() == 1) 
				{
					$user = $getUser->fetch();
					return filter($user[$variable]);
				} 
				else 
				{
					Admin::error("Gebruiker niet gevonden!"); exit;
				}
			}
		}
		public static function EditNews($variable)
		{
			global $dbh;
			if (isset($_GET['news'])) 
			{
				$getNews = $dbh->prepare("SELECT * FROM cms_news WHERE id=:newsid LIMIT 1");
				$getNews->bindParam(':newsid', $_GET['news']);
				$getNews->execute();
				if ($getNews->RowCount() == 1) 
				{
					$news = $getNews->fetch();
					return $news[$variable];
				} 
				else 
				{
					Admin::error("Geen nieuws gevonden!"); exit;
				}
			}
		}
		public static function LookSollie($variable)
		{
			Global $dbh,$config;
			if (isset($_GET['look'])) 
			{
				$getSollie = $dbh->prepare("SELECT * FROM staffApplication WHERE id=:look LIMIT 1");
				$getSollie->bindParam(':look', $_GET['look']);
				$getSollie->execute();
				if ($getSollie->RowCount() == 1) 
				{
					$data = $getSollie->fetch();
					$datenow = date('d-m-Y', $data['date']);
					return filter($data[$variable]);
				} 
				else 
				{
					header('Location: '.$config['hotelUrl'].'/adminpan/sollie');
				}
			}
		}
		public static function DeleteNews()
		{
			Global $dbh;
			if(isset($_GET['delete'])) 
			{ 
				$deleteNews = $dbh->prepare("DELETE FROM cms_news WHERE id=:newsid");
				$deleteNews->bindParam(':newsid', $_GET['delete']);
				$deleteNews->execute();
				Admin::gelukt('Het nieuws bericht is verwijderd');
			}
		}
		public static function DeleteSollie()
		{
			Global $config, $dbh;
			if(isset($_GET['delete'])) 
			{ 
				$deleteSollie = $dbh->prepare("DELETE FROM staffApplication WHERE id=:newsid");
				$deleteSollie->bindParam(':newsid', $_GET['delete']);
				$deleteSollie->execute();
				Admin::gelukt('Sollicitatie verwijderd');
				header('Location: '.$config['hotelUrl'].'/adminpan/sollie');
			}
		}
		public static function DeleteBans()
		{
			Global $dbh;
			if(isset($_GET['delete'])) 
			{ 
				$deleteBan = $dbh->prepare("DELETE FROM bans WHERE id=:newsid");
				$deleteBan->bindParam(':newsid', $_GET['delete']);
				$deleteBan->execute();
				Admin::gelukt('Sollicitatie verwijderd');
			}
		}
		public static function PostNews()
		{
			global $dbh;
			if (isset($_POST['postnews']))
			{
				$_SESSION['title'] = $_POST['title'];
				$_SESSION['news'] = $_POST['news'];
				if (!empty($_POST['title']))
				{
					if (!empty($_POST['news']))
					{
						$postNews = $dbh->prepare("
						INSERT INTO cms_news(title,image,shortstory,longstory,author,date,type,roomid,updated)
						VALUES
						(
						:title,
						:topstory, 
						:slogan,
						:news,
						:id,
						'" . time() . "',
						'1',
						'1',
						'1'
						)");
						$postNews->bindParam(':title', $_POST['title']);
						$postNews->bindParam(':slogan', $_POST['slogan']);
						$postNews->bindParam(':topstory', $_POST['topstory']);
						$postNews->bindParam(':news', $_POST['news']);
						$postNews->bindParam(':id', $_SESSION['id']);
						$postNews->execute();
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
			}
		}
	}
?>							