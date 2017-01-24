<div class="container">
	<div class="row centrado">
	<hr><h1>Categorías</h1><hr>
	<?php foreach($ListaCategorias as $categoria){ ?>
		<div class="col-md-4"><br><br>			
			<?php echo anchor(
				'ctrl_portada/categoria/'.$categoria["id"], 
				$categoria["nombre"].'
				<br>
				<i class="fa fa-music fa-5x" aria-hidden="true"></i>', 
				'class="btn btn-outline-secondary redondo"');
			?>
		</div>
	<?php } ?>
	</div>
<br/><br/>

	<div class="row centrado"><hr><h1>Destacados</h1><hr>
	<?php foreach($destacados as $producto){ ?>
		<div class="col-md-4"><br>			
			<div class="card card-block prod">
				<img class="img-fluid" src="<?php echo base_url('assets/img/'.$producto['imagen'].'.jpg') ?>">
				
				<a class="h4" href="<?php echo base_url('index.php/ctrl_portada/producto/'.$producto['id']) ?>"><?php echo $producto['nombre'] ?></a>
				<h4><?php echo $producto['precioventa'] ?>	€</h4>
				
				<?php 
					if($producto['stock']>0){
						?>
							<a class="btn btn-primary" href="<?=base_url('index.php/ctrl_carrito/Add/'.$producto['id'])?>"><i class="fa fa-cart-plus" aria-hidden="true"></i> Añadir al carrito</a>
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
	</div><br>
	<div class="text-md-center">
			<?php echo $this->pagination->create_links(); ?><br/><br/>
		</div>
</div>
