# 🛡️ Safeline WAF Integration Setup

Dokumentasi untuk konfigurasi integrasi Safeline WAF pada RRI-CSIRT Dashboard.

---

## 📋 Daftar Isi

- [Arsitektur](#arsitektur)
- [Setup Environment](#setup-environment)
- [Konfigurasi](#konfigurasi)
- [Flow Authentication](#flow-authentication)
- [Testing](#testing)
- [Troubleshooting](#troubleshooting)

---

## 🏗️ Arsitektur

Integrasi Safeline WAF menggunakan pola berikut:

```
┌─────────────────┐
│   Dashboard     │
│   Controller    │
└────────┬────────┘
         │
         ▼
┌─────────────────┐
│   Waf_model     │
└────────┬────────┘
         │
         ▼
┌─────────────────┐
│ Safeline_api    │
│    Library      │
└────────┬────────┘
         │
         ▼
┌─────────────────┐
│  Safeline WAF   │
│    REST API     │
└─────────────────┘
```

### Komponen Utama

1. **Dashboard Controller** (`application/controllers/Dashboard.php`)
   - Menampilkan data WAF di halaman dashboard

2. **Waf_model** (`application/models/Waf_model.php`)
   - Business logic untuk data WAF
   - Parsing dan transformasi response API
   - Caching layer

3. **Safeline_api Library** (`application/libraries/Safeline_api.php`)
   - Handle autentikasi (CSRF + JWT)
   - Request wrapper dengan auto-retry
   - Token caching

4. **Safeline Config** (`application/config/safeline.php`)
   - Load kredensial dari `.env`
   - Configuration untuk caching, timeout, dll

5. **Env Helper** (`application/helpers/env_helper.php`)
   - Parse file `.env`
   - Provide `env()` function seperti Laravel

---

## ⚙️ Setup Environment

### 1. Copy Template Environment

```bash
cp .env.example .env
```

### 2. Edit File `.env`

Buka file `.env` dan isi dengan kredensial Safeline WAF:

```bash
# =====================================================
# SAFELINE WAF API CONFIGURATION
# =====================================================

# Base URL untuk Safeline WAF API (tanpa trailing slash)
SAFELINE_BASE_URL=https://trial-waf.rri.go.id/api

# Callback address (untuk login)
SAFELINE_CALLBACK_URL=https://trial-waf.rri.go.id

# Username untuk autentikasi WAF API
SAFELINE_USERNAME=smk-pkl

# Password Hash (sudah di-encode, dari browser F12 saat login)
SAFELINE_PASSWORD_HASH=N2RjMmE1OWU5YjEwMzlmMq6EHYt7vBgUVNZ2P2rT8iM=

# =====================================================
# SAFELINE CACHING & PERFORMANCE
# =====================================================

# JWT Token Time-To-Live (dalam detik, default 50 menit)
SAFELINE_JWT_TTL=3000

# CSRF Token Time-To-Live (dalam detik, default 5 menit)
SAFELINE_CSRF_TTL=300

# Request timeout untuk CURL (dalam detik)
SAFELINE_REQUEST_TIMEOUT=15

# Enable SSL verification (true untuk production!)
SAFELINE_SSL_VERIFY=true
```

### 3. Cara Mendapatkan Password Hash

Password hash **BUKAN** password plaintext! Ini adalah encoded password dari browser:

1. **Buka Safeline WAF** di browser: `https://trial-waf.rri.go.id`
2. **Buka DevTools** (F12) → Tab **Network**
3. **Login** dengan username dan password normal
4. **Cari request** ke `/api/open/auth/login`
5. **Lihat Payload/Request Body**, copy nilai `password`
6. **Paste** ke `.env` sebagai `SAFELINE_PASSWORD_HASH`

**Contoh nilai password hash:**
```
N2RjMmE1OWU5YjEwMzlmMq6EHYt7vBgUVNZ2P2rT8iM=
```

---

## 🔐 Flow Authentication

Safeline WAF menggunakan 2-step authentication:

### Step 1: Get CSRF Token

```
GET /api/open/auth/csrf

Response:
{
  "data": {
    "csrf_token": "115_Fuui5EOnwvrL"
  }
}
```

**Cache:** 5 menit (configurable via `SAFELINE_CSRF_TTL`)

### Step 2: Login & Get JWT

```
POST /api/open/auth/login

Body:
{
  "callback_address": "https://trial-waf.rri.go.id",
  "csrf_token": "115_Fuui5EOnwvrL",
  "password": "N2RjMmE1OWU5YjEwMzlmMq6EHYt7vBgUVNZ2P2rT8iM=",
  "test": false,
  "username": "smk-pkl"
}

Response:
{
  "data": {
    "jwt": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
    "id": 6,
    "tfa_enabled": false
  }
}
```

**Cache:** 50 menit (configurable via `SAFELINE_JWT_TTL`)

### Step 3: API Requests dengan JWT

Semua request ke endpoint lain menggunakan JWT di header:

```
GET /api/open/records?limit=100

Headers:
Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...
```

### Auto-Refresh JWT

Library `Safeline_api` akan **otomatis refresh** JWT jika:
- Response code = `401 Unauthorized`
- Maksimal 1x retry per request (mencegah infinite loop)

---

## 📊 API Endpoints

### 1. Get Attack Records (Log Serangan)

```
GET /api/open/records?limit=100&offset=0
```

**Response Structure:**
```json
{
  "data": {
    "data": [
      {
        "src_ip": "180.243.39.165",
        "host": "jdih.rri.go.id",
        "url_path": "/common/dokumen/abs2022kp2090.pdf",
        "module": "m_php_unserialize",
        "action": 0,
        "timestamp": 1769134553,
        "country": "ID",
        "city": "Sidoarjo"
      }
    ],
    "total": 15420
  }
}
```

### 2. Get Events (Kejadian Penting)

```
GET /api/open/events?limit=100&offset=0
```

**Response Structure:**
```json
{
  "data": {
    "nodes": [
      {
        "src_ip": "192.168.1.100",
        "host": "example.com",
        "count": 45,
        "duration": "5m",
        "timestamp": 1769134553
      }
    ],
    "total": 230
  }
}
```

---

## 🧪 Testing

### Test Manual di Browser

1. **Akses Dashboard:**
   ```
   http://localhost/RRI-CSIRT/dashboard
   ```

2. **Lihat Console Browser** (F12) untuk debug logs

3. **Check data muncul** di tabel "Log Serangan" dan "Kejadian"

### Test via Postman/cURL

**1. Get CSRF Token:**
```bash
curl -X GET https://trial-waf.rri.go.id/api/open/auth/csrf
```

**2. Login:**
```bash
curl -X POST https://trial-waf.rri.go.id/api/open/auth/login \
  -H "Content-Type: application/json" \
  -d '{
    "username": "smk-pkl",
    "password": "N2RjMmE1OWU5YjEwMzlmMq6EHYt7vBgUVNZ2P2rT8iM=",
    "csrf_token": "CSRF_TOKEN_DARI_STEP_1",
    "callback_address": "https://trial-waf.rri.go.id",
    "test": false
  }'
```

**3. Get Records:**
```bash
curl -X GET "https://trial-waf.rri.go.id/api/open/records?limit=10" \
  -H "Authorization: Bearer JWT_TOKEN_DARI_STEP_2"
```

### Check CodeIgniter Logs

Lihat file log di `application/logs/log-YYYY-MM-DD.php`:

```bash
tail -f application/logs/log-2026-01-26.php
```

**Look for:**
- `Safeline API Error:` → Ada masalah koneksi/auth
- `JWT from cache` → JWT berhasil di-cache
- `CSRF Token from cache` → CSRF berhasil di-cache

---

## 🐛 Troubleshooting

### ❌ Error: "Username atau Password tidak terkonfigurasi"

**Penyebab:** File `.env` tidak ada atau credentials kosong

**Solusi:**
```bash
# 1. Pastikan file .env ada
ls -la .env

# 2. Check isi file
cat .env | grep SAFELINE

# 3. Pastikan tidak ada typo pada nama variable
```

---

### ❌ Error: "Failed to get CSRF token"

**Penyebab:** 
- Koneksi ke WAF gagal
- SSL verification error
- Base URL salah

**Solusi:**
```bash
# 1. Test koneksi manual
curl https://trial-waf.rri.go.id/api/open/auth/csrf

# 2. Jika SSL error, sementara disable di .env
SAFELINE_SSL_VERIFY=false

# 3. Check base URL benar (tanpa trailing slash)
SAFELINE_BASE_URL=https://trial-waf.rri.go.id/api
```

---

### ❌ Error: "Login failed (HTTP 401)"

**Penyebab:**
- Username salah
- Password hash salah
- CSRF token expired

**Solusi:**
```bash
# 1. Clear cache CSRF
rm application/cache/safeline_csrf_token*

# 2. Dapatkan password hash baru dari browser (F12)

# 3. Update .env dengan password hash yang benar
```

---

### ❌ Error: "Authentication failed after retry"

**Penyebab:**
- JWT expired dan refresh gagal
- Credentials tidak valid

**Solusi:**
```bash
# 1. Clear semua cache
rm application/cache/safeline_*

# 2. Check credentials di .env
cat .env | grep SAFELINE

# 3. Test login manual via Postman
```

---

### ❌ Dashboard menampilkan data fallback

**Gejala:** Data di dashboard selalu sama (dummy data)

**Penyebab:** API request gagal, sistem pakai fallback data

**Solusi:**
```bash
# 1. Check logs
tail -f application/logs/log-*.php

# 2. Look for "Safeline API Error"

# 3. Fix error berdasarkan pesan log
```

---

### ❌ Data tidak update (stuck)

**Penyebab:** Cache terlalu lama

**Solusi:**
```bash
# 1. Clear cache manual
rm application/cache/waf_stats_v3.json

# 2. Atau adjust cache duration di Waf_model.php
# private $cache_duration = 300; // 5 menit -> ubah ke lebih kecil

# 3. Atau click tombol "Live View" di dashboard
```

---

## 📁 File Structure

```
RRI-CSIRT/
│
├── .env                                    # Kredensial (JANGAN COMMIT!)
├── .env.example                            # Template kredensial
│
├── application/
│   ├── config/
│   │   ├── autoload.php                   # Load env helper
│   │   └── safeline.php                   # Config WAF (baca dari .env)
│   │
│   ├── helpers/
│   │   └── env_helper.php                 # Parser .env file
│   │
│   ├── libraries/
│   │   └── Safeline_api.php               # WAF API wrapper
│   │
│   ├── models/
│   │   └── Waf_model.php                  # Business logic WAF data
│   │
│   ├── controllers/
│   │   ├── Dashboard.php                  # Dashboard controller
│   │   └── Waf.php                        # WAF AJAX endpoints
│   │
│   ├── views/
│   │   └── admin/
│   │       └── dashboard.php              # Dashboard view
│   │
│   └── cache/
│       ├── safeline_jwt_token             # JWT cache (auto-created)
│       ├── safeline_csrf_token            # CSRF cache (auto-created)
│       └── waf_stats_v3.json              # Stats cache (auto-created)
│
└── docs/
    └── SAFELINE_SETUP.md                  # This file
```

---

## 🔒 Security Best Practices

### ✅ DO:

1. ✅ **Selalu gunakan `.env`** untuk credentials
2. ✅ **Enable SSL verify** di production (`SAFELINE_SSL_VERIFY=true`)
3. ✅ **Commit `.env.example`** ke git
4. ✅ **Add `.env` ke `.gitignore`**
5. ✅ **Rotate password hash** secara berkala
6. ✅ **Monitor logs** untuk failed attempts
7. ✅ **Set proper cache TTL** (jangan terlalu lama)

### ❌ DON'T:

1. ❌ **Jangan commit `.env`** ke git
2. ❌ **Jangan hardcode credentials** di code
3. ❌ **Jangan disable SSL verify** di production
4. ❌ **Jangan share password hash** di chat/email
5. ❌ **Jangan set cache TTL** terlalu tinggi (>1 jam)

---

## 📞 Support

Jika ada masalah:

1. **Check logs** di `application/logs/`
2. **Read troubleshooting** section di atas
3. **Contact:** Tim Teknologi Media Baru - RRI

---

**Last Updated:** 2026-01-26  
**Version:** 2.0.0 (Environment-based Configuration)
