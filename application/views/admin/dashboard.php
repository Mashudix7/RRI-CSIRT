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
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Total Attacks -->
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-slate-700 hover:shadow-md transition-all relative overflow-hidden group" data-aos="fade-up">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 to-indigo-600"></div>
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Total Serangan</p>
                <h3 id="stat-total-attacks" class="text-3xl font-bold text-gray-900 dark:text-white" data-count-up="<?= $stats['total_attacks'] ?>"><?= number_format($stats['total_attacks']) ?></h3>
            </div>
            <div class="w-12 h-12 bg-blue-100 dark:bg-blue-500/20 text-blue-600 dark:text-blue-400 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
        </div>
    </div>
    
    <!-- Blocked Attacks -->
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-slate-700 hover:shadow-md transition-all relative overflow-hidden group" data-aos="fade-up" data-aos-delay="100">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-green-500 to-emerald-500"></div>
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Diblokir Safeline</p>
                <h3 id="stat-blocked-attacks" class="text-3xl font-bold text-green-600 dark:text-green-400" data-count-up="<?= $stats['blocked_attacks'] ?>"><?= number_format($stats['blocked_attacks']) ?></h3>
            </div>
            <div class="w-12 h-12 bg-green-100 dark:bg-green-500/20 text-green-600 dark:text-green-400 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
    </div>
    
    <!-- System Status -->
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-slate-700 hover:shadow-md transition-all relative overflow-hidden" data-aos="fade-up" data-aos-delay="200">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-purple-500 to-pink-500"></div>
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Status Proteksi</p>
                <h3 class="text-2xl font-bold text-purple-600 dark:text-purple-400">Terlindungi</h3>
            </div>
            <div class="w-12 h-12 bg-purple-100 dark:bg-purple-500/20 text-purple-600 dark:text-purple-400 rounded-xl flex items-center justify-center">
                <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
            </div>
        </div>
    </div>
</div>

<!-- Main Content Grid -->
<div class="grid lg:grid-cols-1 gap-6">
    <!-- Attack Activity Table -->
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700" data-aos="fade-up">
        <div class="px-6 py-4 border-b border-gray-100 dark:border-slate-700 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Aktivitas Serangan WAF</h2>
            
            <div class="flex items-center bg-gray-100 dark:bg-slate-700 p-1 rounded-lg">
                <button onclick="switchTab('logs')" id="tab-logs-btn" class="px-4 py-1.5 text-xs font-medium rounded-md transition-all bg-white dark:bg-slate-600 text-blue-600 dark:text-blue-400 shadow-sm">
                    Log Serangan
                </button>
                <button onclick="switchTab('events')" id="tab-events-btn" class="px-4 py-1.5 text-xs font-medium rounded-md transition-all text-gray-500 dark:text-gray-400">
                    Kejadian (Events)
                </button>
            </div>

            <button class="text-sm text-blue-600 dark:text-blue-400 hover:text-blue-700 font-medium flex items-center gap-2" id="live-view-btn">
                Live View <span class="relative flex h-2 w-2"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span><span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span></span>
            </button>
        </div>
        
        <!-- Logs Table -->
        <div id="table-logs-container" class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 dark:bg-slate-700/50">
                    <tr>
                        <th class="px-6 py-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Action</th>
                        <th class="px-6 py-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">URL</th>
                        <th class="px-6 py-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Attack Type</th>
                        <th class="px-6 py-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">IP Addr</th>
                        <th class="px-6 py-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase text-right">Time</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-slate-700" id="logs-table-body">
                    <?php if (empty($recent_logs)): ?>
                        <tr><td colspan="5" class="px-6 py-12 text-center text-gray-400 italic">Menunggu data...</td></tr>
                    <?php else: ?>
                        <?php foreach ($recent_logs as $log): ?>
                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors">
                            <td class="px-6 py-4">
                                <?php if ($log['action'] == 1 || $log['action'] == 'block'): ?>
                                    <span class="px-2 py-0.5 bg-red-100 text-red-600 dark:bg-red-500/10 dark:text-red-400 rounded-full text-[10px] uppercase font-bold">Blocked</span>
                                <?php else: ?>
                                    <span class="px-2 py-0.5 bg-gray-100 text-gray-600 dark:bg-slate-600 dark:text-gray-400 rounded-full text-[10px] uppercase font-bold">Log</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900 dark:text-white truncate max-w-[200px]" title="<?= htmlspecialchars($log['url_path']) ?>"><?= htmlspecialchars($log['url_path']) ?></div>
                                <div class="text-[10px] text-gray-400"><?= htmlspecialchars($log['host']) ?></div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-xs font-medium text-gray-700 dark:text-gray-300"><?= htmlspecialchars($log['module']) ?></span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-mono text-sm text-gray-900 dark:text-white"><?= htmlspecialchars($log['src_ip']) ?></div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="text-xs text-gray-900 dark:text-white"><?= date('H:i:s', $log['timestamp']) ?></div>
                                <div class="text-[10px] text-gray-500"><?= date('Y-m-d', $log['timestamp']) ?></div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Events Table (Hidden by default) -->
        <div id="table-events-container" class="overflow-x-auto hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 dark:bg-slate-700/50">
                    <tr>
                        <th class="px-6 py-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">IP Addr</th>
                        <th class="px-6 py-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Applications</th>
                        <th class="px-6 py-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase text-center">Attack Count</th>
                        <th class="px-6 py-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase text-center">Duration</th>
                        <th class="px-6 py-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase text-right">Start At</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-slate-700" id="events-table-body">
                    <?php if (empty($recent_events)): ?>
                        <tr><td colspan="5" class="px-6 py-12 text-center text-gray-400 italic">Tidak ada kejadian penting hari ini.</td></tr>
                    <?php else: ?>
                        <?php foreach ($recent_events as $event): ?>
                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-mono text-sm text-gray-900 dark:text-white"><?= htmlspecialchars($event['src_ip'] ?? '-') ?></div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900 dark:text-white"><?= htmlspecialchars($event['host'] ?? '-') ?></div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-2 py-1 bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 rounded text-xs"><?= $event['count'] ?? '1' ?></span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-xs text-gray-600 dark:text-gray-400"><?= $event['duration'] ?? '1m' ?></span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="text-xs text-gray-900 dark:text-white"><?= date('H:i:s', $event['timestamp'] ?? time()) ?></div>
                                <div class="text-[10px] text-gray-500"><?= date('Y-m-d', $event['timestamp'] ?? time()) ?></div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
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

