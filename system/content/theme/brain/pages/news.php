<?php
	include_once 'includes/header.php';
?>
<title><?= $config['hotelName'] ?>: <?=  $lang["Nnews"] ?></title>
<style type="text/css">
	.mainBox.newsBox a {
	color: #1c76c7;
	}
	.googlebox{
	padding: 10px;
    background-color: #969696;
    border-radius: 3px;
	}
</style>
<div class="center">
	<div style="margin-left: 0px;" class="columright">
		<div style = "" class="box">
			<div class="title">
				<?=  $lang["Nnews"] ?>
			</div>
			<div class="mainBox" style="float;left">
				<?php
					for ($i = 0; $i < 6; $i++)
					{
						$sectionName = "";
						$sectionCutoffMax = 0;
						$sectionCutoffMin = 0;
						switch ($i)
						{
							case 0:
							$sectionName = ''.$lang["Ntoday"].'';
							$sectionCutoffMax = time();
							$sectionCutoffMin = time() - 86400;
							break;
							case 1:
							$sectionName = ''.$lang["Nyesterday"].'';
							$sectionCutoffMax = time() - 86400;
							$sectionCutoffMin = time() - 172800;
							break;
							case 2:
							$sectionName = ''.$lang["Nthisweek"].'';
							$sectionCutoffMax = time() - 172800;
							$sectionCutoffMin = time() - 604800;
							break;
							case 3:
							$sectionName = ''.$lang["Nlastweek"].'';
							$sectionCutoffMax = time() - 604800;
							$sectionCutoffMin = time() - 1209600;
							break;
							case 4:
							$sectionName = ''.$lang["Nthismonth"].'';
							$sectionCutoffMax = time() - 1209600;
							$sectionCutoffMin = time() - 2592000;
							break;
							case 5:
							$sectionName = ''.$lang["Nlastmonth"].'';
							$sectionCutoffMax = time() - 2592000;
							$sectionCutoffMin = time() - 5184000;
							break;
						}
						$q = DB::Query("SELECT id,date,title FROM cms_news WHERE date >= " . filter(DB::Escape($sectionCutoffMin)) . " AND date <= " . filter(DB::Escape($sectionCutoffMax)) .  " ORDER BY date DESC");
						$getArticles = $q;
						if (DB::NumRows($getArticles) > 0)
						{
							echo '
							<h2 style="  font-size: 100%;">' . filter($sectionName) . '</h2>
							';
							while ($a = DB::Fetch($getArticles))
							{
								echo '<a href="/news/' . filter($a['id']) . '" class="llink active" style="">' . filter($a['title']) . '&nbsp;&raquo;</a><br>';
							}
						}
					}
				?>
			</div>
		</div>
		<style>
			.buttonlike {
			background: #1d0fda !important;
			}
			.buttonlike:hover {
			background: #150e75 !important;
			transition: all .2s ease-in;
			}
		</style>
		<div class='box'>
			<div class='title green'><?= $lang["NlikeTitle"] ?></div>
			<div class='mainBox'>
				<?= newsLike() ?>
				<b style="font-size:15px; "><?= newsLikeCount() ?> <?= $lang["Nuserslikenews"] ?></b> <img style="float:right;" src="/system/content/theme/brain/style/images/account/image_969.png">
				<form method="post">
					<input type="submit" class="buttonlike" value="<?= $lang["Nuserslikenewsbutton"] ?>" name="likenews" style="margin-top: 10px;">
				</form>
			</div>
		</div>
	</div>
	<div style="margin-left: 10px;" class="columleft">
		<?php
			if (empty(filter(DB::Escape($_GET['id']))))
			{
			?>
			<div class='box'>
				<div class='title red'><?= $lang["Nnotfoundheader"] ?></div>
				<div class='mainBox'>
					<?= $lang["Nnotfoundtxt"] ?>
				</div>
			</div>
			<?php
			}
			else
			{
				if (!is_numeric(filter(DB::Escape($_GET['id']))))
				{
					exit('Shut up!');
				}
				$sql = DB::Query("SELECT id,title,longstory FROM cms_news WHERE id = ".filter(DB::Escape($_GET['id']))."");
				if (DB::NumRows($sql) == 1)
				{
					while ($news = DB::Fetch($sql))
					{
						echo'<div class="box">
						<div class="title">
						'.filter($news["title"]).'
						</div>
						<div class="mainBox newsBox" style="float;left">
						<div class="boxHeader"></div>
						'.html_entity_decode($news['longstory']).'
						</div>
						</div>';
					}
				}
				else
				{
				?>
				<div class='box'>
					<div class='title red'><?= $lang["Nnotfoundheader"] ?></div>
					<div class='mainBox'>
						<?= $lang["Nnotfoundtxt"] ?>
					</div>
				</div>
				<?php
				}
			}
		?>
		<style>
			.mainnewscolumn{
			width: 100%;
			height: 100px;
			float: left;
			box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.09),0 1px 2px rgba(0, 0, 0, 0.43);
			margin-bottom: 10px;
			border-radius: 3px;
			}
			.newscolumnname{
			float: left;
			margin-top: 9px;
			margin-left: -14px;
			font-weight: bold;
			font-size: 14px;
			width: 65%;
			}
			.newscolumndate{
			float: right;
			margin-top: 9px;
			padding-right: 10px;
			}
			.newscolumndelete{
			float: right;
			margin-top: 6px;
			padding-right: 3px;
			}
			.newscolumnmessage{
			float: left;
			margin-top: 14px;
			font-size: 14px;
			width: 83%;
			height: 49px;
			overflow: auto;
			}
			textarea {
			width: 100%;
			height: 100px;
			padding: 12px 20px;
			box-sizing: border-box;
			border: 1px solid #ccc;
			border-radius: 3px;
			background-color: #f8f8f8;
			resize: none;
			}
		</style>
		<div class='box'>
			<div class='title blue'><?= $lang["Nnewscommands"] ?></div>
			<div class='mainBox'>
				<?= deleteCommand() ?>
				<?php
					$getMessage = DB::Query("SELECT id,userid,newsid,date,message,hash FROM cms_news_message WHERE newsid = ".filter(DB::Escape($_GET['id']))."");
					if (DB::NumRows($getMessage) > 0)
					{
						while ($getMessageData = DB::Fetch($getMessage))
						{
							$getMessageUser = DB::Fetch(DB::Query("SELECT id,username FROM users WHERE id = ".filter(DB::Escape($getMessageData["userid"])."")));
							echo'<div class="mainnewscolumn">
							<div id="newscolumn" style="border: 2px dotted rgba(0, 0, 0, 0.2);padding: 10px;margin-top: 10px;margin-left: 10px;margin-right: 10px;margin-bottom: 10px;float: left;height:55px;width: 55px;border-radius: 555px;-moz-border-radius: 555px;-webkit-border-radius: 555px;background:url(https://avatar-retro.com/habbo-imaging/avatarimage?figure=hr-3163-1035.hd-3092-2.ch-215-63.lg-3320-1189-62.sh-3089-1408.ca-3219-110.wa-2001-0&amp;head_direction=3&amp;action=wav) no-repeat;background-position: 50% 10%;"></div>
							<div class="newscolumnname">
							'.filter($getMessageUser["username"]).'
							</div>';
							if ($getMessageData['userid'] == User::userData('id') || User::userData('rank') >= 3)
							{
								echo'
								<div class="newscolumndelete">
								<form method="post">
								<button name="deletecommand" type="submit" style="border: 0; background: transparent">
								<img src="/system/content/theme/brain/style/images/icons/trash.png" width="16" height="16" alt="delete" />
								<input type="hidden" name="hashid" value="'.filter($getMessageData['hash']).'">
								</button>
								</form>
								</div>
								';
							}
							echo '
							<div class="newscolumndate">
							'.filter(gmdate("d-m-y", $getMessageData["date"])).'
							</div>
							<div class="newscolumnmessage">
							'.filter(html_entity_decode($getMessageData["message"])).'
							</div>
							</div>';
						}
					}
					else{
						echo $lang["Nnocommands"];
					}
				?>
			</div>
		</div>
		<div class='box'>
			<div class='title red'><?= $lang["Npostcommand"] ?></div>
			<div class='mainBox'>
				<?= newsComment() ?>
				<form method="post">
					<textarea name="message"></textarea>
					<input type="submit" class="button" value="<?= $lang["Ncommandbutton"] ?>" name="newscomment" style="margin-top: 10px;">
				</form>
			</div>
		</div>
	</div>
	<?php
		include_once 'includes/footer.php';
	?>
</div>
</div>
</body>
</html>			