<?php

	class editor2 extends CI_Controller {

	 // 	function __construct() {

	 //        header('Access-Control-Allow-Origin: *');
	 //        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
	 //        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
	 //        $method = $_SERVER['REQUEST_METHOD'];
	 //        if($method == "OPTIONS") {
	 //            die();
  //       	}

  //       	parent::__construct();
		// }

		function index(){
			//array
			$data['sample'] = array(
								'data1' => 0,
								'data2'	=> 1
								);
			// $data['sample'] = "joash";
			$this->load->view('templates/headerEditor');
			$this->load->view('pages/editorz', $data);
		}

		function try(){

			$data[0] = array(
					'data1' => 'Josh Michael Olea',
					'data2'	=> 'joawdhi'
					);
			$data[1] = array(
					'data1' => 'Kyle Villegas',
					'data2'	=> 'joawdhi'
					);

			header('Access-Control-Allow-Origin: *');
    		header('Access-Control-Allow-Credentials: true');    
    		header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); 
			header('Content-Type: application/json');
			print(json_encode($data));
			
		}
		
}

?>
