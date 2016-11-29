<?php
	if(!defined('BRAIN_CMS')) 
	{ 
		die('Sorry but you cannot access this file!'); 
	}
	/* 
		Functions list Class Html.
		--------------- 
		checkBan();
		page();
		pageHK();
		error();
		errorSucces();
		loadPlugins();
	*/
	class Html 
	{
		private static function checkBan($ip, $username = null)
		{
			if (DB::NumRowsQuery("SELECT bantype,expire FROM bans WHERE bantype = 'ip' && value = '".filter(DB::Escape($ip))."'") === 1)
			{
				$queryIp = DB::Query("SELECT bantype,expire FROM bans WHERE bantype = 'ip' && value = '".filter(DB::Escape($ip))."'");
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
				if (DB::NumRowsQuery("SELECT bantype,expire FROM bans WHERE bantype = 'user' && value = '".filter(DB::Escape($username))."'") === 1)
				{
					$queryUser = DB::Query("SELECT bantype,expire FROM bans WHERE bantype = 'user' && value = '".filter(DB::Escape($username))."'");
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
			
			if (defined('PHP_VERSION') && PHP_VERSION >= 5.6) 
			{
				true;
			} 
			else 
			{
				echo 'PHP version is lower then PHP 5.6 your PHP version is '.PHP_VERSION.'';
				exit;
			}
			if (self::checkBan(checkCloudflare(), User::userData('username')))
			{
				include("system/theme/".$config['skin']."/pages/banned.php");
				exit();
			}
			else
			{
				if(isset($_GET['url']))
				{
					$page = filter($_GET['url']);	
					if($page)
					{ 
						if (!$config['maintenance'] == true || isset($_SESSION['adminlogin'])	){
							$fileExists = A . G . H . S .'/pages/'.$page.".php";
							if(file_exists($fileExists))
							{
								include A . G . H . S .'/pages/'.$page.'.php';
							} 
							else 
							{
								include A . G . H . S .'/pages/404.php'; 
							}
						}
						else
						{
							if ($page == 'adminlogin')
							{
								include A . G . I . 'adminlogin.php'; 
							}
							else
							{
								include A . G . I . 'index.php'; 
							}
						}
					} 
					else 
					{
						include A . G . H . S . '/pages/index.php';
					}
				} 
				else 
				{
					include A . G . H . S . '/pages/index.php';
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
					case "changename";
					if (User::userData('fbenable') >= 1)
					{
						header('Location: '.$config['hotelUrl'].'/me');	
						exit();
					}
					break;
					case "game":
					case "client":
					case "hotel":
					if (User::userData('fbenable') == 0)
					{
						header('Location: '.$config['hotelUrl'].'/changename');	
						exit();
					}
					break;
					default:
					//Nothing
					break;
				}
			}
			if(!loggedIn()){ 
				switch($page)
				{
					case "me":
					case "settingspassword":
					case "settingsemail":
					case "settingshotel":
					case "sollicitaties":
					case "stats":
					case "game":
					case "client":
					case "hotel":
					case "pin":
					case "password":
					case "community":
					case "news":
					case "staff":
					case "teams":
					case "advertentie_tips":
					case "online":
					case "home/":
					case "changename":
					header('Location: '.$config['hotelUrl'].'/index');
					break;
					default:
					//Nothing
					break;
				}
			}
		}
		public static function pageHK()
		{
			global $emu, $config, $lang, $hotel, $version;
			if(isset($_GET['url']))
			{
				$pageHK = DB::Escape($_GET['url']);	
				if($pageHK)
				{ 
					$fileExists = J . $pageHK.".php";
					if(file_exists(filter($fileExists)))
					{
						include J .$pageHK.".php";
					} 
					else 
					{
						include J . "/404.php"; 
					}
				} 
				else 
				{
					include J . "/dash.php";
				}
			} 
			else 
			{
				include J . "dash.php";
				header('Location: '.$config['hotelUrl'].'/adminpan/dash');
			}
			
			switch($pageHK)
			{
				case $pageHK:
				admin::CheckRank(3);
				break;
				default:
				//Nothing
				break;
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
		public static function loadPlugins()
		{
			$pluginDir = A . B . K;
			foreach (glob($pluginDir."*.php") as $filename) {
				require_once $pluginDir."".basename($filename)."";
			}
		}
	} 
?>			