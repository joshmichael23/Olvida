<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class Account extends CI_Controller {

		 public function index(){
		 	$status = $this->session->userdata('status');
		 	$id =$this->session->userdata('id');
		 	$this->load->model('Connect_Db');

		 	if($status=='director'){
		 		$data['result']= $this->Connect_Db->getAccountDirector($id);

		 		$this->load->view('templates/headerREAL');
		 		$this->load->view('pages/EditAccountDirector', $data);
		 		$this->load->view('templates/footer');
		 	}
		 	else{
		 		$data['result']= $this->Connect_Db->getAccountSchool($id);
		 		$this->load->view('templates/headerREAL');
		 		$this->load->view('pages/EditAccountSchool', $data);
		 		$this->load->view('templates/footer');
		 	}
		 }

		public function processEdit($ID){
		 	$status = $this->session->userdata('status');
		 	$this->load->model('Connect_Db');

		 	if($status=='director'){
		 		$data['result']= $this->Connect_Db->getAccountDirector($ID);

		 		$this->load->view('templates/headerREAL');
		 		$this->load->view('pages/ProcessEditDirector', $data);
		 		$this->load->view('templates/footer');
		 	}
		 	else{
		 		$data['result']= $this->Connect_Db->getAccountSchool($ID);
		 		$this->load->view('templates/headerREAL');
		 		$this->load->view('pages/ProcessEditSchool', $data);
		 		$this->load->view('templates/footer');
		 	}
		}

		public function EditAccountDirector($ID){
			$password = $this->input->post('Password');
			$confirmpassword = $this->input->post('ConfirmPassword');
			$email = $this->input->post('Email');
			$contactno = $this->input->post('ContactNo');

			$this->load->model('Connect_Db');
			$data = $this->Connect_Db->getAccountDirector($ID);

			//change password

			if($password!='' && $password != $data->row()->password || $email != $data->row()->email || $contactno != $data->row()->contact_no){
				if($password!='' && $confirmpassword!='' && $password==$confirmpassword){
						$this->session->set_flashdata('Success', 'Edit Successful!');
						$this->Connect_Db->submitDirectorChanges($ID, $email, $contactno, $password);
						redirect('Account/index');
				}
				else{
					if($email != $data->row()->email || $contactno != $data->row()->contact_no){
						$this->session->set_flashdata('Success', 'Edit Successful!');
						$this->Connect_Db->submitDirectorChanges($ID, $email, $contactno, $data->row()->password);
						redirect('Account/index');
					}
					else{
						$this->session->set_flashdata('Error', 'No Changes Made');	
						redirect('Account/index');
					}
				}
			}
			else{
						$this->session->set_flashdata('Error', 'No Changes Made');
						//$this->Connect_Db->submitDirectorChanges($ID, $email, $contactno, $data->row()->password);
						redirect('Account/index');
			}
		}


		public function EditAccountSchool($ID){
			$password = $this->input->post('Password');
			$confirmpassword = $this->input->post('ConfirmPassword');
			$email = $this->input->post('Email');
			//$contactno = $this->input->post('ContactNo');

			$this->load->model('Connect_Db');
			$data = $this->Connect_Db->getAccountSchool($ID);

			//change password

			if($password!='' && $password != $data->row()->password || $email != $data->row()->email){
				if($password!='' && $confirmpassword!='' && $password==$confirmpassword){
						$this->session->set_flashdata('Success', 'Edit Successful!');
						$this->Connect_Db->submitSchoolChanges($ID, $email, $password);
						redirect('Account/index');
				}
				else{
					if($email != $data->row()->email){
						$this->session->set_flashdata('Success', 'Edit Successful!');
						$this->Connect_Db->submitSchoolChanges($ID, $email, $data->row()->password);
						redirect('Account/index');
					}
					else{
						$this->session->set_flashdata('Error', 'No Changes Made');	
						redirect('Account/index');
					}
				}
			}
			else{
						$this->session->set_flashdata('Error', 'No Changes Made');
						//$this->Connect_Db->submitDirectorChanges($ID, $email, $contactno, $data->row()->password);
						redirect('Account/index');
			}
		}

	}
?>