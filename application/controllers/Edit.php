<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class Edit extends CI_Controller {


        public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url'));
        }

		function index(){
			$this->load->view('templates/headerREAL');
			$this->load->view('pages/all_teams', array());
			$this->load->view('templates/footer');
		}
		
		function editparticipant($participantID){   

	            $fname = $this->input->post('first_name');
	            $mname = $this->input->post('middle_name');
	            $lname = $this->input->post('last_name');
	            $address = $this->input->post('address');
	            $contactno = $this->input->post('contactno');
	            $email = $this->input->post('email');

	            $user = array(
	            		'first_name'=>$fname,
	            		'middle_name'=>$mname,
	            		'last_name'=>$lname,
	            		'address'=>$address,
	            		'contactno'=>$contactno,
	            		'email'=>$email
	            );

			


			$this->load->model('team_model');
			$this->team_model->editParticipant($user, $participantID);


			$config['upload_path']          = './uploads/matriculations/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['overwrite'] 			= TRUE;
            $config['max_size']             = 100;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;

            $this->load->library('upload', $config);

           	// if ( ! $this->upload->do_upload('userfile'))
            // {
            //     $error = array('error' => $this->upload->display_errors());
            //            // $this->load->view('pages/upload_form', $error);
            //     echo "aw";
            //     die();
            // }
            if ($this->upload->do_upload('userfile'))
            {
                $data = array('upload_data' => $this->upload->data());
                
                	if($this->team_model->checkMatri($participantID)!=true){
	  		            $insert = array(
	                				'participant_id' => $participantID,
	        	                    'file_name' => $data['upload_data']['file_name'],
	            	                'upload_path' => $data['upload_data']['full_path']
	        	        		  );
	                       
	                	$this->db->insert('photos', $insert);
            		}
            		else{
            			// $insert = array(
	              //   				'participant_id' => $participantID,
	        	     //                'file_name' => $data['upload_data']['file_name'],
	            	 //                'upload_path' => $data['upload_data']['full_path']
	        	     //    		  );
            			
            			$file_name = $data['upload_data']['file_name'];
            			$uplod_path = $data['upload_data']['full_path'];
            			$this->team_model->updateMatri($participantID, $file_name);
                       // $this->load->view('pages/upload_success', $data);
            		}
            }
                


			redirect('School_teams/participants');


		}
	}

?>