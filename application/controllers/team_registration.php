<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class team_registration extends CI_Controller{


    function __construct() {
            parent::__construct();
            if(!$this->session->userdata('logged_in'))
                redirect('Login/home', true);
    }

    
    public function index()
    {
        if($this->session->userdata('logged_in')==true){
            if($this->session->userdata('status') == 'school'){
                $this->load->view('templates/headerSchool');
                $this->load->view('pages/team_reg');
                $this->load->view('templates/footer');
            }
        }
        else{
            $this->load->view('login/index');   
        }

        
    }

    public function team_name(){

        $this->load->library('form_validation');

        $this->form_validation->set_rules("teamname","Team Name", 'ucwords|required|is_unique[team.team_name]');
        $teamname = $this->input->post("teamname");

        $this->form_validation->set_rules("coach_fname","First Name", 'ucwords');
        $this->form_validation->set_rules("coach_mname","Middle Name", 'ucwords');
        $this->form_validation->set_rules("coach_lname","Last Name", 'ucwords');
        $this->form_validation->set_rules("coach_contactno","Contact No");
        $this->form_validation->set_rules("coach_email","Email|is_unique[coach.email]");
        $this->form_validation->set_rules("coach_address","Address", 'ucwords');
        
        $this->form_validation->set_rules("part_fname","First Name", 'ucwords|required');
        $this->form_validation->set_rules("part_mname","Middle Name", 'ucwords|required');
        $this->form_validation->set_rules("part_lname","Last Name", 'ucwords|required');
        $this->form_validation->set_rules("part_contactno","Contact No", 'required');
        $this->form_validation->set_rules("part_email","Email", 'required|is_unique[participant.email]');
        $this->form_validation->set_rules("part_address","Address", 'ucwords|required');

        $this->form_validation->set_rules("part_fname1","First Name", 'ucwords');
        $this->form_validation->set_rules("part_mname1","Middle Name", 'ucwords');
        $this->form_validation->set_rules("part_lname1","Last Name", 'ucwords');
        $this->form_validation->set_rules("part_contactno1","Contact No", '');
        $this->form_validation->set_rules("part_email1","Email", 'is_unique[participant.email]');
        $this->form_validation->set_rules("part_address1","Address", 'ucwords');


        $this->form_validation->set_rules("part_fname2","First Name", 'ucwords');
        $this->form_validation->set_rules("part_mname2","Middle Name", 'ucwords');
        $this->form_validation->set_rules("part_lname2","Last Name", 'ucwords');
        $this->form_validation->set_rules("part_contactno2","Contact No", '');
        $this->form_validation->set_rules("part_email2","Email", 'is_unique[participant.email]');
        $this->form_validation->set_rules("part_address2","Address", 'ucwords');


        if($this->form_validation->run()){

            $this->load->model("team_model");

            $teamname = $this->input->post("teamname");
                    # $school = $this->team_model->getSchoolName();
            $data = array(
                "school_id" => $this->session->userdata('id'),
                "team_name" => $this->input->post("teamname"),
                
            #"school_id" => $this->team_model->getSchoolID($school)
            );

            
            $this->team_model->insert_data_team($data);


            $coach = array(
            "first_name" => $this->input->post("coach_fname"),
            "middle_name" => $this->input->post("coach_mname"),
            "last_name" => $this->input->post("coach_lname"),
            "contact_no" => $this->input->post("coach_contactno"),
            "email" => $this->input->post("coach_email"),
            "address" => $this->input->post("coach_address"),
            "team_id" => $this->team_model->getTeamID($teamname)
            );

          $part = array(
            "first_name" => $this->input->post("part_fname"),
            "middle_name" => $this->input->post("part_mname"),
            "last_name" => $this->input->post("part_lname"),
            "contact_no" => $this->input->post("part_contactno"),
            "email" => $this->input->post("part_email"),
            "address" => $this->input->post("part_address"),
            "team_id" => $this->team_model->getTeamID($teamname)
            );


           
           $part1 = array(
            "first_name" => $this->input->post("part_fname1"),
            "middle_name" => $this->input->post("part_mname1"),
            "last_name" => $this->input->post("part_lname1"),
            "contact_no" => $this->input->post("part_contactno1"),
            "email" => $this->input->post("part_email1"),
            "address" => $this->input->post("part_address1"),
            "team_id" => $this->team_model->getTeamID($teamname)
            );

            $part2 = array(
            "first_name" => $this->input->post("part_fname2"),
            "middle_name" => $this->input->post("part_mname2"),
            "last_name" => $this->input->post("part_lname2"),
            "contact_no" => $this->input->post("part_contactno2"),
            "email" => $this->input->post("part_email2"),
            "address" => $this->input->post("part_address2"),
            "team_id" => $this->team_model->getTeamID($teamname)
            );


            $this->team_model->insert_data_participant($part);
            if(!in_array("", $part1))
                $this->team_model->insert_data_participant($part1);
            if(!in_array("", $part2))
                $this->team_model->insert_data_participant($part2);
            $this->team_model->insert_data_coach($coach);
            redirect('School_teams/index');
        }

      else
      {
        $this->session->set_flashdata('error_msg', 'Error occured, Try again.');
        redirect('team_registration/index');
        
      }

    }   


    
   
}
?>
