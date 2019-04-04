<?php  
session_start();
if (($_SESSION['level'] == "")) {
  header('location:login.php');
}

  require 'config.php';
    

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

    <?php include 'menu.php'; ?>

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
        <?php include 'footer.php'; ?>

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
