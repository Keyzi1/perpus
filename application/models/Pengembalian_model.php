<?php
class Pengembalian_model extends CI_Model{
    public function getListPeminjaman()
    {
        $array = array('UserId' => $this->session->userdata('userid'), 'StatusPeminjaman' => 'dikembalikan');
        $query = $this->db->where($array)->get('peminjaman')->result();
		return $query;
    }

    public function invoice($id){
        return $this->db->where('PeminjamanId', $id)->get('peminjaman')->row();
    }

    public function checkAvailability($id){
		$query = $this->db->where('PeminjamanId', $id)->get('peminjaman');
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
}
?>