<!DOCTYPE html>
<html lang="es">
<head>
      <meta charset="utf-8"/>      
      <meta NAME="distribution" CONTENT="global"/>
      <title><?= $title.' :: '.SITE_NAME;?></title>      
      <link rel="stylesheet/less" type="text/css" href="<?= base_url('css/style.less');?>"  />
     <!--?= isset($style) ?'<link  rel="stylesheet/less" type="text/css" href="'.base_url('css/'.$style.'.less').'" />': '';?-->
      <script type="text/javascript" src="<?= base_url('js/less.js');?>"></script>      
      <script type="text/javascript" src="<?= base_url('js/jquery-1.7.1.min.js');?>"></script>      
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
      <script type="text/javascript" src="<?= base_url('js/jquery.nivo.slider.pack.js');?>"></script>
	  <link rel="stylesheet" href="<?= base_url('js/nivo-slider/default.css');?>" type="text/css" media="screen" />
	  <link rel="stylesheet" href="<?= base_url('css/nivo-slider.css');?>" type="text/css" media="screen" />
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
				<a href="<?= base_url();?>" target="_blank"><img id="logo-prefeco" src="<?= base_url('images/logo-prefeco.png');?>" /></a>
				<div id="logo-interprefecos"><img src="<?= base_url('images/logo-interprefecos-min.png');?>"/></div>
				<div id="user-bar-log" class="round">
					<ul>
						<li class="username"><?= (isset($username) && strlen($username)) ? 'Bienvenido, '.$username: anchor('login', 'Entrar', ''); ?></li>
						<?= (isset($username) && strlen($username)) ? '<li class="log-out">'.anchor('login/logout', 'Salir', '').'</li>':''; ?>
						<div class="clear"></div>
					</ul>
				</div>
			</div>
			<ul id="menu-bar-nav">
				<li><?= anchor('', 'INICIO', '');?></li>
				<li><?= anchor('eventos/calendario', 'EVENTOS Y RESULTADOS', '');?></li>
				<li><?= anchor('estadisticas', 'ESTADISTICAS', '');?></li>
				<li><?= ($this->session->userdata('logged_in')) ? anchor('login', 'REGISTRO',''): anchor('login', 'REGISTRO','');?></li>
			</ul>
		</div><!-- end header-->
		<div id="body">