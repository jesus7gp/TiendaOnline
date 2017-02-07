<?php
function EstadoPedido($estado){
		if($estado== 'p'){
			return "Procesando";
		}
		if($estado== 'c'){
			return "Cancelado";
		}
	}