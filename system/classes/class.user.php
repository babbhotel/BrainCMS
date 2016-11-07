<?php
	/* 
		Functions list Class User.
		---------------
		checkUser();
		hashed();
		validName();
		userData();
		emailTaken();
		userTaken();
		staffPin();
		staffCheck();
		login();
		register();
		editPassword();
		editEmail();
		editHotelSettings();
	*/
	class User 
	{
		public static function checkUser($password, $passwordDb)
		{
			return (password_verify($password, $passwordDb));
		}
		public static function hashed($password)
		{
			return password_hash($password, PASSWORD_BCRYPT);
		}
		public static function validName($username)
		{
			if(strlen($username) <= 12 && strlen($username) >= 3 && ctype_alnum($username))
			{
				return true;
			}
			return false;
		}
		public static function userData($key)
		{
			if (loggedIn())
			{
				$query = DB::Fetch(DB::Query("SELECT id,username,mail,motto,auth_ticket,credits,vip_points,activity_points,look,rank,online FROM users WHERE id = '" . DB::Escape($_SESSION['id']) . "'"));
				return filter($query[$key]);
			}
			return false;
		}
		public static function emailTaken($email)
		{
			$sqlEmailTaken = DB::Query("SELECT*FROM users WHERE mail = '" . DB::Escape($email) . "' LIMIT 1");
			if ($sqlEmailTaken->num_rows > 0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		public static function userTaken($username)
		{
			$sqlEmailTaken = DB::Query("SELECT*FROM users WHERE username = '" . DB::Escape($username) . "' LIMIT 1");
			if ($sqlEmailTaken->num_rows > 0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		public static function staffPin()
		{
			global $config, $lang;
			if (isset($_POST['loginPin']))
			{
				if (!empty($_POST['PINbox']))
				{
					$query = DB::Fetch(DB::Query("SELECT pin FROM users WHERE id = '" . DB::Escape($_SESSION['id']) . "'"));
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
		Public static function staffCheck()
		{
			global $config,$hotel;
			if($hotel['staffCheckClient'] == true)
			{
				if (self::userData('rank') > $hotel['staffCheckClientMinimumRank '])
				{
					if (empty($_SESSION['staffCheck'])) 
					{ 
						header('Location: '.$config['hotelUrl'].'/pin');
						exit;
					}
				}
			}
		}
		public static function login()
		{
			global $config,$lang;
			if (isset($_POST['login']))
			{
				if ($_POST['hiddenField_login'] == hiddenField())
				{
					if (!empty($_POST['username']))
					{
						if (!empty($_POST['password']))
						{
							if (DB::NumRowsQuery("SELECT username FROM users WHERE username = '".DB::Escape($_POST['username'])."'") == 1)
							{
								$getInfo = DB::Fetch(DB::Query("SELECT id, password FROM users WHERE username = '".DB::Escape($_POST['username'])."'"));
								if (self::checkUser($_POST['password'], $getInfo['password']))
								{
									$_SESSION['id'] = $getInfo['id'];
									header('Location: '.$config['hotelUrl'].'/me');
								}
								return html::error($lang["Lpasswordwrong"]);
							}
							return html::error($lang["Lnotexistuser"]);
						}
						return html::error($lang["Lnopassword"]);
					}
					return html::error($lang["Lnousername"]);
				}
				return html::error($lang["Lwrong"]);
			}
		}
		public static function register()
		{
			global $config, $lang;
			if (isset($_POST['register']))
			{
				if ($_POST['hiddenField_register'] == hiddenField())
				{
					if (!empty($_POST['username']))
					{
						if (self::validName($_POST['username']))
						{
							if (!empty($_POST['password']))
							{
								if (!empty($_POST['password_repeat']))
								{
									if (!empty($_POST['email']))
									{
										if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
										{
											if (!Self::userTaken(DB::Escape($_POST['username'])))
											{
												if (!Self::emailTaken(DB::Escape($_POST['email'])))
												{
													if (strlen($_POST['password']) > 5)
													{
														if ($_POST['password'] == $_POST['password_repeat'])
														{	
															if (DB::NumRowsQuery("SELECT ip_reg FROM users WHERE ip_reg = '".checkCloudflare()."'") < 4)
															{
																if(!$config['recaptchaSiteKeyEnable'] == true)
																{
																	$_POST['g-recaptcha-response'] = true;
																}
																if ($_POST['g-recaptcha-response'])
																{
																	if ($_POST['motto'] !== $config['startMotto'])
																	{
																		$motto = DB::Escape($_POST['motto']);
																	}
																	else
																	{
																		$motto = $config['startMotto'];
																	}
																	DB::Query("
																	INSERT INTO
																	users
																	(username, password, rank, motto, account_created, mail, look, ip_last, ip_reg, credits, activity_points, vip_points)
																	VALUES
																	(
																	'".DB::Escape($_POST['username'])."', 
																	'".self::hashed($_POST['password'])."', 
																	'1', 
																	'".$motto."', 
																	'".strtotime("now")."', 
																	'".DB::Escape($_POST['email'])."', 
																	'".DB::Escape($_POST['habbo-avatar'])."',
																	'".checkCloudflare()."', 
																	'".checkCloudflare()."', 
																	'".$config['credits']."',
																	'".$config['duckets']."',
																	'".$config['diamonds']."'
																	)
																	");
																	$userInfo = DB::Query("SELECT * FROM `users` WHERE username='".DB::Escape($_POST['username'])."' && mail = '".DB::Escape($_POST['email'])."' LIMIT 1");
																	while ($User = $userInfo->fetch_assoc())
																	{
																		$_SESSION['id'] = DB::Escape($User['id']);
																		header('Location: '.$config['hotelUrl'].'/me');
																	}
																}
																else
																{
																	return html::error($lang["Rnorobot"]); 
																}
															}
															else
															{
																return html::error($lang["Rmaxaccounts"]); 
															}
														}
														else
														{
															return html::error($lang["Rpasswordswrong"]);
														}
													}
													else
													{
														return html::error($lang["Rpasswordshort"]); 
													}
												}
												else
												{
													return html::error($lang["Remailexists"]);
												}
											}
											else
											{
												return html::error($lang["Rusernameused"]);
											}
										}
										else
										{
											return html::error($lang["Remailnotallowed"]);
										}
									}
									else
									{
										return html::error($lang["Remailempty"]);
									}
								}
								else
								{
									return html::error($lang["Rpasswordsempty"]); 
								}
							}
							else
							{
								return html::error($lang["Rpasswordsempty"]); 
							}
						}
						else
						{
							return html::error($lang["Rusernameshort"]);
						}
					}
					else
					{
						return html::error($lang["Rusrnameempty"]);
					}
				}
				else
				{
					return html::error($lang["Rwrong"]);
				}
			}
		}
		Public static function editPassword()
		{
			global $lang;
			if (isset($_POST['password']))
			{
				if (isset($_POST['oldpassword']) && !empty($_POST['oldpassword']))
				{
					if (isset($_POST['newpassword']) && !empty($_POST['newpassword']))
					{
						$passwordOld = DB::Escape($_POST['oldpassword']);
						$getInfo = DB::Fetch(DB::Query("SELECT id, password FROM users WHERE id = '". DB::Escape($_SESSION['id'])."'"));
						if (self::checkUser($_POST['oldpassword'], $getInfo['password']))
						{
							if (strlen($_POST['newpassword']) > 5)
							{
								if($sql = DB::Query("
								UPDATE 
								users 
								SET password = 
								'".DB::Escape(self::hashed($_POST['newpassword']))."' 
								WHERE id = 
								'".DB::Escape($_SESSION['id'])."'"
								)
								)
								{
									return Html::errorSucces($lang["Ppasswordchanges"]);
								}
								else
								{
									return Html::error($lang["Pnotwork"]);
								}
							}
							else
							{
								return Html::error($lang["Ppasswordshort"]);
							}
						}
						else
						{
							return Html::error($lang["Poldpasswordwrong"]);
						}
					}
					else
					{
						return Html::error('Je nieuwe wachtwoord is leeg!');
					}
				}
				else
				{
					return Html::error('Oude wachtwoord is leeg!');
				}
			}
		}
		Public static function editEmail()
		{
			global $lang;
			if (isset($_POST['account']))
			{
				if (isset($_POST['email']) && !empty($_POST['email']))
				{
					if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
					{
						if (!Self::emailTaken($_POST['email']))
						{
							$user = DB::Query("UPDATE users SET mail = '". DB::Escape($_POST['email'])."' WHERE id = '". DB::Escape($_SESSION['id'])."'");
							return Html::errorSucces($lang["Eemailchanges"]);
						}
						else
						{
							return Html::error($lang["Eemailexists"]);
						}
					}
					else
					{
						return Html::error($lang["Eemailnotallowed"]);
					}
				}
				else
				{
					return Html::error($lang["Enoemail"]);
				}
			}
		}
		Public static function editHotelSettings()
		{
			global $lang;
			if (isset($_POST['hinstellingenv']))
			{
				$user = DB::Query("UPDATE users SET ignore_invites = '". DB::Escape($_POST['hinstellingenv'])."' WHERE id = '". DB::Escape($_SESSION['id'])."'");
			}
			if (isset($_POST['hinstellingenl']))
			{
				$user = DB::Query("UPDATE users SET allow_mimic = '". DB::Escape($_POST['hinstellingenl'])."' WHERE id = '". DB::Escape($_SESSION['id'])."'");
			}
			if (isset($_POST['hinstellingeno']))
			{
				$user = DB::Query("UPDATE users SET hide_online = '". DB::Escape($_POST['hinstellingeno'])."' WHERE id = '". DB::Escape($_SESSION['id'])."'");	
			}
			if (isset($_POST['hotelsettings']))
			{
				return Html::errorSucces($lang["Hchanges"]);
			}
		}
	}
?>										