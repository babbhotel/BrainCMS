<?php
	session_destroy();
	header('Location: '.$config['hotelUrl'].'/index');
?>