<?php

$link = mysqli_connect('localhost','root','');
if ($link)
   {   
   echo "Koneksi dengan MySQL : OK ... <br><br>";
   }
else
   {
     die("Koneksi dengan MySQL gagal");
   };

$hapus = mysqli_query($link,"DROP DATABASE login");
if ($hapus)
    {
    echo "HAPUS DATABASE  :   OK .... <br><br>";
    }
else
   {
   echo "DATABASE BELUM DIBUAT .... <br><br>";
   };
   
$buat = mysqli_query($link,'CREATE DATABASE login');
if ($buat)
    {
    echo "BUAT DATABASE  :    OK .... <br><br>";
    }
else
    {
    echo("DATABASE  SUDAH ADA ... <br><br>");
    };
   
$gunakan = mysqli_query($link,'USE login');
if ($gunakan)
    {
    echo "GUNAKAN DATABASE  :    OK .... <br><br>";
    }
else
   {
   die("GUNAKAN DATABASE  : GAGAL ... <br><br>");
   };

$admin = "CREATE TABLE admin (
                       username varchar(16) NOT NULL,
                       password varchar(16) NOT NULL,
                       PRIMARY KEY (username)
                       );";
                      
$tabel_login = mysqli_query($link, $admin);

$user = mysqli_query($link,"INSERT INTO admin VALUES ('admin', 'admin123')"); 



echo       "INSTAL DATABASE  login        :    OK ....<br><br>
            INSTAL TABEL  admin           :    OK ....<br><br><br>
            Klik <a href='login.php'>DI SINI</a> untuk melanjutkan<br>";

?>