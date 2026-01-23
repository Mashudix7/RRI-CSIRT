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
        
        // Data user dari session
        $data['user'] = [
            'id' => $this->session->userdata('user_id'),
            'username' => $this->session->userdata('username'),
            'role' => $this->session->userdata('role'),
            'role_name' => $this->session->userdata('role_name')
        ];
        
        // Load WAF Model
        $this->load->model('Waf_model');
        
        // Fetch Real-time Stats from Safeline WAF
        $waf_data = $this->Waf_model->get_daily_stats();
        $waf_events = $this->Waf_model->get_daily_events(30);
        
        $data['stats'] = $waf_data['summary'];
        $data['attack_stats'] = $waf_data['types'];
        $data['recent_logs'] = $waf_data['recent'];
        $data['recent_events'] = $waf_events;
        
        /* 
        // Example Data Structure from API:
        $data['recent_threats'] = [
            [
                "site_uuid" => "43",
                "src_ip" => "180.243.39.165",
                "host" => "jdih.rri.go.id",
                "url_path" => "/common/dokumen/abs2022kp2090.pdf",
                "country" => "ID",
                "city" => "Sidoarjo",
                "action" => 0, // 0: Detected/Log, 1: Block?
                "module" => "m_php_unserialize",
                "attack_type" => 6,
                "timestamp" => 1769134553
            ]
        ];
        */
        
        // Load views
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('admin/templates/footer', $data);
    }
}
