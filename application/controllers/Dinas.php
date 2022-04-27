<?php

class dinas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('email') == "") {
            redirect('auth');
        }
        $this->load->model('M_Dinas', 'M_Desa');
    }

    public function index()
    {

        $data['title'] = 'Validasi Pariwisata';
        $data['admin'] = $this->M_Dinas->getDataDinas();
        $data['wisata'] = $this->M_Desa->getWisata();
        $data['status'] = $this->M_Dinas->getStatus();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_dinas', $data);
        $this->load->view('admin/v_dinas', $data);
        $this->load->view('template/footer');
    }

    public function profil()
    {
        $this->load->model('M_Dinas');

        $data['title'] = 'Profile';
        $data['admin'] = $this->M_Dinas->getDataDinas();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_dinas', $data);
        $this->load->view('admin/profil_dinas', $data);
        $this->load->view('template/footer');
    }
    public function ubah_profile()
    {
        $data['title'] = 'Edit Profile';
        $data['admin'] = $this->M_Dinas->getDataDinas();

        $this->form_validation->set_rules('username', 'Username', 'required|trim', [
            'required'  => 'Username Wajib Diisi!'
        ]);
        $this->form_validation->set_rules('telp', 'Telp', 'required|trim', [
            'required'  => 'Nomor Telepon Wajib Diisi!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar_dinas', $data);
            $this->load->view('admin/profile_dinas', $data);
            $this->load->view('template/footer');
        } else {
            $this->M_Dinas->ubahDataProfile();
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil diubah!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('dinas/profil');
        }
    }

    public function pengguna()
    {
        $data['title'] = 'Pengguna';
        $data['pengguna'] = $this->M_Dinas->getDataUser();
        $data['role'] = $this->M_Dinas->getLevel();
        $data['admin'] = $this->M_Dinas->getDataDinas();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_dinas', $data);
        $this->load->view('pengguna/v_user', $data);
        $this->load->view('template/footer');
    }

    public function tambah_pengguna()
    {
        $data['title'] = 'Tambah Pengguna';
        $data['admin'] = $this->M_Dinas->getDataDinas();
        $data['pengguna'] = $this->M_Dinas->getDataUser();
        $data['role'] = $this->M_Dinas->getLevel();

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tb_user.email]', [
            'required'  => 'Email Wajib Diisi!',
            'is_unique'  => 'Email Sudah Terdaftar!'
        ]);
        $this->form_validation->set_rules('username', 'Username', 'required', [
            'required'  => 'Username Wajib Diisi!'
        ]);
        $this->form_validation->set_rules('telp', 'Telp', 'required|trim', [
            'required'  => 'Nomor Telepon Wajib Diisi!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]|max_length[8]', [
            'required'  => 'Password Wajib Diisi!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar_dinas', $data);
            $this->load->view('pengguna/v_tambah_user', $data);
            $this->load->view('template/footer');
        } else {
            $this->M_Dinas->tambah_user();
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Pengguna berhasil ditambahkan!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('dinas/pengguna');
        }
    }

    public function edit_pengguna($id_user)
    {
        $data['title'] = 'Edit Data Pengguna';
        $data['admin'] = $this->M_Dinas->getDataDinas();
        $data['pengguna'] = $this->M_Dinas->getUserById($id_user);

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required'  => 'Email Wajib Diisi!',
        ]);
        $this->form_validation->set_rules('username', 'Username', 'required', [
            'required'  => 'Username Wajib Diisi!'
        ]);
        $this->form_validation->set_rules('telp', 'Telp', 'required|trim', [
            'required'  => 'Nomor Telepon Wajib Diisi!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar_dinas', $data);
            $this->load->view('pengguna/v_edit_user', $data);
            $this->load->view('template/footer');
        } else {
            $this->M_Dinas->edit_user($id_user);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Pengguna berhasil diubah!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('dinas/pengguna');
        }
    }

    public function hapus_pengguna($id_user)
    {
        $this->M_Dinas->hapus_user($id_user);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Pengguna berhasil dihapus!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('dinas/pengguna');
    }

    public function tampil_validasi()
    {
        $data['title'] = 'Validasi Pariwisata';
        $data['admin'] = $this->M_Dinas->getDataDinas();
        $data['wisata'] = $this->M_Desa->getWisata();
        $data['status'] = $this->M_Dinas->getStatus();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_dinas', $data);
        $this->load->view('validasi/v_validasi', $data);
        $this->load->view('template/footer');
    }

    public function pemeringkatan()
    {
        $data['title'] = 'Pemeringkatan';
        $data['admin'] = $this->M_Dinas->getDataDinas();
        $data['wisata'] = $this->M_Desa->getWisata();
        $data['status'] = $this->M_Dinas->getStatus();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_dinas', $data);
        $this->load->view('pemeringkatan/v_pemeringkatan', $data);
        $this->load->view('template/footer');
    }

    public function validasi($id_pariwisata)
    {
        $data['title'] = 'Validasi';
        $data['admin'] = $this->M_Dinas->getDataDinas();
        $data['wisata'] = $this->M_Desa->getWisataById($id_pariwisata);

        $this->form_validation->set_rules('id_status', 'Status', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar_dinas', $data);
            $this->load->view('validasi/v_edit_validasi', $data);
            $this->load->view('template/footer');
        } else {
            $this->M_Dinas->edit_status($id_pariwisata);
            $this->session->set_flashdata('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">Status validasi data telah diubah!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('dinas/tampil_validasi');
        }
    }
}
