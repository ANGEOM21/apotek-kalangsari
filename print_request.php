<?php 
	session_start();
    if(!isset($_SESSION['level'])){
        header("Location: login.php");
        exit;
    }
    require 'functions/config.php';

	require_once __DIR__ . '/vendor/autoload.php';
	require 'functions/func_request_obat.php';

	$mpdf = new \Mpdf\Mpdf();

	$html = '<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Request Obat</title>
		<style>
			body {
				font-family: arial;
			}
			tr:nth-child(even){
				background-color: #ddd;
			}
		</style>
	</head>
	<body>
	<h2>Request Obat Apotek</h2>
		<table border="1" cellspacing="0" cellpadding="8">
			<tr>
				<th>No</th>
		        <th>Nama</th>
		        <th>Stok</th>
		        <th>Kategory</th>
	     	</tr>';

	  $i = 1;
      $sql = "SELECT * FROM request_obat ORDER BY nama ASC";
      $res = mysqli_query($conn, $sql);
     while($data = mysqli_fetch_assoc($res)) {

     	$html .= '<tr>
                <td>' . $i . '</td>
                <td>' . $data['nama'] . '</td>
                <td>' . $data['stok'] . '</td>
                <td>' . $data['kategory'] . '</td>
			</tr>';	$i++;
     }

      $html .= '</table>
	</body>
	</html>';

	$mpdf->WriteHTML($html);
	$mpdf->Output('docs_request_obat.pdf', 'I');
 ?>