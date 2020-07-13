<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
/*
    function __construct(){
            parent::__construct();
            // to protect the controller to be accessed only by registered users
    
    }
*/

    public function home(){
            $this->load->view('templates/header');
            $this->load->view('templates/footer');
    }

    public function code(){
            $this->load->view('templates/header');
            $this->load->view('pages/entercode');
            $this->load->view('templates/footer');
    }

    public function entercode(){
            $code = $this->input->post('code');
            // echo $code;
            // die();
            $this->load->model('Connect_Db');
            $this->Connect_Db->enterCode($code);

            if($this->Connect_Db->enterCode($code)==true){
                $this->session->set_flashdata('success', "Successfully entered code!");
                redirect('login/home');
            }
            else{
                $this->session->set_flashdata('error', "Invalid code!");
                redirect('login/home');
            }
    }

    public function index(){

      if($this->session->userdata('logged_in')==true){
        $this->load->model('compANDcatModel');
        $this->load->model('team_model');
        $ID = $this->session->userdata('id');
        $username = $this->session->userdata('user');
        $status = $this->session->userdata('status');
    
        
        $data['sample'] = $this->compANDcatModel->countCompetitions($ID);
        $data['sample1'] = $this->compANDcatModel->countTeams();
        $data['sample2'] = $this->compANDcatModel->countAllComp();
        $data['sample3'] = $this->team_model->countTeams($ID);
        $data['sample4'] = $this->compANDcatModel->secCountComp($ID,$status);
        if($status=='director'){
            
                $this->load->view('templates/headerREAL');
                $this->load->view('pages/homez', $data);
                $this->load->view('templates/footer');
        
        }

        else if($status=='school'){
           

            $this->load->view('templates/headerSchool');
            $this->load->view('pages/homezschool',$data);
            $this->load->view('templates/footer');
            
        }
        else if($status=='Secretariat Committee'){
            
            $this->load->view('templates/headerSecretariat');
            $this->load->view('pages/homezsec',$data);
            $this->load->view('templates/footer');
            
        }
        else if($status=='Technical Committee'){
            $this->load->view('templates/headerTechnical');
            $this->load->view('pages/homeztec');
            $this->load->view('templates/footer');

        }
        else if($status=='Admin'){
            $this->load->view('templates/headerAdmin');
            $this->load->view('pages/homezadmin');
            $this->load->view('templates/footer');               
        }
    }
    else{
            redirect('Login/home'); 
    }

}
  

    public function process()
    {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required'); 
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_error_delimiters('<div class "text-danger">', '</div>');

        if($this->form_validation->run() ){

            $this->load->library('session');
            $user = $this->input->post('username');
            $pass = $this->input->post('password');
       
            $this->load->model('Connect_Db');
              
            $status = $this->Connect_Db->checkSchoolORDirector($user, $pass);

        
            if($status=='director'){
                $id = $this->Connect_Db->getDirectorID($user);
                $whole_name = $this->Connect_Db->getDirectorName($id);

                if($this->Connect_Db->checkDirectorIfApproved($id)==true){


                    $sess_array = array(
                        'id'        => $id,
                        'user'  =>  $user,
                        'logged_in'    =>  true,
                        'status' => $status,
                        'whole_name' => $whole_name
                    );

                    
                    $this->session->set_userdata($sess_array);
                    $this->session->set_userdata('logged_in', true);
                    redirect('login/index');
                }
                else{
                    $this->session->set_flashdata('error', 'Account is not yet approved!');
                    redirect('login/home');
                }
            }

            else if($status=='school'){
                $id = $this->Connect_Db->getSchoolID($user);
                $school = $this->Connect_Db->getSchoolName($id);
                 

                if($this->Connect_Db->checkSchoolIfApproved($id)==true){
                    $sess_array = array(
                        'id'        => $id,
                        'user'  =>  $user,
                        'logged_in'    =>  true,
                        'status' => $status,
                        'school_name' => $school
                    );                 
                    
                    $this->session->set_userdata($sess_array);
                    $this->session->set_userdata('logged_in', true);
                    redirect('Login/index');
                }
                else{
                    $this->session->set_flashdata('error', 'Account is not yet approved!');
                    redirect('login/home');
                }

            }
            
             else if($status=='Technical Committee'){
                $id = $this->Connect_Db->getDirectorIDofCom($user);
           
                 
                $sess_array = array(
                    'id'        => $id,
                    'user'  =>  $user,
                    'logged_in'    =>  true,
                    'status' => $status,
                  
                );

                
                $this->session->set_userdata('logged_in', true);
                $this->session->set_userdata($sess_array);
                redirect('Login/index');
            }
             else if($status=='Secretariat Committee'){
                $id = $this->Connect_Db->getDirectorIDofCom($user);
           
                 
                $sess_array = array(
                    'id'        => $id,
                    'user'  =>  $user,
                    'logged_in'    =>  true,
                    'status' => $status,
                  
                );
                $this->session->set_userdata('logged_in', true);
                $this->session->set_userdata($sess_array);
                redirect('Login/index');
            }
            else if($status=='Admin'){
                $id = $this->Connect_Db->getAdminID($user);
                
                 
                $sess_array = array(
                    'id'        => $id,
                    'user'  =>  $user,
                    'logged_in'    =>  true,
                    'status' => $status,
                  
                );
                $this->session->set_userdata('logged_in', true);
                $this->session->set_userdata($sess_array);
                redirect('Login/index');
            }


            else{
                $this->session->set_flashdata('error','Invalid username or password');
                redirect('Login/home');
            }
        }
        else{
            $this->session->set_flashdata('error','Invalid username or password');
            redirect('Login/home');
        }
    }
    




    


   public function logout()
    {
            // var_dump($this->session->all_userdata());
            // die();
        //removing session
        session_destroy();
        redirect("/login");
    }

}

?>