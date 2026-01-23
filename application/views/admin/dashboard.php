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
    <!-- Total Incidents -->
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-slate-700 hover:shadow-md transition-all relative overflow-hidden group" data-aos="fade-up">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 to-indigo-600"></div>
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Total Insiden</p>
                <h3 class="text-3xl font-bold text-gray-900 dark:text-white"><?= number_format($stats['total_incidents'] ?? 0) ?></h3>
            </div>
            <div class="w-12 h-12 bg-blue-100 dark:bg-blue-500/20 text-blue-600 dark:text-blue-400 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
        </div>
    </div>
    
    <!-- Resolved Incidents -->
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-slate-700 hover:shadow-md transition-all relative overflow-hidden group" data-aos="fade-up" data-aos-delay="100">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-green-500 to-emerald-500"></div>
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Insiden Teratasi</p>
                <h3 class="text-3xl font-bold text-green-600 dark:text-green-400"><?= number_format($stats['resolved_incidents'] ?? 0) ?></h3>
            </div>
            <div class="w-12 h-12 bg-green-100 dark:bg-green-500/20 text-green-600 dark:text-green-400 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
    </div>
    
    <!-- Pending Incidents -->
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-slate-700 hover:shadow-md transition-all relative overflow-hidden group" data-aos="fade-up" data-aos-delay="200">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-yellow-500 to-orange-500"></div>
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Tertunda</p>
                <h3 class="text-3xl font-bold text-yellow-600 dark:text-yellow-400"><?= number_format($stats['pending_incidents'] ?? 0) ?></h3>
            </div>
            <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-500/20 text-yellow-600 dark:text-yellow-400 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Main Content Grid -->
<div class="grid lg:grid-cols-1 gap-6">
    <!-- Empty State for Dashboard -->
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 p-12 text-center" data-aos="fade-up">
        <div class="w-20 h-20 bg-slate-100 dark:bg-slate-700/50 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
        </div>
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Selamat Datang di SOC RRI</h2>
        <p class="text-gray-500 dark:text-gray-400 max-w-md mx-auto">Gunakan menu di samping untuk mengelola konten, infrastruktur, dan administrasi sistem.</p>
    </div>
</div>

