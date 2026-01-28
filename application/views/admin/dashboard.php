<!-- =====================================================
     Dashboard Main View - Attack & Protection Panel
     ===================================================== -->

<!-- Welcome Banner -->
<div class="mb-8 p-6 rounded-2xl bg-gradient-to-r from-slate-800 to-slate-900 text-white relative overflow-hidden" data-aos="fade-up">
    <div class="absolute inset-0 opacity-20">
        <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="dash-grid" width="40" height="40" patternUnits="userSpaceOnUse">
                    <path d="M 40 0 L 0 0 0 40" fill="none" stroke="currentColor" stroke-width="0.5"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#dash-grid)"/>
        </svg>
    </div>
    <div class="relative z-10">
        <h1 class="text-2xl font-bold mb-2">Security Operations Center</h1>
        <p class="text-slate-300">Monitoring ancaman siber dan status perlindungan sistem secara real-time.</p>
    </div>
    <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-blue-500/10 rounded-full blur-2xl"></div>
    <div class="absolute -right-5 -bottom-5 w-24 h-24 bg-purple-500/10 rounded-full blur-xl"></div>
</div>



<!-- Main Content Grid -->
<div class="grid lg:grid-cols-3 gap-6">
    <!-- Security Overview Cards (Main Column) -->
    <div class="lg:col-span-2 space-y-6" data-aos="fade-up">
        <!-- Quick Stats Row -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <!-- Total Attacks Today -->
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 p-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-red-100 dark:bg-red-500/10 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white" id="stat-total-attacks" data-count-up="<?= $stats['total_attacks'] ?? 0 ?>"><?= number_format($stats['total_attacks'] ?? 0) ?></p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Serangan Hari Ini</p>
                    </div>
                </div>
            </div>

            <!-- Blocked Attacks -->
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 p-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-green-100 dark:bg-green-500/10 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white" id="stat-blocked-attacks" data-count-up="<?= $stats['blocked_attacks'] ?? 0 ?>"><?= number_format($stats['blocked_attacks'] ?? 0) ?></p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Diblokir</p>
                    </div>
                </div>
            </div>

            <!-- Protected Sites -->
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 p-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-100 dark:bg-blue-500/10 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white" data-count-up="<?= $stats['protected_sites'] ?? 12 ?>"><?= $stats['protected_sites'] ?? 12 ?></p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Situs Dilindungi</p>
                    </div>
                </div>
            </div>

            <!-- Uptime -->
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 p-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-purple-100 dark:bg-purple-500/10 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">99.9%</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Uptime WAF</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Attack Map Box (Replaces Placeholder) -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 p-6 relative overflow-hidden">
            <div class="flex items-center justify-between mb-4 relative z-10">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Live Attack Map</h3>
                <div class="flex items-center gap-2">
                    <span class="inline-block w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
                    <span class="text-xs text-gray-400 dark:text-gray-500">Real-time</span>
                </div>
            </div>
            <!-- Map Container -->
            <div id="attack-map" class="w-full h-[400px]"></div>
        </div>

        <!-- WAF Activity Card with Link -->
        <div class="bg-gradient-to-br from-blue-600 to-blue-800 dark:from-blue-700 dark:to-blue-900 rounded-xl shadow-lg p-6 relative overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="waf-pattern" width="30" height="30" patternUnits="userSpaceOnUse">
                            <path d="M 30 0 L 0 0 0 30" fill="none" stroke="white" stroke-width="0.5"/>
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#waf-pattern)"/>
                </svg>
            </div>
            <div class="relative z-10">
                <div class="flex items-start justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-2">Aktivitas Serangan WAF</h3>
                        <p class="text-blue-100 text-sm mb-4">Lihat log serangan dan kejadian keamanan secara real-time dari Safeline WAF.</p>
                        
                        <div class="flex items-center gap-4 mb-4">
                            <div class="flex items-center gap-2">
                                <span class="relative flex h-2 w-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                                </span>
                                <span class="text-sm text-blue-100">WAF Active</span>
                            </div>
                            <span class="text-blue-200 text-sm">•</span>
                            <span class="text-sm text-blue-100"><?= count($recent_logs ?? []) ?> log terbaru</span>
                        </div>
                    </div>
                    <div class="w-16 h-16 bg-white/10 rounded-xl flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                </div>
                
                <a href="<?= base_url('admin/security-waf-activity') ?>" 
                   class="inline-flex items-center gap-2 px-4 py-2 bg-white text-blue-600 font-medium rounded-lg hover:bg-blue-50 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    Lihat Detail Serangan
                </a>
            </div>
            <div class="absolute -right-8 -bottom-8 w-32 h-32 bg-white/5 rounded-full blur-xl"></div>
        </div>

        <!-- Placeholder for Future Content -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Ringkasan Infrastruktur</h3>
                <span class="text-xs text-gray-400 dark:text-gray-500">Coming Soon</span>
            </div>
            <div class="grid grid-cols-3 gap-4 text-center">
                <div class="p-4 bg-gray-50 dark:bg-slate-700/50 rounded-lg">
                    <p class="text-2xl font-bold text-gray-900 dark:text-white" data-count-up="4">4</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Data Center</p>
                </div>
                <div class="p-4 bg-gray-50 dark:bg-slate-700/50 rounded-lg">
                    <p class="text-2xl font-bold text-gray-900 dark:text-white" data-count-up="68">68</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Satker VPN</p>
                </div>
                <div class="p-4 bg-gray-50 dark:bg-slate-700/50 rounded-lg">
                    <p class="text-2xl font-bold text-gray-900 dark:text-white" data-count-up="254">254</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">IP Terkelola</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Sidebar -->
    <div class="space-y-6">
        <!-- Attack Types -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 p-6" data-aos="fade-up">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Jenis Serangan</h3>
            
            <div class="space-y-4">
                <?php
                $attack_config = [
                    'ddos' => ['label' => 'DDoS Attacks', 'color' => 'bg-red-500'],
                    'phishing' => ['label' => 'Phishing Attempts', 'color' => 'bg-orange-500'],
                    'malware' => ['label' => 'Malware', 'color' => 'bg-yellow-500'],
                    'intrusion' => ['label' => 'Intrusion Attempts', 'color' => 'bg-blue-500']
                ];
                $total_types = array_sum($attack_stats ?? []);
                ?>
                
                <?php foreach ($attack_config as $key => $config): ?>
                    <?php 
                    $count = $attack_stats[$key] ?? 0;
                    $percentage = $total_types > 0 ? round(($count / $total_types) * 100) : 0;
                    ?>
                    <div>
                        <div class="flex items-center justify-between text-sm mb-1">
                            <span class="font-medium text-gray-700 dark:text-gray-300"><?= $config['label'] ?></span>
                            <span class="text-gray-500 dark:text-gray-400"><?= $count ?></span>
                        </div>
                        <div class="w-full h-2 bg-gray-100 dark:bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full <?= $config['color'] ?> rounded-full" style="width: <?= $percentage ?>%"></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 p-6" data-aos="fade-up" data-aos-delay="100">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Kontrol Keamanan</h3>
            
            <div class="space-y-3">
                <button class="w-full flex items-center gap-3 px-4 py-3 bg-white dark:bg-slate-700 hover:bg-gray-50 dark:hover:bg-slate-600 border border-gray-200 dark:border-slate-600 rounded-xl transition-all text-left group">
                    <div class="p-2 bg-red-50 dark:bg-red-500/10 rounded-lg group-hover:bg-red-100 dark:group-hover:bg-red-500/20 transition-colors">
                        <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">Blokir IP</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Tambahkan ke blacklist</p>
                    </div>
                </button>
                
                <a href="<?= base_url('admin/reports') ?>" class="w-full flex items-center gap-3 px-4 py-3 bg-white dark:bg-slate-700 hover:bg-gray-50 dark:hover:bg-slate-600 border border-gray-200 dark:border-slate-600 rounded-xl transition-all text-left group">
                    <div class="p-2 bg-gray-50 dark:bg-gray-600/30 rounded-lg group-hover:bg-gray-100 dark:group-hover:bg-gray-600/50 transition-colors">
                        <svg class="w-5 h-5 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">Laporan Keamanan</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Download PDF</p>
                    </div>
                </a>
            </div>
        </div>
        
        <!-- System Status -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 p-6" data-aos="fade-up" data-aos-delay="200">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Status Agen</h3>
            
            <div class="space-y-3">
                <div class="flex items-center justify-between p-3 bg-green-50 dark:bg-green-500/10 rounded-lg">
                    <div class="flex items-center gap-2">
                         <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                         <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">WAF Protection</span>
                    </div>
                    <span class="text-xs font-bold text-green-600 dark:text-green-400">ACTIVE</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-blue-50 dark:bg-blue-500/10 rounded-lg">
                    <div class="flex items-center gap-2">
                         <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                         <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">SSL Status</span>
                    </div>
                    <span class="text-xs font-bold text-blue-600 dark:text-blue-400">SECURE</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mt-8 text-center" data-aos="fade-up">
    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Selamat Datang di SOC RRI</h2>
    <p class="text-gray-500 dark:text-gray-400 max-w-md mx-auto">Sistem monitoring keamanan terpadu untuk perlindungan aset digital Radio Republik Indonesia.</p>
