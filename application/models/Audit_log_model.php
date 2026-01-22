<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Audit_log_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function log($user_id, $action, $details = null, $module = 'system') {
        $data = [
            'user_id' => $user_id, // Can be NULL for failed logins
            'action' => $action,
            'module' => $module,
            'details' => $details,
            'ip_address' => $this->input->ip_address(),
            'user_agent' => $this->input->user_agent(),
            'created_at' => date('Y-m-d H:i:s')
        ];
        return $this->db->insert('audit_logs', $data);
    }

    public function get_all($limit = 100) {
        $this->db->select('audit_logs.*, users.username');
        $this->db->from('audit_logs');
        $this->db->join('users', 'users.id = audit_logs.user_id', 'left');
        $this->db->order_by('audit_logs.created_at', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result_array();
    }

    /**
     * Check for recent failed login attempts
     */
    public function count_login_failures($ip_address, $minutes = 15) {
        $time_limit = date('Y-m-d H:i:s', strtotime("-{$minutes} minutes"));
        
        $this->db->where('ip_address', $ip_address);
        $this->db->where('action', 'LOGIN_FAILED');
        $this->db->where('created_at >=', $time_limit);
        return $this->db->count_all_results('audit_logs');
    }
}
