<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_carrito extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('model_categorias');			
	}

	public function index(){
		$carrito = new Carrito();
		$this->load->CargaVista('carrito/v_carrito',array('carrito'=>$carrito));
	}

	/**
	 *
	 * Añade un producto al carrito
	 * Si no se especifica cantidad, añadirá 1 por defecto
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

	//Finaliza el pedido e inserta en la tabla de datos
	public function FinalizaPedido(){
		$carrito = new Carrito();
		if($carrito->articulos_total()==0){//No hay productos en el carrito, lleva al index
			redirect(base_url());
		}
		elseif (!($this->session->has_userdata('id'))) {//No hay sesión de usuario, lleva a la página de login
			redirect(base_url('index.php/ctrl_user'));
		}
		else{//Se puede finalizar el pedido
			$this->load->model('model_user');
			$this->load->model('model_pedidos');

			//Obtiene los datos del usuario para introducirlos en el pedido
			$usuario = $this->model_user->UsuarioID($this->session->userdata('id'));

			$datos = array(
				'id_usuario' => $usuario['id'],
				'fecha' => date('Y-m-d h:i:s a', time()),
				'nombre' => $usuario['nombre'],
				'apellidos' => $usuario['apellidos'],
				'direccion' => $usuario['direccion'],
				'cp' => $usuario['cp'], 
				'dni' => $usuario['dni'], 
				'correo' => $usuario['correo'], 
				'estado' => 'p' 

				);
			//Inserta el pedido y obtiene id de pedido
			$pedidoid = $this->model_pedidos->InsertaPedido($datos);

			//Se insertan todos los productos del carrito
			$carro = $carrito->get_content();
			foreach($carro as $producto){
				$datos_linea = array(
					'id_pedido' => $pedidoid,
					'id_producto' => $producto['id'],
					'precio' => $producto['precio'],
					'cantidad' => $producto['cantidad']  
					);
				$this->model_pedidos->InsertaLinea($datos_linea);
			}
			//Una vez ha terminado el pedido, se vacía el carrito
			$carrito->destroy();
			
			//Vista de éxito
			$this->load->CargaVista('carrito/v_realizado',null);
		}
	}
}

/* End of file ctrl_carrito.php */
/* Location: ./application/controllers/ctrl_carrito.php */