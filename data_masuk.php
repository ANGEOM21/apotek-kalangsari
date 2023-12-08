<?php 
    session_start();
    if(!isset($_SESSION['level'])){
        header("Location: login.php");
        exit;
    }

    require 'functions/func_users.php';
    $data_users = getData("SELECT * FROM users ORDER BY id DESC");

    if (isset($_POST['submit'])){
        if (insert($_POST) > 0) {
            header("Location:users.php");
        }else {
            echo "<script>alert('Ada yang salah!!!');</script>";
        }
    }

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

	<title>Apotek KalangSari Admin</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="azure" data-image="assets/img/sidebar-5.jpg">

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
            <?php if($_SESSION['level'] == 'apoteker' || $_SESSION['level'] == 'admin' || $_SESSION['level'] == 'pegawai') { ?>
                <li>
                    <a href="dashboard.php">
                        <i class="pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
            <?php } ?>
            <?php if($_SESSION['level'] == 'admin') { ?>
                <li class="active">
                    <a href="users.php">
                        <i class="pe-7s-user"></i>
                        <p>Users</p>
                    </a>
                </li>
            <?php } ?>
            <?php if($_SESSION['level'] == 'apoteker' || $_SESSION['level'] == 'admin' || $_SESSION['level'] == 'pegawai') { ?>
                <li>
                    <a href="obat.php">
                        <i class="pe-7s-note2"></i>
                        <p>Data Obat</p>
                    </a>
                </li>
            <?php } ?>
            <?php if($_SESSION['level'] == 'pegawai' || $_SESSION['level'] == 'admin') { ?>
                <li>
                    <a href="penjualan.php">
                        <i class="pe-7s-note2"></i>
                        <p>Data Penjualan</p>
                    </a>
                </li>
            <?php } ?>
            <?php if($_SESSION['level'] == 'pegawai') { ?>
                <li>
                    <a href="laporan.php">
                        <i class="pe-7s-news-paper"></i>
                        <p>Laporan</p>
                    </a>
                </li>
            <?php } ?>
            <?php if($_SESSION['level'] == 'apoteker' || $_SESSION['level'] == 'admin') { ?>
                <li>
                    <a href="request_obat.php">
                        <i class="pe-7s-note2"></i>
                        <p>Data obat expired</p> <?php /// buat button print ?>
                    </a>
                </li>
            <?php } ?>
            <?php if($_SESSION['level'] == 'apoteker') { ?>
                <li>
                    <a href="penjualan_obat_narkotika.php">
                        <i class="pe-7s-note2"></i>
                        <p>Penjualan Obat Narkotika</p> <?php /// buat button laporan BNN ?>
                    </a>
                </li>
            <?php } ?>
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
                    <a class="navbar-brand" href="#">Data Masuk</a>
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
						<li class="separator hidden-lg hidden-md"></li>
                    </ul>
                </div>
            </div>
        </nav>


        <!-- disini isi dengan data users -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h5><b> <?php echo "Jumlah Data Masuk: " . $jumlah['jumlah']; ?></b></h5>
                        <div class="card">
                            <div class="header">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span>Tambah</button>
                                
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>No.</th>
                                        <th>Nama Lengkap</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Level</th>
                                        <th>Aksi</th>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($data_users as $data) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $data['nama_lengkap'] ?></td>
                                            <td><?= $data['username'] ?></td>
                                            <td><?= $data['password'] ?></td>
                                            <td><?= $data['level'] ?></td>
                                            <td>
                                                <a href="update_users.php?id=<?= $data['id'] ?>" class="btn btn-warning">Update</a>
                                                <a href="delete_users.php?id=<?= $data['id'] ?>" class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus data ini?');">Delete</a>
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
                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="#">Apotek kalangsari</a>, Jl. Saptamarga, Kec. Botupingge, Desa Panggulo Barat.
                </p>
            </div>
        </footer>

    </div>
</div>

<!-- modal input -->
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Tambah Users Baru</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input name="nama_lengkap" type="text" class="form-control" placeholder="Nama Lengkap .." autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input name="username" type="text" class="form-control" placeholder="Username .." autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input name="password" type="password" class="form-control" placeholder="Password .." autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Level</label>
                        <select name="level" class="form-control">
                            <option disabled>-- Level Users --</option>
                            <option>Admin</option>
                            <option>Apoteker</option>
                            <option>Pegawai</option>
                        </select>
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
