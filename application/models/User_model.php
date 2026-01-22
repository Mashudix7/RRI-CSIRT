<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all() {
        return $this->db->get('users')->result_array();
    }

    public function get_by_id($id) {
        return $this->db->get_where('users', ['id' => $id])->row_array();
    }

    public function create($data) {
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert('users', $data);
    }

    public function update($id, $data) {
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        } else {
            unset($data['password']);
        }
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('users');
    }

    public function login($username, $password) {
        $user = $this->db->get_where('users', ['username' => $username])->row_array();
        if ($user && password_verify($password, $user['password'])) {
            // Update last login
            $this->db->where('id', $user['id']);
            $this->db->update('users', ['last_login' => date('Y-m-d H:i:s')]);
            return $user;
        }
        return false;
    }

    public function update_activity($user_id) {
        $this->db->where('id', $user_id);
        $this->db->update('users', ['last_activity' => date('Y-m-d H:i:s')]);
    }
}
