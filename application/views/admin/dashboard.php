<!-- =====================================================
     Dashboard Main View - Attack & Protection Panel
     ===================================================== -->

<!-- Welcome Banner -->
<div class="mb-8 p-6 rounded-2xl bg-gradient-to-r from-slate-800 to-slate-900 text-white relative overflow-hidden" data-aos="fade-down">
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

<!-- Attack Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Attacks -->
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm dark:shadow-none p-6 border border-gray-100 dark:border-slate-700 hover:shadow-md dark:hover:border-slate-600 transition-all relative overflow-hidden group" data-aos="fade-up" data-aos-delay="0">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-red-500 to-red-600"></div>
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Total Serangan</p>
                <p class="text-3xl font-bold text-gray-900 dark:text-white" data-count-up="<?= $stats['total_attacks'] ?>"><?= number_format($stats['total_attacks']) ?></p>
            </div>
            <div class="w-12 h-12 bg-red-100 dark:bg-red-500/20 text-red-600 dark:text-red-400 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
        </div>
        <p class="text-xs text-gray-400 dark:text-gray-500 mt-3">24 jam terakhir</p>
    </div>
    
    <!-- Blocked Attacks -->
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm dark:shadow-none p-6 border border-gray-100 dark:border-slate-700 hover:shadow-md dark:hover:border-slate-600 transition-all relative overflow-hidden group" data-aos="fade-up" data-aos-delay="100">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-green-500 to-emerald-500"></div>
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Serangan Diblokir</p>
                <p class="text-3xl font-bold text-green-600 dark:text-green-400" data-count-up="<?= $stats['blocked_attacks'] ?>"><?= number_format($stats['blocked_attacks']) ?></p>
            </div>
            <div class="w-12 h-12 bg-green-100 dark:bg-green-500/20 text-green-600 dark:text-green-400 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <p class="text-xs text-green-600 dark:text-green-400 mt-3 flex items-center gap-1">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
            Efektivitas Tinggi
        </p>
    </div>
    
    <!-- Active Threats -->
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm dark:shadow-none p-6 border border-gray-100 dark:border-slate-700 hover:shadow-md dark:hover:border-slate-600 transition-all relative overflow-hidden group" data-aos="fade-up" data-aos-delay="200">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-orange-500 to-amber-500"></div>
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Ancaman Aktif</p>
                <p class="text-3xl font-bold text-orange-600 dark:text-orange-400" data-count-up="<?= $stats['active_threats'] ?>"><?= $stats['active_threats'] ?></p>
            </div>
            <div class="w-12 h-12 bg-orange-100 dark:bg-orange-500/20 text-orange-600 dark:text-orange-400 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
        </div>
        <p class="text-xs text-orange-600 dark:text-orange-400 mt-3">Perlu investigasi</p>
    </div>
    
    <!-- Protection Level -->
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm dark:shadow-none p-6 border border-gray-100 dark:border-slate-700 hover:shadow-md dark:hover:border-slate-600 transition-all relative overflow-hidden group" data-aos="fade-up" data-aos-delay="300">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 to-indigo-500"></div>
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Tingkat Proteksi</p>
                <p class="text-3xl font-bold text-blue-600 dark:text-blue-400"><?= $stats['protection_level'] ?></p>
            </div>
            <div class="w-12 h-12 bg-blue-100 dark:bg-blue-500/20 text-blue-600 dark:text-blue-400 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>
        </div>
        <p class="text-xs text-gray-400 dark:text-gray-500 mt-3">Sistem Aman</p>
    </div>
</div>

