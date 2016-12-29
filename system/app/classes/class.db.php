<?php
	if(!defined('BRAIN_CMS')) 
	{ 
		die('Sorry but you cannot access this file!'); 
	}
	try {
		$dbh = new PDO('mysql:host='.$db['host'].':'.$db['port'].';dbname='.$db['db'].'', $db['user'], $db['pass']);
	}
	catch (PDOException $e) {
		echo ("<div style='background-repeat: no-repeat;
		background-position: 10px 50%;
		padding: 10px 10px 10px 10px;
		-moz-border-radius: 5px;
		border-radius: 5px;
		-moz-box-shadow: 0 1px 1px #fff inset;
		box-shadow: 0 1px 1px #fff inset;
		border: 1px solid maroon !important;
		color: #000;
		background: pink;
		display: table;
		margin: 0 auto;
		font-size: 15px;
		font-family: Tahoma;'><b>BrainCMS Configuration Error:</b><br>I was unable to connect to the provided MySQL server. Please ask the administrator to review the error message log for details.</div>"); 
		die();
	}
	class database
	{
		public static function existTable($dbtabel) 
		{
			global $config, $dbh, $db;
			$checkTable = $dbh->prepare("SHOW TABLES LIKE :table_name");
			$checkTable->bindParam(":table_name", $dbtabel);
			$sqlResult = $checkTable->execute();
			$dbtabelUser = 'users';
			$checkTableUser = $dbh->prepare("SHOW TABLES LIKE :table_name");
			$checkTableUser->bindParam(":table_name", $dbtabelUser);
			$sqlResultUser = $checkTableUser->execute();
			if ($sqlResult) 
			{
				if ($sqlResultUser) 
				{
					$row = $checkTableUser->fetch();
					if ($row[0]) 
					{
						$row = $checkTable->fetch();
						if ($row[0]) 
						{
							true;
						} 
						else 
						{
							self::importSQL($dbtabel.'.sql');
						}
					} 
					else 
					{
						if(isset($_POST['uploadplusdb'])) {
							echo'lol';
							database::importSQL('plusDB.sql');
							header('Location: '.$config['hotelUrl'].'/index');
						}
						echo'<div style="background-repeat: no-repeat;
						background-position: 10px 50%;
						padding: 10px 10px 10px 10px;
						-moz-border-radius: 5px;
						border-radius: 5px;
						-moz-box-shadow: 0 1px 1px #fff inset;
						box-shadow: 0 1px 1px #fff inset;
						border: 1px solid maroon !important;
						color: #000;
						background: pink;
						display: table;
						margin: 0 auto;
						font-size: 15px;
						font-family: Tahoma;">Your database <b>'.$db['db'].'</b> is empty!<hr>Click on the button "Upload PlusDB" to upload the plus database to your mysql server
						<form action="" method="POST">
						<button style="width: 140px;
						float: right;
						margin-right: 14px;" name="uploadplusdb" type="submit" class="btn btn-success">Upload PlusDB</button>
						</form>
						</div>'; 
						exit;
					}
				}
			}
		}
		public static function importSQL($sqlfile)
		{    
			global $dbh;
			$file = file($_SERVER['DOCUMENT_ROOT'].'/system/app/systemsql/'.$sqlfile);
			$file = array_filter($file,
			create_function('$line',
			'return strpos(ltrim($line), "--") !== 0;'));
			$file = array_filter($file,
			create_function('$line',
			'return strpos(ltrim($line), "/*") !== 0;'));
			$sql = "";
			$del_num = false;
			foreach($file as $line){
				$query = trim($line);
				try
				{
					$delimiter = is_int(strpos($query, "DELIMITER"));
					if($delimiter || $del_num){
						if($delimiter && !$del_num )
						{
							$sql = "";
							$sql = $query."; ";
							$del_num = true;
						}
						else if($delimiter && $del_num)
						{
							$sql .= $query." ";
							$del_num = false;
							$dbh->exec($sql);
							$sql = "";
						}
						else
						{                            
							$sql .= $query."; ";
						}
					}
					else
					{
						$delimiter = is_int(strpos($query, ";"));
						if($delimiter){
							$dbh->exec("$sql $query");
							$sql = "";
						}
						else
						{
							$sql .= " $query";
						}
					}
				}
				catch (\Exception $e)
				{
					echo '';
				}
			}
		}
	}
	database::existTable('staffapplication');
	database::existTable('uotw');
	database::existTable('teams');
	database::existTable('cms_news_like');
	database::existTable('cms_news_message');
	database::existTable('referrer');
	database::existTable('referrerbank');
	database::existTable('resetpassword');
?>			