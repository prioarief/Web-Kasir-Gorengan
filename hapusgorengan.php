<?php  
session_start();
  if (!isset($_SESSION['username'])){
    header('location: login.php');
  }
  if ($_SESSION['level']!="admin"){
    header('location: login.php');
  }
require 'config.php';

$id  = $_GET["id"];

$queryyy = $conn->query("DELETE FROM gorengan WHERE id_gorengan ='$id'");
if ($queryyy > 0) {
	echo "<script>alert('sukses');</script>";
	echo "<script>location='datagorengan.php';</script>";
}else{
	echo "<script>alert('gagal sukses');</script>";
	echo "<script>location='datagorengan.php';</script>";					
}

?>