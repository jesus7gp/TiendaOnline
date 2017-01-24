<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_carrito extends CI_Controller {

	public function index()
	{
		$carrito = new Carrito();
		$this->load->view('templates/layout', array(
			'cuerpo'=>$this->load->view('carrito/v_carrito',array('carrito'=>$carrito),TRUE),
			'carrito'=>$carrito
			));
	}

	public function Add($id){
		$carrito = new Carrito();
		$this->load->model('model_productos');
		$productoid = $this->model_productos->EligeProducto($id);
		$articulo = array(
			"id"			=>		$productoid['id'],
			"cantidad"		=>		1,
			"precio"		=>		$productoid['precioventa'],
			"nombre"		=>		$productoid['nombre']
		);
		$carrito->add($articulo);
		redirect(base_url('index.php/ctrl_carrito'));
	}

	public function Destroy(){
		$carrito = new Carrito();
		$carrito->destroy();
		redirect(base_url('index.php/ctrl_carrito'));
	}

}

/* End of file ctrl_carrito.php */
/* Location: ./application/controllers/ctrl_carrito.php */