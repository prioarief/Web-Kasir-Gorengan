<?php 
session_start();
  if (!isset($_SESSION['username'])){
    header('location: login.php');
  }
  if ($_SESSION['level']!="admin"){
    header('location: login.php');
  }
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

  <body id="page-top">

    <?php include 'menu.php'; ?>

      <div id="content-wrapper">

        <h1 class="text-center">Ubah Gorengan</h1>
        <hr>
        <?php $data = $conn->query("SELECT * FROM gorengan WHERE id_gorengan= '$id'");
         $result = $data->fetch_assoc(); ?>

        <div class="container">
			<div class="col-md-12">
				<form action="" method="post">
					<div class="form-group col-md-12">
			          <label for="id_gorengan">id gorengan</label>
			          <input type="text" class="form-control" id="id_gorengan" name="id_gorengan" 
			          value="<?= $result['id_gorengan']; ?>" readonly>
			        </div>
			        <div class="form-group col-md-12">
			          <label for="gorengan">gorengan</label>
			          <input type="text" class="form-control" id="gorengan" name="gorengan"
			          value="<?= $result['gorengan']; ?>">
			        </div>
			        <div class="form-group col-md-12">
			          <label for="harga">harga</label>
			          <input type="number" class="form-control" id="harga" name="harga"
			          value="<?= $result['harga']; ?>">
			        </div>
			        <div class="form-group col-md-12">
			          <button name="submit" class="btn btn-primary btn-block">Ubah</button>
			        </div>
			        
				</form>
				
			</div>
			<?php  
					if(isset($_POST['submit'])){
						$id_gorengan = $_POST['id_gorengan'];
						$gorengan = htmlspecialchars($_POST['gorengan']);
						$harga =htmlspecialchars( $_POST['harga']);
						

						$queryyy = $conn->query("UPDATE gorengan SET
							gorengan ='$gorengan',
							harga ='$harga'
						
							

							WHERE id_gorengan = '$id'");

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
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © Website Gorengan 2019</span>
            </div>
          </div>
        </footer>

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