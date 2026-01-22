<div class="space-y-6">
    <!-- Header & Summary Cards -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Manajemen IP VPN</h1>
            <p class="text-gray-500 dark:text-gray-400 mt-1">Daftar IP VPN Tunnel & LAN Satker Radio Republik Indonesia Tahun <?= date('Y') ?></p>
        </div>
        
        <div class="flex items-center gap-3">
             <div class="relative">
                <input type="text" placeholder="Cari Satker..." 
                       class="pl-10 pr-4 py-2 border border-gray-200 dark:border-slate-600 rounded-lg text-sm bg-white dark:bg-slate-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500/20 transition-all w-64 shadow-sm">
                <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <button class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm transition-all flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Tambah VPN
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Card 1: Total VPN -->
        <div class="bg-white dark:bg-slate-800 rounded-xl p-6 border border-gray-100 dark:border-slate-700 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-blue-50 dark:bg-blue-900/20 rounded-xl text-blue-600 dark:text-blue-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Satker VPN</h3>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1"><?= $stats['total'] ?></p>
                </div>
            </div>
        </div>

        <!-- Card 2: Online Status -->
        <div class="bg-white dark:bg-slate-800 rounded-xl p-6 border border-gray-100 dark:border-slate-700 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-emerald-50 dark:bg-emerald-900/20 rounded-xl text-emerald-600 dark:text-emerald-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Online Now</h3>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1"><?= $stats['online'] ?></p>
                    <div class="text-xs text-emerald-600 dark:text-emerald-400 mt-1 flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        Active Connections
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 3: Offline Status -->
        <div class="bg-white dark:bg-slate-800 rounded-xl p-6 border border-gray-100 dark:border-slate-700 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-red-50 dark:bg-red-900/20 rounded-xl text-red-600 dark:text-red-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Not Connected</h3>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1"><?= $stats['offline'] ?></p>
                </div>
            </div>
        </div>
    </div>


    <!-- TABS & TABLES -->
    <div x-data="{ activeTab: 'connected' }" class="bg-white dark:bg-slate-800 rounded-xl shadow-lg shadow-gray-200/50 dark:shadow-black/20 border border-gray-100 dark:border-slate-700 overflow-hidden">
        
        <!-- Tab Navigation equivalent to Public IP Header -->
        <div class="flex border-b border-gray-100 dark:border-slate-700 bg-gray-50/50 dark:bg-slate-800/50">
            <button @click="activeTab = 'connected'" 
                    :class="activeTab === 'connected' ? 'text-emerald-600 dark:text-emerald-400 border-b-2 border-emerald-600 dark:border-emerald-400 bg-emerald-50/50 dark:bg-emerald-500/10' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-700'"
                    class="flex-1 px-6 py-4 font-medium text-sm transition-all cursor-pointer">
                <span class="flex items-center justify-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-500" :class="activeTab === 'connected' ? 'animate-pulse' : ''"></span>
                    Status: Terhubung (<?= count($vpn_connected) ?>)
                </span>
            </button>
            <button @click="activeTab = 'not_connected'" 
                    :class="activeTab === 'not_connected' ? 'text-red-600 dark:text-red-400 border-b-2 border-red-600 dark:border-red-400 bg-red-50/50 dark:bg-red-500/10' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-700'"
                    class="flex-1 px-6 py-4 font-medium text-sm transition-all cursor-pointer">
                <span class="flex items-center justify-center gap-2">
                     <span class="w-2 h-2 rounded-full bg-red-500"></span>
                    Status: Belum Terkoneksi (<?= count($vpn_not_connected) ?>)
                </span>
            </button>
        </div>

        <!-- TABLE 1: CONNECTED -->
        <div x-show="activeTab === 'connected'" class="overflow-x-auto">
             <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50/50 dark:bg-slate-700/50 border-b border-gray-100 dark:border-slate-700">
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase w-16 text-center">No</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Nama Satker</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase text-center">Detail Akun</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase text-center">Network Info</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase text-center">ISP & SNMP</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase text-center">Status</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-slate-700">
                    <?php if (empty($vpn_connected)): ?>
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400 flex flex-col items-center justify-center">
                                <span class="text-sm">Tidak ada data terhubung.</span>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($vpn_connected as $vpn): ?>
                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors bg-white dark:bg-slate-800">
                            <td class="px-6 py-4 text-center font-medium text-gray-400 text-sm"><?= $vpn['no'] ?></td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-900 dark:text-white"><?= $vpn['satker'] ?></div>
                                <div class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">ISP Satker: <?= $vpn['isp_satker'] ?></div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="inline-flex flex-col items-start text-xs bg-gray-50 dark:bg-slate-900 p-2 rounded-lg border border-gray-100 dark:border-slate-700 min-w-[120px]">
                                    <div class="flex justify-between w-full mb-1">
                                        <span class="text-gray-400">User:</span>
                                        <span class="font-mono text-gray-700 dark:text-gray-300"><?= $vpn['username'] ?: '-' ?></span>
                                    </div>
                                    <div class="flex justify-between w-full">
                                        <span class="text-gray-400">Pass:</span>
                                        <span class="font-mono text-gray-700 dark:text-gray-300"><?= $vpn['password'] ?: '-' ?></span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col gap-1 text-sm">
                                    <div class="flex items-center gap-2">
                                        <span class="w-16 text-xs text-gray-400 uppercase">IP VPN</span>
                                        <code class="font-mono text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/20 px-1 py-0.5 rounded text-xs"><?= $vpn['ip_vpn'] ?: '-' ?></code>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="w-16 text-xs text-gray-400 uppercase">IP LAN</span>
                                        <code class="font-mono text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-900/20 px-1 py-0.5 rounded text-xs"><?= $vpn['ip_lan'] ?: '-' ?></code>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center text-sm">
                                <div class="flex flex-col items-center gap-1">
                                    <span class="text-gray-900 dark:text-white font-medium"><?= $vpn['isp_pusat'] ?: '-' ?></span>
                                    <span class="text-xs text-gray-400">SNMP: <?= $vpn['snmp'] ?: '-' ?></span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-100/80 dark:bg-emerald-500/20 text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                    Online
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button class="text-blue-600 hover:text-blue-800 p-1 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded transition-colors" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- TABLE 2: NOT CONNECTED -->
        <div x-show="activeTab === 'not_connected'" class="overflow-x-auto">
             <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50/50 dark:bg-slate-700/50 border-b border-gray-100 dark:border-slate-700">
                        <th rowspan="2" class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase w-16 text-center align-middle border-r border-gray-100 dark:border-slate-700">No</th>
                        <th rowspan="2" class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase align-middle border-r border-gray-100 dark:border-slate-700">Nama Satker</th>
                        <th colspan="3" class="px-4 py-2 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase text-center border-b border-r border-gray-100 dark:border-slate-700">Username VPN</th>
                        <th rowspan="2" class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase text-center align-middle border-r border-gray-100 dark:border-slate-700">Password</th>
                        <th colspan="3" class="px-4 py-2 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase text-center border-b border-r border-gray-100 dark:border-slate-700">Direct VPN MPLS</th>
                        <th rowspan="2" class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase text-center align-middle border-r border-gray-100 dark:border-slate-700">Status</th>
                        <th rowspan="2" class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase align-middle border-r border-gray-100 dark:border-slate-700">PIC</th>
                        <th rowspan="2" class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase text-right align-middle">Aksi</th>
                    </tr>
                    <tr class="bg-gray-50 dark:bg-slate-700/30">
                        <th class="px-3 py-2 text-[10px] font-semibold text-gray-500 dark:text-gray-400 text-center uppercase border-r border-gray-100 dark:border-slate-700">PRO 1</th>
                        <th class="px-3 py-2 text-[10px] font-semibold text-gray-500 dark:text-gray-400 text-center uppercase border-r border-gray-100 dark:border-slate-700">PRO 2</th>
                        <th class="px-3 py-2 text-[10px] font-semibold text-gray-500 dark:text-gray-400 text-center uppercase border-r border-gray-100 dark:border-slate-700">PRO 4</th>
                        <th class="px-3 py-2 text-[10px] font-semibold text-gray-500 dark:text-gray-400 text-center uppercase border-r border-gray-100 dark:border-slate-700">ASTINET</th>
                        <th class="px-3 py-2 text-[10px] font-semibold text-gray-500 dark:text-gray-400 text-center uppercase border-r border-gray-100 dark:border-slate-700">DSCPC</th>
                        <th class="px-3 py-2 text-[10px] font-semibold text-gray-500 dark:text-gray-400 text-center uppercase border-r border-gray-100 dark:border-slate-700">HSP</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-slate-700">
                    <?php if (empty($vpn_not_connected)): ?>
                        <tr><td colspan="12" class="px-6 py-12 text-center text-gray-500">Belum ada data.</td></tr>
                    <?php else: ?>
                        <?php foreach ($vpn_not_connected as $vpn): ?>
                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors bg-white dark:bg-slate-800">
                            <td class="px-6 py-4 text-center font-medium text-gray-400 text-sm border-r border-gray-50 dark:border-slate-700/50"><?= $vpn['no'] ?></td>
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white border-r border-gray-50 dark:border-slate-700/50"><?= $vpn['satker'] ?></td>
                            
                            <?php if(!empty($vpn['u_single'])): ?>
                                <td colspan="3" class="px-4 py-4 text-center text-sm font-mono text-gray-600 dark:text-gray-400 border-r border-gray-50 dark:border-slate-700/50">
                                    <?= $vpn['u_single'] ?>
                                </td>
                            <?php else: ?>
                                <td class="px-2 py-4 text-center text-xs font-mono text-gray-500 border-r border-gray-50 dark:border-slate-700/50"><?= $vpn['u_pro1'] ?></td>
                                <td class="px-2 py-4 text-center text-xs font-mono text-gray-500 border-r border-gray-50 dark:border-slate-700/50"><?= $vpn['u_pro2'] ?></td>
                                <td class="px-2 py-4 text-center text-xs font-mono text-gray-500 border-r border-gray-50 dark:border-slate-700/50"><?= $vpn['u_pro4'] ?></td>
                            <?php endif; ?>

                            <td class="px-6 py-4 text-center border-r border-gray-50 dark:border-slate-700/50 bg-gray-50/30 dark:bg-slate-900/10">
                                <code class="bg-gray-100 dark:bg-slate-700 px-2 py-1 rounded text-xs font-mono text-gray-700 dark:text-gray-300"><?= $vpn['password'] ?></code>
                            </td>

                            <td class="px-2 py-4 text-center border-r border-gray-50 dark:border-slate-700/50">
                                <?= $vpn['isp_astinet'] ? '<span class="text-blue-500">✓</span>' : '<span class="text-gray-300">-</span>' ?>
                            </td>
                            <td class="px-2 py-4 text-center border-r border-gray-50 dark:border-slate-700/50">
                                <?= $vpn['isp_dscpc'] ? '<span class="text-purple-500">✓</span>' : '<span class="text-gray-300">-</span>' ?>
                            </td>
                            <td class="px-2 py-4 text-center border-r border-gray-50 dark:border-slate-700/50">
                                <?= $vpn['isp_hsp'] ? '<span class="text-pink-500">✓</span>' : '<span class="text-gray-300">-</span>' ?>
                            </td>

                            <td class="px-6 py-4 text-center border-r border-gray-50 dark:border-slate-700/50">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 dark:bg-slate-700 text-gray-500 dark:text-gray-400 border border-gray-200 dark:border-slate-600">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                                    Offline
                                </span>
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400 border-r border-gray-50 dark:border-slate-700/50">
                                <?= $vpn['pic'] ?>
                            </td>

                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button class="text-blue-600 hover:text-blue-800 p-1 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded transition-colors" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
