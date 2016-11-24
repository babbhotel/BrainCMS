<?php
	if(!defined('BRAIN_CMS')) 
	{ 
		die('Sorry but you cannot access this file!'); 
	}
	function newsLike()
	{
		global $lang;
		if (isset($_POST['likenews']))
		{
			$newsLikeUser = DB::Fetch(DB::Query("SELECT userid, newsid FROM cms_news_like WHERE userid = '".DB::Escape(User::userData('id'))."' AND newsid = '".DB::Escape(filter($_GET['id']))."'"));
			if($newsLikeUser['userid'] == DB::Escape(User::userData('id')) && $newsLikeUser['newsid'] == DB::Escape(filter($_GET['id']))) {
				return html::error($lang["LoneTime"]);
				} else {
				$sql = DB::Query("SELECT id,title,longstory FROM cms_news WHERE id = ".DB::Escape(filter($_GET['id']))."");
				if (!DB::NumRows($sql) == 0)
				{
					DB::Query("
					INSERT INTO
					cms_news_like
					(userid, newsid)
					VALUES
					(
					'".DB::Escape(User::userData('id'))."', 
					'".DB::Escape(filter($_GET['id']))."' 
					)
					");
					return html::errorSucces($lang["LnewsLike"]);
				}
				else{
					return html::error($lang["LnoNews"]);
				}
			}
		}
	}
	function newsLikeCount()
	{
		$query = DB::NumRows(DB::Query("SELECT * FROM cms_news_like WHERE newsid = '" . DB::Escape(filter($_GET['id'])) . "'"));
		return filter($query);
	}
	
?>