<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class Generate extends CI_Controller {
				function __construct() {
	        // then execute the parent constructor anyway
	        parent::__construct();
	        // $this->load->library('session');

			if(!$this->session->userdata('logged_in'))
				redirect('Login/logout', true);
	    }

		function index(){
			$status = $this->session->userdata('status');
			if($status=='director')
				$this->load->view('templates/headerREAL');
			elseif($status=='Secretariat Committee')
				$this->load->view('templates/headerSecretariat');
			$this->load->view( 'pages/all_teams', array() );
			$this->load->view('templates/footer');
		}
		
		function choosePrint($compID){
		    $this->session->set_userdata('header', 'competitions');
            $this->session->set_userdata('sublevel', 'generateCertificate');
			$status = $this->session->userdata('status');
			if($status=='director')
				$this->load->view('templates/headerREAL');
			elseif($status=='Secretariat Committee')
				$this->load->view('templates/headerSecretariat');

			$data['compID'] = $compID;


			$this->load->view( 'pages/choosePrint', $data);
			$this->load->view('templates/footer');

            $this->session->unset_userdata('header');
            $this->session->unset_userdata('sublevel');

		}



		function printParticipation($compID){
			$data['compID'] = $compID;
			$data['type'] = "participation";
			$this->load->view('templates/headerEditor');
			$this->load->view('pages/editorz', $data);
		}

		function printPlacersForCat($compID){
			$data['compID'] = $compID;
			$data['type'] = "placers";
			$this->load->view('templates/headerEditor');
			$this->load->view('pages/editorz', $data);
		}

		function printPlacers($compID){
			$status = $this->session->userdata('status');
			$this->load->model('compANDcatModel');
			$data['sample'] = $this->compANDcatModel->displayCatByID($compID);
			// foreach($data['sample']->result_array() as $aw){
			// 	print_r($aw);
			// }
			// die();
			$data['type'] = "placers";
			$data['compName'] = $this->compANDcatModel->getCompNamebyCompID($compID);
			$data['compID'] = $compID;
			if($status=='director')
                $this->load->view('templates/headerREAL');
            elseif($status=='Secretariat Committee')
                $this->load->view('templates/headerSecretariat');
			$this->load->view('pages/printcategories', $data);
			
		}

		function getCompNameAndDate($compID){
			$this->load->model('compANDcatModel');
			$aw = $this->compANDcatModel->getCompNameAndDate($compID);
			
			$data = array();

			foreach($aw as $sample){

				$date = date_create($sample['end_date']);
				$data[] = array(
					"competition_name" => $sample['competition_name'],
					"end_date" => date_format($date, "F d, Y")
				);
			}

			header('Access-Control-Allow-Origin: *');
    		header('Access-Control-Allow-Credentials: true');    
    		header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); 
			header('Content-Type: application/json');
			print(json_encode($data, JSON_PRETTY_PRINT));			
		}	

		function getParticipants($compID){

			$this->load->model("compANDcatModel");
			
			//get all teams from comp
			$userList = $this->compANDcatModel->getTeamsFromAttendance($compID);
			

			$teams = array();

			foreach ($userList as $user){
				$teams[] = array(
					"Name" => $user['Name'],
					"team_name" => $user['team_name'],
					"comp_name" => $user['competition_name'],
					"end_date" => $user['end_date']
				);
				
			}

			header('Access-Control-Allow-Origin: *');
    		header('Access-Control-Allow-Credentials: true');    
    		header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); 
			header('Content-Type: application/json');
			print(json_encode($teams, JSON_PRETTY_PRINT));
		}

		function getPlacers($catID){

			$this->load->model("compANDcatModel");
			
			//get all teams from comp
			$userList = $this->compANDcatModel->getTeamWinners($catID);
			

			$teams = array();

			foreach ($userList as $user){
				$teams[] = array(
					"Name" => $user['Name'],
					"team_name" => $user['team_name'],
					"rank" => $user['rank']
				);
				
			}
			
			header('Access-Control-Allow-Origin: *');
    		header('Access-Control-Allow-Credentials: true');    
    		header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); 
			header('Content-Type: application/json');
			print(json_encode($teams, JSON_PRETTY_PRINT));
		}

		function getCatNameCompNameAndDate($catID){
			$this->load->model('compANDcatModel');
			$aw = $this->compANDcatModel->getCatNameCompNameAndDate($catID);
			
			$data = array();

			foreach($aw as $sample){

				$date = date_create($sample['end_date']);

				$data[] = array(
					"competition_name" => $sample['competition_name'],
					"category_name" => $sample['category_name'],
					"end_date" => date_format($date, "F d, Y")
				);
			}

			header('Access-Control-Allow-Origin: *');
    		header('Access-Control-Allow-Credentials: true');    
    		header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); 
			header('Content-Type: application/json');
			print(json_encode($data, JSON_PRETTY_PRINT));			
		}	


	}
?>