<?php

	/* Database Setting */
	$db['host'] = '127.0.0.1';
	$db['port'] = '3306';
	$db['user'] = "root";
	$db['pass'] = '******';
	$db['db'] = "hotel";

	/* Website Setting */
	$config['hotelUrl'] = "http://127.0.0.1";
	$config['skin'] = "brain";
	$config['lang'] = "en";
	$config['hotelName'] = "Brain";
	$config['startMotto'] = "Welkom in Brain!";
	$config['favicon'] = "http://127.0.0.1/system/theme/brain/style/images/favicon/favicon.ico";
	$config['maintenance'] = false;
	$config['showErrors'] = true;
	$config['groupBadgeURL'] = "http://127.0.0.1/swf/habbo-imaging/badge.php?badge=";
	$config['badgeURL'] = "http://127.0.0.1/swf/c_images/album1584/"; 

	/* Client Setting */
	$hotel['emuHost'] = "127.0.0.1";
	$hotel['emuPort'] = "30000";  
	$hotel['staffCheckClient'] = true;
	$hotel['staffCheckClientMinimumRank '] = 3;
	$hotel['homeRoom'] = '0';
	$hotel['external_Variables'] = "http://127.0.0.1/swf/gamedata/external_variables.txt";
	$hotel['external_Variables_Override'] = "http://127.0.0.1/swf/gamedata/override/external_override_variables.txt";
	$hotel['external_Texts'] = "http://127.0.0.1/swf/gamedata/nl_external_flash_texts.txt";
	$hotel['external_Texts_Override'] = "http://127.0.0.1/swf/gamedata/override/external_flash_override_texts.txt";
	$hotel['productdata'] = "http://127.0.0.1/swf/gamedata/productdata.txt";
	$hotel['furnidata'] = "http://127.0.0.1/swf/gamedata/furnidata.xml";
	$hotel['figuremap'] = "http://127.0.0.1/swf/gamedata/figuremap.xml";
	$hotel['figuredata'] = "http://127.0.0.1/swf/gamedata/figuredata.xml";
	$hotel['swfFolder'] = "http://127.0.0.1/swf/gordon/PRODUCTION-201602082203-712976078";
	$hotel['swfFolderSwf'] = "http://127.0.0.1/swf/gordon/PRODUCTION-201602082203-712976078/habbo.swf?v=2";
	
	/* Social settings */
	$config['facebook'] = 'https://www.facebook.com/Habbo/';
	$config['facebookEnable'] = true;
	$config['twitter'] = 'https://twitter.com/Habbo';
	$config['twitterEnable'] = true;
	
	/* Register Setting */
	$config['credits']	= "10000";
	$config['duckets']	= "20000";
	$config['diamonds']	= "10";
	
	/* Google recaptcha Site Key  
	   Go to this website to create a recaptcha Site Key: https://www.google.com/recaptcha/intro/index.html	*/
	$config['recaptchaSiteKey'] = "6LdSSykTAAAAAJtY8DuXw9Cu9F0ZJ7J3tu0QpUUk";
	$config['recaptchaSiteKeyEnable'] = true;	
	
?>