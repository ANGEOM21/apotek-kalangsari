<?php
session_start();
if (!isset($_SESSION['level'])) {
    header("Location: login.php");
    exit;
}
require 'functions/func_obat.php';
$data_obat = getData("SELECT * FROM obat ORDER BY id DESC");

// button search ditekan
if (isset($_POST['search'])) {
    $data_obat = search($_POST['keyword']);
}

if (isset($_POST['submit'])) {
    if (insert($_POST) > 0) {
        header("Location:obat.php");
    } else {
        echo "<script>alert('Ada yang salah!!!');</script>";
    }
}
// hitung jumlah record
$sql = "SELECT count(*) AS jumlah FROM obat";
$res = mysqli_query($conn, $sql);
$jumlah = mysqli_fetch_assoc($res);


$tipe_obat = [
    ["Batuk" => "batuk"],
    ["Flu" => "flu"],
    ["Pusing" => "pusing"],
    ["Sakit Kepala" => "sakit kepala"],
    ["Mual" => "mual"],
    ["Diare" => "diare"],
    ["Masuk Angin" => "masuk angin"],
    ["Mag" => "mag"],
    ["Sakit Perut" => "sakit perut"],
    ["Sakit Badan" => "sakit badan"],
    ["Penenang" => "penenang"],
    ["Panas" => "panas"],
    ["Darah Tinggi" => "darah tinggi"],
    ["Kolestrol" => "kolestrol"],
    ["Diabetes" => "diabetes"],
    ["Malaria" => "malaria"]
]

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Apotek kalangsari</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet" />

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet" />


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
</head>

