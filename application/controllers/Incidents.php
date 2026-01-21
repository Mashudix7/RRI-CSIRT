<?php
/**
 * =====================================================
 * Incidents Controller
 * =====================================================
 * 
 * Controller untuk manajemen insiden CSIRT.
 * Memerlukan autentikasi.
 * 
 * @package     CSIRT RRI
 * @subpackage  Controllers
 * @category    Incident Management
 * @author      Tim Teknologi Media Baru
 * 
 * Komentar Kritikal:
 * - SEMUA perubahan status HARUS dicatat di incident_log
 * - SEMUA aksi HARUS dicatat di audit_log
 * - Validasi role sebelum aksi sensitif (update, delete)
 * - File upload HARUS divalidasi secara ketat
 * =====================================================
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Incidents extends CI_Controller {

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        
        // Proteksi: Cek login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }

    /**
     * Daftar Insiden
     */
    public function index()
    {
        $data['title'] = 'Daftar Insiden';
        $data['page'] = 'incidents';
        $data['user'] = $this->_get_user_data();
        
        // Filter dari query string
        $data['filter_status'] = $this->input->get('status');
        $data['filter_severity'] = $this->input->get('severity');
        $data['search'] = $this->input->get('search');
        
        // Dummy data - akan diganti dengan query database
        $data['incidents'] = $this->_get_dummy_incidents();
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/incidents/index', $data);
        $this->load->view('admin/templates/footer', $data);
    }

    /**
     * Form Lapor Insiden Baru
     */
    public function create()
    {
        $data['title'] = 'Lapor Insiden Baru';
        $data['page'] = 'incidents_create';
        $data['user'] = $this->_get_user_data();
        
        // Opsi untuk form
        $data['severity_options'] = [
            'low' => 'Low - Dampak minimal',
            'medium' => 'Medium - Dampak moderat',
            'high' => 'High - Dampak signifikan',
            'critical' => 'Critical - Dampak kritis'
        ];
        
        $data['category_options'] = [
            'malware' => 'Malware/Ransomware',
            'phishing' => 'Phishing',
            'unauthorized_access' => 'Akses Tidak Sah',
            'data_breach' => 'Kebocoran Data',
            'ddos' => 'DDoS Attack',
            'defacement' => 'Website Defacement',
            'other' => 'Lainnya'
        ];
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/incidents/create', $data);
        $this->load->view('admin/templates/footer', $data);
    }

    /**
     * Simpan Insiden Baru
     */
    public function store()
    {
        // Validasi CSRF otomatis via Security class
        
        // Ambil data dari form
        $title = $this->input->post('title');
        $category = $this->input->post('category');
        $severity = $this->input->post('severity');
        $description = $this->input->post('description');
        $source = $this->input->post('source');
        
        // TODO: Simpan ke database
        // Untuk saat ini hanya dummy logic
        
        // Simpan flashdata untuk notifikasi sukses
        // $this->session->set_flashdata('message', 'Insiden berhasil dilaporkan.');
        
        // Redirect ke daftar insiden
        redirect('incidents');
    }

    /**
     * Detail Insiden
     */
    public function detail($id)
    {
        $data['title'] = 'Detail Insiden #' . $id;
        $data['page'] = 'incidents';
        $data['user'] = $this->_get_user_data();
        
        // Dummy data untuk detail
        $data['incident'] = [
            'id' => $id,
            'title' => 'Percobaan akses tidak sah ke server mail',
            'description' => 'Terdeteksi percobaan login berulang dari IP mencurigakan ke server mail utama. Total 150+ percobaan dalam 10 menit.',
            'severity' => 'high',
            'status' => 'in_progress',
            'category' => 'unauthorized_access',
            'reporter' => ['id' => 2, 'name' => 'John Doe'],
            'assignee' => ['id' => 1, 'name' => 'Admin CSIRT'],
            'created_at' => '2026-01-20 07:30:00',
            'updated_at' => '2026-01-20 08:15:00',
            'affected_systems' => 'mail.rri.co.id',
            'initial_assessment' => 'Kemungkinan brute force attack dari botnet.'
        ];
        
        // Timeline dummy
        $data['timeline'] = [
            ['time' => '2026-01-20 08:15:00', 'user' => 'Admin CSIRT', 'action' => 'Mengubah status menjadi In Progress', 'notes' => 'Memulai investigasi'],
            ['time' => '2026-01-20 07:45:00', 'user' => 'Admin CSIRT', 'action' => 'Mengubah status menjadi Validated', 'notes' => 'Insiden dikonfirmasi valid'],
            ['time' => '2026-01-20 07:30:00', 'user' => 'John Doe', 'action' => 'Melaporkan insiden', 'notes' => '']
        ];
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/incidents/detail', $data);
        $this->load->view('admin/templates/footer', $data);
    }

    /**
     * Catatan Insiden
     */
    public function notes($id)
    {
        // Handle POST request untuk tambah catatan
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $note = $this->input->post('note');
            // TODO: Simpan catatan ke database
            
            redirect('incidents/' . $id);
            return;
        }

        // Tampilkan daftar catatan (jika diakses via GET, meski biasanya via AJAX atau embedded di detail)
        $data['title'] = 'Catatan Insiden #' . $id;
        $data['user'] = $this->_get_user_data();
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        // Load view khusus notes jika ada, atau redirect ke detail
        redirect('incidents/' . $id);
    }

    /**
     * Helper: Get user data from session
     */
    private function _get_user_data()
    {
        return [
            'id' => $this->session->userdata('user_id'),
            'username' => $this->session->userdata('username'),
            'role' => $this->session->userdata('role'),
            'role_name' => $this->session->userdata('role_name')
        ];
    }

    /**
     * Helper: Get dummy incidents for testing
     */
    private function _get_dummy_incidents()
    {
        return [
            [
                'id' => 1,
                'title' => 'Percobaan akses tidak sah ke server mail',
                'severity' => 'high',
                'status' => 'in_progress',
                'category' => 'unauthorized_access',
                'reporter' => 'John Doe',
                'assignee' => 'Admin CSIRT',
                'created_at' => '2026-01-20 07:30:00'
            ],
            [
                'id' => 2,
                'title' => 'Malware terdeteksi pada workstation IT',
                'severity' => 'critical',
                'status' => 'validated',
                'category' => 'malware',
                'reporter' => 'Jane Smith',
                'assignee' => '-',
                'created_at' => '2026-01-20 06:15:00'
            ],
            [
                'id' => 3,
                'title' => 'Phishing email ditemukan di inbox publik',
                'severity' => 'medium',
                'status' => 'reported',
                'category' => 'phishing',
                'reporter' => 'Bob Wilson',
                'assignee' => '-',
                'created_at' => '2026-01-19 16:45:00'
            ],
            [
                'id' => 4,
                'title' => 'Update keamanan tertunda pada server web',
                'severity' => 'low',
                'status' => 'closed',
                'category' => 'other',
                'reporter' => 'Admin',
                'assignee' => 'Admin CSIRT',
                'created_at' => '2026-01-19 14:20:00'
            ],
            [
                'id' => 5,
                'title' => 'Aktivitas mencurigakan terdeteksi pada firewall',
                'severity' => 'high',
                'status' => 'mitigated',
                'category' => 'unauthorized_access',
                'reporter' => 'System Monitor',
                'assignee' => 'Security Team',
                'created_at' => '2026-01-18 22:10:00'
            ]
        ];
    }
}
