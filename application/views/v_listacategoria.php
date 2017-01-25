<div class="container">
	<div class="row centrado">
	<hr><h1>Categorías</h1><hr>
	<?php foreach($ListaCategorias as $categoria): ?>
		<div class="col-md-4"><br><br>			
			<?php echo anchor(
				'ctrl_portada/categoria/'.$categoria["id"], 
				$categoria["nombre"].'
				<br>
				<i class="fa fa-music fa-5x" aria-hidden="true"></i>', 
				'class="btn btn-outline-secondary redondo"');
			?>
		</div>
	<?php endforeach; ?>
	</div>
<br/><br/>
</div>