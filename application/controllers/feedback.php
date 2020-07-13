<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feedback extends CI_Controller {
 
 public function __construct()
 {
  parent::__construct();
//   $this->load->model('csv_import_model');
//   $this->load->library('csvimport');
 }
function index(){
    if($this->session->userdata('status')=='director'){
     

        $this->load->view('templates/headerREAL');
        $this->load->view('pages/feedbackDirector');
        $this->load->view('templates/footer');

    }
    else{
    $this->load->view('templates/headerSchool');
    $this->load->view('pages/feedbackSchool');
    $this->load->view('templates/footer');
    }
}



}