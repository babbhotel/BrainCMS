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
							Zoek een gebruiker
							<form action="" method="POST">
							</header>
							<div class="panel-body">
								<?php admin::searchUser(); ?>
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
				else{
				?>
				<input type="hidden"  value="<?php echo admin::EditUser("zoek"); ?>" name="zoek" class="form-control" disabled>
				<?php
				}
			?>
			
			<div class="col-md-12">
				<section class="panel">
					<header class="panel-heading">
						<b>Gebruikerlijst van alle gebruikers die gerigistreerd zijn.</b><br>
						<form name="mygallery" action="" method="POST">
						</header>
						<div class="panel-body">
							<?php admin::DeleteBans(); ?>
							<table class="table table-striped table-bordered table-condensed">
								<tbody>
									<strong><tr style="width: 5%;"><td><b>ID</b></td><td><b>Naam</b></td><td><b>Email</b></td><td><b>Motto</b></td><?php 	if (User::userData('rank') > '6')
										{
											echo'<td style="width: 5%;"><b>Bewerken</b></td></tr></strong>
											</tr>';
										}
									?>
									
									
									<?php
										
										$sql = DB::Query("SELECT * FROM users ORDER BY id DESC");
										while($news = $sql->fetch_assoc())
										{
											echo'';
											echo'<tr>
											<td>'.$news["id"].'</td>
											<td style="width: 13%;">'.$news["username"].'</td>
											<td style="width: 25%;">'.$news["mail"].'</td>
											<td>'.htmlentities($news["motto"]).'</td>
											';
											if (User::userData('rank') > '5')
											{
												echo'<td><a href=gebruiker.php?user='.$news["username"].'><i style="padding-top: 4px; color:green;" class="fa fa-edit"></i></center></a></td>
												</tr>';
											}
										}
									?>
									</tbody>
									</table>
								</div>
							</div>
						</div>
						<?php
							include_once "includes/footer.php";
							include_once "includes/script.php";
						?>																					