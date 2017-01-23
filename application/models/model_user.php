<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_user extends CI_Model {
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function InsertaUsuario($datos){
		unset($datos['repclave']);
		$datos['clave']=md5($datos['clave']);
		$datos['activo'] = 1;
		$this->db->insert('usuario',$datos);
	}

	public function CompruebaUsuario($datos){
		$query = $this->db->get_where('usuario', array('usuario'=>$datos['usuario'], 'clave'=>md5($datos['clave'])));
		return $query->row_array();	
	}

	public function UsuarioID($id){
		$query = $this->db->get_where('usuario', array('id'=>$id));
		return $query->row_array();
	}

	public function CambiaDatos($id, $datos){
		$this->db->update('usuario', $datos, $id);
	}

}

/* End of file model_user.php */
/* Location: ./application/models/model_user.php */