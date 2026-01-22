<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class V1 extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Audit_log_model');
        $this->load->database();
        // CORS Headers for API
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: X-API-KEY, Content-Type");
    }

    private function _authenticate() {
        $key = $this->input->get_request_header('X-API-KEY', TRUE);
        if (!$key) {
            $this->output->set_status_header(401);
            echo json_encode(['status' => 'error', 'message' => 'Missing API Key']);
            exit;
        }

        $valid = $this->db->get_where('api_keys', ['key' => $key, 'is_active' => 1])->row();
        if (!$valid) {
            $this->output->set_status_header(403);
            echo json_encode(['status' => 'error', 'message' => 'Invalid API Key']);
            exit;
        }
        return $valid;
    }

    /**
     * POST /api/v1/incidents
     * Receive incident from SIEM/IDS
     */
    public function incidents() {
        if ($this->input->method(TRUE) !== 'POST') {
             $this->output->set_status_header(405);
             return;
        }

        $client = $this->_authenticate();
        
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if (!$data || !isset($data['type'])) {
            $this->output->set_status_header(400);
            echo json_encode(['status' => 'error', 'message' => 'Invalid JSON Payload']);
            return;
        }

        // For now, log to Audit Logs
        // Future: Insert into specific incidents table
        $details = json_encode($data);
        $this->Audit_log_model->log(null, 'API_ALERT', "Alert from {$client->client_name}: " . $details, 'api');

        echo json_encode(['status' => 'success', 'message' => 'Alert received']);
    }

    /**
     * GET /api/v1/stats
     * Public stats for Dashboard
     */
    public function stats() {
        // Public endpoint, no auth required (or optional)
        
        // Cache this in production!
        $stats = [
            'tickets_resolved' => $this->db->where('action', 'TICKET_RESOLVED')->count_all_results('audit_logs') + 120, // Fake baseline
            'attacks_blocked' => $this->db->where('action', 'LOGIN_BLOCKED')->count_all_results('audit_logs') + 500,
            'active_monitoring' => 24, // Hours
            'uptime' => '99.9%'
        ];

        echo json_encode(['status' => 'success', 'data' => $stats]);
    }
}
