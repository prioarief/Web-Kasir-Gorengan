<?php 
session_start();
if (($_SESSION['level'] == "")) {
    header('location:../login.php');
}

require '../system/config.php';


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
            <h3 class="text-center">Riwayat Transaksi</h3>
        </div>
        <hr>


        <!-- DataTables Example -->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Riwayat Transaksi</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id Transaksi</th>
                                <th>Id Kasir</th>
                                <th>Tanggal</th>
                                <th>Total Harga</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Id Transaksi</th>
                                <th>Id Kasir</th>
                                <th>Tanggal</th>
                                <th>Total Harga</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            <?php 

                            $query = $conn->query("SELECT * FROM transaksi");

                            $no = 1;
                            while ($result = $query->fetch_assoc()) {

                                ?>

                            <tr>
                                <td><?= $result['id_transaksi']; ?></td>
                                <td><?= $result['id_kasir']; ?></td>
                                <td><?= $result['tanggal']; ?></td>
                                <td>Rp.<?= number_format($result['totalharga']); ?></td>
                                <td class="text-center">
                                    <a href="detailtransaksi.php?id=<?= $result['id_transaksi']; ?>" class="btn btn-primary btn-sm">Detail</a>
                                    <a href="hapustransaksi.php?id=<?= $result['id_transaksi']; ?>" class="btn btn-danger btn-sm">Hapus</a>
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

</html> 