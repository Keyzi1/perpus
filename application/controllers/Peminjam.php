<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjam extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Peminjam_model'); // Memuat model Peminjam_model
    }

    public function index() {
        // Memanggil fungsi untuk mendapatkan daftar peminjam
        $data['peminjam'] = $this->Peminjam_model->getAllPeminjamInfo();
        $data['buku'] = $this->Peminjam_model->getListBuku(); // Mengambil daftar buku
        $data['user'] = $this->Peminjam_model->getListUser(); // Mengambil daftar user
        // Tampilkan data peminjam ke view
        $this->load->view('peminjam/peminjam_view', $data);
    }

    
    public function submit()
	{
		if ($this->input->post('submit')) {
			$this->form_validation->set_rules('bukuid', 'Kode BukuId', 'trim|required');
			$this->form_validation->set_rules('userid', 'UserId', 'trim|required');


			if ($this->form_validation->run() == true) {
				if ($this->Peminjam_model->insert() == true) {
					$bukuid = $this->input->post('bukuid');
                	$this->reduceBookStock($bukuid);

					$this->session->set_flashdata('announce', 'Berhasil menyimpan data');
					redirect('peminjam');
				} else {
					$this->session->set_flashdata('announce', 'Gagal menyimpan data');
					redirect('peminjam');
				}
			} else {
				$this->session->set_flashdata('announce', validation_errors());
				redirect('peminjam');
			}
		}
	}

	private function reduceBookStock($bukuid) {
    // Mengurangi stok buku
    $book = $this->Peminjam_model->cariBuku($bukuid)->row_array();
    $currentStock = $book['Stok'];

    if ($currentStock > 0) {
        $newStock = $currentStock - 1;
        $this->Peminjam_model->updateBookStock($bukuid, $newStock);
    }
}
    


    public function add() {
		$data = array(
			'title' => 'peminjaman',
			'buku' => $this->Peminjam_model->getListBuku(),
            'user' => $this->Peminjam_model->getListUser(),
			'primary_view' => 'peminjam/add_peminjam_view'
		);
		$this->load->view('peminjam/add_peminjam_view', $data);
    }

}
