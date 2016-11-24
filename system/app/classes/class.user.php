<?php
	if(!defined('BRAIN_CMS')) 
	{ 
		die('Sorry but you cannot access this file!'); 
	}
	/* 
		Functions list Class User.
		---------------
		checkUser();
		hashed();
		validName();
		userData();
		emailTaken();
		userTaken();
		login();
		register();
		editPassword();
		editEmail();
		editHotelSettings();
	*/
	class User 
	{
		public static function checkUser($password, $passwordDb, $username)
		{
			if (substr($passwordDb, 0, 1) == "$") 
			{
				if (password_verify($password, $passwordDb))
				{
					return true;
				}
				return false;
			}
			else 
			{
				if (md5($password) == $passwordDb) 
				{
					$updateUserHash = DB::Fetch(DB::Query("UPDATE users SET password = '".self::hashed($password)."' WHERE username = '".filter(DB::Escape($username))."'"));		
					return true;
				}
				return false;
			}
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
				$query = DB::Fetch(DB::Query("SELECT id,username,mail,motto,auth_ticket,credits,vip_points,activity_points,look,rank,online,fbenable FROM users WHERE id = '" . filter(DB::Escape($_SESSION['id'])) . "'"));
				return filter($query[$key]);
			}
			return false;
		}
		public static function emailTaken($email)
		{
			$sqlEmailTaken = DB::Query("SELECT*FROM users WHERE mail = '" . filter(DB::Escape($email) . "' LIMIT 1"));
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
			$sqlUserTaken = DB::Query("SELECT*FROM users WHERE username = '" . filter(DB::Escape($username) . "' LIMIT 1"));
			if ($sqlUserTaken->num_rows > 0)
			{
				return true;
			}
			else
			{
				return false;
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
							if (DB::NumRowsQuery("SELECT username FROM users WHERE username = '".filter(DB::Escape($_POST['username'])."'")) == 1)
							{
								$getInfo = DB::Fetch(DB::Query("SELECT id, password, username, rank FROM users WHERE username = '".filter(DB::Escape($_POST['username'])."'")));
								if (self::checkUser($_POST['password'], $getInfo['password'],$getInfo['username']))
								{	
									$_SESSION['id'] = filter($getInfo['id']);
									if (!$config['maintenance'] == true)
									{
										header('Location: '.$config['hotelUrl'].'/me');
									}
									else
									{	
										if ($getInfo['rank'] >= $config['maintenancekMinimumRankLogin'])
										{
											$_SESSION['adminlogin'] = true;
											header('Location: '.$config['hotelUrl'].'/me');	
										}
										return html::error($lang["Mnologin"]);
									}
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
				if ($config['registerEnable'] == true)
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
												if (!self::userTaken(DB::Escape($_POST['username'])))
												{
													if (!self::emailTaken(DB::Escape($_POST['email'])))
													{
														if (strlen($_POST['password']) >= 6)
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
																			$motto = filter(DB::Escape($_POST['motto']));
																		}
																		else
																		{
																			$motto = $config['startMotto'];
																		}
																		DB::Fetch(DB::Query("
																		INSERT INTO
																		users
																		(username, password, rank, motto, account_created, mail, look, ip_last, ip_reg, credits, activity_points, vip_points)
																		VALUES
																		(
																		'".DB::Escape(filter($_POST['username']))."', 
																		'".self::hashed($_POST['password'])."', 
																		'1', 
																		'".$motto."', 
																		'".strtotime("now")."', 
																		'".DB::Escape(filter($_POST['email']))."', 
																		'".DB::Escape(filter($_POST['habbo-avatar']))."',
																		'".checkCloudflare()."', 
																		'".checkCloudflare()."', 
																		'".$config['credits']."',
																		'".$config['duckets']."',
																		'".$config['diamonds']."'
																		)
																		"));
																		$userInfo = DB::Fetch(DB::Query("SELECT * FROM `users` WHERE username='".filter(DB::Escape($_POST['username']))."' && mail = '".filter(DB::Escape($_POST['email']))."' LIMIT 1"));
																		
																			$_SESSION['id'] = filter(DB::Escape($userInfo['id']));
																			header('Location: '.$config['hotelUrl'].'/me');
																		
																	}
																	else
																	{
																		return html::error($lang["Rrobot"]); 
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
				else
				{
					return html::error($lang["RregisterDisable"]);
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
						$getInfo = DB::Fetch(DB::Query("SELECT id, password, username FROM users WHERE id = '". filter(DB::Escape($_SESSION['id'])."'")));
						if (self::checkUser(filter($_POST['oldpassword']), $getInfo['password'], filter($getInfo['username'])))
						{
							if (strlen($_POST['newpassword']) >= 6)
							{
								if($sql = DB::Query("
								UPDATE 
								users 
								SET password = 
								'".DB::Escape(self::hashed($_POST['newpassword']))."' 
								WHERE id = 
								'".filter(DB::Escape($_SESSION['id']))."'"
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
						if (!self::emailTaken($_POST['email']))
						{
							$user = DB::Fetch(DB::Query("UPDATE users SET mail = '". filter(DB::Escape($_POST['email']))."' WHERE id = '". filter(DB::Escape($_SESSION['id']))."'"));
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
				$user = DB::Fetch(DB::Query("UPDATE users SET ignore_invites = '". filter(DB::Escape($_POST['hinstellingenv']))."' WHERE id = '". filter(DB::Escape($_SESSION['id'])."'")));
			}
			if (isset($_POST['hinstellingenl']))
			{
				$user = DB::Fetch(DB::Query("UPDATE users SET allow_mimic = '". filter(DB::Escape($_POST['hinstellingenl']))."' WHERE id = '". filter(DB::Escape($_SESSION['id'])."'")));
			}
			if (isset($_POST['hinstellingeno']))
			{
				$user = DB::Fetch(DB::Query("UPDATE users SET hide_online = '". filter(DB::Escape($_POST['hinstellingeno']))."' WHERE id = '". filter(DB::Escape($_SESSION['id'])."'")));	
			}
			if (isset($_POST['hotelsettings']))
			{
				return Html::errorSucces($lang["Hchanges"]);
			}
		}
		Public static function editUsername()
		{
			global $lang;
			if (isset($_POST['editusername']))
			{
				if(!User::userData('fbenable') == 1)
				{
					if(!self::userTaken(DB::Escape($_POST['username'])))
					{
						if(self::validName($_POST['username']))
						{
							$updateUsername = DB::Fetch(DB::Query("UPDATE users SET username = '". DB::Escape(filter($_POST['username']))."', fbenable = '1' WHERE id = '". DB::Escape(filter($_SESSION['id']))."'"));	
							header('Location: '.$config['hotelUrl'].'/me');
						}
						else
						{
							return Html::error($lang["Cusernameshort"]);
						}
					}
					else
					{
						return html::error($lang["Cusernameused"]);
					}
				}
				else
				{
					return html::error($lang["Cchangeno"]);
				}
			}
		}
	}
?>																										