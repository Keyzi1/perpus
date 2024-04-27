<?php
class Buku extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Buku_model');
        // $this->load->model('Petugas_model');
        if ($this->session->userdata('logged_in') == false) {
            redirect('welcome');
        }
    }

    public function index()
    {
        $data['title'] = 'Buku';
        $data['primary_view'] = 'Buku/Buku_view';
        $data['total'] = $this->Buku_model->getCount();
        $data['list'] = $this->Buku_model->getList();
        $this->load->view('Buku/buku_view', $data);
    }

    public function add()
    {
        $data['title'] = 'Tambah Buku';
        $data['primary_view'] = 'Buku/add_buku_view';
        $this->load->view('Buku/add_buku_view', $data);
    }

    public function submit()
    {
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('judul', 'Judul', 'trim|required');
            $this->form_validation->set_rules('penulis', 'Penulis', 'trim|required');
            $this->form_validation->set_rules('penerbit', 'Penerbit', 'trim|required');
            $this->form_validation->set_rules('tahun_terbit', 'TahunTerbit', 'trim|required|numeric');

            if ($this->form_validation->run() == true) {
                if ($this->Buku_model->insert() == true) {
                    $this->session->set_flashdata('announce', 'Berhasil menyimpan data');
                    redirect('Buku');
                } else {
                    $this->session->set_flashdata('announce', 'Gagal menyimpan data');
                    redirect('Buku');
                }
            } else {
                $this->session->set_flashdata('announce', validation_errors());
                redirect('Buku');
            }
        }
    }

    public function submits()
    {
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('judul', 'Judul', 'trim|required');
            $this->form_validation->set_rules('penulis', 'Penulis', 'trim|required');
            $this->form_validation->set_rules('penerbit', 'Penerbit', 'trim|required');
            $this->form_validation->set_rules('tahun_terbit', 'TahunTerbit', 'trim|required|numeric');

            if ($this->form_validation->run() == true) {
                if ($this->Buku_model->update($this->input->post('id')) == true) {
                    $this->session->set_flashdata('announce', 'Berhasil menyimpan data');
                    redirect('Buku/edit?idtf=' . $this->input->post('id'));
                } else {
                    $this->session->set_flashdata('announce', 'Gagal menyimpan data');
                    redirect('Buku/edit?idtf=' . $this->input->post('id'));
                }
            } else {
                $this->session->set_flashdata('announce', validation_errors());
                redirect('Buku/edit?idtf=' . $this->input->post('id'));
            }
        }
    }

    public function edit()
    {
        $id = $this->input->get('idtf');
        //CHECK : Data Availability
        if ($this->Buku_model->checkAvailability($id) == true) {
            $data['primary_view'] = 'Buku/edit_buku_view';
        } else {
            $data['primary_view'] = '404_view';
        }
        $data['title'] = 'Edit Buku';
        $data['detail'] = $this->Buku_model->getDetail($id);
        $this->load->view('Buku/edit_buku_view', $data);
    }

    public function delete()
    {
        $id = $this->input->get('rcgn');
        if ($this->Buku_model->delete($id) == true) {
            $this->session->set_flashdata('announce', 'Berhasil menghapus data');
            redirect('Buku');
        } else {
            $this->session->set_flashdata('announce', 'Gagal menghapus data');
            redirect('Buku');
        }
    }
}
