<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class editor extends CI_Controller {

		function index(){
			$this->load->view('templates/headerREAL');
			$this->load->view('pages/editor/index.html');
			$this->load->view('templates/footer');
		}
	}
?>