<body>

    <div class="wrapper">
        <div class="sidebar" data-color="green" data-image="assets/img/sidebar-5.jpg">

            <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="#" class="simple-text">
                        <?php
                        if ($_SESSION['level'] == 'admin') {
                            echo "admin apotek";
                        } else if ($_SESSION['level'] == 'apoteker') {
                            echo "apoteker apotek";
                        } else if ($_SESSION['level'] == 'pegawai') {
                            echo "pegawai apotek";
                        }
                        ?>
                    </a>
                </div>

                <ul class="nav">
                    <?php if ($_SESSION['level'] == 'apoteker' || $_SESSION['level'] == 'admin' || $_SESSION['level'] == 'pegawai') { ?>
                        <li>
                            <a href="index.php">
                                <i class="pe-7s-graph"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ($_SESSION['level'] == 'admin') { ?>
                        <li>
                            <a href="users.php">
                                <i class="pe-7s-user"></i>
                                <p>Users</p>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ($_SESSION['level'] == 'apoteker' || $_SESSION['level'] == 'admin' || $_SESSION['level'] == 'pegawai') { ?>
                        <li class="active">
                            <a href="obat.php">
                                <i class="pe-7s-note2"></i>
                                <p>Data Obat</p>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ($_SESSION['level'] == 'pegawai' || $_SESSION['level'] == 'admin') { ?>
                        <li>
                            <a href="penjualan.php">
                                <i class="pe-7s-note2"></i>
                                <p>Data Penjualan</p>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ($_SESSION['level'] == 'pegawai') { ?>
                        <li>
                            <a href="laporan.php">
                                <i class="pe-7s-news-paper"></i>
                                <p>Laporan</p>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ($_SESSION['level'] == 'apoteker' || $_SESSION['level'] == 'admin') { ?>
                        <li>
                            <a href="request_obat.php">
                                <i class="pe-7s-note2"></i>
                                <p>Data obat expired</p> <?php /// buat button print 
                                                            ?>
                            </a>
                        </li>
                    <?php } ?>
                    <?php //if($_SESSION['level'] == 'apoteker') { 
                    ?>
                    <!-- <li>
                    <a href="penjualan_obat_narkotika.php">
                        <i class="pe-7s-note2"></i>
                        <p>Penjualan Obat Narkotika</p>
                    </a>
                </li> -->
                    <?php //} 
                    ?>
                </ul>
            </div>
        </div>

        <div class="main-panel">
            <nav class="navbar navbar-default navbar-fixed">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">Data Obat</a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-left">
                            <li>
                                <form action="" method="post">
                                    <div class="form-group">
                                        <input type="text" size="30" name="keyword" autocomplete="off" autofocus placeholder="Cari Obat..">
                                        <button type="submit" name="search" class="btn btn-default">Search</button>
                                    </div>
                                </form>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="logout.php">
                                    <p>Log out</p>
                                </a>
                            </li>
                            <li class="separator hidden-lg hidden-md"></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <h5><b> <?php echo "Jumlah Data Obat: " . $jumlah['jumlah']; ?></b></h5>
                            <p style="color: red;font-size: 10px;">* Warna merah pada expired, menandakan obat sudah expired!</p>
                            <div class="card">
                                <div class="header">
                                    <?php if ($_SESSION['level'] == 'apoteker' || $_SESSION['level'] == 'admin') { ?>
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span>Tambah</button>
                                    <?php } ?>
                                </div>
                                <div class="content table-responsive table-full-width">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>Harga</th>
                                            <th>Stok</th>
                                            <th>Kategory</th>
                                            <th>Khasiat</th>
                                            <th>Expired</th>
                                            <?php if ($_SESSION['level'] == 'apoteker' || $_SESSION['level'] == 'admin') { ?>
                                                <th>Aksi</th>
                                            <?php } ?>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            $tgl = date("Y-m-d");
                                            ?>
                                            <?php foreach ($data_obat as $data) : ?>
                                                <tr>
                                                    <td><?= $i; ?></td>
                                                    <td><?= $data['nama'] ?></td>
                                                    <td>Rp.<?= $data['harga'] ?></td>
                                                    <td><?= $data['stok'] ?></td>
                                                    <td><?= $data['kategory'] ?></td>
                                                    <td><?= $data['khasiat'] ?></td>
                                                    <?php if ($data['expired'] <= $tgl) { ?>
                                                        <td style="color: red;"><?= $data['expired'] ?></td>
                                                    <?php } else { ?>
                                                        <td><?= $data['expired'] ?></td>
                                                    <?php } ?>
                                                    <td>
                                                        <?php if ($_SESSION['level'] == 'apoteker' || $_SESSION['level'] == 'admin') { ?>
                                                            <a href="update_obat.php?id=<?= $data['id'] ?>" class="btn btn-warning">Update</a> <?php } ?>
                                                        <?php if ($_SESSION['level'] == 'apoteker' || $_SESSION['level'] == 'admin') { ?>
                                                            <a href="delete_obat.php?id=<?= $data['id'] ?>" class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus data ini?');">Delete</a> <?php } ?>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            <?php endforeach; ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="footer">
                <div class="container-fluid">
                    <nav class="pull-left">
                        <ul>
                            <li>
                                <a href="#">
                                    Home
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <p class="copyright pull-right">
                        &copy; <script>
                            document.write(new Date().getFullYear())
                        </script> <a href="#">Apotek kalangsari</a>, Jl. Saptamarga, Kec. Botupingge, Desa Panggulo Barat.
                    </p>
                </div>
            </footer>


        </div>
    </div>

    <!-- modal input -->
    <div id="myModal" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Tambah Obat Baru</h4>
                </div>
                <div class="modal-body">
                    <form action="" method="post" class="mx-2">
                        <div class="form-group">
                            <label>Nama</label>
                            <input name="nama" type="text" class="form-control" placeholder="Nama Obat .." autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label>Harga</label>
                            <input name="harga" type="text" class="form-control" placeholder="Harga Obat .." autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label>Stok</label>
                            <input name="stok" type="text" class="form-control" placeholder="Stok Obat .." autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label>Kategory</label>
                            <select name="kategory" class="form-control" required>
                                <option disabled>-- Pilih Kategory --</option>
                                <option>Obat Bebas</option>
                                <option>Obat Bebas Terbatas</option>
                                <option>Obat Keras</option>
                                <option>Jamu</option>
                                <option>Obat Herbal Terstandar</option>
                                <option>Fitofarmaka</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <div style="display: flex; align-items: center; flex-wrap: wrap; justify-content: flex-start; gap: 10px;">
                                <?php foreach ($tipe_obat as $tipe) { ?>
                                    <?php foreach ($tipe as $k => $v) { ?>
                                        <div class="form-check" style="margin-right: 10px;">
                                            <input class="form-check-input" type="checkbox" value="<?= $v ?>" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                <?= $k ?>
                                            </label>
                                        </div>
                                    <?php }; ?>
                                <?php }; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Expired</label>
                            <input name="expired" type="date" class="form-control" placeholder="Tanggal Expired .." required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
                </div>
                </form>
            </div>
        </div>
    </div>

</body>

<!--   Core JS Files   -->
<script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Charts Plugin -->
<script src="assets/js/chartist.min.js"></script>

<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>

<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>


</html>