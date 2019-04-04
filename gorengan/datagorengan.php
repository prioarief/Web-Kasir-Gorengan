<?php 
session_start();

if (($_SESSION['level'] == "")) {
  header('location:../login.php');
}

require '../system/config.php';
$query = "SELECT max(id_gorengan) as maxID FROM gorengan";
$hasil = mysqli_query($conn, $query);
$data  = mysqli_fetch_assoc($hasil);
$ID = $data['maxID'];

// mengambil angka atau bilangan dalam kode anggota terbesar,
// dengan cara mengambil substring mulai dari karakter ke-1 diambil 6 karakter
// misal 'GRG001', akan diambil '001'
// setelah substring bilangan diambil lantas dicasting menjadi integer
$noUrut = (int)substr($ID, 3, 3);

// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
$noUrut++;

// membentuk kode anggota baru
// perintah sprintf("%03s", $noUrut); digunakan untuk memformat string sebanyak 3 karakter
// misal sprintf("%03s", 12); maka akan dihasilkan '012'
// atau misal sprintf("%03s", 1); maka akan dihasilkan string '001'
$char = "GRG";
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
        <div class="col-sm-12">
            <h3 class="text-center">List Gorengan</h3>
        </div>
        <hr>


        <!-- DataTables Example -->
        <div class="card mb-3">
            <div class="card-header">
                <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#tambahgorengan">
                    Tambah Gorengan
                </button>
            </div>
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
                                <th>Gorengan</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            <?php 
                            $query = $conn->query("SELECT * FROM gorengan");
                            while ($result = $query->fetch_assoc()) {


                              ?>

                            <tr>
                                <td><?= $result['gorengan']; ?></td>
                                <td><?= $result['harga']; ?></td>
                                <td><?= $result['stok']; ?></td>
                                <td class="text-center">
                                    <a href="tambahstokgorengan.php?id=<?= $result['id_gorengan']; ?>" class="btn btn-primary btn-sm mb-2">Tambah Stok</a>
                                    <a href="hapusgorengan.php?id=<?= $result['id_gorengan']; ?>" class="btn btn-danger btn-sm mb-2" onclick="return confirm ('yakin?');">Hapus</a>
                                    <a href="ubahgorengan.php?id=<?= $result['id_gorengan']; ?>" class="btn btn-success btn-sm mb-2">Ubah</a>
                                </td>
                            </tr>

                            <?php 
                          } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
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

<!-- Modal tambah gorengan -->
<div class="modal fade" id="tambahgorengan" tabindex="-1" role="dialog" aria-labelledby="tambahgorenganLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="tambahgorenganLabel">Tambah Gorengan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group col-md-12">
                        <label for="id_gorengan">id gorengan</label>
                        <input type="text" class="form-control" id="id_gorengan" name="id_gorengan" value="<?= $newID; ?>" readonly>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="gorengan">gorengan</label>
                        <input type="text" class="form-control" id="gorengan" name="gorengan">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="harga">harga</label>
                        <input type="number" class="form-control" id="harga" name="harga">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="stok">stok</label>
                        <input type="number" class="form-control" id="stok" name="stok">
                    </div>



            </div>
            <div class="modal-footer">
                <input type="reset" value="reset" class="btn btn-secondary">
                <button name="submit" class="btn btn-dark">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- akhir modal tambah gorengan -->

</html>
<?php 
if (isset($_POST['submit'])) {
  $id_gorengan = htmlspecialchars($_POST['id_gorengan']);
  $gorengan = htmlspecialchars($_POST['gorengan']);
  $harga = htmlspecialchars($_POST['harga']);
  $stok = htmlspecialchars($_POST['stok']);

  if (empty($id_gorengan) || empty($gorengan) || empty($harga) || empty($stok)) {
    echo "<script>alert('mohon di isi semua');</script>";
    echo "<script>location='datagorengan.php';</script>";
    return false;
  }


  $queryyy = $conn->query("INSERT INTO gorengan VALUES ('$id_gorengan','$gorengan','$harga',
              '$stok')");

  if ($queryyy > 0) {
    echo "<script>alert('sukses');</script>";
    echo "<script>location='datagorengan.php';</script>";
  } else {
    echo "<script>alert('gagal sukses');</script>";
    echo "<script>location='datagorengan.php';</script>";
  }
}

?> 