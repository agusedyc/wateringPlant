<html>
<title>Melihat Data Warga</title>
<style type="text/css">
<!--
.style2 {font-size: 24px}
-->
</style>
<head>
	<link rel="stylesheet" type="text/css" href="assets/css/jquery.dataTables.css">
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" href="css/menu.css" type="text/css" media="screen"> 
	<script type="text/javascript" src="assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
</head>
<script>
    $(document).ready(function() {
	   $('#example').DataTable();
	} );
	</script>
<body>
<div id="content" align="center">
<div class="body">
<div id="content" align="center">
<div class="header">
<img src="images/headernew.jpg"></div>
<div class="menu">
<ul id="nav">
        <li ><a title="Home "href="home.php"><b><font >Home</font></b></a></li>
		<li><a href="input.php">Input Data</a></li>
		<li><a href="view.php">Lihat Data</a></li>
		<li><a href="normalisasi.php">Normalisasi</a></li>
		<li><a href="rangking.php">Rangking</a></li>
		<li><a href="index.php">Logout</a></li>
</ul><br><br>
		
<h1> Daftar Nama Calon Penerima Raskin </h1>
	<table id='example' class='display' cellspacing='0' width='100%'>
		<thead>
		<tr bgcolor="#CCCCCC">
			<th>No.</th>
			<th>NIK</th>
			<th>Nama</th>
			<th>Bobot Pekerjaan</th>
			<th>Bobot Penghasilan</th>
			<th>Bobot Jenis Rumah</th>
			<th>Aksi</th>
		</tr>
		</thead>
		<?php
		//iclude file koneksi ke database
		include('koneksi.php');
		
		//query ke database dg SELECT table siswa diurutkan berdasarkan NIS paling besar
		$query = mysql_query("SELECT * FROM tbl_warga, tbl_matrik where tbl_matrik.nik=tbl_warga.nik order by tbl_matrik.nik asc") or die(mysql_error());
		
		//cek, apakakah hasil query di atas mendapatkan hasil atau tidak (data kosong atau tidak)
		if(mysql_num_rows($query) == 0){	//ini artinya jika data hasil query di atas kosong
			
			//jika data kosong, maka akan menampilkan row kosong
			echo '<tr><td colspan="7">Tidak ada data!</td></tr>';
			
		}else{	//else ini artinya jika data hasil query ada (data diu database tidak kosong)
			
			//jika data tidak kosong, maka akan melakukan perulangan while
			$no = 1;	//membuat variabel $no untuk membuat nomor urut
			while($data = mysql_fetch_assoc($query)){	//perulangan while dg membuat variabel $data yang akan mengambil data di database
				
				//menampilkan row dengan data di database
				echo '<tr>';
					echo '<td align="center">'.$no.'</td>';	//menampilkan nomor urut
					echo '<td>'.$data['nik'].'</td>';	//menampilkan data nis dari database
					echo '<td>'.$data['nama'].'</td>';	//menampilkan data nama lengkap dari database
					echo '<td align="center">'.$data['kriteria1_pekerjaan'].'</td>';	//menampilkan data kelas dari database
					echo '<td align="center">'.$data['kriteria2_penghasilan'].'</td>';	//menampilkan data jurusan dari database
					echo '<td align="center">'.$data['kriteria3_jenis_rumah'].'</td>';
					echo '<td>
					<a href="edit.php?nik='.$data['nik'].'">Edit</a> | 
					<a href="hapus.php?nik='.$data['nik'].'">Hapus</a> 
					</td>';
				

					
				
				$no++;	//menambah jumlah nomor urut setiap row
				
			}
			
		}
		?>
	</table>
</body>
</html>