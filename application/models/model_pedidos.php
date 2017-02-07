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

	public function SacaPedidos($id_usuario){
		$query = $this->db->get_where('pedido', array('id_usuario'=>$id_usuario));
		return $query->result_array();
	}

	public function Pedido($id){
		$query = $this->db->get_where('pedido', array('id'=>$id));
		return $query->row_array();
	}

	public function Lineas($id_pedido){
		$query = $this->db->get_where('linea_pedido', array('id_pedido'=>$id_pedido));
		return $query->result_array();
	}

	public function Cancelar($id){
		$this->db->update('pedido', array('estado' => 'c'), array('id'=>$id));
	}
}

/* End of file model_pedidos.php */
/* Location: ./application/models/model_pedidos.php */