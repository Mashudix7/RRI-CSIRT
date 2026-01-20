<!-- =====================================================
     Audit Log Page - Dark Mode Support
     ===================================================== -->

<!-- Header -->
<div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Audit Log</h1>
        <p class="text-gray-500 dark:text-gray-400 mt-1">Riwayat aktivitas pengguna dalam sistem</p>
    </div>
    <div class="flex items-center gap-3">
        <input type="date" class="px-4 py-2 border border-gray-200 dark:border-slate-600 rounded-lg focus:outline-none focus:border-blue-500 text-sm bg-white dark:bg-slate-700 text-gray-900 dark:text-white">
        <button class="px-4 py-2 bg-gray-100 dark:bg-slate-700 text-gray-700 dark:text-gray-300 font-medium rounded-lg hover:bg-gray-200 dark:hover:bg-slate-600 transition-colors text-sm">
            Filter
        </button>
    </div>
</div>

<!-- Log Table -->
<div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm dark:shadow-none border border-gray-100 dark:border-slate-700 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 dark:bg-slate-700/50 border-b border-gray-100 dark:border-slate-700">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Waktu</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Pengguna</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Aksi</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Detail</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">IP Address</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-slate-700">
                <?php foreach ($logs as $log): ?>
                <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors">
                    <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                        <?= date('d M Y', strtotime($log['time'])) ?>
                        <div class="text-xs text-gray-400 dark:text-gray-500"><?= date('H:i:s', strtotime($log['time'])) ?></div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                                <span class="text-white text-xs font-semibold"><?= strtoupper(substr($log['user'], 0, 1)) ?></span>
                            </div>
                            <span class="font-medium text-gray-900 dark:text-white"><?= htmlspecialchars($log['user']) ?></span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <?php
                        $action_colors = [
                            'LOGIN' => 'bg-green-100 text-green-700 dark:bg-green-500/20 dark:text-green-300',
                            'LOGOUT' => 'bg-gray-100 text-gray-700 dark:bg-gray-500/20 dark:text-gray-300',
                            'CREATE_INCIDENT' => 'bg-blue-100 text-blue-700 dark:bg-blue-500/20 dark:text-blue-300',
                            'UPDATE_INCIDENT' => 'bg-amber-100 text-amber-700 dark:bg-amber-500/20 dark:text-amber-300',
                            'DELETE_INCIDENT' => 'bg-red-100 text-red-700 dark:bg-red-500/20 dark:text-red-300',
                            'CREATE_USER' => 'bg-purple-100 text-purple-700 dark:bg-purple-500/20 dark:text-purple-300',
                        ];
                        $color = $action_colors[$log['action']] ?? 'bg-gray-100 text-gray-700 dark:bg-gray-500/20 dark:text-gray-300';
                        ?>
                        <span class="px-2.5 py-1 text-xs font-medium rounded-full <?= $color ?>">
                            <?= htmlspecialchars($log['action']) ?>
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                        <?= htmlspecialchars($log['details']) ?>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-400 font-mono">
                        <?= htmlspecialchars($log['ip']) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <div class="px-6 py-4 border-t border-gray-100 dark:border-slate-700 flex items-center justify-between">
        <p class="text-sm text-gray-500 dark:text-gray-400">Menampilkan <?= count($logs) ?> log terbaru</p>
        <div class="flex gap-1">
            <button class="px-3 py-1.5 text-sm rounded-lg bg-blue-600 text-white">1</button>
            <button class="px-3 py-1.5 text-sm rounded-lg text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-slate-700">2</button>
            <button class="px-3 py-1.5 text-sm rounded-lg text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-slate-700">3</button>
        </div>
    </div>
</div>
