<?php

class Feedbacks extends CI_Controller {
 
 public function __construct()
 {
  parent::__construct();
  $this->load->model('csv_import_model');
  $this->load->library('csvimport');

 }
  


  function viewCompFeedback()
    {
       if($this->session->userdata('logged_in')==true){
            $this->session->set_userdata('header', 'competitions');
            $this->session->set_userdata('sublevel', 'Feedbacks');

            $this->load->model('compANDcatModel');
            $ID = $this->session->userdata('id');
            $username = $this->session->userdata('user');
            $status = $this->session->userdata('status');
            $data['sample'] = $this->compANDcatModel->displayDoneComp($ID, $status);

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
            $rowsCount = $this->compANDcatModel->getDoneComps($conditions);
            
            // Pagination config
            $config['base_url']    = base_url().'csv_import/viewCompFeedback/';
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
            $data['sample'] = $this->compANDcatModel->getDoneComps($conditions);
            $data['title'] = '';
          
            if($status=='director'   || $status=='Technical Committee'){
                $this->load->view('templates/headerREAL');
                $this->load->view('pages/competitionFeedback', $data);
                $this->load->view('templates/footer');
            }
            else if($status=='Secretariat Committee'){
                $this->load->view('templates/headerSecretariat');
                $this->load->view('pages/competitionFeedback', $data);
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
   function index($compID=NULL){

      $this->session->set_userdata('header', 'competitions');
      $this->session->set_userdata('sublevel', 'Feedbacks');

      if($this->session->userdata('status')=='director'  ){

            $this->load->model('compANDcatModel');
            $data['compName'] = $this->compANDcatModel->getCompNameByCompID($compID);
            $data['results'] = $this->compANDcatModel->getFeedbackFromCompetition($compID);
          
            for($i=1; $i<8; $i++){
              $func = 'getResponse'.$i.'FromCompetition';
              $data['resultFrom'.$i] = $this->compANDcatModel->$func($compID);
            }

            $data['MostLiked'] = $this->compANDcatModel->getMostLikedComments($compID);
            $data['Expectations'] = $this->compANDcatModel->getExpectationsComments($compID);
            $data['Suggestions'] = $this->compANDcatModel->getSuggestionsComments($compID);
            $data['Overall'] = $this->compANDcatModel->getAverage($compID);
            // print_r($data['resultFrom1']);
            // die();

            $this->load->view('templates/headerREAL');
            $this->load->view('pages/feedbackDirector', $data);
            $this->load->view('templates/footer');
      }
      else if($this->session->userdata('status')=='Secretariat Committee'){

        $this->load->model('compANDcatModel');
        $data['compName'] = $this->compANDcatModel->getCompNameByCompID($compID);
        $data['results'] = $this->compANDcatModel->getFeedbackFromCompetition($compID);
      
        for($i=1; $i<8; $i++){
          $func = 'getResponse'.$i.'FromCompetition';
          $data['resultFrom'.$i] = $this->compANDcatModel->$func($compID);
        }

        $data['MostLiked'] = $this->compANDcatModel->getMostLikedComments($compID);
        $data['Expectations'] = $this->compANDcatModel->getExpectationsComments($compID);
        $data['Suggestions'] = $this->compANDcatModel->getSuggestionsComments($compID);
        $data['Overall'] = $this->compANDcatModel->getAverage($compID);
        // print_r($data['resultFrom1']);
        // die();

        $this->load->view('templates/headerSecretariat');
        $this->load->view('pages/feedbackDirector', $data);
        $this->load->view('templates/footer');
  }
      else{
            $this->load->view('templates/headerSchool');
            $this->load->view('pages/feedbackSchool');
            $this->load->view('templates/footer');
      }

      $this->session->unset_userdata('header');
      $this->session->unset_userdata('sublevel');

   }

    function answer($code){

      // if($this->session->userdata('answer'.$compID)=='answering'){
      //   // echo $this->session->userdata('__ci_last_regenerate') . ' is answering';
      //   // die();
        
      // }

      //$this->session->set_userdata('answer'.$compID, 'answering');
      // echo $this->session->userdata('__ci_last_regenerate');

      // die();

      $this->load->model('feedback_model');
      if($this->feedback_model->checkIfCodeIsUSed($code)==false){

      $data['compID']=$this->feedback_model->getCompIDofCode($code);

      $this->load->model('compANDcatModel');
      $data['compname']=$this->compANDcatModel->getCompNameByCompID($data['compID']);
      $data['code']=$code;

      $this->load->view('templates/headerPlain');
      $this->load->view('pages/feedbackSchool', $data);

      }else{
        redirect("Welcome/ThankYou");
      }

   }

    function load_data($compID){
      $result = $this->csv_import_model->select($compID);
      $output = '
       <h3 align="center">Feedback of competition</h3>

            <div class="table-responsive">
            
             <table class="table table-bordered table-striped" style="font-size: 8px">
              <tr>
               <th>Timestamp</th>
               <th>Email Address</th>
               <th>Event Information Dissemenation</th>
               <th>Registration Process</th>
               <th>Programming Competition Problems</th>
               <th>Time allocated for problems to be solved</th>
               <th>Event Facilitators</th>
               <th>Date and Time of the Competition</th>
               <th>Venue and Facilities</th>
               <th>Competition Rating</th>
               <th>Comments[Liked/Disliked]</th>
               <th>Future Expectations</th>
               <th>Suggestions</th>
           
              </tr>
      ';
      $count = 0;
      if($result->num_rows() > 0)
      {
       foreach($result->result() as $row)
       {
        $count = $count + 1;
        $output .= '
        <tr>
         <td>'.$row->timestamp.'</td>
         <td>'.$row->username.'</td>
         <td>'.$row->response1.'</td>
         <td>'.$row->response2.'</td>
         <td>'.$row->response3.'</td>
         <td>'.$row->response4.'</td>
         <td>'.$row->response5.'</td>
         <td>'.$row->response6.'</td>
         <td>'.$row->response7.'</td>
         <td>'.$row->rating.'</td>
         <td>'.$row->comments1.'</td>
         <td>'.$row->comments2.'</td>
         <td>'.$row->comments3.'</td>
        </tr>
        ';
       }
      }
      else
      {
       $output .= '
       <tr>
           <td colspan="5" align="center">Data not Available</td>
          </tr>
       ';
      }
      $output .= '</table></div>';
      echo $output;

 }

  function import($compID=NULL){


  $this->load->model('compANDcatModel');
                          
  $file_data = $this->csvimport->get_array($_FILES["csv_file"]["tmp_name"]);
  
  foreach($file_data as $row)
  {

   $data[] = array(
    	  'timestamp' => $row["Timestamp"],
          'username'  => $row["Username"],
          'response1'   => $row["How satisfied  were you with aspects of the programming competition? [Event Information Dissemenation]"],
          'response2'   => $row["How satisfied  were you with aspects of the programming competition? [Registration Process]"],
          'response3'   => $row["How satisfied  were you with aspects of the programming competition? [Programming Competition Problems]"],
          'response4'   => $row["How satisfied  were you with aspects of the programming competition? [Time allocated for problems to be solved]"],
          'response5'   => $row["How satisfied  were you with aspects of the programming competition? [Event Facilitators]"],
          'response6'   => $row["How satisfied  were you with aspects of the programming competition? [Date and Time of the Competition]"],
          'response7'   => $row["How satisfied  were you with aspects of the programming competition? [Venue and Facilities]"],
          'rating'   => $row["Overall, how satisfied are you with the flow of the programming competition?"],
          'comments1'   => $row["What did you like most/least about the event?"],
          'comments2'   => $row["What is/are your expectations for the next programming competition?"],
          'comments3'   => $row["Do you have any other suggestions of further improvements for the organizers? Programming competition flow?"],
          'competition_id' => $compID
   );
  }
  $this->csv_import_model->insert($data);
 }


function submitFeedback($compID, $code){

            $this->load->model('feedback_model');

                //if code na macheck kung may answer na.
                $this->load->library('form_validation');
                $this->form_validation->set_rules('school_name', 'School Name', 'required');
                $this->form_validation->set_rules('option1', 'Event Information Dissemenation', 'required'); 
                $this->form_validation->set_rules('option2', 'Registration Process', 'required');
                $this->form_validation->set_rules('option3', 'Programming Competition Problems', 'required');
                $this->form_validation->set_rules('option4', 'Time allocated for problems to be solved', 'required');
                $this->form_validation->set_rules('option5', 'Event Facilitators', 'required'); 
                $this->form_validation->set_rules('option6', 'Date and Time of the Competition', 'required');
                $this->form_validation->set_rules('option7', 'Venue and Facilities', 'required');
                $this->form_validation->set_rules('option8', 'Satisfaction Rating', 'required');
                $this->form_validation->set_rules('likes', 'Satisfaction Rating');
                $this->form_validation->set_rules('expectations', 'Satisfaction Rating');
                $this->form_validation->set_rules('suggestions', 'Satisfaction Rating');
                $this->form_validation->set_error_delimiters('<div class "text-danger">', '</div>');
      
                if($this->form_validation->run())
                {
                    $this->load->model('compANDcatModel');
                    $user = $this->session->userdata('user');
                    $this->load->model("feedback_model");
                    $this->load->model("Connect_Db");

                   $data = array(
                     "school_name" => $this->input->post("school_name"),
                     "response1" => $this->input->post("option1"),
                     "response2" => $this->input->post("option2"),
                     "response3" => $this->input->post("option3"),
                     "response4" => $this->input->post("option4"),
                     "response5" => $this->input->post("option5"),
                     "response6" => $this->input->post("option6"),
                     "response7" => $this->input->post("option7"),
                     "rating"    => $this->input->post("option8"),
                     "comments1" => $this->input->post("likes"),
                     "comments2" => $this->input->post("expectations"),
                     "comments3" => $this->input->post("suggestions"),
                     "competition_id" => $compID                
                   

                  );
                    $this->feedback_model->insert($data, $code);

                    redirect("Welcome/ThankYou");
                }
                else{
                    $this->session->set_flashdata('error', 'Please insert necessary data!');
                    redirect('Feedbacks/answer/'.$compID);              
                }
          
}



 
  
}