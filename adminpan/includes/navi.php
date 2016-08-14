<!DOCTYPE html>
<body style="margin-top: -20px;" class="skin-black">
	<div class="wrapper row-offcanvas row-offcanvas-left">
		<aside class="left-side sidebar-offcanvas">
			<section class="sidebar">
				<ul class="sidebar-menu">
					<?php
						if (User::userData('rank') > '3')
						{
							echo'<li>
							<a href="index.php">
							<i class="fa fa-dashboard"></i> <span>Voorpagina</span>
							</a>
							</li>';
						}

						if (User::userData('rank') > '5')
						{
							echo'	
							<li>
							<a href="news.php">
							<i class="fa fa-newspaper-o"></i> <span>Nieuwsberichten</span>
							</a>
							</li>
							';
						}
						if (User::userData('rank') > '7')
						{
							echo'	
							<li>
							<a href="sollie.php">
							<i class="fa fa-newspaper-o"></i> <span>Sollicitaties</span>
							</a>
							</li>
							';
						}

						if (User::userData('rank') > '4')
						{
							echo'	
							<li>
							<a href="zoekgebruiker.php">
							<i class="fa fa-user"></i> <span>Gebruikers</span>
							</a>
							</li>
							';
						}

						if (User::userData('rank') > '3')
						{
							echo'
							<li>
							<a href="rooms.php">
							<i class="fa fa-home "></i> <span>Kamers in Horba</span>
							</a>
							</li>
								<li>
							<a href="wordfilter.php">
							<i class="fa fa-filter"></i> <span>Woord Filter</span>
							</a>
							</li>
							<li>
							<a href="chatlogs.php">
							<i class="fa fa-folder-o"></i> <span>Kamer Chatlogs</span>
							</a>
							</li>
							<li>
							<a href="chatlogs_console.php">
							<i class="fa fa-desktop"></i> <span>Prive Chatlogs</span>
							</a>
							</li>
							<li>
							<a href="bans.php">
							<i class="fa fa-users"></i> <span>Banlijst</span>
							</a>
							</li>';
						}
					?>
				
				</ul>
			</section>
		</aside>							