<?php
/**
 * =====================================================
 * Admin Controller
 * =====================================================
 * 
 * Controller untuk semua halaman administrasi.
 * Memerlukan autentikasi dan role admin.
 * 
 * @package     CSIRT RRI
 * @subpackage  Controllers
 * @category    Administration
 * @author      Tim Teknologi Media Baru
 * 
 * Komentar Kritikal:
 * - SEMUA method memerlukan autentikasi
 * - Role admin diperlukan untuk akses
 * - Audit log untuk semua aksi sensitif
 * =====================================================
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
        $this->load->library('form_validation'); // Make sure validation is loaded
        $this->load->model('Article_model');
        $this->load->model('Team_model');
        $this->load->model('User_model');
        $this->load->model('Audit_model');
        
        // Proteksi: Cek login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        
        // Proteksi: Cek role yang diizinkan (Semua role yang valid boleh masuk, tapi akses menu dibatasi di method masing-masing)
        $role = $this->session->userdata('role');
        $allowed_roles = ['admin', 'management', 'auditor'];
        
        if (!in_array($role, $allowed_roles)) {
            // Role tidak dikenali
            $this->session->sess_destroy();
            redirect('auth/login');
        }
    }

    /**
     * User Management
     */
    public function users()
    {
        // RBAC: Admin Only
        if ($this->session->userdata('role') !== 'admin') {
            show_error('Unauthorized Access', 403);
        }

        $data['title'] = 'Manajemen Pengguna';
        $data['page'] = 'users';
        $data['user'] = $this->_get_user_data();
        
        $data['users'] = $this->User_model->get_all();
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/users', $data);
        $this->load->view('admin/templates/footer', $data);
    }

    /**
     * User Management CRUD
     */
    public function user_create()
    {
        if ($this->session->userdata('role') !== 'admin') show_error('Unauthorized', 403);

        $data['title'] = 'Tambah Pengguna';
        $data['page'] = 'users'; 
        $data['user'] = $this->_get_user_data();
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/users/create', $data);
        $this->load->view('admin/templates/footer', $data);
    }

    public function user_store()
    {
        if ($this->session->userdata('role') !== 'admin') show_error('Unauthorized', 403);

        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('role', 'Role', 'required|in_list[admin,management,auditor]');

        if ($this->form_validation->run() === FALSE) {
            $this->user_create();
            return;
        }

        $data = [
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password'), // Model will hash it
            'role' => $this->input->post('role'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        // Handle Image Upload
        if (!empty($_FILES['avatar']['name'])) {
            $config['upload_path'] = './uploads/avatars/';
            $config['allowed_types'] = 'jpg|jpeg|png|webp';
            $config['max_size'] = 2048;
            $config['file_name'] = 'avatar_' . time();

            if (!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('avatar')) {
                $upload_data = $this->upload->data();
                $data['avatar'] = $upload_data['file_name'];
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                $this->user_create();
                return;
            }
        } else {
            $data['avatar'] = 'default_avatar.png'; // Default
        }

        if ($this->User_model->create($data)) {
            $this->Audit_model->log('create_user', 'Created user: ' . $data['username']);
            $this->session->set_flashdata('success', 'Pengguna berhasil ditambahkan!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan pengguna DB.');
        }
        
        redirect('admin/users');
    }

    /**
     * Dashboard (Homepage)
     */
    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['page'] = 'dashboard';
        $data['user'] = $this->_get_user_data();

        // Load WAF Model
        $this->load->model('Waf_model');
        
        // Fetch Real-time Stats from Safeline WAF
        $waf_data = $this->Waf_model->get_daily_stats();
        
        $data['stats'] = $waf_data['summary'];
        $data['recent_threats'] = $waf_data['recent'];
        $data['attack_stats'] = $waf_data['types'];

        // Add additional needed stats if not in WAF response
        $data['stats']['uptime'] = '99.9%'; // Hardcode or fetch from server monitor

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('admin/templates/footer', $data);
    }

    public function user_edit($id)
    {
        if ($this->session->userdata('role') !== 'admin') show_error('Unauthorized', 403);

        $data['title'] = 'Edit Pengguna';
        $data['page'] = 'users';
        $data['user'] = $this->_get_user_data();
        
        $data['user_edit'] = $this->User_model->get_by_id($id);
        
        if (!$data['user_edit']) {
            show_404();
        }
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/users/edit', $data);
        $this->load->view('admin/templates/footer', $data);
    }

    public function user_update($id)
    {
         if ($this->session->userdata('role') !== 'admin') show_error('Unauthorized', 403);

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('role', 'Role', 'required|in_list[admin,management,auditor]');
        
        if ($this->form_validation->run() === FALSE) {
            $this->user_edit($id);
            return;
        }

        $data = [
            'email' => $this->input->post('email'),
            'role' => $this->input->post('role')
        ];

        // Update Password only if provided
        $password = $this->input->post('password');
        if (!empty($password)) {
            $data['password'] = $password; 
        }

        // Handle Image Upload
        if (!empty($_FILES['avatar']['name'])) {
            $config['upload_path'] = './uploads/avatars/';
            $config['allowed_types'] = 'jpg|jpeg|png|webp';
            $config['max_size'] = 2048;
            $config['file_name'] = 'avatar_' . time();

            if (!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('avatar')) {
                $upload_data = $this->upload->data();
                $data['avatar'] = $upload_data['file_name'];
            }
        }

        if ($this->User_model->update($id, $data)) {
            $this->Audit_model->log('update_user', 'Updated user ID: ' . $id);
            $this->session->set_flashdata('success', 'Pengguna berhasil diperbarui!');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui pengguna.');
        }

        redirect('admin/users');
    }

    public function user_delete($id)
    {
        if ($this->session->userdata('role') !== 'admin') show_error('Unauthorized', 403);
        
        if ($id == $this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'Anda tidak dapat menghapus akun sendiri!');
            redirect('admin/users');
            return;
        }

        $user = $this->User_model->get_by_id($id);
        if ($this->User_model->delete($id)) {
             $this->Audit_model->log('delete_user', 'Deleted user: ' . ($user['username'] ?? $id));
             $this->session->set_flashdata('success', 'Pengguna berhasil dihapus!');
        } else {
             $this->session->set_flashdata('error', 'Gagal menghapus pengguna.');
        }
        redirect('admin/users');
    }

    /**
     * Audit Log
     */
    public function audit_log()
    {
        $role = $this->session->userdata('role');
        if ($role !== 'admin' && $role !== 'auditor') {
            show_error('Unauthorized', 403);
        }

        $data['title'] = 'Audit Log';
        $data['page'] = 'audit_log';
        $data['user'] = $this->_get_user_data();
        
        $data['logs'] = $this->Audit_model->get_all(100); 

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/audit_log', $data); 
        $this->load->view('admin/templates/footer', $data);
    }

    /**
     * Article Management
     */
    /**
     * Article Management
     */
    public function articles($action = 'index', $id = null)
    {
        $data['user'] = $this->_get_user_data();

        // RBAC Check for CUD
        $role = $this->session->userdata('role');
        if (in_array($action, ['create', 'store', 'edit', 'update', 'delete'])) {
             if (!in_array($role, ['admin', 'management'])) {
                 show_error('Unauthorized', 403);
             }
        }

        // Ensure models are loaded
        if (!isset($this->Article_model)) {
            $this->load->model('Article_model');
        }

        switch ($action) {
            case 'create':
                $data['title'] = 'Tambah Artikel';
                $data['page'] = 'articles';
                $this->load->view('admin/templates/header', $data);
                $this->load->view('admin/templates/sidebar', $data);
                $this->load->view('admin/artikle/create', $data);
                $this->load->view('admin/templates/footer', $data);
                break;

            case 'store':
                // Handle form submission
                $input = $this->input->post();
                
                // Explicitly validatable fields
                $this->form_validation->set_rules('title', 'Judul', 'required');
                $this->form_validation->set_rules('content', 'Konten', 'required');
                
                if ($this->form_validation->run() === FALSE) {
                    $this->session->set_flashdata('error', validation_errors());
                    redirect('admin/articles/create');
                    return;
                }

                $thumbnail = null;
                // Handle File Upload
                if (!empty($_FILES['thumbnail']['name'])) {
                    $upload = $this->_upload_and_resize('thumbnail', 800, 600);
                    if ($upload['status']) {
                        $thumbnail = 'assets/uploads/' . $upload['file_name'];
                    } else {
                        $this->session->set_flashdata('error', $upload['error']);
                        redirect('admin/articles/create');
                        return;
                    }
                }
                
                // Prepare Data for DB (EXPLICIT MAPPING)
                $data = [
                    'title' => $input['title'],
                    'slug'  => url_title($input['title'], '-', TRUE),
                    'category' => $input['category'],
                    'content' => $input['content'],
                    'status' => $input['status'],
                    'author_id' => $this->session->userdata('user_id'),
                    'thumbnail' => $thumbnail,
                    'created_at' => date('Y-m-d H:i:s')
                ];

                // Handle Excerpt
                $data['excerpt'] = !empty($input['excerpt']) ? $input['excerpt'] : substr(strip_tags($input['content']), 0, 150);
                
                // Handle Published Date
                if ($input['status'] === 'published') {
                    $data['published_at'] = date('Y-m-d H:i:s');
                } else {
                    $data['published_at'] = null;
                }

                if ($this->Article_model->create($data)) {
                    $this->Audit_model->log('create_article', 'Created article: ' . substr($input['title'], 0, 50));
                    $this->session->set_flashdata('success', 'Artikel berhasil ditambahkan');
                } else {
                    $db_error = $this->db->error();
                    $this->session->set_flashdata('error', 'Gagal menambahkan artikel: ' . ($db_error['message'] ?? 'Unknown Error'));
                }
                redirect('admin/articles');
                break;

            case 'edit':
                $data['title'] = 'Edit Artikel';
                $data['page'] = 'articles';
                $data['article'] = $this->Article_model->get_by_id($id);
                
                if (!$data['article']) {
                    show_404();
                }

                $this->load->view('admin/templates/header', $data);
                $this->load->view('admin/templates/sidebar', $data);
                $this->load->view('admin/artikle/edit', $data);
                $this->load->view('admin/templates/footer', $data);
                break;
                
            case 'update':
                $input = $this->input->post();
                
                // Prepare Data for DB (EXPLICIT MAPPING)
                $data = [
                    'title' => $input['title'],
                    'category' => $input['category'],
                    'content' => $input['content'],
                    'status' => $input['status'],
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                if (isset($input['title'])) {
                    $data['slug'] = url_title($input['title'], '-', TRUE);
                }

                // Handle File Upload
                if (!empty($_FILES['thumbnail']['name'])) {
                    $upload = $this->_upload_and_resize('thumbnail', 800, 600);
                    if ($upload['status']) {
                        $data['thumbnail'] = 'assets/uploads/' . $upload['file_name'];
                    } else {
                        $this->session->set_flashdata('error', $upload['error']);
                        redirect('admin/articles/edit/' . $id);
                        return;
                    }
                }
                
                // Handle Excerpt if user changed it? Or simple update logic
                // If we want to auto-update excerpt when content changes unless explicitly set:
                // For now, simpler:
                if (!empty($input['excerpt'])) {
                    $data['excerpt'] = $input['excerpt'];
                }

                // Handle Published Date Update
                if ($input['status'] === 'published') {
                    $data['published_at'] = date('Y-m-d H:i:s');
                }

                if ($this->Article_model->update($id, $data)) {
                    $this->Audit_model->log('update_article', 'Updated article ID: ' . $id);
                    $this->session->set_flashdata('success', 'Artikel berhasil diperbarui');
                } else {
                    $db_error = $this->db->error();
                    $this->session->set_flashdata('error', 'Gagal memperbarui artikel: ' . ($db_error['message'] ?? 'Unknown Error'));
                }
                redirect('admin/articles');
                break;
                
            case 'delete':
                $article = $this->Article_model->get_by_id($id);
                if ($this->Article_model->delete($id)) {
                    $this->Audit_model->log('delete_article', 'Deleted article: ' . ($article['title'] ?? $id));
                    $this->session->set_flashdata('success', 'Artikel berhasil dihapus');
                } else {
                    $this->session->set_flashdata('error', 'Gagal menghapus artikel');
                }
                redirect('admin/articles');
                break;

            case 'index':
            default:
                $data['title'] = 'Manajemen Artikel';
                $data['page'] = 'articles';
                $data['articles'] = $this->Article_model->get_all();
                
                $this->load->view('admin/templates/header', $data);
                $this->load->view('admin/templates/sidebar', $data);
                $this->load->view('admin/artikle/articles', $data);
                $this->load->view('admin/templates/footer', $data);
                break;
        }
    }

    /**
     * Helper: Upload and Resize Image
     */
    private function _upload_and_resize($field_name, $width, $height)
    {
        $config['upload_path']   = './assets/uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|webp';
        $config['max_size']      = 2048; // 2MB
        // $config['encrypt_name']  = TRUE; // Disable to keep easy names or enable for security

        // Check if directory exists
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload($field_name)) {
            return ['status' => false, 'error' => $this->upload->display_errors()];
        }

        $upload_data = $this->upload->data();
        
        // Resize Image
        $config_resize['image_library']  = 'gd2';
        $config_resize['source_image']   = $upload_data['full_path'];
        $config_resize['create_thumb']   = FALSE;
        $config_resize['maintain_ratio'] = TRUE;
        $config_resize['width']          = $width;
        $config_resize['height']         = $height;
        $config_resize['quality']        = '80%'; 

        $this->load->library('image_lib', $config_resize);
        $this->image_lib->resize();
        $this->image_lib->clear();

        return ['status' => true, 'file_name' => $upload_data['file_name']];
    }

    /**
     * Reports
     */
    public function reports()
    {
        $data['title'] = 'Laporan';
        $data['page'] = 'reports';
        $data['user'] = $this->_get_user_data();
        
        // Stats for reports
        $data['stats'] = [
            'total_attacks' => 12450,
            'blocked_attacks' => 12400,
            'threats_detected' => 50,
            'uptime' => '99.9%'
        ];
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/reports', $data);
        $this->load->view('admin/templates/footer', $data);
    }

    /**
     * Settings
     */
    /**
     * Settings
     */
    public function settings()
    {
        if ($this->session->userdata('role') !== 'admin') {
             show_error('Unauthorized', 403);
        }

        $this->load->model('Settings_model');

        $data['title'] = 'Pengaturan Sistem';
        $data['page'] = 'settings';
        $data['user'] = $this->_get_user_data();
        $data['settings_grouped'] = $this->Settings_model->get_all_grouped();
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/settings', $data);
        $this->load->view('admin/templates/footer', $data);
    }

    public function settings_update()
    {
        if ($this->session->userdata('role') !== 'admin') show_error('Unauthorized', 403);

        $this->load->model('Settings_model');
        $input = $this->input->post();

        if (!empty($input)) {
            $updated_count = 0;
            foreach ($input as $key => $value) {
                // Ignore CSRF token if present
                if ($key == $this->security->get_csrf_token_name()) continue;

                if ($this->Settings_model->update($key, $value)) {
                    $updated_count++;
                }
            }
            
            // Log Action
            $this->Audit_model->log('update_settings', "Updated $updated_count settings");
            $this->session->set_flashdata('success', 'Pengaturan berhasil disimpan.');
        }

        redirect('admin/settings');
    }

    /**
     * Team Management
     */
    public function teams($action = 'index', $id = null)
    {
        $data['user'] = $this->_get_user_data();

        // RBAC Check
        $role = $this->session->userdata('role');
        if (in_array($action, ['create', 'store', 'edit', 'update', 'delete'])) {
             if (!in_array($role, ['admin', 'management'])) {
                 show_error('Unauthorized', 403);
             }
        }


        
        // Ensure models are loaded
        if (!isset($this->Team_model)) {
            $this->load->model('Team_model');
        }

        switch ($action) {
            case 'create':
                $data['title'] = 'Tambah Anggota Tim';
                $data['page'] = 'teams';
                $this->load->view('admin/templates/header', $data);
                $this->load->view('admin/templates/sidebar', $data);
                $this->load->view('admin/teams/create', $data);
                $this->load->view('admin/templates/footer', $data);
                break;

            case 'store':
                $input = $this->input->post();
                unset($input[$this->security->get_csrf_token_name()]); // Remove CSRF token

                // Validation: Check for existing leader in division
                if ($input['role'] === 'leader') {
                    if ($this->Team_model->has_leader($input['division'])) {
                        $this->session->set_flashdata('error', 'Divisi ini sudah memiliki Ketua Tim. Hapus atau ubah ketua tim lama terlebih dahulu.');
                        redirect('admin/teams/create');
                        return;
                    }
                }
                
                // Upload Photo
                if (!empty($_FILES['photo']['name'])) {
                    $upload = $this->_upload_and_resize('photo', 400, 400); // 1:1 Aspect Ratio preferred
                    if ($upload['status']) {
                        $input['photo'] = $upload['file_name'];
                    } else {
                        $this->session->set_flashdata('error', $upload['error']);
                        redirect('admin/teams/create');
                        return;
                    }
                }

                if ($this->Team_model->create($input)) {
                    $this->Audit_model->log('create_team', 'Added team member: ' . $input['name']);
                    $this->session->set_flashdata('success', 'Anggota tim berhasil ditambahkan');
                } else {
                    $this->session->set_flashdata('error', 'Gagal menambahkan anggota tim');
                }
                redirect('admin/teams');
                break;

            case 'edit':
                $data['title'] = 'Edit Anggota Tim';
                $data['page'] = 'teams';
                $data['member'] = $this->Team_model->get_by_id($id);

                if (!$data['member']) show_404();

                $this->load->view('admin/templates/header', $data);
                $this->load->view('admin/templates/sidebar', $data);
                $this->load->view('admin/teams/edit', $data);
                $this->load->view('admin/templates/footer', $data);
                break;
                
            case 'update':
                $input = $this->input->post();
                unset($input[$this->security->get_csrf_token_name()]); // Remove CSRF token
                
                // Validation: Check for existing leader (exclude self)
                if ($input['role'] === 'leader') {
                    if ($this->Team_model->has_leader($input['division'], $id)) {
                        $this->session->set_flashdata('error', 'Divisi ini sudah memiliki Ketua Tim.');
                        redirect('admin/teams/edit/' . $id);
                        return;
                    }
                }

                if (!empty($_FILES['photo']['name'])) {
                    $upload = $this->_upload_and_resize('photo', 400, 400);
                    if ($upload['status']) {
                        $input['photo'] = $upload['file_name'];
                    } else {
                        $this->session->set_flashdata('error', $upload['error']);
                        redirect('admin/teams/edit/' . $id);
                        return;
                    }
                }

                if ($this->Team_model->update($id, $input)) {
                    $this->Audit_model->log('update_team', 'Updated team member ID: ' . $id);
                    $this->session->set_flashdata('success', 'Data tim berhasil diperbarui');
                } else {
                    $this->session->set_flashdata('error', 'Gagal memperbarui data');
                }
                redirect('admin/teams');
                break;

            case 'delete':
                $member = $this->Team_model->get_by_id($id);
                if ($this->Team_model->delete($id)) {
                    $this->Audit_model->log('delete_team', 'Deleted team member: ' . ($member['name'] ?? $id));
                    $this->session->set_flashdata('success', 'Anggota tim berhasil dihapus');
                } else {
                    $this->session->set_flashdata('error', 'Gagal menghapus anggota');
                }
                redirect('admin/teams');
                break;

            case 'index':
            default:
                $data['title'] = 'Manajemen Tim';
                $data['page'] = 'teams';
                
                // Fetch ALL teams and sort/group them in the view or here
                // For simplified grouping as requested (Media Baru vs IT)
                // We'll fetch all sorted by division & level using the new model method
                $all_teams = $this->Team_model->get_all_by_division_sorted();
                
                $data['team_media_baru'] = array_filter($all_teams, function($t) { 
                    return $t['division'] == 'media_baru'; 
                });
                $data['team_it'] = array_filter($all_teams, function($t) { 
                    return $t['division'] == 'it'; 
                });
                
                $this->load->view('admin/templates/header', $data);
                $this->load->view('admin/templates/sidebar', $data);
                $this->load->view('admin/teams/teams', $data);
                $this->load->view('admin/templates/footer', $data);
                break;
        }
    }

    /**
     * IP Address Management
     */
    /**
     * IP Address Management
     */

    // =====================================================
    // INCIDENT RESPONSE SYSTEM
    // =====================================================

    public function incident_triage($id)
    {
        $data = $this->_get_user_data();
        $data['title'] = 'Incident Triage';
        $data['incident'] = $this->_get_mock_incident($id); // Mock data for now
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        // $this->load->view('admin/templates/topbar'); // Removed invalid view
        $this->load->view('admin/incidents/triage', $data);
        $this->load->view('admin/templates/footer');
    }

    public function incident_assignment($id)
    {
        $data = $this->_get_user_data();
        $data['title'] = 'Incident Assignment';
        $data['incident'] = $this->_get_mock_incident($id);
        $data['teams'] = [
            'network' => 'Tim Jaringan',
            'server' => 'Tim Server',
            'security' => 'Tim Keamanan',
            'dev' => 'Tim Developer'
        ];
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        // $this->load->view('admin/templates/topbar'); // Removed invalid view
        $this->load->view('admin/incidents/assignment', $data);
        $this->load->view('admin/templates/footer');
    }

    public function incident_investigation($id)
    {
        $data = $this->_get_user_data();
        $data['title'] = 'Incident Investigation';
        $data['incident'] = $this->_get_mock_incident($id);
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        // $this->load->view('admin/templates/topbar'); // Removed invalid view
        $this->load->view('admin/incidents/investigation', $data);
        $this->load->view('admin/templates/footer');
    }

    public function incident_mitigation($id)
    {
        $data = $this->_get_user_data();
        $data['title'] = 'Incident Mitigation';
        $data['incident'] = $this->_get_mock_incident($id);
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        // $this->load->view('admin/templates/topbar'); // Removed invalid view
        $this->load->view('admin/incidents/mitigation', $data);
        $this->load->view('admin/templates/footer');
    }

    public function incident_recovery($id)
    {
        $data = $this->_get_user_data();
        $data['title'] = 'Incident Recovery';
        $data['incident'] = $this->_get_mock_incident($id);
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        // $this->load->view('admin/templates/topbar'); // Removed invalid view
        $this->load->view('admin/incidents/recovery', $data);
        $this->load->view('admin/templates/footer');
    }

    private function _get_mock_incident($id)
    {
        return [
            'id' => $id,
            'title' => 'Suspicious Activity Detected',
            'description' => 'Unusual traffic pattern observed on port 8080.',
            'status' => 'Open',
            'source' => 'System Monitoring',
            'reported_at' => date('Y-m-d H:i:s'),
            'reporter' => 'SysAdmin',
            'severity' => 'High',
            'category' => 'Intrusion',
            'affected_systems' => 'Web Server 01',
            'pic' => 'Budi Santoso',
            'sla_deadline' => date('Y-m-d H:i:s', strtotime('+4 hours'))
        ];
    }



    /**
     * IP Address Management
     */


    // =====================================================
    // IP Management (Public IP - Hardcoded View)
    // =====================================================
    public function ip_management($region = null)
    {
        $data['user'] = $this->_get_user_data();
        $data['page'] = 'ip_management'; 
        
        $this->load->model('Ip_model');
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data); 

        // Fetch Data from DB
        $search = $this->input->get('q');
        $all_ip_data = $this->Ip_model->get_all_grouped_by_network($search);

        // If no region selected, show dashboard with summary data
        if (!$region) {
            $data['title'] = 'Manajemen IP Address';
            
            // Generate Summary for Dashboard Cards
            $summary = [];
            foreach ($all_ip_data as $slug => $net) {
                // Calculate usage stats dynamically based on DB rows
                // Assumptions: 
                // - Total IPs = Rows in DB (for now, as we only seeded significant ones)
                // - Used = Status active
                // To display "Total Capacity" (e.g. /26 = 64 IPs), we would need calculation. 
                // User requirement: "Data yg sebelumnya hardcode dijadikan database".
                // The DB rows represent the "Inventory".
                
                $total_rows = count($net['ips']);
                $used_rows = 0;
                foreach ($net['ips'] as $ip) {
                    if ($ip['status'] == 'active') $used_rows++;
                }

                $summary[$slug] = [
                    'name' => $net['name'],
                    'cidr' => $net['cidr'],
                    'range_start' => $net['range_start'],
                    'range_end' => $net['range_end'],
                    'subnet_mask' => $net['subnet_mask'] ?? '255.255.255.0',
                    'total' => $total_rows,
                    'used' => $used_rows,
                    'free' => $total_rows - $used_rows,
                    'usage_percent' => ($total_rows > 0) ? round(($used_rows / $total_rows) * 100) : 0
                ];
            }

            $data['regions'] = $summary;
            $data['global_stats'] = $this->Ip_model->get_global_stats();

            $this->load->view('admin/ip/ip_management/index', $data);
        } else {
            // Show specific region list
            if (isset($all_ip_data[$region])) {
                $data['title'] = $all_ip_data[$region]['name'];
                $data['location_name'] = $all_ip_data[$region]['name'];
                $data['network_cidr'] = $all_ip_data[$region]['cidr'];
                $data['ip_list'] = $all_ip_data[$region]['ips'];
                $this->load->view('admin/ip/ip_management/list', $data);
            } else {
                show_404();
            }
        }

        $this->load->view('admin/templates/footer');
    }

    public function ip_export($region)
    {
        // Cek login & role (redundant with constructor but good practice)
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') !== 'admin') {
            redirect('auth/login');
        }

        $this->load->model('Ip_model');
        $this->load->helper('download');

        $search = $this->input->get('q');
        $all_ip_data = $this->Ip_model->get_all_grouped_by_network($search);

        if (!isset($all_ip_data[$region])) {
            show_404();
            return;
        }

        $network = $all_ip_data[$region];
        $ips = $network['ips'];

        // CSV Header
        $csv_content = "No,IP Address,Status,Keterangan,Tipe\n";

        // CSV Data
        foreach ($ips as $ip) {
            // Escape content for CSV
            $keterangan = str_replace('"', '""', $ip['description']);
            $status = ucfirst($ip['status']);
            $type = ucfirst($ip['type']);
            
            $line = [
                $ip['no'],
                $ip['ip_address'],
                $status,
                '"' . $keterangan . '"',
                $type
            ];
            
            $csv_content .= implode(',', $line) . "\n";
        }

        $filename = 'IP_Data_' . $network['name'] . '_' . date('Ymd_His') . '.csv';
        force_download($filename, $csv_content);
    }

    public function ip_private()
    {
        $data['user'] = $this->_get_user_data();
        $data['title'] = 'Manajemen IP Private';
        $data['page'] = 'ip_private';
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/ip/ip_private', $data);
        $this->load->view('admin/templates/footer', $data);
    }


    // =====================================================
    // Network Config Helpers (JSON Persistence)
    // =====================================================
    private function _get_networks()
    {
        $file = APPPATH . 'config/ip_networks.json';
        if (file_exists($file)) {
            $json = file_get_contents($file);
            return json_decode($json, true) ?? [];
        }
        return [];
    }

    private function _save_networks($data)
    {
        $file = APPPATH . 'config/ip_networks.json';
        file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
    }

    // =====================================================
    // Network CRUD Actions
    // =====================================================
    public function networks()
    {
        $data['title'] = 'Kelola Network Wilayah';
        $data['page'] = 'ip_management';
        $data['user'] = $this->_get_user_data();
        
        $this->load->model('Ip_model');
        $data['networks'] = $this->Ip_model->get_networks();

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/ip/ip_management/networks/index', $data);
        $this->load->view('admin/templates/footer', $data);
    }

    public function network_create()
    {
        if ($this->session->userdata('role') !== 'admin') show_error('Unauthorized', 403);

        $data['title'] = 'Tambah Network';
        $data['page'] = 'ip_management';
        $data['user'] = $this->_get_user_data();
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/ip/ip_management/networks/form', $data);
        $this->load->view('admin/templates/footer', $data);
    }

    public function network_store()
    {
        if ($this->session->userdata('role') !== 'admin') show_error('Unauthorized', 403);

        $this->load->model('Ip_model');
        
        $data = [
            'slug' => url_title($this->input->post('name'), 'dash', TRUE),
            'name' => $this->input->post('name'),
            'cidr' => $this->input->post('cidr'),
            'range_start' => $this->input->post('range_start'),
            'range_end' => $this->input->post('range_end'),
            'subnet_mask' => $this->input->post('subnet_mask'),
            'description' => $this->input->post('description'),
            'is_reserve' => $this->input->post('is_reserve') ? 1 : 0
        ];

        // Check duplicate? For now, standard insert
        if ($this->Ip_model->create_network($data)) {
            $this->Audit_model->log('create_network', 'Created network: ' . $data['name']);
            $this->session->set_flashdata('success', 'Network berhasil ditambahkan!');
        } else {
            $error = $this->db->error(); // Capture DB error like duplicate slug
            $this->session->set_flashdata('error', 'Gagal menambahkan network: ' . $error['message']);
        }
        
        redirect('admin/ip_management/networks');
    }

    public function network_edit($id)
    {
        if ($this->session->userdata('role') !== 'admin') show_error('Unauthorized', 403);

        $this->load->model('Ip_model');
        $network = $this->Ip_model->get_network_by_id($id);
        
        if(!$network) show_404();

        $data['title'] = 'Edit Network';
        $data['page'] = 'ip_management';
        $data['user'] = $this->_get_user_data();
        $data['network'] = $network;
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/ip/ip_management/networks/form', $data);
        $this->load->view('admin/templates/footer', $data);
    }

    public function network_update($id)
    {
        if ($this->session->userdata('role') !== 'admin') show_error('Unauthorized', 403);

        $this->load->model('Ip_model');
        
        $data = [
            'name' => $this->input->post('name'),
            'cidr' => $this->input->post('cidr'),
            'range_start' => $this->input->post('range_start'),
            'range_end' => $this->input->post('range_end'),
            'subnet_mask' => $this->input->post('subnet_mask'),
            'description' => $this->input->post('description'),
            'is_reserve' => $this->input->post('is_reserve') ? 1 : 0
        ];

        if ($this->Ip_model->update_network($id, $data)) {
            $this->Audit_model->log('update_network', 'Updated network ID: ' . $id);
            $this->session->set_flashdata('success', 'Data Network berhasil diperbarui!');
        } else {
             $this->session->set_flashdata('error', 'Gagal memperbarui data network.');
        }
        redirect('admin/ip_management/networks');
    }

    public function network_delete($id)
    {
        if ($this->session->userdata('role') !== 'admin') show_error('Unauthorized', 403);

        $this->load->model('Ip_model');
        // Get name before delete for log
        $network = $this->Ip_model->get_network_by_id($id);

        if ($this->Ip_model->delete_network($id)) {
            $this->Audit_model->log('delete_network', 'Deleted network: ' . ($network['name'] ?? $id));
            $this->session->set_flashdata('success', 'Network berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus network.');
        }
        redirect('admin/ip_management/networks');
    }

    // =====================================================
    // IP CRUD (Individual)
    // =====================================================

    public function ip_edit($ip_or_id = null)
    {
        // Admin & Management
        if (!in_array($this->session->userdata('role'), ['admin', 'management'])) {
            show_error('Unauthorized', 403);
        }

        $this->load->model('Ip_model');
        
        $ip_data = null;
        
        // Retrieve explicit query param if present (safer for IPs with dots)
        $query_ip = $this->input->get('ip'); 
        if ($query_ip) {
            $ip_or_id = $query_ip;
        }

        // 1. Try by ID (if numeric)
        if (is_numeric($ip_or_id)) {
            $ip_data = $this->Ip_model->get_ip_by_id($ip_or_id);
        }

        // 2. If not found by ID (or not numeric), try by IP Address String
        if (!$ip_data && $ip_or_id) {
             $ip_data = $this->Ip_model->get_ip_by_address($ip_or_id);
        }

        // 3. If still not found, it means it's a "Free/Virtual" IP we want to activate/edit
        if (!$ip_data && $ip_or_id) {
             // Create a temporary object for the view
             $ip_data = [
                 'id' => null,
                 'network_id' => $this->input->get('network_id'), // Passed from link
                 'ip_address' => $ip_or_id,
                 'description' => '',
                 'type' => 'normal',
                 'status' => 'inactive'
             ];
        }

        if (!$ip_data) {
            show_404();
            return;
        }

        $data['title'] = 'Edit IP Address';
        $data['page'] = 'ip_management';
        $data['user'] = $this->_get_user_data();
        $data['ip'] = $ip_data;
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/ip/ip_management/form_ip', $data);
        $this->load->view('admin/templates/footer', $data);
    }

    public function ip_update()
    {
        // Admin & Management
        if (!in_array($this->session->userdata('role'), ['admin', 'management'])) {
            show_error('Unauthorized', 403);
        }

        $this->load->model('Ip_model');
        
        $data = [
            'network_id' => $this->input->post('network_id'),
            'ip_address' => $this->input->post('ip_address'),
            'description' => $this->input->post('description'),
            'type' => $this->input->post('type'),
            'status' => $this->input->post('status')
        ];

        // Basic Validation
        if (empty($data['network_id']) || empty($data['ip_address'])) {
             $this->session->set_flashdata('error', 'Data tidak lengkap (Network ID / IP missing).');
             redirect('admin/ip_management');
             return;
        }

        if ($this->Ip_model->save_ip($data)) {
            $this->Audit_model->log('update_ip', "Updated IP: {$data['ip_address']} ({$data['status']})");
            $this->session->set_flashdata('success', 'Data IP berhasil diperbarui!');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui data IP.');
        }

        // Redirect logic
        $network = $this->Ip_model->get_network_by_id($data['network_id']);
        if ($network && isset($network['slug'])) {
            redirect('admin/ip_management/' . $network['slug']);
        } else {
             redirect('admin/ip_management');
        }
    }

    private function _generate_public_ips()
    {
        $networks = $this->_get_networks();
        $regions = [];

        foreach ($networks as $key => $net) {
            $ips = [];
            
            // Extract start/end range from IPs (assuming IPv4)
            // Ideally we'd calculate from CIDR, but for simplicity we rely on the input range strings last segment
            // e.g. "218.33.123.0" -> last octet 0
            
            $start_parts = explode('.', $net['range_start']);
            $end_parts = explode('.', $net['range_end']);
            
            $prefix = $start_parts[0] . '.' . $start_parts[1] . '.' . $start_parts[2];
            $start_idx = (int)end($start_parts);
            $end_idx = (int)end($end_parts);

            // Safety cap
            if ($end_idx < $start_idx) $end_idx = $start_idx;
            if ($end_idx - $start_idx > 255) $end_idx = $start_idx + 255;

            $counter = 1;
            for ($i = $start_idx; $i <= $end_idx; $i++) {
                $ip_addr = "$prefix.$i";
                $desc = "";
                $type = "normal";

                // INJECT HARDCODED DATA based on Network ID and Index
                if ($key === 'jakarta') {
                    if ($i == 1) { $desc = "Gateway"; $type = "gateway"; }
                    elseif ($i == 2) $desc = "Internet DNS Server Lokal";
                    elseif ($i == 3) $desc = "Internet Aplikasi NextCloud";
                    elseif ($i == 4) $desc = "Aplikasi AudioLibrary";
                    elseif ($i == 5) $desc = "Internet PPID RRI";
                    elseif ($i == 6) $desc = "Aplikasi Simpatik (PT. Novarya)";
                    elseif ($i == 7) $desc = "Aplikasi Drive Cloud";
                    elseif ($i == 8) $desc = "WAF-Jakarta";
                    elseif ($i == 9) $desc = "Pro 1 Streaming";
                    elseif ($i == 10) $desc = "Pro 2 Streaming";
                    elseif ($i == 11) $desc = "Pro 4 Streaming";
                    elseif ($i == 12) $desc = "Streaming Sentral";
                    elseif ($i == 13) $desc = "Aplikasi Logger NEW";
                    elseif ($i == 14) $desc = "GL Audio Streaming";
                    elseif ($i == 15) $desc = "SIP Server Lama";
                    elseif ($i == 16) $desc = "Zabbix All NMS";
                    elseif ($i == 17) $desc = "Aplikasi Meeting TMB";
                    elseif ($i == 18) $desc = "Aplikasi Video GL";
                    elseif ($i == 19) $desc = "Omada Controller";
                    elseif ($i == 20) $desc = "Aplikasi Sisporja NEW";
                    elseif ($i == 21) $desc = "Unify Controller Pusat";
                    elseif ($i == 22) $desc = "DC JKT Cloud Proxmox VE";
                    elseif ($i == 23) $desc = "Aplikasi DAP & MEDIA";
                    elseif ($i == 24) $desc = "Intranet JKT";
                    elseif ($i == 25) $desc = "Aplikasi Supporting Server";
                    elseif ($i == 26) $desc = "IP PUBLIK NEW PRO 1";
                    elseif ($i == 27) $desc = "IP PUBLIK NEW PRO 2";
                    elseif ($i == 28) $desc = "IP PUBLIK NEW PRO 4";
                    elseif ($i == 29) $desc = "Global Media Academy";
                    elseif ($i == 30) $desc = "Aplikasi Presensi Mobile API Node JS";
                    elseif ($i == 31) $desc = "Aplikasi PNBP NEW";
                    elseif ($i == 32) $desc = "Aplikasi PNet Lab";
                    elseif ($i == 33) $desc = "IoT Siaga";
                    elseif ($i == 34) $desc = "IP Extend Portal Berita RRI";
                    elseif ($i == 35) $desc = "IP Private-Streaming Video";
                    elseif ($i == 36) $desc = "Aplikasi Mail Corporate (rri.co.id)";
                    elseif ($i == 37) $desc = "Aplikasi Mail Gateway Corporate (rri.co.id)";
                    elseif ($i == 38) $desc = "Aplikasi E-Learning MBC";
                    elseif ($i == 39) $desc = "Aplikasi WAZUH SOC";
                    elseif ($i == 40) $desc = "DevOps";
                    elseif ($i == 41) $desc = "RRI Digital 1";
                    elseif ($i == 42) $desc = "RRI Digital 2";
                    elseif ($i == 43) $desc = "RRI Digital 3";
                    elseif ($i == 44) $desc = "S3 RRI Digital";
                    elseif ($i == 45) $desc = "NextCloud Collabora";
                    elseif ($i == 46) $desc = "Docker Swarm";
                    elseif ($i == 47) $desc = "My-Presensi Terbaru (PT. TKM)";
                    elseif ($i == 48) $desc = "LB My-Presensi Terbaru (PT. TKM)";
                    elseif ($i == 49) $desc = "MinIO My-Presensi Terbaru (PT. TKM)";
                    elseif ($i == 50) $desc = "JDIH Nginx";
                    elseif ($i == 51) $desc = "Codec Backup";
                    elseif ($i == 52) $desc = "H3C";
                    elseif ($i == 53) $desc = "Aplikasi DIAS";
                    elseif ($i == 54) $desc = "IP Router Firewall DC Jakarta";
                    elseif ($i == 56) $desc = "TrueNas";
                    elseif ($i == 57) $desc = "internet Gedung Sebelah (sebelumnya digunakan LPU)";
                    elseif ($i == 58) $desc = "CMS Portal";
                    elseif ($i == 59) $desc = "Front Portal";
                    elseif ($i == 60) $desc = "Server API Portal";
                }
                elseif ($key === 'serpong') {
                    if ($i == 65) { $desc = "Gateway"; $type = "gateway"; }
                    elseif ($i == 66) $desc = "IP Router 1";
                    elseif ($i == 67) $desc = "IP Router 2";
                    elseif ($i == 68) $desc = "IP Server";
                    elseif ($i == 69) $desc = "IP API Portal";
                    elseif ($i == 70) $desc = "IP CMS Portal";
                    elseif ($i == 71) $desc = "IP Frontend Portal";
                    elseif ($i == 72) $desc = "IP Pro 1 Streaming";
                    elseif ($i == 73) $desc = "IP Pro 2 Streaming";
                    elseif ($i == 74) $desc = "IP Pro 4 Streaming";
                    elseif ($i == 75) $desc = "IP WAF DC PDN Serpong";
                    elseif ($i == 76) $desc = "IP S3 Portal";
                }
                elseif ($key === 'pusat') {
                    if ($i == 129) { $desc = "Gateway"; $type = "gateway"; }
                    elseif ($i == 130) $desc = "IP Firewall Kantor Pusat";
                    elseif ($i == 131) $desc = "IP Router Kantor Pusat";
                }
                elseif ($key === 'depok') {
                    if ($i == 193) { $desc = "Gateway"; $type = "gateway"; }
                    elseif ($i == 194) $desc = "Internet Semua Perangkat DC MBC";
                    elseif ($i == 195) $desc = "Aplikasi Manajemen IP";
                    elseif ($i == 196) $desc = "Aplikasi Pusdatin NEW";
                    elseif ($i == 197) $desc = "Aplikasi JDIH NEW";
                    elseif ($i == 198) $desc = "IP Internet Server Aplikasi E-Learning MBC";
                    elseif ($i == 199) $desc = "IP Internet Server Docker MBC";
                    elseif ($i == 200) $desc = "T-Track Pemancar";
                    elseif ($i == 201) $desc = "IP Publik Email Corporate RRI (rri.go.id)";
                    elseif ($i == 202) $desc = "Aplikasi DRM Proxy";
                    elseif ($i == 203) $desc = "Aplikasi WAF MBC";
                    elseif ($i == 204) $desc = "Aplikasi Jenkins Git Docker";
                    elseif ($i == 205) $desc = "IP Router Core Operasional";
                    elseif ($i == 206) $desc = "IP Publik-Streaming Video";
                    elseif ($i == 207) $desc = "IP Aplikasi Logger NEW";
                    elseif ($i == 208) $desc = "IP Aplikasi Simpatik (PT. Novarya)";
                    elseif ($i == 209) $desc = "IP My-Presensi Terbaru (PT. TKM)";
                    elseif ($i == 210) $desc = "IP LB My-Presensi Terbaru (PT. TKM)";
                    elseif ($i == 211) $desc = "IP MinIO My-Presensi Terbaru (PT. TKM)";
                    elseif ($i == 212) $desc = "IP Aplikasi Presensi Mobile API Node JS";
                }
                elseif (isset($net['is_reserve']) && $net['is_reserve']) {
                    // For reserves, no description yet other than the network description but here we are listing IPs
                    $desc = $net['description']; // Fallback
                }
                
                $is_reserve = isset($net['is_reserve']) && $net['is_reserve'];
                
                $ips[] = [
                    'no' => $counter++,
                    'ip_address' => $ip_addr,
                    'description' => $desc,
                    'type' => $type,
                    'is_reserve' => $is_reserve
                ];
            }

            $regions[$key] = [
                'name' => $net['name'],
                'cidr' => $net['cidr'],
                'ips' => $ips
            ];
        }

        return $regions;
    }


    // =====================================================
    // VPN Management 
    // =====================================================
    public function vpn_management()
    {
        $data['title'] = 'Manajemen IP VPN';
        $data['page'] = 'vpn_management';
        $data['user'] = $this->_get_user_data();

        // Get VPN Data
        $vpn_data = $this->_generate_vpn_ip_data();
        $data['vpn_connected'] = $vpn_data['connected'];
        $data['vpn_not_connected'] = $vpn_data['not_connected'];

        // Calculate Stats
        $connected_count = count($data['vpn_connected']);
        $not_connected_count = count($data['vpn_not_connected']);
        
        $data['stats'] = [
            'total' => $connected_count + $not_connected_count,
            'online' => $connected_count,
            'offline' => $not_connected_count
        ];

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/ip/vpn_management/index', $data);
        $this->load->view('admin/templates/footer', $data);
    }

    // =====================================================
    // Infrastructure - Network
    // =====================================================

    public function network_traffic_mrtg()
    {
        $data['user'] = $this->_get_user_data();
        $data['title'] = 'Traffic MRTG';
        $data['page'] = 'network_traffic_mrtg';
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        // Note: Filesystem shows network files in 'security' folder
        $this->load->view('admin/infrastructure/security/network_traffic_mrtg', $data);
        $this->load->view('admin/templates/footer', $data);
    }

    public function network_traffic_ap()
    {
        $data['user'] = $this->_get_user_data();
        $data['title'] = 'Traffic Access Point';
        $data['page'] = 'network_traffic_ap';
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        // Note: Filesystem shows network files in 'security' folder
        $this->load->view('admin/infrastructure/security/network_traffic_ap', $data);
        $this->load->view('admin/templates/footer', $data);
    }

    // =====================================================
    // Infrastructure - Data Center
    // =====================================================

    public function datacenter_resource_server()
    {
        $data['user'] = $this->_get_user_data();
        $data['title'] = 'Resource Server (JKT, MBC)';
        $data['page'] = 'datacenter_resource_server';
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/infrastructure/data_center/datacenter_resource_server', $data);
        $this->load->view('admin/templates/footer', $data);
    }

    public function datacenter_traffic_vm()
    {
        $data['user'] = $this->_get_user_data();
        $data['title'] = 'Traffic Virtual Machine';
        $data['page'] = 'datacenter_traffic_vm';
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/infrastructure/data_center/datacenter_traffic_vm', $data);
        $this->load->view('admin/templates/footer', $data);
    }

    // =====================================================
    // Infrastructure - Security
    // =====================================================

    public function security_fortigate()
    {
        $data['user'] = $this->_get_user_data();
        $data['title'] = 'Fortigate';
        $data['page'] = 'security_fortigate';
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        // Note: Filesystem shows security files in 'network' folder
        $this->load->view('admin/infrastructure/network/security_fortigate', $data);
        $this->load->view('admin/templates/footer', $data);
    }

    public function security_safeline()
    {
        $data['user'] = $this->_get_user_data();
        $data['title'] = 'Safe Line';
        $data['page'] = 'security_safeline';
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        // Note: Filesystem shows security files in 'network' folder
        $this->load->view('admin/infrastructure/network/security_safeline', $data);
        $this->load->view('admin/templates/footer', $data);
    }

    // =====================================================
    // Infrastructure - Satellite
    // =====================================================

    public function satellite_starlink()
    {
        $data['user'] = $this->_get_user_data();
        $data['title'] = 'Starlink';
        $data['page'] = 'satellite_starlink';
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/infrastructure/satelite/satellite_starlink', $data);
        $this->load->view('admin/templates/footer', $data);
    }

    public function satellite_broadcast_audio()
    {
        $data['user'] = $this->_get_user_data();
        $data['title'] = 'Broadcast Audio';
        $data['page'] = 'satellite_broadcast_audio';
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/infrastructure/satelite/satellite_broadcast_audio', $data);
        $this->load->view('admin/templates/footer', $data);
    }

    /**
     * Audit Log
     */
    public function audit()
    {
        // Admin Only
        if ($this->session->userdata('role') !== 'admin') show_error('Unauthorized', 403);

        $data['title'] = 'Audit Log';
        $data['page'] = 'audit';
        $data['user'] = $this->_get_user_data();

        // Get logs
        $raw_logs = $this->Audit_model->get_all(500); // Limit 500
        
        // Map to View Format
        $data['logs'] = array_map(function($log) {
            return [
                'time' => $log['created_at'],
                'user' => $log['username'] ?? 'System',
                'action' => strtoupper($log['action']),
                'details' => $log['details'],
                'ip' => $log['ip_address']
            ];
        }, $raw_logs);
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/audit', $data);
        $this->load->view('admin/templates/footer', $data);
    }



    private function _generate_vpn_ip_data()
    {
        $data = [];
        
        // 1. TERHUBUNG (CONNECTED) - From Image 1 (Yellow)
        // Headers: No, Satker, Username, Password, ISP Satker, IP VPN, IP LAN Satker, ISP VPN Pusat, SNMP, Keterangan
        $connected = [
            [
                'satker' => 'LPP RRI Entikong',
                'username' => '', 'password' => '',
                'isp_satker' => 'DSCPC', 'ip_vpn' => '', 'ip_lan' => '10.115.1.0/24',
                'isp_pusat' => '', 'snmp' => 'entikong', 'keterangan' => 'ONLINE DSCPC'
            ],
            [
                'satker' => 'LPP RRI Tahuna',
                'username' => 'RRI TAHUNA', 'password' => 'lpprri45',
                'isp_satker' => 'DSCPC', 'ip_vpn' => '172.16.3.45', 'ip_lan' => '192.168.85.0/24',
                'isp_pusat' => '', 'snmp' => 'tahuna', 'keterangan' => 'ONLINE DSCPC'
            ],
            [
                'satker' => 'LPP RRI Wamena',
                'username' => '', 'password' => '',
                'isp_satker' => 'DSCPC', 'ip_vpn' => '', 'ip_lan' => '10.88.1.0/24',
                'isp_pusat' => '', 'snmp' => 'wamena', 'keterangan' => 'ONLINE DSCPC'
            ],
            [
                'satker' => 'LPP RRI Boven Digoel',
                'username' => '', 'password' => '',
                'isp_satker' => 'DSCPC', 'ip_vpn' => '', 'ip_lan' => '10.108.1.0/24',
                'isp_pusat' => '', 'snmp' => 'bovendigoel', 'keterangan' => 'ONLINE DSCPC'
            ]
        ];

        // 2. BELUM TERHUBUNG (NO CONNECTED) - Data from Image
        $not_connected = [
            // Row 1-18 (Multi Channel Format)
            ['satker' => 'LPP RRI Meulaboh', 'u_pro1' => 'PRO 1 RRI MEULABOH', 'u_pro2' => 'PRO 2 RRI MEULABOH', 'u_pro4' => '', 'password' => 'lpprri45', 'isp_astinet' => true, 'isp_dscpc' => false, 'isp_hsp' => false, 'status' => 'NO CONNECTED', 'pic' => 'Achmad Sulaeman'],
            ['satker' => 'LPP RRI Takengon', 'u_pro1' => 'PRO 1 RRI TAKENGON', 'u_pro2' => 'PRO 2 RRI TAKENGON', 'u_pro4' => '', 'password' => 'lpprri45', 'isp_astinet' => true, 'isp_dscpc' => false, 'isp_hsp' => false, 'status' => 'NO CONNECTED', 'pic' => 'Achmad Sulaeman'],
            ['satker' => 'LPP RRI Jambi', 'u_pro1' => 'PRO 1 RRI JAMBI', 'u_pro2' => 'PRO 2 RRI JAMBI', 'u_pro4' => 'PRO 4 RRI JAMBI', 'password' => 'lpprri45', 'isp_astinet' => true, 'isp_dscpc' => false, 'isp_hsp' => false, 'status' => 'NO CONNECTED', 'pic' => 'Achmad Sulaeman'],
            ['satker' => 'LPP RRI Tanjung Pinang', 'u_pro1' => 'PRO 1 RRI TANJUNG PINANG', 'u_pro2' => 'PRO 2 RRI TANJUNG PINANG', 'u_pro4' => 'PRO 4 TANJUNG PINANG', 'password' => 'lpprri45', 'isp_astinet' => true, 'isp_dscpc' => false, 'isp_hsp' => false, 'status' => 'NO CONNECTED', 'pic' => 'Achmad Sulaeman'],
            ['satker' => 'LPP RRI Ranai', 'u_pro1' => 'PRO 1 RRI RANAI', 'u_pro2' => 'PRO 2 RRI RANAI', 'u_pro4' => '', 'password' => 'lpprri45', 'isp_astinet' => true, 'isp_dscpc' => false, 'isp_hsp' => false, 'status' => 'NO CONNECTED', 'pic' => 'Achmad Sulaeman'],
            ['satker' => 'LPP RRI Sungailiat', 'u_pro1' => 'PRO 1 RRI SUNGAI LIAT', 'u_pro2' => 'PRO 2 RRI SUNGAI LIAT', 'u_pro4' => '', 'password' => 'lpprri45', 'isp_astinet' => true, 'isp_dscpc' => false, 'isp_hsp' => false, 'status' => 'NO CONNECTED', 'pic' => 'Achmad Sulaeman'],
            ['satker' => 'LPP RRI Madiun', 'u_pro1' => 'PRO 1 RRI MADIUN', 'u_pro2' => 'PRO 2 RRI MADIUN', 'u_pro4' => '', 'password' => 'lpprri45', 'isp_astinet' => true, 'isp_dscpc' => false, 'isp_hsp' => false, 'status' => 'NO CONNECTED', 'pic' => 'Achmad Sulaeman'],
            ['satker' => 'LPP RRI Sintang', 'u_pro1' => 'PRO 1 RRI SINTANG', 'u_pro2' => 'PRO 2 RRI SINTANG', 'u_pro4' => '', 'password' => 'lpprri45', 'isp_astinet' => true, 'isp_dscpc' => false, 'isp_hsp' => false, 'status' => 'NO CONNECTED', 'pic' => 'Achmad Sulaeman'],
            ['satker' => 'LPP RRI Entikong', 'u_pro1' => '', 'u_pro2' => '', 'u_pro4' => '', 'password' => 'lpprri45', 'isp_astinet' => false, 'isp_dscpc' => true, 'isp_hsp' => false, 'status' => 'NO CONNECTED', 'pic' => 'Achmad Sulaeman'],
            ['satker' => 'LPP RRI Tahuna', 'u_pro1' => '', 'u_pro2' => '', 'u_pro4' => '', 'password' => 'lpprri45', 'isp_astinet' => false, 'isp_dscpc' => true, 'isp_hsp' => false, 'status' => 'NO CONNECTED', 'pic' => 'Achmad Sulaeman'],
            ['satker' => 'LPP RRI Jayapura', 'u_pro1' => 'PRO 1 RRI JAYAPURA', 'u_pro2' => 'PRO 2 RRI JAYAPURA', 'u_pro4' => 'PRO 4 JAYAPURA', 'password' => 'lpprri45', 'isp_astinet' => true, 'isp_dscpc' => false, 'isp_hsp' => false, 'status' => 'NO CONNECTED', 'pic' => 'Achmad Sulaeman'],
            ['satker' => 'LPP RRI Merauke', 'u_pro1' => 'PRO 1 RRI MERAUKE', 'u_pro2' => 'PRO 2 RRI MERAUKE', 'u_pro4' => '', 'password' => 'lpprri45', 'isp_astinet' => true, 'isp_dscpc' => false, 'isp_hsp' => false, 'status' => 'NO CONNECTED', 'pic' => 'Achmad Sulaeman'],
            ['satker' => 'LPP RRI Nabire', 'u_pro1' => 'PRO 1 RRI NABIRE', 'u_pro2' => 'PRO 2 RRI NABIRE', 'u_pro4' => '', 'password' => 'lpprri45', 'isp_astinet' => true, 'isp_dscpc' => false, 'isp_hsp' => false, 'status' => 'NO CONNECTED', 'pic' => 'Achmad Sulaeman'],
            ['satker' => 'LPP RRI Wamena', 'u_pro1' => '', 'u_pro2' => '', 'u_pro4' => '', 'password' => 'lpprri45', 'isp_astinet' => false, 'isp_dscpc' => true, 'isp_hsp' => false, 'status' => 'NO CONNECTED', 'pic' => 'Achmad Sulaeman'],
            ['satker' => 'LPP RRI Serui', 'u_pro1' => 'PRO 1 RRI SERUI', 'u_pro2' => 'PRO 2 RRI SERUI', 'u_pro4' => '', 'password' => 'lpprri45', 'isp_astinet' => true, 'isp_dscpc' => false, 'isp_hsp' => false, 'status' => 'NO CONNECTED', 'pic' => 'Randy Phoa'],
            ['satker' => 'LPP RRI Boven Digoel', 'u_pro1' => '', 'u_pro2' => '', 'u_pro4' => '', 'password' => 'lpprri45', 'isp_astinet' => false, 'isp_dscpc' => true, 'isp_hsp' => false, 'status' => 'NO CONNECTED', 'pic' => 'Randy Phoa'],
            ['satker' => 'LPP RRI Mamuju', 'u_pro1' => 'PRO 1 RRI MAMUJU', 'u_pro2' => 'PRO 2 RRI MAMUJU', 'u_pro4' => '', 'password' => 'lpprri45', 'isp_astinet' => true, 'isp_dscpc' => false, 'isp_hsp' => false, 'status' => 'NO CONNECTED', 'pic' => 'Randy Phoa'],
            ['satker' => 'LPP RRI Fak-fak', 'u_pro1' => 'PRO 1 RRI FAK-FAK', 'u_pro2' => 'PRO 2 RRI FAK-FAK', 'u_pro4' => '', 'password' => 'lpprri45', 'isp_astinet' => true, 'isp_dscpc' => false, 'isp_hsp' => false, 'status' => 'NO CONNECTED', 'pic' => 'Randy Phoa'],

            // Single Channel (SP)
            ['satker' => 'LPP RRI Aceh Singkil', 'u_single' => 'SP ACEH SINGKIL', 'password' => 'lpprri45', 'isp_astinet' => true, 'isp_dscpc' => false, 'isp_hsp' => false, 'status' => 'NO CONNECTED', 'pic' => 'Randy Phoa'],
            ['satker' => 'LPP RRI Ampana', 'u_single' => 'SP AMPANA', 'password' => 'lpprri45', 'isp_astinet' => true, 'isp_dscpc' => false, 'isp_hsp' => false, 'status' => 'NO CONNECTED', 'pic' => 'Randy Phoa'],
            ['satker' => 'LPP RRI Bau-bau', 'u_single' => 'SP BAU-BAU', 'password' => 'lpprri45', 'isp_astinet' => true, 'isp_dscpc' => false, 'isp_hsp' => false, 'status' => 'NO CONNECTED', 'pic' => 'Randy Phoa'],
            ['satker' => 'LPP RRI Belitung', 'u_single' => 'SP BELITUNG', 'password' => 'lpprri45', 'isp_astinet' => true, 'isp_dscpc' => false, 'isp_hsp' => false, 'status' => 'NO CONNECTED', 'pic' => 'Randy Phoa'],
            ['satker' => 'LPP RRI Bengkalis', 'u_single' => 'SP BENGKALIS', 'password' => 'lpprri45', 'isp_astinet' => true, 'isp_dscpc' => false, 'isp_hsp' => false, 'status' => 'NO CONNECTED', 'pic' => 'Randy Phoa'],
            ['satker' => 'LPP RRI Bima', 'u_single' => 'SP BIMA', 'password' => 'lpprri45', 'isp_astinet' => true, 'isp_dscpc' => false, 'isp_hsp' => false, 'status' => 'NO CONNECTED', 'pic' => 'Randy Phoa'],
            ['satker' => 'LPP RRI Bula', 'u_single' => 'SP BULA', 'password' => 'lpprri45', 'isp_astinet' => true, 'isp_dscpc' => false, 'isp_hsp' => false, 'status' => 'NO CONNECTED', 'pic' => 'Randy Phoa'],
            ['satker' => 'LPP RRI Kaimana', 'u_single' => 'SP KAIMANA', 'password' => 'lpprri45', 'isp_astinet' => true, 'isp_dscpc' => false, 'isp_hsp' => false, 'status' => 'NO CONNECTED', 'pic' => 'Randy Phoa'],
            ['satker' => 'LPP RRI Bintuhan', 'u_single' => 'SP BINTUHAN', 'password' => 'lpprri45', 'isp_astinet' => true, 'isp_dscpc' => false, 'isp_hsp' => false, 'status' => 'NO CONNECTED', 'pic' => 'Randy Phoa'],
            ['satker' => 'LPP RRI Kediri', 'u_single' => 'SP KEDIRI', 'password' => 'lpprri45', 'isp_astinet' => true, 'isp_dscpc' => false, 'isp_hsp' => false, 'status' => 'NO CONNECTED', 'pic' => 'Randy Phoa']
        ];

        // Add numbering to not_connected
        foreach ($not_connected as $k => &$v) {
            $v['no'] = $k + 1;
            // Default empty fields if not set
            if(!isset($v['u_single'])) $v['u_single'] = null;
            if(!isset($v['u_pro1'])) $v['u_pro1'] = '';
            if(!isset($v['u_pro2'])) $v['u_pro2'] = '';
            if(!isset($v['u_pro4'])) $v['u_pro4'] = '';
        }

        return [
            'connected' => $connected,
            'not_connected' => $not_connected
        ];
    }

    private function _get_user_data()
    {
        // If we strictly want database data, fetch it.
        // But session data is usually enough. For Avatar we might need to be sure.
        // Let's use session, it's faster. Avatar is in session.
        return [
            'id' => $this->session->userdata('user_id'),
            'username' => $this->session->userdata('username'),
            'role' => $this->session->userdata('role'),
            'role_name' => $this->session->userdata('role_name'),
            'avatar' => $this->session->userdata('avatar') ?? 'default_avatar.png'
        ];
    }
}
