<?php
$MyUsername = "root";  // enter your username for mysql
$MyPassword = "agusedyc";  // enter your password for mysql
$MyHostname = "raspberrypi";      // this is usually "localhost" unless your database resides on a different server

$dbh = mysql_pconnect($MyHostname , $MyUsername, $MyPassword);
$selected = mysql_select_db("iot",$dbh);
?>