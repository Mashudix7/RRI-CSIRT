<!-- =====================================================
     Settings Page - Dark Mode Support
     ===================================================== -->

<!-- Header -->
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Pengaturan</h1>
    <p class="text-gray-500 dark:text-gray-400 mt-1">Konfigurasi sistem dan preferensi</p>
</div>

<div class="grid lg:grid-cols-3 gap-6">
    <!-- Main Settings -->
    <div class="lg:col-span-2 space-y-6">
        <!-- General Settings -->
        <div class="bg-white dark:bg-slate-800 rounded-xl p-6 border border-gray-100 dark:border-slate-700 shadow-sm dark:shadow-none" data-aos="fade-up">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Pengaturan Umum</h3>
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nama Aplikasi</label>
                    <input type="text" value="CSIRT RRI" class="w-full px-4 py-2.5 border border-gray-200 dark:border-slate-600 rounded-lg focus:outline-none focus:border-blue-500 bg-white dark:bg-slate-700 text-gray-900 dark:text-white">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email Admin</label>
                    <input type="email" value="csirt@rri.co.id" class="w-full px-4 py-2.5 border border-gray-200 dark:border-slate-600 rounded-lg focus:outline-none focus:border-blue-500 bg-white dark:bg-slate-700 text-gray-900 dark:text-white">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Timezone</label>
                    <select class="w-full px-4 py-2.5 border border-gray-200 dark:border-slate-600 rounded-lg focus:outline-none focus:border-blue-500 bg-white dark:bg-slate-700 text-gray-900 dark:text-white">
                        <option value="Asia/Jakarta" selected>Asia/Jakarta (WIB)</option>
                        <option value="Asia/Makassar">Asia/Makassar (WITA)</option>
                        <option value="Asia/Jayapura">Asia/Jayapura (WIT)</option>
                    </select>
                </div>
            </div>
        </div>
        
        <!-- Notification Settings -->
        <div class="bg-white dark:bg-slate-800 rounded-xl p-6 border border-gray-100 dark:border-slate-700 shadow-sm dark:shadow-none" data-aos="fade-up" data-aos-delay="100">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Notifikasi</h3>
            
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">Email Notifikasi Insiden</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Kirim email saat ada insiden baru</p>
                    </div>
                    <button class="relative w-12 h-6 bg-blue-600 rounded-full transition-colors">
                        <span class="absolute right-1 top-1 w-4 h-4 bg-white rounded-full transition-transform"></span>
                    </button>
                </div>
                
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">Notifikasi Critical</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Notifikasi khusus untuk insiden critical</p>
                    </div>
                    <button class="relative w-12 h-6 bg-blue-600 rounded-full transition-colors">
                        <span class="absolute right-1 top-1 w-4 h-4 bg-white rounded-full transition-transform"></span>
                    </button>
                </div>
                
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">Daily Report</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Kirim laporan harian ke admin</p>
                    </div>
                    <button class="relative w-12 h-6 bg-gray-300 dark:bg-slate-600 rounded-full transition-colors">
                        <span class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-transform"></span>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Security Settings -->
        <div class="bg-white dark:bg-slate-800 rounded-xl p-6 border border-gray-100 dark:border-slate-700 shadow-sm dark:shadow-none" data-aos="fade-up" data-aos-delay="200">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Keamanan</h3>
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Session Timeout (menit)</label>
                    <input type="number" value="120" class="w-full px-4 py-2.5 border border-gray-200 dark:border-slate-600 rounded-lg focus:outline-none focus:border-blue-500 bg-white dark:bg-slate-700 text-gray-900 dark:text-white">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Max Login Attempts</label>
                    <input type="number" value="5" class="w-full px-4 py-2.5 border border-gray-200 dark:border-slate-600 rounded-lg focus:outline-none focus:border-blue-500 bg-white dark:bg-slate-700 text-gray-900 dark:text-white">
                </div>
                
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">Two-Factor Authentication</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Aktifkan 2FA untuk semua admin</p>
                    </div>
                    <button class="relative w-12 h-6 bg-gray-300 dark:bg-slate-600 rounded-full transition-colors">
                        <span class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-transform"></span>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Save Button -->
        <div class="flex justify-end">
            <button class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-medium rounded-lg hover:from-blue-700 hover:to-blue-800 shadow-md transition-all">
                Simpan Perubahan
            </button>
        </div>
    </div>
    
    <!-- Sidebar Info -->
    <div class="space-y-6">
        <!-- System Info -->
        <div class="bg-white dark:bg-slate-800 rounded-xl p-6 border border-gray-100 dark:border-slate-700 shadow-sm dark:shadow-none" data-aos="fade-left" data-aos-delay="300">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Informasi Sistem</h3>
            
            <div class="space-y-3 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-500 dark:text-gray-400">Versi Aplikasi</span>
                    <span class="text-gray-900 dark:text-white font-medium">1.0.0</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500 dark:text-gray-400">PHP Version</span>
                    <span class="text-gray-900 dark:text-white font-medium"><?= phpversion() ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500 dark:text-gray-400">CodeIgniter</span>
                    <span class="text-gray-900 dark:text-white font-medium">3.x</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500 dark:text-gray-400">Server</span>
                    <span class="text-gray-900 dark:text-white font-medium">Apache</span>
                </div>
            </div>
        </div>
        
        <!-- Quick Links -->
        <div class="bg-white dark:bg-slate-800 rounded-xl p-6 border border-gray-100 dark:border-slate-700 shadow-sm dark:shadow-none" data-aos="fade-left" data-aos-delay="400">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Aksi Cepat</h3>
            
            <div class="space-y-2">
                <button class="w-full px-4 py-2.5 text-left text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-700 rounded-lg transition-colors text-sm flex items-center gap-2">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Clear Cache
                </button>
                <button class="w-full px-4 py-2.5 text-left text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-700 rounded-lg transition-colors text-sm flex items-center gap-2">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                    </svg>
                    Backup Database
                </button>
                <button class="w-full px-4 py-2.5 text-left text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-700 rounded-lg transition-colors text-sm flex items-center gap-2">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    View Logs
                </button>
            </div>
        </div>
    </div>
</div>
