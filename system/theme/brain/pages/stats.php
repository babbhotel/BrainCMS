<?php
	include_once 'includes/header.php';
?>
<title><?= $config['hotelName'] ?>: Statistieken</title>
<div class="center">
	<div style="width: 100%;"class="columleft">
		<div class="box">
			<div class="title blue">
				Wie heeft de meeste Diamanten?
			</div>
			<div class="mainBox" style="float;left">
				<?php $belcr_get= DB::Query("SELECT * from users WHERE rank < 5 ORDER BY `vip_points` DESC  LIMIT 6");
					while($belcr_row = mysqli_fetch_assoc($belcr_get)){
					?>
					<div style="pointer;float: left;padding-top: 20px;border-radius: 5px;border: 1px solid rgba(0, 0, 0, 0.2);border-bottom: 2px solid rgba(0, 0, 0, 0.2);width: 300px;margin-bottom: 10px;margin-left: 5px;margin-right: 5px;">
						<div id="column" style="border: 2px dotted rgba(0, 0, 0, 0.2);margin-top: -10px;margin-left: 10px;margin-right: 10px;margin-bottom: 10px;float: left;height:55px;width: 55px;border-radius: 555px;-moz-border-radius: 555px;-webkit-border-radius: 555px;background:url(/system/habbo-imaging/avatar.php?username=<?= $belcr_row['username'] ?>&head_direction=3&amp;action=wav) no-repeat;background-position: 50% 10%;"></div>
						<b  style="font-size: 16px;"><?= $belcr_row['username'] ?> </b>
						<a href="/home/<?= $belcr_row['username'] ?>" class="tooltip"> <img src="/system/theme/brain/style/images/icons/diamondje.png" align="right">
						</a>
						<br> <b style="font-size: 12px;"><?= $belcr_row['vip_points'] ?></b> Diamanten.
					</div>
					<?php
					}
					echo "</div>";
				?>
			</div>
			<div class="box">
				<div class="title purple">
					Wie heeft de meeste Duckets?
				</div>
				<div class="mainBox" style="float;left">
					<?php $belcr_get= DB::Query("SELECT * from users WHERE rank < 5 ORDER BY `activity_points` DESC  LIMIT 6");
						while($belcr_row = mysqli_fetch_assoc($belcr_get)){
						?>
						<div style="pointer;float: left;padding-top: 20px;border-radius: 5px;border: 1px solid rgba(0, 0, 0, 0.2);border-bottom: 2px solid rgba(0, 0, 0, 0.2);width: 300px;margin-bottom: 10px;margin-left: 5px;margin-right: 5px;">
							<div id="column" style="border: 2px dotted rgba(0, 0, 0, 0.2);margin-top: -10px;margin-left: 10px;margin-right: 10px;margin-bottom: 10px;float: left;height:55px;width: 55px;border-radius: 555px;-moz-border-radius: 555px;-webkit-border-radius: 555px;background:url(/system/habbo-imaging/avatar.php?username=<?= $belcr_row['username'] ?>&head_direction=3&amp;action=wav) no-repeat;background-position: 50% 10%;"></div>
							<b  style="font-size: 16px;"><?= $belcr_row['username'] ?> </b>
							<a href="/home/<?= $belcr_row['username'] ?>" class="tooltip"> <img src="/system/theme/brain/style/images/icons/ducket.png?v=1" align="right">
							</a>
							<br> <b style="font-size: 12px;"><?= $belcr_row['activity_points'] ?></b> Duckets.
						</div>
						<?php
						}
						echo "</div>";
					?>
				</div>
				<div class="box">
					<div class="title yellow">
						Wie heeft de meeste Credits?
					</div>
					<div class="mainBox" style="float;left">
						<?php $belcr_get= DB::Query("SELECT * from users WHERE rank < 5 ORDER BY `credits` DESC  LIMIT 6");
							while($belcr_row = mysqli_fetch_assoc($belcr_get)){
							?>
							<div style="pointer;float: left;padding-top: 20px;border-radius: 5px;border: 1px solid rgba(0, 0, 0, 0.2);border-bottom: 2px solid rgba(0, 0, 0, 0.2);width: 300px;margin-bottom: 10px;margin-left: 5px;margin-right: 5px;">
								<div id="column" style="border: 2px dotted rgba(0, 0, 0, 0.2);margin-top: -10px;margin-left: 10px;margin-right: 10px;margin-bottom: 10px;float: left;height:55px;width: 55px;border-radius: 555px;-moz-border-radius: 555px;-webkit-border-radius: 555px;background:url(/system/habbo-imaging/avatar.php?username=<?= $belcr_row['username'] ?>&head_direction=3&amp;action=wav) no-repeat;background-position: 50% 10%;"></div>
								<b  style="font-size: 16px;"><?= $belcr_row['username'] ?> </b>
								<a href="/home/<?= $belcr_row['username'] ?>" class="tooltip"> <img src="/system/theme/brain/style/images/icons/credit.gif" align="right">
								</a>
								<br> <b style="font-size: 12px;"><?= $belcr_row['credits'] ?></b> Credits.
							</div>
							<?php
							}
							echo "</div>";
						?>
					</div>
					<?php
						include_once 'includes/footer.php';
					?>
				</div>
			</div>
		</body>
	</html>				