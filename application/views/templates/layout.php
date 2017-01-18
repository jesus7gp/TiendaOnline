<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/css/bootstrap.min.css" integrity="sha384-2hfp1SzUoho7/TsGGGDaFdsuuDL0LX2hnUp6VkX3CUQ2K4K+xjboZdsXyp4oUHZj" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body>
<nav class="navbar navbar-dark bg-inverse">
<!-- Navbar content -->
<a class="navbar-brand mb-0" href="<?php echo base_url() ?>"><i class="fa fa-music" aria-hidden="true"></i>	MusicOnline</a>
<ul class="nav navbar-nav pull-xs-right">
	<?php if(isset($_SESSION['sesion'])): ?>
	<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
¡Hola, <strong><?=$_SESSION['sesion']?></strong>!
</a>
	<div class="dropdown-menu" aria-labelledby="Preview">
	<a class="dropdown-item" href="#">Datos de usuario</a>
	<a class="dropdown-item" href="#">Cerrar sesión</a>
	</div>
	</li>
	<?php else: ?>
	<li class="nav-item">
		<a class="nav-link" href="<?php echo base_url('index.php/ctrl_user') ?>">Iniciar sesión</a>
	</li>
	<?php endif; ?>
	<li class="nav-item">
		<a class="nav-link" href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
	</li>
</ul>
</nav>
<div id="cuerpo">
  <?=$cuerpo?>
 </div>
</body>
</html>