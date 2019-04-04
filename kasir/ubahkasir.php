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

        <h1 class="text-center">Ubah Kasir</h1>
        <hr>
        <?php $data = $conn->query("SELECT * FROM kasir WHERE id_kasir= '$id'"); ?>
        <?php $result = $data->fetch_assoc(); ?>

        <div class="container">
			<div class="col-md-12">
				<form action="" method="post">
					<div class="form-group col-md-12">
			          <label for="id_kasir">id kasir</label>
			          <input type="text" class="form-control" id="id_kasir" name="id_kasir" 
			          value="<?= $result['id_kasir']; ?>" readonly>
			        </div>
			        <div class="form-group col-md-12">
			          <label for="nama">Nama</label>
			          <input type="text" class="form-control" id="nama" name="nama"
			          value="<?= $result['nama']; ?>">
			        </div>
			        <div class="form-group col-md-12">
			          <label for="username">username</label>
			          <input type="text" class="form-control" id="username" name="username"
			          value="<?= $result['username']; ?>">
			        </div>
			        <div class="form-group col-md-12">
			          <label for="password">password</label>
			          <input type="text" class="form-control" id="password" name="password"
			          value="<?= $result['password']; ?>">
			        </div>
			        <div class="form-group col-md-12">
			          <label for="level">level</label>
			          <select class="custom-select custom-select-md" id = "level" name="level">
			          	<?php $level = $result['level']; ?>
			          	<option <?php echo ($level == 'admin') ? "selected" : "" ?>>admin</option>
						<option <?php echo ($level == 'kasir') ? "selected" : "" ?>>kasir</option>
                    </select>
			        </div>
			        <div class="form-group col-md-12">
			          <button name="submit" class="btn btn-primary btn-block">Ubah</button>
			        </div>
			        
				</form>
				
			</div>
			<?php  
					if(isset($_POST['submit'])){
						$id_kasir = $_POST['id_kasir'];
						$nama = htmlspecialchars($_POST['nama']);
						$username =htmlspecialchars( $_POST['username']);
						$password = htmlspecialchars($_POST['password']);
						$level = htmlspecialchars($_POST['level']);

						$queryyy = $conn->query("UPDATE kasir SET
							username ='$username',
							nama ='$nama',
							password ='$password',
							level = '$level'

							WHERE id_kasir = '$id'");

						if ($queryyy >0) {
							echo "<script>alert('sukses');</script>";
							echo "<script>location='datakasir.php';</script>";
						}else{
							echo "<script>alert('gagal sukses');</script>";
							echo "<script>location='datakasir.php';</script>";
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