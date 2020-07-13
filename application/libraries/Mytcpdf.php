<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require('tcpdf/tcpdf.php');

class Mytcpdf extends TCPDF{ 

	public function __construct() { 
		parent::__construct(); 
		$CI =& get_instance();
	}

}

/*Author:Tutsway.com */
/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */
?>