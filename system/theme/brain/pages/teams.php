<?php
	include_once 'includes/header.php';
?>
<title><?= $config['hotelName'] ?>: Staffteam</title>
<div class="center">
	<div style="width: 600px;"class="columleft">
		<style>.staff-offline{text-indent:-9999px;width:0px;position:absolute;margin-top:6px;margin-left:7px;height:0px;border:5px solid #F37373;box-shadow:0px 0px 0px 1px rgba(0,0,0,0.2);border-radius:50%;}.staff-online{text-indent:-9999px;width:0px;position:absolute;margin-top:6px;margin-left:7px;height:0px;border:5px solid #73F375;box-shadow:0px 0px 0px 1px rgba(0,0,0,0.2);border-radius:50%;}</style>
		<?php
			$getRanks = DB::Query("SELECT id,name,badgeid FROM teams ORDER BY id DESC");
			while ($Ranks = mysqli_fetch_assoc($getRanks))
			{	
				echo '
				<div class="box">
				<div class="title">' . $Ranks['name'] . '</div>
				<div class="mainBox" style="float;left">
				<div class="boxHeader"></div>
				';
				$getMembers = DB::Query("SELECT id,username,motto,look,online FROM users WHERE teamrank = '" . DB::Escape($Ranks['id']) . "'");
				echo '';
				if (mysqli_num_rows($getMembers) > 0)
				{
					while ($member = mysqli_fetch_assoc($getMembers))
					{
						$username = DB::Escape($member['username']);
						$motto = DB::Escape($member['motto']);
						$look = DB::Escape($member['look']);
						$online = DB::Escape($member['online']);
						if($online == 1){ $OnlineStatus = "online"; } else { $OnlineStatus = "offline"; }
						echo '
						<a href="/home/'.$username.'"><div style="pointer;float: left;padding-top: 20px;border-radius: 5px;border: 1px solid rgba(0, 0, 0, 0.2);border-bottom: 2px solid rgba(0, 0, 0, 0.2);width: 275px;margin-bottom: 0px;margin-left: 5px;margin-right: 5px;">
						<div id="column" style="border: 2px dotted rgba(0, 0, 0, 0.2);margin-top: -10px;margin-left: 10px;margin-right: 10px;margin-bottom: 10px;float: left;height:55px;width: 55px;border-radius: 555px;-moz-border-radius: 555px;-webkit-border-radius: 555px;background:url(/system/habbo-imaging/avatar.php?username='.$username.'&head_direction=3&amp;action=wav) no-repeat;background-position: 50% 10%;"></div>
						<b  style="font-size: 16px;">' .$username . ' </b> <span class="staff-'.$OnlineStatus.'">0</span> 
						<img src="/system/theme/brain/style/images/badges/'.$Ranks['badgeid'].'.gif" style="margin-right:5px;" align="right"> 
						</a>
						<br>  <img src="/system/theme/brain/style/images/icons/motto.png"> <i style="font-size: 12px;">' .$motto . '</i>
						<BR>
						</div>
						';
					}
				}
				else
				{
					echo 'Nog niemand heeft deze team rank.';
				}
				echo '
				</div>
				</div>';
			}
		?>
	</div>
	<div style="width: 370px;" class="columright">
		<div class="box">
			<div class="black title">
				<?= $config['hotelName'] ?> Teams
			</div>
			<div class="mainBox" style="float;left">
				<div class="boxHeader"></div>
		Dit zijn wat mensen die zich vrijwillig  inzetten om <?= $config['hotelName'] ?> te verbeteren. De spammers zorgen ervoor dat het steeds drukker wordt op <?= $config['hotelName'] ?>, de bouwers zorgen voor nieuwe kamers en de event Managers zorgen ervoor dat het nooit saai wordt in en rondom <?= $config['hotelName'] ?>!</div>
</div>
</div>
<?php
	include_once 'includes/footer.php';
?>
</body>
</html>		