<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class teams extends CI_Controller {


        function __construct() {
            // then execute the parent constructor anyway
            parent::__construct();
            // $this->load->library('session');

            if(!$this->session->userdata('logged_in'))
                redirect('Login/logout', true);
        }

	public function index(){


        if($this->session->userdata('logged_in')==true){
            $this->load->model('compANDcatModel');
            $ID = $this->session->userdata('id');
            $username = $this->session->userdata('user');
            $status = $this->session->userdata('status');


            if($status=='director'){
                $this->load->view('templates/headerREAL');
                $this->load->view('pages/teams');
                $this->load->view('templates/footer');
            }
            else if($status=='school'){
                $this->load->view('templates/headerSchool');
                $this->load->view('pages/teamsSchool');
                $this->load->view('templates/footer');
            }
        }
        else{
            $this->load->view('login/index');   
        }
      }
   
      public function STeams(){
            $this->load->model('compANDcatModel');
            $aw = $this->session->userdata('id');
            
            $data['sample'] = $this->compANDcatModel->displaySchoolTeams($aw);
            
            $this->load->view('templates/headerSchool');
            $this->load->view('pages/teamsSchool', $data);
            $this->load->view('templates/footer');
            //get variable to display teams from school. to be continued
      }

      public function inviteTeams($catID){

            $data = array();
            $this->load->model('compANDcatModel');
            $this->load->library('pagination');
            $perPage = 9;
            
            // If search request submitted
            if($this->input->post('submitSearch')){
                $inputKeywords = $this->input->post('searchKeyword');
                $searchKeyword = strip_tags($inputKeywords);
                if(!empty($searchKeyword)){
                    $this->session->set_userdata('searchKeyword', $searchKeyword);
                }else{
                    $this->session->unset_userdata('searchKeyword');
                }
            }elseif($this->input->post('submitSearchReset')){
                $this->session->unset_userdata('searchKeyword');
            }

            $data['searchKeyword'] = $this->session->userdata('searchKeyword');
            
            // Get rows count
            $conditions['searchKeyword'] = $data['searchKeyword'];
            $conditions['returnType']    = 'count';
            $rowsCount = $this->compANDcatModel->InviteIndividual($conditions);
            
            // Pagination config
            $config['base_url']    = base_url().'teams/inviteTeamsIndividual/'.$catID;
            $config['uri_segment'] = 3;
            $config['total_rows']  = $rowsCount;
            $config['per_page']    = $perPage;
            
            // Initialize pagination library
            $this->pagination->initialize($config);
            
            // Define offset
            $page = $this->uri->segment(3);
            $offset = !$page?0:$page;
            
            // Get rows
            $conditions['returnType'] = '';
            $conditions['start'] = $offset;
            $conditions['limit'] = $perPage;
            $data['sample'] = $this->compANDcatModel->InviteIndividual($conditions);
            $data['title'] = '';



            $data['catID'] = $catID;
            $data['compname'] = $this->compANDcatModel->getCompNameByCatID($catID);
            $data['catname'] = $this->compANDcatModel->getCatNamebyCatID($catID);
            $data['sample'] = $this->compANDcatModel->InviteIndividual();
            $data['catID'] = $catID;
            $this->load->view('templates/headerREAL');
            $this->load->view('pages/inviteTeams', $data);
            $this->load->view('templates/footer');   
      }

       public function inviteTeamsz($catID){

            $data = array();
            $this->load->model('compANDcatModel');
            $this->load->library('pagination');
            $perPage = 9;
            
            // If search request submitted
            if($this->input->post('submitSearch')){
                $inputKeywords = $this->input->post('searchKeyword');
                $searchKeyword = strip_tags($inputKeywords);
                if(!empty($searchKeyword)){
                    $this->session->set_userdata('searchKeyword', $searchKeyword);
                }else{
                    $this->session->unset_userdata('searchKeyword');
                }
            }elseif($this->input->post('submitSearchReset')){
                $this->session->unset_userdata('searchKeyword');
            }

            $data['searchKeyword'] = $this->session->userdata('searchKeyword');
            
            // Get rows count
            $conditions['searchKeyword'] = $data['searchKeyword'];
            $conditions['returnType']    = 'count';
            $rowsCount = $this->compANDcatModel->InviteIndividual($conditions);
            
            // Pagination config
            $config['base_url']    = base_url().'teams/inviteTeamsIndividual/'.$catID;
            $config['uri_segment'] = 3;
            $config['total_rows']  = $rowsCount;
            $config['per_page']    = $perPage;
            
            // Initialize pagination library
            $this->pagination->initialize($config);
            
            // Define offset
            $page = $this->uri->segment(3);
            $offset = !$page?0:$page;
            
            // Get rows
            $conditions['returnType'] = '';
            $conditions['start'] = $offset;
            $conditions['limit'] = $perPage;
            $data['sample'] = $this->compANDcatModel->InviteIndividual($conditions);
            $data['title'] = '';



            $data['catID'] = $catID;
            $data['compname'] = $this->compANDcatModel->getCompNameByCatID($catID);
            $data['catname'] = $this->compANDcatModel->getCatNamebyCatID($catID);
            $data['sample'] = $this->compANDcatModel->InviteIndividual();
            $data['catID'] = $catID;
            $this->load->view('templates/headerREAL');
            $this->load->view('pages/inviteTeams', $data);
            $this->load->view('templates/footer');   
      }


    public function sendInvites($schoolID, $catID){
        $this->load->model('compANDcatModel');
        $compID = $this->compANDcatModel->getCompIDByCatID($catID);
        $schoolName = $this->compANDcatModel->getSchoolNameBySchoolID($schoolID);
        $directorID = $this->compANDcatModel->getDirectorIDofCat($catID);
        $catname = $this->compANDcatModel->getCatNamebyCatID($catID);
        $compname = $this->compANDcatModel->getCompNameByCatID($catID);
        

        if($this->compANDcatModel->checkInvite($schoolID, $compID)==false){
            $this->compANDcatModel->sendInvite($schoolID, $compID);

            //this is only the notification.
            $this->load->model('notification');
            date_default_timezone_set('Asia/Manila');
            $today = date("Y-m-d H:i:s");
            $message = "You are directly invited to join " . $catname . " of " . $compname  . ". You can view the competition in the all competitions tab.";
                    
            $notification = array(
                            'subject' => "Direct Invite " . $catname . " of " . $compname,
                            'text' =>  $message,
                            'date' => $today
                            );
                    
            $notifID = $this->notification->insertNotification($notification);      //get ID of inserted notif
            $this->notification->sendNotificationSchool($schoolID, $notifID);  
            $this->session->set_flashdata('success', 'Successfully sent invite to ' . $schoolName);
            redirect('teams/inviteTeams/'.$catID);

        }else{
                $this->session->set_flashdata('warning', 'Already sent a request to ' . $schoolName);
                redirect('teams/inviteTeams/'.$catID);
        }




  
    }
	

 	public function viewTeams($aw2){
            $this->load->model('compANDcatModel');
            // $type = $this->compANDcatModel->getCategoryType($aw2);
            // if($type=='Individual')
            //     echo "aw";

            // die();
            
            $status = $this->session->userdata('status');

            if($status == 'director' || $status =='Secretariat Committee' || $status=='Technical Committee'){
                $this->load->model('compANDcatModel');
                
                if($this->compANDcatModel->displayTeams($aw2)!='nothing'){
                    $data2['sample'] = $this->compANDcatModel->displayTeamz($aw2);
                    $data2['header'] = '';
                    $data2['compName'] = $this->compANDcatModel->getCompNameByCatID($aw2);
                    $data2['catID'] = $aw2;
                    $data2['catname'] =$this->compANDcatModel->getCatNamebyCatID($aw2);
                    $data2['catType'] = $this->compANDcatModel->getCategoryType($aw2);
                    $data2['start_date'] = $this->compANDcatModel->getDateOfCat($aw2);
                    
                    $this->session->set_userdata('CatNumber',$aw2);

                    if($this->compANDcatModel->getWinners($aw2)!=false)
                            $data2['winners'] = $this->compANDcatModel->getWinners($aw2); 
                        else
                            $data2['winners'] = '';
                    
                    if($status=='director'){
                        $this->load->view('templates/headerREAL');
                        $this->load->view('pages/teams', $data2);
                        $this->load->view('templates/footer');
                    }
                    elseif($status=='Secretariat Committee'){
                        $this->load->view('templates/headerSecretariat');
                        $this->load->view('pages/teams', $data2);
                        $this->load->view('templates/footer');
                    }
                    else{
                        $this->load->view('templates/headerTechnical');
                        $this->load->view('pages/teams', $data2);
                        $this->load->view('templates/footer');
                    }
                }
                else{
                        $data2['header'] = "No Approved Teams Yet";
                        $data2['sample'] = $this->compANDcatModel->displayTeamz($aw2);
                        $data2['compName'] = $this->compANDcatModel->getCompNameByCatID($aw2);
                        $data2['catID'] = $aw2;
                        $data2['catType'] = $this->compANDcatModel->getCategoryType($aw2);
                        $data2['catname'] =$this->compANDcatModel->getCatNamebyCatID($aw2);
                        if($status=='director')
                            $this->load->view('templates/headerREAL');
                        elseif($status=='Secretariat Committee')
                            $this->load->view('templates/headerSecretariat');
                        else
                            $this->load->view('templates/headerTechnical');
                        $this->load->view('pages/NoApprovedTeams', $data2);
                        $this->load->view('templates/footer');
            
                }
            }

            else if($status=='school'){
                $this->load->model('compANDcatModel');
                if($this->compANDcatModel->displayTeams($aw2)!='nothing'){
                        $data2['sample'] = $this->compANDcatModel->displayTeams($aw2);
                        $data2['header'] = '';

                        $this->load->view('templates/headerSchool');
                        $this->load->view('pages/approvedTeams', $data2);
                        $this->load->view('templates/footer');
            
                }
                else{
                        $data2['header'] = "No Approved Teams Yet";
                        $this->load->view('templates/headerSchool');
                        $this->load->view('pages/NoApprovedTeams', $data2);
                        $this->load->view('templates/footer');
            
                }
            }     
    }

     public function exportTSV($catID, $value='')
    {

        
        /*$header = array_keys($results[0]);
        fputcsv($handle,$header);*/

       


            $this->load->model('compANDcatModel');
            
            
            $ID = $this->session->userdata('id');
            // $this->db->select('competition.site_no,LOWER(team.team_name) ,LOWER(team.team_name) as displayname,LOWER(team.team_name) as password');
             //$this->db->from('competition,team,category,slot');

             //$this->db->where("competition.director_id = '$ID' && competition.competition_id = category.competition_id && slot.team_id = team.team_id && slot.status = 'approved' && slot.category_id = category.category_id
               //   group by team.team_id");
            // $data['competition,team,category,slot'] = $this->db->get()->result_array();
           $this->load->dbutil();

$this->load->helper('file');
$this->load->helper('download');
           // $aw = $this->session->userdata('CatNumber');
           $query = $this->db->query("SET @n = 0;");
           $query = $this->db->query("SELECT competition.site_no as site, CONCAT('team', @n := @n+1) as account, LOWER(teams_in_competition.team_name) as displayname, replace(LOWER(teams_in_competition.team_name), ' ', '') as password 
                                    FROM competition
                                    INNER JOIN category on category.competition_id = competition.competition_id 
                                    INNER JOIN slot on slot.category_id = category.category_id
                                    INNER JOIN teams_in_competition on slot.team_id = teams_in_competition.teams_in_competition_id 
                                    WHERE competition.director_id = $ID && slot.status = 'approved' && slot.category_id = $catID 
                                    GROUP BY teams_in_competition.teams_in_competition_id
                 ");

            $delimiter = "\t";
            $newline = "\r\n";
           
            $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
            force_download('PC^2 Accounts.tsv',$data);
    }

    public function viewSchoolsTeams(){
            $this->load->model('compANDcatModel');
            $this->load->view('templates/headerSchool');
            $this->load->view('pages/schoolteams');
            $this->load->view('templates/footer');
            }

}

?>