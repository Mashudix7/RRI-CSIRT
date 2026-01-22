<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Audit Log</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Rekam jejak aktivitas pengguna sistem</p>
        </div>
        <div>
            <button onclick="window.print()" class="px-4 py-2 bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors shadow-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                Cetak Log
            </button>
        </div>
    </div>

    <!-- Filter Section (Optional) -->
    <!-- <div class="bg-white dark:bg-slate-800 p-4 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700">
        Filter controls here...
    </div> -->

    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-gray-50 dark:bg-slate-900/50 border-b border-gray-200 dark:border-slate-700 text-gray-500 dark:text-gray-400 uppercase tracking-wider font-semibold">
                        <th class="px-6 py-4 w-48">Waktu</th>
                        <th class="px-6 py-4 w-40">Pengguna</th>
                        <th class="px-6 py-4 w-32">Role</th>
                        <th class="px-6 py-4 w-40">Aksi</th>
                        <th class="px-6 py-4">Detail</th>
                        <th class="px-6 py-4 w-32">IP Address</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-slate-700">
                    <?php if(empty($logs)): ?>
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                Belum ada data log aktivitas.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($logs as $log): ?>
                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors">
                                <td class="px-6 py-4 font-mono text-gray-600 dark:text-gray-400">
                                    <?= date('d M Y H:i:s', strtotime($log['created_at'])) ?>
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                    <?= htmlspecialchars($log['username']) ?>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium 
                                        <?= $log['role'] == 'admin' ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300' : 
                                           ($log['role'] == 'management' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300' : 
                                           'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300') ?>">
                                        <?= ucfirst($log['role']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-700 dark:text-gray-300 font-medium">
                                    <?= ucwords(str_replace('_', ' ', $log['action'])) ?>
                                </td>
                                <td class="px-6 py-4 text-gray-500 dark:text-gray-400 max-w-md truncate" title="<?= htmlspecialchars($log['details']) ?>">
                                    <?= htmlspecialchars($log['details']) ?>
                                </td>
                                <td class="px-6 py-4 font-mono text-xs text-gray-400">
                                    <?= $log['ip_address'] ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <!-- Pagination if implemented -->
        <div class="p-4 border-t border-gray-100 dark:border-slate-700 text-right">
             <span class="text-xs text-gray-400">Menampilkan 100 aktivitas terakhir</span>
        </div>
    </div>
</div>
