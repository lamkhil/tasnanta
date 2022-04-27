<?php

class M_Dinas extends CI_model
{
    public function getDataDinas()
    {
        return $this->db->get_where('tb_user', ['email' =>
        $this->session->userdata('email')])->row_array();
    }

    public function getDataUser()
    {
        return $this->db->get('tb_user')->result_array();
    }

    public function getUserById($id_user)
    {
        return $this->db->get_where('tb_user', ['id_user' => $id_user])->row_array();
    }

    public function getLevel()
    {
        return $this->db->get('tb_level')->result_array();
    }

    public function getStatus()
    {
        return $this->db->get('tb_status')->result_array();
    }

    public function tambah_user()
    {
        $data = array(
            'email'     => htmlspecialchars($this->input->post('email', TRUE)),
            'username'  => htmlspecialchars($this->input->post('username', TRUE)),
            'telp'      => $this->input->post('telp', TRUE),
            'password'  => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'id_level'  => $this->input->post('id_level', TRUE),
            'foto'      => 'default.png',
        );

        $this->db->insert('tb_user', $data);
    }

    public function edit_user($id_user)
    {
        $email     = $this->input->post('email', TRUE);
        $username  = $this->input->post('username', TRUE);
        $telp      = $this->input->post('telp', TRUE);
        $id_level  = $this->input->post('id_level', TRUE);

        $data = [
            'email'     => $email,
            'username'  => $username,
            'telp'      => $telp,
            'id_level'  => $id_level,
        ];

        $this->db->set('email', $email);
        $this->db->set('username', $username);
        $this->db->set('telp', $telp);
        $this->db->set('id_level', $id_level);
        $this->db->where('id_user', $id_user);
        $this->db->update('tb_user', $data);
    }

    public function hapus_user($id_user)
    {
        $this->db->where('id_user', $id_user);
        $this->db->delete('tb_user');
    }

    public function edit_status($id_pariwisata)
    {
        $id_status  = $this->input->post('id_status', TRUE);

        $data = array(
            'id_status'  => $id_status,
        );

        $this->db->set('id_status', $id_status);
        $this->db->where('id_pariwisata', $id_pariwisata);
        $this->db->update('tb_pariwisata', $data);
    }
}
