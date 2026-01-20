<!-- =====================================================
     IP Address Management Page - Admin Panel
     Unified View with Type Badges and Filters
     ===================================================== -->

<!-- Header Actions -->
<div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Manajemen IP Address</h1>
        <p class="text-gray-500 dark:text-gray-400 mt-1">Kelola semua IP Address dalam satu tampilan</p>
    </div>
    <button onclick="openModal('addIPModal')" 
            class="px-5 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-medium rounded-lg hover:from-blue-700 hover:to-blue-800 shadow-md transition-all flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
        </svg>
        Tambah IP
    </button>
</div>

<?php
// Demo data with all IP types
$ip_data = [
    // Jakarta - Local
    ['name' => 'Server Utama', 'ip_address' => '192.168.1.1', 'region' => 'Jakarta', 'description' => 'Main application server', 'status' => 'active', 'usage_status' => 'in_use', 'app_name' => 'Web Portal', 'type' => 'local'],
    ['name' => 'Database Server', 'ip_address' => '192.168.1.2', 'region' => 'Jakarta', 'description' => 'MySQL Database', 'status' => 'active', 'usage_status' => 'in_use', 'app_name' => 'SIMPEG', 'type' => 'local'],
    ['name' => 'Backup Server', 'ip_address' => '192.168.1.3', 'region' => 'Jakarta', 'description' => 'Backup storage', 'status' => 'active', 'usage_status' => 'available', 'app_name' => '', 'type' => 'local'],
    ['name' => 'Mail Server', 'ip_address' => '192.168.1.4', 'region' => 'Jakarta', 'description' => 'Email server', 'status' => 'active', 'usage_status' => 'in_use', 'app_name' => 'Mail RRI', 'type' => 'local'],
    ['name' => 'Dev Server', 'ip_address' => '192.168.1.5', 'region' => 'Jakarta', 'description' => 'Development', 'status' => 'inactive', 'usage_status' => 'available', 'app_name' => '', 'type' => 'local'],
    
    // Bandung - Private
    ['name' => 'Router Bandung', 'ip_address' => '10.10.1.1', 'region' => 'Bandung', 'description' => 'Main router', 'status' => 'active', 'usage_status' => 'in_use', 'app_name' => 'Network Gateway', 'type' => 'private'],
    ['name' => 'Server Bandung', 'ip_address' => '10.10.1.2', 'region' => 'Bandung', 'description' => 'Local server', 'status' => 'active', 'usage_status' => 'in_use', 'app_name' => 'Streaming Audio', 'type' => 'private'],
    ['name' => 'NAS Bandung', 'ip_address' => '10.10.1.3', 'region' => 'Bandung', 'description' => 'Storage', 'status' => 'active', 'usage_status' => 'available', 'app_name' => '', 'type' => 'private'],
    
    // Surabaya - Private
    ['name' => 'Server Surabaya', 'ip_address' => '10.20.1.1', 'region' => 'Surabaya', 'description' => 'Regional server', 'status' => 'active', 'usage_status' => 'in_use', 'app_name' => 'Web Regional', 'type' => 'private'],
    ['name' => 'Backup Surabaya', 'ip_address' => '10.20.1.2', 'region' => 'Surabaya', 'description' => 'Backup storage', 'status' => 'active', 'usage_status' => 'available', 'app_name' => '', 'type' => 'private'],
    ['name' => 'Printer Server', 'ip_address' => '10.20.1.3', 'region' => 'Surabaya', 'description' => 'Print server', 'status' => 'inactive', 'usage_status' => 'available', 'app_name' => '', 'type' => 'private'],
    
    // Medan - VPN
    ['name' => 'VPN Medan', 'ip_address' => '172.16.1.1', 'region' => 'Medan', 'description' => 'VPN Gateway', 'status' => 'active', 'usage_status' => 'in_use', 'app_name' => 'VPN Access', 'type' => 'vpn'],
    ['name' => 'Server Medan', 'ip_address' => '172.16.1.2', 'region' => 'Medan', 'description' => 'Local server', 'status' => 'active', 'usage_status' => 'in_use', 'app_name' => 'Arsip Digital', 'type' => 'vpn'],
    
    // Makassar - VPN
    ['name' => 'VPN Makassar', 'ip_address' => '172.16.2.1', 'region' => 'Makassar', 'description' => 'VPN Gateway', 'status' => 'active', 'usage_status' => 'in_use', 'app_name' => 'VPN Access', 'type' => 'vpn'],
    ['name' => 'Server Makassar', 'ip_address' => '172.16.2.2', 'region' => 'Makassar', 'description' => 'Regional server', 'status' => 'active', 'usage_status' => 'available', 'app_name' => '', 'type' => 'vpn'],
    ['name' => 'Backup Makassar', 'ip_address' => '172.16.2.3', 'region' => 'Makassar', 'description' => 'Backup storage', 'status' => 'inactive', 'usage_status' => 'available', 'app_name' => '', 'type' => 'vpn'],
];

