<?php  
	// mengaktifkan session
	// set session
	
	session_start();


	if(($_SESSION['level'] == "admin")){
		header('location:admin.php');
	}
	else if(($_SESSION['level'] == "kasir")){
		header('location:kasir.php');
	}
	else{
		header('location:login.php');
	}
	require 'config.php';

	$username = htmlspecialchars($_POST['username']);
	$password = htmlspecialchars($_POST['password']);
	$op 	  = $_GET['op'];

	if ($op == "in"){
		$qlogin = mysqli_query($conn,"SELECT * FROM kasir WHERE username = '$username' 
				  AND password = '$password'");
		if (mysqli_num_rows($qlogin) == 1){
			$data = mysqli_fetch_array($qlogin);
			$_SESSION['login'] == true;
			$_SESSION['username'] = $data['username'];
			$_SESSION['id'] = $data['id_kasir'];
			$_SESSION['nama'] = $data['nama'];
			$_SESSION['level'] = $data['level'];

			if ($data['level'] == "admin"){
				header('location: admin.php');
			}
			else if ($data['level'] == "kasir"){
				header('location: kasir.php');
			}
		}
		}
	elseif($op == "out"){
		unset($_SESSION['username']);
		unset($_SESSION['level']);
		header('location: login.php');
	}
?>