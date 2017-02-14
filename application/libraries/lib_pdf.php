<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'third_party/fpdf/fpdf.php';

class Lib_pdf
{
	protected $ci;

	public function __construct()
	{
        $this->ci =& get_instance();
	}

	public function PDF($id_pedido,$pedido,$lineas,$fichero){
		

		$pdf = new FPDF();
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Times','',30);
		
		$pdf->Cell(40,20,'Datos del pedido:');
		$pdf->Ln();

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
			$pdf->Cell($w[0],6,utf8_decode($linea['nombreproducto']),'LR');
			$pdf->Cell($w[1],6,utf8_decode($linea['cantidad']),'LR',0,'C');
			$pdf->Cell($w[2],6,utf8_decode($linea['precio'].' euros'),'LR',0,'R');
			$pdf->Cell($w[3],6,utf8_decode(($linea['precio']*$linea['cantidad']).' euros'),'LR',0,'R');
			$pdf->Ln();
		}		
		$pdf->Cell(array_sum($w),0,'','T');
		if($fichero){
			return $pdf->Output('F','assets/pedido.pdf','true');
		}
		else{
			return $pdf->Output();
		}
	}	

}

/* End of file lib_pdf.php */
/* Location: ./application/libraries/lib_pdf.php */
