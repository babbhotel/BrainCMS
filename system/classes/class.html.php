<?php
	/* 
		Functions list Class Html.
		--------------- 
		checkBan();
		page();
		error();
		errorSucces();
	*/
	class Html 
	{
	
		private static function checkBan($ip, $username = null)
		{
			if (DB::NumRowsQuery("SELECT bantype,expire FROM bans WHERE bantype = 'ip' && value = '".DB::Escape($ip)."'") === 1)
			{
				$queryIp = DB::Query("SELECT bantype,expire FROM bans WHERE bantype = 'ip' && value = '".DB::Escape($ip)."'");
				while ($rowIp = DB::Fetch($queryIp))
				{
					if (strtotime(gmdate($rowIp['expire'])) <= strtotime('now'))
					{
						return true;
						}
					else
					{
						return false;
					}
				}
			}
			else if ($username !== null)
			{
				if (DB::NumRowsQuery("SELECT bantype,expire FROM bans WHERE bantype = 'user' && value = '".DB::Escape($username)."'") === 1)
				{
					$queryUser = DB::Query("SELECT bantype,expire FROM bans WHERE bantype = 'user' && value = '".DB::Escape($username)."'");
					while ($rowUser = DB::Fetch($queryUser))
					{
						if (strtotime(gmdate($rowUser['expire'])) <= strtotime('now'))
						{
							return true;
						}
						else
						{
							return false;
						}
					}
				}
			}
			else
			{
				return false;
			}
		}
		public static function page()
		{
			global $emu, $config, $lang, $hotel, $version;
			
			if (loggedIn())
			{
				$user = User::userData('username');
			}
			else
			{
				$user = null;
			}
			if (self::checkBan(checkCloudflare(), $user))
			{
				include("system/theme/".$config['skin']."/pages/banned.php");
				exit();
			}
			if (self::checkBan(checkCloudflare(), $user))
			{
				include("system/theme/".$config['skin']."/pages/banned.php");
				exit();
			}
			else
			{
				if(isset($_GET['url']))
				{
					$page = DB::Escape($_GET['url']);	
					if($page)
					{ 
						if ($config['showErrors'] == true){
							ini_set('display_errors', 1);
							ini_set('display_startup_errors', 1);
							error_reporting(E_ALL);
						}
						if (!$config['maintenance'] == true){
							$fileExists = $_SERVER['DOCUMENT_ROOT'] . '/system/theme/'.$config['skin'].'/pages/'.$page.".php";
							if(file_exists(filter($fileExists)))
							{
								include("system/theme/".$config['skin']."/pages/".$page.".php");
							} 
							else 
							{
								include("system/theme/".$config['skin']."/pages/404.php"); 
							}
						}
						else
						{
							include("system/theme/".$config['skin']."/pages/maintenance.php"); 
						}
					} 
					else 
					{
						include("system/theme/".$config['skin']."/pages/index.php");
					}
				} 
				else 
				{
					include("system/theme/".$config['skin']."/pages/index.php");
					header('Location: '.$config['hotelUrl'].'/index');
				}
			}
			if(loggedIn()){ 
				switch($page)
				{
					case "index":
					case "register":
					header('Location: '.$config['hotelUrl'].'/me');
					break;
				}
			}
			if(!loggedIn()){ 
				switch($page)
				{
					case "me":
					case "game":
					case "pin":
					case "password":
					case "community":
					case "news":
					case "staff":
					case "teams":
					case "advertentie_tips":
					case "online":
					case "home/":
					header('Location: '.$config['hotelUrl'].'/index');
					break;
				}
			}
		}
		public static function error($errorName)
		{
			echo '<div class="error" style="display: block;">'.$errorName.'</div>';
		}
		public static function errorSucces($succesMessage)
		{
			echo '<div class="errorSucces" style="display: block;">'.$succesMessage.'</div>';
		}
	}
?>			