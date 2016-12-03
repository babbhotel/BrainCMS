<?php
	include_once "includes/head.php";
	include_once "includes/header.php";
	include_once "includes/navi.php";
	$_SESSION['title'] = '';
	$_SESSION['slogan'] = '';
	$_SESSION['news'] ='';
?>
<aside class="right-side">
	<section class="content">
		<!-- Main row -->
		<div class="row">
			<div class="col-md-8">
				<!--earning graph start-->
				<section class="panel">
					<header class="panel-heading">
						<b>   Het Staffpaneel dat wordt gebruikt op <?= $config['hotelName'] ?> Hotel.</b><br>
					</header>
					<div class="panel-body">
					<?php 
					
					checkVersion();
					
					?>
					
						Welkom in de HK van <?= $config['hotelName'] ?> hotel.<b></b>!<br>
						Gebruik het Admin Paneel zoals het hoort, regels zijn regels en afspraken zijn afspraken.
						<br>Alles wat je hier in doet kunnen wij achterhalen.
						<br>
						<br>
						<br>Het kan zijn dat nog niet alles werkt en dat er nog weinig functie's zijn.
						<br>We gaan het rustig opbouwen en in de loop van de maanden steeds meer uitbreiden!
						<br>
						<br>
						Als er iets niet werkt mag je het gerust komen melden bij <b><?= $config['hotelName'] ?> manager</b>.
						<br>Doe dat dan ook zodat wij het kunnen verbeteren!
						<br>
						<br>Met vriendelijk groet,
						<br><b> Tom maker van BrainCMS</b>
					</div>
				</section>
				<!--earning graph end-->
			</div>
			<div class="col-lg-4">
				<!--chat start-->
				<section class="panel">
					<header class="panel-heading">
						<b>   Het Gebruik van het admin panel </b>
					</header>
					<div class="panel-body">
						<div class="alert alert-block alert-danger">
							<button data-dismiss="alert" class="close close-sm" type="button">
								<i class="fa fa-times"></i>
							</button>
							<strong>Admin panel gebruiken</strong><br> De housekeeping is bedoeld om niet in te klooien maar om dingen te veranderen, te vernieuwen ga zo door, denk jij te gaan klooien in de housekeeping van <?= $config['hotelName'] ?>? 
							Krijg je unrank! 
						</div>
					</div>
				</section>
			</div>
		</div>
		<?php
			include_once "includes/footer.php";
			include_once "includes/script.php";
		?>		