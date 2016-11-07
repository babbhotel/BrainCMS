<?php
	include_once 'includes/header.php';
?>
<title><?= $config['hotelName'] ?>: <?= $lang["Ssettings"] ?></title>
<div class="center">
	<div style="margin-left: 0px;" class="columright">
		<div style = "" class="box">
			<div class="title">
				<?= $lang["Ssettings"] ?>
			</div>
			<div class="mainBox" style="float;left">
				<a href="/settingspassword"><?= $lang["Schangepassword"] ?></a><br>
				<a href="/settingsemail"><?= $lang["Schangeemail"] ?></a><br>
				<b><?= $lang["Shotelsettings"] ?></b>
			</div>
		</div>
	</div>
	<script src="/system/theme/brain/style/js/burst.js"></script>
	<div style="margin-left: 10px;" class="columleft">
		<div class='box'>
			<div class='title red'><?= $lang["Shotelsettings"] ?></div>
			<form action="" method="POST">
				<div style="
				padding-top: 50px;"class='mainBox'>
					<?php User::editHotelSettings(); 
						$user = DB::Query("SELECT * FROM users WHERE id = '". DB::Escape($_SESSION['id'])."'");
						$stats = $user->fetch_assoc();
					?>
					<div class="oddeven"> 
						<div id="lft"><?= $lang["Sallowfrends"] ?>
						</div> 
						<div id="rght"> <input type="radio" class="hidde" onclick="Brain.Actions.settings(1, 1);" name="hinstellingenv" id="true" value="0" novalidate=""> 
							<div class="<?php if($stats['ignore_invites'] == 0 ){ echo "burst_active";}else {echo 'burst';}?>" id="img_true_1"> 
								<label for="true"> 
									<img src="/system/theme/brain/style/images/account/image_969.png"> 
								</label> 
							</div> 
							<input type="radio" class="hidde" onclick="Brain.Actions.settings(2, 1);" name="hinstellingenv" id="false" value="1" novalidate=""> 
							<div class="<?php if($stats['ignore_invites'] == 1 ){ echo "burst_active";}else {echo 'burst';}?>" id="img_false_1"> 
								<label for="false"> 
									<img src="/system/theme/brain/style/images/account/image_969_1.png"> 
								</label> 
								</div> 
						</div> 
						<div class="c">
						</div> </div> 
						<div class="oddeven"> 
							<div id="lft"><?= $lang["Sallowlook"] ?>
							</div> 
							<div id="rght"> 
								<input type="radio" class="hidde" onclick="Brain.Actions.settings(1, 2);" name="hinstellingenl" id="true2" value="1" novalidate=""> 
								<div class="<?php if($stats['allow_mimic'] == 1 ){ echo "burst_active";}else {echo 'burst';}?>" id="img_true_2"> 
									<label for="true2"> 
										<img src="/system/theme/brain/style/images/account/image_969.png"> 
									</label> 
								</div> 
								<input type="radio" class="hidde" onclick="Brain.Actions.settings(2, 2);" name="hinstellingenl" id="false2" value="0" novalidate=""> 
								<div class="<?php if($stats['allow_mimic'] == 0 ){ echo "burst_active";}else {echo 'burst';}?>" id="img_false_2"> 
									<label for="false2"> 
										<img src="/system/theme/brain/style/images/account/image_969_1.png"> 
									</label> 
								</div> 
							</div> 
							<div class="c">
							</div> 
						</div> 
						<div class="oddeven"> 
							<div id="lft"><?= $lang["Sallowonline"] ?>
							</div> 
							<div id="rght"> 
								<input type="radio" class="hidde" onclick="Brain.Actions.settings(1, 3);" name="hinstellingeno" id="true3" value="1" novalidate=""> 
								<div class="<?php if($stats['hide_online'] == 0 ){ echo "burst";}else {echo 'burst_active';}?>" id="img_true_3"> 
									<label for="true3"> 
										<img src="/system/theme/brain/style/images/account/image_969.png"> 
									</label> 
								</div> 
								<input type="radio" class="hidde" onclick="Brain.Actions.settings(2, 3);" name="hinstellingeno" id="false3" value="0" novalidate=""> 
								<div class="<?php if($stats['hide_online'] == 1 ){ echo "burst";}else {echo 'burst_active';}?>" id="img_false_3"> 
									<label for="false3"> 
										<img src="/system/theme/brain/style/images/account/image_969_1.png"> 
									</label> 
								</div> 
							</div> 
							<div class="c">
							</div> 
						</div> 
						<input type="submit" class="submit" value="<?= $lang["Ssave"] ?>" name="hotelsettings" style="margin-top: 10px;">
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