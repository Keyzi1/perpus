<?php

class Login extends CI_Controller
{
   public function __construct()
   {
      parent::__construct();
      $this->load->model('m_login');
      if ($this->m_login->accountCheck() == true) {
         redirect('login');
      }
      if ($this->session->userdata('logged_in') == true) {
         redirect('welcome');
      }
   }

   public function index()
   {
      $this->load->view('v_login');
   }

   public function logout()
   {
      $this->session->sess_destroy();
      redirect('login');
   }

   public function dologin()
   {
      if ($this->input->post('login')) {
         $this->form_validation->set_rules('username', 'Username', 'trim|required');
         $this->form_validation->set_rules('password', 'Password', 'trim|required');

         if ($this->form_validation->run() == true) {
            if ($this->m_login->userCheck() == true) {
               $src = $this->input->get('src');
               if (!empty($src)) {
                  redirect($src);
               } else {
                  redirect('dashboard');
               }
            } else {
               $this->session->set_flashdata('announce', 'Invalid username or password');
               redirect('login');
            }
         } else {
            $this->session->set_flashdata('announce', validation_errors());
            redirect('login');
         }
      }
   }
}
