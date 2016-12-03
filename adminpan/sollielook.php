<?php
	include_once "includes/head.php";
	include_once "includes/header.php";
	include_once "includes/navi.php";
	
	
	
	admin::CheckRank(7);
	
?>
<script src="js/ckeditor/ckeditor.js"></script>
<aside class="right-side">
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<section class="panel">
					<header class="panel-heading">
						
						Sollicitaties van <b><?php echo admin::LookSollie("username"); ?></b>.
					</header>
					<div class="panel-body">
						<?php admin::DeleteSollie(); ?>
						<div class="col-md-6">
							
							
							Gebruikersnaam:<br><b><?php echo admin::LookSollie("username"); ?></b> <br><br>
							Echte naam:<br><b><?php echo admin::LookSollie("realname"); ?></b> <br><br>
							Leeftijd:<br><b><?php echo admin::LookSollie("age"); ?></b> <br><br>
							Skype Naam:<br><b><?php echo admin::LookSollie("skype"); ?></b> <br><br>
							Functie gevraagd:<br><b><?php echo admin::LookSollie("functie"); ?></b> <br><br>
							Aantal uren online per week:<br><b><?php echo admin::LookSollie("onlinetime"); ?></b> <br><br>
							Ervaring op andere hotels:<br><b><?php echo admin::LookSollie("experience"); ?></b> <br><br>
							
							
						</div>
						
						<div class="col-md-6">
							
							
							Wat weet hij/zij al:<br><b><?php echo admin::LookSollie("knowing"); ?></b> <br><br>
							Als 2 mensen ruzie hebben:<br><b><?php echo admin::LookSollie("quarrel"); ?></b> <br><br>
							Vertrouwen en serieus:<br><b><?php echo admin::LookSollie("serious"); ?></b> <br><br>
							Verbeteringen voor het hotel:<br><b><?php echo admin::LookSollie("improve"); ?></b> <br><br>
							Datum sollicitatie gemaakt:<br><b><?php echo date('d-m-Y H:i', admin::LookSollie("date")) ?></b> <br><br>
							Ip van de gebruiker:<br><b><?php echo admin::LookSollie("ip"); ?></b> <br><br>
							<?php
								if (User::userData('rank') > '8')
								{
								?>
								
									<a href = "<?php echo''.$config['hotelUrl'].'/adminpan/sollielook/delete/'.admin::LookSollie("id").'' ?>"><button style="width: 200px;
									float: left;
									margin-right: 14px;" value="<?php echo admin::LookSollie("id"); ?>" name="DeleteSollieNow" type="submit" class="btn btn-danger">Verwijder sollicitatie</button>
								</a></div>
								<?php
								}
								else{
								?>
								
								<?php
								}
						?>
					</div>
				</div>
				
			</div>
			<?php
				include_once "includes/footer.php";
				include_once "includes/script.php";
			?>									
			<style>
				
				.imagebox {
				width: auto;
				background-repeat: repeat-y;
				border-radius: 6px;
				float: left;
				margin-right: 0.72pc;
				margin-bottom: 10px;
				webkit-box-shadow: 0 3px rgba(0,0,0,.17),inset 0px 0px 0px 1px rgba(0,0,0,0.31),inset 0 0 0 2px rgba(255,255,255,0.44)!important;
				-moz-box-shadow: 0 3px rgba(0,0,0,.17),inset 0px 0px 0px 1px rgba(0,0,0,0.31),inset 0 0 0 2px rgba(255,255,255,0.44)!important;
				box-shadow: 0 3px rgba(0,0,0,.17),inset 0px 0px 0px 1px rgba(0,0,0,0.31),inset 0 0 0 2px rgba(255,255,255,0.44)!important;
				}
				
			</style>
			<script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
			</script>			