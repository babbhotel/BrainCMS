<?php
	if(!defined('BRAIN_CMS')) 
	{ 
		die('Sorry but you cannot access this file!'); 
	}
	function staffPinHk()
		{
			global $config, $lang;
			if (isset($_POST['loginPin']))
			{
				if (!empty($_POST['PINbox']))
				{
					$query = DB::Fetch(DB::Query("SELECT pin FROM users WHERE id = '" . filter(DB::Escape($_SESSION['id'])) . "'"));
					if ($_POST['PINbox'] == $query['pin'])
					{
						$_SESSION['staffCheckHk'] = '1';
						header('Location: '.$config['hotelUrl'].'/adminpan/dash');
					}
					else{
						echo $lang["Ppinwrong"];
					}
				}
				else{
					echo $lang["Pnopin"];
				}
			}
		}
		function staffCheckHk()
		{
			global $config,$hotel;
			if($config['staffCheckHk'] == true)
			{
				if (user::userData('rank') > $config['staffCheckHkMinimumRank '])
				{
					if (empty($_SESSION['staffCheckHk'])) 
					{ 
						header('Location: '.$config['hotelUrl'].'/adminpan/pin');
						exit;
					}
				}
			}
		}
?>