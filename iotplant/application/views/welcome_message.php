<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>
<section id="app">
<template>
  <ul v-if="posts && posts.length">
    <li v-for="post of posts">
      <p><strong>{{post.title}}</strong></p>
      <p>{{post.body}}</p>
    </li>
  </ul>

  <ul v-if="errors && errors.length">
    <li v-for="error of errors">
      {{error.message}}
    </li>
  </ul>
</template>
	<div id="container">
	<h1>Welcome to CodeIgniter!</h1>
	
	<div id="body">
		<p>The page you are looking at is being generated dynamically by CodeIgniter.</p>

		<p>If you would like to edit this page you'll find it located at:</p>
		<code>application/views/welcome_message.php</code>

		<p>The corresponding controller for this page is found at:</p>
		<code>application/controllers/Welcome.php</code>

		<p>If you are exploring CodeIgniter for the very first time, you should start by reading the <a href="user_guide/">User Guide</a>.</p>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>	
</section>
<div id="device_status"></div>
<div id="soil_moisture"></div>
<div id="suhu"></div>
<div id="dht_humiditas"></div>
<div id="dht_temp"></div>
<!-- <script src="https://unpkg.com/vue"></script> -->
<!-- <script src="https://unpkg.com/axios/dist/axios.min.js"></script> -->
<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
<script>
	setInterval(
	   function(){
	   		$.getJSON("http://blynk-cloud.com/a1682c558de345d1b67eb01235e7cb93/get/V1", function(responseSoilMoisture){
	            var dtSoilMoisture = responseSoilMoisture;
	            var showSoilMoisture = document.getElementById('soil_moisture');
	                  showSoilMoisture.innerHTML = "Kelembapan Tanah :"+dtSoilMoisture;
	      });
 $.getJSON("http://blynk-cloud.com/a1682c558de345d1b67eb01235e7cb93/get/V2", function(responseSuhu){
                    var dtSuhu = responseSuhu;
                    var showSuhu = document.getElementById('suhu');
                          showSuhu.innerHTML = "Suhu Tanah :"+dtSuhu;
              });
 $.getJSON("http://blynk-cloud.com/a1682c558de345d1b67eb01235e7cb93/get/V3", function(responseDhtHumiditas){
                    var dtDhtHumiditas = responseDhtHumiditas;
                    var showDhtHumiditas = document.getElementById('dht_humiditas');
                          showDhtHumiditas.innerHTML = "DHT Humiditas :"+dtDhtHumiditas;
              });
 $.getJSON("http://blynk-cloud.com/a1682c558de345d1b67eb01235e7cb93/get/V4", function(responseDhtTemp){
                    var dtDhtTemp = responseDhtTemp;
                    var showDhtTemp = document.getElementById('dht_temp');
                          showDhtTemp.innerHTML = "DHT Suhu :"+dtDhtTemp;
              });


	   		$.getJSON("http://blynk-cloud.com/a1682c558de345d1b67eb01235e7cb93/isHardwareConnected", function(device_status){
	            var statDevice = device_status;
	            if(statDevice== false){
	            	var devStat = "Offline";
	            }else{
	            	var devStat = "Online";
	            }
	            var dStat = document.getElementById('device_status');
	                  dStat.innerHTML = devStat;
	      });
	   },1000);	
</script>
</body>
</html>
