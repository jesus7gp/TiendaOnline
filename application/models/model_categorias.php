<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_categorias extends CI_Model {
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	public function ListaCategorias(){		
		$query = $this->db->get_where('categoria', array('oculto'=>1));
		return $query->result_array();
	}
	public function EligeCategoria($id){		
		$query = $this->db->get_where('categoria', array('id'=>$id));
		return $query->row_array();
	}
	

}

/* End of file model_categorias.php */
/* Location: ./application/models/model_categorias.php */