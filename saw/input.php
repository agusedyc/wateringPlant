<html>
<style type="text/css">
<title>Memasukkan Data Warga</title>
<!--
.style3 {color: #0033FF}
-->
</style>
<head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" href="css/menu.css" type="text/css" media="screen"> 
</head>

<body>
<div id="content" align="center">
<div class="body">
<div id="content" align="center">
<div class="header">
<img src="images/headernew.jpg"></div>

<div class="menu">
<ul id="nav">
        <li ><a title="Home "href="Home.php"><b><font >Home</font></b></a></li>
        <li><a title="Input Data"href="tambah.php"><b></font>Input Data</b></a></li>
		<li><a href="view.php">Lihat Data</a></li>
		<li><a href="normalisasi.php">Normalisasi</a></li>
		<li><a href="rangking.php">Rangking</a></li>
		 <li><a title=" Logout"href="logout.php"><b></font>Logout</b></a></li>
</div> <!--end: menu--></ul>
		 
		</div>
<div class="tengah">
<h1 class="style3"> Input Data Warga </h1>

<br>
<br>
<form method="post" action="input-proses.php">
<table width="494" border="0">
  <tr>
    <td width="150">Nik</td>
    <td width="10">:</td>
    <td width="300"><input name="nik1" type="text" size="25" maxlength="50" required></td>
  </tr>
  <tr>
    <td>Nama</td>
    <td>:</td>
    <td><input name="nama1" type="text" size="25" maxlength="50" required></td>
  </tr>
  <tr>
    <td>Alamat</td>
    <td>:</td>
    <td><input name="alamat1" type="text" size="25" maxlength="50" required></td>
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
	<option value="80">Lantai Tanah</option>
	<option value="50">Dinding Bambu</option>
	<option value="40">Dinding Kayu</option>
	</select>
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input name="Submit" type="submit" value="Tambah"></td>
  </tr>
</table>
</hr>
</form>

</body>
</html>