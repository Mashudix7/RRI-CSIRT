<?php
/**
 * =====================================================
 * Dashboard Controller
 * =====================================================
 * 
 * Controller untuk dashboard admin CSIRT.
 * Memerlukan autentikasi.
 * 
 * @package     CSIRT RRI
 * @subpackage  Controllers
 * @category    Dashboard
 * @author      Tim Teknologi Media Baru
 * 
 * Komentar Kritikal:
 * - SEMUA method di sini memerlukan user yang sudah login
 * - Akses ke dashboard dicek di constructor
 * - Data statistik harus di-query secara efisien
 * =====================================================
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    /**
     * Constructor
     * 
     * Komentar Kritikal:
     * - Pengecekan session di constructor untuk proteksi seluruh controller
     * - User yang tidak login akan di-redirect ke halaman login
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        
        // Proteksi: Cek apakah user sudah login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }

        $this->load->database();
    }

    /**
     * Halaman Utama Dashboard
     * 
     * Komentar:
     * - Menampilkan statistik overview insiden
     * - Data dummy sementara, akan diganti dengan query database
     */
    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['page'] = 'dashboard';
        
        // Data user from session
        $data['user'] = [
            'id' => $this->session->userdata('user_id'),
            'username' => $this->session->userdata('username'),
            'role' => $this->session->userdata('role'),
            'role_name' => $this->session->userdata('role_name')
        ];
        
        // Mock data for dashboard overview
        $data['stats'] = [
            'total_incidents' => 0,
            'resolved_incidents' => 0,
            'pending_incidents' => 0
        ];
        $data['attack_stats'] = [];
        $data['recent_threats'] = [];
        
        // Load views
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('admin/templates/footer', $data);
    }
}
