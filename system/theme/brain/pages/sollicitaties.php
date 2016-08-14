<?php
	include_once 'includes/header.php';
?>
<title><?= $config['hotelName'] ?>: Solliciteren</title>
<div class="center">
	<div class="columleft">
		<div class="box">
			<div class="title">
				Solliciteren
			</div>
			<div class="mainBox" style="float;left">
				<div class="boxHeader"></div>
				<form action="" method="POST">
					<?php Website::staffApplication(); ?>
					<center><h3><font color="blue"></center></h3></font><img src="/system/theme/brain/style/images/icons/solli_succes.gif" align="right"> 
					<h1>Solliciteren</h1>
					<hr><h2>Over jezelf</h2>
					<p><label><b><?= $config['hotelName'] ?> naam:</b><br>
					<input type="text" name="username" size="400" placeholder="Naam" value= "<?= User::userData('username') ?>" id="username" style="width: 100%;" disabled></p>
					<p><label><b>Echte naam:</b><br>
					<input type="text" name="realname" size="400" placeholder="Echte naam" value= "" id="username" style="width: 100%;"></p>
					<p><label><b>Skype:</b><br>
					<input type="text" name="skype" size="400" placeholder="Skype" value= "" id="username" style="width: 100%;"></p>
					<p><label><b>Leeftijd:</b><br>
					<input type="number" name="age" size="400" placeholder="Leeftijd" value= "" id="username" style="width: 100%;"></p>
					<hr><h2>Solliciteren</h2>
					</p><label><b>Functie:</b>
					<select style="width: 100%;" name="functie" class="form-control">
		                <option name="functie" value="1">Junior Moderator</option> 					
						<option name="functie" value="2">Eventteam</option> 
						<option name="functie" value="3">Spamteam</option> 
						<option name="functie" value="4">Bouwteam</option> 
						<option name="functie" value="5">Proef DJ</option>
						<option name="functie" value="6">Pixelaar</option>
					</select>	</p>
					<p><label><b>Hoeveel uur perweek online?</b><br>
					<input type="number" name="onlinetime" size="400" placeholder="10" id="amount" style="width: 100%;"></p>
					<p><label><b>Ervaring bij een ander hotel en welke rank zo ja welke? (Bijv. <?= $config['hotelName'] ?> Moderator)</b><br>
					<textarea name="knowing" size="400" rows="5" cols="50" style="width: 100%;"> </textarea></p>
					<p><label><b>Wat doe je als er 2 mensen ruzie hebben?</b><br>
					<textarea name="quarrel" size="400" rows="5" cols="50" style="width: 100%;"> </textarea></p>
					<p><label><b>Ben je te vertrouwen, en neem je het ook serieus?</b><br>
					<textarea name="serious" size="400" rows="5" cols="50" style="width: 100%;"> </textarea></p>
					<p><label><b>Kan jij het hotel verbeteren door nieuwe leden te spammen? <small>(extra vraag)</small></b><br>
					<textarea name="improve" size="400" rows="5" cols="50" style="width: 100%;"> </textarea></p>
					</p><label><b>Heb jij eventueel een microfoon zodat je kan bellen met het team via Skype?</b><br>
					<select style="width: 100%;" name="microphone" class="form-control">
						<option name="microphone" value="1">Ja</option>
						<option name="microphone" value="2">Nee</option>
					</select></p>
					<input type="submit" value="Verstuur" name="addsollie" class="submit" style="float:right" >
					</form>
					</div>
					</div></div>
					<div class="columright">
						<div class="box">
							<div class="title green">
								Solliciteren
							</div>
							<b>Beste lezer,
							</b>
							<br>
							hierbij geef ik informatie over de vacatures die momenteel beschikbaar zijn.
							<br>Solliciteren doe je niet zomaar. Je moet er inzet en doorzettingsvermogen voor hebben, natuurlijk komen er ook andere dingen bij kijken.
							Onderaan vind je een lijst met open vacatures.
							<br>
							<br>
							<hr>
							<br>
							<h4>
								<b>Eisen:</b>
								<br>
							</h4>
							<b>- Minimaal 12 jaar.
								<br> - Stressbestendig.
								<br> - Minimaal 2 tot 4 uur per dag online zijn.
								<br> - Horba Hotel meer dan 1 week gespeeld te hebben.
								<br> - Banloos zijn.
								<br> - Goed met andere mensen en het team omgaan.
								<br> - Positieve uitstraling, negatief accepteren we niet.
								<br> - AN kunnen typen.
							<br> - Ervaring hebben met de MOD-Tools en alle andere functie's.</b>
						</div>
					</div>
					<?php
						include_once 'includes/footer.php';
					?>
					</div>
					</div>
					</body>
				</html>											