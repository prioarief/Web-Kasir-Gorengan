<?php
session_start();
include '../system/config.php';


if (empty($_SESSION['belanja'])) {
    echo "<script>alert('keranjang kosong, silahkan belanja dahulu');</script>";
    echo "<script>location='../index.php';</script>";
}


$query = "SELECT max(id_transaksi) as maxID FROM transaksi";
$hasil = mysqli_query($conn, $query);
$data  = mysqli_fetch_assoc($hasil);
$ID = $data['maxID'];

// mengambil angka atau bilangan dalam kode anggota terbesar,
// dengan cara mengambil substring mulai dari karakter ke-1 diambil 6 karakter
// misal 'TR001', akan diambil '001'
// setelah substring bilangan diambil lantas dicasting menjadi integer
$noUrut = (int)substr($ID, 2, 3);

// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
$noUrut++;

// membentuk kode anggota baru
// perintah sprintf("%03s", $noUrut); digunakan untuk memformat string sebanyak 3 karakter
// misal sprintf("%03s", 12); maka akan dihasilkan '012'
// atau misal sprintf("%03s", 1); maka akan dihasilkan string '001'
$char = "TR";
$newID = $char . sprintf("%03s", $noUrut);
$kasir = $_SESSION['id'];
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
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin.css" rel="stylesheet">

</head>

<body>

    <?php include '../system/menu.php'; ?>

    <div id="content-wrapper">
        <h1 class="text-center">Keranjang Transaksi Gorengan</h1>

        <div class="container">
            <table class="table table-light table-striped table-bordered table-responsive-md mt-5 text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gorengan</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Sub Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $nomor = 1;
                    $totalharga = 0;
                    foreach ($_SESSION['belanja'] as $id => $jumlah) :

                        $gorengan = $conn->query("SELECT * FROM gorengan WHERE id_gorengan = '$id'");
                        $pecah = $gorengan->fetch_assoc();



                        ?>
                        <tr>
                            <td><?= $nomor; ?></td>
                            <td><?= $pecah['gorengan']; ?></td>
                            <td>Rp. <?= number_format($pecah['harga']); ?></td>
                            <td><?= $jumlah; ?></td>
                            <?php $sub = $pecah['harga'] * $jumlah; ?>
                            <td>Rp. <?= number_format($sub); ?></td>

                            <td>
                                <a href="hapuskeranjang.php?id=<?= $pecah['id_gorengan']; ?>" class="text-center">
                                    <i class="fas fa-fw fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                        <?php $nomor++; ?>
                        <?php $totalharga += $sub; ?>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" class="text-left"><b>Total Harga + PPN 5%</b></td>
                        <?php $pajak = $totalharga * 0.05; ?>
                        <?php $hargatotal = $totalharga + $pajak; ?>
                        <td>Rp. <?= number_format($hargatotal); ?></td>
                    </tr>
                </tfoot>
            </table>
            <form action="" method="post">

                <div class="form-group col-md-12">
                    <label for="id_transaksi"><b>id_transaksi</b></label>
                    <input type="text" class="form-control" id="id_transaksi" name="id_transaksi" value="<?= $newID; ?>">
                </div>
                <div class="form-group col-md-12">
                    <label for="bayar"><b>Bayar</b></label>
                    <input type="number" class="form-control" id="bayar" name="bayar" required autofocus>
                </div>

                <div class="form-group col-md-12">
                    <a href="../index.php" class="btn btn-primary btn-block">Tambah Gorengan</a>
                </div>

                <div class="form-group col-md-12">
                    <button class="btn btn-primary btn-block" name="checkout">Checkout</button>
                </div>


            </form>
            <?php
            if (isset($_POST['checkout'])) {
                $_SESSION['bayar'] = $_POST['bayar'];
                if ($_SESSION['bayar'] < $hargatotal) {
                    echo "<script>alert('bayarnya kurang');</script>";
                    echo "<script>location = keranjang.php;</script>";
                    return false;
                }
                $kembalian = $bayar - $hargatotal;
                date_default_timezone_set('Asia/Jakarta');
                $tanggal = date('d-m-Y H:i:s');
                $tanggall = date('Y-m-d');




                // menyimpan data transaksi ke table pembelian
                $conn->query("INSERT INTO transaksi VALUES ('$newID','$kasir','$tanggal','$hargatotal')");




                foreach ($_SESSION['belanja'] as $id => $jumlah) {
                    $conn->query("INSERT INTO detail_transaksi VALUES ('','$newID','$id','$jumlah')");
                }
                echo "<script>alert('sukses');</script>";
                echo "<script>location='detailtransaksi.php?id=" . $newID . "';</script>";

                // bersihkan keranjang
                unset($_SESSION['belanja']);
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