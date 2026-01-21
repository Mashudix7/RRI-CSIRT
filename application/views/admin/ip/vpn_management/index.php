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
                       class="pl-10 pr-4 py-2 border border-gray-200 dark:border-slate-600 rounded-lg text-sm bg-white dark:bg-slate-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 transition-all w-64">
                <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <button class="px-5 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-medium rounded-lg hover:from-blue-700 hover:to-blue-800 shadow-md transition-all flex items-center gap-2">
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
                <div class="p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                <div class="p-3 bg-emerald-50 dark:bg-emerald-900/20 rounded-lg">
                    <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                <div class="p-3 bg-red-50 dark:bg-red-900/20 rounded-lg">
                    <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">No Connected</h3>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1"><?= $stats['offline'] ?></p>
                </div>
            </div>
        </div>
    </div>


    <!-- TABS -->
    <div x-data="{ activeTab: 'connected' }" class="bg-white dark:bg-slate-800 rounded-xl shadow-sm dark:shadow-none border border-gray-100 dark:border-slate-700 overflow-hidden">
        
        <!-- Tab Buttons -->
        <div class="flex border-b border-gray-100 dark:border-slate-700">
            <button @click="activeTab = 'connected'" 
                    :class="activeTab === 'connected' ? 'text-green-600 dark:text-green-400 border-b-2 border-green-600 dark:border-green-400 bg-green-50 dark:bg-green-500/10' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300'"
                    class="flex-1 px-6 py-4 font-medium text-sm transition-colors cursor-pointer">
                <span class="flex items-center justify-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                    Status: Terhubung (<?= count($vpn_connected) ?>)
                </span>
            </button>
            <button @click="activeTab = 'not_connected'" 
                    :class="activeTab === 'not_connected' ? 'text-red-600 dark:text-red-400 border-b-2 border-red-600 dark:border-red-400 bg-red-50 dark:bg-red-500/10' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300'"
                    class="flex-1 px-6 py-4 font-medium text-sm transition-colors cursor-pointer">
                <span class="flex items-center justify-center gap-2">
                     <span class="w-2 h-2 rounded-full bg-red-500"></span>
                    Status: Belum Terkoneksi (<?= count($vpn_not_connected) ?>)
                </span>
            </button>
        </div>

        <!-- TABLE 1: CONNECTED (Standardized Style) -->
        <div x-show="activeTab === 'connected'" class="overflow-x-auto">
             <table class="w-full text-left border-collapse border border-gray-200 dark:border-slate-700">
                <thead class="bg-blue-200 dark:bg-slate-700 text-gray-800 dark:text-gray-200">
                    <tr>
                        <th class="px-4 py-3 text-xs font-bold uppercase border border-gray-300 dark:border-slate-600 text-center w-12 bg-blue-300 dark:bg-blue-900/50">No</th>
                        <th class="px-4 py-3 text-xs font-bold uppercase border border-gray-300 dark:border-slate-600 bg-blue-300 dark:bg-blue-900/50">Nama Satker</th>
                        <th class="px-4 py-3 text-xs font-bold uppercase border border-gray-300 dark:border-slate-600 text-center bg-blue-300 dark:bg-blue-900/50">Username</th>
                        <th class="px-4 py-3 text-xs font-bold uppercase border border-gray-300 dark:border-slate-600 text-center bg-blue-300 dark:bg-blue-900/50">Password</th>
                        <th class="px-4 py-3 text-xs font-bold uppercase border border-gray-300 dark:border-slate-600 text-center bg-blue-300 dark:bg-blue-900/50">ISP Satker</th>
                        <th class="px-4 py-3 text-xs font-bold uppercase border border-gray-300 dark:border-slate-600 text-center bg-blue-300 dark:bg-blue-900/50">IP VPN</th>
                        <th class="px-4 py-3 text-xs font-bold uppercase border border-gray-300 dark:border-slate-600 text-center bg-blue-300 dark:bg-blue-900/50">IP LAN Satker</th>
                        <th class="px-4 py-3 text-xs font-bold uppercase border border-gray-300 dark:border-slate-600 text-center bg-blue-300 dark:bg-blue-900/50">ISP VI Pusat</th>
                        <th class="px-4 py-3 text-xs font-bold uppercase border border-gray-300 dark:border-slate-600 text-center bg-blue-300 dark:bg-blue-900/50">SNMP</th>
                        <th class="px-4 py-3 text-xs font-bold uppercase border border-gray-300 dark:border-slate-600 text-center bg-blue-300 dark:bg-blue-900/50">Keterangan</th>
                        <th class="px-4 py-3 text-xs font-bold uppercase border border-gray-300 dark:border-slate-600 text-center bg-blue-300 dark:bg-blue-900/50">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-slate-800 divide-y divide-gray-100 dark:divide-slate-700">
                    <?php if (empty($vpn_connected)): ?>
                        <tr><td colspan="11" class="px-6 py-4 text-center text-gray-500">Tidak ada data terhubung.</td></tr>
                    <?php else: ?>
                        <?php foreach ($vpn_connected as $vpn): ?>
                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/30 transition-colors">
                            <td class="px-4 py-3 text-sm text-center border-r border-gray-300 dark:border-slate-700 font-medium text-gray-500 dark:text-gray-400"><?= $vpn['no'] ?></td>
                            <td class="px-4 py-3 text-sm font-semibold text-gray-900 dark:text-white border-r border-gray-300 dark:border-slate-700"><?= $vpn['satker'] ?></td>
                            <td class="px-4 py-3 text-sm text-center border-r border-gray-300 dark:border-slate-700"><?= $vpn['username'] ?></td>
                            <td class="px-4 py-3 text-sm text-center border-r border-gray-300 dark:border-slate-700"><?= $vpn['password'] ?></td>
                            <td class="px-4 py-3 text-sm text-center border-r border-gray-300 dark:border-slate-700"><?= $vpn['isp_satker'] ?></td>
                            <td class="px-4 py-3 text-sm text-center border-r border-gray-300 dark:border-slate-700 font-mono"><?= $vpn['ip_vpn'] ?></td>
                            <td class="px-4 py-3 text-sm text-center border-r border-gray-300 dark:border-slate-700 font-mono"><?= $vpn['ip_lan'] ?></td>
                            <td class="px-4 py-3 text-sm text-center border-r border-gray-300 dark:border-slate-700"><?= $vpn['isp_pusat'] ?></td>
                            <td class="px-4 py-3 text-sm text-center border-r border-gray-300 dark:border-slate-700"><?= $vpn['snmp'] ?></td>
                            <td class="px-4 py-3 text-center border-r border-gray-300 dark:border-slate-700">
                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 border border-green-200">
                                    <?= $vpn['keterangan'] ?>
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center border-r border-gray-300 dark:border-slate-700">
                                <div class="flex items-center justify-center gap-2">
                                    <button class="p-1.5 text-green-600 hover:bg-green-50 dark:hover:bg-green-900/30 rounded-lg transition-colors" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- TABLE 2: NOT CONNECTED (Complex Header Style) -->
        <div x-show="activeTab === 'not_connected'" class="overflow-x-auto">
             <table class="w-full text-left border-collapse border border-gray-200 dark:border-slate-700">
                <thead class="bg-blue-200 dark:bg-slate-700 text-gray-800 dark:text-gray-200">
                    <tr>
                        <th rowspan="2" class="px-4 py-3 text-xs font-bold uppercase border border-gray-300 dark:border-slate-600 text-center w-12 bg-blue-300 dark:bg-blue-900/50">No</th>
                        <th rowspan="2" class="px-4 py-3 text-xs font-bold uppercase border border-gray-300 dark:border-slate-600 bg-blue-300 dark:bg-blue-900/50">Nama Satker RRI</th>
                        <th colspan="3" class="px-4 py-2 text-xs font-bold uppercase border border-gray-300 dark:border-slate-600 text-center bg-blue-300 dark:bg-blue-900/50">Username VPN Tunnel</th>
                        <th rowspan="2" class="px-4 py-3 text-xs font-bold uppercase border border-gray-300 dark:border-slate-600 text-center bg-blue-300 dark:bg-blue-900/50">Password</th>
                        <th colspan="3" class="px-4 py-2 text-xs font-bold uppercase border border-gray-300 dark:border-slate-600 text-center bg-blue-300 dark:bg-blue-900/50">Direct VPN MPLS</th>
                        <th rowspan="2" class="px-4 py-3 text-xs font-bold uppercase border border-gray-300 dark:border-slate-600 text-center bg-blue-300 dark:bg-blue-900/50">Status Logger</th>
                        <th rowspan="2" class="px-4 py-3 text-xs font-bold uppercase border border-gray-300 dark:border-slate-600 bg-blue-300 dark:bg-blue-900/50">PIC</th>
                        <th rowspan="2" class="px-4 py-3 text-xs font-bold uppercase border border-gray-300 dark:border-slate-600 bg-blue-300 dark:bg-blue-900/50 text-center">Aksi</th>
                    </tr>
                    <tr>
                        <!-- Subheaders for Username -->
                        <th class="px-3 py-2 text-xs font-bold border border-gray-300 dark:border-slate-600 text-center bg-blue-200 dark:bg-blue-900/30">PRO 1</th>
                        <th class="px-3 py-2 text-xs font-bold border border-gray-300 dark:border-slate-600 text-center bg-blue-200 dark:bg-blue-900/30">PRO 2</th>
                        <th class="px-3 py-2 text-xs font-bold border border-gray-300 dark:border-slate-600 text-center bg-blue-200 dark:bg-blue-900/30">PRO 4</th>
                        
                        <!-- Subheaders for ISP -->
                        <th class="px-3 py-2 text-xs font-bold border border-gray-300 dark:border-slate-600 text-center bg-blue-200 dark:bg-blue-900/30">ASTINET</th>
                        <th class="px-3 py-2 text-xs font-bold border border-gray-300 dark:border-slate-600 text-center bg-blue-200 dark:bg-blue-900/30">DSCPC</th>
                        <th class="px-3 py-2 text-xs font-bold border border-gray-300 dark:border-slate-600 text-center bg-blue-200 dark:bg-blue-900/30">HSP</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-slate-800 divide-y divide-gray-100 dark:divide-slate-700">
                    <?php if (empty($vpn_not_connected)): ?>
                        <tr><td colspan="12" class="px-6 py-8 text-center text-gray-500">Belum ada data.</td></tr>
                    <?php else: ?>
                        <?php foreach ($vpn_not_connected as $vpn): ?>
                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/30 transition-colors">
                            <td class="px-4 py-3 text-sm text-center border-r border-gray-300 dark:border-slate-700 font-medium text-gray-500 dark:text-gray-400"><?= $vpn['no'] ?></td>
                            <td class="px-4 py-3 text-sm font-semibold text-gray-900 dark:text-white border-r border-gray-300 dark:border-slate-700"><?= $vpn['satker'] ?></td>
                            
                            <!-- Username Columns / Single Column -->
                            <?php if(!empty($vpn['u_single'])): ?>
                                <td colspan="3" class="px-4 py-3 text-center text-sm font-mono text-gray-700 dark:text-gray-300 border-r border-gray-300 dark:border-slate-700 bg-gray-50/50 dark:bg-slate-700/30">
                                    <?= $vpn['u_single'] ?>
                                </td>
                            <?php else: ?>
                                <td class="px-2 py-3 text-xs text-center border-r border-gray-300 dark:border-slate-700 font-mono text-gray-600 dark:text-gray-400"><?= $vpn['u_pro1'] ?></td>
                                <td class="px-2 py-3 text-xs text-center border-r border-gray-300 dark:border-slate-700 font-mono text-gray-600 dark:text-gray-400"><?= $vpn['u_pro2'] ?></td>
                                <td class="px-2 py-3 text-xs text-center border-r border-gray-300 dark:border-slate-700 font-mono text-gray-600 dark:text-gray-400"><?= $vpn['u_pro4'] ?></td>
                            <?php endif; ?>

                            <td class="px-4 py-3 text-center border-r border-gray-300 dark:border-slate-700">
                                <span class="bg-gray-100 dark:bg-slate-700 px-2 py-1 rounded text-xs font-mono"><?= $vpn['password'] ?></span>
                            </td>

                            <!-- ISP Checks -->
                            <td class="px-2 py-3 text-center border-r border-gray-300 dark:border-slate-700">
                                <?= $vpn['isp_astinet'] ? '<span class="text-blue-600 dark:text-blue-400 font-bold">YA</span>' : '' ?>
                            </td>
                            <td class="px-2 py-3 text-center border-r border-gray-300 dark:border-slate-700">
                                <?= $vpn['isp_dscpc'] ? '<span class="text-purple-600 dark:text-purple-400 font-bold">YA</span>' : '' ?>
                            </td>
                            <td class="px-2 py-3 text-center border-r border-gray-300 dark:border-slate-700">
                                <?= $vpn['isp_hsp'] ? '<span class="text-pink-600 dark:text-pink-400 font-bold">YA</span>' : '' ?>
                            </td>

                            <td class="px-4 py-3 text-center border-r border-gray-300 dark:border-slate-700">
                                <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full bg-red-600 text-white text-xs font-bold">
                                    <?= $vpn['status'] ?>
                                </span>
                            </td>

                            <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">
                                <?= $vpn['pic'] ?>
                            </td>

                            <td class="px-4 py-3 text-center border-r border-gray-300 dark:border-slate-700">
                                <div class="flex items-center justify-center gap-2">
                                    <button class="p-1.5 text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-lg transition-colors" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
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
