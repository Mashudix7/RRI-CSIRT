# 🚀 Safeline WAF - Quick Reference

Quick reference untuk developer yang bekerja dengan Safeline WAF integration.

---

## 📦 Setup Baru (First Time)

```bash
# 1. Copy template
cp .env.example .env

# 2. Edit .env dengan editors favorit
nano .env
# atau
code .env

# 3. Isi credentials Safeline WAF
SAFELINE_USERNAME=your-username
SAFELINE_PASSWORD_HASH=your-password-hash

# 4. Test akses dashboard
# Buka browser: http://localhost/RRI-CSIRT/dashboard
```

---

## 🔑 Cara Mendapat Password Hash

```
1. Buka: https://trial-waf.rri.go.id
2. Tekan F12 → Tab Network
3. Login dengan username & password normal
4. Cari request ke: /api/open/auth/login
5. Lihat Request Payload → Copy nilai "password"
6. Paste ke .env sebagai SAFELINE_PASSWORD_HASH
```

---

## 🧹 Clear Cache

Kalau data WAF stuck atau tidak update:

```bash
# Hapus semua cache Safeline
rm application/cache/safeline_*

# Atau hapus specific cache
rm application/cache/safeline_jwt_token
rm application/cache/safeline_csrf_token
rm application/cache/waf_stats_v3.json
```

---

## 🔧 Environment Variables

### Wajib (Required)
```bash
SAFELINE_BASE_URL=https://trial-waf.rri.go.id/api
SAFELINE_USERNAME=smk-pkl
SAFELINE_PASSWORD_HASH=N2RjMmE1OWU5YjEwMzlmMq6EHYt7vBgUVNZ2P2rT8iM=
```

### Optional (Ada Default)
```bash
SAFELINE_CALLBACK_URL=https://trial-waf.rri.go.id
SAFELINE_JWT_TTL=3000           # 50 menit
SAFELINE_CSRF_TTL=300           # 5 menit  
SAFELINE_REQUEST_TIMEOUT=15     # detik
SAFELINE_SSL_VERIFY=true        # production: true
```

---

## 📝 Menggunakan env() Function

### Di Config Files
```php
<?php
// application/config/safeline.php
$config['safeline'] = array(
    'username' => env('SAFELINE_USERNAME', 'default-user'),
    'api_key' => env('SAFELINE_API_KEY'),
);
```

### Di Controllers/Models
```php
<?php
// Load env helper dulu (kalau belum autoload)
$this->load->helper('env');

// Get value
$username = env('SAFELINE_USERNAME');
$timeout = env('SAFELINE_REQUEST_TIMEOUT', 15);

// Required (throw error kalau kosong)
$api_key = env_required('SAFELINE_API_KEY');
```

### Type Parsing
```bash
# String
APP_NAME=MyApp              → "MyApp"

# Integer
MAX_UPLOAD=1024             → 1024

# Float
PRICE=99.99                 → 99.99

# Boolean
DEBUG=true                  → true
DEBUG=false                 → false

# Null
CACHE=null                  → null

# Empty
OPTIONAL=empty              → ""
```

---

## 🐛 Troubleshooting Quick Fixes

### Problem: "Username atau Password tidak terkonfigurasi"
```bash
# Check file .env exists
ls -la .env

# Check content
cat .env | grep SAFELINE_USERNAME
cat .env | grep SAFELINE_PASSWORD_HASH

# Pastikan tidak ada typo
code .env
```

### Problem: "Failed to get CSRF token"
```bash
# Test manual
curl https://trial-waf.rri.go.id/api/open/auth/csrf

# Jika SSL error di development
# Edit .env:
SAFELINE_SSL_VERIFY=false

# PRODUCTION harus:
SAFELINE_SSL_VERIFY=true
```

### Problem: Dashboard showing dummy data
```bash
# Clear cache
rm application/cache/waf_stats_v3.json

# Check logs
tail -f application/logs/log-$(date +%Y-%m-%d).php | grep Safeline
```

### Problem: JWT expired terus
```bash
# Clear JWT cache
rm application/cache/safeline_jwt_token

# Increase TTL di .env (max 3600 = 1 jam)
SAFELINE_JWT_TTL=3600
```

---

## 📊 API Endpoints Reference