</div>

<!-- ECharts & Map Scripts -->
<script src="https://cdn.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // -----------------------------------------------------
    // Configuration
    // -----------------------------------------------------
    const JAKARTA_COORDS = [106.8456, -6.2088]; // Target Location (RRI)
    
    // Expanded Country Coordinates to ensure matches
    const COUNTRY_COORDS = {
        // Move ID/Indonesia to Central Indonesia (Kalimantan) so domestic lines to Jakarta are visible
        'Indonesia': [113.9213, -0.7893], 'ID': [113.9213, -0.7893],
        'United States': [-95.7, 37.1], 'US': [-95.7, 37.1], 'USA': [-95.7, 37.1],

        'China': [104.2, 35.9], 'CN': [104.2, 35.9],
        'Russia': [105.3, 61.5], 'RU': [105.3, 61.5],
        'Brazil': [-51.9, -14.2], 'BR': [-51.9, -14.2],
        'India': [78.9, 20.6], 'IN': [78.9, 20.6],
        'Germany': [10.4, 51.2], 'DE': [10.4, 51.2],
        'United Kingdom': [-3.4, 55.4], 'UK': [-3.4, 55.4], 'GB': [-3.4, 55.4],
        'France': [2.2, 46.2], 'FR': [2.2, 46.2],
        'Italy': [12.6, 41.9], 'IT': [12.6, 41.9],
        'Canada': [-106.3, 56.1], 'CA': [-106.3, 56.1],
        'Australia': [133.8, -25.3], 'AU': [133.8, -25.3],
        'Japan': [138.3, 36.2], 'JP': [138.3, 36.2],
        'South Korea': [127.8, 35.9], 'KR': [127.8, 35.9],
        'Netherlands': [5.3, 52.1], 'NL': [5.3, 52.1],
        'Singapore': [103.8, 1.4], 'SG': [103.8, 1.4],
        'Malaysia': [102.0, 4.2], 'MY': [102.0, 4.2],
        'Vietnam': [108.3, 14.1], 'VN': [108.3, 14.1],
        'Thailand': [101.0, 15.9], 'TH': [101.0, 15.9],
        'Taiwan': [121.0, 23.7], 'TW': [121.0, 23.7],
        'Hong Kong': [114.2, 22.3], 'HK': [114.2, 22.3],
        'Ukraine': [31.2, 48.4], 'UA': [31.2, 48.4],
        'Iran': [53.7, 32.4], 'IR': [53.7, 32.4],
        'Turkey': [35.2, 39.0], 'TR': [35.2, 39.0],
        'Israel': [34.9, 31.0], 'IL': [34.9, 31.0],
        'Poland': [19.1, 51.9], 'PL': [19.1, 51.9],
        'Sweden': [18.6, 60.1], 'SE': [18.6, 60.1],
        'Spain': [-3.7, 40.5], 'ES': [-3.7, 40.5],
        'Mexico': [-102.6, 23.6], 'MX': [-102.6, 23.6],
        'Argentina': [-63.6, -38.4], 'AR': [-63.6, -38.4],
        'South Africa': [22.9, -30.6], 'ZA': [22.9, -30.6],
        'Egypt': [30.8, 26.8], 'EG': [30.8, 26.8],
        'Saudi Arabia': [45.1, 23.9], 'SA': [45.1, 23.9],
        'Pakistan': [69.3, 30.4], 'PK': [69.3, 30.4],
        'Bangladesh': [90.4, 23.7], 'BD': [90.4, 23.7],
        'Philippines': [121.8, 12.9], 'PH': [121.8, 12.9],
        'New Zealand': [174.9, -40.9], 'NZ': [174.9, -40.9],
        'Switzerland': [8.2, 46.8], 'CH': [8.2, 46.8],
        'Belgium': [4.5, 50.5], 'BE': [4.5, 50.5],
        'Austria': [14.6, 47.5], 'AT': [14.6, 47.5],
        'Norway': [8.5, 60.5], 'NO': [8.5, 60.5],
        'Denmark': [9.5, 56.3], 'DK': [9.5, 56.3],
        'Finland': [25.7, 61.9], 'FI': [25.7, 61.9],
        'Ireland': [-8.2, 53.4], 'IE': [-8.2, 53.4],
        'Portugal': [-8.2, 39.4], 'PT': [-8.2, 39.4],
        'Greece': [21.8, 39.1], 'GR': [21.8, 39.1],
        'Romania': [25.0, 45.9], 'RO': [25.0, 45.9],
        'Hungary': [19.5, 47.2], 'HU': [19.5, 47.2],
        'Czech Republic': [15.5, 49.8], 'CZ': [15.5, 49.8],
        'Mauritius': [57.5, -20.3], 'MU': [57.5, -20.3],
        'Lebanon': [35.5, 33.9], 'LB': [35.5, 33.9],
    };

    let chartInstance = null;
    let isMapLoaded = false;

    // -----------------------------------------------------
    // Map Initialization
    // -----------------------------------------------------
    function initMap() {
        const dom = document.getElementById('attack-map');
        if (!dom) return;

        chartInstance = echarts.init(dom, 'dark', {
            renderer: 'canvas',
            useDirtyRect: false
        });

        // Load World Map JSON
        $.getJSON('https://fastly.jsdelivr.net/npm/echarts@4.9.0/map/json/world.json', function (data) {
            echarts.registerMap('world', data);
            
            const option = {
                backgroundColor: 'transparent',
                tooltip: {
                    trigger: 'item',
                    backgroundColor: 'rgba(15, 23, 42, 0.9)', // Slate-900 transparent
                    borderColor: '#334155',
                    textStyle: { color: '#f8fafc' },
                    formatter: function(params) {
                        // FIX: Check if it's a line or a point
                        if (params.seriesType === 'lines') {
                            const data = params.data;
                            return `
                                <div class="font-bold border-b border-gray-600 pb-1 mb-1">Attack Detected</div>
                                <div class="text-xs">
                                    <span class="text-red-400">Src:</span> ${data.fromName}${data.location ? ', ' + data.location : ''} <span class="text-gray-400">(${data.ip})</span><br/>
                                    <span class="text-green-400">Dst:</span> ${data.toName}<br/>
                                    <span class="text-blue-400">Type:</span> ${data.type}
                                </div>
                            `;
                        } else if (params.seriesType === 'effectScatter') {
                            const data = params.data;
                            // Custom tooltip for RRI Server vs Attacker Node
                            if (data.name === 'RRI Server') {
                                return `
                                    <div class="font-bold text-green-400">RRI Server (Protected)</div>
                                    <div class="text-xs text-gray-300">Location: Jakarta, ID</div>
                                `;
                            } else {
                                return `<div class="font-bold text-red-400">${data.name}</div><div class="text-xs text-gray-300">${data.location || 'Attacker Source'}</div>`;
                            }
                        }
                    }
                },
                geo: {
                    map: 'world',
                    roam: 'scale', // Only Zoom allowed (No Panning/Dragging)
                    silent: true,
                    label: {
                        emphasis: { show: false }
                    },
                    itemStyle: {
                        normal: {
                            areaColor: '#1e293b', 
                            borderColor: '#0f172a',
                            borderWidth: 1
                        },
                        emphasis: {
                            areaColor: '#334155'
                        }
                    },
                    zoom: 4, // Default Zoom In
                    center: [115, -2] // Focus on Indonesia
                },
                series: [
                    {
                        name: 'Attack Lines',
                        type: 'lines',
                        zlevel: 1,
                        effect: {
                            show: true,
                            period: 2, // Faster animation
                            trailLength: 0.2, // Shorter trail for cleaner look
                            color: '#fb7185', // Rose-400
                            symbolSize: 4
                        },
                        lineStyle: {
                            normal: {
                                color: '#f43f5e', // Rose-500
                                width: 0.5,
                                opacity: 0.1, // Faint tracer
                                curveness: 0.3
                            }
                        },
                        data: [] 
                    },
                    {
                        name: 'Attack Points',
                        type: 'effectScatter',
                        coordinateSystem: 'geo',
                        zlevel: 2,
                        rippleEffect: {
                            brushType: 'fill',
                            scale: 4
                        },
                        symbolSize: 6,
                        itemStyle: {
                            normal: { color: '#ef4444' }
                        },
                        data: []
                    },
                    {
                        name: 'Target Point',
                        type: 'effectScatter',
                        coordinateSystem: 'geo',
                        zlevel: 3,
                        rippleEffect: {
                            brushType: 'stroke',
                            period: 4,
                            scale: 6
                        },
                        label: {
                            normal: {
                                show: true,
                                position: 'right',
                                formatter: '{b}',
                                fontSize: 12,
                                fontWeight: 'bold',
                                color: '#4ade80',
                                backgroundColor: 'rgba(0,0,0,0.5)',
                                padding: [4, 8],
                                borderRadius: 4
                            }
                        },
                        symbolSize: 15,
                        symbol: 'diamond',
                        itemStyle: {
                            normal: {
                                color: '#22c55e',
                                shadowBlur: 10,
                                shadowColor: '#22c55e'
                            }
                        },
                        data: [{
                            name: 'RRI Server',
                            value: [...JAKARTA_COORDS, 100],
                        }]
                    }
                ]
            };

            chartInstance.setOption(option);
            isMapLoaded = true;
            
            // Resize handler
            window.addEventListener('resize', function() {
                chartInstance.resize();
            });
        });
    }

    // -----------------------------------------------------
    // Data Processing & Updates
    // -----------------------------------------------------
    function updateMapData(records) {
        if (!isMapLoaded || !chartInstance) return;

        console.log("Updating Map Data with:", records.length, "records");

        const lineData = [];
        const scatterData = [];

        // Limit to recent 20 for visual clarity and effectiveness of animation
        // Sort by timestamp if available to animate chronologically? 
        // Or just take the list as is (usually latest first). 
        // Let's reverse it so the "oldest" of the recent batch starts first? 
        // Or just animate 1-by-1 in the list.
        const recent = records.slice(0, 20);

        recent.forEach((record, idx) => {
            const country = record.country || 'Unknown';
            const src_ip = record.src_ip || 'Unknown';
            const module = record.module || 'Web Detection';
            const target_host = record.host || 'RRI Server';
            
            let startCoords = null;
            let locationName = '';
            
            // PRIORITY 1: Use precise coordinates from tracking API (provided by backend)
            if (record.coords && record.coords.lon && record.coords.lat) {
                startCoords = [record.coords.lon, record.coords.lat];
                locationName = (record.coords.city ? record.coords.city + ', ' : '') + (record.coords.region || '');
            } 
            // PRIORITY 2: Fallback to country centers
            else if (COUNTRY_COORDS[country]) {
                startCoords = COUNTRY_COORDS[country];
            } else {
                const upper = country.toUpperCase();
                const foundKey = Object.keys(COUNTRY_COORDS).find(k => 
                    k.toUpperCase() === upper || 
                    k.toUpperCase().includes(upper) || 
                    upper.includes(k.toUpperCase())
                );
                
                if (foundKey) {
                    startCoords = COUNTRY_COORDS[foundKey];
                } else {
                     startCoords = [0, 0]; 
                }
            }

            if (!startCoords) return;

            // Create Line: Source -> Target Host
            lineData.push({
                fromName: country,
                toName: target_host,
                coords: [startCoords, JAKARTA_COORDS],
                type: module,
                ip: src_ip,
                location: locationName,
                // Custom property for delay calculation
                index: idx 
            });

            // Create Scatter for Source
            scatterData.push({
                name: country,
                location: locationName,
                value: [...startCoords, 10], 
            });
        });

        chartInstance.setOption({
            series: [
                { 
                    name: 'Attack Lines',
                    type: 'lines',
                    zlevel: 1,
                    effect: {
                        show: true,
                        period: 4, 
                        trailLength: 0.5, // Longer trail
                        color: '#fb7185', 
                        symbolSize: 4,
                        // One by One Animation Logic
                        // Delay based on index: 500ms separation
                        delay: function (idx) {
                            return idx * 1000;
                        }
                    },
                    lineStyle: {
                        normal: {
                            color: '#f43f5e', 
                            width: 0.2, // Thinner lines to reduce clutter
                            opacity: 0.1, 
                            curveness: 0.3
                        }
                    },
                    data: lineData 
                }, 
                { 
                    data: scatterData 
                }, 
                { 
                     data: [{
                        name: 'RRI Server',
                        value: [...JAKARTA_COORDS, 100],
                    }]
                } 
            ]
        });
    }

    // -----------------------------------------------------
    // Data Fetching
    // -----------------------------------------------------
    async function refreshDashboardStats() {
        try {
            const response = await fetch('<?= base_url("waf/dashboard_live") ?>?t=' + new Date().getTime());
            if (!response.ok) return;
            const result = await response.json();
            
            if (result.success && result.data) {
                if (result.data.summary) {
                    const totalElem = document.getElementById('stat-total-attacks');
                    const blockedElem = document.getElementById('stat-blocked-attacks');
                    // Stats update logic here if needed...
                }

                const events = result.data.events || [];
                const records = result.data.records || [];
                const attacks = [...events, ...records]; 
                
                updateMapData(attacks);
            }
        } catch (error) {
            console.log('Stats refresh skipped', error);
        }
    }

    // Initialize
    initMap();
    
    // Initial fetch after 1s
    setTimeout(refreshDashboardStats, 1000);
    // Poll every 10s (Slower poll to allow animations to play out)
    setInterval(refreshDashboardStats, 10000);
});
</script>
