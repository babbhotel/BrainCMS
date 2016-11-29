<?php
	include_once 'includes/header.php';
?>
<style></style>
<title><?= $config['hotelName'] ?>: <?= userHome('username'); ?> </title>
<div class="center">
	<div style="    width: 500px; margin-left: 0px;" class="columright">
		<div style = "" class="box">
			<div class="title">
				<?= userHome('username'); ?>'s <?= $lang["Huserprofile"] ?>
			</div>
			<div class="mainBox" style="float;left">
				<div id="column" style="    width: 460px;height: 400px;background: url('/system/content/theme/brain/style/images/icons/Hotel_HP_BG.png') no-repeat;background-color: #FFF;">
					<div class='boxbg1'>
						<div class="platte" style="float: left;margin-left:-5px;margin-top:5px;width:119px;height:165px">
							<img src="https://avatar-retro.com/habbo-imaging/avatarimage?figure=<?= userHome('look'); ?>&direction=2&head_direction=3&action=wlk&gesture=sml" style="-webkit-filter: drop-shadow(0 1px 0 #FFFFFF) drop-shadow(0 -1px 0 #FFFFFF) drop-shadow(1px 0 0 #FFFFFF) drop-shadow(-1px 0 0 #FFFFFF);margin-top: -20px;position: absolute;margin-left: 25px;">
						</div>
						<div class="mission">	 <?= filter(userHome('motto')); ?></div>
					</div>
					<div class="boxbg3">
						<div class='boxx credits'>
							<?= userHome('username'); ?>  <?= $lang["Hhas"] ?> <b> <?= userHome('credits'); ?> </b> <?= $lang["Hcredits"] ?>
						</div>
						<div class='boxx pixel'>
							<?= userHome('username'); ?>  <?= $lang["Hhas"] ?> <b> <?= userHome('activity_points'); ?> </b> <?= $lang["Hduckets"] ?>
						</div>
						<div class='boxx sterne'>
							<?= userHome('username'); ?>  <?= $lang["Hhas"] ?> <b> <?= userHome('vip_points'); ?> </b> <?= $lang["Hdiamond"] ?>
						</div>
						<div class='boxx register'>
							<?= $lang["Hjoined"] ?> <b><?php echo date("y-m-d, H:i",userHome('account_created')); ?></b>
						</div>
						<div class='boxx register'>
							<?= $lang["Hlastonline"] ?> <b><?php echo date("y-m-d, H:i", userHome('last_online')); ?></b>
						</div>
					</div>
					<div class="boxbg2">
						<div class="sternbg">
							<div class="smalltext" style="text-align: center;"></div>
							<div class="smalltext" style="width: 100%;text-align: center;"><b><?= userHome('username'); ?>:</b> <?= $lang["Hhometext"] ?></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div style="width: 470px;margin-left: 10px;" class="columleft">
		<div class="box">
			<div class="green title">
				<?= $lang["Hbagesof"] ?> <?= userHome('username'); ?>
			</div>
			<div class="mainBox" style="float;left">
				<?php
					$getUSerBadges = DB::Query("SELECT * FROM `user_badges` WHERE (`user_id` = '".filter(DB::Escape(userHome('id')))."')");
					if (!DB::NumRows($getUSerBadges) == 0)
					{
						while($badge = DB::Fetch($getUSerBadges))
						{
							echo"<img src=\"".$config['badgeURL']."".$badge["badge_id"].".GIF\">";
						}
					}
					else
					{
						echo userHome('username').' heeft nog geen badges';
					}
				?>
			</div>
		</div>
		<div class="box">
			<div class="blue title">
				<?= $lang["Hfrendsof"] ?> <?= userHome('username'); ?>
			</div>
			<div class="mainBox" style="float;left">
				<div style="width: 450px; height: 400px; overflow-y: scroll;">
					<?php
						$sql = DB::Query("SELECT * FROM `messenger_friendships` WHERE (`user_one_id`='".filter(DB::Escape(userHome('id')))."') OR (`user_two_id`='".DB::Escape(userHome('id'))."') ORDER BY RAND()");
						if (!DB::NumRows($sql) == 0)
						{
							while($news = DB::Fetch($sql))
							{
								$id = (filter(userHome('id')) == $news['user_two_id'] ? $news['user_one_id'] : $news['user_two_id']);
								$getUserData = DB::Fetch(DB::Query("SELECT * FROM users WHERE id = '".filter(DB::Escape($id."'"))));
								echo'
								- <a href="/home/'.filter($getUserData['username']).'"> <img style="float: right;" src="https://avatar-retro.com/habbo-imaging/avatarimage?figure='.filter($getUserData['look']).'&direction=3&head_direction=3&action=wav&gesture=sml&size=s&headonly=0"> 
								<b>'.filter($getUserData['username']).'</b></a><br>'.filter($getUserData['motto']).'<br><br><br><hr>  
								';
							}
						}
						else
						{
							echo userHome('username').' heeft nog geen vrienden';
						}
					?>
				</div>
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