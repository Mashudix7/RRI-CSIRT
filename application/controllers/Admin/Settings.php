<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->_check_role_access(['admin']);
        $this->load->model('Settings_model');
    }

    public function index()
    {
        $data['title'] = 'Pengaturan Sistem';
        $data['page'] = 'settings';
        $data['settings_grouped'] = $this->Settings_model->get_all_grouped();
        
        $this->render_admin('admin/settings', $data);
    }

    public function update()
    {
        $input = $this->input->post();

        if (!empty($input)) {
            $updated_count = 0;
            foreach ($input as $key => $value) {
                // Ignore CSRF token if present
                if ($key == $this->security->get_csrf_token_name()) continue;

                if ($this->Settings_model->update($key, $value)) {
                    $updated_count++;
                }
            }
            
            // Log Action
            $this->Audit_log_model->log('update_settings', "Updated $updated_count settings");
            $this->session->set_flashdata('success', 'Pengaturan berhasil disimpan.');
        }

        redirect('admin/settings');
    }
}
