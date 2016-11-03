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
		editHotelSettings();
		editEmail();
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
			global $config;
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
						echo'Je ingevulde PIN klopt niet!';
					}
				}
				else{
					echo'Geen PIN ingevuld!';
				}
			}
		}
		Public static function staffCheck()
		{
			global $config;
			if($config['staffCheckClient'] == true)
			{
				if (self::userData('rank') > $config['staffCheckClientMinimumRank '])
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
			global $config;
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
								return html::error("Je wachtwoord klopt niet!");
							}
							return html::error("Deze gebruikersnaam bestaat niet.");
						}
						return html::error("Je hebt geen wachtwoord ingevuld.");
					}
					return html::error("Je hebt geen gebruikersnaam ingevuld.");
				}
				return html::error("Er is iets mis gegaan!");
			}
		}
		public static function register()
		{
			global $config;
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
																	return html::error('Druk op "Ik ben geen robot"!'); 
																}
															}
															else
															{
																return html::error("Sorry maar je mag maar 3 accounts hebben per IP!"); 
															}
														}
														else
														{
															return html::error("Ingevoerde wachtwoorden komen niet overeen!");
														}
													}
													else
													{
														return html::error("Wachtwoord moet bestaan uit meer dan 6 tekens!"); 
													}
												}
												else
												{
													return html::error("Email is al geregistreerd!");
												}
											}
											else
											{
												return html::error("Gebruikersnaam is al gebruik!");
											}
										}
										else
										{
											return html::error("Email is niet toegestaan!");
										}
									}
									else
									{
										return html::error("Email is leeg");
									}
								}
								else
								{
									return html::error("Ingevoerde wachtwoorden komen niet overeen!"); 
								}
							}
							else
							{
								return html::error("Ingevoerde wachtwoorden komen niet overeen!"); 
							}
						}
						else
						{
							return html::error("Je naam moet minimaal uit 3 karakters bestaan en niet langer dan 13 karakters!");
						}
					}
					else
					{
						return html::error("Gebruikersnaam is leeg");
					}
				}
				else
				{
					return html::error("Er is iets mis gegaan!");
				}
			}
		}
		Public static function editPassword()
		{
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
									return Html::errorSucces('Wachtwoord is gewijzigd!');
								}
								else
								{
									return Html::error('niet gelukt!');
								}
							}
							else
							{
								return Html::error('Wachtwoord moet meer dan 6 tekens hebben');
							}
						}
						else
						{
							return Html::error('Je oude wachtwoord is verkeerd!');
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
		Public static function editHotelSettings()
		{
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
				return Html::errorSucces('Hotel Instellingen gewijzicht');
			}
		}
		Public static function editEmail()
		{
			if (isset($_POST['account']))
			{
				if (isset($_POST['email']) && !empty($_POST['email']))
				{
					if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
					{
						if (!Self::emailTaken($_POST['email']))
						{
							$user = DB::Query("UPDATE users SET mail = '". DB::Escape($_POST['email'])."' WHERE id = '". DB::Escape($_SESSION['id'])."'");
							return Html::errorSucces("Je email adres is gewijzigd. ");
						}
						else
						{
							return Html::error("Dit email adres is al in gebruik!");
						}
					}
					else
					{
						return Html::error("Dit email is niet geldig!");
					}
				}
				else
				{
					return Html::error("Er is geen emial ingevuld!");
				}
			}
		}
	}	
?>										