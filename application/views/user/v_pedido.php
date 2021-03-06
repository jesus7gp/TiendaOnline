<div class="container"><br/><br/>
	<h1><i class="fa fa-truck" aria-hidden="true"></i> Datos del pedido</h1><br/>
	<div class="btn-group">
	<a class="btn btn-secondary volver" title="Volver" href="<?=base_url('index.php/Ctrl_user/VerPedidos')?>"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
	<a class="btn btn-secondary volver" target="_blank" title="Exportar PDF" href="<?=base_url('index.php/Ctrl_user/creaPDF/'.$pedido['id'])?>"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
	<!--Cancelar pedido-->
				<?php if($pedido['estado'] == "p"): ?>
					<a title="Cancelar pedido" href="<?=base_url('index.php/Ctrl_user/CancelarPedido/'.$pedido['id'])?>" class="btn btn-danger volver"><i class="fa fa-remove" aria-hidden="true"></i></a>
				<?php endif; ?>
	</div>
	<ul class="list-group">
	<li class="list-group-item"><strong>Nombre:</strong> <?=$pedido['nombre']?></li>
	<li class="list-group-item"><strong>Apellidos:</strong> <?=$pedido['apellidos']?></li>
	<li class="list-group-item"><strong>Dirección:</strong> <?=$pedido['direccion']?></li>
	<li class="list-group-item"><strong>Código:</strong> <?=$pedido['cp']?></li>
	<li class="list-group-item"><strong>Fecha:</strong> <?=date("d-m-Y" ,strtotime($pedido['fecha']))?></li>
	<li class="list-group-item"><strong>Hora:</strong> <?=date("H:m" ,strtotime($pedido['fecha']))?></li>
	<li class="list-group-item"><strong>Estado:</strong> <?=EstadoPedido($pedido['estado'])?></li>
	</ul><br/>
	<table class="table table-hover">
	<tr>
		<th>Producto</th>
		<th>Cantidad</th>
		<th>Precio</th>
		<th>Subtotal</th>
	</tr>
	<?php foreach($lineas as $linea): ?>
			<tr>
				<td><?=$this->model_productos->NombreProducto($linea['id_producto'])?></td>
				<td><?=$linea['cantidad']?></td>
				<td><?=$linea['precio']?></td>
				<td><?=$linea['precio']*$linea['cantidad']?></td>
			</tr>
		<?php endforeach; ?>
	</table>
	
</div>