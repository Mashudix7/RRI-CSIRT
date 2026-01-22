<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setup extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->dbforge();
    }

    public function index() {
        echo "<h1>Database Setup</h1>";
        
        $this->_create_users_table();
        $this->_create_articles_table();
        $this->_create_teams_table();
        $this->_create_sessions_table();
        $this->_create_knowledge_base_table();
        $this->_create_evidence_table();
        $this->_create_api_keys_table();
        
        echo "<p>Setup completed!</p>";
    }
    
    private function _create_users_table() {
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'unique' => TRUE,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '200',
            ],
            'role' => [
                'type' => 'ENUM("admin", "auditor")',
                'default' => 'admin',
            ],
            'status' => [
                'type' => 'ENUM("active", "inactive")',
                'default' => 'active',
            ],
            'last_login' => [
                'type' => 'DATETIME',
                'null' => TRUE,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => TRUE,
            ],
        ]);
        $this->dbforge->add_key('id', TRUE);
        if ($this->dbforge->create_table('users', TRUE)) {
            echo "<p>Table 'users' created or already exists.</p>";
            
            // Seed default admin if empty
            $query = $this->db->get_where('users', ['username' => 'admin']);
            if ($query->num_rows() == 0) {
                $data = [
                    'username' => 'admin',
                    'password' => password_hash('admin123', PASSWORD_BCRYPT), // Default password
                    'email' => 'admin@rri.co.id',
                    'role' => 'admin',
                    'status' => 'active',
                    'created_at' => date('Y-m-d H:i:s')
                ];
                $this->db->insert('users', $data);
                echo "<p>Default admin user created (admin / admin123).</p>";
            }
        }
    }

    private function _create_articles_table() {
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'content' => [
                'type' => 'TEXT',
                'null' => TRUE,
            ],
            'category' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'status' => [
                'type' => 'ENUM("published", "draft", "archived")',
                'default' => 'draft',
            ],
            'author_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'image_url' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => TRUE,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => TRUE,
            ],
        ]);
        $this->dbforge->add_key('id', TRUE);
        if ($this->dbforge->create_table('articles', TRUE)) {
            echo "<p>Table 'articles' created or already exists.</p>";
        }
    }

    private function _create_teams_table() {
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
            ],
            'position' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'division' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'photo' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ],
            'status' => [
                'type' => 'ENUM("active", "inactive")',
                'default' => 'active',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => TRUE,
            ],
        ]);
        $this->dbforge->add_key('id', TRUE);
        if ($this->dbforge->create_table('teams', TRUE)) {
            echo "<p>Table 'teams' created or already exists.</p>";
        }
    }

    private function _create_sessions_table() {
        $this->dbforge->add_field([
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => FALSE
            ],
            'ip_address' => [
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => FALSE
            ],
            'timestamp' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'default' => 0,
                'null' => FALSE
            ],
            'data' => [
                'type' => 'BLOB',
                'null' => FALSE
            ]
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('timestamp');
        if ($this->dbforge->create_table('ci_sessions', TRUE)) {
            echo "<p>Table 'ci_sessions' created or already exists.</p>";
        }
    }

    private function _create_knowledge_base_table() {
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'content' => [
                'type' => 'TEXT',
            ],
            'category' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'default' => 'General'
            ],
            'is_public' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1
            ],
            'views' => [
                'type' => 'INT',
                'default' => 0
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => TRUE,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => TRUE,
            ],
        ]);
        $this->dbforge->add_key('id', TRUE);
        if ($this->dbforge->create_table('knowledge_base', TRUE)) {
            echo "<p>Table 'knowledge_base' created or already exists.</p>";
        }
    }

    private function _create_evidence_table() {
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'case_ref_no' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'file_name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'original_name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'file_type' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE
            ],
            'file_size' => [
                'type' => 'INT',
                'unsigned' => TRUE
            ],
            'file_hash' => [
                'type' => 'VARCHAR',
                'constraint' => '64', // SHA-256
            ],
            'uploaded_by' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'notes' => [
                'type' => 'TEXT',
                'null' => TRUE
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => TRUE,
            ],
        ]);
        $this->dbforge->add_key('id', TRUE);
        if ($this->dbforge->create_table('evidence', TRUE)) {
            echo "<p>Table 'evidence' created or already exists.</p>";
        }
    }

    private function _create_api_keys_table() {
            $this->dbforge->add_field([
                'id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ],
                'key' => [
                    'type' => 'VARCHAR',
                    'constraint' => '64',
                ],
                'client_name' => [
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                ],
                'is_active' => [
                    'type' => 'TINYINT',
                    'default' => 1
                ],
                'created_at' => [
                    'type' => 'DATETIME',
                    'null' => TRUE,
                ],
            ]);
            $this->dbforge->add_key('id', TRUE);
            if ($this->dbforge->create_table('api_keys', TRUE)) {
                echo "<p>Table 'api_keys' created or already exists.</p>";
                
                // Seed Default Key
                $params = ['key' => 'CSIRT-LIVE-KEY-12345'];
                 $query = $this->db->get_where('api_keys', $params);
                 if ($query->num_rows() == 0) {
                     $data = [
                         'key' => 'CSIRT-LIVE-KEY-12345',
                         'client_name' => 'Default SIEM Connector',
                         'created_at' => date('Y-m-d H:i:s')
                     ];
                     $this->db->insert('api_keys', $data);
                     echo "<p>Default API Key seeded.</p>";
                 }
            }
        }
    public function migration_add_category() {
        if (!$this->db->field_exists('category', 'articles')) {
             $fields = [
                'category' => [
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'after' => 'title',
                    'default' => 'Informasi'
                ]
            ];
            $this->dbforge->add_column('articles', $fields);
            echo "Column 'category' added to 'articles' table.<br>";
        } else {
            echo "Column 'category' already exists.<br>";
        }
    }

    public function migration_update_users_features() {
        // 1. Add Photo
        if (!$this->db->field_exists('photo', 'users')) {
            $this->dbforge->add_column('users', [
                'photo' => [
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                    'null' => TRUE,
                    'after' => 'email'
                ]
            ]);
            echo "Column 'photo' added.<br>";
        }

        // 2. Add Phone if not exists (it was in sql but maybe not in table)
        if (!$this->db->field_exists('phone', 'users')) {
            $this->dbforge->add_column('users', [
                'phone' => [
                    'type' => 'VARCHAR',
                    'constraint' => '20',
                    'null' => TRUE,
                    'after' => 'full_name'
                ]
            ]);
            echo "Column 'phone' added.<br>";
        }

        // 3. Add Full Name if not exists
        if (!$this->db->field_exists('full_name', 'users')) {
             $this->dbforge->add_column('users', [
                'full_name' => [
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'null' => TRUE,
                    'after' => 'role'
                ]
            ]);
            echo "Column 'full_name' added.<br>";
        }

        // 4. Add Last Activity
        if (!$this->db->field_exists('last_activity', 'users')) {
            $this->dbforge->add_column('users', [
                'last_activity' => [
                    'type' => 'DATETIME',
                    'null' => TRUE,
                    'after' => 'last_login'
                ]
            ]);
            echo "Column 'last_activity' added.<br>";
        }

        // 5. Modify Role Enum
        // Note: modify_column with ENUM can be tricky in CI3/MySQL. 
        // Using direct SQL for ENUM modification to be safe and specific.
        $this->db->query("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'management', 'view') DEFAULT 'view'");
        echo "Column 'role' modified to ENUM('admin', 'management', 'view').<br>";
        
        echo "<p>User table features updated!</p>";
    }

    public function migration_create_audit_logs() {
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE,
            ],
            'action' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'module' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'details' => [
                'type' => 'TEXT',
                'null' => TRUE,
            ],
            'ip_address' => [
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => TRUE,
            ],
            'user_agent' => [
                'type' => 'TEXT',
                'null' => TRUE,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => TRUE,
            ],
        ]);
        $this->dbforge->add_key('id', TRUE);
        if ($this->dbforge->create_table('audit_logs', TRUE)) {
            echo "<p>Table 'audit_logs' created.</p>";
        } else {
             echo "<p>Table 'audit_logs' already exists or failed.</p>";
        }
    }
    public function seed_users() {
        $this->load->model('User_model');
        
        // Data pengguna yang akan di-seed
        $users = [
            [
                'username' => 'admin_pusat',
                'password' => 'admin123',
                'full_name' => 'Administrator Pusat',
                'email' => 'admin@rri.co.id',
                'role' => 'admin',
                'status' => 'active',
                'photo' => null
            ],
            [
                'username' => 'manager_it',
                'password' => 'manager123',
                'full_name' => 'Budi Santoso (Manager IT)',
                'email' => 'manager@rri.co.id',
                'role' => 'management',
                'status' => 'active',
                'photo' => null
            ],
            [
                'username' => 'viewer_tamu',
                'password' => 'guest123',
                'full_name' => 'Tamu Pengawas',
                'email' => 'guest@rri.co.id',
                'role' => 'view',
                'status' => 'active',
                'photo' => null
            ]
        ];

        $count = 0;
        foreach ($users as $u) {
            // Cek jika username sudah ada
            $exists = $this->db->get_where('users', ['username' => $u['username']])->row();
            if (!$exists) {
                // Gunakan model untuk create agar password di-hash
                $this->User_model->create($u);
                $count++;
            }
        }

        echo "<h1>Seeding Complete</h1>";
        echo "<p>Berhasil menambahkan $count pengguna baru.</p>";
        echo "<ul>";
        foreach ($users as $u) {
            echo "<li>{$u['username']} ({$u['role']}) - Pass: {$u['password']}</li>";
        }
        echo "</ul>";
        echo "<p><a href='" . base_url('admin/users') . "'>Kembali ke User Management</a></p>";
    }
}
