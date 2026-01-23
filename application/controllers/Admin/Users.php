<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
        // Check Admin Access for all methods in this controller
        $this->_check_role_access(['admin']);
    }

    public function index()
    {
        $data['title'] = 'Manajemen Pengguna';
        $data['page'] = 'users';
        $data['users'] = $this->User_model->get_all_with_status();
        
        $this->render_admin('admin/users', $data);
    }
    
    public function create()
    {
        $data['title'] = 'Tambah Pengguna';
        $data['page'] = 'users';
        $this->render_admin('admin/users/create', $data);
    }

    public function store()
    {
        $config['upload_path'] = './assets/uploads/users/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|webp';
        $config['max_size'] = 2048;
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        
        if (!is_dir('./assets/uploads/users/')) { mkdir('./assets/uploads/users/', 0777, true); }

        $photo = null;
        if ($this->upload->do_upload('photo')) {
             $upload_data = $this->upload->data();
             $photo = 'assets/uploads/users/' . $upload_data['file_name'];
        }

        $data = [
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password'),
            'role' => $this->input->post('role'),
            'status' => $this->input->post('status'),
            'full_name' => $this->input->post('full_name'),
            'photo' => $photo
        ];
        
        if ($this->User_model->create($data)) {
            $this->session->set_flashdata('success', 'Pengguna berhasil ditambahkan!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan pengguna!');
        }
        redirect('admin/users');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Pengguna';
        $data['page'] = 'users'; // Active sidebar menu
        $data['user'] = $this->User_model->get_by_id($id);
        
        if (!$data['user']) {
            show_404();
        }

        $this->render_admin('admin/users/edit', $data);
    }

    public function update($id)
    {
        $config['upload_path'] = './assets/uploads/users/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|webp';
        $config['max_size'] = 2048;
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        
        if (!is_dir('./assets/uploads/users/')) { mkdir('./assets/uploads/users/', 0777, true); }

        $data = [
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'role' => $this->input->post('role'),
            'status' => $this->input->post('status'),
            'full_name' => $this->input->post('full_name'),
        ];
        
        $password = $this->input->post('password');
        if (!empty($password)) {
            $data['password'] = $password;
        }
        
        if ($this->upload->do_upload('photo')) {
             $upload_data = $this->upload->data();
             $data['photo'] = 'assets/uploads/users/' . $upload_data['file_name'];
        }

        if ($this->User_model->update($id, $data)) {
            $this->session->set_flashdata('success', 'Data pengguna berhasil diperbarui!');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui data pengguna!');
        }
        redirect('admin/users');
    }

    public function delete($id)
    {
        if ($this->User_model->delete($id)) {
            $this->session->set_flashdata('success', 'Pengguna berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus pengguna!');
        }
        redirect('admin/users');
    }
}
