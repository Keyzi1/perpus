<?php

class Anggota extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->load->model('Anggota_model');
		if ($this->session->userdata('logged_in') == false) {
			redirect('welcome');
		}
	}

	public function index()
	{
		$data['title'] = 'Anggota';
		$data['list'] = $this->Anggota_model->getList();
		$data['primary_view'] = 'Anggota/anggota_view';
		$data['total'] = $this->Anggota_model->getCount();
		$this->load->view('Anggota/anggota_view', $data);
	}

	public function detail()
	{
		$data['title'] = 'Detail Anggota';

		//GET : Detail data
		$id = $this->input->get('idtf');
		$data['row'] = $this->Anggota_model->getDetail($id);
		//CHECK : Data Availability
		if ($this->Anggota_model->checkAvailability($id) == true) {
			$data['primary_view'] = 'Anggota/detail_anggota_view';
		} else {
			$data['primary_view'] = '404_view';
		}
		$this->load->view('Anggota/anggota_view', $data);
	}

	public function add()
	{
		$data['title'] = 'Tambah Anggota';
		$data['primary_view'] = 'Anggota/add_anggota_view';
		$this->load->view('Anggota/add_anggota_view', $data);
	}

	public function edit(){
		if($this->session->userdata('role') == 'administrator') {
			$id = $this->input->get('tken');
			//CHECK : Data Availability
			if($this->Anggota_model->checkAvailability($id) == true){
				$data['primary_view'] = 'Anggota/edit_anggota_view';
			}else{
				$data['primary_view'] = '404_view';
			}
			$data['title'] = 'Edit Petugas';
			$data['detail'] = $this->Anggota_model->getDetail($id);
			$this->load->view('Anggota/edit_anggota_view', $data);
		}else{
			$this->load->view('full_401_view');
		}
	}

	public function submit()
	{
		if ($this->input->post('submit')) {
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('nama_lengkap', 'NamaLengkap', 'trim|required');
			$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
			$this->form_validation->set_rules('role', 'Role', 'trim|required');

			if ($this->form_validation->run() == true) {
				if ($this->Anggota_model->insert() == true) {
					$this->session->set_flashdata('announce', 'Berhasil menyimpan data');
					redirect('Anggota');
				} else {
					$this->session->set_flashdata('announce', 'Gagal menyimpan data');
					redirect('Anggota');
				}
			} else {
				$this->session->set_flashdata('announce', validation_errors());
				redirect('Anggota');
			}
		}
	}


	public function submits(){
		if($this->input->post('submit')){
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('nama_lengkap', 'NamaLengkap', 'trim|required');
			$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
			$this->form_validation->set_rules('role', 'Role', 'trim|required');

			if($this->form_validation->run() == true) {
				$id = $this->input->post('ids');
				$psw = false;
				if($this->input->post('password') != ''){
					$psw = true;
					$password = $this->input->post('password');
					$cpassword = $this->input->post('cpassword');

					if($password == $cpassword){
						if($this->Anggota_model->usernameChecks($id) == true){
							if($this->Anggota_model->inserts($id, $psw) == true){
								$this->session->set_flashdata('announce', 'Berhasil menyimpan data');
								redirect('Anggota/edit?tken='.$id);
							}else{
								$this->session->set_flashdata('announce', 'Gagal menyimpan data');
								redirect('Anggota/edit?tken='.$id);
							}
						}else{
							$this->session->set_flashdata('announce', 'Username tidak tersedia, silahkan pilih username lain');
							redirect('Anggota/edit?tken='.$id);
						}
					}else{
						$this->session->set_flashdata('announce', 'Password tidak sesuai');
						redirect('Anggota/edit?tken='.$id);
					}
				}else{
					if($this->Anggota_model->usernameChecks($id) == true){
						if($this->Anggota_model->inserts($id, $psw) == true){
							$this->session->set_flashdata('announce', 'Berhasil menyimpan data');
							redirect('Anggota/edit?tken='.$id);
						}else{
							$this->session->set_flashdata('announce', 'Gagal menyimpan data');
							redirect('Anggota/edit?tken='.$id);
						}
					}else{
						$this->session->set_flashdata('announce', 'Username tidak tersedia, silahkan pilih username lain');
						redirect('Anggota/edit?tken='.$id);
					}
				}
			} else {
				$this->session->set_flashdata('announce', validation_errors());
				redirect('petugas/add');
			}
		}
	}

	public function delete()
	{
		$id = $this->input->get('rcgn');
		if ($this->Anggota_model->delete($id) == true) {
			$this->session->set_flashdata('announce', 'Berhasil menghapus data');
			redirect('anggota');
		} else {
			$this->session->set_flashdata('announce', 'Gagal menghapus data');
			redirect('anggota');
		}
	}
}
