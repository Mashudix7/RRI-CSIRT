<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Server_credentials extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->database();
        
        // Login Check
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        
        // RBAC
        if ($this->session->userdata('role') !== 'admin') {
            // show_error('Unauthorized Access', 403); 
            // Or redirect
            redirect('admin/dashboard');
        }

        $this->load->model('Server_credential_model');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['title'] = 'Data IP & Password';
        $data['page'] = 'server_credentials';
        
        $data['user'] = [
            'username' => $this->session->userdata('username'),
            'role' => $this->session->userdata('role'),
            'role_name' => $this->session->userdata('role_name'),
            'avatar' => $this->session->userdata('avatar')
        ];

        $data['credentials'] = $this->Server_credential_model->get_all();

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/server_credentials/index', $data);
        $this->load->view('admin/templates/footer', $data);
    }

    public function create() {
        $data['title'] = 'Tambah Data IP & Password';
        $data['page'] = 'server_credentials';
        
        $data['user'] = [
            'username' => $this->session->userdata('username'),
            'role' => $this->session->userdata('role'),
            'role_name' => $this->session->userdata('role_name'),
            'avatar' => $this->session->userdata('avatar')
        ];

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/server_credentials/create', $data);
        $this->load->view('admin/templates/footer', $data);
    }

    public function edit($id) {
        $data['title'] = 'Edit Data IP & Password';
        $data['page'] = 'server_credentials';
        
        $data['user'] = [
            'username' => $this->session->userdata('username'),
            'role' => $this->session->userdata('role'),
            'role_name' => $this->session->userdata('role_name'),
            'avatar' => $this->session->userdata('avatar')
        ];

        $data['credential'] = $this->Server_credential_model->get_by_id($id);
        
        if (!$data['credential']) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('admin/server_credentials');
        }

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/server_credentials/edit', $data);
        $this->load->view('admin/templates/footer', $data);
    }

    public function store() {
        $this->form_validation->set_rules('vm_name', 'Nama VM', 'required');
        $this->form_validation->set_rules('ip_address', 'IP Address', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
        } else {
            $data = [
                'vm_name' => $this->input->post('vm_name'),
                'ip_address' => $this->input->post('ip_address'),
                'domain' => $this->input->post('domain'),
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'description' => $this->input->post('description')
            ];
            
            if ($this->Server_credential_model->create($data)) {
                $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan data');
            }
        }
        redirect('admin/server_credentials');
    }

    public function update($id) {
        $this->form_validation->set_rules('vm_name', 'Nama VM', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
        } else {
            $data = [
                'vm_name' => $this->input->post('vm_name'),
                'ip_address' => $this->input->post('ip_address'),
                'domain' => $this->input->post('domain'),
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'description' => $this->input->post('description')
            ];
            
            if ($this->Server_credential_model->update($id, $data)) {
                $this->session->set_flashdata('success', 'Data berhasil diupdate');
            } else {
                $this->session->set_flashdata('error', 'Gagal update data');
            }
        }
        redirect('admin/server_credentials');
    }

    public function delete($id) {
        if ($this->Server_credential_model->delete($id)) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data');
        }
        redirect('admin/server_credentials');
    }
}
