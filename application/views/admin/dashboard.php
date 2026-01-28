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
    <div class="relative z-10 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold mb-2">Security Operations Center</h1>
            <p class="text-slate-300">Monitoring ancaman siber dan status perlindungan sistem secara real-time.</p>
        </div>
        <div class="text-right hidden md:block">
            <div id="live-date" class="text-sm font-bold text-slate-400 mb-1 uppercase tracking-widest"><?= date('Y-m-d') ?></div>
            <div id="live-clock" class="text-4xl font-black text-white tracking-tighter tabular-nums">00:00:00</div>
        </div>
    </div>
    <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-blue-500/10 rounded-full blur-2xl"></div>
    <div class="absolute -right-5 -bottom-5 w-24 h-24 bg-purple-500/10 rounded-full blur-xl"></div>
</div>



<!-- Main Content Grid -->
<div class="grid lg:grid-cols-3 gap-6">
    <!-- Security Overview Cards (Main Column) -->
    <div class="lg:col-span-2 space-y-6" data-aos="fade-up">


        <!-- Attack Map Box (Replaces Placeholder) -->
        <div id="map-card" class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 p-6 relative overflow-hidden transition-all duration-500">
            <div class="flex items-center justify-between mb-4 relative z-10 text-slate-800">
                <div class="flex items-center gap-3">
                    <h3 class="text-lg font-semibold dark:text-white">Live Attack Map</h3>
                    <div class="flex items-center gap-2 px-2 py-0.5 bg-red-100 dark:bg-red-500/10 rounded text-red-600 dark:text-red-400">
                        <span class="inline-block w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
                        <span class="text-[10px] font-bold uppercase tracking-wider">Real-time</span>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <button id="btn-fullscreen" class="p-2 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-lg transition-colors text-slate-400 group" title="Toggle Fullscreen">
                        <svg id="icon-fullscreen" class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                        </svg>
                    </button>
                </div>
            </div>
            <!-- Map Container -->
            <div id="attack-map-container" class="w-full h-[400px] relative rounded-lg overflow-hidden border border-slate-100 dark:border-slate-700 bg-[#e0e7ff]/30">
                <div id="attack-map" class="w-full h-full"></div>
            </div>
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


    </div>

    <!-- Right Sidebar -->
    <div class="space-y-6">
        <!-- Real-time Web Attack Card -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 overflow-hidden flex flex-col h-[520px]" data-aos="fade-up">
            <div class="p-6 pb-2 border-b border-gray-50 dark:border-slate-700/50">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Real-time Web Attack</h3>
            </div>
            
            <div id="web-attack-list" class="flex-1 overflow-y-auto custom-scrollbar p-6 space-y-4">
                <!-- Loading State -->
                <div class="flex flex-col items-center justify-center h-full text-slate-400 space-y-2 opacity-50">
                    <svg class="w-8 h-8 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span class="text-sm font-medium">Syncing events...</span>
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

<style>
/* Fullscreen Styles for the Map Card */
#map-card:-webkit-full-screen {
    width: 100vw !important;
    height: 100vh !important;
    padding: 2rem !important;
    background-color: #f8fafc !important;
    border: none !important;
    border-radius: 0 !important;
}

#map-card:fullscreen {
    width: 100vw !important;
    height: 100vh !important;
    padding: 2rem !important;
    background-color: #f8fafc !important;
    border: none !important;
    border-radius: 0 !important;
}

#map-card.is-fullscreen #attack-map-container {
    height: calc(100vh - 120px) !important;
}

