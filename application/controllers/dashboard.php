<?php

class Dashboard Extends CI_Controller{

    public function index()
    {
        $this->load->view('v_dashboard');
    }

    public function logout()
	{
		$data = array(
			'username' => '',
			'logged_in' => false,
			'role' => ''
		);

		$this->session->sess_destroy();
		redirect('welcome');
	}
}