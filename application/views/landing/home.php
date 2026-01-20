<!-- =====================================================
     Home Page - Full Height Hero with Dark Mode Support
     ===================================================== -->

<!-- Hero Section - FULL VIEWPORT HEIGHT -->
<section class="relative h-screen flex items-center overflow-hidden bg-white dark:bg-slate-900">
    <!-- Grid Pattern - Blue gradient for light mode -->
    <div class="absolute inset-0">
        <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <linearGradient id="grid-gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" style="stop-color:#3b82f6;stop-opacity:0.15"/>
                    <stop offset="50%" style="stop-color:#1d4ed8;stop-opacity:0.1"/>
                    <stop offset="100%" style="stop-color:#1e40af;stop-opacity:0.15"/>
                </linearGradient>
                <pattern id="grid" width="50" height="50" patternUnits="userSpaceOnUse">
                    <path d="M 50 0 L 0 0 0 50" fill="none" stroke="url(#grid-gradient)" stroke-width="1" class="dark:stroke-blue-500/20"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#grid)"/>
        </svg>
    </div>
    
    <!-- Dark mode glow effect -->
    <div class="hero-glow hidden dark:block"></div>
    
    <!-- Decorative Silhouettes/Blurs -->
    <div class="absolute top-20 left-10 w-72 h-72 bg-blue-500/10 dark:bg-blue-500/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-20 right-10 w-96 h-96 bg-blue-400/10 dark:bg-blue-600/10 rounded-full blur-3xl"></div>
    <div class="absolute top-1/2 left-1/3 w-64 h-64 bg-blue-300/10 dark:bg-blue-400/5 rounded-full blur-2xl"></div>
    
    <!-- Bottom gradient for dark mode only -->
    <div class="absolute bottom-0 left-0 w-full h-32 bg-gradient-to-t from-slate-900 to-transparent hidden dark:block"></div>
    
    <!-- Hero Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="max-w-3xl fade-in">
            <!-- Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-100 dark:bg-white/10 backdrop-blur-md rounded-full mb-6 border border-blue-200 dark:border-white/10">
                <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                <span class="text-blue-700 dark:text-white text-sm font-medium">Tim CSIRT Aktif 24/7</span>
            </div>
            
            <!-- Main Heading -->
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold text-gray-900 dark:text-white mb-6 leading-tight">
                Computer Security<br>
                <span class="text-blue-600 dark:text-blue-400">Incident Response Team</span>
            </h1>
            
            <!-- Subtitle -->
            <p class="text-lg text-gray-600 dark:text-blue-200/80 max-w-2xl mb-8 leading-relaxed">
                Portal informasi keamanan siber internal Radio Republik Indonesia. 
                Akses artikel, panduan, dan laporan insiden keamanan.
            </p>
            
            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row items-start gap-4">
                <a href="<?= base_url('auth/login') ?>" 
                   class="px-8 py-4 bg-blue-600 text-white font-semibold rounded-xl 
                          hover:bg-blue-700 shadow-lg hover:shadow-xl transition-all duration-300 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    Masuk Dashboard
                </a>
                <a href="#articles" 
                   class="px-8 py-4 bg-white dark:bg-white/5 text-blue-600 dark:text-white font-semibold rounded-xl border-2 border-blue-200 dark:border-white/10
                          hover:bg-blue-50 dark:hover:bg-white/10 transition-all duration-300 flex items-center gap-2 shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                    Lihat Artikel
                </a>
            </div>
        </div>
        
        <!-- Hero Image Placeholder (Right Side) -->
        <div class="hidden lg:block absolute right-8 top-1/2 -translate-y-1/2 w-96 h-96">
            <div class="relative w-full h-full">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-100 to-blue-50 dark:from-white/5 dark:to-white/5 backdrop-blur-sm rounded-3xl border border-blue-200 dark:border-white/10 flex items-center justify-center shadow-xl">
                    <div class="text-center text-blue-400 dark:text-white/60">
                        <svg class="w-24 h-24 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="text-sm">Hero Image</p>
                        <p class="text-xs mt-1">384 x 384 px</p>
                    </div>
                </div>
                <!-- Decorative rings -->
                <div class="absolute -inset-4 border border-blue-200/50 dark:border-white/10 rounded-[2rem]"></div>
                <div class="absolute -inset-8 border border-blue-100/50 dark:border-white/5 rounded-[3rem]"></div>
            </div>
        </div>
    </div>
    
    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10">
        <a href="#articles" class="flex flex-col items-center gap-2 text-blue-500 dark:text-white/60 hover:text-blue-600 dark:hover:text-white transition-colors">
            <span class="text-sm">Scroll untuk melihat artikel</span>
            <div class="animate-bounce">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                </svg>
            </div>
        </a>
    </div>
