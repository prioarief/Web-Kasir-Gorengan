<?php  
  session_start();
  
  require 'config.php';
  $id = $_GET['id'];


?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Website Gorengan</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

  </head>

  <body >

    <?php include 'menu.php'; ?>

      <div id="content-wrapper">

        <h1 class="text-center">Detail Transaksi</h1>
        <hr>
        <?php  
          $ambil   = $conn->query("SELECT * FROM transaksi WHERE id_transaksi = '$_GET[id]'");
          $hasil   = $ambil->fetch_assoc();
          $kasir   = $hasil['id_kasir'];
          $ambill  = $conn->query("SELECT nama FROM kasir WHERE id_kasir = '$kasir'");
          $resultt = $ambill->fetch_assoc();

        ?>
        <div class="col-sm-12 ml-2">
          <div class="col-sm-6">
            <p>Nama Kasir : <?= $resultt['nama']; ?></p>
          </div>
          <div class="col-sm-6">
            <p>Tanggal Pembelian : <?= $hasil['tanggal']; ?> </p>
          </div>
        </div>
        



        

        <div class="container">
          <table class="table table-striped table-responsive-sm table-bordered mt-5 text-center ">
            <thead>
              <tr>
                <th>No</th>
                <th>Gorengan</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Sub Total</th>
              </tr>
              
              
            </thead>

            <?php  

                $ambil = $conn->query("SELECT * FROM detail_transaksi JOIN gorengan ON detail_transaksi.id_gorengan = gorengan.id_gorengan WHERE id_transaksi = '$_GET[id]'");
                
                $no = 1;
                $sebelumpajak = 0;
                while($result = $ambil -> fetch_assoc()){
                



              ?>
            <tbody>
              <tr>
                <td><?= $no; ?></td>
                <td><?= $result['gorengan']; ?></td>
                <td>Rp. <?= number_format($result['harga']); ?></td>
                <td><?= $result['jumlah']; ?></td>
                <?php $sub = $result['harga']*$result['jumlah']; ?>
                <td>Rp. <?= number_format($sub); ?></td>
              </tr>

            
            <?php $no++; ?>
            <?php $sebelumpajak += $sub; ?>
            <?php } ?>
            <?php $pajak = $sebelumpajak*0.05; ?>
            
            <tr>
              <td colspan="4" class="text-left">Total Harga</td>
              <td>Rp. <?= number_format($sebelumpajak); ?></td>
            </tr>
            <tr>
              <td colspan="4" class="text-left">Pajak 5%</td>
              <td>Rp. <?= number_format($pajak); ?></td>
            </tr>
            <tr>
                <td colspan="4" class="text-left">Total Harga + Pajak 5%</td>
                <td>Rp. <?= number_format($hasil['totalharga']); ?></td>
            </tr>
            <?php if(isset($_SESSION['bayar'])){ ?>
            <tr>
                <td colspan="4" class="text-left">Bayar</td>
                <td>Rp. <?= number_format($_SESSION['bayar']); ?></td>
            </tr>
            <tr>
                <td colspan="4" class="text-left">Kembalian</td>
                <?php $kembalian = $_SESSION['bayar'] - $hasil['totalharga']; ?>
                <td>Rp. <?= number_format($kembalian); ?></td>
            </tr>
            
            <?php } ?>
          </tbody>
          </table>
          <div class="col-sm-12 text-center mb-5">
            <a href="cetak.php?id=<?= $id; ?>" target ="_blank" class="btn btn-dark btn-block">Cetak</a>
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
