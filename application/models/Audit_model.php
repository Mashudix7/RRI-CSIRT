<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Audit_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Log an activity
     * 
     * @param string $action Action name (e.g., 'login', 'create_user')
     * @param string $details Detailed description
     * @param int|null $user_id Optional user ID (defaults to current session)
     * @return bool
     */
    public function log($action, $details = null, $user_id = null) {
        $user_id = $user_id ?? $this->session->userdata('user_id');
        $username = $this->session->userdata('username') ?? 'system';
        $role = $this->session->userdata('role') ?? 'system';

        $data = [
            'user_id' => $user_id,
            'username' => $username,
            'role' => $role,
            'action' => $action,
            'details' => $details,
            'ip_address' => $this->input->ip_address(),
            'user_agent' => $this->input->user_agent(),
            'created_at' => date('Y-m-d H:i:s')
        ];

        return $this->db->insert('audit_logs', $data);
    }

    /**
     * Get all logs
     * Can be filtered by limit/offset for pagination
     */
    public function get_all($limit = 100, $offset = 0) {
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('audit_logs', $limit, $offset)->result_array();
    }
}
