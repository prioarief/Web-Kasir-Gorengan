<?php 
session_start();
if (!isset($_SESSION['username'])) {
    header('location: login.php');
}
if ($_SESSION['level'] != "admin") {
    header('location: login.php');
}
require 'config.php';

$id  = $_GET["id"];

$queryyy = $conn->query("DELETE FROM transaksi WHERE id_transaksi ='$id'");
if ($queryyy >= 1) {
    echo "<script>alert('sukses');</script>";
    echo "<script>location='riwayat.php';</script>";
} else {
    echo "<script>alert('gagal sukses');</script>";
    echo "<script>location='riwayat.php';</script>";
}
