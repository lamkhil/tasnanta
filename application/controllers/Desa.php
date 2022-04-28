<?php

class desa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('email') == "") {
            redirect('auth');
        }
        $this->load->model('M_Desa', 'M_Kriteria');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->M_Desa->getDataByEmail();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_desa', $data);
        $this->load->view('admin/v_desa', $data);
        $this->load->view('template/footer');
    }

    public function profile()
    {
        $data['title'] = 'Profile';
        $data['user'] = $this->M_Desa->getDataByEmail();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_desa', $data);
        $this->load->view('admin/profile_desa', $data);
        $this->load->view('template/footer');
    }
    public function ubah_profile()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->M_Desa->getDataByEmail();

        $this->form_validation->set_rules('username', 'Username', 'required|trim', [
            'required'  => 'Username Wajib Diisi!'
        ]);
        $this->form_validation->set_rules('telp', 'Telp', 'required|trim', [
            'required'  => 'Nomor Telepon Wajib Diisi!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar_desa', $data);
            $this->load->view('admin/profile_desa', $data);
            $this->load->view('template/footer');
        } else {
            $this->M_Desa->ubahDataProfile();
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil diubah!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('desa/profile');
        }
    }

    public function tampil_survey()
    {
        $data['title'] = 'Data Survey';
        $data['user'] = $this->M_Desa->getDataByEmail();
        $data['wisata'] = $this->M_Desa->getWisata();
        $data['kriteria'] = $this->M_Kriteria->getAllKriteria();
        $data['subkriteria'] = $this->M_Kriteria->getAllSubkriteria();
        $data['nilai'] = $this->M_Desa->getPariwisataWithNilai();

        
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_desa', $data);
        $this->load->view('survey/v_survey', $data);
        $this->load->view('template/footer');
    }

    public function isi_survey()
    {
        $data['title'] = 'Isi Survey';
        $data['user'] = $this->M_Desa->getDataByEmail();
        $data['kriteria'] = $this->M_Kriteria->getAllKriteria();
        $data['subkriteria'] = $this->M_Kriteria->getAllSubkriteria();

        $this->form_validation->set_rules('nm_pariwisata', 'Nama Pariwisata', 'required|is_unique[tb_pariwisata.nm_pariwisata]', [
            'required'  => 'Nama Pariwisata Wajib Diisi!',
            'is_unique' => 'Pariwisata sudah ada'
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required', [
            'required'  => 'Alamat Wajib Diisi!'
        ]);
        $dropdown[''] = '';
        foreach ($data['kriteria'] as $kr) {
            $dropdown[$kr['id_kriteria']] = $this->input->post($kr['id_kriteria'], true);
        }
        $data['dropdown'] = $dropdown;
        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar_desa', $data);
            $this->load->view('survey/isi_survey', $data);
            $this->load->view('template/footer');
        } else {
            $this->M_Desa->tambahDataWisata();
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil ditambah!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('desa/tampil_survey');
        }
    }

    public function hapus_survey($id_pariwisata)
    {
        $this->M_Desa->hapusDataWisata($id_pariwisata);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil dihapus!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('desa/tampil_survey');
    }

    public function edit_survey($id_pariwisata)
    {
        $data['title'] = 'Edit Data Pariwisata';
        $data['user'] = $this->M_Desa->getDataByEmail();
        $data['wisata'] = $this->M_Desa->getPariwisataWithNilaiById($id_pariwisata);
        $data['kriteria'] = $this->M_Kriteria->getAllKriteria();
        $data['subkriteria'] = $this->M_Kriteria->getAllSubkriteria();

        $this->form_validation->set_rules('nm_pariwisata', 'Nama Pariwisata', 'required', [
            'required'  => 'Nama Pariwisata Wajib Diisi!',
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required', [
            'required'  => 'Alamat Wajib Diisi!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar_desa', $data);
            $this->load->view('survey/edit_survey', $data);
            $this->load->view('template/footer');
        } else {
            $this->M_Desa->editDataWisataWithNilai($id_pariwisata);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Pengguna berhasil diubah!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('desa/tampil_survey');
        }
    }

    public function tampil_opsi()
    {
        if ($this->input->post('nilai')) {
            echo $this->M_Kriteria->get_opsi($this->input->post('id_kriteria'));
        }
    }
}
