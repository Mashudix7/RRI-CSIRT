# 🛡️ RRI-CSIRT Dashboard

Security Operations Center (SOC) Dashboard untuk Radio Republik Indonesia - Cyber Security Incident Response Team.

[![CodeIgniter](https://img.shields.io/badge/CodeIgniter-3.1.13-orange.svg)](https://codeigniter.com/)
[![PHP](https://img.shields.io/badge/PHP-7.4+-blue.svg)](https://www.php.net/)
[![License](https://img.shields.io/badge/License-Proprietary-red.svg)](LICENSE)

---

## 📋 Daftar Isi

- [Tentang Project](#tentang-project)
- [Fitur Utama](#fitur-utama)
- [Teknologi](#teknologi)
- [Instalasi](#instalasi)
- [Konfigurasi](#konfigurasi)
- [Dokumentasi](#dokumentasi)
- [Troubleshooting](#troubleshooting)
- [Tim Pengembang](#tim-pengembang)

---

## 🎯 Tentang Project

RRI-CSIRT Dashboard adalah aplikasi web untuk monitoring dan manajemen keamanan siber Radio Republik Indonesia. Dashboard ini terintegrasi dengan **Safeline WAF** untuk real-time monitoring serangan siber dan perlindungan sistem.

### Komponen Utama

- **Company Profile** - Landing page publik tentang CSIRT RRI
- **Authentication System** - Login dengan rate limiting dan audit log
- **Admin Dashboard** - Real-time monitoring serangan WAF
- **Article Management** - CRUD artikel keamanan siber
- **Team Management** - Manajemen tim CSIRT
- **IP Management** - Whitelist/blacklist IP addresses
- **Audit Log** - Tracking semua aktivitas user
- **Infrastructure Monitoring** - Network, Data Center, Security, Satellite

---

## ✨ Fitur Utama

### 🔐 Security Features

- ✅ **Safeline WAF Integration** - Real-time attack monitoring
- ✅ **Rate Limiting** - Prevent brute force attacks
- ✅ **Session Management** - Secure session handling
- ✅ **Audit Logging** - Track all user activities
- ✅ **IP Whitelisting/Blacklisting** - Access control
- ✅ **Role-based Access Control** - Admin/User permissions

### 📊 Dashboard Features

- ✅ **Real-time Attack Stats** - Total attacks, blocked, active threats
- ✅ **Attack Logs Table** - Detailed attack records with filtering
- ✅ **Events Monitoring** - Grouped attack events by IP
- ✅ **Attack Type Breakdown** - DDoS, Intrusion, Malware, Phishing
- ✅ **Live View Mode** - Auto-refresh every 30 seconds
- ✅ **Tab Switching** - Toggle between Logs and Events view

### 🎨 UI/UX Features

- ✅ **Dark Mode Support** - Toggle light/dark theme
- ✅ **Responsive Design** - Mobile, tablet, desktop friendly
- ✅ **Modern UI** - Tailwind CSS with glassmorphism
- ✅ **Smooth Animations** - AOS animations on scroll
- ✅ **Toast Notifications** - User-friendly feedback

---

## 🛠️ Teknologi

### Backend
- **Framework:** CodeIgniter 3.1.13
- **PHP:** 7.4+
- **Database:** MySQL 5.7+
- **Cache:** File-based caching

### Frontend
- **CSS Framework:** Tailwind CSS 3.x
- **JavaScript:** Vanilla JS (ES6+)
- **Icons:** Heroicons
- **Animations:** AOS (Animate On Scroll)

### Integrations
- **Safeline WAF API** - Attack monitoring
- **CSRF Protection** - Form security
- **JWT Authentication** - API token management

---

## 📦 Instalasi

### Prerequisites

- PHP 7.4 atau lebih tinggi
- MySQL 5.7 atau lebih tinggi
- Apache/Nginx dengan mod_rewrite enabled
- Composer (optional)

### Step-by-Step Installation

#### 1. Clone Repository

```bash
git clone https://github.com/your-org/RRI-CSIRT.git
cd RRI-CSIRT
```

#### 2. Setup Database

```bash
# Import database schema
mysql -u root -p < database/rri_csirt.sql

# Atau manual via phpMyAdmin
```

#### 3. Setup Environment

```bash
# Copy template environment
cp .env.example .env

# Edit dengan credentials Anda
nano .env
```

**Isi file `.env`:**

```bash
# Database Configuration
DB_HOST=localhost
DB_USER=root
DB_PASS=your_password
DB_NAME=rri_csirt

# Safeline WAF API
SAFELINE_BASE_URL=https://trial-waf.rri.go.id/api
SAFELINE_CALLBACK_URL=https://trial-waf.rri.go.id
SAFELINE_USERNAME=your-username
SAFELINE_PASSWORD_HASH=your-password-hash

# Caching & Performance
SAFELINE_JWT_TTL=3000
SAFELINE_CSRF_TTL=300
SAFELINE_REQUEST_TIMEOUT=15
SAFELINE_SSL_VERIFY=true
```

#### 4. Set Permissions

```bash
# Cache directory
chmod -R 777 application/cache/
chmod -R 777 application/logs/

# Uploads directory
chmod -R 777 uploads/
```

#### 5. Configure Apache

Edit `.htaccess` dan sesuaikan `RewriteBase`:

```apache
RewriteBase /RRI-CSIRT/
```

#### 6. Test Installation

Buka browser:
```
http://localhost/RRI-CSIRT/
```

---

## ⚙️ Konfigurasi

### 1. Database Configuration

Edit `application/config/database.php` atau gunakan `.env`:

```php
$db['default'] = array(
    'hostname' => env('DB_HOST', 'localhost'),
    'username' => env('DB_USER', 'root'),
    'password' => env('DB_PASS', ''),
    'database' => env('DB_NAME', 'rri_csirt'),
);
```

### 2. Safeline WAF Configuration

**Cara mendapat Password Hash:**

1. Buka https://trial-waf.rri.go.id
2. Tekan **F12** → Tab **Network**
3. Login dengan username & password
4. Cari request ke `/api/open/auth/login`
5. Lihat **Request Payload** → Copy nilai `password`
6. Paste ke `.env` sebagai `SAFELINE_PASSWORD_HASH`

**Contoh:**
```bash
SAFELINE_PASSWORD_HASH=N2RjMmE1OWU5YjEwMzlmMq6EHYt7vBgUVNZ2P2rT8iM=
```

### 3. Base URL Configuration

Edit `application/config/config.php`:

```php
$config['base_url'] = 'http://localhost/RRI-CSIRT/';
```

---

## 📚 Dokumentasi

Dokumentasi lengkap tersedia di folder `docs/`:

| Dokumen | Deskripsi |
|---------|-----------|
| [SAFELINE_SETUP.md](docs/SAFELINE_SETUP.md) | Setup guide lengkap Safeline WAF integration |
| [MIGRATION_SUMMARY.md](docs/MIGRATION_SUMMARY.md) | Summary migrasi ke environment-based config |
| [QUICK_REFERENCE.md](docs/QUICK_REFERENCE.md) | Quick reference untuk daily development |

### API Documentation

#### Safeline WAF Endpoints

**1. Get Attack Records**
```bash
GET /waf/records?limit=100&offset=0
```

**2. Get Events**
```bash
GET /waf/events?limit=100&offset=0
```

**3. Dashboard Live Data**
```bash
GET /waf/dashboard_live
```

---

## 🐛 Troubleshooting

### Problem: "Not Found" Error

**Solusi:**
```bash
# Check .htaccess RewriteBase
cat .htaccess | grep RewriteBase

# Harus sesuai dengan folder name
RewriteBase /RRI-CSIRT/
```

### Problem: "Username atau Password tidak terkonfigurasi"

**Solusi:**
```bash
# Check .env file exists
ls -la .env

# Check credentials
cat .env | grep SAFELINE

# Pastikan tidak ada typo
```

### Problem: Dashboard showing dummy data

**Solusi:**
```bash
# Clear WAF cache
rm application/cache/safeline_*
rm application/cache/waf_stats_v3.json

# Check logs
tail -f application/logs/log-$(date +%Y-%m-%d).php | grep Safeline
```

### Problem: "Failed to get CSRF token"

**Solusi:**
```bash
# Test manual
curl https://trial-waf.rri.go.id/api/open/auth/csrf

# Jika SSL error (development only)
# Edit .env:
SAFELINE_SSL_VERIFY=false
```

**Dokumentasi lengkap:** [docs/SAFELINE_SETUP.md](docs/SAFELINE_SETUP.md)

---

## 🔒 Security Best Practices

### ✅ DO:

1. ✅ Gunakan `.env` untuk semua credentials
2. ✅ Enable SSL verify di production (`SAFELINE_SSL_VERIFY=true`)
3. ✅ Set proper file permissions (cache: 777, .env: 600)
4. ✅ Rotate password hash secara berkala
5. ✅ Monitor audit logs regularly
6. ✅ Keep CodeIgniter and dependencies updated

### ❌ DON'T:

1. ❌ Commit `.env` file ke repository
2. ❌ Hardcode credentials di source code
3. ❌ Disable SSL verify di production
4. ❌ Share password hash via chat/email
5. ❌ Use default admin password
6. ❌ Expose debug mode di production

---

## 📁 Struktur Project

```
RRI-CSIRT/
│
├── .env                          # Environment config (GITIGNORED)
├── .env.example                  # Template environment
├── .htaccess                     # Apache rewrite rules
├── index.php                     # Entry point
│
├── application/
│   ├── config/
│   │   ├── autoload.php         # Autoload libraries/helpers
│   │   ├── database.php         # Database config
│   │   ├── routes.php           # URL routing
│   │   └── safeline.php         # Safeline WAF config
│   │
│   ├── controllers/
│   │   ├── Auth.php             # Authentication
│   │   ├── Dashboard.php        # Main dashboard
│   │   ├── Admin.php            # Admin functions
│   │   ├── Landing.php          # Public landing
│   │   ├── Artikel.php          # Article management
│   │   └── Waf.php              # WAF AJAX endpoints
│   │
│   ├── models/
│   │   ├── User_model.php       # User CRUD
│   │   ├── Waf_model.php        # WAF data processing
│   │   ├── Audit_model.php      # Audit logging
│   │   └── Settings_model.php   # App settings
│   │
│   ├── views/
│   │   ├── admin/               # Admin views
│   │   │   ├── dashboard.php    # Dashboard view
│   │   │   └── templates/       # Header, sidebar, footer
│   │   ├── auth/                # Login/logout views
│   │   └── landing/             # Public views
│   │
│   ├── libraries/
│   │   ├── Safeline_api.php     # WAF API wrapper
│   │   └── Security_manager.php # Security utilities
│   │
│   ├── helpers/
│   │   └── env_helper.php       # Environment parser
│   │
│   ├── cache/                    # File cache (auto-created)
│   └── logs/                     # Application logs
│
├── assets/
│   ├── css/                      # Custom CSS
│   ├── js/                       # Custom JavaScript
│   └── images/                   # Images & icons
│
├── uploads/                      # User uploads
│
├── docs/
│   ├── SAFELINE_SETUP.md        # Setup guide
│   ├── MIGRATION_SUMMARY.md     # Migration docs
│   └── QUICK_REFERENCE.md       # Quick reference
│
└── system/                       # CodeIgniter core (don't modify)
```

---

## 🚀 Deployment

### Production Checklist

- [ ] Set `APP_ENV=production` di `.env`
- [ ] Set `APP_DEBUG=false` di `.env`
- [ ] Set `SAFELINE_SSL_VERIFY=true` di `.env`
- [ ] Change default admin password
- [ ] Set proper file permissions (`.env`: 600)
- [ ] Enable HTTPS/SSL certificate
- [ ] Configure firewall rules
- [ ] Setup backup schedule
- [ ] Configure log rotation
- [ ] Test all critical features

### Server Requirements

- **PHP:** 7.4+ with extensions:
  - `mysqli`
  - `curl`
  - `json`
  - `mbstring`
  - `openssl`
- **MySQL:** 5.7+
- **Apache:** 2.4+ with `mod_rewrite`
- **SSL Certificate** (Let's Encrypt recommended)

---

## 👥 Tim Pengembang

**Tim Teknologi Media Baru - Radio Republik Indonesia**

- **Project Lead:** [Name]
- **Backend Developer:** [Name]
- **Frontend Developer:** [Name]
- **Security Analyst:** [Name]

---

## 📄 License

Proprietary - Radio Republik Indonesia © 2026

**Hak Cipta dilindungi undang-undang.**

---

## 📞 Support & Contact

**Email:** csirt@rri.go.id  
**Website:** https://www.rri.go.id  
**Emergency:** +62-xxx-xxxx-xxxx

---

## 🔄 Changelog

### Version 2.0.0 (2026-01-26)
- ✅ Migrated to environment-based configuration
- ✅ Added `.env` support for credentials
- ✅ Improved security (no hardcoded credentials)
- ✅ Added comprehensive documentation
- ✅ Fixed `.htaccess` RewriteBase issue
- ✅ Enhanced error handling and logging

### Version 1.0.0 (2026-01-19)
- ✅ Initial release
- ✅ Safeline WAF integration
- ✅ Dashboard with real-time monitoring
- ✅ Authentication system
- ✅ Article management
- ✅ Audit logging

---

**Built with ❤️ by Tim Teknologi Media Baru - RRI**
