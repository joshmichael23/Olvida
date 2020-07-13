<?php

class Upload extends CI_Controller {




                function __construct() {
                // then execute the parent constructor anyway
                parent::__construct();
                // $this->load->library('session');

                        if(!$this->session->userdata('logged_in'))
                                redirect('Login/logout', true);
            }

        public function index()
        {
                $this->load->view('pages/upload_form', array('error' => ' ' ));
        }

        public function do_upload($ID)
        {
                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 100;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = array('error' => $this->upload->display_errors());

                        // $this->load->view('pages/upload_form', $error);
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
                        
                        $insert = array(
                                'participant_id'=>$ID,
                                'file_name' => $data['upload_data']['file_name'],
                                'upload_path' => $data['upload_data']['full_path']
                        );

                        $this->db->insert('photos', $insert);
                        // $this->load->view('pages/upload_success', $data);
                }
        }
}
?>