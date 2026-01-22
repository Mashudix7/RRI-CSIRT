<!-- =====================================================
     Reports Page - Dark Mode Support
     ===================================================== -->

<!-- Header -->
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Laporan & Statistik</h1>
    <p class="text-gray-500 dark:text-gray-400 mt-1">Ringkasan penanganan insiden dan performa tim</p>
</div>

<!-- Stats Overview -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <div class="bg-white dark:bg-slate-800 rounded-xl p-6 border border-gray-100 dark:border-slate-700 shadow-sm dark:shadow-none" data-aos="fade-up" data-aos-delay="0">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-3xl font-bold text-gray-900 dark:text-white"><?= $stats['total_incidents'] ?></div>
                <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">Total Insiden</div>
            </div>
            <div class="w-12 h-12 bg-blue-100 dark:bg-blue-500/20 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
        </div>
    </div>
    
    <div class="bg-white dark:bg-slate-800 rounded-xl p-6 border border-gray-100 dark:border-slate-700 shadow-sm dark:shadow-none" data-aos="fade-up" data-aos-delay="100">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-3xl font-bold text-green-600 dark:text-green-400"><?= $stats['resolved'] ?></div>
                <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">Diselesaikan</div>
            </div>
            <div class="w-12 h-12 bg-green-100 dark:bg-green-500/20 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
        </div>
    </div>
    
    <div class="bg-white dark:bg-slate-800 rounded-xl p-6 border border-gray-100 dark:border-slate-700 shadow-sm dark:shadow-none" data-aos="fade-up" data-aos-delay="200">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-3xl font-bold text-amber-600 dark:text-amber-400"><?= $stats['pending'] ?></div>
                <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">Pending</div>
            </div>
            <div class="w-12 h-12 bg-amber-100 dark:bg-amber-500/20 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
    </div>
    
    <div class="bg-white dark:bg-slate-800 rounded-xl p-6 border border-gray-100 dark:border-slate-700 shadow-sm dark:shadow-none" data-aos="fade-up" data-aos-delay="300">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-3xl font-bold text-purple-600 dark:text-purple-400"><?= $stats['avg_resolution_time'] ?></div>
                <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">Waktu Rata-rata</div>
            </div>
            <div class="w-12 h-12 bg-purple-100 dark:bg-purple-500/20 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Charts Placeholder -->
<div class="grid lg:grid-cols-2 gap-6 mb-8" data-aos="fade-up" data-aos-delay="400">
    <!-- Incidents by Month -->
    <div class="bg-white dark:bg-slate-800 rounded-xl p-6 border border-gray-100 dark:border-slate-700 shadow-sm dark:shadow-none">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Insiden per Bulan</h3>
        <div class="h-64 bg-gray-50 dark:bg-slate-700/50 rounded-lg flex items-center justify-center">
            <div class="text-center text-gray-400 dark:text-gray-500">
                <svg class="w-12 h-12 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                <p>Chart akan ditampilkan di sini</p>
                <p class="text-sm">(Integrasi Chart.js)</p>
            </div>
        </div>
    </div>
    
    <!-- Incidents by Severity -->
    <div class="bg-white dark:bg-slate-800 rounded-xl p-6 border border-gray-100 dark:border-slate-700 shadow-sm dark:shadow-none">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Distribusi Severity</h3>
        <div class="h-64 bg-gray-50 dark:bg-slate-700/50 rounded-lg flex items-center justify-center">
            <div class="text-center text-gray-400 dark:text-gray-500">
                <svg class="w-12 h-12 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                </svg>
                <p>Pie Chart akan ditampilkan di sini</p>
                <p class="text-sm">(Integrasi Chart.js)</p>
            </div>
        </div>
    </div>
</div>

<!-- Export Options -->
<div class="bg-white dark:bg-slate-800 rounded-xl p-6 border border-gray-100 dark:border-slate-700 shadow-sm dark:shadow-none" data-aos="fade-left" data-aos-delay="500">
    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Export Laporan</h3>
    <div class="flex flex-wrap gap-3">
        <button class="px-4 py-2.5 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-colors flex items-center gap-2">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zM6 20V4h7v5h5v11H6z"/>
            </svg>
            Export Excel
        </button>
        <button class="px-4 py-2.5 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition-colors flex items-center gap-2">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zM6 20V4h7v5h5v11H6z"/>
            </svg>
            Export PDF
        </button>
        <button class="px-4 py-2.5 bg-gray-600 text-white font-medium rounded-lg hover:bg-gray-700 transition-colors flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
            </svg>
            Print
        </button>
    </div>
</div>
