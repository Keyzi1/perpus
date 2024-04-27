<?php

class m_login extends CI_Model
{

    public function accountCheck()
    {
        $qury = $this->db->count_all('user');
        if ($qury == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function userCheck()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $kueri = $this->db->where('Username', $username)->where('Password',  md5($password))->get('user');
        if ($kueri->num_rows() > 0) {
            $data = array(
                'username' => $kueri->row()->Username,
                'logged_in' => true,
                'role' => $kueri->row()->Role,
                'userid' => $kueri->row()->UserId
            );

            $this->session->set_userdata($data);
            return true;
        } else {
            return false;
        }
    }
}
