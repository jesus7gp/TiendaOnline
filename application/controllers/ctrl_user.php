<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_user extends CI_Controller {

	public function index()
	{
		$this->load->model('model_user');
				
		$this->load->view('templates/layout', array(
			'cuerpo'=>$this->load->view('user/v_login', null,TRUE)
			));
	}

	public function registro(){
		$this->load->model('model_provincias');
		$this->load->model('model_user');
		$this->load->library('form_validation');

		$listaProvincias = $this->model_provincias->ListaProvincias();
		$this->form_validation->set_error_delimiters('<div style="color:tomato"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>

 ', '</div>');
		$this->form_validation->set_rules('usuario', 'usuario', 'required');
		$this->form_validation->set_rules('correo', 'email', 'required|valid_email');
		$this->form_validation->set_rules('clave', 'contraseña', 'required');
		$this->form_validation->set_rules('repclave', 'confirmar contraseña', 'required|matches[clave]');
		$this->form_validation->set_rules('nombre', 'nombre', 'required');
		$this->form_validation->set_rules('apellidos', 'apellidos', 'required');
		$this->form_validation->set_rules('dni', 'DNI', 'required');
		$this->form_validation->set_rules('provincia', 'provincia', 'required|greater_than[0]',array('greater_than'=>'El campo provincia es obligatorio.'));
		$this->form_validation->set_rules('cp', 'código postal', 'required');
		$this->form_validation->set_rules('direccion', 'dirección', 'required');
				
		
		if ($this->form_validation->run() == FALSE){
            $this->load->view('templates/layout', array(
			'cuerpo'=>$this->load->view('user/v_registro', array('ListaProvincias' => $listaProvincias),TRUE)
			));
        }
        else {
            unset($_POST['repclave']);
            $this->model_user->InsertaUsuario($this->input->post());

            $this->load->model('model_categorias');
			$listaCategorias = $this->model_categorias->ListaCategorias();
			$this->load->view('templates/layout', array(
				'cuerpo'=>$this->load->view('v_portada', array('ListaCategorias'=>$listaCategorias),TRUE)
			));

        }

	}

}

/* End of file ctrl_user.php */
/* Location: ./application/controllers/ctrl_user.php */