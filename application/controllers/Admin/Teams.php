<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teams extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
        // Access control: Admin defaults, specific checks inside if needed. 
        // Based on old code, it seems open to admin access.
        $this->_check_role_access(['admin']); 
        $this->load->model('Team_model');
        $this->load->library('upload');
    }

    public function index()
    {
        $data['title'] = 'Manajemen Tim';
        $data['page'] = 'teams';
        $all_teams = $this->Team_model->get_all();
        $data['all_teams'] = $all_teams;
        $data['divisions'] = array_unique(array_column($all_teams, 'division'));
        
        $this->render_admin('admin/teams/teams', $data); 
    }

    public function create()
    {
        $data['title'] = 'Tambah Anggota Tim';
        $data['page'] = 'teams';
        
        // Check leader status for known divisions
        $divisions = ['Tim IT', 'Tim Teknologi Media Baru'];
        $leaders_status = [];
        foreach ($divisions as $div) {
            $leaders_status[$div] = $this->Team_model->has_leader($div);
        }
        $data['leaders_status'] = $leaders_status;
        
        $this->render_admin('admin/teams/create', $data);
    }

    public function store()
    {
        $config['upload_path']          = './assets/uploads/teams/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg|webp';
        $config['max_size']             = 2048;
        $config['encrypt_name']         = TRUE;

        $this->upload->initialize($config);

        if (!is_dir('./assets/uploads/teams/')) {
            mkdir('./assets/uploads/teams/', 0777, true);
        }

        $photo = null;
        if ($this->upload->do_upload('photo')) {
             $upload_data = $this->upload->data();
             $photo = 'assets/uploads/teams/' . $upload_data['file_name'];
        }
        $data = [
            'name' => $this->input->post('name'),
            'position' => $this->input->post('position'),
            'division' => $this->input->post('division'),
            'email' => $this->input->post('email'),
            'role' => $this->input->post('level'),
            'photo' => $photo
        ];

        // Validate One Leader Per Division
        if ($data['role'] === 'leader') {
            if ($this->Team_model->has_leader($data['division'])) {
                $this->session->set_flashdata('error', 'Divisi ini sudah memiliki Ketua! Hanya boleh ada 1 Ketua per Divisi.');
                redirect('admin/teams/create');
                return;
            }
        }

        if ($this->Team_model->create($data)) {
            $this->session->set_flashdata('success', 'Anggota tim berhasil ditambahkan!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan anggota tim!');
        }
        redirect('admin/teams');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Anggota Tim';
        $data['page'] = 'teams';
        $data['member'] = $this->Team_model->get_by_id($id);
        
        if (!$data['member']) show_404();
        
        // Check leader status for known divisions
        $divisions = ['Tim IT', 'Tim Teknologi Media Baru'];
        $leaders_status = [];
        foreach ($divisions as $div) {
            // Check if leader exists EXCLUDING this current member
            $leaders_status[$div] = $this->Team_model->has_leader($div, $id);
        }
        $data['leaders_status'] = $leaders_status;

        $this->render_admin('admin/teams/edit', $data);
    }

    public function update($id)
    {
        $config['upload_path']          = './assets/uploads/teams/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg|webp';
        $config['max_size']             = 2048;
        $config['encrypt_name']         = TRUE;

        $this->upload->initialize($config);

        if (!is_dir('./assets/uploads/teams/')) {
            mkdir('./assets/uploads/teams/', 0777, true);
        }

        $data = [
            'name' => $this->input->post('name'),
            'position' => $this->input->post('position'),
            'division' => $this->input->post('division'),
            'email' => $this->input->post('email'),
            'role' => $this->input->post('level'),
        ];

        // Validate One Leader Per Division
        if ($data['role'] === 'leader') {
            if ($this->Team_model->has_leader($data['division'], $id)) {
                $this->session->set_flashdata('error', 'Divisi ini sudah memiliki Ketua! Hanya boleh ada 1 Ketua per Divisi.');
                redirect('admin/teams/edit/' . $id);
                return;
            }
        }

        if ($this->upload->do_upload('photo')) {
             $upload_data = $this->upload->data();
             $data['photo'] = 'assets/uploads/teams/' . $upload_data['file_name'];
        }

        if ($this->Team_model->update($id, $data)) {
            $this->session->set_flashdata('success', 'Data tim berhasil diperbarui!');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui data tim!');
        }
        redirect('admin/teams');
    }

    public function delete($id)
    {
        if ($this->Team_model->delete($id)) {
            $this->session->set_flashdata('success', 'Anggota tim berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus anggota tim!');
        }
        redirect('admin/teams');
    }
}
