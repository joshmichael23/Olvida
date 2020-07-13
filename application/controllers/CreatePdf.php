<?php

class CreatePdf{

	function pdf(){
    	$this->load->library('Mytcpdf');
    	$data['txt']= <<<EOD

EOD;

    	$this->load->view('pages/tcpdf', $data);
	}
}

?>