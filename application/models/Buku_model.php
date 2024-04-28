<?php
class Buku_model extends CI_Model{
    public function insert()
    {
        $data = array(
            'Judul' => $this->input->post('judul'),
            'Penulis' => $this->input->post('penulis'),
            'Penerbit' => $this->input->post('penerbit'),
            'TahunTerbit' => $this->input->post('tahun_terbit'),
            'Stok' => $this->input->post('stok')
        );

        $this->db->insert('buku', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function update($id)
    {
        $data = array(
            'Judul' => $this->input->post('judul'),
            'Penulis' => $this->input->post('penulis'),
            'Penerbit' => $this->input->post('penerbit'),
            'TahunTerbit' => $this->input->post('tahun_terbit'),
            'Stok' => $this->input->post('stok')
        );

        $this->db->where('BukuId', $id)->update('buku', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getCount()
    {
        return $this->db->count_all('buku');
    }

    public function getList()
    {
        return $query = $this->db->order_by('BukuId', 'ASC')->get('buku')->result();
    }


    public function getDetail($id)
    {
        return $this->db->where('BukuId', $id)->get('buku')->row();
    }

    public function delete($id)
    {
        $this->db->where('BukuId', $id)->delete('buku');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function checkAvailability($id)
    {
        $query = $this->db->where('BukuId', $id)->get('buku');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
?>