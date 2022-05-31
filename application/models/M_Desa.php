<?php

class M_Desa extends CI_Model
{
    public function getDataByEmail()
    {
        $email = $this->session->userdata('email');

        $this->db->from('tb_user');
        $this->db->where('email', $email);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getWisata()
    {
        $query = $this->db->get('tb_pariwisata');
        return $query->result_array();
    }

    public function getWisataById($id_pariwisata)
    {
        return $this->db->get_where('tb_pariwisata', ['id_pariwisata' => $id_pariwisata])->row_array();
    }

    public function getUserNotif($user_id){
        return $this->db->get_where('tb_notif', ['user_id' => $user_id])->result_array();
    }
    public function getCountUserNotifUnread($user_id){
        return $this->db->get_where('tb_notif', ['user_id' => $user_id, 'is_read' => 0])->num_rows();
    }
    
    public function readAllNotif($user_id){
        $this->db->where('user_id', $user_id);
        $this->db->update('tb_notif', ['is_read'=>1]);
    }

    public function ubahDataProfile()
    {
        $email     = $this->input->post('email', TRUE);
        $username  = $this->input->post('username', TRUE);
        $telp      = $this->input->post('telp', TRUE);
        $foto      = $this->input->post('foto', TRUE);

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
                redirect('desa');
            }
        }
        $this->db->where('email', $email);
        $this->db->update('tb_user', $data);
    }

    public function getNilai()
    {
        $query = $this->db->get('tb_nilai');
        return $query->result_array();
    }
    public function getNilaiByPariwisata()
    {   
        $this->db->select('*');
        $this->db->from('tb_nilai');
        $this->db->join('tb_pariwisata', 'tb_nilai.id_pariwisata = tb_pariwisata.id_pariwisata', 'inner');
        $this->db->join('tb_kriteria', 'tb_nilai.kriteria_id = tb_kriteria.id_kriteria', 'inner');
        $this->db->join('tb_subkriteria', 'tb_nilai.id_subkriteria = tb_subkriteria.id_subkriteria', 'inner');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getPariwisataWithNilai(){
        $pariwisata = $this->getWisata();
        foreach ($pariwisata as $key => $value) {
            $this->db->select('*');
            $this->db->from('tb_kriteria');
            $this->db->join('tb_nilai', 'tb_nilai.kriteria_id = tb_kriteria.id_kriteria', 'inner');
            $this->db->join('tb_subkriteria', 'tb_nilai.id_subkriteria = tb_subkriteria.id_subkriteria', 'inner');
            $this->db->where('id_pariwisata', $value['id_pariwisata']);
            $query = $this->db->get();
            $pariwisata[$key]['nilai'] = $query->result_array();
        }
        return $pariwisata;
    }
    public function getPariwisataWithNilaiById($id_pariwisata){
        $pariwisata = $this->getWisataById($id_pariwisata);
        $this->db->select('*');
            $this->db->from('tb_kriteria');
            $this->db->join('tb_nilai', 'tb_nilai.kriteria_id = tb_kriteria.id_kriteria', 'inner');
            $this->db->join('tb_subkriteria', 'tb_nilai.id_subkriteria = tb_subkriteria.id_subkriteria', 'inner');
            $this->db->where('id_pariwisata', $id_pariwisata);
            $query = $this->db->get();
            $pariwisata['nilai'] = $query->result_array();
        return $pariwisata;
    }

    public function getNilaiById($id_nilai)
    {
        return $this->db->get_where('tb_nilai', ['id_nilai' => $id_nilai])->row_array();
    }

    public function editDataWisataWithNilai($id_pariwisata)
    {
        $nm_pariwisata = $this->input->post('nm_pariwisata', true);
        $alamat = $this->input->post('alamat', true);
        $id_user = $this->input->post('id_user', true);

        $data = array(
            'nm_pariwisata'     => $nm_pariwisata,
            'alamat'            => $alamat,
            'id_user'           => $id_user
        );

        $this->db->where('id_pariwisata', $id_pariwisata);
        $this->db->update('tb_pariwisata', $data);
        // tambah nilai
        $query = $this->db->get('tb_kriteria');
        $kriteria = $query->result_array();
        $pariwisataWithNilai = $this->getPariwisataWithNilaiById($id_pariwisata);

        foreach ($kriteria as $kr) {
            $is_exist = FALSE;
            foreach ($pariwisataWithNilai['nilai'] as $n) {
                if ($kr['nm_kriteria'] == $n['nm_kriteria']) {
                    $is_exist = TRUE;
                    $nilai = array(
                        'id_pariwisata'     => $id_pariwisata,
                        'kriteria_id'       => $kr['id_kriteria'],
                        'id_subkriteria'    => $this->input->post($kr['id_kriteria'], true)
                    );
                    $this->db->where('id_nilai', $n['id_nilai']);
                    $this->db->update('tb_nilai', $nilai);
                }
            }
            if (!$is_exist) {
                $nilai = array(
                    'id_pariwisata'     => $id_pariwisata,
                    'kriteria_id'       => $kr['id_kriteria'],
                    'id_subkriteria'    => $this->input->post($kr['id_kriteria'], true)
                );
                $this->db->insert('tb_nilai', $nilai);
            }
        }
    }

    public function tambahDataWisata()
    {
        $nm_pariwisata = $this->input->post('nm_pariwisata', true);
        $alamat = $this->input->post('alamat', true);
        $id_user = $this->input->post('id_user', true);

        $data = array(
            'nm_pariwisata'     => $nm_pariwisata,
            'alamat'            => $alamat,
            'id_user'           => $id_user
        );

        $this->db->insert('tb_pariwisata', $data);
        $id = $this->db->insert_id();
        // tambah nilai
        $query = $this->db->get('tb_kriteria');
        $kriteria = $query->result_array();

        foreach ($kriteria as $kr) {
            $nilai = array(
                'id_pariwisata'     => $id,
                'kriteria_id'       => $kr['id_kriteria'],
                'id_subkriteria'    => $this->input->post($kr['id_kriteria'], true)
            );
            $this->db->insert('tb_nilai', $nilai);
        }
    }

    public function editDataWisata($id_pariwisata)
    {
        $nm_pariwisata = $this->input->post('nm_pariwisata', true);
        $alamat = $this->input->post('alamat', true);

        $data = array(
            'nm_pariwisata'     => $nm_pariwisata,
            'alamat'            => $alamat,
        );

        $this->db->set('nm_pariwisata', $nm_pariwisata);
        $this->db->set('alamat', $alamat);
        $this->db->where('id_pariwisata', $id_pariwisata);
        $this->db->update('tb_pariwisata', $data);
    }

    public function hapusDataWisata($id_pariwisata)
    {
        $this->db->delete('tb_pariwisata', ['id_pariwisata' => $id_pariwisata]);
    }
}
