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
                        <p class="text-2xl font-bold text-gray-900 dark:text-white" id="stat-total-attacks"><?= number_format($stats['total_attacks'] ?? 0) ?></p>
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
                        <p class="text-2xl font-bold text-gray-900 dark:text-white" id="stat-blocked-attacks"><?= number_format($stats['blocked_attacks'] ?? 0) ?></p>
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
                        <p class="text-2xl font-bold text-gray-900 dark:text-white"><?= $stats['protected_sites'] ?? 12 ?></p>
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

        <!-- Placeholder Box -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Data Tambahan</h3>
                <span class="text-xs text-gray-400 dark:text-gray-500">Placeholder</span>
            </div>
            <div class="h-24 flex items-center justify-center border-2 border-dashed border-gray-200 dark:border-slate-600 rounded-lg">
                <p class="text-gray-400 dark:text-gray-500 text-sm">Area untuk konten tambahan</p>
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

        <!-- Placeholder for Future Content -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Ringkasan Infrastruktur</h3>
                <span class="text-xs text-gray-400 dark:text-gray-500">Coming Soon</span>
            </div>
            <div class="grid grid-cols-3 gap-4 text-center">
                <div class="p-4 bg-gray-50 dark:bg-slate-700/50 rounded-lg">
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">4</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Data Center</p>
                </div>
                <div class="p-4 bg-gray-50 dark:bg-slate-700/50 rounded-lg">
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">68</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Satker VPN</p>
                </div>
                <div class="p-4 bg-gray-50 dark:bg-slate-700/50 rounded-lg">
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">254</p>
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

<!-- Dashboard Stats Refresh Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Optional: Auto-refresh dashboard stats every 60 seconds
    async function refreshDashboardStats() {
        try {
            const response = await fetch('<?= base_url("waf/dashboard_live") ?>');
            if (!response.ok) return;
            const result = await response.json();
            if (result.success && result.data && result.data.summary) {
                const totalElem = document.getElementById('stat-total-attacks');
                const blockedElem = document.getElementById('stat-blocked-attacks');
                
                if (totalElem) totalElem.textContent = new Intl.NumberFormat().format(result.data.summary.total_attacks);
                if (blockedElem) blockedElem.textContent = new Intl.NumberFormat().format(result.data.summary.blocked_attacks);
            }
        } catch (error) {
            console.log('Stats refresh skipped');
        }
    }

    // Initial refresh after 5 seconds, then every 60 seconds
    setTimeout(refreshDashboardStats, 5000);
    setInterval(refreshDashboardStats, 60000);
});
</script>
