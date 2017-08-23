
<!DOCTYPE HTML>
<!--
	Iridium by TEMPLATED
    templated.co @templatedco
    Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title><?php echo $title; ?></title>
		<link rel="shortcut icon" href="http://raspberrypi/teroka/assets/img/faviconUSM.png" type="image/x-icon" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href='http://fonts.googleapis.com/css?family=Arimo:400,700' rel='stylesheet' type='text/css'>
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="<?php echo base_url();?>assets/theme/iridium/js/skel.min.js"></script>
		<script src="<?php echo base_url();?>assets/theme/iridium/js/skel-panels.min.js"></script>
		<script src="<?php echo base_url();?>assets/theme/iridium/js/init.js"></script>
		<!-- <noscript> -->
			<link rel="stylesheet" href="<?php echo base_url();?>assets/theme/iridium/css/skel-noscript.css" />
			<link rel="stylesheet" href="<?php echo base_url();?>assets/theme/iridium/css/style.css" />
			<link rel="stylesheet" href="<?php echo base_url();?>assets/theme/iridium/css/style-desktop.css" />
		<!-- </noscript> -->
		<!--[if lte IE 8]><link rel="stylesheet" href="<?php echo base_url();?>assets/theme/iridium/css/ie/v8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="<?php echo base_url();?>assets/theme/iridium/css/ie/v9.css" /><![endif]-->
	</head>
	<body class="no-sidebar">

		<!-- Header -->
		<div id="header">
			<div class="container"> 
				
				<!-- Logo -->
				<div id="logo">
					<h1><a href="#">TEROKA</a></h1>
					<!-- <span>Design by TEMPLATED</span> -->
				</div>
				
				<!-- Nav -->
				<nav id="nav">
					<ul>
						<li><a href="<?php echo site_url('home');?>">Home</a></li>
						<li><a href="<?php echo site_url('auth/login#signup');?>">Register</a></li>
						<li><a href="<?php echo site_url('auth/login#login');?>">login</a></li>
					</ul>
				</nav>
			</div>
		</div>

		<!-- Main -->
		<div id="main">
			<div class="container">
				<div class="row"> 
					
					<!-- Content -->
					<div id="content" class="12u skel-cell-important">
						<section>
							<header>
								<h2><?php echo $row->title; ?></h2>
								<!-- <span class="byline">Integer sit amet pede vel arcu aliquet pretium</span> -->
							</header>
							<!-- <a href="#" class="image full"><img src="<?php echo base_url();?>assets/theme/iridium/images/pic07.jpg" alt="" /></a> -->
							<br>
							<p><?php echo $row->content; ?></p>
						</section>
					</div>
					
				</div>
			</div>
		</div>

		<!-- Footer -->
		<div id="footer">
			<div class="container">
				<div class="row">
					<div class="4u">
						<section>
							<h2>Latest Posts</h2>

							<ul class="default">
							<?php foreach ($rows as $value): ?>
								<li><a href="<?= site_url($this->uri->segment(1).'/detail/'.$value->id_blog);?>"><?php echo $value->title; ?></a></li>
							<?php endforeach ?>								
								<!-- <li><a href="#">Lorem ipsum consectetuer adipiscing</a></li>
								<li><a href="#">Phasellus nibh pellentesque congue</a></li>
								<li><a href="#">Cras vitae metus aliquam pharetra</a></li>
								<li><a href="#">Maecenas vitae orci feugiat eleifend</a></li> -->
							</ul>
							<div class="row">
                      <div class="col-md-12" align="center">
                        <?php echo $pagination; ?>
                      </div>
                    </div>
						</section>

					</div>
					<!-- <div class="4u">
						<section>
							<h2>Ultrices fringilla</h2>
							<ul class="default">
								<li><a href="#">Pellentesque lectus gravida blandit</a></li>
								<li><a href="#">Lorem ipsum consectetuer adipiscing</a></li>
								<li><a href="#">Phasellus nibh pellentesque congue</a></li>
								<li><a href="#">Cras vitae metus aliquam pharetra</a></li>
								<li><a href="#">Maecenas vitae orci feugiat eleifend</a></li>
							</ul>
						</section>
					</div>
					<div class="4u">
						<section>
							<h2>Aenean elementum</h2>
							<ul class="default">
								<li><a href="#">Pellentesque lectus gravida blandit</a></li>
								<li><a href="#">Lorem ipsum consectetuer adipiscing</a></li>
								<li><a href="#">Phasellus nibh pellentesque congue</a></li>
								<li><a href="#">Cras vitae metus aliquam pharetra</a></li>
								<li><a href="#">Maecenas vitae orci feugiat eleifend</a></li>
							</ul>
						</section>
					</div> -->
				</div>
			</div>
		</div>

		<!-- Copyright -->
		<div id="copyright">
			<div class="container">
				Design: <a href="http://templated.co">TEMPLATED</a> Images: <a href="http://unsplash.com">Unsplash</a> (<a href="http://unsplash.com/cc0">CC0</a>)
			</div>
		</div>
		
	</body>
</html>