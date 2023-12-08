<?php 
	require 'config.php';

	// insert data
	function insert($data){
		global $conn;
		$obat = $data['obat'];
		$jumlah = htmlspecialchars($data['jumlah']);

		$sql = "INSERT INTO `penjualan` (`id_penjualan`, `id_obat`, `tanggal`, `jumlah_obat`) VALUES ('', '$obat', CURRENT_TIMESTAMP, '$jumlah');";
		mysqli_query($conn, $sql);

		return mysqli_affected_rows($conn);
	}

	// // delete data
	function delete($id){
		global $conn;
		mysqli_query($conn, "DELETE FROM penjualan WHERE id_penjualan = $id");
		return mysqli_affected_rows($conn);
	}

	// // update data
	// function update($data){
	// 	global $conn;
	// 	$id = $data['id'];
	// 	$tanggal = htmlspecialchars($data['tanggal']);
	// 	$obat = htmlspecialchars($data['obat']);
	// 	$jumlah = htmlspecialchars($data['jumlah']);

	// 	$sql = "UPDATE penjualan set
	// 				tanggal = '$tanggal',
	// 				obat = $obat,
	// 				jumlah = $jumlah WHERE id = $id
	// 	";

	// 	mysqli_query($conn, $sql);

	// 	return mysqli_affected_rows($conn);
	// }

	// // search data
	// function search($keyword){
	// 	$sql = "SELECT * FROM penjualan WHERE
	// 			tanggal LIKE '%$tanggal%' OR
	// 			obat LIKE '%$obat%' OR
	// 			jumlah LIKE '%$jumlah%'";
	// 	return getData($sql);
	// }
 ?>

