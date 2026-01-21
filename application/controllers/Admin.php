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
     * User Management CRUD
     */
    public function user_create()
    {
        $data['title'] = 'Tambah Pengguna';
        $data['page'] = 'users'; // Keep 'users' active in sidebar
        $data['user'] = $this->_get_user_data();
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/users/create', $data);
        $this->load->view('admin/templates/footer', $data);
    }

    public function user_store()
    {
        // Mock storage logic
        // In real app: $this->User_model->create($this->input->post());
        
        $this->session->set_flashdata('success', 'Pengguna berhasil ditambahkan!');
        redirect('admin/users');
    }

    public function user_edit($id)
    {
        $data['title'] = 'Edit Pengguna';
        $data['page'] = 'users';
        $data['user'] = $this->_get_user_data();
        
        // Mock fetching user data based on ID
        $data['user_edit'] = [
            'id' => $id, 
            'username' => 'user_mock_' . $id, 
            'email' => 'user' . $id . '@rri.co.id', 
            'role' => 'user', 
            'status' => 'active', 
            'full_name' => 'User Mock ' . $id
        ];
        
        // Override with some specific dummy data if ID matches standard dummies
        if ($id == 1) $data['user_edit'] = ['id' => 1, 'username' => 'admin', 'email' => 'admin@rri.co.id', 'role' => 'admin', 'status' => 'active', 'full_name' => 'Administrator'];
        if ($id == 2) $data['user_edit'] = ['id' => 2, 'username' => 'analyst1', 'email' => 'analyst1@rri.co.id', 'role' => 'analyst', 'status' => 'active', 'full_name' => 'Security Analyst 1'];
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/users/edit', $data);
        $this->load->view('admin/templates/footer', $data);
    }

    public function user_update($id)
    {
        // Mock update logic
        // In real app: $this->User_model->update($id, $this->input->post());
        
        $this->session->set_flashdata('success', 'Data pengguna berhasil diperbarui!');
        redirect('admin/users');
    }

    public function user_delete($id)
    {
        // Mock delete logic
        // In real app: $this->User_model->delete($id);
        
        $this->session->set_flashdata('success', 'Pengguna berhasil dihapus!');
        redirect('admin/users');
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
        $data['page'] = 'ip_management'; // Set active page for sidebar
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data); // Pass data to sidebar

        $all_ip_data = $this->_generate_public_ips();

        // If no region selected, show dashboard with summary data
        if (!$region) {
            $data['title'] = 'Manajemen IP Address';
            
            // Calculate summaries for the dashboard
            $summary = [];
            $total_ips = 0;
            $used_ips = 0;

            foreach ($all_ip_data as $key => $region_data) {
                $region_total = count($region_data['ips']);
                $region_used = 0;
                foreach ($region_data['ips'] as $ip) {
                    if (!empty($ip['description']) || (isset($ip['type']) && $ip['type'] === 'gateway')) {
                        $region_used++;
                    }
                }

                $summary[$key] = [
                    'name' => $region_data['name'],
                    'cidr' => $region_data['cidr'],
                    'total' => $region_total,
                    'used' => $region_used,
                    'free' => $region_total - $region_used,
                    'usage_percent' => ($region_total > 0) ? round(($region_used / $region_total) * 100) : 0
                ];

                $total_ips += $region_total;
                $used_ips += $region_used;
            }

            $data['regions'] = $summary;
            $data['global_stats'] = [
                'total_ips' => $total_ips,
                'used_ips' => $used_ips,
                'free_ips' => $total_ips - $used_ips,
                'usage_percent' => ($total_ips > 0) ? round(($used_ips / $total_ips) * 100) : 0,
                'total_networks' => count($summary)
            ];

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
        $data['networks'] = $this->_get_networks();

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/ip/ip_management/networks/index', $data);
        $this->load->view('admin/templates/footer', $data);
    }

    public function network_create()
    {
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
        $networks = $this->_get_networks();
        $id = $this->input->post('id'); // slug
        
        if(isset($networks[$id])) {
            $this->session->set_flashdata('error', 'ID Network sudah ada!');
            redirect('admin/ip_management/network_create');
        }

        $networks[$id] = [
            'id' => $id,
            'name' => $this->input->post('name'),
            'cidr' => $this->input->post('cidr'),
            'range_start' => $this->input->post('range_start'),
            'range_end' => $this->input->post('range_end'),
            'subnet_mask' => $this->input->post('subnet_mask'),
            'description' => $this->input->post('description'),
            'is_reserve' => $this->input->post('is_reserve') ? true : false
        ];

        $this->_save_networks($networks);
        $this->session->set_flashdata('success', 'Network berhasil ditambahkan!');
        redirect('admin/ip_management/networks');
    }

    public function network_edit($id)
    {
        $networks = $this->_get_networks();
        if(!isset($networks[$id])) show_404();

        $data['title'] = 'Edit Network';
        $data['page'] = 'ip_management';
        $data['user'] = $this->_get_user_data();
        $data['network'] = $networks[$id];
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/ip/ip_management/networks/form', $data);
        $this->load->view('admin/templates/footer', $data);
    }

    public function network_update($id)
    {
        $networks = $this->_get_networks();
        if(!isset($networks[$id])) show_404();

        // Update fields (ID logic preserved as key)
        $networks[$id]['name'] = $this->input->post('name');
        $networks[$id]['cidr'] = $this->input->post('cidr');
        $networks[$id]['range_start'] = $this->input->post('range_start');
        $networks[$id]['range_end'] = $this->input->post('range_end');
        $networks[$id]['subnet_mask'] = $this->input->post('subnet_mask');
        $networks[$id]['description'] = $this->input->post('description');
        $networks[$id]['is_reserve'] = $this->input->post('is_reserve') ? true : false;

        $this->_save_networks($networks);
        $this->session->set_flashdata('success', 'Data Network berhasil diperbarui!');
        redirect('admin/ip_management/networks');
    }

    public function network_delete($id)
    {
        $networks = $this->_get_networks();
        if(isset($networks[$id])) {
            unset($networks[$id]);
            $this->_save_networks($networks);
            $this->session->set_flashdata('success', 'Network berhasil dihapus!');
        }
        redirect('admin/ip_management/networks');
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
        return [
            'id' => $this->session->userdata('user_id'),
            'username' => $this->session->userdata('username'),
            'role' => $this->session->userdata('role'),
            'role_name' => $this->session->userdata('role_name')
        ];
    }
}
