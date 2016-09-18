<?php
	include_once "includes/head.php";
	include_once "includes/header.php";
	include_once "includes/navi.php";
	admin::CheckRank(5);
?>
<aside class="right-side">
	<section class="content">
		<div class="row">
			<?php
				if (User::userData('rank') > '5')
				{
				?>
				<div class="col-md-12">
					<section class="panel">
						<header class="panel-heading">
							Zoek een gebruiker voor <?= $config['hotelName'] ?> van de week
							<form action="" method="POST">
							</header>
							<div class="panel-body">
								<?php admin::searchUserOfTheWeek(); ?>
								<div class="form-group">
									<label class="col-sm-2 col-sm-2 control-label">Gebruikersnaam</label>
									<div class="col-sm-10">
										<input type="text"  value="" name="user" class="form-control">
									</div>
								</div>
								<br><br>
								<button style="width: 140px;
								float: right;
								margin-right: 14px;" name="zoek" type="submit" class="btn btn-success">Gebruiker zoeken</button>
							</div>
						</section>
					</div>
				</form>
				<?php
				}
?>
		</div>
		<?php
			include_once "includes/footer.php";
			include_once "includes/script.php";
		?>																							