<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class School_teams extends CI_Controller{

    
    public function __construct()
    {
                parent::__construct();
                $this->load->helper(array('form', 'url'));
    }

    public function UploadOrView($filename=NULL)
    {
                if($filename==NULL){
                    $this->session->set_flashdata('message', 'No Matri Found');
                    redirect('School_teams/participants');

                }
                else{
                   echo '<img src="' . base_url( 'uploads/matriculations/' . $filename) . '">';
                }
    }

    public function index()
    {
        if($this->session->userdata('logged_in')==true){
            

            $ID = $this->session->userdata('id');
            $username = $this->session->userdata('user');
            $status = $this->session->userdata('status');

            if($status=='director'){
                $this->load->model('team_model');
                $data['sample'] = $this->team_model->displayALL($ID, $status);
            
                $this->load->view('templates/headerSchool');
                $this->load->view('pages/my_teams', $data);
                $this->load->view('templates/footer');
            }
            else if($status=='school'){

                $this->session->set_userdata('header', 'teams');
                $this->session->set_userdata('sublevel', 'myteams');
                $this->load->model('team_model');
                $data['sample'] = $this->team_model->getParticipantsInSchool($ID);
                $data['sample2'] = $this->team_model->getCoachForTeam($ID);
                $this->load->view('templates/headerSchool');
                $this->load->view('pages/my_teams', $data);
                $this->load->view('templates/footer');
                $this->session->unset_userdata('header');
                $this->session->unset_userdata('sublevel');

            }
        }   
        else{
        redirect('Login/index');
        }
    }  

    

    public function coaches()
    {
        if($this->session->userdata('logged_in')==true){
            
            //echo $this->session->flashdata('message_name');

            $ID['id'] = $this->session->userdata('id');
            $username = $this->session->userdata('user');
            $status = $this->session->userdata('status');

            if($status=='school'){

                $this->session->set_userdata('header', 'teams');
                $this->session->set_userdata('sublevel', 'coaches');

                $this->load->model('team_model');
                $this->load->helper('form');

                // $data['sample'] = $this->team_model->displayParticipants($ID);
                $this->load->view('templates/headerSchool');
                // $this->load->view('pages/Schools/participants', $data);
                $this->load->view('pages/Schools/coaches', $ID);
                $this->load->view('templates/footer');

            }
        }

        else{
redirect('Login/index');
        }
    } 

 public function participants()
    {
        if($this->session->userdata('logged_in')==true){
                            $this->session->set_userdata('header', 'teams');
                $this->session->set_userdata('sublevel', 'participants');
            echo $this->session->flashdata('message_name');

            $ID['id'] = $this->session->userdata('id');
            $username = $this->session->userdata('user');
            $status = $this->session->userdata('status');

            if($status=='school'){

                $this->load->model('team_model');
                $this->load->helper('form');

                // $data['sample'] = $this->team_model->displayParticipants($ID);
                $this->load->view('templates/headerSchool');
                // $this->load->view('pages/Schools/participants', $data);
                $this->load->view('pages/Schools/participants', $ID);
                $this->load->view('templates/footer');
                $this->session->unset_userdata('header');
                $this->session->unset_userdata('sublevel');
            }
        }

        else{
            redirect('Login/index');
        }
    } 
    public function createParticipant(){
         if($this->session->userdata('logged_in')==true){
            $this->session->set_userdata('header', 'teams');
            $this->session->set_userdata('sublevel', 'participants');
        echo $this->session->flashdata('message_name');

        $ID['id'] = $this->session->userdata('id');
        $username = $this->session->userdata('user');
        $status = $this->session->userdata('status');
            $status = $this->session->userdata('status');
            if($status=='school'){
                $this->load->library('form_validation');
                $this->form_validation->set_rules('firstname', 'First Name', 'required|alpha'); 
                $this->form_validation->set_rules('middlename', 'Middle Name','required|alpha');
                $this->form_validation->set_rules('lastname', 'Last Name',  'required|alpha');
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email', 'callback_email_exists');
                $this->form_validation->set_rules('contactno', 'Contact Number', 'required|numeric');
                $this->form_validation->set_rules('address', 'Address', 'required');
                if($this->form_validation->run() == TRUE){
                $fname = $this->input->post('firstname');
                $mname = $this->input->post('middlename');
                $lname = $this->input->post('lastname');
                $address = $this->input->post('address');
                $contactno = $this->input->post('contactno');
                $email = $this->input->post('email');

                $id = $this->session->userdata('id');
                $user = array(
                        'first_name'=>$fname,
                        'middle_name'=>$mname,
                        'last_name'=>$lname,
                        'address'=>$address,
                        'contact_no'=>$contactno,
                        'email'=>$email,
                        'school_id'=>$id
                );

            $this->load->model('team_model');
            $this->team_model->createParticipant($user);


            $config['upload_path']          = './uploads/matriculations/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['overwrite']            = FALSE; 
            // $config['max_size']             = 100;
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;

            $this->load->library('Upload', $config);


            if ($this->Upload->do_upload('userfile'))
            {
                $data = array('upload_data' => $this->upload->data());
                    
                    //get email to get id to upload
                    $participantID=$this->team_model->getParticipantIDemail($email);
                    if($this->team_model->checkMatri($participantID)!=true){
                        $insert = array(
                                    'participant_id' => $participantID,
                                    'file_name' => $data['upload_data']['file_name'],
                                    'upload_path' => $data['upload_data']['full_path']
                                  );
                           
                        $this->db->insert('photos', $insert);
                    }
                    else{
                        
                        $file_name = $data['upload_data']['file_name'];
                        $upload_path = $data['upload_data']['full_path'];
                        $this->team_model->updateMatri($participantID, $file_name);
                       // $this->load->view('pages/upload_success', $data);
                    }
            }
                

            $this->session->set_flashdata('create', 'Successfully Added!');
            
            redirect('School_teams/participants');

        }
            }
        }
        
        
        else{
            redirect('login'); 
        }
        $this->load->view('templates/headerSchool');
                // $this->load->view('pages/Schools/participants', $data);
                $this->load->view('pages/Schools/participants', $ID);
                $this->load->view('templates/footer');
    }


    public function processEdit($id){
         if($this->session->userdata('logged_in')==true){
            
            $status = $this->session->userdata('status');
            if($status=='school'){

                $fname = $this->input->post('firstname');
                $mname = $this->input->post('middlename');
                $lname = $this->input->post('lastname');
                $address = $this->input->post('address');
                $contactno = $this->input->post('contactno');
                $email = $this->input->post('email');

                $user = array(
                        'first_name'=>$fname,
                        'middle_name'=>$mname,
                        'last_name'=>$lname,
                        'address'=>$address,
                        'contact_no'=>$contactno,
                        'email'=>$email,
                        'team_id'=>NULL
                );

            $this->load->model('team_model');
            $this->team_model->editParticipant($user, $id);


            $config['upload_path']          = './uploads/matriculations/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['overwrite']            = FALSE; //true
            // $config['max_size']             = 100;
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;

            $this->load->library('upload', $config);


            if ($this->upload->do_upload('userfile'))
            {
                $data = array('upload_data' => $this->upload->data());
                    
                    //get email to get id to upload
                    // $participantID=$this->team_model->getParticipantIDemail($email);
                    if($this->team_model->checkMatri($id)!=true){
                        $insert = array(
                                    'participant_id' => $id,
                                    'file_name' => $data['upload_data']['file_name'],
                                    'upload_path' => $data['upload_data']['full_path']
                                  );
                           
                        $this->db->insert('photos', $insert);
                    }
                    else{
                        
                        $file_name = $data['upload_data']['file_name'];
                        $uplod_path = $data['upload_data']['full_path'];
                        $this->team_model->updateMatri($id, $file_name);
                       // $this->load->view('pages/upload_success', $data);
                    }
            }
                

            $this->session->set_flashdata('edit', 'Edit Successful!');
            
            redirect('School_teams/participants');


            }
        }

        else{
            redirect('login'); 
        }
    }

    public function processEditCoach($id){
         if($this->session->userdata('logged_in')==true){
            
            $status = $this->session->userdata('status');
            if($status=='school'){

                $fname = $this->input->post('firstname');
                $mname = $this->input->post('middlename');
                $lname = $this->input->post('lastname');
                $address = $this->input->post('address');
                $contactno = $this->input->post('contactno');
                $email = $this->input->post('email');

                $user = array(
                        'first_name'=>$fname,
                        'middle_name'=>$mname,
                        'last_name'=>$lname,
                        'address'=>$address,
                        'contact_no'=>$contactno,
                        'email'=>$email,
                        'school_id'=>$this->session->userdata('id')
                );

            $this->load->model('team_model');
            $this->team_model->editCoach($user, $id);

            $this->session->set_flashdata('edit', 'Edit Successful!');
            
            redirect('School_teams/coaches');


            }
        }

        else{
            redirect('login'); 
        }
    }


    public function deleteParticipants($aw)
    {
        if($this->session->userdata('logged_in')==true){
            
            $status=$this->session->userdata('status');
            if($status=='school'){


                $this->load->model('team_model');
                $this->team_model->deleteParticipant($aw);

                $this->session->set_flashdata('delete', 'Delete successful!');
                redirect('School_teams/participants');

            }
        }

        else{
redirect('Login/index');
        }
    } 


    //EDITING PARTICIPANTS 
    public function editParticipant($aw)
    {
        if($this->session->userdata('logged_in')==true){
            $status=$this->session->userdata('status');
        
            if($status=='school'){

                $this->session->set_userdata('header', 'teams');
                $this->session->set_userdata('sublevel', 'participants');
                $this->load->model('team_model');
                $data['sample'] = $this->team_model->getParticipant($aw);
                // print_r($data['sample']);
                // die();
                $this->load->view('templates/headerSchool');
                $this->load->view('pages/Schools/editParticipant', $data);
                $this->load->view('templates/footer');



            }
        }

        else{
redirect('Login/index');
        }
    } 

    
        function get_participants($id){
            $this->load->library('Datatables');
            // $this->datatables->select('b.file_name, a.participant_id, a.address, a.contact_no, a.email, concat(" ", a.first_name, " ", a.last_name) as FullName, ')->from('participant a, photos b')->where('a.participant_id = b.participant_id');

            // $this->db->query("select photos.file_name from participant inner join photos on participant.participant_id = photos.participant_id");

            // $a = $this->db->get()->row()->file_name;


            $this->datatables
                ->select('b.file_name, a.participant_id, a.address, a.contact_no, a.email, concat(" ", a.first_name, " ", a.last_name) as FullName, ')
                ->from('participant a')
                ->join('photos b', 'a.participant_id = b.participant_id', 'LEFT OUTER')
                ->where('a.school_id', $id);


            // <a class="btn" href="'. base_url() . 'uploads/'. '$1' . '" > View</a>


            // if($a!=NULL){ 
                
                $this->datatables->add_column('edit', '<a href="' . base_url() . 'School_teams/UploadOrView/' . '$1' . '">View</a>', 'file_name');

            // if($this->datatables->get()->row()->file_name!=NULL){
            //     echo "aw";
            // }


            // }
            // else{
            //     $this->datatables->add_column('edit', 'No Matriculation Form Founds', 'file_name');
            // }

            // $this->datatables->add_column('delete', '<a class="btn btn-primary" href="chooseCat/$1">Edit</a>  <a class="btn btn-danger" href="chooseCat/$1">Delete</a>', 'participant_id');
            $this->datatables->add_column('delete', '<a class="btn btn-primary" href="editParticipant/$1">Edit</a>  <a class="btn btn-danger" href="deleteParticipants/$1/" onclick="return doconfirm()">Delete</a>', 'participant_id');

            echo $this->datatables->generate();


        } 

        function get_coaches($id){
            $this->load->library('Datatables');
           

            $this->datatables->select('coach_id, address, contact_no, email, concat(" ", first_name, " ", last_name) as FullName, ')->from('coach')->where('school_id', $id);

            // ->join('photos b', 'a.participant_id = b.participant_id', 'LEFT OUTER');
        
            $this->datatables->add_column('delete', '<a class="btn btn-primary" href="editCoach/$1">Edit</a>  <a class="btn btn-danger" href="deleteCoach/$1/" onclick="return doconfirm()">Delete</a>', 'coach_id');

            echo $this->datatables->generate();


        }    


        public function createCoach(){
         if($this->session->userdata('logged_in')==true){
            $ID['id'] = $this->session->userdata('id');
            $username = $this->session->userdata('user');
            $status = $this->session->userdata('status');
           
            if($status=='school'){
                $this->load->library('form_validation');
                $this->form_validation->set_rules('firstname', 'First Name', 'required|alpha'); 
                $this->form_validation->set_rules('middlename', 'Middle Name','required|alpha');
                $this->form_validation->set_rules('lastname', 'Last Name',  'required|alpha');
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email', 'callback_email_exists');
                $this->form_validation->set_rules('contactno', 'Contact Number', 'required|numeric');
                $this->form_validation->set_rules('address', 'Address', 'required');
                if($this->form_validation->run() == TRUE){
                $fname = $this->input->post('firstname');
                $mname = $this->input->post('middlename');
                $lname = $this->input->post('lastname');
                $address = $this->input->post('address');
                $contactno = $this->input->post('contactno');
                $email = $this->input->post('email');

                $user = array(
                        'first_name'=>$fname,
                        'middle_name'=>$mname,
                        'last_name'=>$lname,
                        'address'=>$address,
                        'contact_no'=>$contactno,
                        'email'=>$email,
                        'school_id' => $this->session->userdata('id')
                );

            $this->load->model('team_model');
            $this->team_model->createCoach($user);

            $this->session->set_flashdata('create', 'Successfully Added!');
            
            redirect('School_teams/coaches');


            }
        }
    }
        else{
            redirect('login'); 
        }
        $this->load->view('templates/headerSchool');
        // $this->load->view('pages/Schools/participants', $data);
        $this->load->view('pages/Schools/coaches', $ID);
        $this->load->view('templates/footer');
    }

    public function deleteCoach($aw)
    {
        if($this->session->userdata('logged_in')==true){
            
            $status=$this->session->userdata('status');
            if($status=='school'){


                $this->load->model('team_model');
                $this->team_model->deleteParticipant($aw);

                $this->session->set_flashdata('delete', 'Delete successful!');
                redirect('School_teams/coaches');

            }
        }

        else{
redirect('Login/index');
        }
       
    } 

    public function editCoach($aw)
    {
        if($this->session->userdata('logged_in')==true){
            $status=$this->session->userdata('status');
        
            if($status=='school'){


                $this->load->model('team_model');
                $data['sample'] = $this->team_model->getCoach($aw);
                // print_r($data['sample']);
                // die();
                $this->load->view('templates/headerSchool');
                $this->load->view('pages/Schools/editCoach', $data);
                $this->load->view('templates/footer');

            }
        }

        else{
redirect('Login/index');
        }
    }

    function get_Schoolteams(){
            $id = $this->session->userdata('id');
            $this->load->library('Datatables');
            // $this->datatables->select('a.team_name as team_name, group_concat(concat(" ", c.first_name, " ", c.last_name)) as members')->from('team a, participant c')->where('a.team_id = c.team_id')->where('a.school_id', $id)->group_by('a.team_id');

            // $this->datatables->select('a.team_name as team_name, concat(" ", c.first_name, " ", c.last_name) as members, concat(" ", b.first_name, " ", b.last_name)')->from('team a, participant c, coach b')->where('a.team_id = c.team_id')->where('b.team_id = a.team_id')->where('c.school_id', $id);

            //TRY INNER JOIN FOR BETTER PURPOSES PAG SEARCH


                //             select team.team_name as team_name, concat(" ", participant.first_name, " ", participant.last_name) as members, concat(" ", coach.first_name, " ", coach.last_name) as coach
                // from participant
                // left outer join coach ON coach.team_id = participant.team_id 
                // inner join team on team.team_id = participant.team_id 
                // WHERE team.school_id = 

//             SELECT a.team_name, a.team_id, concat(" ", c.first_name, " ", c.last_name) as members, concat(b.first_name, " ", b.last_name) as coach
// from participant c 
// INNER JOIN team a ON a.team_id = c.team_id
// LEFT OUTER JOIN coach b ON b.coach_id = a.coach_id
//WHERE a.school_id = $id



            $this->datatables->select('d.team_name, a.team_id, concat(" ", c.first_name, " ", c.last_name) as members, concat(b.first_name, " ", b.last_name) as coach')->from('participant c')->join('teams_members a', 'a.participant_id = c.participant_id', 'INNER')->join('team d', 'd.team_id = a.team_id', 'INNER')->join('coach b', 'b.coach_id = a.coach_id', 'LEFT OUTER')->where('d.school_id', $id);

            $this->datatables->add_column('action', '<a class="btn btn-primary" href="editTeam/$1">Edit</a>  <a class="btn btn-danger" href="deleteTeams/$1" onclick="return doconfirm()">Delete</a>', 'team_id');

            echo $this->datatables->generate();
    }

    public function createTeam(){
         if($this->session->userdata('logged_in')==true){
            $ID = $this->session->userdata('id');
            $username = $this->session->userdata('user');
           
            $status = $this->session->userdata('status');
            if($status=='school'){

                $this->load->library('form_validation');
                $this->form_validation->set_rules('teamname', 'Team Name', 'required'); 
                
                
                
                if($this->form_validation->run() == TRUE){
                $id = $this->session->userdata('id');
                $names = $this->input->post('members');
                $coach = $this->input->post('coach');
                $teamname = $this->input->post('teamname');
                $newmember = $this->input->post('NewMember');


                //TOKENIZE TO MAKE ARRAAY AND INPUT TO PARTICIPANTS BUT ONLY NAME ON IT.    

                $team = array(
                        'team_name'=>$teamname,
                        'school_id'=>$id
                );

                $this->load->model('team_model');

                $this->team_model->createTeam($team);                         //GIBUHON MUNA SI TEAM 

                $teamid = $this->team_model->getTeamID($teamname);            //KUAHON SI TEAM ID PARA MALAAG SA Participant

                $teamz = array(
                            'team_id' => $teamid
                        );

                // $this->team_model->createTeamMembers($teamz);
             
                foreach($names as $puta){
                    $this->team_model->joinTeam($teamid, $puta, $coach);
                }

                // if($coach!=NULL){
                //     $this->team_model->CoachJoin($teamid, $coach);
                // }

                $this->session->set_flashdata('create', 'Successfully Added!');
            
                redirect('School_teams/index');


            }
        }
    }
        else{
            redirect('login'); 
        }
        $this->session->set_userdata('header', 'teams');
        $this->session->set_userdata('sublevel', 'myteams');
        $this->load->model('team_model');
        $data['sample'] = $this->team_model->getParticipantsInSchool($ID);
        $data['sample2'] = $this->team_model->getCoachForTeam($ID);
        $this->load->view('templates/headerSchool');
        $this->load->view('pages/my_teams', $data);
        $this->load->view('templates/footer');
        $this->session->unset_userdata('header');
        $this->session->unset_userdata('sublevel');
    }

    public function deleteTeams($teamID)
    {
        if($this->session->userdata('logged_in')==true){
            
            $status=$this->session->userdata('status');
            if($status=='school'){


                $this->load->model('team_model');

                //delete team
                $this->team_model->deleteTeam($teamID);

                $this->session->set_flashdata('delete', 'Delete successful!');
                redirect('School_teams/index');

            }
        }

        else{
            redirect('Login/index');
        }
    } 


    //EDITING PARTICIPANTS 
    public function editTeam($teamID)
    {
        if($this->session->userdata('logged_in')==true){
            $status=$this->session->userdata('status');
        
            if($status=='school'){


                //ANOTHER IF NA PAG KASALI ANG TEAM SA COMPETITION NA UPCOMING OR PRESENT MAKAKACANCEL ANG APPROVAL.
                


                $schoolid = $this->session->userdata('id');

                $this->load->model('team_model');
                $data['sample'] = $this->team_model->getTeam($teamID); //EDITING PARTICIPANTS IN THAT TEAM

                //get participants in team and put in array
                $participants = $this->team_model->getParticipantIDInTeam($teamID);
                $count = $participants->num_rows();
                $data['sample3'] = $this->team_model->getParticipantsNotInTeam($schoolid, $participants->result_array(), $count); //GETTING PARTICIPANTS 
                

                $data['sample4'] = $this->team_model->getCoachInTeam($teamID);   //get facking coach

                if($data['sample4']!='false'){
                    $coachID = $this->team_model->getCoachIDInTeam($teamID);
                    $data['sample2'] = $this->team_model->getCoachNotInTeam($teamID, $coachID);   //get facking coach
                }

                $data['sample5'] = $this->team_model->getCoachForTeam($schoolid);

                $this->load->view('templates/headerSchool');
                $this->load->view('pages/Schools/editTeam', $data);

            }
        }

        else{
redirect('Login/index');
        }
    }

     public function editTeamz($teamID)
    {
        if($this->session->userdata('logged_in')==true){
            $status=$this->session->userdata('status');
        
            if($status=='school'){


                // echo "Team: " . $aw . "<br>";

                $this->load->model('team_model');

                $this->team_model->clearTeam($teamID);  //delete participants in team

                $name = $this->input->post("teamname");

                $this->team_model->updateTeamName($teamID, $name);      //name of team muna


                foreach($this->input->post("members") as $partID){
                     $this->team_model->setTeamForParticipant($teamID, $partID);     //seet the new team id for selected 
                }

                $coach = $this->input->post("coach");

                if($coach){
                    $this->team_model->clearTeamsCoach($teamID);                //clear coach pag may input

                    foreach($this->input->post("coach") as $coachID){   
                        $this->team_model->setTeamForCoach($teamID, $coachID);  //set new coach omegalul
                    }
                }

                $this->session->set_flashdata('edit', 'Edit Successful!');
                redirect('School_teams/index');

            }
        }

        else{
            redirect('Login/login');
        }
    }

    function participant_data(){
        $this->load->model('team_model');
        $data=$this->team_model->participant_list();
        echo json_encode($data);
    }

    function indexzc(){
        $this->load->view('templates/headerSchool');
        $this->load->view('templates/footer');
        $this->load->view('pages/Schools/participants_view');
    }
}


   


?>


