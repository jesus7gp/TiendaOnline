<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_productos extends CI_Model {
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	public function ListaProductos($id, $inicio, $tamano){
		$this->db->limit($inicio, $tamano);		
		$query = $this->db->get_where('producto', array('categoria'=>$id));
		return $query->result_array();
	}
	public function Destacados($inicio, $tamano){
		$this->db->limit($inicio, $tamano);		
		$query = $this->db->get_where('producto', array('destacado'=>1));
		return $query->result_array();
	}

	public function TotalDestacados(){
		$this->db->select('producto.*');
		$this->db->from('producto');	
		$this->db->where('producto.oculto', 1);
		$this->db->where('producto.destacado', 1);
		return $this->db->count_all_results();
	}
	public function EligeProducto($id){		
		$query = $this->db->get_where('producto', array('id'=>$id));
		return $query->row_array();
	}

	public function TotalProductos($id){		
		$this->db->select('producto.*');
		$this->db->from('producto');	
		$this->db->where('producto.oculto', 1);
		$this->db->where('producto.categoria', $id);
		return $this->db->count_all_results();
	}
	

}