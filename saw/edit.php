<!DOCTYPE html>
<html>
<head>
	<title>Edit Data Warga</title>
</head>
<body>
	<h1 class="style3"> Masukkan Data warga </h1>
	
	<h3>Edit Data Warga</h3>
	
	<?php
	//proses mengambil data ke database untuk ditampilkan di form edit berdasarkan siswa_id yg didapatkan dari GET id -> edit.php?id=siswa_id
	
	//include atau memasukkan file koneksi ke database
	include('koneksi.php');
	
	//membuat variabel $id yg nilainya adalah dari URL GET id -> edit.php?id=siswa_id
	$nik = $_GET['nik'];
	
	//melakukan query ke database dg SELECT table siswa dengan kondisi WHERE siswa_id = '$id'
	$show = mysql_query("SELECT * FROM tbl_warga, tbl_matrik WHERE tbl_matrik.nik=tbl_warga.nik and tbl_matrik.nik='$nik'");
	
	//cek apakah data dari hasil query ada atau tidak
	if(mysql_num_rows($show) == 0){
		
		//jika tidak ada data yg sesuai maka akan langsung di arahkan ke halaman depan atau beranda -> index.php
		echo '<script>window.history.back()</script>';
		
	}else{
	
		//jika data ditemukan, maka membuat variabel $data
		$data = mysql_fetch_assoc($show);	//mengambil data ke database yang nantinya akan ditampilkan di form edit di bawah
	
	}
	?>
	
	<form action="edit-proses.php" method="post">
		<table cellpadding="3" cellspacing="0">
			<tr>
				<td>NIK</td>
				<td>:</td>
				<td><input type="text" name="nik" value="<?php echo $data['nik']; ?>" required></td>	<!-- value diambil dari hasil query -->
			</tr>
			<tr>
				<td>Nama</td>
				<td>:</td>
				<td><input type="text" name="nama1" size="30" value="<?php echo $data['nama']; ?>" required></td> <!-- value diambil dari hasil query -->
			</tr>
			<tr>
				<td>Alamat</td>
				<td>:</td>
				<td><input type="text" name="alamat1" size="30" value="<?php echo $data['alamat']; ?>" required></td>
				</tr>
<tr>
    <td>Pekerjaan</td>
    <td>:</td>
    <td><select name="kriteria1_pekerjaan1" required>
	<option value="">Pilih Pekerjaan</option>
	<option value="90">Pengangguran</option>
	<option value="80">Tukang Becak</option>
	<option value="75">Penjual Gorengan</option>
	<option value="70">Penjual Buah</option>
	<option value="65">Nelayan</option>
	<option value="60">Tukang Pijet</option>
	<option value="55">Penjual Nasi</option>
	<option value="50">Supir Angkot</option>
	<option value="40">Petani</option>
	<option value="20">Penjual Sayur</option>
	<option value="10">Pembantu Rumah Tangga</option>
	</select>
	</td>
  </tr>
   <tr>
    <td>Penghasilan</td>
    <td>:</td>
    <td><select name="kriteria2_penghasilan1" required>
	<option value="">Pilih Penghasilan</option>
	<option value="90">Rp.0</option>
	<option value="80">Rp.300.000-Rp.500.000</option>
	<option value="70">Rp.350.000-Rp.500.000</option>
	<option value="65">Rp.400.000-Rp.500.000</option>
	<option value="60">Rp.400.000-Rp.800.000</option>
	<option value="55">Rp.500.000-Rp.600.000</option>
	<option value="50">Rp.500.000-Rp.700.000</option>
	<option value="40">Rp.700.000-Rp.900.000</option>
	<option value="10">Rp.800.000-Rp.1.000.000</option>
	</select>
	</td>
  </tr>
  <tr>
    <td>Jenis Rumah</td>
    <td>:</td>
    <td><select name="kriteria3_jenis_rumah1" required>
	<option value="">Pilih Jenis Rumah</option>
	<option value="90">Lantai Tanah</option>
	<option value="70">Dinding Bambu</option>
	<option value="50">Dinding Kayu</option>
	</select>
	</td>
  </tr>
				<td>&nbsp;</td>
				<td></td>
				<td><input type="submit" name="simpan" value="Simpan"></td>
			</tr>
		</table>
	</form>
</body>
</html>