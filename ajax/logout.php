<?php
	setcookie("user_id", "", time() - 3600, "/");

	
	session_start();
	session_destroy();
?>