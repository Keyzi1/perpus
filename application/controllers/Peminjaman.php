<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Peminjaman extends CI_Controller{
    public function __construct()
	{
		parent::__construct();
		$this->load->model('Peminjaman_model');
		if ($this->session->userdata('logged_in') == false) {
			redirect('welcome');
		}
	}
    
    public function index(){
        $data = array(
			'title' => 'Peminjaman',
			// 'kode' => $this->Peminjamanuser_model->generateID(),
			// 'petugas' => $this->Peminjamanuser_model->getPetugas(),
			'buku' => $this->Peminjaman_model->getListBuku(),
            'peminjaman' => $this->Peminjaman_model->getListPeminjaman(),
			// 'buku' => $this->Peminjamanuser_model->getBkuList(),
			// 'peminjaman' => $this->Peminjamanuser_model->getListPeminjaman(),
			'primary_view' => 'peminjaman/peminjaman_view'
		);
		$this->load->view('Peminjaman/peminjaman_view', $data);
    }

	public function searchAgtName()
	{
		$kode = $this->input->post('id');
		$anggota = $this->Peminjaman_model->cariBuku($kode);
		if ($anggota->num_rows() > 0) {
			$agt = $anggota->row_array();
			echo $agt['Judul'];
		}
	}

	public function submit()
	{
		if ($this->input->post('submit')) {
			$this->form_validation->set_rules('bukuid', 'Kode BukuId', 'trim|required');
			$this->form_validation->set_rules('userid', 'UserId', 'trim|required');
			$this->form_validation->set_rules('tanggal_pengembalian', 'TanggalPengembalian', 'trim|required');


			if ($this->form_validation->run() == true) {
				if ($this->Peminjaman_model->insert() == true) {
					$this->session->set_flashdata('announce', 'Berhasil menyimpan data');
					redirect('peminjaman');
				} else {
					$this->session->set_flashdata('announce', 'Gagal menyimpan data');
					redirect('peminjaman');
				}
			} else {
				$this->session->set_flashdata('announce', validation_errors());
				redirect('peminjaman');
			}
		}
	}

	public function add(){
		$data = array(
			'title' => 'peminjaman',
			'buku' => $this->Peminjaman_model->getListBuku(),
			'primary_view' => 'peminjaman/add_peminjaman_view'
		);
		$this->load->view('Peminjaman/add_peminjaman_view', $data);
	}

	public function kembalikan(){
		$id = $this->input->get('rcgn');
		if($this->Peminjaman_model->kembali($id) == true){
			$this->session->set_flashdata('announce', 'Berhasil mengembalikan data');
			redirect('peminjaman');
		}else{
			$this->session->set_flashdata('announce', 'Berhasil Mengembalikan data');
			redirect('peminjaman');
		}
	}
}
?>