### 1. Get CSRF Token
```bash
GET /api/open/auth/csrf

# Response
{ "data": { "csrf_token": "xxx" } }
```

### 2. Login (Get JWT)
```bash
POST /api/open/auth/login
Content-Type: application/json

{
  "username": "smk-pkl",
  "password": "hash_from_browser",
  "csrf_token": "from_step_1",
  "callback_address": "https://trial-waf.rri.go.id",
  "test": false
}

# Response
{ "data": { "jwt": "eyJ..." } }
```

### 3. Get Attack Records
```bash
GET /api/open/records?limit=100&offset=0
Authorization: Bearer {jwt}
```

### 4. Get Events
```bash
GET /api/open/events?limit=100&offset=0
Authorization: Bearer {jwt}
```

---

## 🔍 Check Logs

```bash
# Real-time logs
tail -f application/logs/log-$(date +%Y-%m-%d).php

# Filter Safeline errors
tail -f application/logs/log-*.php | grep "Safeline"

# Check specific error
grep "Safeline API Error" application/logs/log-*.php
```

---

## 🎯 Common Use Cases

### Switch to Different WAF Server
```bash
# Edit .env
SAFELINE_BASE_URL=https://production-waf.rri.go.id/api
SAFELINE_CALLBACK_URL=https://production-waf.rri.go.id

# Clear cache
rm application/cache/safeline_*

# Reload dashboard
```

### Test with Different Credentials
```bash
# Edit .env
SAFELINE_USERNAME=new-user
SAFELINE_PASSWORD_HASH=new-hash

# Clear JWT
rm application/cache/safeline_jwt_token

# Test
curl http://localhost/RRI-CSIRT/dashboard
```

### Disable SSL Verify (Development Only)
```bash
# Edit .env
SAFELINE_SSL_VERIFY=false

# NEVER use this in production!
```

---

## ⚡ Performance Tuning

### Cache Duration
```bash
# JWT TTL (max 1 hour = 3600)
SAFELINE_JWT_TTL=3600

# CSRF TTL (recommended 5-10 min)
SAFELINE_CSRF_TTL=300

# Stats cache (in Waf_model.php)
private $cache_duration = 300; // 5 minutes
```

### Request Timeout
```bash
# Increase jika network lambat
SAFELINE_REQUEST_TIMEOUT=30  # 30 detik

# Decrease jika network cepat
SAFELINE_REQUEST_TIMEOUT=10  # 10 detik
```

---

## 🔐 Security Checklist

- [ ] `.env` file NOT in git repository
- [ ] `.env` in `.gitignore`
- [ ] `SAFELINE_SSL_VERIFY=true` in production
- [ ] Password hash rotated regularly
- [ ] `.env` file permissions: 600 (read/write owner only)
- [ ] `.env` backed up securely (encrypted)

```bash
# Set proper permissions
chmod 600 .env

# Verify gitignore
git status | grep .env  # Should show nothing

# Check SSL verify
cat .env | grep SAFELINE_SSL_VERIFY
```

---

## 🆘 Emergency Commands

### Complete Reset
```bash
# 1. Clear all caches
rm application/cache/safeline_*
rm application/cache/waf_stats_v3.json

# 2. Re-copy .env template
cp .env.example .env

# 3. Fill credentials again
nano .env

# 4. Test
curl http://localhost/RRI-CSIRT/dashboard
```

### Quick Test API
```bash
# Test CSRF
curl https://trial-waf.rri.go.id/api/open/auth/csrf

# Test dengan credentials
curl -X POST https://trial-waf.rri.go.id/api/open/auth/login \
  -H "Content-Type: application/json" \
  -d '{"username":"smk-pkl","password":"HASH","csrf_token":"TOKEN","callback_address":"https://trial-waf.rri.go.id","test":false}'
```

---

## 📞 Help

**Documentation:**
- Setup Guide: `docs/SAFELINE_SETUP.md`
- Migration Summary: `docs/MIGRATION_SUMMARY.md`
- This Quick Ref: `docs/QUICK_REFERENCE.md`

**Logs:**
- Application: `application/logs/log-YYYY-MM-DD.php`
- Cache: `application/cache/`

**Support:**
Tim Teknologi Media Baru - RRI

---

**Last Updated:** 2026-01-26
