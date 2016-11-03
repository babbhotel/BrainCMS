<html lang="en">
	<head>
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin">
		<link rel="stylesheet" href="/system/theme/brain/style/css/main2.css?v=5" type="text/css">
		<link rel="stylesheet" href="/system/theme/brain/style/css/home.css" type="text/css">
	</head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-latest.js"></script>
	<script type="text/javascript">
        $(document).ready(function(e) {
            $.ajaxSetup({
                cache:true
			});
            setInterval(function() {
                $('#onlinecounter').load('/onlinecount');
			}, 1500);
            $( "#onlinecounter").click(function() {
				$('#onlinecounter').load('/onlinecount');
			});
		});
	</script>
	<script type="text/javascript">
        $(document).ready(function(e) {
            $.ajaxSetup({
                cache:true
			});
            setInterval(function() {
                $('#roomcount').load('/roomcount');
			}, 5500);
            $( "#roomcount").click(function() {
				$('#roomcount').load('/roomcount');
			});
		});
	</script>
	<body>
		<header id="mainheader">
			<div class="center">
				<a href="#">
					<div class="head_enter"><a href="/game" onclick="window.open('/game','new','toolbar=0,scrollbars=0,location=1,statusbar=1,menubar=0,resizable=1,width=1270,height=700');return false;" class="btn btn-success">Naar <?= $config['hotelName'] ?> </a> <a onclick="<?= $config['hotelUrl'] ?>/logout" href="<?= $config['hotelUrl'] ?>/logout" class="btn btn-danger">Log uit</a></div> <div class="wrap">
						<div class="logo">
						</div>
					</a>
					<div id="onlinecounter"><small><b><?= Game::usersOnline() ?></b> <?= $config['hotelName'] ?>'s online.</small></div>
					<?php
						if (User::userData('rank') > '3')
						{
							echo'	
							<div class="langbox"><a href="/adminpan/index.php"><img src="/system/theme/brain/style/images/menuicons/settings_icon.png" style="padding:7px;float:right;"> </div>
							';
						}
					?>
				</div>
			</header>
			<nav>
				<div id="navigator">
					<div class="center">
						<ul>
							<li class="blauw">
								<a href="/"><?= User::userData('username') ?></a>
								<div class="submenu">
									<a href="/me"><?= User::userData('username') ?></a>
									<a href="/settingspassword">Account Instellingen</a> 
									<a href="/home/<?= User::userData('username') ?>">Mijn profiel</a>
									<a href="/logout">Uitloggen</a>
								</div>
							</li>
							<li class="rood">
								<a href="/community">Gemeenschap</a>
								<div class="submenu">
									<a href="/community">Gemeenschap</a>
									<a href="/sollicitaties">Solliciteren</a>
									<a href="<?php
										$sql = DB::Query("SELECT * FROM cms_news ORDER BY ID DESC LIMIT 1");
										{
											while($row = $sql->fetch_assoc())
											{
												echo "/news/".$row['id']."";
											}
										}
									?>">Nieuwsberichten </a>
									<a href="/advertentie_tips">Advertentie Tips</a>
									<a href="/stats">Statistieken</a>
									<a href="/online">Online <?= $config['hotelName'] ?>'s</a>
								</div>
							</li>
							<li class="paars">
								<a href="/staff"><?= $config['hotelName'] ?> Staff</a>
								<div class="submenu">
									<a href="/staff"><?= $config['hotelName'] ?> Staff</a>
									<a href="/teams"><?= $config['hotelName'] ?> Teams</a>
								</div>
							</li>
							<a href="<?= $config['hotelUrl'] ?>/logout"><li class="logout">Log uit</li></a>
						</ul>
					</div>
				</nav>						