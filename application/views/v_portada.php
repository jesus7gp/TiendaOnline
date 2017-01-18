
<br>
<div class="container">
	<div class="row centrado">
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
</div>
