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
	

}

/* End of file model_user.php */
/* Location: ./application/models/model_user.php */