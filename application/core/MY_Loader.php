<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Loader extends CI_Loader {
	protected $ci;

	public function __construct()
	{
        $this->ci =& get_instance();
	}
	
	public function CargaVista($cuerpo, $variables){
		$carrito = new Carrito();
		$this->ci->load->model('model_categorias');
		$listaCategorias = $this->ci->model_categorias->ListaCategorias();

		$this->ci->load->view('templates/layout', array(

			'cuerpo'=>$this->ci->load->view($cuerpo, $variables,TRUE),
			'carrito'=>$carrito,
			'ListaCategorias'=>$listaCategorias
			));
	}

}