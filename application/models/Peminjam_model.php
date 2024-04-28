<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjam_model extends CI_Model {
    public function getListBuku(){
        $query = $this->db->get('buku')->result();
		return $query;
    }

    public function getListUser(){
        $query = $this->db->get('user')->result();
		return $query;
    }

    public function cariBuku($kode){
		$hm = $this->db->where('BukuId', $kode)->get('buku');
		return $hm;
	}

    public function cariUser($kode1){
		$hm = $this->db->where('UserId', $kode1)->get('user');
		return $hm;
	}

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getAllPeminjamInfo() {
        // Mengambil informasi peminjaman beserta Username dan Judul
        $this->db->select('peminjaman.*, user.Username, buku.Judul');
        $this->db->from('peminjaman');
        $this->db->join('user', 'user.UserId = peminjaman.UserId');
        $this->db->join('buku', 'buku.BukuId = peminjaman.BukuId');
        $query = $this->db->get();
        return $query->result();
    }

    public function insert()
	{
		$data = array(
			'UserId' => $this->input->post('userid'),
			'BukuId' => $this->input->post('bukuid'),
			'TanggalPeminjaman' => date('Y/m/d'),
			'TanggalPengembalian' => date('Y/m/d', strtotime('+4 days')),
			'StatusPeminjaman' => "dipinjam" //default status
		);

		$this->db->insert('peminjaman', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
}
