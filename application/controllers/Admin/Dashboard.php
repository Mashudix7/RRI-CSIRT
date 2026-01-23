<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
        // Additional models for dashboard stats
        $this->load->model('Article_model');
        $this->load->model('Team_model');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['page'] = 'dashboard';
        
        // Pass stats to view
        $data['stats'] = [
            'users' => $this->User_model->count_all(),
            'articles' => $this->Article_model->count_all(),
            'teams' => $this->Team_model->count_all()
        ];
        
        $data['recent_threats'] = [];

        // Render using parent helper
        $this->render_admin('admin/dashboard', $data);
    }
}
