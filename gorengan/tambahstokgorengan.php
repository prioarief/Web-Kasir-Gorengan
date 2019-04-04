<?php 
session_start();
  if (!isset($_SESSION['username'])){
    header('location: ../login.php');
  }
  if ($_SESSION['level']!="admin"){
    header('location: ../login.php');
  }
  require '../system/config.php';
  $id = $_GET['id'];

$query = "SELECT max(id_stok) as maxID FROM stok";
$hasil = mysqli_query($conn,$query);
$data  = mysqli_fetch_assoc($hasil);
$ID = $data['maxID'];

// mengambil angka atau bilangan dalam kode anggota terbesar,
// dengan cara mengambil substring mulai dari karakter ke-1 diambil 6 karakter
// misal 'STOK001', akan diambil '001'
// setelah substring bilangan diambil lantas dicasting menjadi integer
$noUrut = (int) substr($ID, 4, 3);

// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
$noUrut++;

// membentuk kode anggota baru
// perintah sprintf("%03s", $noUrut); digunakan untuk memformat string sebanyak 3 karakter
// misal sprintf("%03s", 12); maka akan dihasilkan '012'
// atau misal sprintf("%03s", 1); maka akan dihasilkan string '001'
$char = "STOK";
$newID = $char . sprintf("%03s", $noUrut);

  


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
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <?php include '../system/menu.php'; ?>
      <div id="content-wrapper">

        <h1 class="text-center">Tambah Stok</h1>
        <hr>
        <?php $data = $conn->query("SELECT * FROM gorengan WHERE id_gorengan= '$id'"); ?>
        <?php $result = $data->fetch_assoc(); ?>

        <div class="container">
			<div class="col-md-12">
				<form action="" method="post">
					<div class="form-group col-md-12">
			          
			          <input type="hidden" class="form-control" id="id_stok" name="id_stok" 
			          value="<?= $newID; ?>" readonly>
			        </div>
			        <div class="form-group col-md-12">
			          
			          <input type="hidden" class="form-control" id="id_gorengan" name="id_gorengan"
			          value="<?= $result['id_gorengan']; ?>">
			        </div>
			        <div class="form-group col-md-12">
			          <label for="gorengan">gorengan</label>
			          <input type="text" class="form-control" id="gorengan" name="gorengan"
			          value="<?= $result['gorengan']; ?>" readonly>
			        </div>
			        <div class="form-group col-md-12">
			          <label for="stokawal">stokawal</label>
			          <input type="number" class="form-control" id="stokawal" name="stokawal"
			          value="<?= $result['stok']; ?>" readonly>
			        </div>
			        <div class="form-group col-md-12">
			          <label for="tambahstok">tambahstok</label>
			          <input type="number" class="form-control" id="tambahstok" name="tambahstok"
			          required autofocus>
			        </div>
			        <div class="form-group col-md-12">
			          <label for="tanggal">tanggal</label>
			          <input type="text" class="form-control" id="tanggal" name="tanggal"
			          value="<?= date('d-m-Y'); ?>" readonly>
			        </div>
			        <div class="form-group col-md-12">
			          <button name="submit" class="btn btn-primary btn-block">Tambah</button>
			        </div>
			        
				</form>
				
			</div>
			<?php  
					if(isset($_POST['submit'])){
						$id_stok = htmlspecialchars($_POST['id_stok']);
						$id_gorengan = htmlspecialchars($_POST['id_gorengan']);
						$tambahstok =htmlspecialchars( $_POST['tambahstok']);
						$tanggal = date('d-m-Y');
             if ($tambahstok < 0) {
               echo "<script>alert('gagal');</script>";
               echo "<script>location='tambahstokgorengan.php?id=$id';</script>";
               return false;
             }
						

						$queryyy = $conn->query("INSERT INTO stok VALUES ('$id_stok','$id_gorengan','$tambahstok','$tanggal')");

						if ($queryyy >0) {
							echo "<script>alert('sukses');</script>";
							echo "<script>location='datagorengan.php';</script>";
						}else{
							echo "<script>alert('gagal sukses');</script>";
							echo "<script>location='datagorengan.php';</script>";
						}


					}

				?>



        </div>

        <!-- Sticky Footer -->
        <?php include '../system/footer.php'; ?>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->


    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="../vendor/chart.js/Chart.min.js"></script>
    <script src="../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="../js/demo/datatables-demo.js"></script>
    <script src="../js/demo/chart-area-demo.js"></script>

  </body>

</html>