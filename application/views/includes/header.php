<!DOCTYPE html>
<html lang="es">
<head>
      <meta charset="utf-8" >
      <meta NAME="keywords" CONTENT="">
      <meta NAME="description" CONTENT="">
      <meta NAME="revisit-after" CONTENT="15 days">
      <meta NAME="ROBOTS" CONTENT="INDEX, FOLLOW">
      <meta NAME="ROBOTS" CONTENT="INDEX, ALL">
      <meta NAME="distribution" CONTENT="global">
      <title><?php echo $title.' :: '.SITE_NAME;?></title>
      <link rel="stylesheet" href="<?php echo base_url('css/Style.css');?>" type="text/css" />
     <?php if(@$style) echo '<link  rel="stylesheet" href="'.base_url('css/'.$style).'" type="text/css" />';?>
      <script type="text/javascript" src="<?php echo base_url('js/jquery-1.7.1.min.js');?>"></script>      
	  <?php if(isset($notification)){?>
		<script>
			$(document).ready(function() {
				$('#notification').hide();
				$('#notification').slideDown();
				$('#notification').click(function(){
					$(this).slideUp();
				});
			});
		</script>
	  <?php } ?>
      <script type="text/javascript" src="<?php echo base_url('js/jquery.nivo.slider.pack.js');?>"></script>
	  <link rel="stylesheet" href="<?php echo base_url('js/nivo-slider/default.css');?>" type="text/css" media="screen" />
	  <link rel="stylesheet" href="<?php echo base_url('css/nivo-slider.css');?>" type="text/css" media="screen" />
      <script type="text/javascript">	  
		$(window).load(function() {
			$('#slider').nivoSlider();
			
		});
      </script>
</head>
<body>
<div id="container">
  <center>
	<div id="wp-page" class="content round">
		<div id="header">
			<div id="menu-prefeco" class="round-top">
				<a href="<?php echo base_url();?>" target="_blank"><img id="logo-prefeco" src="<?php echo base_url('images/logo-prefeco.png');?>" /></a>
				<div id="logo-interprefecos"><img src="<?php echo base_url('images/logo-interprefecos-min.png');?>"/></div>
				<div id="user-bar-log" class="round">
					<ul>
						<li class="username"><?php if(isset($username) && strlen($username)) echo 'Bienvenido, '.$username; else echo anchor('login', 'Entrar', ''); ?></li>
						<?php if(isset($username) && strlen($username)) echo '<li class="log-out">'.anchor('login/logout', 'Salir', '').'</li>'; ?>
						<div class="clear"></div>
					</ul>
				</div>
			</div>
			<ul id="menu-bar-nav">
				<li><?php echo anchor('', 'INICIO', '');?></li>
				<li><?php echo anchor('eventos/calendario', 'EVENTOS Y RESULTADOS', '');?></li>
				<li><?php echo anchor('estadisticas', 'ESTADISTICAS', '');?></li>
				<li><?php if($this->session->userdata('logged_in')) echo anchor('login', 'REGISTRO',''); else echo anchor('login', 'REGISTRO','');?></li>
			</ul>
		</div><!-- end header-->
		<div id="body">