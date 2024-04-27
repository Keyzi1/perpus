<?php
class Pengembalian extends CI_Controller{
    public function __construct()
	{
		parent::__construct();
		$this->load->model('Pengembalian_model');
		if ($this->session->userdata('logged_in') == false) {
			redirect('welcome');
		}
	}

    public function index(){
        $data = array(
            'title' => 'Pengembalian',
            'pengembalian' => $this->Pengembalian_model->getListPeminjaman(),
            'primary_view' => 'Pengembalian/pengembalian_view'
        );
        $this->load->view('Pengembalian/pengembalian_view', $data);
    }

    public function invoice(){
        $data['title'] = 'Invoice Peminjaman';

		//GET : Detail data
		$id = $this->input->get('idtf');
		$data['row'] = $this->Pengembalian_model->invoice($id);
		//CHECK : Data Availability
		if($this->Pengembalian_model->checkAvailability($id) == true){
			$data['primary_view'] = 'Pengembalian/invoice_pengembalian';
		}else{
			$data['primary_view'] = '404_view';
		}
		$this->load->view('Pengembalian/invoice_pengembalian', $data);
    }
}
?>