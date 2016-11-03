<?php
	include_once 'includes/header.php';
?>
<title><?= $config['hotelName'] ?>: Insetllingen</title>
<div class="center">
	<div style="margin-left: 0px;" class="columright">
		<div style = "" class="box">
			<div class="title">
				Instellingen
			</div>
			<div class="mainBox" style="float;left">
				<a href="/settingspassword">Wachtwoord veranderen</a><br>
				<a href="/settingsemail">Email veranderen</a><br>
				<b>Hotel Instellingen</b>
			</div>
		</div>
	</div>
	<style>
		.oddeven:nth-child(odd) {
		background-color: rgba(0,0,0,0.06);
		}
		.oddeven {
		transition: .1s all ease-out;
		padding: 10px;
		max-height: 30px;
		border-bottom: 1px dotted #BDBDBD;
		cursor: pointer;
		}
		#lft {
		float: left;
		}
		#rght {
		float: right;
		}
		.hidde {
		display: none;
		}
		.burst {
		width: 29px;
		float: left;
		height: 38px;
		padding-top: 6px;
		padding-left: 10px;
		}
		label {
		cursor: default;
		}
		.burst_active {
		background: url(/system/theme/brain/style/images/account/burst_tiny.png);
		width: 28px;
		height: 32px;
		float: left;
		padding-top: 6px;
		padding-left: 10px;
		}
		.c {
		clear: both;
		}
	</style>
	<script>
		var Tebbo = {
			Actions: {
				settings: function(rate, id) {
					var rate = parseInt(rate);
					if (rate == 1) {
						$("#img_true_" + id).removeClass("burst").addClass("burst_active");
						$("#img_false_" + id).removeClass("burst_active").addClass("burst");
						} else {
						$("#img_false_" + id).removeClass("burst").addClass("burst_active");
						$("#img_true_" + id).removeClass("burst_active").addClass("burst");
					}
					$('#target').submit();
				},
			}
		};
	</script>
	<div style="margin-left: 10px;" class="columleft">
		<div class='box'>
			<div class='title red'>Hotel Instellingen</div>
			<form action="" method="POST">
				
				<div style="
			padding-top: 50px;"class='mainBox'>
				
				<?php User::editHotelSettings(); 
					
				$user = DB::Query("SELECT * FROM users WHERE id = '". DB::Escape($_SESSION['id'])."'");
					$stats = $user->fetch_assoc();

				?>
				<div class="oddeven"> 
					<div id="lft"> <b>Vrienden toestaan</b><br>  Sta je toe dat andere mensen jou een vriendenverzoek sturen?
					</div> 
					<div id="rght"> <input type="radio" class="hidde" onclick="Tebbo.Actions.settings(1, 1);" name="hinstellingenv" id="true" value="0" novalidate=""> 
						<div class="<?php if($stats['ignore_invites'] == 0 ){ echo "burst_active";}else {echo 'burst';}?>" id="img_true_1"> 
							<label for="true"> 
								<img src="/system/theme/brain/style/images/account/image_969.png"> 
							</label> 
						</div> 
						<input type="radio" class="hidde" onclick="Tebbo.Actions.settings(2, 1);" name="hinstellingenv" id="false" value="1" novalidate=""> 
						<div class="<?php if($stats['ignore_invites'] == 1 ){ echo "burst_active";}else {echo 'burst';}?>" id="img_false_1"> 
							<label for="false"> 
								<img src="/system/theme/brain/style/images/account/image_969_1.png"> 
							</label> 
						</div> 
					</div> 
					<div class="c">
					</div> </div> 
					<div class="oddeven"> 
						<div id="lft"> <b>Kopieerlook toestaan</b><br> Sta je toe dat andere je look kunnen kopieren? 
						</div> 
						<div id="rght"> 
							<input type="radio" class="hidde" onclick="Tebbo.Actions.settings(1, 2);" name="hinstellingenl" id="true2" value="1" novalidate=""> 
							<div class="<?php if($stats['allow_mimic'] == 1 ){ echo "burst_active";}else {echo 'burst';}?>" id="img_true_2"> 
								<label for="true2"> 
									<img src="/system/theme/brain/style/images/account/image_969.png"> 
								</label> 
							</div> 
							<input type="radio" class="hidde" onclick="Tebbo.Actions.settings(2, 2);" name="hinstellingenl" id="false2" value="0" novalidate=""> 
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
						<div id="lft"> <b>Online status</b><br> Sta je toe dat andere mensen mogen zien of je online bent? 
						</div> 
						<div id="rght"> 
							<input type="radio" class="hidde" onclick="Tebbo.Actions.settings(1, 3);" name="hinstellingeno" id="true3" value="1" novalidate=""> 
							<div class="<?php if($stats['hide_online'] == 0 ){ echo "burst";}else {echo 'burst_active';}?>" id="img_true_3"> 
								<label for="true3"> 
									<img src="/system/theme/brain/style/images/account/image_969.png"> 
								</label> 
							</div> 
							<input type="radio" class="hidde" onclick="Tebbo.Actions.settings(2, 3);" name="hinstellingeno" id="false3" value="0" novalidate=""> 
							<div class="<?php if($stats['hide_online'] == 1 ){ echo "burst";}else {echo 'burst_active';}?>" id="img_false_3"> 
								<label for="false3"> 
									<img src="/system/theme/brain/style/images/account/image_969_1.png"> 
								</label> 
							</div> 
						</div> 
						<div class="c">
						</div> 
					</div> 
					<input type="submit" class="submit" value="Opslaan" name="hotelsettings" style="margin-top: 10px;">
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