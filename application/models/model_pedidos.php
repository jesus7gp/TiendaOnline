<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pedidos extends CI_Model {

	public function InsertaPedido($datos){
		$query = $this->db->insert('pedido',$datos);
		return $this->db->insert_id();
	}

	public function InsertaLinea($datos){
		$this->db->insert('linea_pedido',$datos);
	}


}

/* End of file model_pedidos.php */
/* Location: ./application/models/model_pedidos.php */