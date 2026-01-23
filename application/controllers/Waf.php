<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * WAF Controller
 * 
 * Endpoint untuk ambil data attack records dari Safeline
 */

class Waf extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        // Load library HANYA di controller yang perlu (bukan autoload)
        $this->load->library('safeline_api');
        
        // Ensure user is logged in (optional, but recommended for security)
        // If your admin session is checkable, do it here.
        // For now I'll follow the user request exactly but add a note.
    }
    
    /**
     * GET /waf/records
     * List semua attack records
     * 
     * Query params:
     *   - limit: jumlah records (default 100)
     *   - offset: mulai dari record ke- (default 0)
     */
    public function records() {
        try {
            $limit = $this->input->get('limit', TRUE) ?: 100;
            $offset = $this->input->get('offset', TRUE) ?: 0;
            
            // Validasi input
            if (!is_numeric($limit) || !is_numeric($offset) || $limit < 1 || $offset < 0) {
                return $this->_json_response(false, 'Invalid limit or offset', null, 400);
            }
            
            $result = $this->safeline_api->get_records($limit, $offset);
            
            // Cek error
            if (isset($result['error'])) {
                log_message('error', 'Safeline API Error: ' . $result['error']);
                return $this->_json_response(false, $result['error'], null, 500);
            }
            
            // Robust parsing for different API versions
            $data_container = isset($result['data']) ? $result['data'] : [];
            $records = [];
            $total = 0;

            if (isset($data_container['data']) && is_array($data_container['data'])) {
                $records = $data_container['data'];
                $total = isset($data_container['total']) ? $data_container['total'] : count($records);
            } elseif (isset($data_container['list']) && is_array($data_container['list'])) {
                $records = $data_container['list'];
                $total = isset($data_container['total']) ? $data_container['total'] : count($records);
            }

            // Aggregate records using Waf_model
            $this->load->model('Waf_model');
            $aggregated_records = $this->Waf_model->aggregate_records($records);

            // Success
            return $this->_json_response(true, 'OK', array(
                'data' => $aggregated_records,
                'total' => $total, // keep original count for stats
                'limit' => $limit,
                'offset' => $offset,
            ), 200);
            
        } catch (Exception $e) {
            log_message('error', 'WAF Controller Error: ' . $e->getMessage());
            return $this->_json_response(false, 'Internal Server Error', null, 500);
        }
    }
    
    /**
     * GET /waf/record/:id
     * Detail satu attack record
     */
    public function record($id = null) {
        try {
            if (!$id) {
                return $this->_json_response(false, 'Record ID required', null, 400);
            }
            
            // Validasi format ID (alphanumeric only)
            if (!preg_match('/^[a-f0-9]{32}$/', $id)) {
                return $this->_json_response(false, 'Invalid record ID format', null, 400);
            }
            
            $result = $this->safeline_api->get_record($id);
            
            if (isset($result['error'])) {
                log_message('error', 'Safeline API Error: ' . $result['error']);
                return $this->_json_response(false, $result['error'], null, 500);
            }
            
            return $this->_json_response(true, 'OK', $result['data'], 200);
            
        } catch (Exception $e) {
            log_message('error', 'WAF Controller Error: ' . $e->getMessage());
            return $this->_json_response(false, 'Internal Server Error', null, 500);
        }
    }
    
    /**
     * Health check endpoint
     * GET /waf/health
     */
    public function health() {
        return $this->_json_response(true, 'WAF API Service is running', null, 200);
    }
    
    /**
     * Private: Return JSON response
     */
    private function _json_response($success, $message, $data = null, $http_code = 200) {
        $this->output
            ->set_content_type('application/json')
            ->set_status_header($http_code)
            ->set_output(json_encode(array(
                'success' => (bool) $success,
                'message' => $message,
                'data' => $data,
                'timestamp' => date('c'),
            )));
    }
}
