<?php

class User extends CI_Controller {



public function index()
{
$this->load->view("register.php");
}

public function register_user(){
      $user=array(
      'user_name'=>$this->input->post('user_name'),
      'user_email'=>$this->input->post('user_email'),
      'password'=>md5($this->input->post('user_password')),
      'user_age'=>$this->input->post('user_age'),
      'user_mobile'=>$this->input->post('user_mobile')
        );
        print_r($user);
 
$email_check=$this->user_model->email_check($user['user_email']);
 
if($email_check){
  $this->user_model->register_user($user);
  $this->session->set_flashdata('success_msg', 'Registered successfully.Now login to your account.');
  redirect('user/login_view');
 
}
else{
 
  $this->session->set_flashdata('error_msg', 'Error occured,Try again.');
  redirect('user');
 
 
}

}


public function login_view(){
 
$this->load->view("login.php");
 
}

 
}
?>