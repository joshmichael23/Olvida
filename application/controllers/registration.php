<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class registration extends CI_Controller {



public function __construct(){
        parent::__construct();
        $this -> load -> library('form_validation');
    }
    
    public function DirectorIndex()
    {

        $this->load->view('templates/headerPlain');
        $this->load->view('pages/director_reg');
        $this->load->view('templates/footer');
    }

    public function SchoolIndex()
    {
        $this->load->view('templates/headerPlain');
        $this->load->view('pages/school_reg');
        $this->load->view('templates/footer');
    }

    public function email_exists($email){
      $this->load->model('Connect_Db');
      if($this->Connect_Db->email_check($email)==true){
          return TRUE;
      }
      else
          return FALSE;
    }

    public function username_exists($username){
      $this->load->model('Connect_Db');
      if($this->Connect_Db->username_check($username)==true)
        return TRUE;
      else
        return FALSE;      
    }

    public function register_user(){
 
        $this->load->library('form_validation');
        // echo $this->username_exists($this->input->post('username'));
        // die();
        $this->form_validation->set_rules('firstname', 'First Name', 'required|alpha'); 
        $this->form_validation->set_rules('middlename', 'Middle Name', 'required|alpha');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required|alpha'); 
        $this->form_validation->set_rules('contactno', 'Contact Number', 'required|numeric');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email', 'callback_email_exists');
        $this->form_validation->set_rules('username', 'Username', 'required', 'callback_username_exists'); 
        $this->form_validation->set_rules('password', 'Password', 'required|alpha_numeric|min_length[6]');
        $this->form_validation->set_rules('password1', 'Password Confirmation', 'required|matches[password]');

         
        //LAGAY MUNA SA TAAS PARA MAREMEMBER ANG MGA PINOST

        if($this->form_validation->run() == TRUE){
              echo "form is validated";
              
              $user=array(
                'first_name'=>$this->input->post('firstname'),
                'middle_name'=>$this->input->post('middlename'),
                'last_name'=>$this->input->post('lastname'),
                'contact_no'=>$this->input->post('contactno'),
                'email'=>$this->input->post('email'),
                'username'=>$this->input->post('username'),
                'password'=>$this->input->post('password'),
              );
 
              $this->load->model('Connect_Db');
              $this->Connect_Db->register_user($user);

              $code;

              do{   
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);

                $randomString = '';

                for ($j = 0; $j < 6; $j++){
                   $randomString .= $characters[rand(0, $charactersLength - 1)];
                    //      //PUTANGINANG MGA CODE DIGDI PARA SA PAGREGISTER
                }
                $code = $randomString;
                $this->load->model('compANDcatModel');
              }while($this->compANDcatModel->checkCodesApproval($code)==true);

              $this->load->model('Connect_Db');
              $this->Connect_Db->DirectorRequestApproval($user, $code);
              // $this->session->set_flashdata('success', 'Successfuly requested!');
              $this->session->set_flashdata('success', 'Successfully registered account. Please wait for approval!');
              redirect('Login/home');



       }
       $this->load->view('templates/headerPlain');
       $this->load->view('pages/director_reg');
       $this->load->view('templates/footer');
       
  }

  public function register_school(){
 

        $this->load->library('form_validation');
        $this->form_validation->set_rules('school_name', 'School Name', 'required'); 
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('user', 'Username',  'required', 'callback_username_exists');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email', 'callback_email_exists');
        $this->form_validation->set_rules('pass', 'Password', 'required|alpha_numeric|min_length[6]');
        $this->form_validation->set_rules('pass1', 'Password Confirmation', 'required|matches[pass]');

        $aw = $this->input->post('school_name');


        if($this->form_validation->run() == TRUE){

             

              $school=array(
                'school_name'=>$this->input->post('school_name'),
                'address'=>$this->input->post('address'),
                'email'=>$this->input->post('email'),
                'user'=>$this->input->post('user'),
                'pass'=>$this->input->post('pass'),
              );

              $this->load->model('Connect_Db');
              $this->Connect_Db->registerSchool($school);


              $code;

              do{   
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);

                $randomString = '';

                for ($j = 0; $j < 6; $j++){
                   $randomString .= $characters[rand(0, $charactersLength - 1)];
                    //      //PUTANGINANG MGA CODE DIGDI PARA SA PAGREGISTER
                }
                $code = $randomString;
                $this->load->model('compANDcatModel');
              }while($this->compANDcatModel->checkCodesApproval($code)==true);

              $this->load->model('Connect_Db');
              $this->Connect_Db->SchoolRequestApproval($school, $code);
              $this->session->set_flashdata('success', 'Successfully registered account. Please wait for approval!');
              redirect('Login/home');

       }
       $this->load->view('templates/headerPlain');
       $this->load->view('pages/school_reg');
       $this->load->view('templates/footer');
     
  }
}
?>