// Counts
$count_local = count(array_filter($ip_data, fn($ip) => $ip['type'] === 'local'));
$count_private = count(array_filter($ip_data, fn($ip) => $ip['type'] === 'private'));
$count_vpn = count(array_filter($ip_data, fn($ip) => $ip['type'] === 'vpn'));
$total_in_use = count(array_filter($ip_data, fn($ip) => $ip['usage_status'] === 'in_use'));
$total_available = count($ip_data) - $total_in_use;
$all_regions = array_unique(array_column($ip_data, 'region'));
?>

<!-- Stats Cards -->
<div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mb-6">
    <div class="bg-white dark:bg-slate-800 rounded-xl p-4 border border-gray-100 dark:border-slate-700 shadow-sm dark:shadow-none">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-blue-100 dark:bg-blue-500/20 rounded-lg">
                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2"/>
                </svg>
            </div>
            <div>
                <div class="text-xl font-bold text-gray-900 dark:text-white"><?= $count_local ?></div>
                <div class="text-sm text-gray-500 dark:text-gray-400">Local</div>
            </div>
        </div>
    </div>
    <div class="bg-white dark:bg-slate-800 rounded-xl p-4 border border-gray-100 dark:border-slate-700 shadow-sm dark:shadow-none">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-purple-100 dark:bg-purple-500/20 rounded-lg">
                <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>
            <div>
                <div class="text-xl font-bold text-gray-900 dark:text-white"><?= $count_private ?></div>
                <div class="text-sm text-gray-500 dark:text-gray-400">Private</div>
            </div>
        </div>
    </div>
    <div class="bg-white dark:bg-slate-800 rounded-xl p-4 border border-gray-100 dark:border-slate-700 shadow-sm dark:shadow-none">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-emerald-100 dark:bg-emerald-500/20 rounded-lg">
                <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                </svg>
            </div>
            <div>
                <div class="text-xl font-bold text-gray-900 dark:text-white"><?= $count_vpn ?></div>
                <div class="text-sm text-gray-500 dark:text-gray-400">VPN</div>
            </div>
        </div>
    </div>
    <div class="bg-white dark:bg-slate-800 rounded-xl p-4 border border-gray-100 dark:border-slate-700 shadow-sm dark:shadow-none">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-amber-100 dark:bg-amber-500/20 rounded-lg">
                <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>
            <div>
                <div class="text-xl font-bold text-gray-900 dark:text-white"><?= $total_in_use ?></div>
                <div class="text-sm text-gray-500 dark:text-gray-400">Digunakan</div>
            </div>
        </div>
    </div>
    <div class="bg-white dark:bg-slate-800 rounded-xl p-4 border border-gray-100 dark:border-slate-700 shadow-sm dark:shadow-none">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-green-100 dark:bg-green-500/20 rounded-lg">
                <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <div class="text-xl font-bold text-gray-900 dark:text-white"><?= $total_available ?></div>
                <div class="text-sm text-gray-500 dark:text-gray-400">Tersedia</div>
            </div>
        </div>
    </div>
</div>

