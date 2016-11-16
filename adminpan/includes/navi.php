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
							<a href="'.$config['hotelUrl'].'/adminpan/dash">
							<i class="fa fa-dashboard"></i> <span>Voorpagina</span>
							</a>
							</li>';
						}

						if (User::userData('rank') > '5')
						{
							echo'	
							<li>
							<a href="'.$config['hotelUrl'].'/adminpan/news">
							<i class="fa fa-newspaper-o"></i> <span>Nieuwsberichten</span>
							</a>
							</li>
							';
						}
						if (User::userData('rank') > '7')
						{
							echo'	
							<li>
							<a href="'.$config['hotelUrl'].'/adminpan/sollie">
							<i class="fa fa-newspaper-o"></i> <span>Sollicitaties</span>
							</a>
							</li>
							';
						}

						if (User::userData('rank') > '7')
						{
							echo'	
							<li>
							<a href="'.$config['hotelUrl'].'/adminpan/zoekgebruiker">
							<i class="fa fa-user"></i> <span>Gebruikers</span>
							</a>
							</li>
							';
						}

						if (User::userData('rank') > '3')
						{
							echo'
							<li>
							<a href="'.$config['hotelUrl'].'/adminpan/rooms">
							<i class="fa fa-home "></i> <span>Kamers in Horba</span>
							</a>
							</li>
								<li>
							<a href="'.$config['hotelUrl'].'/adminpan/wordfilter">
							<i class="fa fa-filter"></i> <span>Woord Filter</span>
							</a>
							</li>
							<li>
							<a href="'.$config['hotelUrl'].'/adminpan/chatlogs">
							<i class="fa fa-folder-o"></i> <span>Kamer Chatlogs</span>
							</a>
							</li>
							<li>
							<a href="'.$config['hotelUrl'].'/adminpan/chatlogs_console">
							<i class="fa fa-desktop"></i> <span>Prive Chatlogs</span>
							</a>
							</li>
							<li>
							<a href="'.$config['hotelUrl'].'/adminpan/bans">
							<i class="fa fa-users"></i> <span>Banlijst</span>
							</a>
							</li>
							<li>
							<a href="'.$config['hotelUrl'].'/adminpan/userofteweek">
							<i class="fa fa-user"></i> <span>'.$config['hotelName'].' van de week</span>
							</a>
							</li>';
						}
					?>
				
				</ul>
			</section>
		</aside>							