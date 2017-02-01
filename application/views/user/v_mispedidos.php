<div class="container" id="login"><br/><br/>	
	<h1><i class="fa fa-truck" aria-hidden="true"></i> Mis pedidos</h1><br/>
	<table class="table table-hover">
			<tr>
				<th></th>
				<th>Nombre</td>
				<th>Apellidos</th>
				<th>Fecha del pedido</th>
				
				
				<th>Estado</th>
			</tr>
		<?php foreach($pedidos as $pedido): ?>
			<tr>
				<td><a class="btn btn-info cantip" href="<?=base_url('index.php/ctrl_user/UnPedido/'.$pedido['id'])?>"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
				<td><?=$pedido['nombre']?></td>
				<td><?=$pedido['apellidos']?></td>
				<td><?=date("d-m-Y" ,strtotime($pedido['fecha']))?></td>
				
				
				<td><?=EstadoPedido($pedido['estado'])?></td>
			</tr>
		<?php endforeach; ?>
	</table>

</div>