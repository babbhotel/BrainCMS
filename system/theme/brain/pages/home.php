<?php
	include_once 'includes/header.php';
?>
<style></style>
<title><?= $config['hotelName'] ?>: <?= Website::userHome('username'); ?> </title>
<div class="center">
	<div style="    width: 500px; margin-left: 0px;" class="columright">
		<div style = "" class="box">
			<div class="title">
				<?= Website::userHome('username'); ?>'s <?= $lang["Huserprofile"] ?>
			</div>
			<div class="mainBox" style="float;left">
				<div id="column" style="    width: 460px;height: 400px;background: url('/system/theme/brain/style/images/icons/Hotel_HP_BG.png') no-repeat;background-color: #FFF;">
					<div class='boxbg1'>
						<div class="platte" style="float: left;margin-left:-5px;margin-top:5px;background:url(/assets/images/home/xplatte.png.pagespeed.ic._FLI3gmXWX.png) no-repeat;background-position:50% 50%;width:119px;height:165px">
							<img src="https://avatar-retro.com/habbo-imaging/avatarimage?figure=<?= Website::userHome('look'); ?>&direction=2&head_direction=3&action=wlk&gesture=sml" style="-webkit-filter: drop-shadow(0 1px 0 #FFFFFF) drop-shadow(0 -1px 0 #FFFFFF) drop-shadow(1px 0 0 #FFFFFF) drop-shadow(-1px 0 0 #FFFFFF);margin-top: -20px;position: absolute;margin-left: 25px;">
						</div>
						<div class="mission">	 <?= filter(Website::userHome('motto')); ?></div>
					</div>
					<div class="boxbg3">
						<div class='boxx credits'>
							<?= Website::userHome('username'); ?>  <?= $lang["Hhas"] ?> <b> <?= Website::userHome('credits'); ?> </b> <?= $lang["Hcredits"] ?>
						</div>
						<div class='boxx pixel'>
							<?= Website::userHome('username'); ?>  <?= $lang["Hhas"] ?> <b> <?= Website::userHome('activity_points'); ?> </b> <?= $lang["Hduckets"] ?>
						</div>
						<div class='boxx sterne'>
							<?= Website::userHome('username'); ?>  <?= $lang["Hhas"] ?> <b> <?= Website::userHome('vip_points'); ?> </b> <?= $lang["Hdiamond"] ?>
						</div>
						<div class='boxx register'>
							<?= $lang["Hjoined"] ?> <b><?php echo date("y-m-d, H:i",Website::userHome('account_created')); ?></b>
						</div>
						<div class='boxx register'>
							<?= $lang["Hlastonline"] ?> <b><?php echo date("y-m-d, H:i", Website::userHome('last_online')); ?></b>
						</div>
					</div>
					<div class="boxbg2">
						<div class="sternbg">
							<div class="smalltext" style="text-align: center;"></div>
							<div class="smalltext" style="width: 100%;text-align: center;"><b><?= Website::userHome('username'); ?>:</b> <?= $lang["Hhometext"] ?></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div style="width: 470px;margin-left: 10px;" class="columleft">
		<div class="box">
			<div class="green title">
				<?= $lang["Hbagesof"] ?> <?= Website::userHome('username'); ?>
			</div>
			<div class="mainBox" style="float;left">
				<?php
					$sql = DB::Query("SELECT * FROM `user_badges` WHERE (`user_id` = '".DB::Escape(Website::userHome('id'))."')");
					if (!DB::NumRows($sql) == 0)
					{
						while($news = DB::Fetch($sql))
						{
							echo"<img src=\"/swf/c_images/album1584/".$news["badge_id"].".GIF\">";
						}
					}
					else
					{
						echo Website::userHome('username').' heeft nog geen badges';
					}
				?>
			</div>
		</div>
		<div class="box">
			<div class="blue title">
				<?= $lang["Hfrendsof"] ?> <?= Website::userHome('username'); ?>
			</div>
			<div class="mainBox" style="float;left">
				<div style="width: 450px; height: 400px; overflow-y: scroll;">
					<?php
						$sql = DB::Query("SELECT * FROM `messenger_friendships` WHERE (`user_one_id`='".DB::Escape(Website::userHome('id'))."') OR (`user_two_id`='".DB::Escape(Website::userHome('id'))."') ORDER BY RAND()");
						if (!DB::NumRows($sql) == 0)
						{
							while($news = DB::Fetch($sql))
							{
								$id = (DB::Escape(Website::userHome('id')) == $news['user_two_id'] ? $news['user_one_id'] : $news['user_two_id']);
								$getUserData = DB::Fetch(DB::Query("SELECT * FROM users WHERE id = '".$id."'"));
								echo'
								- <a href="/home/'.$getUserData['username'].'"> <img style="float: right;" src="https://avatar-retro.com/habbo-imaging/avatarimage?figure='.$getUserData['look'].'&direction=3&head_direction=3&action=wav&gesture=sml&size=s&headonly=0"> 
								<b>'.$getUserData['username'].'</b></a><br>'.filter($getUserData['motto']).'<br><br><br><hr>  
								';
							}
						}
						else
						{
							echo Website::userHome('username').' heeft nog geen vrienden';
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