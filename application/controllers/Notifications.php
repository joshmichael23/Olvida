<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class Notifications extends CI_Controller {


		function __construct() {
	        // then execute the parent constructor anyway
	        parent::__construct();
	        // $this->load->library('session');

			if(!$this->session->userdata('logged_in'))
				redirect('Login/logout', true);
	    }
    
		function view($userID, $status){

			$this->load->model('notification');

			if($status=='school'){
				$this->notification->clearNotificationSchool($userID);
				$this->load->view('templates/headerSchool');
			}
			elseif($status=='director'){			
				$this->notification->clearNotificationDirector($userID);
				$this->load->view('templates/headerREAL');
			}

			$this->load->view( 'pages/all_notifications', array() );
			$this->load->view('templates/footer');
		}

		function dismiss($notificationID){
			$id = $this->session->userdata('id');
			$user = $this->session->userdata('user');
			$status = $this->session->userdata('status');

			$this->load->model('Connect_Db');

			if($status=='school'){
				$this->Connect_Db->DismissNotificationSchool($notificationID, $id);
				redirect('Notifications/view/'.$id.'/'.$status);
			}
			if($status=='director'){
				$this->Connect_Db->DismissNotificationDirector($notificationID, $id);
				redirect('Notifications/view/'.$id.'/'.$status);
			}

		}
		
		function get_notifications(){

		$this->load->library('Datatables');

			// SELECT notifications.subject, notifications.text FROM `notifications` inner join user_notifications on notifications.notifications_id = user_notifications.notifications_id where user_notifications.target_id = 1 ORDER BY notifications.notifications_id DESC

			$id = $this->session->userdata('id');
			$user = $this->session->userdata('user');
			$status = $this->session->userdata('status');
			$this->load->model('notification');
			
			if($status=='school'){

				$this->datatables->select('a.subject, a.text, a.date, a.notifications_id, b.status')->from('notifications a')->join('school_notifications b', 'a.notifications_id = b.notifications_id', 'INNER')->join('school c', 'c.school_id = b.target_id', 'INNER')->where('b.target_id', $id);

		        $this->datatables->add_column('dismiss', '<a class="btn btn-danger" href="' . base_url() . 'Notifications/Dismiss/' . '$1' . '">Dismiss</a>', 'notifications_id');
					
				echo $this->datatables->generate();

				$this->notification->clearNotificationSchool($id);

			}
			elseif($status=='director'){
				$this->datatables->select('a.subject, a.text, a.date, a.notifications_id, b.status')->from('notifications a')->join('director_notifications b', 'a.notifications_id = b.notifications_id', 'INNER')->join('director c', 'c.director_id = b.target_id', 'INNER')->where('b.target_id', $id);


		        $this->datatables->add_column('dismiss', '<a class="btn btn-danger" href="' . base_url() . 'Notifications/Dismiss/' . '$1' . '">Dismiss</a>', 'notifications_id');
				echo $this->datatables->generate();		

						
			}


		
		}


	}
?>