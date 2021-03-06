<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_portada extends CI_Controller {	
	/**
	 *
	 * En el index se carga la portada con destacados y categorías
	 *
	 */
	public function index(){	
		$this->load->model('model_productos');
		$this->conf_pagDes();		
		$pag = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$destacados = $this->model_productos->Destacados($this->pagination->per_page, $pag);
		$this->load->CargaVista('v_portada',array('destacados'=>$destacados));	
	}

	public function categoria(){		
		$this->load->model('model_productos');
		$this->conf_pag();
		$categoriaporid = $this->model_categorias->EligeCategoria($this->uri->segment(3));
		$pag = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$productos = $this->model_productos->ListaProductos($this->uri->segment(3),$this->pagination->per_page, $pag);
		$this->load->CargaVista('v_categoria',array('categoria' => $categoriaporid, 'ListaProductos' => $productos));	
	}

	public function producto(){
		$this->load->model('model_productos');
		$productoid = $this->model_productos->EligeProducto($this->uri->segment(3));
		$this->load->CargaVista('v_producto', array('producto' => $productoid));
	}

	public function conf_pag(){
		$this->load->library('pagination');
		
		$config['base_url'] = base_url('index.php/Ctrl_portada/categoria/'.$this->uri->segment(3).'/');
		$config['total_rows'] = $this->model_productos->TotalProductos($this->uri->segment(3));
		$config['per_page'] = 3;
		$config['uri_segment'] = 4;
		$config['num_links'] = 1;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['first_link'] = 'Primero';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Último';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = '&gt;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&lt;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active">';
		$config['cur_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);
	}

	public function conf_pagDes(){
		$this->load->library('pagination');
		
		$config['base_url'] = base_url('index.php/Ctrl_portada/index/');
		$config['total_rows'] = $this->model_productos->TotalDestacados();
		$config['per_page'] = 3;
		$config['uri_segment'] = 3;
		$config['num_links'] = 1;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['first_link'] = 'Primero';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Último';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = '&gt;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&lt;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active">';
		$config['cur_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);
	}
		
}

/* End of file Ctrl_portada.php */
/* Location: ./application/controllers/Ctrl_portada.php */