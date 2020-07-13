<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class competitions extends CI_Controller {
        function __construct() {
            // then execute the parent constructor anyway
            parent::__construct();
            // $this->load->library('session');

            if(!$this->session->userdata('logged_in'))
                redirect('Login/logout', true);
        }
    public function index(){

        if($this->session->userdata('logged_in')==true){
            $ID = $this->session->userdata('id');
            $username = $this->session->userdata('user');
            $status = $this->session->userdata('status');
        
            
            // Load the list page view
            if($status!='school'){

                $data = array();
                $this->load->model('compANDcatModel');
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
                $rowsCount = $this->compANDcatModel->getComps($conditions);
                
                // Pagination config
                $config['base_url']    = base_url().'competitions/index/';
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
                $data['sample'] = $this->compANDcatModel->getComps($conditions);
                $data['title'] = '';

                if($status=='director'){
                    $this->session->set_userdata('header', 'competitions');
                    $this->session->set_userdata('sublevel', 'AllCompetitions');
                    $this->load->view('templates/headerREAL');
                    $this->load->view('templates/footer');
                    $this->load->view('pages/CompetitionDirector', $data);
                    $this->session->unset_userdata('header');
                    $this->session->unset_userdata('sublevel');
                }
                elseif($status=='Secretariat Committee'){


                    $this->load->model('compANDcatModel');
                    //$data['sample'] = $this->compANDcatModel->displayComp($ID, $status);
                    $this->load->view('templates/headerSecretariat');
                    $this->load->view('templates/footer');
                    $this->load->view('pages/CompetitionCommittee', $data);
                }
                elseif($status=='Technical Committee'){
                    $this->load->model('compANDcatModel');
                    //$data['sample'] = $this->compANDcatModel->displayComp($ID, $status);
                    $this->load->view('templates/headerTechnical');
                    $this->load->view('pages/CompetitionCommittee', $data);
                    $this->load->view('templates/footer');                
                }
            }

            else{

                $this->session->set_userdata('header', 'mycompetitions');

                $conditions['SchoolID'] = $ID;
                $conditions['status'] = $status;
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
                $rowsCount = $this->compANDcatModel->displayCompSchool($conditions);
                
                // Pagination config
                $config['base_url']    = base_url().'competitions/sample/';
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
                $data['sample'] = $this->compANDcatModel->displayCompSchool($conditions);
                $data['title'] = '';


                $this->load->model('compANDcatModel');
                //if($this->compANDcatModel->displayCompSchool($status)!=false){
                if( $this->compANDcatModel->displayCompSchool($conditions) == 'false' ){
                    $data['header'] = "No Competitions Registered";
                    $this->load->view('templates/headerSchool');
                    $this->load->view('pages/NoCompetitionsSchool', $data);
                    $this->load->view('templates/footer');   
                }
                else{
                    
                    $data['sample'] = $this->compANDcatModel->displayCompSchool($conditions);
                    $this->load->view('templates/headerSchool');
                    $this->load->view('pages/CompetitionSchool', $data);
                    $this->load->view('templates/footer');
                }

                $this->session->unset_userdata('header');

            }




        }
         else{
            $this->load->view('templates/header');
            $this->load->view('templates/footer');
            $this->load->view('pages/login');   
        }
        
    }


    public function indexOriginal(){
   
    	if($this->session->userdata('logged_in')==true){
            $ID = $this->session->userdata('id');
            $username = $this->session->userdata('user');
            $status = $this->session->userdata('status');
           
            if($status=='director'){

                $this->load->model('compANDcatModel');
                $data['sample'] = $this->compANDcatModel->displayComp($ID, $status);
                $data['directorID'] = $ID;

                //pagination*
        
    		    $this->load->view('templates/headerREAL');
                $this->load->view('pages/CompetitionDirector', $data);
        	    $this->load->view('templates/footer');
            }
           
            elseif($status=='Secretariat Committee'){
                $this->load->model('compANDcatModel');
                $data['sample'] = $this->compANDcatModel->displayComp($ID, $status);
                $this->load->view('templates/headerSecretariat');
                $this->load->view('pages/CompetitionDirector', $data);
                $this->load->view('templates/footer');
            }

            elseif($status=='Technical Committee'){
                $this->load->model('compANDcatModel');
                $data['sample'] = $this->compANDcatModel->displayComp($ID, $status);
                $this->load->view('templates/headerTechnical');
                $this->load->view('pages/CompetitionDirector', $data);
                $this->load->view('templates/footer');                
            }
           
            elseif($status=='school'){
                /*
                $legit = str_replace("%20"," ",$aw);
                //$data2['compID'] = $aw;
                $data2['sample'] = $this->compANDcatModel->displayCat($legit);
                $data2['name'] = $legit;
            $this->load->view('templates/headerSchool');
            $this->load->view('pages/categoriesSchool', $data2);
            $this->load->view('templates/footer')
            */
                $this->load->model('compANDcatModel');
                //if($this->compANDcatModel->displayCompSchool($status)!=false){
                if( $this->compANDcatModel->displayCompSchool($ID, $status) == 'false' ){
                    $data['header'] = "No Competitions Registered";
                    $this->load->view('templates/headerSchool');
                    $this->load->view('pages/NoCompetitionsSchool', $data);
                    $this->load->view('templates/footer');   
                }
                else{
                    
                    $data['sample'] = $this->compANDcatModel->displayCompSchool($ID, $status);
                    $this->load->view('templates/headerSchool');
                    $this->load->view('pages/CompetitionSchool', $data);
                    $this->load->view('templates/footer');
                }

            }

        }
        else{
            $this->load->view('templates/header');
            $this->load->view('templates/footer');
        	$this->load->view('pages/login');	
        }
    }

     public function index2(){

        $this->load->model('compANDcatModel');
        $this->load->library('Ajax_pagination');


        $data = array();
        

        $id = $this->session->userdata('ID');
        $status = $this->session->userdata('status');
        //total rows count
        $totalRec = count($this->compANDcatModel->getComps());
        
        //pagination configuration
        $config['target']      = '#aww';
        $config['base_url']    = base_url().'competitions/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = 6;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $data['sample'] = $this->compANDcatModel->getComps(array('limit'=>6));
        
        //load the view
        $this->load->view('templates/headerREAL');
        $this->load->view('templates/footer');
        $this->load->view('pages/CompetitionDirector', $data);
    }
    
    function ajaxPaginationData(){
        $conditions = array();
        
        //calc offset number
        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //set conditions for search
        $keywords = $this->input->post('keywords');
        $sortBy = $this->input->post('sortBy');
        if(!empty($keywords)){
            $conditions['search']['keywords'] = $keywords;
        }
        if(!empty($sortBy)){
            $conditions['search']['sortBy'] = $sortBy;
        }
        
        //total rows count
        $totalRec = count($this->compANDcatModel->getComps($conditions));
        
        //pagination configuration
        $config['target']      = '#aww';
        $config['base_url']    = base_url().'posts/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $data['sample'] = $this->compANDcatModel->getComp($conditions);
        
        //load the view
        $this->load->view('pages/pagination/ajax-pagination-data', $data, false);
    }
    


    public function FetchCompetitions(){
        $output = '';
        $query = '';
        $directorID = '';
        $this->load->model('compANDcatModel');
        
        $directorID = $this->input->post('directorID');
                
        if($this->input->post('query')){
         $query = $this->input->post('query');
        }

        // $data = $this->compANDcatModel->fetchCompetitions($query, $directorID);
        
 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data = $this->compANDcatModel->
            fetchCompetitions($query, $directorID);




  

        if($data->num_rows() > 0){
            foreach($data->result() as $row){


        $output .= '
                <div class="row-lg-3 row-xs-6">
                    <div class="col-lg-3 col-xs-6">
                        <div style="background-color: rgb(60, 141, 188)" class="small-box text-center" id="box">
                            <div class="inner" style="color: white">
                    ';

                $output .= '
                    <h3 style="font-size: 20px;">'. $row->competition_name . '</h3>
                        <p>'.  
                        $row->start_date;

                        if(date('F d, Y') > $row->start_date){
                          $output .= '<br><i class="label bg-red">Done</i>';
                        }
                        else{
                          $output .= '<i>&nbsp;</i>'; 
                        }

                        $output .= '</p>';
                
                if($this->session->userdata('status')=='director'){
                    if($row->start_date <= date('F d, Y')){         //BALIKTADON MO NI 
                    
                    $output .= '<a class="btn btn-primary" href="editComp/' . $row->competition_id . '" class="btn btn primary">Edit</a>

                                <a class="btn btn-danger" href="deleteComp/' . $row->competition_id . '" class="btn btn primary" onClick="return doconfirm();"> Delete </a>';
                        }
                }

                $output .= '</div>
                    <a href="viewCat/' . $row->competition_name . '" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>

                    </div>
                    </div>
                    </div>' 

                    ;    
            }
        }

        else{
           $output = 'No Data Found';
        }

        echo $output;
    }

    


    public function all(){
   
        if($this->session->userdata('logged_in')==true){
            $ID = $this->session->userdata('id');
            $username = $this->session->userdata('user');
            $status = $this->session->userdata('status');
           

           if($status=='school'){

                $this->session->set_userdata('header', 'competitions');


                    // $this->load->model('compANDcatModel');
                    // $data['sample'] = $this->compANDcatModel->displayComp($ID, $status);
                    // $this->load->view('templates/headerSchool');
                    // $this->load->view('pages/CompetitionSchoolAll', $data);
                    // $this->load->view('templates/footer');


            //MAKE DATATABLES FOR CHOOSING COMP
                $this->load->model('compANDcatModel');
                $data['result'] = $this->compANDcatModel->getCompetitionsForSchool();
                $this->load->view('templates/headerSchool');
                $this->load->view('pages/all_competitions', $data);
                $this->load->view('templates/footer');

                $this->session->unset_userdata('header');
            }
            
               
        }
        else{
           redirect('Login/index'); 
        }
    }

    public function get_comps(){
            $this->load->library('Datatables');
            $id = $this->session->userdata('id');

            $this->datatables

                             ->select("DISTINCT (a.competition_id) as CompID, a.competition_name, a.start_date")
                             ->from('competition a');
                             //->join('invites c', 'c.competition_id = a.competition_id', 'LEFT OUTER')
                             //->where('c.competition_id', 'a.competition_id')
                             //->where('c.school_id', $id);
            
            $this->datatables->add_column('edit', '<a class="btn btn-primary" href="chooseCat/$1">View</a>', 'CompID');

            echo $this->datatables->generate();
        
    }

    public function pendingrequests(){
            $ID = $this->session->userdata('id');
            $username = $this->session->userdata('user');
            $status = $this->session->userdata('status');

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
            $rowsCount = $this->compANDcatModel->getCompsWithPending($conditions);
            
            // Pagination config
            $config['base_url']    = base_url().'competitions/pendingrequests/';
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
            $data['sample'] = $this->compANDcatModel->getCompsWithPending($conditions);
            $data['title'] = '';
           
            $this->session->set_userdata('header', 'competitions');
            $this->session->set_userdata('sublevel', 'PendingRequests');

            if($status=='director'){
                //$this->load->model('compANDcatModel');
                //$data['sample'] = $this->compANDcatModel->getCompWithPendingNew($ID);
                
                if($this->compANDcatModel->getCompWithPendingNew($ID) != false){
                    $this->load->view('templates/headerREAL');
                    $this->load->view('pages/CompsWithPending', $data);
                    $this->load->view('templates/footer');
                }
                else{
                    $this->load->view('templates/headerREAL');
                    $this->load->view('pages/NoCompsWithPending');
                    $this->load->view('templates/footer');
                }
            }
            else if($status == 'Secretariat Committee'){


                if($this->compANDcatModel->getCompWithPending($ID) != false){
                    $this->load->view('templates/headerSecretariat');
                    $this->load->view('pages/CompsWithPending', $data);
                    $this->load->view('templates/footer');
                }
                else{
                    $this->load->view('templates/headerSecretariat');
                    $this->load->view('pages/NoCompsWithPending');
                    $this->load->view('templates/footer');
                }

            }
            
            $this->session->unset_userdata('header');
            $this->session->unset_userdata('sublevel');
        
    }

    public function chooseComp(){
            $this->load->model('compANDcatModel');
            $ID = $this->session->userdata('id');
            $username = $this->session->userdata('user');
            $status = $this->session->userdata('status');
            $data['sample'] = $this->compANDcatModel->displayAvailableComp($ID, $status);
            $this->load->view('templates/headerSchool');
            $this->load->view('pages/ChooseComp', $data);
            $this->load->view('templates/footer');
    }

    public function chooseCat($compID){

        $this->load->model('compANDcatModel');
        if($this->session->userdata('status')=='school'){

             $this->session->set_userdata('header', 'competitions');

            $data2['sample'] = $this->compANDcatModel->displayCatById($compID);
            $data2['compname'] = $this->compANDcatModel->getCompNamebyCompID($compID);
            $data2['desc'] = $this->compANDcatModel->getDescription($compID);
            $this->load->view('templates/headerSchool');
            $this->load->view('pages/chooseCategoryz', $data2);
            $this->load->view('templates/footer');   
            $this->session->unset_userdata('header');
        }
        else{
            $this->load->view('login/index');   
        }
    }

    public function generateCertificate(){


        if($this->session->userdata('logged_in')==true){
                        $this->session->set_userdata('header', 'competitions');
            $this->session->set_userdata('sublevel', 'generateCertificate');

            $this->load->model('compANDcatModel');
            // $ID = $this->session->userdata('id');
            // $username = $this->session->userdata('user');
            // $status = $this->session->userdata('status');
            // $data['sample'] = $this->compANDcatModel->getCompsWithParticipants($ID);
            //this is original sa taas

            $ID = $this->session->userdata('id');
            $username = $this->session->userdata('user');
            $status = $this->session->userdata('status');
           

            //data search pagination
            $data = array();
            $this->load->model('compANDcatModel');
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
            $rowsCount = $this->compANDcatModel->getCompsWithParticipants($conditions);
            
            // Pagination config
            $config['base_url']    = base_url().'competitions/generateCertificate/';
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
            $data['sample'] = $this->compANDcatModel->getCompsWithParticipants($conditions);
            $data['title'] = '';


            if($status=='director'){
                $this->load->view('templates/headerREAL');
                $this->load->view('pages/generateCert', $data);
                $this->load->view('templates/footer');
            }
            else if($status=='Secretariat Committee'){
                $this->load->view('templates/headerSecretariat');
                $this->load->view('pages/generateCert', $data);
                $this->load->view('templates/footer');
            }
            else if($status=='school'){
               
                $this->load->view('templates/headerSchool');
                $this->load->view('pages/CompetitionSchool', $data);
                $this->load->view('templates/footer');
              }
            // redirect('editor/index');
                          $this->session->unset_userdata('header');
            $this->session->unset_userdata('sublevel');
        }


        else{
           redirect('Login/index'); 
        }

    }

     public function createCategory(){

            // $this->session->set_flashdata('compname', $compname);
            // $this->session->set_flashdata('sdate', $sdate);
            // $this->session->set_flashdata('edate', $edate);
            // $this->session->set_flashdata('director_id', $this->session->userdata('id'));  
            // $this->session->set_flashdata('cat_no', $no);
            // $this->load->model('compANDcatModel');
            $this->session->set_userdata('header', 'competitions');
            $this->session->set_userdata('sublevel', 'AllCompetitions');
            $this->load->view('templates/headerREAL');
            $this->load->view('pages/createCategory');
            $this->load->view('templates/footer');
            $this->session->unset_userdata('header');
            $this->session->unset_userdata('sublevel');

    }

    public function registerSchool(){

            $code = $this->input->post('code');
            $id = $this->session->userdata('id');

            
            $this->load->model('compANDcatModel');
           
            if($this->compANDcatModel->regSchool($code, $id)=="true")  
                $this->session->set_flashdata('success', 'Successfully entered code!');
            else
                $this->session->set_flashdata('error', 'Invalid code!');

            
            redirect('competitions/index');


    }

    public function finalstep(){

        $this->load->model('compANDcatModel');

        
        for($i=0; $i<$this->session->userdata('cat_no'); $i++){
            $catname[$i] = $this->input->post('input_'.$i);
            $cattype[$i] = $this->input->post('select_'.$i);
            $catpayment[$i] = $this->input->post('select2_'.$i);

        }

        $data['sample'] = $catname;
        $data['sample2'] = $cattype;
        $data['sample3'] = $catpayment;
        // $data['sample3'] = $catcode;

        $this->session->set_userdata('catnames', $catname);
        $this->session->set_userdata('cattypes', $cattype);
        $this->session->set_userdata('catpayment', $catpayment);


        $this->session->set_userdata('header', 'competitions');
        $this->session->set_userdata('sublevel', 'AllCompetitions');
        $this->load->view('templates/headerREAL');
        $this->load->view('pages/reviewCreation', $data);
        $this->load->view('templates/footer');
        $this->session->unset_userdata('header');
        $this->session->unset_userdata('sublevel');

    }

    public function publish(){
        $this->load->model('compANDcatModel');

        $comp = array(
                'competition_name'=>$this->session->userdata('competition_name'),
                'start_date'=>$this->session->userdata('start_date'),
                'end_date'=>$this->session->userdata('end_date'),
                'site_no'=>$this->session->userdata('site_no'),
                'director_id'=>$this->session->userdata('id'),
                'description'=>$this->input->post('description')
                );

        //insert comp
        $this->compANDcatModel->insertComp($comp);

        //get the Comp ID
        $compID = $this->compANDcatModel->getCompID($this->session->userdata('competition_name'));
        $catnames=$this->session->userdata('catnames');
        $cattypes=$this->session->userdata('cattypes');
        $catpayment = $this->session->userdata('catpayment');

        for($i=0; $i<$this->session->userdata('cat_no'); $i++){
            $cat = array(
                    'competition_id'=> $compID,
                    'category_name'=>$catnames[$i],
                    'category_type'=>$cattypes[$i],
                    'payment'=>$catpayment[$i]
                    );

            $this->compANDcatModel->insertCat($cat);
        }


        $this->session->unset_userdata('cat_no');
        $this->session->unset_userdata('competition_name');
        $this->session->unset_userdata('start_date');
        $this->session->unset_userdata('end_date');
        $this->session->unset_userdata('catnames');
        $this->session->unset_userdata('site_no');
        $this->session->unset_userdata('cattypes');
        // $this->session->unset_userdata('catcodes');


        $this->session->set_flashdata('success', 'Successfully added competition.');
        redirect('competitions/index'); 
    }

    public function CheckAttendance($CompID){
        $status = $this->session->userdata('status');
        $this->session->set_userdata('header', 'competitions');
        $this->session->set_userdata('sublevel', 'CheckAttendance');

        if($status=='director')
            $this->load->view('templates/headerREAL');
       
        else
            $this->load->view('templates/headerSecretariat');

        $this->load->model('team_model');
        
        $data['compID'] = $CompID;


        $this->load->view('pages/attendance', $data);
        $this->session->unset_userdata('header');
        $this->session->unset_userdata('sublevel');
    }

    public function participantYes($partID, $compID){
        $this->load->model('team_model');
        $this->team_model->approveAttendance($partID);
        $participantName = $this->team_model->getNameofParticipant($partID, $compID);
        //
        

        //DIGDI MAGIBONG CODE TAPOS INSERT SA PUTANGINANG FEEDBACK NA MAYO PANG ANSWER
        $this->load->model('feedback_model');
        do{  
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);

                $randomString = '';

                for ($j = 0; $j < 16; $j++){
                   $randomString .= $characters[rand(0, $charactersLength - 1)];
                    //      //PUTANGINANG MGA CODE DIGDI PARA SA PAGREGISTER
                }
                $code = $randomString;


        }while($this->feedback_model->checkCodes($code)==true);

        $this->feedback_model->insertFeedbackSlot($code, $compID);


        $this->load->model('team_model');
        $email = $this->team_model->getEmailOfParticipant($partID, $compID);

        //email the link of competition survey


            
            $this->load->model('compANDcatModel');
            
            $compName = $this->compANDcatModel->getCompNamebyCompID($compID);

            $this->load->library("phpmailer_library");
            $objMail = $this->phpmailer_library->load();
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
                    $this->mail->Subject = 'Survey';
                    $this->mail->Body = '
                    <h2 style="text-align: center;">Good Day, <strong> ' . $participantName . '</strong></h2>
                    <h3 style="text-align: center;">Thank you for attending in <strong>' . $compName .'</strong>!</h3>
                    <p style="text-align: center;">&nbsp;</p>
                    <p style="text-align: center;">We would love to hear your feedback!</p>
                    <p style="text-align: center;">Clink on the link below so that you can participate in the survey.</p>
                    <p style="text-align: center;">&nbsp;</p>
                    <h1 style="text-align: center;"><strong>' . base_url('Feedbacks/answer/') . $code . '</strong></h1>
                    <p>&nbsp;</p>';     //SI PUTANG CODE
                    
                    $this->mail->AddAddress($email);
                    $this->mail->Send();               
                    
            } catch(phpmailerException $e) {
                $this->session->set_flashdata('Success', 'Attendance Recorded!');
                redirect('competitions/CheckAttendance/'.$compID);
            }
        $this->session->set_flashdata('Success', 'Attendance Recorded!');
        redirect('competitions/CheckAttendance/'.$compID);
    }

    public function participantNo($partID, $compID){
        $this->load->model('team_model');
        $this->team_model->declineAttendance($partID);
        $this->session->set_flashdata('Success', 'Attendance Recorded!');
        redirect('competitions/CheckAttendance/'.$compID);
    }


    public function getparticipantingsincomp($compID){

            $this->load->library('Datatables');
            $this->datatables->select('a.Name, b.team_name, f.school_name, a.part_in_comp_ID, a.attend')
                             ->from('participants_in_competition a')
                             ->join('teams_in_competition b', 'b.teams_in_competition_id = a.teams_in_competition_id', 'INNER')
                             ->join('school f', 'f.school_id = b.school_id', 'INNER')
                             ->join('slot c', 'c.team_id = b.teams_in_competition_id', 'INNER')
                             ->join('category d', 'd.category_id = c.category_id', 'INNER')
                             ->join('competition e', 'e.competition_id = d.competition_id', 'INNER')
                             ->where('e.competition_id', $compID);
            echo $this->datatables->generate();        
    }

    public function viewCat($aw){

        //$aw = base64_decode(urldecode($aw2));
        $status = $this->session->userdata('status');

        if($status=='director' || $status=='Secretariat Committee' || $status=='Technical Committee'){

            $this->load->model('compANDcatModel');
            $legit = str_replace("%20"," ",$aw);
            $data2['sample'] = $this->compANDcatModel->displayCat($legit);
            $data3['count'] = $this->compANDcatModel->countCat( $this->compANDcatModel->getCompID($legit));
            $compID = $data2['IDofComp'] = $this->compANDcatModel->getCompID($legit);
            $data2['desc'] = $this->compANDcatModel->getDescription($compID);
            $data2['compname'] = $legit;
            $data2['date'] = $this->compANDcatModel->getCompDateByCompID($compID);

            if($status=='director'){
                $this->session->set_userdata('header', 'competitions');
                $this->session->set_userdata('sublevel', 'AllCompetitions');
                $this->load->view('templates/headerREAL');
            }
            elseif($status=='Secretariat Committee')
                $this->load->view('templates/headerSecretariat');
            elseif($status=='Technical Committee')
                $this->load->view('templates/headerTechnical');

            $this->load->view('pages/categories', $data2, $data3);
            $this->load->view('templates/footer');
        }
        else if($status=='school'){
            $this->session->set_userdata('header', 'mycompetitions');
            $this->load->model('compANDcatModel');
            $legit = str_replace("%20"," ",$aw);
            //$data2['compID'] = $aw;
            $id=$this->session->userdata('id');
            $data2['sample'] = $this->compANDcatModel->displayCatApproved($legit, $id);
            $data2['name'] = $legit;
            $compID = $this->compANDcatModel->getCompID($legit);

            $data2['desc'] = $this->compANDcatModel->getDescription($compID);
            
            $this->load->view('templates/headerSchool');
            $this->load->view('pages/categoriesSchool', $data2);
            $this->load->view('templates/footer');   
            $this->session->unset_userdata('header');
        }
            
    }

    public function viewCatUsingCompID($aw){

        //$aw = base64_decode(urldecode($aw2));


            $this->load->model('compANDcatModel');
            $data2['sample'] = $this->compANDcatModel->displayCatUsingCompID($aw);
            $data2['IDofComp'] = $aw;
            $this->load->view('templates/headerREAL');
            $this->load->view('pages/categories', $data2);
            $this->load->view('templates/footer');
        
            
    }

    public function editComp($aw){
            $this->load->model('compANDcatModel');
            //$legit = str_replace("%20"," ",$aw);
            //$this->compANDcatModel->deleteComp($legit);

            
            //$ID = $this->session->userdata('id');
            //$username = $this->session->userdata('user');
            $status = $this->session->userdata('status');
            $data['sample'] = $this->compANDcatModel->displayCompByCompID($aw, $status);

            if($status=='director'){
                $this->session->set_userdata('header', 'competitions');
                $this->session->set_userdata('sublevel', 'AllCompetitions');
                $this->load->view('templates/headerREAL');
                $this->load->view('pages/editCompetition', $data);
                $this->load->view('templates/footer');
                $this->session->unset_userdata('header');
                $this->session->unset_userdata('sublevel');
            }
    }

    public function processEdit($compID){       //PASS THE START EXISTING START DATE $ END DATE FIRST THEN CHECK IF START < END DATE
           
            $this->load->model('compANDcatModel');

            $name = $this->input->post('CompetitionName');
            $startdate = $this->input->post('startdate');
            $endingdate = $this->input->post('enddate');
   
            //EDIT THE COMPETITION NAME.
            //IF NO INPUT, DONT UPDATE ELSE UPDATE

            // if($name!=NULL){
            //     $this->compANDcatModel->editCompName($name, $compID);
            //     $this->session->set_flashdata('edit', 'Edit Successful!');
                
            // }

            // if($startdate!=NULL){
            //     if($startdate <= $end || $startdate <= $endingdate){                     //PAG MAYONG LAMAN DAI MAG EDIT
            //         $this->compANDcatModel->editStartDate($startdate, $getCompID);
            //         $this->session->set_flashdata('edit', 'Edit Successful!');
            //         redirect('Competitions/index');
            //     }
            // }

            // if($endingdate!=NULL){
            //     if($endingdate >= $start || $endingdate >= $startdate){
                    
            //     }

            //     //NoHacks1230me
            // }
             if($name || $startdate || $endingdate){


                $this->compANDcatModel->editCompName($name, $compID);
                         
                if($startdate <= $endingdate){                //PAG MAYONG LAMAN DAI MAG EDIT
                    $this->compANDcatModel->editStartDate($startdate, $compID);
                    $this->compANDcatModel->editEndDate($endingdate, $compID);
                    $this->session->set_flashdata('edit', 'Edit Successful!');
                    redirect('Competitions/index');
                }
                else{
                    $this->session->set_flashdata('wrongdate', 'Ending date must be greater than starting date!');
                    redirect('Competitions/index');   
                }

                //NoHacks1230me
            }
            else{
                $this->session->set_flashdata('Fail', 'Unable to process edit!');
                redirect('Competitions/index');
            }
            //NO ELSE NA HIKHOK

            

    }

    public function deleteComp($aw){
            $this->load->model('compANDcatModel');
            $legit = str_replace("%20"," ",$aw);
            $this->compANDcatModel->deleteComp($legit);

            
            $ID = $this->session->userdata('id');
            $username = $this->session->userdata('user');
            $status = $this->session->userdata('status');
            $data['sample'] = $this->compANDcatModel->displayComp($ID, $status);

            /*
            if($status=='director'){
                $this->load->view('templates/headerREAL');
                $this->load->view('pages/CompetitionDirector', $data);
                $this->load->view('templates/footer');
            }
            */
            redirect('Competitions/index');


    }

    public function createComp(){                

            $this->session->set_userdata('header', 'competitions');
            $this->session->set_userdata('sublevel', 'AllCompetitions');

            $this->load->view('templates/headerREAL');
            $this->load->view('pages/CreateCompetition');
            $this->load->view('templates/footer');

            $this->session->unset_userdata('header');
            $this->session->unset_userdata('sublevel');
    }

    public function setNo(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('categorynumber', 'Category Number', 'required|alpha');  
        
        $this->session->set_userdata('header', 'competitions');
        $this->session->set_userdata('sublevel', 'AllCompetitions');
        $this->load->view('templates/headerREAL');
        $this->load->view('pages/setNo');
        $this->load->view('templates/footer');
        $this->session->unset_userdata('header');
        $this->session->unset_userdata('sublevel');
    }
    


    //atendance loading the view
    public function chooseAttendance(){
            $status = $this->session->userdata('status');
            $this->session->set_userdata('header', 'competitions');
            $this->session->set_userdata('sublevel', 'CheckAttendance');
            if($status=='director'){
                $this->load->view('templates/headerREAL');
                $this->load->view( 'pages/ChooseAttendance', array() );
                $this->load->view('templates/footer');
                $this->session->unset_userdata('header');
                $this->session->unset_userdata('sublevel');
            }
            elseif($status=='Secretariat Committee'){
                $this->load->view('templates/headerSecretariat');
                $this->load->view( 'pages/ChooseAttendance', array() );
                $this->load->view('templates/footer');
                $this->session->unset_userdata('header');
                $this->session->unset_userdata('sublevel');
            }
    }

    //getting the ajax
    function get_competitions(){

        $id = $this->session->userdata('id');

        $this->load->library('Datatables');

        $this->datatables->select('competition_id, competition_name, start_date, end_date')->from('competition')->where('director_id', $id);
        $this->datatables->add_column('status', '<a class="btn btn-primary" href="CheckAttendance/$1">Check Attendance</a>', 'competition_id');

        echo $this->datatables->generate();
    
    }

    public function processNo(){

            $this->load->library('form_validation');
            $this->form_validation->set_rules('categorynumber', 'Category No', 'required'); 

            if($this->form_validation->run() ){
                $catno = $this->input->post('categorynumber');
                
                $cat['cat_no'] = $catno;
                $this->session->set_userdata($cat);
                //echo $cat['cat_no'];
                redirect('competitions/createCategory');
            }
            else{
                $this->session->set_flashdata('error','Fill all necessary information!');
                $this->load->view('templates/headerREAL');
                $this->load->view('pages/SetNo');
                $this->load->view('templates/footer');
            }
    }

    public function process(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('competitionname', 'Competition Name', 'required|alpha'); 
        $this->form_validation->set_rules('startdate', 'Starting Date', 'required');
        $this->form_validation->set_rules('endingdate', 'Ending Date', 'required');
        $this->form_validation->set_rules('siteno','PC^2 Account Number', 'required');
        //$this->form_validation->set_rules('cat', 'Number of Categories', 'required');
        //$this->form_validation->set_error_delimiters('<div class "text-danger">', '</div>');

        if($this->form_validation->run() == TRUE ){
            
            $compname = $this->input->post('competitionname');
            $sdate = $this->input->post('startdate');
            $edate = $this->input->post('endingdate');
            $sitenum= $this->input->post('siteno');
            //$no = $this->input->post('cat');
            //$no['number']=$this->input->post('cat');
            //THIS WAS FOR INSERTION PURPOSES BUT DISREGARDED FOR NEW WAY OF MAKING CATS.

            $comp=array(
                'competition_name'=>$this->input->post('competitionname'),
                'start_date'=>$this->input->post('startdate'),
                'end_date'=>$this->input->post('endingdate'),
                'site_no' =>$this->input->post('siteno'),
                'director_id'=>($this->session->userdata('id')),
                // 'code'=> $compcode//code
              );
         
            //check so that we can see if it saved permanently
            $this->session->set_userdata($comp);
             
            
            //$this->session->set_flashdata('cat_no', $no);


            // $this->load->model('compANDcatModel');
            // $this->compANDcatModel->insertComp($comp); //ininsert si competition digdi

            //UPDATE AS OF JULY 25, NO AUTOMATIC COMPETITION SO THAT DIRECTOR CAN CHOOSE HOW MANY, AND CAN NAME THEM WHILE CREATING 
            //CATEGORIE/S AND YES. HIKHOK

            // $aw = $this->compANDcatModel->getCompID($compname); //kinua si ID kang competition
            // for($i=1; $i<=$no; $i++){
            //     $name = "Category " . "$i";
            //     $cat = array('competition_id' => $aw,
            //                  'category_name' => $name);
            //     $this->compANDcatModel->insertCat($cat);     //ininsert naman si category depende sa kung pira hinahagad sa input
            // }



            //MAGIBONG CODE PARA MAG AUTOMATIC GIBONG FIVE SLOT PER CATEGORY

            /*
                $aw2 = $this->compANDcatModel->getCatID($aw); //kinua si ID kang category


                
                foreach($aw2->result_array() AS $sample){                           //KADA ROW NA CATEGORY GIGIBUHAN NING
                    for($i=0; $i<5; $i++){                                          //5 SLOTS NA MAY CODE
                        
                        $slot = array('category_id' => $sample['category_id'],      //SAKA IINSERT SA DATABASE
                             'status' => 'empty');
                        $this->compANDcatModel->insertSlot($slot);
                    
                    }
                }


            // */
            if($sdate<=$edate)
                redirect('competitions/setNo');
            else
                header("Refresh:0");
            
        }
    
            
            $this->load->view('templates/headerREAL');
            $this->load->view('pages/CreateCompetition');
            $this->load->view('templates/footer');
            
            //$id = $this->Connect_Db->getDirectorID($user,$pass);
        
    }
}

?>