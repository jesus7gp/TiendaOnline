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

	

}

/* End of file lib_pdf.php */
/* Location: ./application/libraries/lib_pdf.php */
