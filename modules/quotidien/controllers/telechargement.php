<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Telechargement extends CI_Controller {
	
     public function index()
	{           
		
	}

public function download_pdf($pdf)
	{					
		$this->load->helper('download');		
		$data = file_get_contents("pdf/".$pdf); 
		$name = $pdf;		
		force_download($name, $data);
	}

}