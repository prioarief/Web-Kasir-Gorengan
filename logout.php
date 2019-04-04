<?php  

	session_start();
	// menghapus session
	
	unset($_SESSION['username']);
	unset($_SESSION['level']);
	session_destroy();
	header('location:login.php');
?>