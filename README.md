# Safeline WAF Integration - CodeIgniter 3

## Setup

### 1. Copy Files
- `application/config/safeline.php`
- `application/libraries/Safeline_api.php`
- `application/controllers/Waf.php`

### 2. Update Password Hash
Ambil password hash dari web (saat login):
1. Buka https://trial-waf.rri.go.id
2. F12 → Network tab
3. Login → lihat request `/api/open/auth/login`
4. Copy password hash dari request body
5. Paste di `application/config/safeline.php` baris `'password_hash'`

### 3. Test Endpoint

```bash
# List all records
GET http://yourapp.com/waf/records?limit=50&offset=0

# Get one record
GET http://yourapp.com/waf/record/9d0b397f712a43119d40c4a2057bbb25

# Health check
GET http://yourapp.com/waf/health
```

## Security

- ✅ Password hash hardcoded in config (server-side only)
- ✅ JWT cached, auto-refresh on 401
- ✅ SSL verification enabled (production safe)
- ✅ Max 1 retry to prevent infinite loops
- ✅ Input validation on all endpoints
- ✅ Proper error logging

## How It Works

```
Request → Controller → Library Load
          ↓
       Check Cache (JWT)
       ├─ Found → Use JWT
       └─ Not Found → Login
                     ├─ Get CSRF Token
                     ├─ POST Login
                     ├─ Get JWT
                     └─ Cache JWT (50 min)
          ↓
       CURL Request to Safeline API
       ├─ 200 OK → Return data
       └─ 401 → Retry once with fresh JWT
          ↓
       Response JSON to Client
```

## Troubleshooting

### CURL Error
- Check SSL certificate: `CURLOPT_SSL_VERIFYPEER` should be `true`
- Check timeout: increase `request_timeout` in config if API is slow

### 401 Unauthorized after retry
- Password hash expired
- Get new hash from web (repeat Setup step 2)

### Cache not working
- Check `application/cache/` folder exists
- Check `$config['cache_adapter']` in `application/config/config.php`
