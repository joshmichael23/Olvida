<?php

	class signup extends CI_Controller {

		function index(){
			$this->load->view('templates/headerPlain');
			$this->load->view( 'pages/signup');
			$this->load->view('templates/footer');
		}
		


	}
?>