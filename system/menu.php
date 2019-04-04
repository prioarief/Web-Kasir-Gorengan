<?php 

require 'config.php';
?>

<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="../index.php">Gorengan Makknyuss</a>





    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
            <input type="hidden" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">

        </div>
    </form>

    




</nav>

<div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="../index.php">
                <i class="fas fa-fw fa-cart-plus"></i>
                <span>Transaksi Baru</span>
            </a>
        </li>
        <?php if ($_SESSION['level'] == "admin") { ?>
        <li class="nav-item">
            <a class="nav-link" href="../kasir/datakasir.php">
                <i class="fas fa-fw fa-book"></i>
                <span>Data kasir</span></a>
        </li>
        <?php 
      } ?>
        <li class="nav-item">
            <a class="nav-link" href="../gorengan/datagorengan.php">
                <i class="fas fa-fw fa-book"></i>
                <span>Data Gorengan</span></a>
        </li>
        <?php if ($_SESSION['level'] == "admin") { ?>
        <li class="nav-item">
            <a class="nav-link" href="../transaksi/riwayat.php">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Riwayat Transaksi</span></a>
        </li>
        <?php }?>
          
        <li class="nav-item">
            <a class="nav-link" href="../logout.php">
                <i class="fas fa-user-circle fa-fw"></i>
                <span>Logout</span></a>
        </li>
    </ul> 