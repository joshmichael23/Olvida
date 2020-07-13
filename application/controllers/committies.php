  <?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class Committies extends CI_Controller {

      function __construct(){
        parent::__construct();
        $this->load->helper('form');
            if(!$this->session->userdata('logged_in'))
                redirect('Login/logout', true);
      }


      function index2(){
        $this->load->view('templates/headerREAL');
        $this->load->view('pages/Director/Commitee');
        $this->load->view('templates/footer');
      }

      function get_committee(){
        $this->load->library('Datatables');
        // $this->datatables->select('a.school_name, b.team_name, group_concat(concat(" ", c.first_name, " ", c.last_name)) as members')->from('school a, team b, participant c')->where('b.school_id = a.school_id')->where('c.team_id = b.team_id')->group_by('b.team_id');

        $id = $this->session->userdata('id');

        $this->datatables->select('committee_id, username, role, password')->from('committee')->where('director_id', $id);
        $this->datatables->add_column('delete', '<a class="btn btn-danger" href="deleteCommitee/$1">Delete</a>', 'committee_id');

        // $this->datatables->select('*')->from('school');

        echo $this->datatables->generate();
      }

      function index(){

                $this->session->set_userdata('header', 'Committees');

        $this->load->view('templates/headerREAL');
        $this->load->view('pages/reg_committee', array());
        $this->load->view('templates/footer');
                  $this->session->unset_userdata('header');
      }

      function regCommittee(){
        $this->load->library('form_validation');
            $this->form_validation->set_rules('username', 'Username', 'required'); 
            $this->form_validation->set_rules('password', 'Password', 'required|alpha_numeric|min_length[6]');
            $this->form_validation->set_rules('password1', 'Password Confirmation', 'required|matches[password]');
            $this->form_validation->set_rules('role', 'Role', 'required');
            $this->form_validation->set_error_delimiters('<div class "text-danger">', '</div>');

            if($this->form_validation->run() == TRUE)
            {
                $this->load->model('compANDcatModel');
                   $user = $this->session->userdata('user');
                 $this->load->model("committee_model");
                 $this->load->model("Connect_Db");

               $committee = array(
                 "username" => $this->input->post("username"),
                 "password" => $this->input->post("password"),
                 "role" => $this->input->post("role"),
                "director_id" => $this->Connect_Db->getDirectorID($user)

              );
                $this->committee_model->insert_data_committee($committee);

                $this->session->set_flashdata('success', 'Committee successfully created!');
                redirect('Committies/index');
            }
            
               
            $this->load->view('templates/headerREAL');
            $this->load->view('pages/reg_committee', array());
            $this->load->view('templates/footer');            
            
      }

      function viewCompScoreboard()
      {

                $this->session->set_userdata('header', 'competitions');
            $this->session->set_userdata('sublevel', 'UploadScoreboard');
         if($this->session->userdata('logged_in')==true){
              $this->load->model('compANDcatModel');
              $ID = $this->session->userdata('id');
              $username = $this->session->userdata('user');
              $status = $this->session->userdata('status');
              $data['sample'] = $this->compANDcatModel->displayComp($ID, $status);

              $data = array();
              $this->load->library('pagination');
              $perPage = 8;
              
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
              $conditions['DirectorID'] = $ID;
              $rowsCount = $this->compANDcatModel->getComps($conditions);
              
              // Pagination config
              $config['base_url']    = base_url().'Committies/viewCompScoreboard/';
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
              $conditions['DirectorID'] = $ID;
              $data['sample'] = $this->compANDcatModel->getComps($conditions);
              $data['title'] = '';



              if($status=='Technical Committee' || $status=='director'){

                  if($status=='Technical Committee')
                    $this->load->view('templates/headerTechnical');
                  else
                    $this->load->view('templates/headerREAL');

                  $this->load->view('pages/uploadScoreboardComp', $data);
                  $this->load->view('templates/footer');
              }


            $this->session->unset_userdata('header');
            $this->session->unset_userdata('sublevel');
          }
          else{
              $this->load->view('templates/header');
              $this->load->view('templates/footer');
              $this->load->view('pages/login');   
          }

      }

      public function scoreboard($catid, $aw){
                $this->session->set_userdata('header', 'competitions');
            $this->session->set_userdata('sublevel', 'UploadScoreboard');
            if($this->session->userdata('status')=='director'){
                  $this->load->model('compANDcatModel');
                  $legit = str_replace("%20"," ",$aw);
                  $data2['sample'] = $this->compANDcatModel->displayCat($legit);
                  $data3['count'] = $this->compANDcatModel->countCat( $this->compANDcatModel->getCompID($legit));
                  $compID = $data2['IDofComp'] = $this->compANDcatModel->getCompID($legit);
                  $data2['desc'] = $this->compANDcatModel->getDescription($compID);
                  // die();
                  $this->load->view('templates/headerREAL');
                  $this->load->view('pages/categoriesScore', $data2, $data3);
                  $this->load->view('templates/footer');
              }

               else if($this->session->userdata('status')=='Technical Committee'){
                  $this->load->model('compANDcatModel');
                  $legit = str_replace("%20"," ",$compname);
                  $data['compname'] = $legit;
                  $data['sample'] = $this->compANDcatModel->getWinners($catid);
                  $this->load->view('templates/headerTechnical');
                  $this->load->view('pages/viewTechScore', $data);
                  $this->load->view('templates/footer'); 
              }


            $this->session->unset_userdata('header');
            $this->session->unset_userdata('sublevel');
      }

       public function viewCatscore($aw){

          //$aw = base64_decode(urldecode($aw2));

                $this->session->set_userdata('header', 'competitions');
            $this->session->set_userdata('sublevel', 'UploadScoreboard');

          if($this->session->userdata('status')=='director'){
              $this->load->model('compANDcatModel');
              $legit = str_replace("%20"," ",$aw);
              //$data2['compID'] = $aw;

              $data3['count'] = $this->compANDcatModel->countCat( $this->compANDcatModel->getCompID($legit));
              $data2['IDofComp'] = $compID = $this->compANDcatModel->getCompID($legit);
              $data2['sample'] = $this->compANDcatModel->displayCatForScoreboard($compID);
              $data2['compname'] = $legit;
              $this->load->view('templates/headerREAL');
              $this->load->view('pages/viewCatTech', $data2, $data3);
              $this->load->view('templates/footer');
          }

           else if($this->session->userdata('status')=='Technical Committee'){
              $this->load->model('compANDcatModel');
              $legit = str_replace("%20"," ",$aw);
              //$data2['compID'] = $aw;

              $data3['count'] = $this->compANDcatModel->countCat( $this->compANDcatModel->getCompID($legit));
              $data2['IDofComp'] = $compID = $this->compANDcatModel->getCompID($legit);
              $data2['sample'] = $this->compANDcatModel->displayCatForScoreboard($compID);
              $data2['compname'] = $legit;
              $this->load->view('templates/headerTechnical');
              $this->load->view('pages/viewCatTech', $data2, $data3);
              $this->load->view('templates/footer'); 
          }

                      $this->session->unset_userdata('header');
            $this->session->unset_userdata('sublevel');

      }

   //KYLE
   function upload_scoreboard($catID=NULL,$sboardID=NULL){
    $this->load->model('compANDcatModel');
          $user = $this->session->userdata('user');
          $comp_name=$this->compANDcatModel->getCompNamebyCatID($catID);
          // $ye = $this->compANDcatModel->getCompID($comp_name);

       $config['upload_path']      ='./uploads/scoreboard/';
       $config['allowed_types']    ='*';
       $config['max_size']         =1024*8;
       $config['max_widht']        =1024*4;
       $config['max_height']       =768*5;
       $config['overwrite'] = TRUE;

       $this->load->library('upload', $config);

        if(! $this->upload->do_upload('userfile')){
            $error = array('error' => $this->upload->display_errors());
            
        }
        else{

           $data=array('upload_data' => $this->upload->data());

           $this->load->library('simple_html_dom');
           $this->load->model('committee_model');

           $raw = file_get_html($data['upload_data']['full_path']);

           $i=0;
           $k=0;
           $r2[$i] = 0;
           $r1[$k] = 0;
           foreach($raw->find('tr') as $element2){
             $r1[$k] = $element2->children(0)->plaintext;
             $r2[$i]=$element2->children(1)->plaintext;
             

             echo $r1[$k] . " " . $r2[$i] . "<br />";

             $i++;
             $k++;
           }

           array_shift($r2);
           array_shift($r1);

           $this->load->model('compANDcatModel');
           $compID = $this->compANDcatModel->getCompIDbyCatID($catID);
           
           $sboard = array(
                            'file_name' => $data['upload_data']['file_name'],
                            'category_id' => $catID,
                            'competition_id' => $compID
                          );

           $this->load->model('committee_model');

           if($this->committee_model->checkScoreboardIfExisting($sboard)==false){



                 $this->committee_model->insert_data_competition_scoreboard($sboard);


                 for($j = 0; $j<$i-1; $j++){

                          $ranks = array(
                                          'team_name' => $r2[$j],
                                          'rank' => $r1[$j],
                                          'competition_scoreboard_id' => $this->compANDcatModel->getCompIDFromScoreboard($catID)
                                        );

                          $this->committee_model->insert_data_team_competition_winners($ranks);
                 }

                 $this->committee_model->deleteExtra();
               $this->session->set_flashdata('Success', 'Successfully Uploaded!');
               redirect('Committies/viewCatscore/'.$comp_name);
           }
           else{

               $this->committee_model->update_data_competition_scoreboard($sboard);
               $this->committee_model->clear_data_team_competition_winners($this->compANDcatModel->getCompIDFromScoreboard($catID));

                 for($j = 0; $j<$i-1; $j++){

                          $ranks = array(
                                          'team_name' => $r2[$j],
                                          'rank' =>$r1[$j],
                                          'competition_scoreboard_id' => $this->compANDcatModel->getCompIDFromScoreboard($catID)
                                        );

                          $this->committee_model->insert_data_team_competition_winners($ranks);
                          
                 }
               
                 $this->committee_model->deleteExtra();
               $this->session->set_flashdata('Success', 'Successfully Uploaded!');
               redirect('Committies/viewCatscore/'.$comp_name);
           }
         }
}

    
    function certificate_editor(){

        $this->load->view('templates/headerSecretariat');
        $this->load->view('pages/edit_certificate');
        $this->load->view('templates/footer');

    }
    }

  
  ?>