#map-card.is-fullscreen h3 {
    font-size: 1.5rem !important;
    color: #1e293b !important;
}
</style>

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

    // Theme Colors based on user photo
    const MAP_THEME = {
        ocean: '#dee6ed', // Light Grey Blue
        land: '#ffffff',  // White
        border: '#cbd5e1', 
        lineStart: '#fb7185', // Pink
        lineEnd: '#8b5cf6',   // Purple
        target: '#22c55e',   // Green
        attacker: '#ef4444'  // Red
    };

    // -----------------------------------------------------
    // Map Initialization
    // -----------------------------------------------------
    function initMap() {
        const dom = document.getElementById('attack-map');
        if (!dom) return;

        chartInstance = echarts.init(dom, null, {
            renderer: 'canvas',
            useDirtyRect: false
        });

        // Load World Map JSON
        $.getJSON('https://fastly.jsdelivr.net/npm/echarts@4.9.0/map/json/world.json', function (data) {
            echarts.registerMap('world', data);
            
            const option = {
                backgroundColor: MAP_THEME.ocean,
                tooltip: {
                    trigger: 'item',
                    backgroundColor: 'rgba(255, 255, 255, 0.95)',
                    borderColor: '#e2e8f0',
                    textStyle: { color: '#1e293b' },
                    padding: 8,
                    borderRadius: 8,
                    extraCssText: 'box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1); border: 1px solid #e2e8f0;',
                    formatter: function(params) {
                        if (params.seriesType === 'lines') {
                            const d = params.data;
                            return `
                                <div class="text-xs p-1">
                                    <div class="font-bold text-red-600 mb-1 border-b border-red-100 pb-1 uppercase tracking-tight">ATTACK DETECTED</div>
                                    <div class="space-y-1 mt-1">
                                        <div><span class="text-slate-500 font-medium">IP:</span> <span class="font-mono text-slate-800">${d.ip}</span></div>
                                        <div><span class="text-slate-500 font-medium">From:</span> ${d.fromName}${d.location ? ' • ' + d.location : ''}</div>
                                        <div><span class="text-slate-500 font-medium">Target:</span> ${d.toName}</div>
                                        <div><span class="text-slate-500 font-medium">Module:</span> <span class="text-blue-600 font-semibold">${d.type}</span></div>
                                    </div>
                                </div>
                            `;
                        }
                        return null;
                    }
                },
                geo: {
                    map: 'world',
                    roam: true,
                    scaleLimit: { min: 1, max: 10 },
                    center: [106, 15],
                    zoom: 1.5,
                    boundingCoords: [
                        [-180, 85],
                        [180, -60]
                    ],
                    label: { emphasis: { show: false } },
                    itemStyle: {
                        normal: {
                            areaColor: MAP_THEME.land, 
                            borderColor: MAP_THEME.border,
                            borderWidth: 0.5
                        },
                        emphasis: {
                            areaColor: '#f1f5f9'
                        }
                    }
                },
                series: [
                    {
                        name: 'Attack Lines',
                        type: 'lines',
                        effect: {
                            show: true,
                            period: 3,
                            trailLength: 0.4,
                            color: MAP_THEME.lineStart,
                            symbolSize: 3,
                            delay: function(idx) { return idx * 200; }
                        },
                        lineStyle: {
                            normal: {
                                color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                                    offset: 0, color: MAP_THEME.lineStart
                                }, {
                                    offset: 1, color: MAP_THEME.lineEnd
                                }]),
                                width: 1.2,
                                opacity: 0.4,
                                curveness: 0.2
                            }
                        },
                        data: [] 
                    },
                    {
                        name: 'Attack Points',
                        type: 'effectScatter',
                        coordinateSystem: 'geo',
                        rippleEffect: {
                            brushType: 'stroke',
                            scale: 3,
                            period: 4
                        },
                        symbolSize: 6,
                        itemStyle: {
                            normal: { color: MAP_THEME.attacker }
                        },
                        label: {
                            show: true,
                            position: 'top',
                            distance: 12,
                            formatter: function(params) {
                                // params.name is country
                                // params.value[3] is IP
                                // params.value[4] is Location (Province/City)
                                return `{country|${params.name}} {loc|${params.value[4] || ''}} {ip|${params.value[3] || ''}}`;
                            },
                            rich: {
                                country: {
                                    backgroundColor: '#ef4444',
                                    color: '#fff',
                                    padding: [2, 6],
                                    borderRadius: [4, 0, 0, 4],
                                    fontSize: 10,
                                    fontWeight: 'bold'
                                },
                                loc: {
                                    backgroundColor: '#f1f5f9',
                                    color: '#475569',
                                    padding: [2, 6],
                                    fontSize: 9,
                                    fontWeight: 'medium',
                                    borderColor: '#e2e8f0',
                                    borderWidth: 1
                                },
                                ip: {
                                    backgroundColor: '#fff',
                                    color: '#1e293b',
                                    padding: [2, 6],
                                    borderRadius: [0, 4, 4, 0],
                                    fontSize: 10,
                                    borderColor: '#e2e8f0',
                                    borderWidth: 1
                                }
                            }
                        },
                        data: []
                    },
                    {
                        name: 'Target Point',
                        type: 'effectScatter',
                        coordinateSystem: 'geo',
                        rippleEffect: {
                            brushType: 'fill',
                            period: 2,
                            scale: 5
                        },
                        label: {
                            normal: {
                                show: true,
                                position: 'right',
                                formatter: '{b}',
                                fontSize: 10,
                                fontWeight: 'bold',
                                color: '#059669',
                                backgroundColor: 'rgba(255,255,255,0.8)',
                                padding: [2, 6],
                                borderRadius: 4,
                                borderColor: '#10b981',
                                borderWidth: 1
                            }
                        },
                        symbolSize: 12,
                        symbol: 'pin',
                        itemStyle: {
                            normal: {
                                color: MAP_THEME.target,
                                shadowBlur: 10,
                                shadowColor: 'rgba(34, 197, 94, 0.4)'
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

        // 1. Filter unique entries by IP to ensure variety
        const uniqueEntries = new Map();
        [...records].reverse().forEach(r => {
            const key = r.ip || r.src_ip || 'Unknown';
            if (!uniqueEntries.has(key)) uniqueEntries.set(key, r);
        });

        const lineData = [];
        const scatterData = [];
        const usedCoords = new Set();

        /**
         * Enhanced Jitter:
         * Prevents points from stacking exactly on top of each other.
         * Uses smaller jitter for precise coords, larger for center fallbacks.
         */
        const applySmartJitter = (coords, isPrecise) => {
            const range = isPrecise ? 0.3 : 3.5; // Narrow spread for real cities, wide for country centers
            const key = coords[0].toFixed(2) + ',' + coords[1].toFixed(2);
            
            if (usedCoords.has(key)) {
                return [
                    coords[0] + (Math.random() - 0.5) * range,
                    coords[1] + (Math.random() - 0.5) * range
                ];
            }
            usedCoords.add(key);
            return coords;
        };

        // Increase limit to 100 for a more "active" look
        const entries = Array.from(uniqueEntries.values()).slice(0, 100);

        entries.forEach((record) => {
            const country = record.country || 'ID';
            const src_ip = record.ip || record.src_ip || 'Unknown';
            const module = record.module || 'Web Detection';
            const target_host = record.host || 'RRI SOC';
            
            let isPrecise = false;
            let locationName = '';
            
            if (record.coords && record.coords.city) {
                locationName = record.coords.city;
                isPrecise = true;
            } else if (record.coords && record.coords.region) {
                locationName = record.coords.region;
                isPrecise = true;
            } else if (record.province && record.province !== '-') {
                locationName = record.province;
            } else if (record.city && record.city !== '-') {
                locationName = record.city;
            }

            let startCoords = null;
            if (record.coords && record.coords.lon && record.coords.lat) {
                startCoords = [record.coords.lon, record.coords.lat];
                isPrecise = true;
            } else if (COUNTRY_COORDS[country]) {
                startCoords = [...COUNTRY_COORDS[country]];
                isPrecise = false;
            } else {
                startCoords = [0, 0];
            }

            if (!startCoords || (startCoords[0] === 0 && startCoords[1] === 0)) return;

            // Apply smart jitter to separate overlapping hits
            const finalCoords = applySmartJitter(startCoords, isPrecise);

            lineData.push({
                fromName: country,
                toName: target_host,
                coords: [finalCoords, JAKARTA_COORDS],
                type: module,
                ip: src_ip,
                location: locationName
            });

            scatterData.push({
                name: country,
                // value: [lon, lat, size, ip, location]
                value: [...finalCoords, 10, src_ip, locationName], 
            });
        });

        // Limit labels to first 5 for clarity
        const scatterFinal = scatterData.map((d, i) => {
            if (i > 5) return { ...d, label: { show: false } };
            return d;
        });

        chartInstance.setOption({
            series: [
                { data: lineData }, 
                { data: scatterFinal }, 
                { data: [{ name: 'RRI Server', value: [...JAKARTA_COORDS, 100] }] } 
            ]
        }, {
            notMerge: false,
            lazyUpdate: true
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
                    
                    if (totalElem) totalElem.innerText = Number(result.data.summary.total_attacks || 0).toLocaleString();
                    if (blockedElem) blockedElem.innerText = Number(result.data.summary.blocked_attacks || 0).toLocaleString();
                }

                const events = result.data.events || [];
                const records = result.data.records || [];
                const attacks = [...events, ...records]; 
                
                updateMapData(attacks);
                updateWebAttackList(events);
            }
        } catch (error) {
            console.log('Stats refresh skipped', error);
        }
    }

    // -----------------------------------------------------
    // Web Attack List Rendering
    // -----------------------------------------------------
    function updateWebAttackList(events) {
        const listContainer = document.getElementById('web-attack-list');
        if (!listContainer || !events.length) return;

        const html = events.map(record => {
            const date = new Date(record.timestamp * 1000);
            const formattedDate = date.getFullYear() + '-' + 
                                String(date.getMonth() + 1).padStart(2, '0') + '-' + 
                                String(date.getDate()).padStart(2, '0') + ' ' + 
                                String(date.getHours()).padStart(2, '0') + ':' + 
                                String(date.getMinutes()).padStart(2, '0') + ':' + 
                                String(date.getSeconds()).padStart(2, '0');

            return `
                <div class="flex items-start justify-between py-4 border-b border-gray-50 dark:border-slate-700/50 last:border-0 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors px-2 -mx-2 rounded-lg group">
                    <div class="space-y-1">
                        <div class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-indigo-500 shadow-[0_0_8px_rgba(99,102,241,0.6)]"></span>
                            <span class="font-bold text-slate-900 dark:text-white tracking-tight">${record.src_ip}</span>
                        </div>
                        <div class="text-[11px] text-slate-400 font-medium pl-3.5">
                            ${formattedDate}
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="font-bold text-slate-800 dark:text-slate-200 text-sm">${record.country}</div>
                        <div class="text-xs font-bold text-rose-500 mt-1">${record.count || 0}</div>
                    </div>
                </div>
            `;
        }).join('');

        listContainer.innerHTML = html;
    }

    // -----------------------------------------------------
    // Live Clock
    // -----------------------------------------------------
    function startClock() {
        const clockElem = document.getElementById('live-clock');
        const dateElem = document.getElementById('live-date');
        if (!clockElem) return;

        setInterval(() => {
            const now = new Date();
            clockElem.innerText = now.getHours().toString().padStart(2, '0') + ':' + 
                                now.getMinutes().toString().padStart(2, '0') + ':' + 
                                now.getSeconds().toString().padStart(2, '0');
            
            if (now.getSeconds() === 0) {
                dateElem.innerText = now.getFullYear() + '-' + 
                                    (now.getMonth() + 1).toString().padStart(2, '0') + '-' + 
                                    now.getDate().toString().padStart(2, '0');
            }
        }, 1000);
    }
    
    startClock();

    // -----------------------------------------------------
    // Fullscreen Logic
    // -----------------------------------------------------
    const mapCard = document.getElementById('map-card');
    const btnFullscreen = document.getElementById('btn-fullscreen');
    const iconFullscreen = document.getElementById('icon-fullscreen');

    function toggleFullscreen() {
        if (!document.fullscreenElement) {
            if (mapCard.requestFullscreen) {
                mapCard.requestFullscreen();
            } else if (mapCard.webkitRequestFullscreen) { /* Safari */
                mapCard.webkitRequestFullscreen();
            } else if (mapCard.msRequestFullscreen) { /* IE11 */
                mapCard.msRequestFullscreen();
            }
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.webkitExitFullscreen) { /* Safari */
                document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) { /* IE11 */
                document.msExitFullscreen();
            }
        }
    }

    if (btnFullscreen) {
        btnFullscreen.addEventListener('click', toggleFullscreen);
    }

    // Keyboard shortcut 'F' for fullscreen
    document.addEventListener('keydown', function(e) {
        if (e.key.toLowerCase() === 'f' && !e.ctrlKey && !e.altKey && !e.shiftKey) {
            if (document.activeElement.tagName !== 'INPUT' && document.activeElement.tagName !== 'TEXTAREA') {
                toggleFullscreen();
            }
        }
    });

    const handleFullscreenChange = () => {
        if (document.fullscreenElement || document.webkitFullscreenElement || document.mozFullScreenElement || document.msFullscreenElement) {
            mapCard.classList.add('is-fullscreen');
            iconFullscreen.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />';
        } else {
            mapCard.classList.remove('is-fullscreen');
            iconFullscreen.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />';
        }
        setTimeout(() => { if (chartInstance) chartInstance.resize(); }, 150);
    };

    document.addEventListener('fullscreenchange', handleFullscreenChange);
    document.addEventListener('webkitfullscreenchange', handleFullscreenChange);

    // Initialize
    initMap();
    
    // Initial fetch after 1s
    setTimeout(refreshDashboardStats, 1000);
    // Poll every 10s (Slower poll to allow animations to play out)
    setInterval(refreshDashboardStats, 10000);
});
</script>
