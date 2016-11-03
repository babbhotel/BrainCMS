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
			<b>Wachtwoord veranderen</a></b><br>
			<a href="/settingsemail">Email veranderen</a><br>
			<a href="/settingshotel">Hotel Instellingen</a>
			</div>
		</div>
	</div>
	<div style="margin-left: 10px;" class="columleft">
		<div class='box'>
			<div class='title red'>Wachtwoord veranderen</div>
			<div class='mainBox'>
				<form action="" method="POST">
				<?php User::editPassword(); ?>
					<b>Vul hier het huidige wachtwoord:</b>
					<input  placeholder="*****************" type="password" name="oldpassword" value="" id="avatarmotto" style="margin-bottom: 3px;width: 100%;"><br>
					<span style="font-size:12px;color:gray;">Vul hier je oude wachtwoord in.</span><br><br>
					<b>Verander hier het wachtwoord...</b>
					<input  placeholder="*****************"  type="password" name="newpassword" value="" id="avatarmotto" style="margin-bottom: 3px;width: 100%;"><br>
					<span style="font-size:12px;color:gray;">Kies hier een nieuw sterk wachtwoord, zorg ervoor dat niemand jouw wachtwoord zomaar kan kraken.</span>
					<input type="submit" class="submit" value="Opslaan" name="password" style="margin-top: 10px;">
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