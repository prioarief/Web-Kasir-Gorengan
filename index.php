<?php  
session_start();
if (($_SESSION['level'] == "")) {
  header('location:login.php');
}

  require 'system/config.php';
    

?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Gorengan Makkknyussss </title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.php">Gorengan Makknyuss</a>





    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
            <input type="hidden" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">

        </div>
    </form>

    <!-- Navbar -->
    <!-- <?php if (isset($_SESSION['login'])) { ?>
        <div class="col-sm-12">
          <ul class="navbar-nav ml-auto ml-md-0">
          <li class="nav-item">
            <a class="nav-link disabled" aria-disabled="true">
              <i class="fas fa-fw fa-user"></i>
              <span><?= $_SESSION['user']; ?></span>
            </a>
          </li>
        </ul>
        </div>
      <?php 
    } ?> -->




</nav>

<div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="index.php">
                <i class="fas fa-fw fa-cart-plus"></i>
                <span>Transaksi Baru</span>
            </a>
        </li>
        <?php if ($_SESSION['level'] == "admin") { ?>
        <li class="nav-item">
            <a class="nav-link" href="kasir/datakasir.php">
                <i class="fas fa-fw fa-book"></i>
                <span>Data kasir</span></a>
        </li>
        <?php 
      } ?>
        <li class="nav-item">
            <a class="nav-link" href="gorengan/datagorengan.php">
                <i class="fas fa-fw fa-book"></i>
                <span>Data Gorengan</span></a>
        </li>
        <?php if ($_SESSION['level'] == "admin") { ?>
        <li class="nav-item">
            <a class="nav-link" href="transaksi/riwayat.php">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Riwayat Transaksi</span></a>
        </li>
        <?php }?>
          
        <li class="nav-item">
            <a class="nav-link" href="logout.php">
                <i class="fas fa-user-circle fa-fw"></i>
                <span>Logout</span></a>
        </li>
    </ul> 

      <div id="content-wrapper">
        <div class="col-sm-12">
          <h3 class="text-center">List Gorengan</h3>
        </div>
        <hr>
        

        <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Gorengan</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Gorengan</th>
                      <th>Harga</th>
                      <th>Stok</th>
                      <th class="text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Gorengan</>
                      <th>Harga</th>
                      <th>Stok</th>
                      <th class="text-center">Aksi</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    
                    <?php 
                      $query = $conn->query("SELECT * FROM gorengan");
                      while($result = $query->fetch_assoc()){
                      
                        
                    ?>
                    
                    <tr>
                      <td><?= $result['gorengan']; ?></td>
                      <td><?= $result['harga']; ?></td>
                      <td><?= $result['stok']; ?></td>
                      <td class="text-center">
                          <?php if ($result['stok'] >= 1) { ?>
                                <a href="transaksi.php?id=<?= $result['id_gorengan']; ?>" class="btn btn-primary">Beli</a>
                            <?php } ?>
                            <?php if ($result['stok'] < 1) { ?>
                              <a href="transaksi.php?id=<?= $result['id_gorengan']; ?>" class="btn btn-primary btn- disabled" role="button" aria-disabled="true">Beli
                              </a>

                            <?php } ?>
                      </td>
                    </tr>
                    
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

        <!-- Sticky Footer -->
        <?php include 'system/footer.php'; ?>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->



    

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="js/demo/datatables-demo.js"></script>
    <script src="js/demo/chart-area-demo.js"></script>

  </body>

</html>
