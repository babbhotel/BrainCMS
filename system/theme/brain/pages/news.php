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
						$q = DB::Query("SELECT id,date,title FROM cms_news WHERE date >= " . DB::Escape($sectionCutoffMin) . " AND date <= " . DB::Escape($sectionCutoffMax) .  " ORDER BY date DESC");
						$getArticles = $q;
						if ($getArticles->num_rows > 0)
						{
							echo '
							<h2 style="  font-size: 100%;">' . filter($sectionName) . '</h2>
							';
							while($a = $getArticles->fetch_assoc())
							{
								echo '<a href="/news/' . filter($a['id']) . '" class="llink active" style="">' . filter($a['title']) . '&nbsp;&raquo;</a><br>';
							}
							echo '';
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
			<?= Website::newsLike() ?>
				<b style="font-size:15px; "><?= Website::newsLikeCount() ?> <?= $lang["Nuserslikenews"] ?></b> <img style="float:right;" src="/system/theme/brain/style/images/account/image_969.png">
				<form method="post">
				<input type="submit" class="buttonlike" value="<?= $lang["Nuserslikenewsbutton"] ?>" name="likenews" style="margin-top: 10px;">
				</form>
			</div>
		</div>
	</div>
	<div style="margin-left: 10px;" class="columleft">
		<?php
			if (empty($_GET['id']))
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
				if (!is_numeric($_GET['id']))
				{
					exit('Shut up!');
				}
				$sql = DB::Query("SELECT id,title,longstory FROM cms_news WHERE id = ".DB::Escape($_GET['id'])."");
				if (DB::NumRows($sql) == 1)
				{
					while($news = $sql->fetch_assoc())
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
	</div>
	<?php
		include_once 'includes/footer.php';
	?>
</div>
</div>
</body>
</html>			