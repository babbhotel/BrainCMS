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
		global $dbh;
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
					$stmt = $dbh->prepare("UPDATE users SET password = :password WHERE username = :username");
					$stmt->bindParam(':username', $username); 
					$stmt->bindParam(':password', $password); 
					$stmt->execute(); 
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
			global $dbh;
			if (loggedIn())
			{
				$stmt = $dbh->prepare("SELECT * FROM users WHERE id = :id");
				$stmt->bindParam(':id', $_SESSION['id']);
				$stmt->execute();
				$row = $stmt->fetch();
				return $row[$key];
			}
		}
		public static function emailTaken($email)
		{
			global $dbh;
			$stmt = $dbh->prepare("SELECT*FROM users WHERE mail = :email LIMIT 1");
			$stmt->bindParam(':email', $email);
			$stmt->execute();
			if ($stmt->RowCount() > 0)
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
			global $dbh;
			$stmt = $dbh->prepare("SELECT*FROM users WHERE username = :username LIMIT 1");
			$stmt->bindParam(':username', $username);
			$stmt->execute();
			if ($stmt->RowCount() > 0)
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
			global $dbh,$config,$lang;
			if (isset($_POST['login']))
			{
				if (!empty($_POST['username']))
				{
					if (!empty($_POST['password']))
					{
						$stmt = $dbh->prepare("SELECT id, password, username, rank FROM users WHERE username = :username");
						$stmt->bindParam(':username', $_POST['username']); 
						$stmt->execute();
						if ($stmt->RowCount() == 1)
						{
							$row = $stmt->fetch();
							if (self::checkUser($_POST['password'], $row['password'],$row['username']))
							{	
								$_SESSION['id'] = $row['id'];
								if (!$config['maintenance'] == true)
								{
									header('Location: '.$config['hotelUrl'].'/me');
								}
								else
								{	
									if ($row['rank'] >= $config['maintenancekMinimumRankLogin'])
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
		}
		public static function register()
		{
			global $config, $lang, $dbh;
			if (isset($_POST['register']))
			{
				if ($config['registerEnable'] == true)
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
											if (!self::userTaken($_POST['username']))
											{
												if (!self::emailTaken($_POST['email']))
												{
													if (strlen($_POST['password']) >= 6)
													{
														if ($_POST['password'] == $_POST['password_repeat'])
														{	
															$stmt = $dbh->prepare("SELECT ip_reg FROM users WHERE ip_reg = '".checkCloudflare()."'");
															$stmt->execute();
															if ($stmt->RowCount() < 4)
															{
																if(!$config['recaptchaSiteKeyEnable'] == true)
																{
																	$_POST['g-recaptcha-response'] = true;
																}
																if ($_POST['g-recaptcha-response'])
																{
																	if ($_POST['motto'] !== $config['startMotto'])
																	{
																		$motto = $_POST['motto'];
																	}
																	else
																	{
																		$motto = $config['startMotto'];
																	}
																	$password = self::hashed($_POST['password']);
																	$stmt = $dbh->prepare("
																	INSERT INTO
																	users
																	(username, password, rank, motto, account_created, mail, look, ip_last, ip_reg, credits, activity_points, vip_points)
																	VALUES
																	(
																	:username, 
																	:password, 
																	'1', 
																	:motto, 
																	'".strtotime("now")."', 
																	:email, 
																	:avatar,
																	'".checkCloudflare()."', 
																	'".checkCloudflare()."', 
																	:credits,
																	:duckets,
																	:diamonds
																	)");
																	$stmt->bindParam(':username', $_POST['username']);
																	$stmt->bindParam(':password', $password);
																	$stmt->bindParam(':motto', $motto);
																	$stmt->bindParam(':email', $_POST['email']);
																	$stmt->bindParam(':avatar', $_POST['habbo-avatar']);
																	$stmt->bindParam(':credits', $config['credits']);
																	$stmt->bindParam(':duckets', $config['duckets']);
																	$stmt->bindParam(':diamonds', $config['diamonds']);
																	$stmt->execute();
																	$getUser = $dbh->prepare("SELECT id FROM users WHERE username = :username && mail = :email");
																	$getUser->bindParam(':username', $_POST['username']);
																	$getUser->bindParam(':email', $_POST['email']);
																	$getUser->execute();
																	$getUserData = $getUser->fetch();
																	$_SESSION['id'] = $getUserData['id'];
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
					return html::error($lang["RregisterDisable"]);
				}
			}
		}
		Public static function editPassword()
		{
			global $dbh,$lang;
			if (isset($_POST['password']))
			{
				if (isset($_POST['oldpassword']) && !empty($_POST['oldpassword']))
				{
					if (isset($_POST['newpassword']) && !empty($_POST['newpassword']))
					{
						$stmt = $dbh->prepare("SELECT id, password, username FROM users WHERE id = :id");
						$stmt->bindParam(':id', $_SESSION['id']);
						$stmt->execute();
						$getInfo = $stmt->fetch();
						if (self::checkUser(filter($_POST['oldpassword']), $getInfo['password'], filter($getInfo['username'])))
						{
							if (strlen($_POST['newpassword']) >= 6)
							{
								$newPassword = self::hashed($_POST['newpassword']);
								$stmt = $dbh->prepare("
								UPDATE 
								users 
								SET password = 
								:newpassword 
								WHERE id = 
								:id
								");
								$stmt->bindParam(':newpassword', $newPassword); 
								$stmt->bindParam(':id', $_SESSION['id']); 
								$stmt->execute(); 
								return Html::errorSucces($lang["Ppasswordchanges"]);
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
			global $lang,$dbh;
			if (isset($_POST['account']))
			{
				if (isset($_POST['email']) && !empty($_POST['email']))
				{
					if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
					{
						if (!self::emailTaken($_POST['email']))
						{
							$stmt = $dbh->prepare("
							UPDATE 
							users 
							SET mail = 
							:newmail
							WHERE id = 
							:id
							");
							$stmt->bindParam(':newmail', $_POST['email']); 
							$stmt->bindParam(':id', $_SESSION['id']); 
							$stmt->execute(); 
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
			global $lang,$dbh;
			if (isset($_POST['hinstellingenv']))
			{
				$stmt = $dbh->prepare("
				UPDATE 
				users 
				SET ignore_invites = 
				:hinstellingenv
				WHERE id = 
				:id
				");
				$stmt->bindParam(':hinstellingenv', $_POST['hinstellingenv']); 
				$stmt->bindParam(':id', $_SESSION['id']); 
				$stmt->execute(); 
			}
			if (isset($_POST['hinstellingenl']))
			{
				$stmt = $dbh->prepare("
				UPDATE 
				users 
				SET allow_mimic = 
				:hinstellingenl
				WHERE id = 
				:id
				");
				$stmt->bindParam(':hinstellingenl', $_POST['hinstellingenl']); 
				$stmt->bindParam(':id', $_SESSION['id']); 
				$stmt->execute(); 
			}
			if (isset($_POST['hinstellingeno']))
			{
				$stmt = $dbh->prepare("
				UPDATE 
				users 
				SET allow_mimic = 
				:hinstellingeno
				WHERE id = 
				:id
				");
				$stmt->bindParam(':hinstellingeno', $_POST['hinstellingeno']); 
				$stmt->bindParam(':id', $_SESSION['id']); 
				$stmt->execute(); 
			}
			if (isset($_POST['hotelsettings']))
			{
				return Html::errorSucces($lang["Hchanges"]);
			}
		}
		Public static function editUsername()
		{
			global $lang,$dbh;
			if (isset($_POST['editusername']))
			{
				if(!User::userData('fbenable') == 1)
				{
					if(!self::userTaken($_POST['username']))
					{
						if(self::validName($_POST['username']))
						{
							$stmt = $dbh->prepare("UPDATE users SET username = :username, fbenable = '1' WHERE id = :id");
							$stmt->bindParam(':username', $_POST['username']); 
							$stmt->bindParam(':id', $_SESSION['id']); 
							$stmt->execute(); 
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