<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        // Security Headers
        $this->output->set_header('X-Frame-Options: SAMEORIGIN');
        $this->output->set_header('X-Content-Type-Options: nosniff');
        $this->output->set_header('X-XSS-Protection: 1; mode=block');
        $this->output->set_header('Referrer-Policy: strict-origin-when-cross-origin');
        // HSTS (Enable in production with valid SSL)
        // $this->output->set_header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
    }
}

class Admin_Controller extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        // Load common libraries and models
        $this->load->library(['session', 'form_validation']);
        $this->load->helper(['url', 'form', 'security']);
        $this->load->model('User_model');
        $this->load->model('Audit_log_model');

        // Check login status
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }

    /**
     * Helper to render admin views with standard layout
     */
    protected function render_admin($view, $data = [])
    {
        // Get current user data for the layout (navbar/sidebar)
        $data['current_user'] = $this->_get_user_data();

        // Load partials
        $this->load->view('admin/templates/header', $data); // Note: Admin header might need updates if it doesn't use $title well
        $this->load->view('admin/templates/sidebar', $data);
        // Topbar might be redundant if Sidebar handles it or included in header
        $this->load->view($view, $data);
        $this->load->view('admin/templates/footer');
    }

    /**
     * Check role access
     */
    protected function _check_role_access($allowed_roles)
    {
        $user_role = $this->session->userdata('role');
        if (!in_array($user_role, $allowed_roles)) {
            $this->session->set_flashdata('error', 'Anda tidak memiliki akses ke halaman tersebut.');
            redirect('admin/dashboard'); 
        }
    }

    /**
     * Get fresh user data
     */
    protected function _get_user_data()
    {
        $user_id = $this->session->userdata('user_id');
        $user = $this->User_model->get_by_id($user_id);
        
        // Add default photo if missing (logic copied from views)
        if (empty($user['photo'])) {
            $user['username'] = $user['username'] ?? 'User'; // Fallback
            $user['photo_url'] = "https://ui-avatars.com/api/?name=" . urlencode($user['username']) . "&background=random";
        } else {
            $user['photo_url'] = base_url($user['photo']);
        }
        
        return $user;
    }
}
