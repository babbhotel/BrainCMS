<?php
	if(!defined('BRAIN_CMS')) 
	{ 
		die('Sorry but you cannot access this file!'); 
	}
	function newsComment()
	{
	global $lang;
		if (isset($_POST['newscomment']))
		{
			$count = DB::Query("SELECT * FROM cms_news_message WHERE userid = '" .User::userData('id'). "' AND newsid = '".filter(DB::Escape($_GET['id']))."'");
			if (DB::NumRows($count) <= 2)
			{
				if (!empty($_POST['message']))
				{
					if (strlen($_POST['message']) >= 3)
					{
						$sql = DB::Query("SELECT id,title,longstory FROM cms_news WHERE id = ".DB::Escape(filter($_GET['id']))."");
						if (!DB::NumRows($sql) == 0)
						{
							$AddSollie = DB::Escape(DB::Fetch(DB::Query("
							INSERT INTO cms_news_message (
							newsid,
							userid,
							message,
							date,
							hash
							) VALUES (
							'".filter(DB::Escape($_GET['id']))."', 
							'".User::userData('id'). "',
							'". htmlentities(DB::Escape($_POST['message'])). "',
							'". filter(DB::Escape(time())) ."',
							'". filter(DB::Escape(time())) ."'
							'".DB::Escape(user::hashed($_POST['message']))."' 
							
							)")));
							header('Location: '.$config['hotelUrl'].'/news/'.filter(DB::Escape($_GET['id'])).'');	
						}
						else
						{
							return Html::error($lang["CnoNews"]);
						}
					}
					else
					{
						return Html::error($lang["Ccommandshort"]);
					}
				}
				else
				{
					return Html::error($lang["Ccommandempty"]);
				}
			}
			else
			{
				return Html::error($lang["Ccommandmax"]);
			}
		}
	}
?>	