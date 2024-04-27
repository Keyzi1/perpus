<?php
class Anggota_model extends CI_Model
{
    public function insert()
    {
        $data = array(
            'Username' => $this->input->post('username'),
            'Password' => md5($this->input->post('password')),
            'Email' => $this->input->post('email'),
            'NamaLengkap' => $this->input->post('nama_lengkap'),
            'Alamat' => $this->input->post('alamat'),
            'Role' => $this->input->post('role')
        );

        $this->db->insert('user', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function update($id)
    {
        $data = array(
            'Username' => $this->input->post('username'),
            'Password' => $this->input->post('password'),
            'Email' => $this->input->post('email'),
            'NamaLengkap' => $this->input->post('nama_lengkap'),
            'Alamat' => $this->input->post('alamat'),
            'Role' => $this->input->post('role')
        );

        $this->db->where('UserId', $id)->update('user', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function inserts($id, $psw)
    {
        if ($psw == true) {
            $dat = array(
                'Username'    => $this->input->post('username'),
                'Password'    => md5($this->input->post('password')),
                'Email' => $this->input->post('email'),
                'NamaLengkap' => $this->input->post('nama_lengkap'),
                'Alamat' => $this->input->post('alamat'),
                'Role' => $this->input->post('role')
            );
        } else {
            $dat = array(
                'Username'    => $this->input->post('username'),
                'Email' => $this->input->post('email'),
                'NamaLengkap' => $this->input->post('nama_lengkap'),
                'Alamat' => $this->input->post('alamat'),
                'Role' => $this->input->post('role')
            );
        }
        $this->db->where('UserId', $id)->update('user', $dat);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function generateID()
    {
        $query = $this->db->order_by('UserId', 'DESC')->limit(1)->get('user')->row('UserId');
        $lastNo = substr($query, 3);
        $next = $lastNo + 1;
        $kd = 'AGT';
        return $kd . sprintf('%03s', $next);
    }

    public function getList()
    {
        return $query = $this->db->order_by('UserId', 'ASC')->get('user')->result();
    }

    public function getCount()
    {
        return $this->db->count_all('user');
    }

    public function getDetail($id)
    {
        return $this->db->where('UserId', $id)->get('user')->row();
    }

    public function usernameChecks($id)
    {
        $user = $this->db->where('UserId', $id)->get('user')->row('Username');
        if ($this->input->post('username') == $user) {
            return true;
        } else {
            $get = $this->db->where('Username', $this->input->post('username'))->get('user');
            if ($get->num_rows() > 0) {
                return false;
            } else {
                return true;
            }
        }
    }

    public function checkAvailability($id)
    {
        $query = $this->db->where('UserId', $id)->get('user');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $this->db->where('UserId', $id)->delete('user');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