<!-- WAF Live Update Script -->
<script>
let currentDashboardTab = 'logs';

function switchTab(tab) {
    currentDashboardTab = tab;
    
    // Update buttons
    const logsBtn = document.getElementById('tab-logs-btn');
    const eventsBtn = document.getElementById('tab-events-btn');
    const logsContainer = document.getElementById('table-logs-container');
    const eventsContainer = document.getElementById('table-events-container');

    if (tab === 'logs') {
        logsBtn.classList.add('bg-white', 'dark:bg-slate-600', 'text-blue-600', 'dark:text-blue-400', 'shadow-sm');
        logsBtn.classList.remove('text-gray-500', 'dark:text-gray-400');
        eventsBtn.classList.remove('bg-white', 'dark:bg-slate-600', 'text-blue-600', 'dark:text-blue-400', 'shadow-sm');
        eventsBtn.classList.add('text-gray-500', 'dark:text-gray-400');
        
        logsContainer.classList.remove('hidden');
        eventsContainer.classList.add('hidden');
    } else {
        eventsBtn.classList.add('bg-white', 'dark:bg-slate-600', 'text-blue-600', 'dark:text-blue-400', 'shadow-sm');
        eventsBtn.classList.remove('text-gray-500', 'dark:text-gray-400');
        logsBtn.classList.remove('bg-white', 'dark:bg-slate-600', 'text-blue-600', 'dark:text-blue-400', 'shadow-sm');
        logsBtn.classList.add('text-gray-500', 'dark:text-gray-400');
        
        eventsContainer.classList.remove('hidden');
        logsContainer.classList.add('hidden');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const liveViewBtn = document.getElementById('live-view-btn');
    const logsTableBody = document.getElementById('logs-table-body');
    const eventsTableBody = document.getElementById('events-table-body');
    let liveInterval = null;
    let isLive = false;

    function formatTime(timestamp) {
        if (!timestamp) return '-';
        const date = new Date(timestamp * 1000);
        return date.getHours().toString().padStart(2, '0') + ':' + 
               date.getMinutes().toString().padStart(2, '0') + ':' + 
               date.getSeconds().toString().padStart(2, '0');
    }

    function formatDate(timestamp) {
        if (!timestamp) return '-';
        const date = new Date(timestamp * 1000);
        return date.getFullYear() + '-' + 
               (date.getMonth() + 1).toString().padStart(2, '0') + '-' + 
               date.getDate().toString().padStart(2, '0');
    }

    function updateLogsTable(records) {
        if (!records || records.length === 0) return;
        let html = '';
        records.forEach(log => {
            const actionBadge = (log.action == 1 || log.action == 'block') 
                ? `<span class="px-2 py-0.5 bg-red-100 text-red-600 dark:bg-red-500/10 dark:text-red-400 rounded-full text-[10px] uppercase font-bold">Blocked</span>`
                : `<span class="px-2 py-0.5 bg-gray-100 text-gray-600 dark:bg-slate-600 dark:text-gray-400 rounded-full text-[10px] uppercase font-bold">Log</span>`;
            
            html += `
            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors">
                <td class="px-6 py-4">${actionBadge}</td>
                <td class="px-6 py-4">
                    <div class="text-sm text-gray-900 dark:text-white truncate max-w-[200px]" title="${log.url_path || ''}">${log.url_path || ''}</div>
                    <div class="text-[10px] text-gray-400">${log.host || ''}</div>
                </td>
                <td class="px-6 py-4">
                    <span class="text-xs font-medium text-gray-700 dark:text-gray-300">${log.module || ''}</span>
                </td>
                <td class="px-6 py-4">
                    <div class="font-mono text-sm text-gray-900 dark:text-white">${log.src_ip || ''}</div>
                </td>
                <td class="px-6 py-4 text-right">
                    <div class="text-xs text-gray-900 dark:text-white">${formatTime(log.timestamp)}</div>
                    <div class="text-[10px] text-gray-500">${formatDate(log.timestamp)}</div>
                </td>
            </tr>`;
        });
        logsTableBody.innerHTML = html;
    }

    function updateEventsTable(events) {
        if (!events || events.length === 0) return;
        let html = '';
        events.forEach(event => {
            html += `
            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors">
                <td class="px-6 py-4">
                    <div class="font-mono text-sm text-gray-900 dark:text-white">${event.src_ip || '-'}</div>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm text-gray-900 dark:text-white">${event.host || '-'}</div>
                </td>
                <td class="px-6 py-4 text-center">
                    <span class="px-2 py-1 bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 rounded text-xs">${event.count || '1'}</span>
                </td>
                <td class="px-6 py-4 text-center">
                    <span class="text-xs text-gray-600 dark:text-gray-400">${event.duration || '1m'}</span>
                </td>
                <td class="px-6 py-4 text-right">
                    <div class="text-xs text-gray-900 dark:text-white">${formatTime(event.timestamp)}</div>
                    <div class="text-[10px] text-gray-500">${formatDate(event.timestamp)}</div>
                </td>
            </tr>`;
        });
        eventsTableBody.innerHTML = html;
    }

    async function fetchLiveDashboard() {
        try {
            const response = await fetch('waf/dashboard_live');
            const result = await response.json();
            if (result.success && result.data) {
                updateLogsTable(result.data.records);
                updateEventsTable(result.data.events);
                
                if (result.data.summary) {
                    const totalElem = document.getElementById('stat-total-attacks');
                    const blockedElem = document.getElementById('stat-blocked-attacks');
                    
                    if (totalElem) totalElem.textContent = new Intl.NumberFormat().format(result.data.summary.total_attacks);
                    if (blockedElem) blockedElem.textContent = new Intl.NumberFormat().format(result.data.summary.blocked_attacks);
                }
            }
        } catch (error) {
            console.error('Failed to fetch WAF live data:', error);
        }
    }

    if (liveViewBtn) {
        liveViewBtn.addEventListener('click', function() {
            isLive = !isLive;
            if (isLive) {
                liveViewBtn.classList.add('bg-blue-50', 'text-blue-700');
                fetchLiveDashboard();
                liveInterval = setInterval(fetchLiveDashboard, 30000); // 30s
            } else {
                liveViewBtn.classList.remove('bg-blue-50', 'text-blue-700');
                clearInterval(liveInterval);
            }
        });
    }
});
</script>
