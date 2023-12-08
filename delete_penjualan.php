<?php 
    session_start();
    if(!isset($_SESSION['level'])){
        header("Location: login.php");
        exit;
    }
	require 'functions/func_penjualan.php';
	$id = $_GET['id'];
	if (delete($id) > 0) {
		header("Location:penjualan.php");
	} else {
		echo "<script>alert('Ada yang salah!!!');</script>";
	}
 ?>