<div class="jumbotron titulo" style="text-align: center"><h1><i class="fa fa-music" aria-hidden="true"></i> MusicOnline</h1><p>Productos destacados</p></div>
<div class="container">
	<div class="row centrado">
	<?php foreach($destacados as $producto){ ?>
		<div class="col-md-4"><br>			
			<div class="card card-block prod">
				<img class="img-fluid" src="<?php echo base_url('assets/img/'.$producto['imagen'].'.jpg') ?>">
				
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
	</div><br>
	<div class="text-md-center">
			<?php echo $this->pagination->create_links(); ?><br/><br/>
		</div>
</div>
