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

	/**
	 *
	 * Añade un producto al carrito
	 *
	 */
	public function Add($id, $cantidad=1){
		$carrito = new Carrito();
		$this->load->model('model_productos');
		$productoid = $this->model_productos->EligeProducto($id);
		$articulo = array(
			"id"			=>		$productoid['id'],
			"cantidad"		=>		$cantidad,
			"precio"		=>		$productoid['precioventa'],
			"nombre"		=>		$productoid['nombre']
		);
		$carrito->add($articulo);
		redirect(base_url('index.php/ctrl_carrito'));
	}




	/**
	 *
	 * Vacía el carrito
	 *
	 */
	public function Destroy(){
		$carrito = new Carrito();
		$carrito->destroy();
		redirect(base_url('index.php/ctrl_carrito'));
	}

	/**
	 *
	 * Quita un producto del carrito
	 *
	 */
	public function Remove_producto($id){
		$carrito = new Carrito();
		$carrito->remove_producto($id);
		redirect(base_url('index.php/ctrl_carrito'));
	}

}

/* End of file ctrl_carrito.php */
/* Location: ./application/controllers/ctrl_carrito.php */