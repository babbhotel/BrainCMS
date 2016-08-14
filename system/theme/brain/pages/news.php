<?php
	include_once 'includes/header.php';
?>
<title><?= $config['hotelName'] ?>: Nieuwsberichten</title>
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
				Nieuws berichten
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
							$sectionName = 'Vandaag';
							$sectionCutoffMax = time();
							$sectionCutoffMin = time() - 86400;
							break;
							case 1:
							$sectionName = 'Gisteren';
							$sectionCutoffMax = time() - 86400;
							$sectionCutoffMin = time() - 172800;
							break;
							case 2:
							$sectionName = 'Deze week';
							$sectionCutoffMax = time() - 172800;
							$sectionCutoffMin = time() - 604800;
							break;
							case 3:
							$sectionName = 'Vorige week';
							$sectionCutoffMax = time() - 604800;
							$sectionCutoffMin = time() - 1209600;
							break;
							case 4:
							$sectionName = 'Deze maand';
							$sectionCutoffMax = time() - 1209600;
							$sectionCutoffMin = time() - 2592000;
							break;
							case 5:
							$sectionName = 'vorige maand';
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
	</div>
	<div style="margin-left: 10px;" class="columleft">
		<?php
			if (empty($_GET['id']))
			{
			?>
			<div class='box'>
				<div class='title red'>Artikel is niet gevonden.</div>
				<div class='mainBox'>
					Jammer genoeg is dit nieuws artikel niet gevonden!
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
						'.filter(html_entity_decode($news['longstory'])).'
						</div>
						</div>';
					}
				}
				else
				{
				?>
				<div class='box'>
					<div class='title red'>Artikel is niet gevonden.</div>
					<div class='mainBox'>
						Jammer genoeg is dit nieuws artikel niet gevonden!
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