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
		redirect(base_url('index.php/Ctrl_carrito'));
	}

	/**
	 *
	 * Vacía el carrito
	 *
	 */
	public function Destroy(){
		$carrito = new Carrito();
		$carrito->destroy();
		redirect(base_url('index.php/Ctrl_carrito'));
	}

	/**
	 *
	 * Quita un producto del carrito
	 *
	 */
	public function Remove_producto($id){
		$carrito = new Carrito();
		$carrito->remove_producto($id);
		redirect(base_url('index.php/Ctrl_carrito'));
	}

	

	//Finaliza el pedido e inserta en la tabla de datos
	public function FinalizaPedido(){
		$carrito = new Carrito();
		$this->load->library('lib_pdf');
		
		$interrumpir = false;
		if($carrito->articulos_total()==0){//No hay productos en el carrito, lleva al index
			redirect(base_url());
		}
		elseif (!($this->session->has_userdata('id'))) {//No hay sesión de usuario, lleva a la página de login
			redirect(base_url('index.php/Ctrl_user'));
		}
		else{//Se puede finalizar el pedido
			$this->load->model('model_user');
			$this->load->model('model_pedidos');
			$this->load->model('model_productos');
			
			//Obtiene los datos del usuario para introducirlos en el pedido
			$usuario = $this->model_user->UsuarioID($this->session->userdata('id'));
			$carro = $carrito->get_content();
			foreach($carro as $producto){
				$stock = $this->model_productos->Stock($producto['id']);
				if($producto['cantidad'] > $stock){
					$mensaje = '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> No hay suficiente stock de '.$producto['nombre'].', por favor, introduzca una cantidad menor.';
					$interrumpir = true; //Se interrumpe la operación de compra, ya que no hay stock suficiente
					break;
				}
			}
			
			if($interrumpir == false){
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
				
				foreach($carro as $producto){
					

					$datos_linea = array(
						'id_pedido' => $pedidoid,
						'id_producto' => $producto['id'],
						'precio' => $producto['precio'],
						'cantidad' => $producto['cantidad']  
						);
					//Se inserta la linea en la base de datos
					$this->model_pedidos->InsertaLinea($datos_linea);
					//Baja el stock del producto
					$this->model_productos->BajaStock($producto['id'], $producto['cantidad']);
				}


				$pedido = $this->model_pedidos->Pedido($pedidoid);
				$lineas = $this->model_pedidos->Lineas($pedidoid);

				//Se crea un array con los datos necesarios de la linea
				$lineasNombre = array();
				foreach ($lineas as $linea) {
					$line = array(
						'nombreproducto' => $this->model_productos->NombreProducto($linea['id_producto']), 
						'cantidad' => $linea['cantidad'],
						'precio' => $linea['precio']
						);
					
					array_push($lineasNombre, $line);
				}

				//Crea el pdf
				$pdf=$this->lib_pdf->PDF($pedidoid,$pedido,$lineasNombre,true);
				
				$this->load->helper('util_helper');
				$tabla = "";

				$tabla .= "<ul>
				<li><strong>Nombre:</strong>".$pedido['nombre']."</li>
				<li><strong>Apellidos:</strong>". $pedido['apellidos']."</li>
				<li><strong>Dirección:</strong>". $pedido['direccion']."</li>
				<li><strong>Código:</strong>". $pedido['cp']."</li>
				<li><strong>Fecha:</strong>".date('d-m-Y' ,strtotime($pedido['fecha']))."</li>
				<li><strong>Hora:</strong>".date('H:m' ,strtotime($pedido['fecha']))."</li>
				<li><strong>Estado:</strong>".EstadoPedido($pedido['estado'])."</li>
				</ul><br/>";
				$tabla .= "<table border='1'><tr>
									<th>Producto</th>
									<th>Cantidad</th>
									<th>Precio</th>
									<th>Subtotal</th>
								</tr>";
				foreach($lineas as $linea){
					$tabla .= "<tr>";
					$tabla .= "<td>".$this->model_productos->NombreProducto($linea['id_producto'])."</td>";
					$tabla .= "<td>".$linea['cantidad']."</td>";
					$tabla .= "<td>".$linea['precio']."</td>";
					$tabla .= "<td>".$linea['cantidad']*$linea['precio']."</td>";
					$tabla .= "</tr>";
				}
				$tabla .= "</table>";
				

				$this->load->library('email');
				
				$this->email->from('aula4@iessansebastian.com', 'MusicOnline');
				$this->email->to($usuario['correo']);
				
				$this->email->subject('Pedido');
				$this->email->message($tabla);
				$this->email->attach('assets/pedido.pdf');
				$this->email->send();
				
				echo $this->email->print_debugger();

				//Una vez ha terminado el pedido, se vacía el carrito
				$carrito->destroy();
			
				//Vista de éxito
				$this->load->CargaVista('carrito/v_realizado',null);
			}
			else{
				$this->load->CargaVista('carrito/v_carrito', array('mensaje' =>  $mensaje , 'carrito'=>$carrito));
			}
			
		}
	}
}

/* End of file Ctrl_carrito.php */
/* Location: ./application/controllers/Ctrl_carrito.php */