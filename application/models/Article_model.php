<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all($limit = null, $offset = 0) {
        $this->db->select('articles.*, users.username as author');
        $this->db->from('articles');
        $this->db->join('users', 'users.id = articles.author_id', 'left');
        $this->db->order_by('articles.created_at', 'DESC');
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        return $this->db->get()->result_array();
    }

    public function get_by_id($id) {
        return $this->db->get_where('articles', ['id' => $id])->row_array();
    }

    public function create($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert('articles', $data);
    }

    public function update($id, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id', $id);
        return $this->db->update('articles', $data);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('articles');
    }
    
    public function count_all() {
        return $this->db->count_all('articles');
    }
}
