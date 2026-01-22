<?php
/**
 * =====================================================
 * Auth Controller
 * =====================================================
 * 
 * Controller untuk autentikasi pengguna.
 * 
 * @package     CSIRT RRI
 * @subpackage  Controllers
 * @category    Authentication
 * @author      Tim Teknologi Media Baru
 * 
 * Komentar Kritikal:
 * - SEMUA proses login HARUS dicatat di audit log
 * - Password HARUS di-hash menggunakan bcrypt
 * - Session HARUS di-regenerate setelah login berhasil
 * - Implementasi rate limiting untuk mencegah brute force
 * =====================================================
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    /**
     * Constructor
     * Load model dan library yang diperlukan
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('User_model');
        $this->load->model('Audit_model');
    }

    /**
     * Halaman Login
     */
    public function login()
    {
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }

        $data['title'] = 'Login';
        $data['error'] = $this->session->flashdata('error');
        $data['success'] = $this->session->flashdata('success');
        
        $this->load->view('auth/login', $data);
    }

    /**
     * Proses Autentikasi
     */
    public function authenticate()
    {
        // Validasi
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('username', 'Username', 'required|trim', [
            'required' => 'Username harus diisi.'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required', [
            'required' => 'Password harus diisi.'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors('<li>', '</li>')); // Capture specific errors
            redirect('auth/login');
            return;
        }

        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password');

        // Check Login
        $user = $this->User_model->login($username, $password);

        if ($user) {
             // Block access if inactive? (If status column exists. For now assuming all users in DB are active)
            
            // Regenerate session
            $this->session->sess_regenerate(TRUE);
            
            // Set session data
            $sess_data = [
                'user_id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role'],
                'role_name' => ucfirst($user['role']), // Display nicety
                'logged_in' => TRUE,
                'login_time' => time(),
                'avatar' => $user['avatar'] ?? 'default_avatar.png'
            ];
            $this->session->set_userdata($sess_data);

            // Audit Log
            $this->Audit_model->log('login', 'User logged in successfully', $user['id']);

            redirect('dashboard');
        } else {
            // Audit Log (Failed)
            // Need to log without ID or with '0'
            $this->Audit_model->log('login_failed', "Failed login attempt for username: $username", 0);

            $this->session->set_flashdata('error', 'Username atau password salah.');
            redirect('auth/login');
        }
    }

    /**
     * Logout
     */
    public function logout()
    {
        // Audit Log
        if ($this->session->userdata('logged_in')) {
            $this->Audit_model->log('logout', 'User logged out');
        }

        // Destroy session
        $this->session->sess_destroy();
        
        redirect('auth/login');
    }
}
