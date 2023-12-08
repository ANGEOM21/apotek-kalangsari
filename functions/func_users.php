<?php 
	require 'config.php';

	// get data users
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
		$nama_lengkap = htmlspecialchars($data['nama_lengkap']);
		$username = htmlspecialchars($data['username']);
		$password = htmlspecialchars($data['password']);
		$level = htmlspecialchars($data['level']);
		$pass = md5($password);
		// enkripsi password
		// $password = password_hash($password, PASSWORD_DEFAULT);

		$sql = "INSERT INTO users VALUES(
			'','$nama_lengkap','$username','$pass','$level')";
		mysqli_query($conn, $sql);

		return mysqli_affected_rows($conn);
	}

	// delete data
	function delete($id){
		global $conn;
		mysqli_query($conn, "DELETE FROM users WHERE id = $id");
		return mysqli_affected_rows($conn);
	}

	// update data
	function update($data){
		global $conn;
		$id = $data['id'];
		$nama_lengkap = htmlspecialchars($data['nama_lengkap']);
		$username = htmlspecialchars($data['username']);
		$password = htmlspecialchars($data['password']);
		$level = htmlspecialchars($data['level']);
		$pass = md5($password);

		$sql = "UPDATE users set
					nama_lengkap = '$nama_lengkap',
					username = '$username',
					password = '$pass',
					level = '$level' WHERE id = $id
		";

		mysqli_query($conn, $sql);

		return mysqli_affected_rows($conn);
	}
 ?>