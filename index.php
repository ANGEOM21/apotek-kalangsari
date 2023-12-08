<?php
session_start();
if (!isset($_SESSION['level'])) {
    header("Location: login.php");
    exit;
}

require 'functions/func_users.php';

// hitung jumlah record
$sql = "SELECT count(*) AS jumlah FROM users";
$res = mysqli_query($conn, $sql);
$jumlah = mysqli_fetch_assoc($res);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Apotek Kalang sari admin</title>

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
        <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">

            <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

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
                        if ($_SESSION['level'] == 'user') {
                            echo "user";
                        } else if ($_SESSION['level'] == 'apoteker') {
                            echo "apoteker apotek";
                        } else if ($_SESSION['level'] == 'pegawai') {
                            echo "pegawai apotek";
                        }
                        ?>
                    </a>
                </div>

                <ul class="nav">
                    <?php if ($_SESSION['level'] == 'apoteker' || $_SESSION['level'] == 'admin' || $_SESSION['level'] == 'pegawai' || $_SESSION['level'] == 'user') { ?>
                        <li class="active">
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
                    <?php if ($_SESSION['level'] == 'user') { ?>
                        <li>
                            <a href="data_masuk.php">
                                <i class="pe-7s-note2"></i>
                                <p>data obat masuk</p>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ($_SESSION['level'] == 'user') { ?>
                        <li>
                            <a href="users.php">
                                <i class="pe-7s-note2"></i>
                                <p>data obat keluar</p>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ($_SESSION['level'] == 'apoteker' || $_SESSION['level'] == 'admin' || $_SESSION['level'] == 'pegawai' || $_SESSION['level'] == 'user') { ?>
                        <li>
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
                        <a class="navbar-brand" href="#">Dashboard</a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-left">
                            <li>
                                <a href="">
                                    <i class="fa fa-search"></i>
                                    <p class="hidden-lg hidden-md">Search</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="logout.php">
                                    <p>Log out</p>
                                </a>
                            </li>
                            <li class="separator hidden-lg"></li>
                        </ul>
                    </div>
                </div>
            </nav>


            <div class="content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-md-3">
                            <div class="card" style="background-color: #ff4444;">
                                <div class="header">
                                    <h6>Stok Obat</h6>
                                    <h1 style="color: #fff;padding: 10px;">
                                        <?php $sql = "SELECT SUM(stok) AS stok FROM `obat`";
                                        $res = mysqli_query($conn, $sql);
                                        $data_stok = mysqli_fetch_assoc($res);
                                        echo $data_stok['stok'];
                                        ?>
                                    </h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card" style="background-color: #40E0D0;">
                                <div class="header">
                                    <h6>Obat Terjual</h6>
                                    <h1 style="color: #fff;padding: 10px;">
                                        <?php $sql = "SELECT SUM(jumlah_obat) AS jumlah FROM `penjualan`";
                                        $res = mysqli_query($conn, $sql);
                                        $jum_h = mysqli_fetch_assoc($res);
                                        echo $jum_h['jumlah'];
                                        ?>
                                    </h1>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card" style="background-color: #00ff7f;">
                                <div class="header">
                                    <h6>Obat Expired</h6>
                                    <h1 style="color: #fff;padding: 10px;">
                                        <?php
                                        $tgl = date("Y-m-d");
                                        $sql = " SELECT COUNT(id) AS id FROM `obat` WHERE expired <= '$tgl'";
                                        $res = mysqli_query($conn, $sql);
                                        $data_stok = mysqli_fetch_assoc($res);
                                        echo $data_stok['id'];
                                        ?>
                                    </h1>
                                </div>
                            </div>
                        </div>
                        <?php if ($_SESSION['level'] == 'admin' || $_SESSION['level'] == 'apoteker' || $_SESSION['level'] == 'pegawai') { ?>
                            <div class="col-md-3">
                                <div class="card" style="background-color: #ffa500;">
                                    <div class="header">
                                        <h6>Users <h1 style="color: #fff;padding: 10px;"><?= $jumlah['jumlah'] ?></h1>
                                        </h6>
                                    </div>

                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div> <!-- end of content -->

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
                        Repost by <a href="https://stokcoding.com/" title="StokCoding.com" target="_blank">by kelompok apotek</a> |
                        &copy; <script>
                            document.write(new Date().getFullYear())
                        </script> <a href="#">Apotek kalangsari</a>, Jl. Saptamarga, Kec. Botupingge, Desa Panggulo Barat.
                    </p>
                </div>
            </footer>

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

<?php if ($_SESSION['level'] == 'apoteker') { ?>
    <script type="text/javascript">
        $(document).ready(function() {

            demo.initChartist();

            $.notify({
                icon: 'pe-7s-stroke',
                message: "<?php
                            $periksa = mysqli_query($conn, 'SELECT * FROM obat WHERE stok <=5');
                            while ($q = mysqli_fetch_array($periksa)) {
                                if ($q['stok'] <= 5) {
                                    echo "Stok <b style='color:red;'>" . $q['nama:'] . "</b> yang tersisa sudah kurang dari 5 . silahkan request lagi !!<br><br>";
                                };
                            };
                            ?> "
            }, {
                type: 'info',
                timer: 4000
            });

        });
    </script>
<?php } ?>

</html>