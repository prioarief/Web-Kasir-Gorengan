<?php  

session_start();
 if (!isset($_SESSION['username'])){
    header('location: login.php');
  }
$id = $_GET['id'];
unset($_SESSION['belanja'][$id]);

echo "<script>alert('berhasil di hapus dari keranjang');</script>";
echo "<script>location='keranjang.php';</script>";

?>