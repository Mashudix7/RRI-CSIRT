<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white"><?= $title ?></h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">Monitoring seluruh log serangan dari SafeLine WAF secara mendalam.</p>
        </div>
        <div class="flex gap-2">
            <button onclick="refreshTable()" class="flex items-center gap-2 px-4 py-2 bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-700 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                Refresh
            </button>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white dark:bg-slate-800 p-5 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm">
            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase mb-1">Total Serangan (Hari Ini)</p>
            <h3 id="stat-today-total" class="text-2xl font-bold text-gray-900 dark:text-white">-</h3>
        </div>
        <div class="bg-white dark:bg-slate-800 p-5 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm border-l-4 border-l-red-500">
            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase mb-1">Tinggi Ancaman</p>
            <h3 id="stat-high-threat" class="text-2xl font-bold text-gray-900 dark:text-white">-</h3>
        </div>
        <div class="bg-white dark:bg-slate-800 p-5 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm border-l-4 border-l-green-500">
            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase mb-1">Berhasil Diblokir</p>
            <h3 id="stat-blocked" class="text-2xl font-bold text-gray-900 dark:text-white">-</h3>
        </div>
        <div class="bg-white dark:bg-slate-800 p-5 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm border-l-4 border-l-blue-500">
            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase mb-1">IP Unik</p>
            <h3 id="stat-ips" class="text-2xl font-bold text-gray-900 dark:text-white">-</h3>
        </div>
    </div>

    <!-- Data Table -->
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 overflow-hidden">
        <div class="p-6 border-b border-gray-100 dark:border-slate-700 flex justify-between items-center">
            <h3 class="font-bold text-gray-900 dark:text-white">Daftar Log Serangan Lengkap</h3>
        </div>
        <div class="p-6">
            <div class="overflow-x-auto">
                <table id="waf-logs-table" class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 dark:bg-slate-700/50">
                            <th class="px-4 py-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Waktu</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">IP Sumber</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Target (Host)</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Path / URL</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Jenis Serangan</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-slate-700">
                        <!-- Loaded via DataTable -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Styles and Scripts -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<style>
    /* Custom DataTables Styling for Dark Mode */
    .dataTables_wrapper .dataTables_length select,
    .dataTables_wrapper .dataTables_filter input {
        @apply bg-white dark:bg-slate-700 border border-gray-200 dark:border-slate-600 rounded-lg px-3 py-1 text-sm outline-none focus:ring-2 focus:ring-blue-500;
        margin-bottom: 1rem;
    }
    .dark .dataTables_wrapper .dataTables_length,
    .dark .dataTables_wrapper .dataTables_filter,
    .dark .dataTables_wrapper .dataTables_info,
    .dark .dataTables_wrapper .dataTables_processing,
    .dark .dataTables_wrapper .dataTables_paginate {
        @apply text-gray-400;
    }
    .dark .dataTables_wrapper .dataTables_paginate .paginate_button {
        @apply text-gray-400 !important;
    }
    .dark table.dataTable tbody tr {
        @apply bg-slate-800 text-gray-300;
    }
    .dark table.dataTable thead th {
        @apply border-slate-700;
    }
    table.dataTable.no-footer {
        border-bottom: 1px solid #e5e7eb;
    }
    .dark table.dataTable.no-footer {
        border-bottom: 1px solid #334155;
    }
</style>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
let dataTable;

$(document).ready(function() {
    dataTable = $('#waf-logs-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?= base_url("waf/records_paged") ?>',
            type: 'POST',
            dataSrc: function(json) {
                // Update stats cards if provided in response
                if (json.stats) {
                    $('#stat-today-total').text(new Intl.NumberFormat().format(json.stats.total_attacks));
                    $('#stat-blocked').text(new Intl.NumberFormat().format(json.stats.blocked_attacks));
                    $('#stat-ips').text(new Intl.NumberFormat().format(json.stats.active_threats));
                    $('#stat-high-threat').text(json.stats.protection_level || 'High');
                }
                return json.data;
            }
        },
        columns: [
            { 
                data: 'timestamp',
                render: function(data) {
                    const d = new Date(data * 1000);
                    return `<div class="text-xs font-medium">${d.toLocaleDateString()}</div><div class="text-[10px] text-gray-400">${d.toLocaleTimeString()}</div>`;
                }
            },
            { 
                data: 'src_ip',
                render: function(data, type, row) {
                    return `<div>
                        <span class="font-mono text-sm font-bold text-gray-800 dark:text-gray-200">${data}</span>
                        <div class="text-[10px] text-blue-500">${row.country || 'Indonesia'}</div>
                    </div>`;
                }
            },
            { data: 'host', className: 'text-sm' },
            { 
                data: 'url_path',
                render: function(data) {
                    return `<div class="truncate max-w-[200px] text-xs font-mono bg-gray-50 dark:bg-slate-900 p-1 rounded" title="${data}">${data}</div>`;
                }
            },
            { 
                data: 'module',
                render: function(data) {
                    return `<span class="px-2 py-1 bg-slate-100 dark:bg-slate-700 text-gray-600 dark:text-gray-300 rounded text-[10px] font-bold uppercase">${data || 'Unknown'}</span>`;
                }
            },
            { 
                data: 'action',
                className: 'text-center',
                render: function(data) {
                    const isBlocked = (data == 1 || data == 'block' || data == 'deny');
                    return isBlocked 
                        ? '<span class="px-2 py-1 bg-red-100 text-red-600 dark:bg-red-500/20 dark:text-red-400 rounded text-[10px] font-bold">BLOCKED</span>'
                        : '<span class="px-2 py-1 bg-yellow-100 text-yellow-600 dark:bg-yellow-500/20 dark:text-yellow-400 rounded text-[10px] font-bold">DETECTED</span>';
                }
            }
        ],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
        },
        pageLength: 10,
        order: [[0, 'desc']]
    });
});

function refreshTable() {
    dataTable.ajax.reload();
}
</script>
