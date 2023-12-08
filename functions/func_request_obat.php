<?php 
	require 'config.php';

	// get data obat
	function getData($sql){
		global $conn;
		$res = mysqli_query($conn, $sql);
		$rows = [];
		while ($row = mysqli_fetch_assoc($res)) {
			$rows[] = $row;
		}
		return $rows;
	}

	// insert data
	function insert($data){
		global $conn;
		$nama = htmlspecialchars($data['nama']);
		$stok = htmlspecialchars($data['stok']);
		$kategory = htmlspecialchars($data['kategory']);

		$sql = "INSERT INTO request_obat VALUES(
			'','$nama','$stok','$kategory')";
		mysqli_query($conn, $sql);

		return mysqli_affected_rows($conn);
	}

	// delete data
	function delete($id){
		global $conn;
		mysqli_query($conn, "DELETE FROM request_obat WHERE id_request = $id");
		return mysqli_affected_rows($conn);
	}

	// update data
	function update($data){
		global $conn;
		$id = $data['id'];
		$nama = htmlspecialchars($data['nama']);
		$stok = htmlspecialchars($data['stok']);
		$kategory = htmlspecialchars($data['kategory']);

		$sql = "UPDATE request_obat set
					nama = '$nama',
					stok = $stok,
					kategory = '$kategory' WHERE id_request = $id
		";

		mysqli_query($conn, $sql);

		return mysqli_affected_rows($conn);
	}

	// search data
	function search($keyword){
		$sql = "SELECT * FROM request_obat WHERE
				nama LIKE '%$keyword%' OR
				stok LIKE '%$keyword%' OR
				kategory LIKE '%$keyword%'";
		return getData($sql);
	}
 ?>