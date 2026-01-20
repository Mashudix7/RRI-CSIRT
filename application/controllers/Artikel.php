<?php
/**
 * =====================================================
 * Artikel Controller
 * =====================================================
 * 
 * Controller untuk halaman artikel publik.
 * Menampilkan daftar dan detail artikel keamanan siber.
 * 
 * @package     CSIRT RRI
 * @subpackage  Controllers
 * @category    Public Content
 * @author      Tim Teknologi Media Baru
 * =====================================================
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Artikel extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    /**
     * Daftar Artikel
     */
    public function index()
    {
        $data['title'] = 'Artikel';
        
        // Filter kategori dari query string
        $data['kategori'] = $this->input->get('kategori');
        
        // Dummy articles - akan diganti dengan database query
        $data['articles'] = $this->_get_dummy_articles();
        
        // Filter by kategori if provided
        if ($data['kategori']) {
            $data['articles'] = array_filter($data['articles'], function($article) use ($data) {
                return strtolower($article['category']) === strtolower($data['kategori']);
            });
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('landing/artikel', $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * Detail Artikel
     */
    public function detail($id)
    {
        $articles = $this->_get_dummy_articles();
        
        // Find article by ID
        $article = null;
        foreach ($articles as $a) {
            if ($a['id'] == $id) {
                $article = $a;
                break;
            }
        }
        
        if (!$article) {
            show_404();
        }
        
        $data['title'] = $article['title'];
        $data['article'] = $article;
        $data['related'] = array_slice($articles, 0, 3);
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('landing/artikel_detail', $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * Dummy articles data
     */
    private function _get_dummy_articles()
    {
        return [
            [
                'id' => 1,
                'title' => 'Panduan Keamanan Password untuk Seluruh Pegawai RRI',
                'excerpt' => 'Kebijakan baru terkait penggunaan password yang aman. Semua pegawai wajib memperbarui password sesuai standar keamanan terbaru.',
                'content' => '<p>Password yang kuat adalah garis pertahanan pertama dalam melindungi akun dan sistem Anda dari akses tidak sah. Berikut adalah panduan lengkap untuk membuat dan mengelola password yang aman.</p><h3>Kriteria Password Kuat</h3><ul><li>Minimal 12 karakter</li><li>Kombinasi huruf besar dan kecil</li><li>Mengandung angka</li><li>Mengandung karakter khusus (!@#$%^&*)</li></ul><h3>Yang Harus Dihindari</h3><ul><li>Jangan gunakan nama, tanggal lahir, atau informasi pribadi</li><li>Jangan gunakan password yang sama untuk beberapa akun</li><li>Jangan bagikan password kepada siapapun</li></ul>',
                'category' => 'Keamanan',
                'author' => 'Tim CSIRT',
                'date' => '2026-01-20',
                'image' => null,
                'is_featured' => true
            ],
            [
                'id' => 2,
                'title' => 'Cara Mengenali Email Phishing',
                'excerpt' => 'Pelajari cara mengidentifikasi email phishing dan lindungi diri Anda dari penipuan online.',
                'content' => '<p>Email phishing adalah salah satu metode serangan siber yang paling umum. Penyerang mencoba menipu Anda untuk memberikan informasi sensitif.</p><h3>Tanda-tanda Email Phishing</h3><ul><li>Pengirim tidak dikenal atau mencurigakan</li><li>Alamat email yang mirip tapi tidak sama dengan yang asli</li><li>Urgensi palsu (akun akan ditutup, dll)</li><li>Link yang mencurigakan</li><li>Permintaan informasi pribadi atau password</li></ul>',
                'category' => 'Panduan',
                'author' => 'Tim CSIRT',
                'date' => '2026-01-18',
                'image' => null,
                'is_featured' => false
            ],
            [
                'id' => 3,
                'title' => 'Update Sistem Keamanan Jaringan Q1 2026',
                'excerpt' => 'Pengumuman pembaruan sistem keamanan jaringan yang akan dilakukan pada kuartal pertama 2026.',
                'content' => '<p>Dalam rangka meningkatkan keamanan infrastruktur IT RRI, tim CSIRT akan melakukan serangkaian pembaruan sistem keamanan.</p><h3>Jadwal Pembaruan</h3><ul><li>Firewall upgrade: 25 Januari 2026</li><li>Endpoint protection update: 1 Februari 2026</li><li>Network segmentation: 15 Februari 2026</li></ul><p>Selama proses pembaruan, mungkin akan ada gangguan layanan singkat. Informasi lebih lanjut akan disampaikan melalui email internal.</p>',
                'category' => 'Pengumuman',
                'author' => 'Tim IT',
                'date' => '2026-01-15',
                'image' => null,
                'is_featured' => false
            ],
            [
                'id' => 4,
                'title' => 'Laporan Insiden Keamanan Desember 2025',
                'excerpt' => 'Ringkasan insiden keamanan yang ditangani oleh tim CSIRT pada bulan Desember 2025.',
                'content' => '<p>Laporan bulanan insiden keamanan siber yang ditangani oleh tim CSIRT RRI.</p><h3>Statistik Desember 2025</h3><ul><li>Total insiden: 15</li><li>Insiden critical: 2</li><li>Insiden high: 5</li><li>Insiden medium: 8</li></ul><p>Semua insiden telah berhasil ditangani dan sistem telah kembali normal.</p>',
                'category' => 'Laporan',
                'author' => 'Tim CSIRT',
                'date' => '2026-01-10',
                'image' => null,
                'is_featured' => false
            ],
            [
                'id' => 5,
                'title' => 'Cara Aman Menggunakan WiFi Publik',
                'excerpt' => 'Tips keamanan saat terhubung ke jaringan WiFi publik untuk melindungi data Anda.',
                'content' => '<p>WiFi publik sangat nyaman tetapi juga berisiko. Berikut tips untuk tetap aman.</p><h3>Tips Keamanan</h3><ul><li>Gunakan VPN</li><li>Pastikan situs menggunakan HTTPS</li><li>Jangan akses akun sensitif</li><li>Matikan berbagi file</li></ul>',
                'category' => 'Panduan',
                'author' => 'Tim CSIRT',
                'date' => '2026-01-08',
                'image' => null,
                'is_featured' => false
            ]
        ];
    }
}
