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
		$harga = htmlspecialchars($data['harga']);
		$stok = htmlspecialchars($data['stok']);
		$kategory = htmlspecialchars($data['kategory']);
		$khasiat = implode(', ',$data['khasiat']);
		echo "<script>alert('$khasiat')</script>";

		$expired = htmlspecialchars($data['expired']);

		$sql = "INSERT INTO obat VALUES(
			'','$nama','$harga','$stok','$kategory','$khasiat','$expired')";
		mysqli_query($conn, $sql);

		return mysqli_affected_rows($conn);
	}

	// delete data
	function delete($id){
		global $conn;
		mysqli_query($conn, "DELETE FROM obat WHERE id = $id");
		return mysqli_affected_rows($conn);
	}

	// update data
	function update($data){
		global $conn;
		$id = $data['id'];
		$nama = htmlspecialchars($data['nama']);
		$harga = htmlspecialchars($data['harga']);
		$stok = htmlspecialchars($data['stok']);
		$kategory = htmlspecialchars($data['kategory']);
		$khasiat = implode(', ', $data['khasiat']);
		$expired = htmlspecialchars($data['expired']);

		$sql = "UPDATE obat set
					nama = '$nama',
					harga = $harga,
					stok = $stok,
					kategory = '$kategory',
					khasiat = '$khasiat',
					expired = '$expired' WHERE id = $id
		";

		mysqli_query($conn, $sql);

		return mysqli_affected_rows($conn);
	}

	// search data
	function search($keyword){
		$sql = "SELECT * FROM obat WHERE
				nama LIKE '%$keyword%' OR
				harga LIKE '%$keyword%' OR
				stok LIKE '%$keyword%' OR
				kategory LIKE '%$keyword%' OR
				khasiat LIKE '%$keyword%' OR
				expired LIKE '%$keyword%'";
		return getData($sql);
	}
 ?>