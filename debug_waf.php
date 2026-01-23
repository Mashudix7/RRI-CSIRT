<?php
define('BASEPATH', '1');
require_once 'index.php';
$CI =& get_instance();
$CI->load->model('Waf_model');
echo "Daily Stats:\n";
$stats = $CI->Waf_model->get_daily_stats();
print_r($stats);
echo "\nDaily Events:\n";
$events = $CI->Waf_model->get_daily_events();
print_r($events);
