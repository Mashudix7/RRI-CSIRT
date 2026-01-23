<?php
// Simple script to test Waf_model output directly
define('BASEPATH', '1');
define('APPPATH', __DIR__ . '/application/');

// Mocking CodeIgniter enough to load the model might be hard.
// Let's just use the Safeline_api directly with a test script.

require_once 'application/libraries/Safeline_api.php';
// Need to mock CI instance for the library
class MockCI {
    public $config;
    public $cache;
    public $load;
    public function __construct() {
        $this->config = new class { 
            public function load($s) {} 
            public function item($s) {
                return [
                    'base_url' => 'https://trial-waf.rri.go.id/api',
                    'username' => 'smk-pkl',
                    'password_hash' => 'N2RjMmE1OWU5YjEwMzlmMq6EHYt7vBgUVNZ2P2rT8iM=',
                    'jwt_cache_key' => 'safeline_jwt_token',
                    'csrf_cache_key' => 'safeline_csrf_token',
                    'jwt_ttl' => 3000,
                    'csrf_ttl' => 300,
                    'request_timeout' => 15,
                    'enable_ssl_verify' => false, // Set to false for testing if needed
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

$api = new Safeline_api();
echo "Testing open/records...\n";
$res1 = $api->request('open/records?limit=5');
print_r($res1);

echo "\nTesting open/events...\n";
$res2 = $api->request('open/events?limit=5');
print_r($res2);
