<div class="space-y-8">
    <!-- Page Header & Summary -->
    <div>
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Mapping IP Publik RRI
                </h1>
                <p class="text-gray-500 dark:text-gray-400 mt-1 ml-10">Ringkasan alokasi dan distribusi IP Address Publik Data Center.</p>
            </div>
            <div class="flex gap-3">
                <a href="<?= base_url('admin/ip_management/networks') ?>" class="px-4 py-2 bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 text-blue-600 dark:text-blue-400 rounded-lg hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Kelola Wilayah
                </a>
                <button class="px-4 py-2 bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Export Report
                </button>
            </div>
        </div>

        <!-- Metric Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white dark:bg-slate-800 p-5 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 flex items-start justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total IP Publik</p>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mt-1">256</h3>
                    <p class="text-xs text-green-600 font-medium mt-1 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        All Allocated
                    </p>
                </div>
                <div class="p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg text-blue-600 dark:text-blue-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                </div>
            </div>
            
            <div class="bg-white dark:bg-slate-800 p-5 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 flex items-start justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total Networks</p>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mt-1">6</h3>
                    <p class="text-xs text-gray-500 mt-1">JKT, PDN, PST, DPK, +2 RS</p>
                </div>
                <div class="p-3 bg-purple-50 dark:bg-purple-900/20 rounded-lg text-purple-600 dark:text-purple-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
            </div>

             <div class="bg-white dark:bg-slate-800 p-5 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 flex items-start justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Available IP</p>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mt-1">~45%</h3>
                    <p class="text-xs text-yellow-600 font-medium mt-1">Estimated Free Space</p>
                </div>
                <div class="p-3 bg-green-50 dark:bg-green-900/20 rounded-lg text-green-600 dark:text-green-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>

            <div class="bg-gradient-to-br from-blue-600 to-blue-700 p-5 rounded-xl shadow-lg shadow-blue-500/20 text-white flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-blue-100 uppercase tracking-wider">System Status</p>
                    <h3 class="text-xl font-bold mt-1">Normal</h3>
                    <p class="text-xs text-blue-100 mt-1 opacity-80">All Networks Reachable</p>
                </div>
                <div class="p-3 bg-white/10 rounded-lg">
                   <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"/></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Table Card -->
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg shadow-gray-200/50 dark:shadow-black/20 border border-gray-100 dark:border-slate-700 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 dark:border-slate-700 flex items-center justify-between bg-gray-50/50 dark:bg-slate-800/50">
            <h3 class="font-semibold text-gray-900 dark:text-white">Daftar Network & Wilayah</h3>
            <div class="text-xs text-gray-500 italic">Klik pada baris untuk melihat detail IP</div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100 dark:bg-slate-900/50 text-gray-600 dark:text-gray-400 border-b border-gray-200 dark:border-slate-700">
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider w-16 text-center">No.</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Network IP</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Range IP Akhir</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Subnet</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider w-20 text-center">Prefix</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider w-28 text-center">Total IP</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Lokasi</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Keterangan</th>
                        <th class="px-4 py-4 w-10"></th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-100 dark:divide-slate-700">
                    <!-- DC Jakarta -->
                    <tr class="group hover:bg-blue-50 dark:hover:bg-blue-900/10 cursor-pointer transition-all duration-200 relative" onclick="window.location='<?= base_url('admin/ip_management/jakarta') ?>'">
                        <td class="px-6 py-4 text-center font-medium text-gray-500">1</td>
                        <td class="px-6 py-4 font-mono text-blue-600 dark:text-blue-400 font-medium">218.33.123.0</td>
                        <td class="px-6 py-4 font-mono text-gray-600 dark:text-gray-300">218.33.123.63</td>
                        <td class="px-6 py-4 font-mono text-gray-500">255.255.255.192</td>
                        <td class="px-6 py-4 text-center"><span class="px-2 py-1 bg-gray-100 dark:bg-slate-700 rounded text-xs font-bold text-gray-600 dark:text-gray-300">/26</span></td>
                        <td class="px-6 py-4 text-center font-semibold text-gray-700 dark:text-gray-200">64</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-blue-500 shadow-sm shadow-blue-500/50"></span>
                                <span class="font-medium text-gray-900 dark:text-white">DC Jakarta</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-500 italic">Core Network</td>
                        <td class="px-4 py-4 text-gray-400 group-hover:text-blue-500">
                             <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </td>
                    </tr>

                    <!-- DC PDN Serpong -->
                    <tr class="group hover:bg-purple-50 dark:hover:bg-purple-900/10 cursor-pointer transition-all duration-200" onclick="window.location='<?= base_url('admin/ip_management/serpong') ?>'">
                        <td class="px-6 py-4 text-center font-medium text-gray-500">2</td>
                        <td class="px-6 py-4 font-mono text-purple-600 dark:text-purple-400 font-medium">218.33.123.64</td>
                        <td class="px-6 py-4 font-mono text-gray-600 dark:text-gray-300">218.33.123.127</td>
                        <td class="px-6 py-4 font-mono text-gray-500">255.255.255.192</td>
                        <td class="px-6 py-4 text-center"><span class="px-2 py-1 bg-gray-100 dark:bg-slate-700 rounded text-xs font-bold text-gray-600 dark:text-gray-300">/26</span></td>
                        <td class="px-6 py-4 text-center font-semibold text-gray-700 dark:text-gray-200">64</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-purple-500 shadow-sm shadow-purple-500/50"></span>
                                <span class="font-medium text-gray-900 dark:text-white">DC PDN Serpong</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-500 italic">Disaster Recovery (DRC)</td>
                        <td class="px-4 py-4 text-gray-400 group-hover:text-purple-500">
                             <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </td>
                    </tr>

                    <!-- DC Kantor Pusat -->
                    <tr class="group hover:bg-amber-50 dark:hover:bg-amber-900/10 cursor-pointer transition-all duration-200" onclick="window.location='<?= base_url('admin/ip_management/pusat') ?>'">
                        <td class="px-6 py-4 text-center font-medium text-gray-500">3</td>
                        <td class="px-6 py-4 font-mono text-amber-600 dark:text-amber-400 font-medium">218.33.123.128</td>
                        <td class="px-6 py-4 font-mono text-gray-600 dark:text-gray-300">218.33.123.159</td>
                        <td class="px-6 py-4 font-mono text-gray-500">255.255.255.224</td>
                        <td class="px-6 py-4 text-center"><span class="px-2 py-1 bg-gray-100 dark:bg-slate-700 rounded text-xs font-bold text-gray-600 dark:text-gray-300">/27</span></td>
                        <td class="px-6 py-4 text-center font-semibold text-gray-700 dark:text-gray-200">32</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-amber-500 shadow-sm shadow-amber-500/50"></span>
                                <span class="font-medium text-gray-900 dark:text-white">DC Kantor Pusat</span>
                            </div>
                        </td>
                         <td class="px-6 py-4 text-gray-500 italic">Headquarters</td>
                        <td class="px-4 py-4 text-gray-400 group-hover:text-amber-500">
                             <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </td>
                    </tr>

                    <!-- Cadangan 1 -->
                    <tr class="group bg-yellow-50 dark:bg-yellow-900/10 hover:bg-yellow-100 dark:hover:bg-yellow-900/20 cursor-pointer transition-all duration-200 border-l-4 border-yellow-400" onclick="window.location='<?= base_url('admin/ip_management/reserve1') ?>'">
                         <td class="px-6 py-4 text-center font-medium text-gray-500">4</td>
                        <td class="px-6 py-4">
                            <span class="font-mono font-bold text-yellow-700 dark:text-yellow-400 bg-yellow-100 dark:bg-yellow-900/40 px-2 py-1 rounded">218.33.123.160</span>
                        </td>
                        <td class="px-6 py-4 font-mono text-gray-600 dark:text-gray-300">218.33.123.175</td>
                        <td class="px-6 py-4 font-mono text-gray-500">255.255.255.240</td>
                        <td class="px-6 py-4 text-center"><span class="px-2 py-1 bg-white dark:bg-slate-800 border border-yellow-100 dark:border-yellow-900 rounded text-xs font-bold text-yellow-600 dark:text-yellow-400">/28</span></td>
                        <td class="px-6 py-4 text-center font-semibold text-gray-700 dark:text-gray-200">16</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                Reserved
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                           Dapat digunakan untuk: IP Transit
                        </td>
                         <td class="px-4 py-4 text-gray-400 group-hover:text-yellow-600">
                             <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </td>
                    </tr>

                    <!-- Cadangan 2 -->
                    <tr class="group bg-yellow-50 dark:bg-yellow-900/10 hover:bg-yellow-100 dark:hover:bg-yellow-900/20 cursor-pointer transition-all duration-200 border-l-4 border-yellow-400" onclick="window.location='<?= base_url('admin/ip_management/reserve2') ?>'">
                         <td class="px-6 py-4 text-center font-medium text-gray-500">5</td>
                        <td class="px-6 py-4">
                            <span class="font-mono font-bold text-yellow-700 dark:text-yellow-400 bg-yellow-100 dark:bg-yellow-900/40 px-2 py-1 rounded">218.33.123.176</span>
                        </td>
                        <td class="px-6 py-4 font-mono text-gray-600 dark:text-gray-300">218.33.123.191</td>
                        <td class="px-6 py-4 font-mono text-gray-500">255.255.255.240</td>
                        <td class="px-6 py-4 text-center"><span class="px-2 py-1 bg-white dark:bg-slate-800 border border-yellow-100 dark:border-yellow-900 rounded text-xs font-bold text-yellow-600 dark:text-yellow-400">/28</span></td>
                        <td class="px-6 py-4 text-center font-semibold text-gray-700 dark:text-gray-200">16</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                Reserved
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                           Future DC / Event / Kebutuhan Dadakan
                        </td>
                         <td class="px-4 py-4 text-gray-400 group-hover:text-yellow-600">
                             <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </td>
                    </tr>

                     <!-- DC Depok -->
                     <tr class="group hover:bg-emerald-50 dark:hover:bg-emerald-900/10 cursor-pointer transition-all duration-200" onclick="window.location='<?= base_url('admin/ip_management/depok') ?>'">
                        <td class="px-6 py-4 text-center font-medium text-gray-500">6</td>
                        <td class="px-6 py-4 font-mono text-emerald-600 dark:text-emerald-400 font-medium">218.33.123.192</td>
                        <td class="px-6 py-4 font-mono text-gray-600 dark:text-gray-300">218.33.123.255</td>
                        <td class="px-6 py-4 font-mono text-gray-500">255.255.255.192</td>
                        <td class="px-6 py-4 text-center"><span class="px-2 py-1 bg-gray-100 dark:bg-slate-700 rounded text-xs font-bold text-gray-600 dark:text-gray-300">/26</span></td>
                        <td class="px-6 py-4 text-center font-semibold text-gray-700 dark:text-gray-200">64</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 shadow-sm shadow-emerald-500/50"></span>
                                <span class="font-medium text-gray-900 dark:text-white">DC Depok</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-500 italic">Data Center</td>
                         <td class="px-4 py-4 text-gray-400 group-hover:text-emerald-500">
                             <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
