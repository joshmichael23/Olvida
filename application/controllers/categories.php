<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class categories extends CI_Controller {

    function __construct() {
            parent::__construct();
            if(!$this->session->userdata('logged_in'))
                redirect('Login/logout', true);    
    }

    public function index($CompetitionName){
  
     if($this->session->userdata('status')=='director'){

            $this->load->model('compANDcatModel');
            $RealCompName = str_replace("%20"," ",$CompetitionName);

            $data2['sample'] = $this->compANDcatModel->displayCat($RealCompName);
            $data2['IDofComp'] = $this->compANDcatModel->getCompID($RealCompName);

            $data3['count'] = $this->compANDcatModel->countCat( $this->compANDcatModel->getCompID($RealCompName));


            $this->load->view('templates/headerREAL');
            $this->load->view('pages/categories', $data2, $data3);
            $this->load->view('templates/footer');

        }
        else if($this->session->userdata('status')=='school'){
            $this->load->model('compANDcatModel');
            $legit = str_replace("%20"," ",$aw);
            //$data2['compID'] = $aw;
            $data2['sample'] = $this->compANDcatModel->displayCat($legit);
            $data2['name'] = $legit;
            $this->load->view('templates/headerSchool');
            $this->load->view('pages/categoriesSchool', $data2);
            $this->load->view('templates/footer');  
        }
        else{
         redirect('login/index'); 
        }
    }

    public function ViewPayment($catID, $teamID)
    {
            $this->load->model('compANDcatModel');
            $filename = $this->compANDcatModel->getFilenameOfTeamInCat($catID, $teamID);
                   echo '<img src="' . base_url( 'uploads/payments/' . $filename) . '">';
  
    }

    public function PendingTeamsInCategory($catID){
            $this->load->model('compANDcatModel');

            $status = $this->session->userdata('status');

            $data2['sample'] = $this->compANDcatModel->displayPendingTeamsInCat($catID);
            $data2['catID'] = $catID;
            $data2['compID'] = $this->compANDcatModel->getCompIDbyCatID($catID);
            $data2['compname'] = $this->compANDcatModel->getCompNamebyCatID($catID);
            $data2['catname'] = $this->compANDcatModel->getCatNamebyCatID($catID);
            $this->session->set_userdata('header', 'competitions');
            $this->session->set_userdata('sublevel', 'PendingRequests');

            if($status == 'director'){

                if($this->compANDcatModel->displayPendingTeamsInCat($catID)){
                    $this->load->view('templates/headerREAL');
                    $this->load->view('pages/PendingTeams', $data2);
                    $this->load->view('templates/footer');
                }
                else{
                    redirect('categories/pendingCategories/'. $this->compANDcatModel->getCompIDbyCatID($catID));
                }
            }
            elseif($status=='Secretariat Committee'){
                if($this->compANDcatModel->displayPendingTeamsInCat($catID)){
                    $this->load->view('templates/headerSecretariat');
                    $this->load->view('pages/PendingTeams', $data2);
                    $this->load->view('templates/footer');
                }
                else{
                    redirect('categories/pendingCategories/'. $this->compANDcatModel->getCompIDbyCatID($catID));
                }
            }

            $this->session->unset_userdata('header');
            $this->session->unset_userdata('sublevel');
    }

    public function pendingCategories($compID){
            $this->load->model('compANDcatModel');
            $status = $this->session->userdata('status');


            $this->session->set_userdata('header', 'competitions');
            $this->session->set_userdata('sublevel', 'PendingRequests');
            $data2['sample'] = $this->compANDcatModel->displayPendingCat($compID);
            $data2['compname'] = $this->compANDcatModel->getCompNamebyCompID($compID);

            // $data2['IDofComp'] = $this->compANDcatModel->getCompID($RealCompName);

            // $data3['count'] = $this->compANDcatModel->countCat( $this->compANDcatModel->getCompID($RealCompName));
            if($status == 'director'){
                if( $this->compANDcatModel->displayPendingCat($compID) ){
                    $this->load->view('templates/headerREAL');
                    $this->load->view('pages/PendingCategoriez', $data2);
                    $this->load->view('templates/footer');
                }
                else{
                    redirect('Login/index');
                }
            }
            elseif($status == 'Secretariat Committee'){
                if( $this->compANDcatModel->displayPendingCat($compID) ){
                    $this->load->view('templates/headerSecretariat');
                    $this->load->view('pages/PendingCategoriez', $data2);
                    $this->load->view('templates/footer');
                }
                else{
                    redirect('Login/index');
                }               
            }

            $this->session->unset_userdata('header');
            $this->session->unset_userdata('sublevel');


    }

    public function chooseCat($CompetitionName){
        if($this->session->userdata('status')=='school'){
            $this->load->model('compANDcatModel');
            $legit = str_replace("%20"," ",$CompetitionName);
            //$data2['compID'] = $aw;
            $data2['sample'] = $this->compANDcatModel->displayCat($legit);
            $data2['name'] = $legit;
            $this->load->view('templates/headerSchool');
            $this->load->view('pages/chooseCategory', $data2);
            $this->load->view('templates/footer');  
        }
        else{
            $this->load->view('login/index');  
        }
    }

    public function editCategoryName($catID){
  
        if($this->session->userdata('logged_in')==true){
            $this->load->model('compANDcatModel');
            //$newName = $this->input->post('CategoryName');
            $data['sample1'] = $this->compANDcatModel->displayEditCat($catID);
            $data['compName'] = $this->compANDcatModel->getCompNamebyCatID($catID);
            $data['catname'] = $this->compANDcatModel->getCatNamebyCatID($catID);
            $this->load->view('templates/headerREAL');
            $this->load->view('pages/editCategory', $data);
            $this->load->view('templates/footer');

            //if($newName!=NULL){
                //$this->compANDcatModel->editCatName($catID, $newName); //CALL MODEL TO CHANGE OR UPDATE

            //}
        }
        else{
            $this->load->view('login/index');  
        }
    }

    public function updateCat($CatID){
            $newName = $this->input->post('CompetitionName'); //CATEGORY NAME
            $newType= $this->input->post('CatType');
            $newPayment = $this->input->post('Payment');
            $this->load->model('compANDcatModel');


            $catname = $this->compANDcatModel->getCatNamebyCatID($CatID);
            $compname = $this->compANDcatModel->getCompNamebyCatID($CatID);
            $oldPayment = $this->compANDcatModel->getPaymentmethod($CatID);
            $oldType = $this->compANDcatModel->getCategoryType($CatID);

            if($oldPayment!=$newPayment){
                $this->load->model('notification');
                $getID = $this->notification->getSchoolIDsInCat($CatID);

                $count = $getID->num_rows();

                date_default_timezone_set('Asia/Manila');
                $today = date("Y-m-d H:i:s");

                if($newPayment=='Yes')
                    $message = " now requires payment and all teams were kicked so that they can rejoin again with proof of payment.";
                else
                    $message = " doesn't require any payment anymore.";
                $notification = array(
                                'subject' => "Updates for " . $catname . " of " . $compname,
                                'text' =>  $catname . " of " . $compname . "" . $message,
                                'date' => $today
                                );
                $notifID = $this->notification->insertNotification($notification);      //get ID of inserted notif

                foreach($getID->result_array() as $aaw)
                    $this->notification->sendNotificationSchool($aaw['school_id'], $notifID);
               
                $this->notification->deleteTeams($CatID);
            }
            if($oldType != $newType){

                $this->load->model('notification');
                $getID = $this->notification->getSchoolIDsInCat($CatID);

                $count = $getID->num_rows();

                date_default_timezone_set('Asia/Manila');
                $today = date("Y-m-d H:i:s");

               
                $message = "Category type of " . $catname . " of " . $compname . " was changed from " . $oldType . " to " . $newType . ".";
               
                $notification = array(
                                'subject' => "Updates for " . $catname . " of " . $compname,
                                'text' =>  $message,
                                'date' => $today
                                );
                $notifID = $this->notification->insertNotification($notification);      //get ID of inserted notif

                foreach($getID->result_array() as $aaw)
                    $this->notification->sendNotificationSchool($aaw['school_id'], $notifID);

                $this->notification->deleteTeams($CatID);

            }
            $this->compANDcatModel->updateCatName($CatID, $newName, $newType, $newPayment);

            $catname = $this->compANDcatModel->getCatNamebyCatID($CatID);
            $compName = $this->compANDcatModel->getCompNamebyCatID($CatID);
            $this->session->set_flashdata('success', 'Successfully edited ' . $catname . '!');
            redirect('competitions/viewCat/'.$compName);
        }

    public function deleteCat($CatID, $CompID){

        //$CatID = base64_decode(urldecode(($CatID2)));
        //$CompID = base64_decode(urldecode($CompID2));

        if($this->session->userdata('logged_in')==true){
            $this->load->model('compANDcatModel');
            $status = $this->session->userdata('status');

            $compName = $this->compANDcatModel->getCompNamebyCatID($CatID); //get the comp name of the category
            $catname = $this->compANDcatModel->getCatNamebyCatID($CatID);
            $this->compANDcatModel->deleteCat($CatID);
           
            if($status=='director'){
                $this->session->set_flashdata('delete', 'Successfully deleted ' . $catname . '!');
                redirect('competitions/viewCat/'.$compName); //load to index para masaya
                                                             //REDIRECT ALL TO INDEX PARA UNIFORM SA URL BAR
            }
           
        }
        else{
            $this->load->view('login/index');  
        }   
    }

    public function addCat($compID){

        if($this->session->userdata('logged_in')==true){
            $this->load->model('compANDcatModel');
            $compName = $this->compANDcatModel->getCompNamebyCompID($compID);
            $status = $this->session->userdata('status');
           
            $i = $aw['count'] = $this->compANDcatModel->countCat($compID) + 1;       //var i WILL BE THE CATEGORY N
            $name = "Category " . "$i";
           
            while($this->compANDcatModel->checkCategories($name, $compID) == 1){    //IF THERE IS EXISTING NAME CALLED CATEGORY N
                $i = $i + 1;                                                        //ADD 1 AND CHECK AGAIN.
                $name = "Category " . "$i";                                         //IF NONE, THEN GO.
            }

            $cat = array('competition_id' => $compID,
                         'category_name' => $name,
                         'payment' => 'No'
                         );

            $this->compANDcatModel->insertCat($cat);                                //INSERT THE CAT
           
            if($status=='director'){
                $this->session->set_flashdata('add', 'Successfully added another category!');
                redirect('competitions/viewCat/'.$compName);
            }
        }
        else{
            $this->load->view('login/index');  
        }   
    }

    public function join($aw){

        if($this->session->userdata('logged_in')==true){
            $this->load->model('team_model');
            $this->load->helper('form');

            $this->session->set_userdata('header', 'competitions');

            $status = $this->session->userdata('status');

            if($status=='school'){
                $ID = $this->session->userdata('id');
                $type = $this->team_model->checkCatType($aw);


                //IF CAT IS INDIVIDUAL SHOW IND TEAMS
                if($type=='Individual'){

                    if($this->team_model->displayALLIndividual($ID, $status)!='nothing'){
                       
                        $data['sample'] = $this->team_model->displayALLIndividual($ID, $status);
                      
                        $data['catID']=$aw;

                        $data['approvedANDpending'] = $this->team_model->displayTeamsApprovedANDPending($aw);
                        $this->load->model('compANDcatModel');
                        $data['catName'] = $this->compANDcatModel->getCatNamebyCatID($aw);
                        $data['CompID'] = $this->compANDcatModel->getCompIDbyCatID($aw);
                        $data['compName'] = $this->compANDcatModel->getCompNamebyCatID($aw);
                        $data['date'] = $this->compANDcatModel->getDateofCat($aw);


                        $this->load->view('templates/headerSchool');
                        // $this->load->view('pages/chooseTeams', $data); THIS ONE WITH THE SETUP SHIT
                        $this->load->view('pages/chooseTeamz1', $data);
                        $this->load->view('templates/footer');
                    }
                    else{
                        // $this->session->set_flashdata('error', 'No available teams');
                        // $this->load->model('compANDcatModel');
                        // $name = $this->compANDcatModel->getCompNamebyCatID($aw);
                        // //redirect('categories/chooseCat/'.$name);
                        $data['header']="You dont have any team/s eligible for this category";
                        $this->load->view('templates/headerSchool');
                        $this->load->view('pages/noTeamz', $data);
                        $this->load->view('templates/footer');
                                       
                    }
                }
                //ELSE SHOW TEAMS WITH GROUP
                else if($type=='Group'){

                    if($this->team_model->displayALLGroup($ID, $status)!='nothing'){
                        $this->load->model('compANDcatModel');
                        $data['sample'] = $this->team_model->displayALLGroup($ID, $status);
      $data['catID']=$aw;
                        $data['date'] = $this->compANDcatModel->getDateofCat($aw);
                        $data['approvedANDpending'] = $this->team_model->displayTeamsApprovedANDPending($aw);
                       
                      
                         $data['catName'] = $this->compANDcatModel->getCatNamebyCatID($aw);
                        $data['CompID'] = $this->compANDcatModel->getCompIDbyCatID($aw);
                        $data['compName'] = $this->compANDcatModel->getCompNamebyCatID($aw);
                        $this->load->view('templates/headerSchool');
                        $this->load->view('pages/chooseTeamz1', $data);
                        $this->load->view('templates/footer');
                    }
                    else{
                        $data['header']="You dont have any team/s eligible for this category";
                        $this->load->view('templates/headerSchool');
                        $this->load->view('pages/noTeamz', $data);
                        $this->load->view('templates/footer');
                    }
                }
            }
                        $this->session->unset_userdata('header');
        }

        else{
           redirect('login/index');
        }   
    }

   

    public function apply($aw){

        if($this->session->userdata('logged_in')==true){

            $data = $this->input->post('checkyes');
            //var_dump($data);
            //echo "\n";

            //echo "SIZE OF DATA = ", sizeof($data);
            //echo "CAT ID = ", $aw;


            $this->load->model('compANDcatModel');


            for($i=0; $i<sizeof($data); $i++){

                do{  
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);

                $randomString = '';

                for ($j = 0; $j < 6; $j++){
                   $randomString .= $characters[rand(0, $charactersLength - 1)];
                    //      //PUTANGINANG MGA CODE DIGDI PARA SA PAGREGISTER
                }
                $code = $randomString;
           
                }while($this->compANDcatModel->checkCodes($code)==true);
           


                //while($this->compANDcatModel->checkTeamIfPending($data[$i], $aw)!=true){
                $slot = array('category_id' => $aw,      //SAKA IINSERT SA DATABASE
                             'status' => 'pending',
                             'team_id' => $data[$i],
                             'code'=> $code
                         );
              
                while($this->compANDcatModel->checkTeamIfPending($data[$i], $aw)==false){
                    $this->compANDcatModel->insertSlot($slot);
                }             
            }

            redirect('Competitions/index');
           
        }
        else{
            $this->load->view('login/index');  
        }   
    }

    public function applyTeam($catID, $teamID){

        if($this->session->userdata('logged_in')==true){

            $this->load->model('compANDcatModel');

           

                    do{  
                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $charactersLength = strlen($characters);

                    $randomString = '';

                    for ($j = 0; $j < 6; $j++){
                       $randomString .= $characters[rand(0, $charactersLength - 1)];
                        //      //PUTANGINANG MGA CODE DIGDI PARA SA PAGREGISTER
                    }

                    $code = $randomString;
               
                    }while($this->compANDcatModel->checkCodes($code)==true);

                    //while($this->compANDcatModel->checkTeamIfPending($data[$i], $aw)!=true){


                    //REGISTER FIRST SA TEAMS_IN_COMP TAPOS SI MGA PARTICIPANT THEN SA SLOT. PARA SI SLOT MAKUA SA
                    //TEAMS_IN_COMP OKEH????

                    $teamname = $this->compANDcatModel->getTeamNamebyTeamIDReal($teamID);
                    $schoolname = $this->compANDcatModel->getSchoolNamebyTeamID($teamID);
                    $catname = $this->compANDcatModel->getCatNamebyCatID($catID);
                    $compname = $this->compANDcatModel->getCompNamebyCatID($catID);

                    $compid = $this->compANDcatModel->getCompIDbyCatID($catID);
                    $directorID = $this->compANDcatModel->getDirectorIDofCat($catID);

                    $members = $this->compANDcatModel->getMembersInTeam($teamID);


                    $teamz = array(
                        'team_id' => $teamID,
                        'team_name' => $teamname,
                        'competition_id' => $compid,
                        'category_id' => $catID,
                        'school_id' => $this->session->userdata('id')
                         );
                    //put sa list of registered

                    $newTeamID;
                   

                    while($this->compANDcatModel->checkIfAlreadyInComp($teamz) == false){       //check if already in comp
                   
                        $this->compANDcatModel->regTeamToComp($teamz);

                        $newTeamID = $this->compANDcatModel->getTeamsInCompID($teamz);


                        foreach($members->result_array() as $aw){


                            $member = array(
                                        'teams_in_competition_id'=>$newTeamID,
                                        'Name' => $aw['Name'],
                                        'participant_id'=>$aw['participant_id']
                                        );

                            $this->compANDcatModel->insertPartInComp($member);          //insert participant in teamz in comp
                        }

                         $slot = array(
                            'category_id' => $catID,      //SAKA IINSERT SA DATABASE
                            'status' => 'pending',
                            'team_id' => $newTeamID,
                            'code'=> $code
                        );
                  
                        if($this->compANDcatModel->checkTeamIfPending($newTeamID, $catID)==false)
                            $this->compANDcatModel->insertSlot($slot);
  
                                                                                                           //NOT SURE WHAT THSI IS FOR THOUGH

                        //time to send notifuckingations

                        //==========send that this team from this school is joining your cat from comp.===============

                        $this->load->model('notification');
                        $getDirectorID = $this->notification->getDirectorIDofCat($catID);


                        date_default_timezone_set('Asia/Manila');
                        $today = date("Y-m-d H:i:s");
                        $message = $teamname . " of " . $schoolname . " sent a request to join " . $catname . " of " . $compname;
                        echo
                        $notification = array(
                                        'subject' => "Pending request for " . $catname . " of " . $compname,
                                        'text' =>  $message,
                                        'date' => $today
                                        );
                       
                        $notifID = $this->notification->insertNotification($notification);      //get ID of inserted notif

                        $this->notification->sendNotificationDirector($directorID, $notifID);
                        $this->session->set_flashdata('request', 'Successfully requested code for ' . $teamname . ' to join ' . $catname);
                        redirect('categories/join/'.$catID);

                        //======end of notifications=====
               
                    };      //while

                    $this->session->set_flashdata('already', 'Already pending');
                    redirect('categories/join/'.$catID);  
        }
        else{
            $this->load->view('login/index');  
        }   
    }

    public function inviteTeam($catID, $teamID){
        //awd
    }

    public function UploadPaymentAndJoin($catID, $teamID){

        if($this->session->userdata('logged_in')==true){

       

                        $this->load->model('compANDcatModel');

            
                    //for code generation
                        //create code and check if may kapareho           
                        do{   
                        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        $charactersLength = strlen($characters);

                        $randomString = '';

                        for ($j = 0; $j < 6; $j++){
                           $randomString .= $characters[rand(0, $charactersLength - 1)];
                            //      //PUTANGINANG MGA CODE DIGDI PARA SA PAGREGISTER
                        }

                        $code = $randomString;
                    
                        }while($this->compANDcatModel->checkCodes($code)==true);
                    //end of code generation


                    //variables and sht
                        $teamname = $this->compANDcatModel->getTeamNamebyTeamIDReal($teamID);
                        $compid = $this->compANDcatModel->getCompIDbyCatID($catID);
                        $schoolname = $this->compANDcatModel->getSchoolNamebyTeamID($teamID);
                        $catname = $this->compANDcatModel->getCatNamebyCatID($catID);
                        $compname = $this->compANDcatModel->getCompNamebyCatID($catID);
                        $directorID = $this->compANDcatModel->getDirectorIDofCat($catID);


                    $members = $this->compANDcatModel->getMembersInTeam($teamID);

                    $teamz = array(
                        'team_id' => $teamID,
                        'team_name' => $teamname,
                        'competition_id' => $compid,
                        'category_id' => $catID,
                        'school_id' => $this->session->userdata('id')
                         );
                    //put sa list of registered

                    $newTeamID;
                    

                    while($this->compANDcatModel->checkIfAlreadyInComp($teamz) == false){       //check if already in comp
                    
                        

                        $config['upload_path']          = './uploads/payments/';
                        $config['allowed_types']        = 'gif|jpg|png';
                        $config['overwrite']            = FALSE; //true
                        // $config['max_size']             = 100;
                        // $config['max_width']            = 1024;
                        // $config['max_height']           = 768;

                        $this->load->library('upload', $config);

                        if($this->upload->do_upload('userfile')){
                         
                            $this->compANDcatModel->regTeamToComp($teamz);

                        $newTeamID = $this->compANDcatModel->getTeamsInCompID($teamz);


                        foreach($members->result_array() as $aw){

                            $member = array(
                                        'teams_in_competition_id'=>$newTeamID,
                                        'Name' => $aw['Name'],
                                        'participant_id'=>$aw['participant_id']
                                        );

                            $this->compANDcatModel->insertPartInComp($member);          //insert participant in teamz in comp
                        }

                            $data = array('upload_data' => $this->upload->data());   

                             $slot = array(
                                'category_id' => $catID,      //SAKA IINSERT SA DATABASE
                                'status' => 'pending',
                                'team_id' => $newTeamID,
                                'code'=> $code,
                                'payment'=>$data['upload_data']['file_name']
                            );
                       
                            if($this->compANDcatModel->checkTeamIfPending($newTeamID, $catID)==false)
                                $this->compANDcatModel->insertSlot($slot);

                            $this->load->model('notification');
                            $getDirectorID = $this->notification->getDirectorIDofCat($catID);
    
    
                            date_default_timezone_set('Asia/Manila');
                            $today = date("Y-m-d H:i:s");
                            
                            $message = $teamname . " of " . $schoolname . " sent a request to join " . $catname . " of " . $compname;
                            
                            $notification = array(
                                            'subject' => "Pending request for " . $catname . " of " . $compname,
                                            'text' =>  $message,
                                            'date' => $today
                                            );
                            
                            $notifID = $this->notification->insertNotification($notification);      //get ID of inserted notif
    
                            $this->notification->sendNotificationDirector($directorID, $notifID);
    
                            $this->session->set_flashdata('request', 'Successfully requested code for ' . $teamname . ' to join ' . $catname);
                            redirect('categories/join/'.$catID);  
        
                        }else{


                        $this->session->set_flashdata('error', 'File not supported!');
                        redirect('categories/join/'.$catID);
                        }

                
                    };      //while

                    $this->session->set_flashdata('error', 'No file found');
                    redirect('categories/join/'.$catID);
                

                               
        }
        else{
            $this->load->view('login/index');   
        }    
    }
    public function UploadPaymentAndJoin2($catID, $teamID){


        $config['upload_path']          = './uploads/payments/';
              $config['allowed_types']        = 'gif|jpg|png';
              $config['overwrite']            = FALSE; //true
              $this->load->library('upload', $config);
              if($this->upload->do_upload('userfile')){
            
                      $this->form_validation->set_rules('file', '', 'callback_file_check');
      
                      if($this->form_validation->run() == true){
             
      
                  $this->load->model('compANDcatModel');
      
      
                          //for code generation
                              //create code and check if may kapareho          
                              do{  
                              $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                              $charactersLength = strlen($characters);
      
                              $randomString = '';
      
                              for ($j = 0; $j < 6; $j++){
                                 $randomString .= $characters[rand(0, $charactersLength - 1)];
                                  //      //PUTANGINANG MGA CODE DIGDI PARA SA PAGREGISTER
                              }
      
                              $code = $randomString;
                         
                              }while($this->compANDcatModel->checkCodes($code)==true);
                          //end of code generation
      
      
                          //variables and sht
                              $teamname = $this->compANDcatModel->getTeamNamebyTeamIDReal($teamID);
                              $compid = $this->compANDcatModel->getCompIDbyCatID($catID);
                              $schoolname = $this->compANDcatModel->getSchoolNamebyTeamID($teamID);
                              $catname = $this->compANDcatModel->getCatNamebyCatID($catID);
                              $compname = $this->compANDcatModel->getCompNamebyCatID($catID);
                              $directorID = $this->compANDcatModel->getDirectorIDofCat($catID);
      
      
                          $members = $this->compANDcatModel->getMembersInTeam($teamID);
      
                          $teamz = array(
                              'team_id' => $teamID,
                              'team_name' => $teamname,
                              'competition_id' => $compid,
                              'category_id' => $catID,
                              'school_id' => $this->session->userdata('id')
                               );
                          //put sa list of registered
      
                          $newTeamID;
                         
      
                          while($this->compANDcatModel->checkIfAlreadyInComp($teamz) == false){       //check if already in comp
                         
                              $this->compANDcatModel->regTeamToComp($teamz);
      
                              $newTeamID = $this->compANDcatModel->getTeamsInCompID($teamz);
      
      
                              foreach($members->result_array() as $aw){
      
                                  $member = array(
                                              'teams_in_competition_id'=>$newTeamID,
                                              'Name' => $aw['Name'],
                                              'participant_id'=>$aw['participant_id']
                                              );
      
                                  $this->compANDcatModel->insertPartInComp($member);          //insert participant in teamz in comp
                              }
      
      
                              $config['upload_path']          = './uploads/payments/';
                              $config['allowed_types']        = 'gif|jpg|png';
                              $config['overwrite']            = FALSE; //true
                              // $config['max_size']             = 100;
                              // $config['max_width']            = 1024;
                              // $config['max_height']           = 768;
      
                              $this->load->library('upload', $config);
      
                              if($this->upload->do_upload('userfile')){
                                  $data = array('upload_data' => $this->upload->data());  
      
                                   $slot = array(
                                      'category_id' => $catID,      //SAKA IINSERT SA DATABASE
                                      'status' => 'pending',
                                      'team_id' => $newTeamID,
                                      'code'=> $code,
                                      'payment'=>$data['upload_data']['file_name']
                                  );
                            
                                  if($this->compANDcatModel->checkTeamIfPending($newTeamID, $catID)==false)
                                      $this->compANDcatModel->insertSlot($slot);
                              }
                             
                              $this->load->model('notification');
                              $getDirectorID = $this->notification->getDirectorIDofCat($catID);
      
      
                              date_default_timezone_set('Asia/Manila');
                              $today = date("Y-m-d H:i:s");
                             
                              $message = $teamname . " of " . $schoolname . " sent a request to join " . $catname . " of " . $compname;
                             
                              $notification = array(
                                              'subject' => "Pending request for " . $catname . " of " . $compname,
                                              'text' =>  $message,
                                              'date' => $today
                                              );
                             
                              $notifID = $this->notification->insertNotification($notification);      //get ID of inserted notif
      
                              $this->notification->sendNotificationDirector($directorID, $notifID);
      
                              $this->session->set_flashdata('request', 'Successfully requested code for ' . $teamname . ' to join ' . $catname);
                              redirect('categories/join/'.$catID); 
      
      
                     
                          };      //while
      
                          $this->session->set_flashdata('already', 'Already pending');
                          redirect('categories/join/'.$catID);
      
                      }else{
                           $this->session->set_flashdata('error', 'File needs to be png, jpeg, or png!');
                      }
              }else{
                  $this->session->set_flashdata('error', 'No File Uploaded!');
                  redirect('categories/join/'.$catID);  
              }         
              
          }
          
          
          
      


    public function cancelApply($catID, $teamID){

        if($this->session->userdata('logged_in')==true){

                $this->load->model('compANDcatModel');

               


                //notification again bois


                    $teamname = $this->compANDcatModel->getTeamNamebyTeamID($teamID);
                    $schoolname = $this->compANDcatModel->getSchoolNamebyTeamID($teamID);
                    $catname = $this->compANDcatModel->getCatNamebyCatID($catID);
                    $compname = $this->compANDcatModel->getCompNamebyCatID($catID);


                    $directorID = $this->compANDcatModel->getDirectorIDofCat($catID);


                     $this->load->model('notification');
                    $getDirectorID = $this->notification->getDirectorIDofCat($catID);


                    date_default_timezone_set('Asia/Manila');
                    $today = date("Y-m-d H:i:s");
                   
                    $message = $teamname . " of " . $schoolname . " cancelled the request to join " . $catname . " of " . $compname;
                   
                    $notification = array(
                                    'subject' => "Cancelled request for " . $catname . " of " . $compname,
                                    'text' =>  $message,
                                    'date' => $today
                                    );
                   
                    $notifID = $this->notification->insertNotification($notification);      //get ID of inserted notif

                    $this->notification->sendNotificationDirector($directorID, $notifID);

                    $this->compANDcatModel->deleteSlot($catID, $teamID);

                $this->session->set_flashdata('cancel', 'Successfully cancelled request of ' . $teamname . ' to join ' . $catname);
                redirect('categories/join/'.$catID);


               
        }
        else{
            redirect('login/login');
        }   
    }

    public function DisapproveTeam($teamID, $catID){
        if($this->session->userdata('logged_in')==true){
            $this->load->model('compANDcatModel');
            $this->compANDcatModel->deleteSlot($catID, $teamID);
            redirect('categories/PendingTeamsInCategory/'.$catID);
        }
        else{
            redirect('login/login');
        }
    }

    public function accept($teamid, $catid){

        if($this->session->userdata('logged_in')==true){

            // require (APPPATH."PHPMailer/class.phpmailer.php");
            // require (APPPATH."PHPMailer/class.smtp.php");

            $this->load->library("phpmailer_library");
            $objMail = $this->phpmailer_library->load();
           
            $this->load->model('compANDcatModel');
            $code = $this->compANDcatModel->getCode($catid, $teamid);
            $schoolemail = $this->compANDcatModel->getSchoolEmail($teamid);             //done
            $participantemail = $this->compANDcatModel->getParticipantEmail($teamid);   //done
            $categoryname = $this->compANDcatModel->getCatNamebyCatID($catid);         
            $compname = $this->compANDcatModel->getCompNamebyCatID($catid);
            $teamname = $this->compANDcatModel->getTeamNamebyTeamID($teamid);

            $this->compANDcatModel->sentEmailIdentifier($code);
           
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
                    <h4 style="text-align: center;">Congratulations! Your request has been accepted by the director!&nbsp;</h4>
                    <p>&nbsp;</p>
                    <h4 style="text-align: center;"><strong> ' . $teamname . '</strong> will now be able to join ' . '<strong>' . $categoryname . '</strong> of <strong>' . $compname . '</strong></h4>
                    <h4 style="text-align: center;">&nbsp;</h4>
                    <h4 style="text-align: center;">Enter this code so that you can join the category</h4>
                    <h1 style="text-align: center;"><span style="text-decoration: underline;"> ' . $code . '</span></h1>
                    <p>&nbsp;</p>';     //SI PUTANG CODE
                    $this->mail->AddAddress($schoolemail);


                    foreach($participantemail->result() as $sample){
                        $this->mail->AddAddress($sample->email);
                    }

                    $this->mail->Send();
                  


                     $this->load->model('notification');
                        $SchoolID = $this->notification->getSchoolIDofTeam($teamid);


                        date_default_timezone_set('Asia/Manila');
                        $today = date("Y-m-d H:i:s");
                        $message = $teamname . " has been accepted in " . $catname . " of " . $compname;
                       
                        $notification = array(
                                        'subject' => "Request Accepted for " . $catname . " of " . $compname,
                                        'text' =>  $message,
                                        'date' => $today
                                        );
                       
                    $notifID = $this->notification->insertNotification($notification);      //get ID of inserted notif

                    $this->notification->sendNotificationSchool($SchoolID, $notifID);
                    $this->session->set_flashdata('approved', 'Approval Successful!');
                    redirect("competitions/pendingrequests");

                   
            } catch(phpmailerException $e) {
              $this->session->set_flashdata('disapprove', $e->errorMessage()); //Pretty error messages from PHPMailer
              $this->session->set_flashdata('disapproved', "Team's request denied!");
              redirect("competitions/pendingrequests");
            }

        }
        else{
            $this->load->view('login/index');  
        }   
    }

    public function disapprove($teamid, $catid){

        if($this->session->userdata('logged_in')==true){

            $this->load->model('compANDcatModel');
            $this->compANDcatModel->DeclineRequest($teamid, $catid);

            $this->load->model('notification');
            $SchoolID = $this->notification->getSchoolIDofTeam($teamid);


            date_default_timezone_set('Asia/Manila');
            $today = date("Y-m-d H:i:s");
            $message = $teamname . " has been declined to join " . $catname . " of " . $compname;
           
            $notification = array(
                            'subject' => "Request Declined for " . $catname . " of " . $compname,
                            'text' =>  $message,
                            'date' => $today
                            );
                       
            $notifID = $this->notification->insertNotification($notification);      //get ID of inserted notif

            $this->notification->sendNotificationSchool($SchoolID, $notifID);


            redirect('teams/viewTeams/'.$catid);
           
        }
        else{
            $this->load->view('login/index');  
        }   
    }

    public function get_participants(){
            $this->load->library('Datatables');
          
            $aw = $this->session->userdata('zxc');
            $this->session->unset_userdata('zxc');

            $this->datatables->select('b.file_name, a.participant_id, a.address, a.contact_no, a.email, concat(" ", a.first_name, " ", a.last_name) as FullName, ')->from('participant a')->join('photos b', 'a.participant_id = b.participant_id', 'LEFT OUTER')->where('a.team_id', $aw);
               
            $this->datatables->add_column('edit', '<a href="' . base_url() . 'School_teams/UploadOrView/' . '$1' . '">View</a>', 'file_name');

            $this->datatables->add_column('approve', '<a class="btn btn-primary" href="' . base_url() . 'School_teams/UploadOrView/' . '$1' . '">Approve</a>', 'file_name');
           
            echo $this->datatables->generate();
    }

    public function ViewMatri($filename=NULL)
    {
            echo '<img src="' . base_url( 'uploads/matriculations/' . $filename) . '">';
   
    }

    public function checkTeamIfEligible($teamid, $catid){
        $status = $this->session->userdata('status');

        if($this->session->userdata('logged_in')==true){

       
            if($status=='director'){
                $this->session->set_userdata('header', 'competitions');
                $this->session->set_userdata('sublevel', 'PendingRequests');
                $this->load->model('compANDcatModel');
                if($this->compANDcatModel->checkIfMembersHaveMatri($teamid) == TRUE){

                     $data2['sample'] = $this->compANDcatModel->displayMembersApplying($teamid); //insert omegalul;
                     $data2['catID'] = $catid;
                     $data2['compID'] = $this->compANDcatModel->getCompIDbyCatID($catid);
                     $data2['compname'] = $this->compANDcatModel->getCompNamebyCatID($catid);
                     $data2['catname'] = $this->compANDcatModel->getCatNamebyCatID($catid);
                     $data2['teamname'] = $this->compANDcatModel->getTeamNamebyTeamID($teamid);
                     $data2['teamid'] = $teamid;
                     $this->load->view('templates/headerREAL');
                     $this->load->view('pages/Directors/participantz', $data2);
                }
                else{
                    $this->session->set_flashdata('NoMat', 'Unable to approve team. One or more student has no matriculation.') ;
                    redirect('categories/PendingTeamsInCategory/' . $catid);
                }
            }
            elseif($status=='Secretariat Committee'){
                $this->load->model('compANDcatModel');
                if($this->compANDcatModel->checkIfMembersHaveMatri($teamid) == TRUE){
                     // $this->load->view('templates/headerReal');
                     // $this->session->set_userdata('zxc', $teamid);
                     $data2['compname'] = $this->compANDcatModel->getCompNamebyCatID($catid);
                     $data2['catname'] = $this->compANDcatModel->getCatNamebyCatID($catid);
                     $data2['teamname'] = $this->compANDcatModel->getTeamNamebyTeamID($teamid);
                     $data2['sample'] = $this->compANDcatModel->displayMembersApplying($teamid); //insert omegalul;
                     $data2['catID'] = $catid;
                     $data2['compID'] = $this->compANDcatModel->getCompIDbyCatID($catid);
                     $data2['teamid'] = $teamid;
                     $this->load->view('templates/headerSecretariat');
                     $this->load->view('pages/Directors/participantz', $data2);
                }
                else
                    echo "no matri, unable to approve request";
            }


        }
        else{
            redirect('Login/login');  
        }   

    }

    public function viewteams($catID){
        $this->load->model('team_model');

        if($this->session->userdata('status')=='director'){
            $data['sample'] = $this->team_model->viewApprovedTeams($catID);
            $data['header'] = "";
            $data['catID'] = $catID;


            if($this->team_model->viewApprovedTeams($catID)!='nothing'){

                $this->load->view('templates/headerSchool');
                $this->load->view('pages/approvedteams', $data);
                $this->load->view('templates/footer');
            }
            else{
                $this->load->view('templates/headerSchool');
                $data['header'] = "No Approved Teams Yet";
                $data['catID'] = $catID;
                $this->load->view('pages/Schools/NoApprovedTeamz', $data);
                $this->load->view('templates/footer');
            
            }
        }
        else{

            $this->session->set_userdata('header', 'mycompetitions');
            $data['sample'] = $this->team_model->viewApprovedTeamz($catID);
            $data['header'] = "";
            $data['catID'] = $catID;


            //GET COMP NAME OF CAT ID

            if($this->team_model->viewApprovedTeams($catID)!='nothing'){

                $this->load->model('compANDcatModel');
                $data['compname']= $this->compANDcatModel->getCompNamebyCatID($catID);
                $data['catName'] = $this->compANDcatModel->getCatNamebyCatID($catID);
                if($this->compANDcatModel->getWinners($catID)!=false){
                    $data['winners'] = $this->compANDcatModel->getWinners($catID);
                }
                else{
                    $data['winners'] = '';
                }
                $this->load->view('templates/headerSchool');
                $this->load->view('pages/approvedteamz', $data);
                $this->load->view('templates/footer');
            }
            else{
                $this->load->view('templates/headerSchool');
                $data['header'] = "No Approved Teams Yet";
                $data['catID'] = $catID;
                $this->load->view('pages/Schools/NoApprovedTeams', $data);
                $this->load->view('templates/footer');
            
            }
            $this->session->unset_userdata('header');
        }
    }
    public function file_check($str){
        $allowed_mime_type_arr = array('application/pdf','image/gif','image/jpeg','image/pjpeg','image/png','image/x-png');
        $mime = get_mime_by_extension($_FILES['file']['name']);
        if(isset($_FILES['file']['name']) && $_FILES['file']['name']!=""){
            if(in_array($mime, $allowed_mime_type_arr)){
                return true;
            }else{
                $this->form_validation->set_message('file_check', 'Please select only pdf/gif/jpg/png file.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
            return false;
        }
    }

}

?>