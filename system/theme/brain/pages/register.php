<style>
	.error {
    text-align: center;
    font-size: 13px;
    background: #f44336;
    display: none;
    width: 100%;
    color: #fff;
    padding: 0 10px;
    border-radius: 2px;
    margin-bottom: 8px;
    line-height: 40px;
	}
</style>
<html lang="nl-NL">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title><?= $config['hotelName'] ?> | Maak vrienden, doe mee en val op!</title>
		<link href="https://bootswatch.com/paper/bootstrap.css" rel="stylesheet" type="text/css">
		<link href="/system/theme/brain/style/css/register.css?v=4" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300normal,300italic,400normal,400italic,600normal,600italic,700normal,700italic,800normal,800italic&amp;subset=all" rel="stylesheet" type="text/css">
		<script src='https://www.google.com/recaptcha/api.js'></script>
		<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
		<link href="/system/theme/brain/style/css/avatargenerate.css?v=11" rel="stylesheet" />
		<meta name="description" content="Virtuele wereld waar je vrienden kunt maken en ontmoeten.">
		<meta name="keywords" content="<?= $config['hotelName'] ?>, <?= $config['hotelName'] ?>hotel, <?= $config['hotelName'] ?> hotel, virtueel, wereld, sociaal netwerk, gratis, community, avatar, chat, online, tiener, roleplaying, doe mee, sociaal, groepen, forums, veilig, speel, games, on, vrienden, tieners, zeldzaams, zeldzame meubi, verzamelen, maak, verzamel, kom in contact, meubi, meubeks, huisdieren, kamer inrichten, delen, uitdrukking, badges, hangout, muziek, beroemdheid, VIP-visits, celebs, mmo, mmorpgs, massive multiplayer">
	</head>
	<body>
		<nav style="height: 56px;" class="navbar navbar-default">
			<div class="navbar-header"> <a href="/"></a>    
			</div>
			<div class="container"><div class="users-online" id="users-online"><span id="usersOnline"><?= Game::usersOnline() ?></span> <?= $config['hotelName'] ?>'s online.</div>
			</nav>
			<div class="container">
				<div class="logotipo" style="color: #158cba;width: 82px; height: 34px; font-size: 37px; font-family: 'Pacifico', cursive; top: -2px; position: absolute;"><a style="color: #158cba; text-decoration: none;" href="/"> <?= $config['hotelName'] ?> </a></div>
				<div style="clear:both;"></div>
				<div class="panel panel-success" style="width: 56%;float: left;padding: 8px;">
					<form method="post" class="form-horizontal">
						<fieldset>
							<input type="hidden" name="hiddenField_register" required="" value="<?= hiddenField(); ?>"></input>
							<legend>Registreren</legend>
							<?php User::Register(); ?>
							<div class="form-group">
								<label for="inputUsername" class="col-lg-4 control-label"><?= $config['hotelName'] ?>Naam</label>
								<div class="col-lg-8">
									<input type="text" class="form-control" name="username" id="username" placeholder="<?= $config['hotelName'] ?>Naam...">
									<i class="glyphicon glyphicon-user form-control-feedback" style="right: 10px;"></i>
								</div>
							</div>
							<div class="form-group">
								<label for="inputUsername" class="col-lg-4 control-label">Motto</label>
								<div class="col-lg-8">
									<input type="text" class="form-control" name="motto" id="motto" placeholder="<?= $config['startMotto'] ?>" value="<?= $config['startMotto'] ?>">
									<i class="glyphicon glyphicon-star form-control-feedback" style="right: 10px;"></i>
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail" class="col-lg-4 control-label">Email</label>
								<div class="col-lg-8">
									<input type="text" class="form-control" name="email" id="email" placeholder="Email...">
									<i class="glyphicon glyphicon-envelope form-control-feedback" style="right: 10px;"></i>
								</div>
							</div>
							<div class="form-group">
								<label for="inputPassword" class="col-lg-4 control-label">Wachtwoord</label>
								<div class="col-lg-8">
									<input type="password" class="form-control" name="password" id="password" placeholder="Wachtwoord...">
									<i class="glyphicon glyphicon-lock form-control-feedback" style="right: 10px;"></i>
								</div>
							</div>
							<div class="form-group">
								<label for="inputPassword2" class="col-lg-4 control-label">Wachtwoord (herhaal)</label>
								<div class="col-lg-8">
									<input type="password" class="form-control" name="password_repeat" id="password_repeat" placeholder="Wachtwoord (herhaal)...">
									<i class="glyphicon glyphicon-lock form-control-feedback" style="right: 10px;"></i>
								</div>
							</div>
							<div class="form-group">
								<div style="    width: 0%;" class="col-lg-8">
									<div id="avatarSelector" class="builder-viewport">
										<div class="main-navigation">
											<ul>
												<li class="active">
													<a href="#" data-navigate="hd" data-subnav="gender"><img src="/system/theme/brain/style/images/avatarreg/body.png" /></a>
												</li>
												<li>
													<a href="#" data-navigate="hr" data-subnav="hair"><img src="/system/theme/brain/style/images/avatarreg/hair.png" /></a>
												</li>
												<li>
													<a href="#" data-navigate="ch" data-subnav="tops"><img src="/system/theme/brain/style/images/avatarreg/tops.png" /></a>
												</li>
												<li>
													<a href="#" data-navigate="lg" data-subnav="bottoms"><img src="/system/theme/brain/style/images/avatarreg/bottoms.png" /></a>
												</li>
											</ul>
										</div>
										<div class="sub-navigation">
											<ul id="gender" class="display">
												<li>
													<a href="#" class="male nav-selected" data-gender="M"></a>
												</li>
												<li>
													<a href="#" class="female" data-gender="F"></a>
												</li>
											</ul>
											<ul id="hair" class="hidden">
												<li>
													<a href="#" class="hair nav-selected" data-navigate="hr"></a>
												</li>
												<li>
													<a href="#" class="hats" data-navigate="ha"></a>
												</li>
												<li>
													<a href="#" class="hair-accessories" data-navigate="he"></a>
												</li>
												<li>
													<a href="#" class="glasses" data-navigate="ea"></a>
												</li>
												<li>
													<a href="#" class="moustaches" data-navigate="fa"></a>
												</li>
											</ul>
											<ul id="tops" class="hidden">
												<li>
													<a href="#" class="tops nav-selected" data-navigate="ch"></a>
												</li>
												<li>
													<a href="#" class="chest" data-navigate="cp"></a>
												</li>
												<li>
													<a href="#" class="jackets" data-navigate="cc"></a>
												</li>
												<li>
													<a href="#" class="accessories" data-navigate="ca"></a>
												</li>
											</ul>
											<ul id="bottoms" class="hidden">
												<li>
													<a href="#" class="bottoms nav-selected" data-navigate="lg"></a>
												</li>
												<li>
													<a href="#" class="shoes" data-navigate="sh"></a>
												</li>
												<li>
													<a href="#" class="belts" data-navigate="wa"></a>
												</li>
											</ul>
										</div>
										<div id="clothes-colors">
											<div id="clothes"></div>
											<div id="colors"></div>
										</div>
										<div id="avatar">
											<img id="myHabbo" value="" src="" alt="My Habbo" title="My Habbo" />
											<input type="hidden" name="habbo-avatar" id="avatar-code">
										</div>
									</div>
								</div>
							</div>
							<?php
								if($config['recaptchaSiteKeyEnable'] == true)
								{
								?>
								<div class="form-group">
									<label for="inputcaptcha" class="col-lg-4 control-label"><?= $lang["protect"] ?></label>
									<div class="col-lg-8">
										<div class="g-recaptcha" data-sitekey="<?= $config['recaptchaSiteKey'] ?>"></div>
									</div>
								</div>
								<?php
								}
							?>
							<div class="form-group" style="text-align: center;">
								<div class="col-lg-8 col-lg-offset-2">
								</div>
								</div
							<div class="form-group" style="text-align: right;">
							<div class="col-lg-8 col-lg-offset-4">
								<a href="/index" class="btn btn-default">Terug</a>
								<button href="/me"   type="submit" name="register"class="btn btn-primary">Registreren</button>
							</div>
						</div>
					</fieldset>
				</form>
				<div style="float: right; width: 42%;" class="list-group">
					<a class="list-group-item">
						<div class="subimage1"></div>
						<h4 class="list-group-item-heading">Wat is <?= $config['hotelName'] ?> hotel?</h4>
						<p class="list-group-item-text"><?= $config['hotelName'] ?> is een gratis virtuele wereld waar je kunt chatten, lopen, vrienden kunt maken en ontmoeten. Ook is het mogelijk om je eigen virtuele kamer te creeëren die je vervolgens naar eigen keus kunt inrichten.</p>
					</a>
					<a  class="list-group-item">
						<div class="subimage2"></div>
						<h4 class="list-group-item-heading">Wat kan je doen in <?= $config['hotelName'] ?>?</h4>
						<p class="list-group-item-text">In <?= $config['hotelName'] ?> kan je nieuwe vrienden maken. een praatje met andere <?= $config['hotelName'] ?>'s maken, een potje voetballen of gezellig meehelpen aan het bouwen van een mooie kamer. Het kan allemaal in <?= $config['hotelName'] ?>!</p>
					</a>
					<a  class="list-group-item">
						<div class="subimage3"></div>
						<h4 class="list-group-item-heading">Meer dan alleen spelen...</h4>
						<p class="list-group-item-text">Het stylen van je avatar naar de laatste modetrends is niet de enige manier waarop je plezier kunt hebben op <?= $config['hotelName'] ?>. Wil je de architect van de eeuw zijn en duizelingwekkende gebouwen ontwerpen? Dan is de Builders Club echt iets voor jou! Wil je laten zien hoe goed je bent in het maken van games en al je vrienden imponeren? Doe dan mee met onze competities! Ben je gek op selfies en grappige foto's? Onze camera-feature staat garant voor onbeperkt plezier!</p>
					</a>
					<a  class="list-group-item">
						<div class="subimage4"></div>
						<h4 class="list-group-item-heading">Speel gratis, voor altijd.</h4>
						<p class="list-group-item-text"><?= $config['hotelName'] ?> is een gratis game, dus je kunt een enorme wereld vol kamers ontdekken, quests voltooien, chatten en prijzen winnen zonder dat je er ooit voor hoeft te betalen!<br>Sommige extra's in het spel zoals huisdieren, <?= $config['hotelName'] ?> Club-lidmaatschap, Builders Club-lidmaatschap en meubilair kunnen worden aangeschaft met <?= $config['hotelName'] ?> Credits. Voor meer informatie over deze in-game extra's kun je vinden in de <?= $config['hotelName'] ?> winkel.</p>
					</a>
				</div>
				<div style="clear:both;"></div><footer class="footer" style="font-size: 13.5px; font-weight: 100;">
					<center>
						Copyright <span class="glyphicon glyphicon-copyright-mark" aria-hidden="true" style="/* float: right; *//* top: 4px; */"></span> 2016 <?= $config['hotelName'] ?> Hotel. Alle rechten voorbehouden./footer>
					</div>
				</body>
			</html>
			<script src="http://code.jquery.com/jquery-latest.min.js?v=4" type="text/javascript"></script>
		<script src="/system/theme/brain/style/js/jquery.avatargenerate.js?v=13" type="text/javascript"></script>		