<!-- Main Content Grid -->
<div class="grid lg:grid-cols-3 gap-6">
    <!-- Attack Activity Chart/List (Left - 2 columns) -->
    <div class="lg:col-span-2 bg-white dark:bg-slate-800 rounded-xl shadow-sm dark:shadow-none border border-gray-100 dark:border-slate-700" data-aos="fade-up" data-aos-delay="400">
        <div class="px-6 py-4 border-b border-gray-100 dark:border-slate-700 flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Aktivitas Ancaman Terbaru</h2>
            <button class="text-sm text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-medium">
                Live View <span class="animate-pulse text-red-500">●</span>
            </button>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-slate-700/50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Jenis Serangan</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Sumber</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Target</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Waktu</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-slate-700">
                    <?php foreach ($recent_threats as $threat): ?>
                    <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <?php
                                $threat_icons = [
                                    'DDoS Attack' => '<div class="p-1.5 bg-red-100 dark:bg-red-500/20 text-red-600 dark:text-red-400 rounded"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg></div>',
                                    'SQL Injection' => '<div class="p-1.5 bg-orange-100 dark:bg-orange-500/20 text-orange-600 dark:text-orange-400 rounded"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/></svg></div>',
                                    'Malware Download' => '<div class="p-1.5 bg-yellow-100 dark:bg-yellow-500/20 text-yellow-600 dark:text-yellow-400 rounded"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg></div>',
                                    'Port Scanning' => '<div class="p-1.5 bg-blue-100 dark:bg-blue-500/20 text-blue-600 dark:text-blue-400 rounded"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg></div>',
                                ];
                                echo $threat_icons[$threat['type']] ?? '<div class="p-1.5 bg-gray-100 dark:bg-gray-700 text-gray-600 rounded">?</div>';
                                ?>
                                <span class="font-medium text-gray-900 dark:text-white"><?= htmlspecialchars($threat['type']) ?></span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400 font-mono"><?= htmlspecialchars($threat['source']) ?></td>
                        <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400"><?= htmlspecialchars($threat['target']) ?></td>
                        <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400"><?= date('H:i:s', strtotime($threat['timestamp'])) ?></td>
                        <td class="px-6 py-4 text-right">
                            <?php
                            $status_styles = [
                                'blocked' => 'bg-green-100 text-green-700 dark:bg-green-500/20 dark:text-green-300',
                                'quarantined' => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-500/20 dark:text-yellow-300',
                                'detected' => 'bg-blue-100 text-blue-700 dark:bg-blue-500/20 dark:text-blue-300',
                            ];
                            $style = $status_styles[$threat['status']] ?? 'bg-gray-100 text-gray-700';
                            ?>
                            <span class="inline-flex px-2.5 py-1 text-xs font-medium rounded-full <?= $style ?>">
                                <?= ucfirst($threat['status']) ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Right Sidebar (1 column) -->
    <div class="space-y-6">
        <!-- Attack Types -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm dark:shadow-none border border-gray-100 dark:border-slate-700 p-6" data-aos="fade-left" data-aos-delay="500">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Jenis Serangan</h3>
            
            <div class="space-y-4">
                <?php
                $attack_config = [
                    'ddos' => ['label' => 'DDoS Attacks', 'color' => 'bg-red-500'],
                    'phishing' => ['label' => 'Phishing Attempts', 'color' => 'bg-orange-500'],
                    'malware' => ['label' => 'Malware', 'color' => 'bg-yellow-500'],
                    'intrusion' => ['label' => 'Intrusion Attempts', 'color' => 'bg-blue-500']
                ];
                $total_types = array_sum($attack_stats);
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
        
        <!-- Quick Actions (Updated) -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm dark:shadow-none border border-gray-100 dark:border-slate-700 p-6" data-aos="fade-left" data-aos-delay="600">
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
                
                <button class="w-full flex items-center gap-3 px-4 py-3 bg-white dark:bg-slate-700 hover:bg-gray-50 dark:hover:bg-slate-600 border border-gray-200 dark:border-slate-600 rounded-xl transition-all text-left group">
                    <div class="p-2 bg-blue-50 dark:bg-blue-500/10 rounded-lg group-hover:bg-blue-100 dark:group-hover:bg-blue-500/20 transition-colors">
                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">Scan Kerentanan</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Jalankan scan cepat</p>
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
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm dark:shadow-none border border-gray-100 dark:border-slate-700 p-6" data-aos="fade-left" data-aos-delay="700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Status Agen</h3>
            
            <div class="space-y-3">
                <div class="flex items-center justify-between p-3 bg-green-50 dark:bg-green-500/10 rounded-lg">
                    <div class="flex items-center gap-2">
                         <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                         <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">Firewall</span>
                    </div>
                    <span class="text-xs font-bold text-green-600 dark:text-green-400">ACTIVE</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-green-50 dark:bg-green-500/10 rounded-lg">
                    <div class="flex items-center gap-2">
                         <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                         <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">IDS/IPS</span>
                    </div>
                    <span class="text-xs font-bold text-green-600 dark:text-green-400">ONLINE</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-green-50 dark:bg-green-500/10 rounded-lg">
                    <div class="flex items-center gap-2">
                         <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                         <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">WAF</span>
                    </div>
                    <span class="text-xs font-bold text-green-600 dark:text-green-400">PROTECTED</span>
                </div>
            </div>
        </div>
    </div>
</div>
