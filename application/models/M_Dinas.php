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
        $this->db->where('id_pariwisata', $id_pariwisata);
        $this->db->update('tb_pariwisata', $data);
    }

    public function validate_status($id_pariwisata)
    {
        $id_status  = 1;

        $data = array(
            'id_status'  => $id_status,
        );

        $this->db->set('id_status', $id_status);
        $this->db->where('id_pariwisata', $id_pariwisata);
        $this->db->update('tb_pariwisata', $data);
    }

    public function ubahDataProfile()
    {
        $email     = $this->input->post('email', TRUE);
        $username  = $this->input->post('username', TRUE);
        $telp      = $this->input->post('telp', TRUE);

        $data = array(
            'email'     => $email,
            'username'  => $username,
            'telp'      => $telp
        );

        //Jika Ada Foto yang diupload
        $upload_foto = $_FILES['foto']['name'];
        $file_name = str_replace('.','',$email);
        if ($upload_foto) {
            $config['upload_path']      = './assets/img/profile/';
            $config['allowed_types']    = 'gif|jpg|png|jpeg';
            $config['max_size']         = 2048;
            $config['file_name']        = $file_name;
            $config['overwrite']        = true;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto')) {
                $foto_baru = $this->upload->data('file_name');
                $data['foto'] = $foto_baru;
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                redirect('dinas/profile');
            }
        }

        $this->db->where('email', $email);
        $this->db->update('tb_user', $data);
    }
}
