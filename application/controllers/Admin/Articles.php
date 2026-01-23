<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Articles extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->_check_role_access(['admin']);
        $this->load->model('Article_model');
        $this->load->library('upload');
    }

    public function index()
    {
        $data['title'] = 'Manajemen Artikel';
        $data['page'] = 'articles';
        $data['articles'] = $this->Article_model->get_all();
        
        $this->render_admin('admin/artikle/articles', $data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Artikel';
        $data['page'] = 'articles';
        
        $this->render_admin('admin/artikle/create', $data);
    }

    public function store()
    {
        // Debugging removed

        $config['upload_path'] = './assets/uploads/articles/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|webp';
        $config['max_size'] = 2048;
        $config['encrypt_name'] = TRUE;
        
        $this->upload->initialize($config);
        
        if (!is_dir('./assets/uploads/articles/')) { mkdir('./assets/uploads/articles/', 0777, true); }
        
        $thumbnail = null;
        if ($this->upload->do_upload('thumbnail')) {
             $upload_data = $this->upload->data();
             $thumbnail = 'assets/uploads/articles/' . $upload_data['file_name'];
        } else {
             // Optional: log upload error
             // log_message('error', $this->upload->display_errors()); 
        }
        
        $title = $this->input->post('title');
        $slug = url_title($title, 'dash', TRUE);
        
        $content = $this->input->post('content');
        $excerpt = $this->input->post('excerpt');
        if (empty($excerpt)) {
            $excerpt = substr(strip_tags($content), 0, 150);
        }

        $author_id = $this->session->userdata('user_id');
        if (empty($author_id)) {
            $author_id = 1; // Default to Admin ID 1 if session is lost/empty
        }

        $published_at = ($this->input->post('status') === 'published') ? date('Y-m-d H:i:s') : null;

        $data = [
            'title' => $title,
            'slug' => $slug,
            'category' => $this->input->post('category'), 
            'status' => $this->input->post('status'),
            'content' => $content,
            'excerpt' => $excerpt,
            'thumbnail' => $thumbnail,
            'author_id' => $author_id,
            'published_at' => $published_at
        ];

        // Ensure directory exists or is writable for debug log if needed, 
        // but primarily we trust CodeIgniter logging.
        
        if ($this->Article_model->create($data)) {
            $this->session->set_flashdata('success', 'Artikel berhasil ditambahkan!');
        } else {
            $error = $this->db->error();
            $msg = isset($error['message']) ? $error['message'] : 'Unknown Database Error';
            log_message('error', 'Article Create Error: ' . $msg);
            $this->session->set_flashdata('error', 'Gagal menambahkan artikel! Error: ' . $msg);
        }
        redirect('admin/articles');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Artikel';
        $data['page'] = 'articles';
        $data['article'] = $this->Article_model->get_by_id($id);
        
        if (!$data['article']) show_404();
        
        $this->render_admin('admin/artikle/edit', $data);
    }

    public function update($id)
    {
        $config['upload_path'] = './assets/uploads/articles/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|webp';
        $config['max_size'] = 2048;
        $config['encrypt_name'] = TRUE;
        
        $this->upload->initialize($config);
        
        if (!is_dir('./assets/uploads/articles/')) { mkdir('./assets/uploads/articles/', 0777, true); }
        
        $title = $this->input->post('title');
        $slug = url_title($title, 'dash', TRUE);

        $data = [
            'title' => $title,
            'slug' => $slug,
            'category' => $this->input->post('category'), 
            'status' => $this->input->post('status'),
            'content' => $this->input->post('content'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        // Update published_at if changing to published
        if ($this->input->post('status') === 'published') {
             $data['published_at'] = date('Y-m-d H:i:s');
        }

        if ($this->upload->do_upload('thumbnail')) {
             $upload_data = $this->upload->data();
             $data['thumbnail'] = 'assets/uploads/articles/' . $upload_data['file_name'];
        }
        
        if ($this->Article_model->update($id, $data)) {
            $this->session->set_flashdata('success', 'Artikel berhasil diperbarui!');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui artikel!');
        }
        redirect('admin/articles');
    }

    public function delete($id)
    {
        if ($this->Article_model->delete($id)) {
            $this->session->set_flashdata('success', 'Artikel berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus artikel!');
        }
        redirect('admin/articles');
    }
}
