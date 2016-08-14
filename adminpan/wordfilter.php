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
						Woord Filter<br>
						<form name="mygallery" action="" method="POST">
						</header>
						<div class="panel-body">
							<?php admin::DeleteWordFilter(); ?>
							<table class="table table-striped table-bordered table-condensed">
							<b>	<strong><tr><td><b>Woord</b></td><td><b>Naar</b></td></strong></b>
								<tbody>
									<?php
										$sql = DB::Query("SELECT * FROM wordfilter ORDER BY word DESC");
										
										while($news = $sql->fetch_assoc())
										{
									echo'';
											echo'<tr>
											<td style="width: 13%;">'.$news["word"].'</td>
											<td style="width: 7%;">'.$news["replacement"].'</td>
										';
										if (User::userData('rank') > '6')
						{
							echo'	
								
							';
						}
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