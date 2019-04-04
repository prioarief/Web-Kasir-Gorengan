<?php 
session_start();

if (($_SESSION['level'] == "")) {
    header('location:login.php');
}
else if (($_SESSION['level'] == "kasir")) {
    header('location:kasir.php');
}

require 'config.php';
$query = "SELECT max(id_kasir) as maxID FROM kasir";
$hasil = mysqli_query($conn, $query);
$data  = mysqli_fetch_assoc($hasil);
$ID = $data['maxID'];

// mengambil angka atau bilangan dalam kode anggota terbesar,
// dengan cara mengambil substring mulai dari karakter ke-1 diambil 6 karakter
// misal 'STOK001', akan diambil '001'
// setelah substring bilangan diambil lantas dicasting menjadi integer
$noUrut = (int)substr($ID, 5, 3);

// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
$noUrut++;

// membentuk kode anggota baru
// perintah sprintf("%03s", $noUrut); digunakan untuk memformat string sebanyak 3 karakter
// misal sprintf("%03s", 12); maka akan dihasilkan '012'
// atau misal sprintf("%03s", 1); maka akan dihasilkan string '001'
$char = "kasir";
$newID = $char . sprintf("%2s", $noUrut);


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
            <h3 class="text-center">Data Kasir</h3>
        </div>
        <hr>


        <!-- DataTables Example -->
        <div class="card mb-3">
            <div class="card-header">
                <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#tambahkasir">
                    Tambah kasir
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Level</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Level</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            <?php 

                            $query = $conn->query("SELECT * FROM kasir");

                            $no = 1;
                            while ($result = $query->fetch_assoc()) {



                            ?>

                            <tr>
                                <td><?= $result['nama']; ?></td>
                                <td><?= $result['username']; ?></td>
                                <td><?= $result['level']; ?></td>
                                <td>
                                    <a href="hapuskasir.php?id=<?= $result['id_kasir']; ?>" class="btn btn-danger btn-sm" onclick="return confirm ('yakin?');">Hapus kasir</a>
                                    <a href="ubahkasir.php?id=<?= $result['id_kasir']; ?>" class="btn btn-success btn-sm">Ubah Kasir</a>
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

    <!-- Modal tambah kasir -->
    <div class="modal fade" id="tambahkasir" tabindex="-1" role="dialog" aria-labelledby="tambahkasirLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="tambahkasirLabel">Tambah kasir</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="form-group col-md-12">
                            <label for="id_kasir">id kasir</label>
                            <input type="text" class="form-control" id="id_kasir" name="id_kasir" value="<?= $newID; ?>">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="username">username</label>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="password">password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="level">level</label>
                            <select class="custom-select custom-select-md" id="level" name="level">
                                <option selected>Pilih level</option>
                                <option value="admin">admin</option>
                                <option value="kasir">kasir</option>
                            </select>
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

    <!-- akhir modal tambah kasir -->
    <?php 
    if (isset($_POST['submit'])) {
      $id_kasir = htmlspecialchars($_POST['id_kasir']);
      $nama = htmlspecialchars($_POST['nama']);
      $username = htmlspecialchars($_POST['username']);
      $password = htmlspecialchars($_POST['password']);
      $level = htmlspecialchars($_POST['level']);

      if (empty($id_kasir) || empty($nama) || empty($username) || empty($password) || empty($level)) {
        echo "<script>alert('mohon di isi semua');</script>";
        echo "<script>location='datakasir.php';</script>";
        return false;
      }

      $queryyy = $conn->query("INSERT INTO kasir VALUES ('$id_kasir','$username','$nama',
              '$password','$level')");

      if ($queryyy > 0) {
        echo "<script>alert('sukses');</script>";
        echo "<script>location='datakasir.php';</script>";
      } else {
        echo "<script>alert('gagal sukses');</script>";
        echo "<script>location='datakasir.php';</script>";
      }
    }

    ?>

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