<!-- Search and Filters -->
<div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm dark:shadow-none border border-gray-100 dark:border-slate-700 p-4 mb-6">
    <div class="flex flex-col lg:flex-row gap-4">
        <!-- Search -->
        <div class="flex-1 relative">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" id="ipSearch" 
                   class="w-full pl-10 pr-4 py-2.5 border border-gray-200 dark:border-slate-600 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 bg-white dark:bg-slate-900 text-gray-900 dark:text-white placeholder-gray-400"
                   placeholder="Cari nama, IP, daerah, atau aplikasi..."
                   onkeyup="filterIPs()">
        </div>
        
        <!-- Type Filter -->
        <select id="typeFilter" onchange="filterIPs()" 
                class="px-4 py-2.5 border border-gray-200 dark:border-slate-600 rounded-lg focus:outline-none focus:border-blue-500 bg-white dark:bg-slate-900 text-gray-900 dark:text-white">
            <option value="">Semua Tipe</option>
            <option value="local">🔵 Local IP</option>
            <option value="private">🟣 Private IP</option>
            <option value="vpn">🟢 VPN</option>
        </select>
        
        <!-- Region Filter -->
        <select id="regionFilter" onchange="filterIPs()" 
                class="px-4 py-2.5 border border-gray-200 dark:border-slate-600 rounded-lg focus:outline-none focus:border-blue-500 bg-white dark:bg-slate-900 text-gray-900 dark:text-white">
            <option value="">Semua Daerah</option>
            <?php foreach ($all_regions as $region): ?>
                <option value="<?= htmlspecialchars(strtolower($region)) ?>"><?= htmlspecialchars($region) ?></option>
            <?php endforeach; ?>
        </select>
        
        <!-- Status Filter -->
        <select id="statusFilter" onchange="filterIPs()" 
                class="px-4 py-2.5 border border-gray-200 dark:border-slate-600 rounded-lg focus:outline-none focus:border-blue-500 bg-white dark:bg-slate-900 text-gray-900 dark:text-white">
            <option value="">Semua Status</option>
            <option value="in_use">Digunakan</option>
            <option value="available">Tersedia</option>
        </select>
        
        <!-- Reset Button -->
        <button onclick="resetFilters()" 
                class="px-4 py-2.5 bg-gray-100 dark:bg-slate-700 text-gray-700 dark:text-gray-300 font-medium rounded-lg hover:bg-gray-200 dark:hover:bg-slate-600 transition-colors flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
            Reset
        </button>
    </div>
</div>

