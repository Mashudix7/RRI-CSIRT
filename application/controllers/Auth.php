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
        // $this->load->model('User_model'); // Akan diaktifkan setelah model dibuat
        // $this->load->model('Audit_log_model'); // Akan diaktifkan setelah model dibuat
    }

    /**
     * Halaman Login
     * 
     * Komentar:
     * - Jika user sudah login, redirect ke dashboard
     * - Form submit akan dihandle oleh method authenticate()
     */
    public function login()
    {
        // Redirect jika sudah login
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
     * 
     * Komentar Kritikal:
     * - Validasi input WAJIB dilakukan
     * - Password comparison menggunakan password_verify()
     * - Regenerate session ID setelah login berhasil
     * - Catat SEMUA attempt login (berhasil/gagal) ke audit log
     */
    public function authenticate()
    {
        // Validasi CSRF
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Username dan password harus diisi.');
            redirect('auth/login');
            return;
        }

        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password');

        // TODO: Implementasi setelah User_model dibuat
        // $user = $this->User_model->get_by_username($username);
        
        // DEMO: Login dummy untuk testing UI
        // HAPUS blok ini setelah model diimplementasikan
        if ($username === 'admin' && $password === 'admin123') {
            // Regenerate session untuk keamanan
            $this->session->sess_regenerate(TRUE);
            
            // Set session data
            $this->session->set_userdata([
                'user_id' => 1,
                'username' => 'admin',
                'role' => 'admin',
                'role_name' => 'Admin CSIRT',
                'logged_in' => TRUE,
                'login_time' => time()
            ]);

            // TODO: Catat ke audit log
            // $this->Audit_log_model->log('login', 'User logged in successfully');

            redirect('dashboard');
            return;
        }

        // Login gagal
        // TODO: Catat ke audit log (failed attempt)
        $this->session->set_flashdata('error', 'Username atau password salah.');
        redirect('auth/login');
    }

    /**
     * Logout
     * 
     * Komentar Kritikal:
     * - Destroy session SEPENUHNYA
     * - Catat ke audit log sebelum destroy
     */
    public function logout()
    {
        // TODO: Catat ke audit log sebelum destroy session
        // $this->Audit_log_model->log('logout', 'User logged out');

        // Destroy session
        $this->session->sess_destroy();
        
        $this->session->set_flashdata('success', 'Anda telah berhasil logout.');
        redirect('auth/login');
    }
}