</section>

<!-- ============================================= -->
<!-- ARTIKEL SECTION - STARTS AFTER HERO          -->
<!-- ============================================= -->
<section id="articles" class="py-20 bg-white dark:bg-slate-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="flex items-center justify-between mb-10">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white">Artikel Terbaru</h2>
                <p class="text-gray-500 dark:text-gray-400 mt-2">Informasi dan panduan keamanan siber</p>
            </div>
            <a href="<?= base_url('artikel') ?>" class="hidden sm:flex items-center gap-2 text-blue-600 dark:text-blue-400 hover:text-blue-700 font-medium transition-colors">
                Lihat Semua
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
        
        <!-- Articles Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Featured Article -->
            <div class="lg:col-span-2 lg:row-span-2 bg-white dark:bg-slate-800 rounded-2xl shadow-md dark:shadow-none border border-gray-100 dark:border-slate-700 overflow-hidden hover:shadow-lg dark:hover:border-slate-600 transition-all group">
                <!-- Image Placeholder -->
                <div class="relative h-64 lg:h-80 bg-gradient-to-br from-blue-500 to-blue-700 dark:from-blue-600 dark:to-blue-900 overflow-hidden">
                    <div class="absolute inset-0 flex flex-col items-center justify-center text-white/40">
                        <svg class="w-20 h-20 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span class="text-sm">Featured Image (800x400)</span>
                    </div>
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 bg-red-500 text-white text-xs font-semibold rounded-full shadow">PENTING</span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-3 text-sm text-gray-400 dark:text-gray-500 mb-3">
                        <span>20 Jan 2026</span>
                        <span class="w-1 h-1 bg-gray-300 dark:bg-gray-600 rounded-full"></span>
                        <span class="text-blue-600 dark:text-blue-400">Keamanan</span>
                    </div>
                    <h3 class="text-xl lg:text-2xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                        Panduan Keamanan Password untuk Seluruh Pegawai RRI
                    </h3>
                    <p class="text-gray-500 dark:text-gray-400 line-clamp-3">
                        Kebijakan baru terkait penggunaan password yang aman. Semua pegawai wajib memperbarui password 
                        sesuai standar keamanan terbaru untuk mencegah akses tidak sah ke sistem internal.
                    </p>
                    <a href="<?= base_url('artikel/1') ?>" class="inline-flex items-center gap-2 mt-4 text-blue-600 dark:text-blue-400 font-medium hover:gap-3 transition-all">
                        Baca Selengkapnya
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>
            
            <!-- Article Card 2 -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-md dark:shadow-none border border-gray-100 dark:border-slate-700 overflow-hidden hover:shadow-lg dark:hover:border-slate-600 transition-all group">
                <div class="relative h-40 bg-gradient-to-br from-emerald-500 to-teal-600 dark:from-emerald-600 dark:to-teal-800 overflow-hidden">
                    <div class="absolute inset-0 flex items-center justify-center text-white/40">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="absolute top-3 left-3">
                        <span class="px-2 py-1 bg-emerald-600 text-white text-xs font-semibold rounded-full">TUTORIAL</span>
                    </div>
                </div>
                <div class="p-5">
                    <div class="flex items-center gap-2 text-xs text-gray-400 dark:text-gray-500 mb-2">
                        <span>18 Jan 2026</span>
                        <span class="w-1 h-1 bg-gray-300 dark:bg-gray-600 rounded-full"></span>
                        <span class="text-emerald-600 dark:text-emerald-400">Panduan</span>
                    </div>
                    <h3 class="font-bold text-gray-900 dark:text-white mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors line-clamp-2">
                        Cara Mengenali Email Phishing
                    </h3>
                    <a href="<?= base_url('artikel/2') ?>" class="text-sm text-blue-600 dark:text-blue-400 font-medium">Baca →</a>
                </div>
            </div>
            
            <!-- Article Card 3 -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-md dark:shadow-none border border-gray-100 dark:border-slate-700 overflow-hidden hover:shadow-lg dark:hover:border-slate-600 transition-all group">
                <div class="relative h-40 bg-gradient-to-br from-violet-500 to-purple-600 dark:from-violet-600 dark:to-purple-800 overflow-hidden">
                    <div class="absolute inset-0 flex items-center justify-center text-white/40">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="absolute top-3 left-3">
                        <span class="px-2 py-1 bg-violet-600 text-white text-xs font-semibold rounded-full">UPDATE</span>
                    </div>
                </div>
                <div class="p-5">
                    <div class="flex items-center gap-2 text-xs text-gray-400 dark:text-gray-500 mb-2">
                        <span>15 Jan 2026</span>
                        <span class="w-1 h-1 bg-gray-300 dark:bg-gray-600 rounded-full"></span>
                        <span class="text-violet-600 dark:text-violet-400">Pengumuman</span>
                    </div>
                    <h3 class="font-bold text-gray-900 dark:text-white mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors line-clamp-2">
                        Update Sistem Keamanan Jaringan Q1 2026
                    </h3>
                    <a href="<?= base_url('artikel/3') ?>" class="text-sm text-blue-600 dark:text-blue-400 font-medium">Baca →</a>
                </div>
            </div>
        </div>
        
        <!-- Mobile View All -->
        <div class="mt-8 text-center sm:hidden">
            <a href="<?= base_url('artikel') ?>" class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                Lihat Semua Artikel
            </a>
        </div>
    </div>