<!-- Unified IP Table -->
<div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm dark:shadow-none border border-gray-100 dark:border-slate-700 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 dark:bg-slate-700/50 border-b border-gray-100 dark:border-slate-700">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase w-12">No</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Tipe</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Nama</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">IP Address</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Daerah</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Deskripsi</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Status</th>
                    <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-slate-700" id="ipTableBody">
                <?php $no = 1; foreach ($ip_data as $ip): 
                    $typeColors = [
                        'local' => ['bg' => 'blue', 'label' => 'Local'],
                        'private' => ['bg' => 'purple', 'label' => 'Private'],
                        'vpn' => ['bg' => 'emerald', 'label' => 'VPN']
                    ];
                    $tc = $typeColors[$ip['type']];
                ?>
                <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors ip-row"
                    data-name="<?= htmlspecialchars(strtolower($ip['name'])) ?>"
                    data-ip="<?= htmlspecialchars(strtolower($ip['ip_address'])) ?>"
                    data-region="<?= htmlspecialchars(strtolower($ip['region'])) ?>"
                    data-app="<?= htmlspecialchars(strtolower($ip['app_name'])) ?>"
                    data-type="<?= $ip['type'] ?>"
                    data-usage="<?= $ip['usage_status'] ?>">
                    <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400 font-medium"><?= $no++ ?></td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-semibold rounded-full bg-<?= $tc['bg'] ?>-100 dark:bg-<?= $tc['bg'] ?>-500/20 text-<?= $tc['bg'] ?>-700 dark:text-<?= $tc['bg'] ?>-400">
                            <span class="w-1.5 h-1.5 rounded-full bg-<?= $tc['bg'] ?>-500"></span>
                            <?= $tc['label'] ?>
                        </span>
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white"><?= htmlspecialchars($ip['name']) ?></td>
                    <td class="px-6 py-4">
                        <code class="px-2 py-1 bg-gray-100 dark:bg-slate-700 text-gray-800 dark:text-gray-200 rounded text-sm font-mono">
                            <?= htmlspecialchars($ip['ip_address']) ?>
                        </code>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center gap-1.5 text-sm text-gray-600 dark:text-gray-300">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            </svg>
                            <?= htmlspecialchars($ip['region']) ?>
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300 max-w-[200px] truncate" title="<?= htmlspecialchars($ip['description']) ?>">
                        <?= htmlspecialchars($ip['description']) ?>
                    </td>
                    <td class="px-6 py-4">
                        <?php if ($ip['usage_status'] === 'in_use'): ?>
                            <div class="flex flex-col">
                                <span class="flex items-center gap-1.5 text-amber-600 dark:text-amber-400 text-sm font-medium">
                                    <span class="w-2 h-2 bg-amber-500 rounded-full animate-pulse"></span>
                                    Digunakan
                                </span>
                                <span class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                                    <?= htmlspecialchars($ip['app_name']) ?>
                                </span>
                            </div>
                        <?php else: ?>
                            <span class="flex items-center gap-1.5 text-emerald-600 dark:text-emerald-400 text-sm font-medium">
                                <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                                Tersedia
                            </span>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-1">
                            <button class="p-2 text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-500/20 rounded-lg transition-colors" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </button>
                            <button class="p-2 text-gray-400 hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-500/20 rounded-lg transition-colors" title="Hapus">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <!-- Footer with count -->
    <div class="px-6 py-4 border-t border-gray-100 dark:border-slate-700 flex items-center justify-between bg-gray-50 dark:bg-slate-700/30">
        <p class="text-sm text-gray-500 dark:text-gray-400">
            Menampilkan <span id="visibleCount"><?= count($ip_data) ?></span> dari <?= count($ip_data) ?> IP
        </p>
        <div class="flex gap-2 text-xs">
            <span class="px-2 py-1 rounded bg-blue-100 dark:bg-blue-500/20 text-blue-700 dark:text-blue-400">Local: <?= $count_local ?></span>
            <span class="px-2 py-1 rounded bg-purple-100 dark:bg-purple-500/20 text-purple-700 dark:text-purple-400">Private: <?= $count_private ?></span>
            <span class="px-2 py-1 rounded bg-emerald-100 dark:bg-emerald-500/20 text-emerald-700 dark:text-emerald-400">VPN: <?= $count_vpn ?></span>
        </div>
    </div>
</div>

<script>
function filterIPs() {
    const searchTerm = document.getElementById('ipSearch').value.toLowerCase();
    const typeFilter = document.getElementById('typeFilter').value;
    const regionFilter = document.getElementById('regionFilter').value;
    const statusFilter = document.getElementById('statusFilter').value;
    
    const rows = document.querySelectorAll('.ip-row');
    let visibleCount = 0;
    
    rows.forEach(row => {
        const name = row.dataset.name;
        const ip = row.dataset.ip;
        const region = row.dataset.region;
        const app = row.dataset.app;
        const type = row.dataset.type;
        const usage = row.dataset.usage;
        
        const matchesSearch = !searchTerm || 
            name.includes(searchTerm) || 
            ip.includes(searchTerm) || 
            region.includes(searchTerm) ||
            app.includes(searchTerm);
        
        const matchesType = !typeFilter || type === typeFilter;
        const matchesRegion = !regionFilter || region === regionFilter;
        const matchesStatus = !statusFilter || usage === statusFilter;
        
        if (matchesSearch && matchesType && matchesRegion && matchesStatus) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });
    
    document.getElementById('visibleCount').textContent = visibleCount;
}

function resetFilters() {
    document.getElementById('ipSearch').value = '';
    document.getElementById('typeFilter').value = '';
    document.getElementById('regionFilter').value = '';
    document.getElementById('statusFilter').value = '';
    
    const rows = document.querySelectorAll('.ip-row');
    rows.forEach(row => row.style.display = '');
    
    document.getElementById('visibleCount').textContent = rows.length;
}

function openModal(id) {
    alert('Modal ' + id + ' - Fitur akan diimplementasikan dengan database');
}
</script>
