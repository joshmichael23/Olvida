<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class home extends CI_Controller {

        function __construct() {
            // then execute the parent constructor anyway
            parent::__construct();
            // $this->load->library('session');

            if(!$this->session->userdata('logged_in'))
                redirect('Login/logout', true);
        }

    public function index(){
   
    	if($this->session->userdata('logged_in')==true){
    		$this->load->view('templates/headerREAL');
            redirect('home/index');
        	$this->load->view('templates/footer');
        }
        else{
            $this->load->view('templates/header');
        	$this->load->view('pages/login');
            $this->load->view('templates/footer');	
        }
       
    }

    public function approve($role, $id){
        $this->load->library("phpmailer_library");
        $objMail = $this->phpmailer_library->load();
        
        $this->load->model('Connect_Db');
        $code = $this->Connect_Db->getCode($id, $role);

        $email = $this->Connect_Db->getEmail($id, $role);

        $this->mail = new PHPMailer(true);

            try {
                    $this->mail->isSMTP();
                    $this->mail->SMTPAuth = true;
                    $this->mail->SMTPSecure = 'ssl';
                    $this->mail->Host = 'smtp.gmail.com';
                    $this->mail->Port = '465';
                    $this->mail->isHTML();
                    $this->mail->Username = 'olvidasystem@gmail.com';
                    $this->mail->Password = 'Olvida123';
                    $this->mail->SetFrom('no-reply@olvida.com');
                    $this->mail->Subject = 'Verification Code';
                    $this->mail->Body = '
                    <h4 style="text-align: center;">Congratulations! Your request has been accepted by the admin!&nbsp;</h4>
                    <p>&nbsp;</p>
                    <h4 style="text-align: center;">Enter this code so that you can login to the system!</h4>
                    <h1 style="text-align: center;"><span style="text-decoration: underline;"> ' . $code . '</span></h1>
                    <p>&nbsp;</p>';
                    
                    $this->mail->AddAddress($email);

                    $this->mail->Send();


                    $this->session->set_flashdata('approved', 'Approval Successful!');
                    $this->Connect_Db->sentEmailFunc($id, $role);
                    redirect("competitions/pendingrequests");

                    
            } catch(phpmailerException $e) {
              $this->session->set_flashdata('disapprove', $e->errorMessage()); //Pretty error messages from PHPMailer
              redirect("home/pendingrequest");
            }



    }

    public function disapprove($role, $id){
        $this->load->model('Connect_Db');
        $this->Connect_Db->disapprove($role, $id);
        redirect('home/pendingrequest');
    }

    public function pendingrequest(){
        if($this->session->userdata('logged_in')==true){


            $this->load->model('Connect_Db');

            if($this->Connect_Db->PendingDirectorRequest()!=false)
                $data['director'] = $this->Connect_Db->PendingDirectorRequest();
            else
                $data['director'] = '';
            
            
            if($this->Connect_Db->PendingSchoolRequest()!=false)
                $data['school'] = $this->Connect_Db->PendingSchoolRequest();
            else
                $data['school'] = '';

            $this->load->view('templates/headerAdmin');
            $this->load->view('pages/pendingrequest', $data);
            $this->load->view('templates/footer');      
        }
        else{
            redirect('login/index');
        }
    }

    function pdf($id){
        $this->load->model('compANDcatModel');
        $data['real'] = $this->compANDcatModel->displayApprovedParticipantsInComp($id);

        $this->load->library('Mytcpdf');
        
        $sample = "Josh";
        $data['txt']= <<<EOD
        PUTANGINA MO $sample    
EOD;

        $this->load->view('pages/tcpdf', $data);
    }

    public function edit(){
            $this->load->view('pages/Edit');
    }
}

?>