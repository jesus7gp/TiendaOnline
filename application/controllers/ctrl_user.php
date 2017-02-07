<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_user extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			$this->load->model('model_categorias');
			
		}

	//El index será el inicio de sesión		
	public function index()
	{
		$this->load->library('form_validation');	
		$this->load->model('model_user');
	
		if (!$this->input->post()){
			$this->load->CargaVista('user/v_login', null);
		}
		else{
			$usuario = $this->model_user->CompruebaUsuario($this->input->post());
			if($usuario & $usuario['activo'] == 1){
				$newdata = array(
        			'nombre'     => $usuario['nombre'],
        			'id' => $usuario['id']
				);
				$this->session->set_userdata($newdata);
				redirect(base_url());
			}
			else{
				$this->load->CargaVista('user/v_login', null);
			}			
		}
	}

	//Edita los datos del usuario que se encuentra en la sesión
	public function EditarDatos(){
		$this->load->model('model_provincias');
		$this->load->model('model_user');
		$this->load->library('form_validation');
		$listaProvincias = $this->model_provincias->ListaProvincias();
		$usuario = $this->model_user->UsuarioID($this->session->userdata('id'));
		
		//Reglas de validación del formulario
		$this->form_validation->set_error_delimiters('<div style="color:tomato"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>', '</div>');
		
		$this->form_validation->set_rules('nombre', 'nombre', 'required');
		$this->form_validation->set_rules('apellidos', 'apellidos', 'required');
		$this->form_validation->set_rules('dni', 'DNI', 'required');
		$this->form_validation->set_rules('provincia', 'provincia', 'required|greater_than[0]',array('greater_than'=>'El campo provincia es obligatorio.'));
		$this->form_validation->set_rules('cp', 'código postal', 'required');
		$this->form_validation->set_rules('direccion', 'dirección', 'required');
				
		
		if ($this->form_validation->run() == FALSE){
			$this->load->CargaVista('user/v_micuenta', array('usuario' => $usuario,'ListaProvincias' => $listaProvincias));
        }
        else {
            $this->model_user->CambiaDatos($this->session->userdata('id'), $this->input->post());

            
			redirect(base_url());

        }
	}

	public function CancelarPedido($id){
		$this->load->model('model_pedidos');
		$this->load->model('model_productos');
		$this->model_pedidos->Cancelar($id);
		$lineas = $this->model_pedidos->Lineas($id);
		foreach($lineas as $linea){
			$this->model_productos->SubeStock($linea['id_producto'], $linea['cantidad']);
		}
		redirect(base_url('index.php/ctrl_user/VerPedidos'));
	}

	public function NuevaClave(){

		$this->load->model('model_user');
		$this->load->library('form_validation');

		//Reglas de validación del formulario
		$this->form_validation->set_error_delimiters('<div style="color:tomato"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>', '</div>');
		$this->form_validation->set_rules('clave', 'contraseña', 'required');
		$this->form_validation->set_rules('repclave', 'confirmar contraseña', 'required|matches[clave]');
						
		if ($this->form_validation->run() == FALSE){
			$this->load->CargaVista('user/v_pass', null);
        }
        else {
            $this->model_user->CambiaPass($this->session->userdata('id'), $this->input->post());
			redirect(base_url());

        }
	}

	//Se da de baja al usuario, simplemente cambiando el campo correspondiente de la base de datos
	//No elimina nada de la base de datos
	public function Baja(){
		$carrito = new Carrito();
		$this->load->model('model_user');
		$this->model_user->DarBaja($this->session->userdata('id'));

		//Hace el logout
		$this->session->unset_userdata('nombre');
		$this->session->unset_userdata('id');
		redirect(base_url());
	}

	//Sin destruir la sesión, hace un unset de las variables de sesión asociadas al usuario
	public function logout(){
		$carrito = new Carrito();
		$this->session->unset_userdata('nombre');
		$this->session->unset_userdata('id');
		redirect(base_url());
	}

	public function correo(){
		$this->load->library('form_validation');
		$this->load->model('model_user');
		$this->form_validation->set_error_delimiters('<div style="color:tomato"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>', '</div>');
		$this->form_validation->set_rules('usuario', 'usuario', 'required');
		$this->form_validation->set_rules('correo', 'email', 'required|valid_email');
						
		if ($this->form_validation->run() == FALSE){
			$this->load->CargaVista('user/v_recuperapass', null);
        }
        else {
        	$user = $this->model_user->CompruebaCorreo($this->input->post());
        	if($user){
        		$enlace = base_url().'/index.php/ctrl_user/recover/'.$user['id'].'/'.sha1(date('Y-m-d'));

        		$this->load->library('email');
				$this->email->set_mailtype("html");
				$this->email->from('aula4@iessansebastian.com', 'MusicOnline');
				$this->email->to($this->input->post()->correo);
		
				$this->email->subject('Cambio de contraseña');
				$this->email->message('Por favor, cambie su contraseña <a href="'.$enlace.'">aquí</a>');
		
				$this->email->send();
		
				echo $this->email->print_debugger();
        	}
            
			redirect(base_url());

        }
		
	}

	public function recover($id, $fecha){
		$this->load->library('form_validation');
		$this->load->model('model_user');

		$hoy = sha1(date('Y-m-d'));
		if($fecha = $hoy){
			$this->form_validation->set_error_delimiters('<div style="color:tomato"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>', '</div>');
			$this->form_validation->set_rules('clave', 'contraseña', 'required');
			$this->form_validation->set_rules('repclave', 'confirmar contraseña', 'required|matches[clave]');
							
			if ($this->form_validation->run() == FALSE){
				$this->load->CargaVista('user/v_pass', null);
	        }
	        else {
	            $this->model_user->CambiaPass($id, $this->input->post());
				redirect(base_url());

	        }
		}

	}

	//Registro que guarda un usuario nuevo en la base de datos
	public function registro(){
		$this->load->model('model_provincias');
		$this->load->model('model_user');
		$this->load->library('form_validation');

		$listaProvincias = $this->model_provincias->ListaProvincias();

		//Reglas de validación del formulario
		$this->form_validation->set_error_delimiters('<div style="color:tomato"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>', '</div>');
		$this->form_validation->set_rules('usuario', 'usuario', 'required|is_unique[usuario.usuario]',array('is_unique'=>'El usuario ya existe.'));
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
			$this->load->CargaVista('user/v_registro', array('ListaProvincias' => $listaProvincias));
        }
        else {
            $this->model_user->InsertaUsuario($this->input->post());

            $usuario = $this->model_user->CompruebaUsuario($this->input->post());
            $newdata = array(
        			'nombre'     => $usuario['nombre'],
        			'id' => $usuario['id']
				);
			$this->session->set_userdata($newdata);
			redirect(base_url());

        }

	}

	//Se ven los pedidos del usuario que se encuentra en la sesión
	public function VerPedidos(){
		$this->load->helper('util');
		$this->load->model('model_provincias');
		$this->load->model('model_pedidos');
		$this->load->model('model_user');

		$pedidos = $this->model_pedidos->SacaPedidos($this->session->userdata('id'));
		$listaProvincias = $this->model_provincias->ListaProvincias();
		$usuario = $this->model_user->UsuarioID($this->session->userdata('id'));
		$this->load->CargaVista('user/v_mispedidos', 
			array('usuario' => $usuario,
				'ListaProvincias' => $listaProvincias,
				'pedidos' => $pedidos 
				));
	}

	public function UnPedido($id_pedido){
		$this->load->helper('util');
		$this->load->model('model_provincias');
		$this->load->model('model_pedidos');
		$this->load->model('model_user');
		$this->load->model('model_productos');
		$pedido = $this->model_pedidos->Pedido($id_pedido);
		$lineas = $this->model_pedidos->Lineas($id_pedido);
		$listaProvincias = $this->model_provincias->ListaProvincias();
		$usuario = $this->model_user->UsuarioID($this->session->userdata('id'));
		$this->load->CargaVista('user/v_pedido', 
			array('usuario' => $usuario,
				'lineas' => $lineas, 
				'pedido' => $pedido 
				));
	}

	public function CreaPDF($id_pedido){
		$this->load->model('model_pedidos');
		$this->load->model('model_productos');
		$pedido = $this->model_pedidos->Pedido($id_pedido);
		$lineas = $this->model_pedidos->Lineas($id_pedido);

		$this->load->library('lib_pdf');
		$pdf = new FPDF();
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Times','',12);
		
		//DATOS DEL PEDIDO
		$fecha = date("d-m-Y",strtotime($pedido["fecha"]));
		$hora = date("H:m",strtotime($pedido["fecha"]));
		$pdf->Cell(40,6,utf8_decode('·Nombre: '.$pedido['nombre']));
		$pdf->Ln();
		$pdf->Cell(40,6,utf8_decode('·Apellidos: '.$pedido['apellidos']));
		$pdf->Ln();
		$pdf->Cell(40,6,utf8_decode('·Dirección: '.$pedido['direccion']));
		$pdf->Ln();
		$pdf->Cell(40,6,utf8_decode('·Código postal: '.$pedido['cp']));
		$pdf->Ln();
		$pdf->Cell(40,6,utf8_decode('·Fecha: '.$fecha));
		$pdf->Ln();
		$pdf->Cell(40,6,utf8_decode('·Hora: '.$hora));
		$pdf->Ln();

		//TABLA DE LINEAS DE PEDIDO
		$w = array(60, 20, 30, 30);

		$header = array('Producto','Cantidad','Precio','Subtotal');

		for($i=0;$i<count($header);$i++)
        $pdf->Cell($w[$i],7,$header[$i],1,0,'C');
    	$pdf->Ln();
		foreach($lineas as $linea){
			$pdf->Cell($w[0],6,utf8_decode($this->model_productos->NombreProducto($linea['id_producto'])),'LR');
			$pdf->Cell($w[1],6,utf8_decode($linea['cantidad']),'LR',0,'C');
			$pdf->Cell($w[2],6,utf8_decode($linea['precio'].' euros'),'LR',0,'R');
			$pdf->Cell($w[3],6,utf8_decode(($linea['precio']*$linea['cantidad']).' euros'),'LR',0,'R');
			$pdf->Ln();
		}		
		$pdf->Cell(array_sum($w),0,'','T');
		$pdf->Output();
	}

}

/* End of file ctrl_user.php */
/* Location: ./application/controllers/ctrl_user.php */