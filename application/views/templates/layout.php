<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">

	<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous"></script>

<!-- Tether -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js" integrity="sha384-Plbmg8JY28KFelvJVai01l8WyZzrYWG825m+cZ0eDDS1f7d/js6ikvy1+X+guPIB" crossorigin="anonymous"></script>

<!-- Bootstrap 4 Alpha JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/js/bootstrap.min.js" integrity="sha384-VjEeINv9OSwtWFLAtmc4JCtEJXXBub00gtSnszmspDLCtC0I4z4nqz7rEFbIZLLU" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/css/bootstrap.min.css" integrity="sha384-2hfp1SzUoho7/TsGGGDaFdsuuDL0LX2hnUp6VkX3CUQ2K4K+xjboZdsXyp4oUHZj" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
	
</head>
<body>
<nav class="navbar navbar-dark bg-inverse">
<!-- Navbar content -->
<a class="navbar-brand mb-0" href="<?php echo base_url() ?>"><i class="fa fa-music" aria-hidden="true"></i>	MusicOnline</a>
<ul class="nav navbar-nav pull-xs-left">
	<li class="nav-item dropdown">
	<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Categorías</a>
	<div class="dropdown-menu" aria-labelledby="Preview">
		<?php foreach($ListaCategorias as $categoria): ?>		
			<?php echo anchor(
				'Ctrl_portada/categoria/'.$categoria["id"], 
				$categoria["nombre"], 
				'class="dropdown-item"');
			?>
	<?php endforeach; ?>
	</div>
	</li>
</ul>
<!--EL USUARIO SÍ HA INICIADO SESIÓN********************************************************************************************************************************************-->
<ul class="nav navbar-nav pull-xs-right">
	<?php if($this->session->has_userdata('id')): ?>
	<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
¡Hola, <strong><?php echo $this->session->userdata('nombre');?></strong>!
</a>
	<div class="dropdown-menu" aria-labelledby="Preview">
	<a class="dropdown-item" href="<?php echo base_url('index.php/Ctrl_user/EditarDatos') ?>"><i class="fa fa-user-circle" aria-hidden="true"></i> Mi cuenta</a>
	<a class="dropdown-item" href="<?php echo base_url('index.php/Ctrl_user/VerPedidos') ?>"><i class="fa fa-truck" aria-hidden="true"></i> Mis pedidos</a>
	<a class="dropdown-item" data-toggle="modal" data-target="#flipFlop" href=""><i class="fa fa-sign-out" aria-hidden="true"></i> Cerrar sesión</a>
	</div>
	</li>
<!--EL USUARIO NO HA INICIADO SESIÓN********************************************************************************************************************************************-->	
	<?php else: ?>
	<li class="nav-item">
		<a class="nav-link" href="<?php echo base_url('index.php/Ctrl_user') ?>">Iniciar sesión</a>
	</li>
	<?php endif; ?>
	<li class="nav-item">
		<a class="nav-link" href="<?=base_url('index.php/Ctrl_carrito')?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <?=$carrito->articulos_total()?> ítem(s)</a>
	</li>
</ul>
<!--MODAL DE CONFIRMACIÓN CERRAR SESIÓN********************************************************************************************************************************************-->
<div class="modal fade" id="flipFlop" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title" id="modalLabel">Cerrar sesión</h4>
			</div>
			<div class="modal-body">
				¿Está seguro?
			</div>
			<div class="modal-footer">
				<a href="<?php echo base_url('index.php/Ctrl_user/logout') ?>" class="btn btn-secondary respLogout">Sí</a>
				<button type="button" class="btn btn-secondary respLogout" data-dismiss="modal" aria-label="Close">No</button>
			</div>
		</div>
	</div>
</div>
</nav>

<!--CUERPO DE LA PLANTILLA********************************************************************************************************************************************-->
<div id="cuerpo">
	<?=$cuerpo?>
</div>
</body>
</html>