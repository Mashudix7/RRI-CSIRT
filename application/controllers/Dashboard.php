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
        
        // Attack Data Stats
        $data['stats'] = [
            'total_attacks' => 1245,
            'blocked_attacks' => 1240,
            'active_threats' => 5,
            'protection_level' => '99.6%'
        ];
        
        // Attack Types Distribution
        $data['attack_stats'] = [
            'ddos' => 450,
            'malware' => 230,
            'phishing' => 320,
            'intrusion' => 245
        ];

        // Recent Threats
        $data['recent_threats'] = [
            [
                'id' => 1,
                'type' => 'DDoS Attack',
                'source' => '192.168.1.105',
                'target' => 'Web Server',
                'status' => 'blocked',
                'timestamp' => '2026-01-21 14:30:00',
                'severity' => 'critical'
            ],
            [
                'id' => 2,
                'type' => 'SQL Injection',
                'source' => '10.0.0.50',
                'target' => 'Database',
                'status' => 'blocked',
                'timestamp' => '2026-01-21 13:15:00',
                'severity' => 'high'
            ],
            [
                'id' => 3,
                'type' => 'Malware Download',
                'source' => 'Internal PC',
                'target' => 'Gateway',
                'status' => 'quarantined',
                'timestamp' => '2026-01-21 11:45:00',
                'severity' => 'medium'
            ],
            [
                'id' => 4,
                'type' => 'Port Scanning',
                'source' => 'Unknown',
                'target' => 'Firewall',
                'status' => 'detected',
                'timestamp' => '2026-01-21 09:20:00',
                'severity' => 'low'
            ]
        ];
        
        // Load views
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('admin/templates/footer', $data);
    }
}
