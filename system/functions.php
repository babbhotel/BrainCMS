<?php
	
	/* 
		Functions list functions.
		--------------- 
		
		DB::Escape();
		loggedIn();
		checkCloudflare();
		hiddenField();
	*/
	
	function filter($data) 
	{
		$data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
		$data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
		$data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
		$data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');
		
		// Remove any attribute starting with "on" or xmlns
		$data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);
		
		// Remove javascript: and vbscript: protocols
		$data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
		$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
		$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);
		
		// Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
		$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
		$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
		$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);
		
		// Remove namespaced elements (we do not need them)
		$data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);
		
		do
		{
			// Remove really unwanted tags
			$old_data = $data;
			$data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
		}
		while ($old_data !== $data);
		
		// we are done...
		return $data;
	}
	function checkVersion()
	{
		$script = file_get_contents("http://brain.retroripper.com/version.txt");
		$update = file_get_contents("http://brain.retroripper.com/update.txt");
		$version = '0.3.0';
		if($version == $script) {
			echo'<div style = "width: 100%;
			background-color: green;
			border-radius: 5px;
			padding: 10px;
			color: white;
			margin-bottom: 10px;
			font-size: 17px;">Deze versie van brainCMS is up to date! V '.$script.'</div>';
			} else {
			echo'<div style = "width: 100%;
			background-color: red;
			border-radius: 5px;
			padding: 10px;
			color: white;
			margin-bottom: 10px;
			font-size: 17px;">Er is een nieuwe versie beschiktbaar! V '.$script.'</div>
			<div style = "width: 100%;
			background-color: green;
			border-radius: 5px;
			padding: 10px;
			color: white;
			margin-bottom: 10px;
			font-size: 17px;">'.$update.'</div>';
		}	
	}
	function loggedIn()
	{
		if (isset($_SESSION['id']))
		{
			return true;
		}
		else
		{
			return false;
		}		
	}
	function checkCloudflare()
	{
		if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) 
		{
			$_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
			return $_SERVER['REMOTE_ADDR'];
		}
		else
		{
			return $_SERVER['REMOTE_ADDR'];
		}
	}
	function hiddenField()
	{
		$hidCode = md5(date("d-m-Y-l"));
		return $hidCode;
	}
?>
