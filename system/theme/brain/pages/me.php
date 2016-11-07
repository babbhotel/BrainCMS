<?php
	include_once 'includes/header.php';
?>
<title><?= $config['hotelName'] ?>: <?= User::userData('username') ?></title>
<div class="center">
	<div class="columleft">
		<div class="boxuser">
			<div class="userplate">
				<img src="/system/theme/brain/style/images/icons/online/<?= User::userData('online') ?>.png" style="float:left;padding: 5px;">
				<div class="useravatar">
					<div class="avatar" style="background-image:url(https://avatar-retro.com/habbo-imaging/avatarimage?figure=<?= User::userData('look') ?>&amp;direction=2&amp;head_direction=3&amp;action=crr=667&amp;gesture=sml);"></div>
				</div>
			</div>
			<div class="userfirst">
				<div class="usernamebox">
					<div class="username">
						<?= User::userData('username') ?>
					</div>
				</div>
				<div class="usermottobox">
					<div class="usermotto">
						<?= User::userData('motto') ?>
					</div>
				</div>
				<div class="userbuttonbox">
					<a href="/game" onclick="window.open('/game','new','toolbar=0,scrollbars=0,location=1,statusbar=1,menubar=0,resizable=1,width=1270,height=700');return false;"><div class="userbutton">
						<?= $lang["Mgoto"] ?>
					</div></a>
				</div>
			</div>
			<div class="userstatsbox">
				<div style="color: #f8ef2b; background-image: url(/system/theme/brain/style/images/icons/crediticon.png);" class="userstats ">
					<?= User::userData('credits') ?> <?= $lang["Mcredits"] ?>
				</div>
			</div>
			<div class="userstatsbox">
				<div style="color: #e99bdc; background-image: url(/system/theme/brain/style/images/icons/duckicon.png);" class="userstats">
					<?= User::userData('activity_points') ?> <?= $lang["Mduckets"] ?>
				</div>
			</div>
			<div style="margin-bottom: 0px;" class="userstatsbox">
				<div style="color: #6caff4; background-image: url(/system/theme/brain/style/images/icons/diaicon.png);" class="userstats">
					<?= User::userData('vip_points') ?> <?= $lang["Mdiamond"] ?>
				</div>
			</div>
		</div>
		<style>
		</style>
		<div style = "height: 169px;" class="box">
			<div class="lblue title">
				<?= $lang["Mnewinhabbo"] ?>
			</div>
			<div class="mainBox" style="float;left">
				<?php
					$sqlGetUsersByRankDev = DB::Query("SELECT username,look FROM users ORDER BY ID DESC LIMIT 5");
					while ($getUsersDev = DB::Fetch($sqlGetUsersByRankDev))
					{
					?>
					<div class="userNewBox">
						<a href="/home/<?= filter($getUsersDev['username']) ?>"><div class="userNew" style="background: url(https://avatar-retro.com/habbo-imaging/avatarimage?figure=<?= filter($getUsersDev['look']) ?>&direction=3&head_direction=3&action=wav&headonly=0); background-position: 15px 2px;width: 80px;float: left;background-repeat: no-repeat;"></div>
							<div class="userNewName">
							<?= filter($getUsersDev['username']) ?></a>
						</div>
					</div>
					<?php
					}
					echo "</div>";
				?>
			</div>
			<div style = "height: 169px;" class="box">
				<div class="blue title">
					<?= $lang["Mtopgroupsinhabbo"] ?>
				</div>
				<div class="mainBox" style="float;left">
					<?php
						$getem = DB::Query("SELECT *,COUNT(*) AS count FROM groups,group_memberships WHERE groups.id = group_memberships.group_id GROUP BY group_memberships.group_id ORDER BY count DESC LIMIT 5");
						while ($row = $getem->fetch_assoc())
						{
						?>
						<div class="groupboxbg">
							<a class="tooltip" href="#"><div class="userNew" style="background: url(<?= $config['groupBadgeURL'] ?><?= filter($row['badge']); ?>); background-position: 30px 15px;width: 80px;float: left;background-repeat: no-repeat;"></div>
								<div class="userNewName">
									<?= filter($row['name']); ?>
									<span>
										<h3><?= filter($row['name']); ?></h3>
										<hr>
										<?= $row['desc']; ?>
									</span>
								</a>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
			<?php
				if($config['facebookEnable'] == true)
				{
				?>
				<div class="box">
					<div class="purple title">
						<?= $lang["Mfacebook"] ?>
					</div>
					<div class="mainBox" style="float;left">
						<div id="fb-root"></div>
						<script>(function(d, s, id) {
							var js, fjs = d.getElementsByTagName(s)[0];
							if (d.getElementById(id)) return;
							js = d.createElement(s); js.id = id;
							js.src = "//connect.facebook.net/nl_NL/sdk.js#xfbml=1&version=v2.7&appId=183748235334636";
							fjs.parentNode.insertBefore(js, fjs);
						}(document, 'script', 'facebook-jssdk'));</script>
						<center><div class="fb-page" data-href="<?= $config['facebook'] ?>" data-tabs="timeline" data-width="500" data-height="500" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="<?= $config['facebook'] ?>" class="fb-xfbml-parse-ignore"><a href="<?= $config['facebook'] ?>"><?= $config['hotelName'] ?> Hotel - World Wide Community</a></blockquote></div></center>
					</div>
				</div>
				<?php
				}
			?>
		</div>
		<div class="columright">
			<div class="boxnews">
				<?php
					$sql = DB::Query("SELECT id,title,image,shortstory FROM cms_news ORDER BY id DESC LIMIT 1");
					while($news = $sql->fetch_assoc())
					{
						echo'
						<div class="newsFirstImage" style="background-image: url('.filter($news["image"]).');">
						<div class="newsTitle">
						'.filter($news["title"]).'
						</div>
						<div class="newsTitleShort">
						'.filter($news["shortstory"]).'
						</div>
						<div class="newsTitleRead">
						<div class="newsTitleReadName">
						<a href="/news/'.filter($news["id"]).'">Lees meer »</a>
						</div>
						</div>
						</div>';
					}
				?>
			</div>
			<div class="box">
				<div class="title green">
					<?= $lang["Muotw"] ?>
				</div>
				<div class="mainBox" style="float;left">
					<div class="boxHeader"></div>
					<?= Website::userOfTheWeak() ?>
				</div>
			</div>
			<div class="box">
				<div class="title orange">
					<?= $lang["Mnowinroom"] ?>
				</div>
				<div class="mainBox" style="float;left">
					<div class="boxHeader"></div>
					<div class="scroll" style="width:330px;overflow-y: auto;overflow-x: hidden;">
						<div id="roomcount"><?= $lang["mloading"] ?></div>
					</div>
				</div>
			</div>
			<?php
				if($config['twitterEnable'] == true)
				{
				?>
				<div class="box">
					<div class="yellow title">
						<?= $lang["Mtwitter"] ?>
					</div>
					<a class="twitter-timeline" data-width="320" data-height="420" data-link-color="#FAB81E" href="<?= $config['twitter'] ?>">Tweets by <?= $config['hotelName'] ?></a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
				</div>
				<?php
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