</section>

<!-- Categories - Light Blue Tint in Light Mode -->
<section class="py-20 bg-gradient-to-b from-blue-50 to-white dark:from-slate-900 dark:to-slate-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-3">Kategori Informasi</h2>
            <p class="text-gray-500 dark:text-gray-400">Jelajahi artikel berdasarkan kategori</p>
        </div>
        
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="<?= base_url('artikel?kategori=keamanan') ?>" class="bg-white dark:bg-slate-800 rounded-xl p-6 border border-gray-200 dark:border-slate-700 hover:border-blue-300 dark:hover:border-blue-500 hover:shadow-md transition-all group text-center">
                <div class="w-14 h-14 mx-auto bg-red-50 dark:bg-red-900/30 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 dark:text-white mb-1">Keamanan</h3>
                <p class="text-sm text-gray-400">12 Artikel</p>
            </a>
            
            <a href="<?= base_url('artikel?kategori=panduan') ?>" class="bg-white dark:bg-slate-800 rounded-xl p-6 border border-gray-200 dark:border-slate-700 hover:border-blue-300 dark:hover:border-blue-500 hover:shadow-md transition-all group text-center">
                <div class="w-14 h-14 mx-auto bg-blue-50 dark:bg-blue-900/30 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 dark:text-white mb-1">Panduan</h3>
                <p class="text-sm text-gray-400">25 Artikel</p>
            </a>
            
            <a href="<?= base_url('artikel?kategori=pengumuman') ?>" class="bg-white dark:bg-slate-800 rounded-xl p-6 border border-gray-200 dark:border-slate-700 hover:border-blue-300 dark:hover:border-blue-500 hover:shadow-md transition-all group text-center">
                <div class="w-14 h-14 mx-auto bg-amber-50 dark:bg-amber-900/30 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 dark:text-white mb-1">Pengumuman</h3>
                <p class="text-sm text-gray-400">8 Artikel</p>
            </a>
            
            <a href="<?= base_url('artikel?kategori=laporan') ?>" class="bg-white dark:bg-slate-800 rounded-xl p-6 border border-gray-200 dark:border-slate-700 hover:border-blue-300 dark:hover:border-blue-500 hover:shadow-md transition-all group text-center">
                <div class="w-14 h-14 mx-auto bg-violet-50 dark:bg-violet-900/30 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 dark:text-white mb-1">Laporan</h3>
                <p class="text-sm text-gray-400">5 Artikel</p>
            </a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 hero-gradient relative overflow-hidden">
    <!-- Grid Pattern -->
    <div class="absolute inset-0 opacity-20 dark:opacity-30">
        <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="cta-grid" width="40" height="40" patternUnits="userSpaceOnUse">
                    <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="0.5"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#cta-grid)"/>
        </svg>
    </div>
    
    <!-- Glow for dark mode -->
    <div class="hero-glow hidden dark:block"></div>
    
    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-2xl md:text-3xl font-bold text-white mb-4">
            Laporkan Insiden Keamanan
        </h2>
        <p class="text-blue-100 dark:text-blue-200/80 mb-8 max-w-2xl mx-auto">
            Jika Anda menemukan aktivitas mencurigakan atau insiden keamanan, 
            segera laporkan melalui dashboard atau hubungi tim CSIRT.
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="<?= base_url('auth/login') ?>" 
               class="px-8 py-4 bg-white text-blue-700 dark:text-blue-900 font-semibold rounded-xl 
                      hover:bg-blue-50 shadow-lg transition-all duration-300">
                Masuk & Laporkan
            </a>
            <a href="<?= base_url('kontak') ?>" 
               class="px-8 py-4 bg-white/10 dark:bg-white/5 text-white font-semibold rounded-xl border border-white/30 dark:border-white/10
                      hover:bg-white/20 dark:hover:bg-white/10 transition-all duration-300">
                Hubungi Tim
            </a>
        </div>
    </div>
</section>
