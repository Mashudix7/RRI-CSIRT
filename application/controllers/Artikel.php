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
        $this->load->model('Article_model');
    }

    /**
     * Daftar Artikel
     */
    public function index()
    {
        $data['title'] = 'Artikel';
        
        // Filter kategori dari query string
        $data['kategori'] = $this->input->get('kategori');
        
        // Get articles from database
        $data['articles'] = $this->Article_model->get_all();
        
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
        // Find article by ID
        $article = $this->Article_model->get_by_id($id);
        
        if (!$article) {
            show_404();
        }
        
        $data['title'] = $article['title'];
        $data['article'] = $article;
        
        // Related articles (latest 3 except current)
        // Ideally DB should support 'exclude' or we filter here.
        // For simplicity, just get all and slice, or get recent.
        $all_articles = $this->Article_model->get_all(4); // Get 4, hopefully containing or not containing current.
        $data['related'] = array_filter($all_articles, function($a) use ($id) {
            return $a['id'] != $id;
        });
        $data['related'] = array_slice($data['related'], 0, 3);
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('landing/artikel_detail', $data);
        $this->load->view('templates/footer', $data);
    }
}
