<?php
// Comprehensive Debug Script for Safeline API
header('Content-Type: text/plain');

define('BASEPATH', '1');
define('APPPATH', __DIR__ . '/application/');

// Mocking log_message if it doesn't exist
if (!function_exists('log_message')) {
    function log_message($level, $message) {
        echo "[LOG - $level] $message\n";
    }
}

require_once 'application/libraries/Safeline_api.php';

// Mock CI instance
class MockCI {
    public $config;
    public $cache;
    public $load;
    public function __construct() {
        $this->config = new class { 
            public function load($s) {} 
            public function item($s) {
                // Return real values from config/safeline.php
                return [
                    'base_url' => 'https://trial-waf.rri.go.id/api',
                    'username' => 'smk-pkl',
                    'password_hash' => 'N2RjMmE1OWU5YjEwMzlmMq6EHYt7vBgUVNZ2P2rT8iM=',
                    'jwt_cache_key' => 'safeline_jwt_token',
                    'csrf_cache_key' => 'safeline_csrf_token',
                    'jwt_ttl' => 3000,
                    'csrf_ttl' => 300,
                    'request_timeout' => 15,
                    'enable_ssl_verify' => false, // Set to false for testing
                ];
            }
        };
        $this->cache = new class { 
            public function get($k) { return false; }
            public function save($k, $v, $t) { return true; }
            public function delete($k) { return true; }
        };
        $this->load = new class { public function driver($a, $b) {} };
    }
}

function get_instance() { return new MockCI(); }

try {
    $api = new Safeline_api();
    
    echo "--- TESTING LOGIN ---\n";
    // We can't call private methods easily, so we just call a request that triggers login
    $res = $api->request('open/records?limit=1');
    if (isset($res['error'])) {
        echo "FAIL: " . $res['error'] . "\n";
    } else {
        echo "SUCCESS: Connection established.\n";
    }

    echo "\n--- RAW DATA (RECORDS) ---\n";
    $records = $api->request('open/records?limit=5');
    print_r($records);

    echo "\n--- RAW DATA (EVENTS) ---\n";
    $events = $api->request('open/events?limit=5');
    print_r($events);

} catch (Exception $e) {
    echo "FATAL ERROR: " . $e->getMessage() . "\n";
}
