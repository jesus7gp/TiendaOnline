<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_carrito extends CI_Controller {

	public function index()
	{
		$this->load->view('templates/layout', array(
			'cuerpo'=>$this->load->view('carrito/v_carrito',null,TRUE)
			));
	}

}

/* End of file ctrl_carrito.php */
/* Location: ./application/controllers/ctrl_carrito.php */