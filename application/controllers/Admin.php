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
        $this->load->helper('url');
        $this->load->library('session');
        
        // Proteksi: Cek login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        
        // Proteksi: Cek role admin
        // Komentar Kritikal: Role check - hanya admin yang boleh akses
        $role = $this->session->userdata('role');
        if ($role !== 'admin') {
            // Redirect ke dashboard jika bukan admin
            redirect('dashboard');
        }
    }

    /**
     * User Management
     */
    public function users($action = 'index', $id = null)
    {
        $data['title'] = 'Manajemen Pengguna';
        $data['page'] = 'users';
        $data['user'] = $this->_get_user_data();
        
        // Dummy users
        $data['users'] = [
            ['id' => 1, 'username' => 'admin', 'email' => 'admin@rri.co.id', 'role' => 'admin', 'status' => 'active', 'last_login' => '2026-01-20 08:30:00'],
            ['id' => 2, 'username' => 'analyst1', 'email' => 'analyst1@rri.co.id', 'role' => 'analyst', 'status' => 'active', 'last_login' => '2026-01-19 14:20:00'],
            ['id' => 3, 'username' => 'reporter1', 'email' => 'reporter1@rri.co.id', 'role' => 'reporter', 'status' => 'active', 'last_login' => '2026-01-18 09:15:00'],
            ['id' => 4, 'username' => 'auditor1', 'email' => 'auditor1@rri.co.id', 'role' => 'auditor', 'status' => 'inactive', 'last_login' => '2026-01-10 11:00:00'],
        ];
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/users', $data);
        $this->load->view('admin/templates/footer', $data);
    }

    /**
     * Article Management
     */
    public function articles($action = 'index', $id = null)
    {
        $data['title'] = 'Manajemen Artikel';
        $data['page'] = 'articles';
        $data['user'] = $this->_get_user_data();
        
        // Dummy articles
        $data['articles'] = [
            ['id' => 1, 'title' => 'Panduan Keamanan Password', 'category' => 'Keamanan', 'status' => 'published', 'author' => 'Admin', 'date' => '2026-01-20'],
            ['id' => 2, 'title' => 'Cara Mengenali Email Phishing', 'category' => 'Panduan', 'status' => 'published', 'author' => 'Admin', 'date' => '2026-01-18'],
            ['id' => 3, 'title' => 'Update Sistem Q1 2026', 'category' => 'Pengumuman', 'status' => 'draft', 'author' => 'Admin', 'date' => '2026-01-15'],
        ];
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/articles', $data);
        $this->load->view('admin/templates/footer', $data);
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
            'total_incidents' => 156,
            'resolved' => 142,
            'pending' => 14,
            'avg_resolution_time' => '4.2 jam'
        ];
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/reports', $data);
        $this->load->view('admin/templates/footer', $data);
    }

    /**
     * Audit Log
     */
    public function audit()
    {
        $data['title'] = 'Audit Log';
        $data['page'] = 'audit';
        $data['user'] = $this->_get_user_data();
        
        // Dummy audit logs
        $data['logs'] = [
            ['id' => 1, 'user' => 'admin', 'action' => 'LOGIN', 'details' => 'Login berhasil', 'ip' => '192.168.1.100', 'time' => '2026-01-20 08:30:00'],
            ['id' => 2, 'user' => 'admin', 'action' => 'UPDATE_INCIDENT', 'details' => 'Mengubah status insiden #5', 'ip' => '192.168.1.100', 'time' => '2026-01-20 08:25:00'],
            ['id' => 3, 'user' => 'analyst1', 'action' => 'CREATE_INCIDENT', 'details' => 'Membuat insiden baru #6', 'ip' => '192.168.1.105', 'time' => '2026-01-19 16:45:00'],
            ['id' => 4, 'user' => 'admin', 'action' => 'CREATE_USER', 'details' => 'Membuat user baru: reporter2', 'ip' => '192.168.1.100', 'time' => '2026-01-19 10:30:00'],
            ['id' => 5, 'user' => 'reporter1', 'action' => 'LOGIN', 'details' => 'Login berhasil', 'ip' => '192.168.1.110', 'time' => '2026-01-18 09:15:00'],
        ];
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/audit', $data);
        $this->load->view('admin/templates/footer', $data);
    }

    /**
     * Settings
     */
    public function settings()
    {
        $data['title'] = 'Pengaturan';
        $data['page'] = 'settings';
        $data['user'] = $this->_get_user_data();
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/settings', $data);
        $this->load->view('admin/templates/footer', $data);
    }

    /**
     * Team Management
     */
    public function teams($action = 'index', $id = null)
    {
        $data['title'] = 'Manajemen Tim';
        $data['page'] = 'teams';
        $data['user'] = $this->_get_user_data();
        
        // Dummy team data for Tim Teknologi Media Baru
        $data['team_media_baru'] = [
            ['id' => 1, 'name' => 'Ahmad Fauzi', 'position' => 'Kepala Tim Media Baru', 'role' => 'leader', 'order' => 1],
            ['id' => 2, 'name' => 'Siti Rahayu', 'position' => 'Web Dev Lead', 'role' => 'member', 'order' => 2],
            ['id' => 3, 'name' => 'Budi Santoso', 'position' => 'Content Lead', 'role' => 'member', 'order' => 3],
            ['id' => 4, 'name' => 'Dewi Pertiwi', 'position' => 'UI/UX Designer', 'role' => 'member', 'order' => 4],
            ['id' => 5, 'name' => 'Rudi Hermawan', 'position' => 'Web Developer', 'role' => 'member', 'order' => 5],
            ['id' => 6, 'name' => 'Rina Wulandari', 'position' => 'Video Producer', 'role' => 'member', 'order' => 6],
            ['id' => 7, 'name' => 'Agus Prasetyo', 'position' => 'Podcast Manager', 'role' => 'member', 'order' => 7],
            ['id' => 8, 'name' => 'Maya Kusuma', 'position' => 'Social Media', 'role' => 'member', 'order' => 8],
        ];
        
        // Dummy team data for Tim IT
        $data['team_it'] = [
            ['id' => 9, 'name' => 'Hendra Wijaya', 'position' => 'Kepala Tim IT', 'role' => 'leader', 'order' => 1],
            ['id' => 10, 'name' => 'Eko Nugroho', 'position' => 'Infrastructure Lead', 'role' => 'member', 'order' => 2],
            ['id' => 11, 'name' => 'Dian Pratama', 'position' => 'Security Lead', 'role' => 'member', 'order' => 3],
            ['id' => 12, 'name' => 'Fitri Handayani', 'position' => 'Security Analyst', 'role' => 'member', 'order' => 4],
            ['id' => 13, 'name' => 'Gunawan Setiadi', 'position' => 'DBA', 'role' => 'member', 'order' => 5],
            ['id' => 14, 'name' => 'Indra Lesmana', 'position' => 'IT Support', 'role' => 'member', 'order' => 6],
            ['id' => 15, 'name' => 'Joko Widodo', 'position' => 'Cloud Engineer', 'role' => 'member', 'order' => 7],
            ['id' => 16, 'name' => 'Kartika Sari', 'position' => 'DevOps', 'role' => 'member', 'order' => 8],
        ];
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/teams', $data);
        $this->load->view('admin/templates/footer', $data);
    }

    /**
     * IP Address Management
     */
    public function ip_management($action = 'index', $id = null)
    {
        $data['title'] = 'Manajemen IP Address';
        $data['page'] = 'ip_management';
        $data['user'] = $this->_get_user_data();
        
        // Dummy IP data - Local
        $data['ip_local'] = [
            ['id' => 1, 'name' => 'Server Web Utama', 'ip_address' => '192.168.1.10', 'description' => 'Web server utama untuk hosting aplikasi', 'status' => 'active'],
            ['id' => 2, 'name' => 'Database Server', 'ip_address' => '192.168.1.20', 'description' => 'MySQL database server', 'status' => 'active'],
            ['id' => 3, 'name' => 'Backup Server', 'ip_address' => '192.168.1.30', 'description' => 'Server untuk backup data', 'status' => 'active'],
        ];
        
        // Dummy IP data - Private
        $data['ip_private'] = [
            ['id' => 4, 'name' => 'Streaming Server', 'ip_address' => '10.0.1.100', 'description' => 'Server streaming internal', 'status' => 'active'],
            ['id' => 5, 'name' => 'File Server', 'ip_address' => '10.0.1.101', 'description' => 'NAS untuk penyimpanan file', 'status' => 'active'],
            ['id' => 6, 'name' => 'Monitoring Server', 'ip_address' => '10.0.1.102', 'description' => 'Zabbix monitoring', 'status' => 'inactive'],
        ];
        
        // Dummy IP data - VPN
        $data['ip_vpn'] = [
            ['id' => 7, 'name' => 'VPN Gateway Jakarta', 'ip_address' => '203.189.XX.XX', 'description' => 'Gateway VPN kantor pusat', 'status' => 'active'],
            ['id' => 8, 'name' => 'VPN Gateway Bandung', 'ip_address' => '103.123.XX.XX', 'description' => 'Gateway VPN cabang Bandung', 'status' => 'active'],
            ['id' => 9, 'name' => 'VPN Gateway Surabaya', 'ip_address' => '182.253.XX.XX', 'description' => 'Gateway VPN cabang Surabaya', 'status' => 'inactive'],
        ];
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/ip_management', $data);
        $this->load->view('admin/templates/footer', $data);
    }

    private function _get_user_data()
    {
        return [
            'id' => $this->session->userdata('user_id'),
            'username' => $this->session->userdata('username'),
            'role' => $this->session->userdata('role'),
            'role_name' => $this->session->userdata('role_name')
        ];
    }
}
