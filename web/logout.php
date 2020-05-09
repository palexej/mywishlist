<?php
	require 'db.php';
	unset($_SESSION['logged_user']);
	header('Location: http://awishlist/authAndLogin/cataloge');
?>
