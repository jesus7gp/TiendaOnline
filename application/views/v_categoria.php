<div class="jumbotron titulo" style="text-align: center"><h1><i class="fa fa-music" aria-hidden="true"></i> <?php echo $categoria['nombre'] ?></h1><p><?php echo $categoria['descripcion'] ?></p></div>
<div class="container">
	<div class="row centrado">
	<?php foreach($ListaProductos as $producto){ ?>
		<div class="col-md-4"><br>			
			<div class="card card-block prod">
				<img class="img-fluid" src="<?php echo base_url('assets/img/'.$producto['imagen'].'.jpg') ?>">
				<?php 
					if($producto['stock']>0){
						?>
						<div class="alert alert-success" role="alert"><strong>En stock</strong></div>
						<?php
					}
					else{
						?>
						<div class="alert alert-danger" role="alert"><strong>No disponible</strong></div>
						<?php
					}
				?>
				<a class="h4" href="<?php echo base_url('index.php/Ctrl_portada/producto/'.$producto['id']) ?>"><?php echo $producto['nombre'] ?></a>
				<h4><?php echo $producto['precioventa'] ?>	€</h4>
				
				<?php 
					if($producto['stock']>0){
						?>
							<a class="btn btn-primary" href="<?=base_url('index.php/Ctrl_carrito/Add/'.$producto['id'])?>"><i class="fa fa-cart-plus" aria-hidden="true"></i> Añadir al carrito</a>
						<?php
					}
					else{
						?>
							<a class="btn btn-primary disabled"><i class="fa fa-cart-plus" aria-hidden="true"></i> Añadir al carrito</a>
						<?php
					}
				?>
				
			</div>
		</div>
	<?php } ?>
	</div><br><br>
	<div class="text-md-center">
			<?php echo $this->pagination->create_links(); ?>
		</div>
</div>