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
        
        // Data user dari session
        $data['user'] = [
            'id' => $this->session->userdata('user_id'),
            'username' => $this->session->userdata('username'),
            'role' => $this->session->userdata('role'),
            'role_name' => $this->session->userdata('role_name')
        ];
        
        // Statistik dummy - akan diganti dengan query database
        $data['stats'] = [
            'total_incidents' => 127,
            'active_incidents' => 8,
            'resolved_today' => 3,
            'avg_response_time' => '45 menit'
        ];
        
        // Insiden terbaru - dummy data
        $data['recent_incidents'] = [
            [
                'id' => 1,
                'title' => 'Percobaan akses tidak sah ke server mail',
                'severity' => 'high',
                'status' => 'in_progress',
                'reporter' => 'John Doe',
                'created_at' => '2026-01-20 07:30:00'
            ],
            [
                'id' => 2,
                'title' => 'Malware terdeteksi pada workstation IT',
                'severity' => 'critical',
                'status' => 'validated',
                'reporter' => 'Jane Smith',
                'created_at' => '2026-01-20 06:15:00'
            ],
            [
                'id' => 3,
                'title' => 'Phishing email ditemukan di inbox publik',
                'severity' => 'medium',
                'status' => 'reported',
                'reporter' => 'Bob Wilson',
                'created_at' => '2026-01-19 16:45:00'
            ],
            [
                'id' => 4,
                'title' => 'Update keamanan tertunda pada server web',
                'severity' => 'low',
                'status' => 'closed',
                'reporter' => 'Admin',
                'created_at' => '2026-01-19 14:20:00'
            ]
        ];
        
        // Statistik per severity
        $data['severity_stats'] = [
            'critical' => 2,
            'high' => 5,
            'medium' => 12,
            'low' => 8
        ];
        
        // Load views
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('admin/templates/footer', $data);
    }
}
