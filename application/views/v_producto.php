<body><br>
<div class="container">
<?php echo anchor(
				'ctrl_portada/categoria/'.$producto["categoria"], 
				'<i class="fa fa-times" aria-hidden="true"></i>', 
				'class="btn btn-secondary volver"');
			?>
	<div class="row centrado">
	<div class="card card-block prod"><div class="row">
		<div class="col-md-6">
		
		<img class="img img-fluid marco" src="<?php echo base_url('assets/img/'.$producto['imagen'].'.jpg') ?>">
				<?php 
					if($producto['stock']>0){
						?>
						<div class="alert alert-success" role="alert"><strong>En stock</strong></div>
						<h3><?=$producto['precioventa'] ?> €</h3>
						
						<a class="btn btn-primary" href=""><i class="fa fa-cart-plus" aria-hidden="true"></i> Añadir al carrito</a>
						<?php
					}
					else{
						?>
						<div class="alert alert-danger" role="alert"><strong>No disponible</strong></div>
						<h3><?=$producto['precioventa'] ?> €</h3>
						<a class="btn btn-primary disabled" href=""><i class="fa fa-cart-plus" aria-hidden="true"></i> Añadir al carrito
</a>
						<?php
					}
				?>

		</div>

		<div class="col-md-6"><br><br>
		<h3><?=$producto['nombre'] ?></h3><br>
		<p style="text-align: justify"><?=$producto['descripcion'] ?></p>
		<br>
		</div>
		</div>		
	</div>
	</div>
</div>
</body>