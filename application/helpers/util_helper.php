<?php
function EstadoPedido($estado){
	if($estado== 'p'){
		return "Procesando";
	}

	if($estado== 'c'){
		return "Cancelado";
	}
}

function CreaTabla($pedido,$lineas){
	$tabla = "";

	$tabla .= "<ul>
	<li><strong>Nombre:</strong>".$pedido['nombre']."</li>
	<li><strong>Apellidos:</strong>". $pedido['apellidos']."</li>
	<li><strong>Dirección:</strong>". $pedido['direccion']."</li>
	<li><strong>Código:</strong>". $pedido['cp']."</li>
	<li><strong>Fecha:</strong>".date('d-m-Y' ,strtotime($pedido['fecha']))."</li>
	<li><strong>Hora:</strong>".date('H:m' ,strtotime($pedido['fecha']))."</li>
	<li><strong>Estado:</strong>".EstadoPedido($pedido['estado'])."</li>
	</ul><br/>";
	$tabla .= "<table border='1'><tr>
						<th>Producto</th>
						<th>Cantidad</th>
						<th>Precio</th>
						<th>Subtotal</th>
					</tr>";
	foreach($lineas as $linea){
		$tabla .= "<tr>";
		$tabla .= "<td>".$linea['nombreproducto']."</td>";
		$tabla .= "<td>".$linea['cantidad']."</td>";
		$tabla .= "<td>".$linea['precio']."</td>";
		$tabla .= "<td>".$linea['cantidad']*$linea['precio']."</td>";
		$tabla .= "</tr>";
	}
	$tabla .= "</table>";

	return $tabla;
}