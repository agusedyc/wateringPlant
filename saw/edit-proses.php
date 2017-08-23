<?php
//mulai proses edit data

//cek dahulu, jika tombol simpan di klik
if(isset($_POST['simpan'])){
	
	//inlcude atau memasukkan file koneksi ke database
	include('koneksi.php');
	
	//jika tombol tambah benar di klik maka lanjut prosesnya
	$nik=$_POST['nik'];
	$nama1=$_POST['nama1'];
	$alamat1=$_POST['alamat1'];
	$kriteria1_pekerjaan1=$_POST['kriteria1_pekerjaan1'];
	$kriteria2_penghasilan1=$_POST['kriteria2_penghasilan1'];
	$kriteria3_jenis_rumah1=$_POST['kriteria3_jenis_rumah1'];	//membuat variabel $jurusan dan datanya dari inputan dropdown Jurusan
	
	//melakukan query dengan perintah UPDATE untuk update data ke database dengan kondisi WHERE siswa_id='$id' <- diambil dari inputan hidden id
	$update = mysql_query("UPDATE tbl_matrik SET kriteria1_pekerjaan='$kriteria1_pekerjaan1', kriteria2_penghasilan='$kriteria2_penghasilan1',kriteria3_jenis_rumah='$kriteria3_jenis_rumah1' WHERE nik='$nik'") or die(mysql_error());

	$update1 = mysql_query("UPDATE tbl_warga SET nama='$nama1', alamat='$alamat1' WHERE nik='$nik'") or die(mysql_error());
	
	//jika query update sukses
	if($update && $update1){
		
		echo 'Data berhasil di simpan! ';		//Pesan jika proses simpan sukses
		echo '<a href="view.php">Kembali</a>';	//membuat Link untuk kembali ke halaman edit
		
	}else{
		
		echo 'Gagal menyimpan data! ';		//Pesan jika proses simpan gagal
		echo '<a href="edit.php?id='.$id.'">Kembali</a>';	//membuat Link untuk kembali ke halaman edit
		
	}

}else{	//jika tidak terdeteksi tombol simpan di klik

	//redirect atau dikembalikan ke halaman edit
	echo '<script>window.history.back()</script>';

}
?>