<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_provincias extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function ListaProvincias(){
		$query = $this->db->get('provincia');
		$rs = $query->result_array();
		foreach ($rs as $provincia)
		{
			$provincias[$provincia['id']] = $provincia['nombre'];
		}
		return $provincias;
	}

}

/* End of file model_provincias.php */
/* Location: ./application/models/model_provincias.php */