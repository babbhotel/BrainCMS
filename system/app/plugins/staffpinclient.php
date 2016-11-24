<?php
	if(!defined('BRAIN_CMS')) 
	{ 
		die('Sorry but you cannot access this file!'); 
	}
	function staffPin()
		{
			global $config, $lang;
			if (isset($_POST['loginPin']))
			{
				if (!empty($_POST['PINbox']))
				{
					$query = DB::Fetch(DB::Query("SELECT pin FROM users WHERE id = '" . filter(DB::Escape($_SESSION['id'])) . "'"));
					if ($_POST['PINbox'] == $query['pin'])
					{
						$_SESSION['staffCheck'] = '1';
						header('Location: '.$config['hotelUrl'].'/game');
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
		function staffCheck()
		{
			global $config,$hotel;
			if($hotel['staffCheckClient'] == true)
			{
				if (User::userData('rank') >= $hotel['staffCheckClientMinimumRank'])
				{
					if (empty($_SESSION['staffCheck'])) 
					{ 
						header('Location: '.$config['hotelUrl'].'/pin');
						exit;
					}
				}
			}
		}
?>