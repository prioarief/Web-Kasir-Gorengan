<?php 
session_start();
if (($_SESSION['level'] == "")) {
    header('location:login.php');
}

require 'config.php';
$id = $_GET['id'];


$query = $conn->query("SELECT * FROM gorengan WHERE id_gorengan = '$id'");
$result = $query->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Transaksi Penjualan</title>

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
        <h1 class="text-center">Transaksi Gorengan</h1>
        <div class="container">
            <div class="col-md-12">
                <form action="" method="post">

                    <div class="form-group col-md-12">
                        <label for="gorengan">Gorengan</label>
                        <input type="text" class="form-control" id="gorengan" name="gorengan" value="<?= $result['gorengan']; ?>" readonly>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="stok">stok</label>
                        <input type="text" class="form-control" id="stok" name="stok" value="<?= $result['stok']; ?>" readonly>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="harga">harga</label>
                        <input type="text" class="form-control" id="harga" name="harga" value="<?= $result['harga']; ?>" readonly>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="jumlah">jumlah</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="jumlah beli " min="0" max="<?= $result['stok'] ?>" autofocus required>
                    </div>
                    <div class="form-group col-md-12 text-center">
                        <button class="btn btn-primary btn-block" name="proses">Proses</button>
                    </div>
                    <div class="form-group col-md-12 text-center">
                        <a class="btn btn-primary btn-block" href="index.php">Batal</a>
                    </div>

                </form>
                <?php 

                if (isset($_POST['proses'])) {
                    $jumlah = $_POST['jumlah'];
                    $jumlahh = (int)$jumlah;
                    if ($jumlahh <= 1 || $jumlahh > $result['stok']) {
                        echo "<script>alert('Produk gagal masuk ke keranjang belanja');</script>";
                        echo "<script>location='transaksi.php?id=$id';</script>";
                        return false;
                    }
                    $_SESSION["belanja"][$id] = $jumlahh;
                    echo "<script>alert('Produk telah masuk ke keranjang belanja');</script>";
                    echo "<script>location='keranjang.php';</script>";
                }

                ?>
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