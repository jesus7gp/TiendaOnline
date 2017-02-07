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
	public function NombreProducto($id){		
		$this->db->select('nombre');
		$this->db->from('producto');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row()->nombre;
	}
	public function TotalProductos($categoria){		
		$this->db->select('*');
		$this->db->from('producto');	
		$this->db->where('oculto', 1);
		$this->db->where('categoria', $categoria);
		return $this->db->count_all_results();
	}
	
	public function BajaStock($id, $cantidad){
		$producto = $this->db->get_where('producto', array('id' => $id));
		$p = $producto->row_array();
		$nueva = $p['stock'] - $cantidad;
		$this->db->update('producto', array('stock' => $nueva), array('id' => $id));
	}

	public function Stock($id){
		$query = $this->db->get_where('producto', array('id'=>$id));
		return $query->row()->stock;
	}

}