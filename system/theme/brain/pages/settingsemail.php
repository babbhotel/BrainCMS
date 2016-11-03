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
				<b>Email veranderen</b><br>
				<a href="/settingshotel">Hotel Instellingen</a>
			</div>
		</div>
	</div>
	<div style="margin-left: 10px;" class="columleft">
		<div class='box'>
			<div class='title red'>Email veranderen</div>
			<div class='mainBox'>
			<?php User::editEmail(); ?>
				<form action="" method="post">
					<b>Email adres:</b>
					<input type="text" name="email" value="<?= User::userData('mail') ?>" id="avatarmotto" autocomplete="off" style="margin-bottom: 3px;width: 100%;">
					<span style="font-size:12px;color:gray;">Zorg ervoor dat dit een echt Email adres is. Stel je voor je bent je account wachtwoord vergeten en kunt hem niet resetten? met jouw email is dat mogelijk!</span>
					<input type="submit" class="submit" value="Mail opslaan" name="account" style="margin-top: 10px;">
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