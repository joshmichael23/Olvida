<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class All_teams extends CI_Controller {

		function __construct() {
	        // then execute the parent constructor anyway
	        parent::__construct();
	        // $this->load->library('session');

			if(!$this->session->userdata('logged_in'))
				redirect('Login/logout', true);
	    }

		function index(){		    
		  $this->session->set_userdata('header', 'Teams');

			$status = $this->session->userdata('status');
			if($status=='director')
				$this->load->view('templates/headerREAL');
			elseif($status=='Secretariat Committee')
				$this->load->view('templates/headerSecretariat');
			$this->load->view( 'pages/all_teams', array() );
			$this->load->view('templates/footer');

			          $this->session->unset_userdata('header');
		}
		
		function get_teams(){

		$this->load->library('Datatables');

		$this->datatables
				->select(' concat(" ", a.first_name, " ", a.last_name) AS Name, c.team_name, d.school_name, concat(" ", e.first_name, " ", e.last_name) As Coach ')
				->from('participant a')
				->join('teams_members b', 'a.participant_id = b.participant_id', 'INNER')
				->join('team c', 'c.team_id = b.team_id', 'INNER')
				->join('coach e', 'b.coach_id = e.coach_id', 'left outer')
				->join('school d', 'd.school_id = c.school_id', 'INNER');

			echo $this->datatables->generate();
		}

		function get_teams_individual(){

		$this->load->library('Datatables');

		$this->datatables
				->select(' group_concat(concat(" ", a.first_name, " ", a.last_name) AS Name), c.team_name, d.school_name, concat(" ", e.first_name, " ", e.last_name) As Coach')
				->from('participant a')
				->join('teams_members b', 'a.participant_id = b.participant_id', 'INNER')
				->join('team c', 'c.team_id = b.team_id', 'INNER')
				->join('coach e', 'b.coach_id = e.coach_id', 'left outer')
				->join('school d', 'd.school_id = c.school_id', 'INNER')
				->group_by('c.team_name');
				// select concat(" ", a.first_name, " ", a.last_name) AS Name, c.team_name, d.school_name, concat(" ", e.first_name, " ", e.last_name) As Coach
				// from participant a
				// inner join teams_members b on a.participant_id = b.participant_id
				// inner join team c on c.team_id = b.team_id
				// left outer join coach e on b.coach_id = e.coach_id
				// inner join school d on d.school_id = c.school_id
				// group by c.team_name
				// having count(Name) = 1


			echo $this->datatables->generate();
		}

	}
?>