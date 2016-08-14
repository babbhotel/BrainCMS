<?php
	include_once "includes/head.php";
	include_once "includes/header.php";
	include_once "includes/navi.php";
		admin::CheckRank(3);
?>
<aside class="right-side">
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<section class="panel">
					<header class="panel-heading">
						Prive Chatlogs<br>
						<form name="mygallery" action="" method="POST">
						</header>
						<div class="panel-body">
					
							<table class="table table-striped table-bordered table-condensed">
							<b>	<strong><tr><td><b>ID</b></td><td><b>Van Gebruiker</b></td><td><b>Naar Gebruiker</b></td><td><b>Bericht</b></td><td><b>Datum</b></td></tr></strong></b
								<tbody>
									<?php
										$sql = DB::Query("SELECT * FROM chatlogs_console ORDER BY id DESC  LIMIT 1000");
										
										while($news = $sql->fetch_assoc())
										{
									echo'';
											echo'<tr>
											<td>'.$news["id"].'</td>
											<td style="width: 13%;">'.$news["from_id"].'</td>
											<td style="width: 7%;">'.$news["to_id"].'</td>
											<td style="width: 25%;">'.$news["message"].'</td>
											<td>'. gmdate('d-m-Y, H:i ', $news['timestamp']).'</td>
										
											';
										}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<script>
					// Replace the <textarea id="editor1"> with a CKEditor
					// instance, using default configuration.
					CKEDITOR.replace( 'editor1' );
				</script>
				<?php
					include_once "includes/footer.php";
					include_once "includes/script.php";
				?>				