<div class="space-y-8">
    <!-- Header & Summary -->
    <div>
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
            <div>
                 <h1 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.2-2.858.59-4.181m-3.236 5.77a9 9 0 01.997-6.112"/></svg>
                    Manajemen IP VPN
                </h1>
                <p class="text-gray-500 dark:text-gray-400 mt-1 ml-10">Daftar alokasi IP untuk client VPN dan Site-to-Site connections.</p>
            </div>
            <button class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium shadow-lg shadow-blue-500/30 transition-all transform hover:scale-105 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                Tambah Client
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
             <div class="bg-white dark:bg-slate-800 p-5 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 flex items-center gap-4">
                <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-full text-blue-600 dark:text-blue-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">32</h3>
                    <p class="text-sm text-gray-500">Total Client</p>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-800 p-5 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 flex items-center gap-4">
                <div class="p-3 bg-green-100 dark:bg-green-900/30 rounded-full text-green-600 dark:text-green-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">18</h3>
                    <p class="text-sm text-gray-500">Online Now</p>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-800 p-5 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 flex items-center gap-4">
                <div class="p-3 bg-purple-100 dark:bg-purple-900/30 rounded-full text-purple-600 dark:text-purple-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                     <h3 class="text-2xl font-bold text-gray-900 dark:text-white">10.8.0.0/24</h3>
                    <p class="text-sm text-gray-500">VPN Subnet</p>
                </div>
            </div>
        </div>
    </div>

    <!-- VPN List -->
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg shadow-gray-200/50 dark:shadow-black/20 border border-gray-100 dark:border-slate-700 overflow-hidden">
        
        <!-- Toolbar -->
         <div class="p-4 border-b border-gray-100 dark:border-slate-700 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="relative max-w-sm w-full">
                <input type="text" placeholder="Search client name, IP, or location..." class="w-full pl-10 pr-4 py-2 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 text-sm">
                <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <div class="flex gap-2">
                 <select class="px-3 py-2 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-700 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20">
                    <option value="all">All Status</option>
                    <option value="connected">Connected</option>
                    <option value="disconnected">Disconnected</option>
                </select>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50 dark:bg-slate-700/50 border-b border-gray-100 dark:border-slate-700">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase w-16">No</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Username / Client ID</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">IP Address</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Lokasi / Unit</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase text-center w-32">Status</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase text-right w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-slate-700">
                    <!-- Mock Data VPN -->
                    <?php 
                    $vpn_data = [
                        ['id' => 1, 'user' => 'vpn_pusat_01', 'ip' => '10.8.0.2', 'loc' => 'Kantor Pusat - IT', 'status' => 'active', 'last_seen' => 'Just now'],
                        ['id' => 2, 'user' => 'vpn_jogja_01', 'ip' => '10.8.0.3', 'loc' => 'RRI Yogyakarta', 'status' => 'active', 'last_seen' => '2 mins ago'],
                        ['id' => 3, 'user' => 'vpn_surabaya_01', 'ip' => '10.8.0.4', 'loc' => 'RRI Surabaya', 'status' => 'inactive', 'last_seen' => '2 days ago'],
                        ['id' => 4, 'user' => 'vpn_biak_01', 'ip' => '10.8.0.5', 'loc' => 'RRI Biak', 'status' => 'inactive', 'last_seen' => '1 week ago'],
                         ['id' => 5, 'user' => 'vpn_bengkulu_01', 'ip' => '10.8.0.6', 'loc' => 'RRI Bengkulu', 'status' => 'active', 'last_seen' => '5 mins ago'],
                    ];
                    ?>
                    <?php foreach($vpn_data as $i => $vpn): ?>
                    <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors">
                        <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400 text-center"><?= $i + 1 ?></td>
                        <td class="px-6 py-4">
                            <span class="font-medium text-gray-900 dark:text-white block"><?= $vpn['user'] ?></span>
                            <span class="text-xs text-gray-400">Created: Jan 2024</span>
                        </td>
                        <td class="px-6 py-4 font-mono text-sm text-gray-600 dark:text-gray-300"><?= $vpn['ip'] ?></td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300"><?= $vpn['loc'] ?></td>
                        <td class="px-6 py-4 text-center">
                            <?php if($vpn['status'] == 'active'): ?>
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
                                    Online
                                </span>
                            <?php else: ?>
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-500">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                                    Offline
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 text-right">
                             <button class="text-gray-400 hover:text-blue-600 transition-colors p-2 hover:bg-gray-100 rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/></svg>
                             </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <!-- Pagination Mock -->
        <div class="px-6 py-4 border-t border-gray-100 dark:border-slate-700 flex items-center justify-between">
            <span class="text-sm text-gray-500">Showing 1 to 5 of 32 entries</span>
             <div class="flex gap-1">
                <button class="px-3 py-1 border border-gray-200 rounded hover:bg-gray-50 text-sm disabled:opacity-50" disabled>Previous</button>
                <button class="px-3 py-1 bg-blue-600 text-white rounded text-sm">1</button>
                <button class="px-3 py-1 border border-gray-200 rounded hover:bg-gray-50 text-sm">2</button>
                <button class="px-3 py-1 border border-gray-200 rounded hover:bg-gray-50 text-sm">3</button>
                <button class="px-3 py-1 border border-gray-200 rounded hover:bg-gray-50 text-sm">Next</button>
            </div>
        </div>
    </div>
</div>
