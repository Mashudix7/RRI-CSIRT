<?php
/**
 * =====================================================
 * Landing Controller
 * =====================================================
 * 
 * Controller untuk halaman publik (company profile).
 * Tidak memerlukan autentikasi.
 * 
 * @package     CSIRT RRI
 * @subpackage  Controllers
 * @category    Landing Page
 * @author      Tim Teknologi Media Baru
 * 
 * Komentar Kritikal:
 * - Controller ini TIDAK boleh mengakses data sensitif insiden
 * - Semua halaman di sini bersifat publik (internal network)
 * - Tidak ada session check yang diperlukan
 * =====================================================
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller {

    /**
     * Constructor
     * Load helper & library yang diperlukan
     */
    public function __construct()
    {
        parent::__construct();
        // Load URL helper untuk base_url()
        $this->load->helper('url');
    }

    /**
     * Halaman Beranda
     * Menampilkan hero section dan overview CSIRT
     */
    public function index()
    {
        $data['title'] = 'Beranda';
        
        // Load views dengan template
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('landing/home', $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * Halaman Tentang CSIRT
     * Menampilkan visi, misi, dan ruang lingkup kerja
     */
    public function tentang()
    {
        $data['title'] = 'Tentang CSIRT';
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('landing/about', $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * Halaman Tim
     * Menampilkan profil anggota tim CSIRT
     */
    public function tim()
    {
        $data['title'] = 'Tim Kami';
        
        // Data tim (bisa dipindah ke database nanti)
        $data['team_members'] = [
            [
                'name' => 'Ahmad Fauzi',
                'role' => 'Kepala Tim CSIRT',
                'description' => 'Memimpin tim dalam penanganan insiden keamanan siber dan koordinasi respons.',
                'image' => 'team1.jpg'
            ],
            [
                'name' => 'Siti Rahayu',
                'role' => 'Security Analyst',
                'description' => 'Spesialisasi dalam analisis malware dan forensik digital.',
                'image' => 'team2.jpg'
            ],
            [
                'name' => 'Budi Santoso',
                'role' => 'Incident Responder',
                'description' => 'Menangani respons cepat terhadap insiden dan pemulihan sistem.',
                'image' => 'team3.jpg'
            ],
            [
                'name' => 'Dewi Pertiwi',
                'role' => 'Security Engineer',
                'description' => 'Mengembangkan dan memelihara infrastruktur keamanan.',
                'image' => 'team4.jpg'
            ]
        ];
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('landing/team', $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * Halaman Kontak
     * Informasi kontak dan form (jika diperlukan)
     */
    public function kontak()
    {
        $data['title'] = 'Kontak';
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('landing/contact', $data);
        $this->load->view('templates/footer', $data);
    }
}
