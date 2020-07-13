<?php
class Pages extends CI_Controller {
  public function view($page = 'home') {
  	if (!file_exists(APPPATH . 'views/pages/' . $page . '.php'))
	show_404();

	$data['title'] = "Olvida"; //represents the variable we want to pass in the view

	//load the header, the page, and the footer
	$this->load->view('templates/header');
	$this->load->view('pages/' . $page, $data);
	$this->load->view('templates/footer');

  }
}
