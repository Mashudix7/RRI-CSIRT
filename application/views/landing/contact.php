<!-- =====================================================
     Contact Page - With Dark Mode Support
     ===================================================== -->

<!-- Hero Section -->
<section class="relative pt-24 pb-16 hero-gradient overflow-hidden">
    <!-- Grid Pattern -->
    <div class="absolute inset-0 opacity-10 dark:opacity-20">
        <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                    <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="0.5"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#grid)"/>
        </svg>
    </div>
    
    <!-- Glow for dark mode -->
    <div class="hero-glow hidden dark:block"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block px-4 py-1.5 bg-white/20 dark:bg-white/10 backdrop-blur-sm rounded-full text-white text-sm font-medium mb-4">
            Kontak
        </span>
        <h1 class="text-3xl md:text-5xl font-bold text-white mb-4">
            Hubungi <span class="text-blue-200 dark:text-blue-400">Tim CSIRT</span>
        </h1>
        <p class="text-blue-100 dark:text-blue-200/80 max-w-2xl mx-auto">
            Hubungi kami untuk pertanyaan, koordinasi, atau konsultasi seputar keamanan siber
        </p>
    </div>
</section>

<!-- Contact Info & Form -->
<section class="py-20 bg-gradient-to-b from-blue-50 to-white dark:from-slate-900 dark:to-slate-900 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 min-w-0">
            <!-- Contact Info -->
            <div data-aos="fade-up" class="min-w-0">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 break-words">Informasi Kontak</h2>
                
                <div class="space-y-4">
                    <!-- Email -->
                    <div class="bg-white dark:bg-slate-800 rounded-xl p-5 border border-gray-200 dark:border-slate-700 shadow-lg dark:shadow-none flex items-start gap-4 hover:shadow-xl transition-shadow">
                        <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/50 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="min-w-0 break-words">
                            <h4 class="font-semibold text-gray-900 dark:text-white">Email</h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Untuk pertanyaan umum dan koordinasi</p>
                            <a href="mailto:csirt@rri.co.id" class="text-blue-600 dark:text-blue-400 font-medium">csirt@rri.co.id</a>
                        </div>
                    </div>
                    
                    <!-- Phone -->
                    <div class="bg-white dark:bg-slate-800 rounded-xl p-5 border border-gray-200 dark:border-slate-700 shadow-lg dark:shadow-none flex items-start gap-4 hover:shadow-xl transition-shadow">
                        <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/50 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 dark:text-white">Telepon</h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Jam kerja: Senin - Jumat, 08:00 - 17:00</p>
                            <a href="tel:02134567890" class="text-blue-600 dark:text-blue-400 font-medium">(021) 3456-7890</a>
                        </div>
                    </div>
                    
                    <!-- Emergency -->
                    <div class="bg-red-50 dark:bg-red-900/20 rounded-xl p-5 border border-red-200 dark:border-red-800 flex items-start gap-4 hover:shadow-xl transition-shadow">
                        <div class="w-12 h-12 bg-red-100 dark:bg-red-900/50 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-red-800 dark:text-red-300">Kontak Darurat</h4>
                            <p class="text-sm text-red-600 dark:text-red-400 mb-1">Untuk koordinasi insiden kritis - 24/7</p>
                            <a href="tel:08001234567" class="text-red-700 dark:text-red-300 font-bold text-lg">0800-123-4567</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Contact Form -->
            <div data-aos="fade-up" data-aos-delay="100" class="min-w-0">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 break-words">Kirim Pesan</h2>
                
                <form class="bg-white dark:bg-slate-800 rounded-xl p-6 border border-gray-200 dark:border-slate-700 shadow-lg dark:shadow-none space-y-4 min-w-0">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nama Lengkap</label>
                        <input type="text" placeholder="Masukkan nama lengkap" 
                               class="w-full px-4 py-3 bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label>
                        <input type="email" placeholder="email@rri.co.id" 
                               class="w-full px-4 py-3 bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Subjek</label>
                        <select class="w-full px-4 py-3 bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 dark:text-white">
                            <option value="">Pilih subjek...</option>
                            <option>Pertanyaan Umum</option>
                            <option>Koordinasi Insiden</option>
                            <option>Konsultasi Keamanan</option>
                            <option>Lainnya</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pesan</label>
                        <textarea rows="4" placeholder="Tuliskan pesan Anda..." 
                                  class="w-full px-4 py-3 bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500"></textarea>
                    </div>
                    
                    <button type="submit" 
                            class="w-full px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                        Kirim Pesan
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="py-16 bg-gradient-to-r from-blue-600 to-blue-800 dark:from-slate-800/50 dark:to-slate-800/50 relative overflow-hidden" data-aos="fade-in">
    <!-- Grid pattern -->
    <div class="absolute inset-0 opacity-10">
        <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="faq-grid" width="30" height="30" patternUnits="userSpaceOnUse">
                    <path d="M 30 0 L 0 0 0 30" fill="none" stroke="white" stroke-width="0.5"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#faq-grid)"/>
        </svg>
    </div>
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-white dark:text-white text-center mb-8" data-aos="fade-up">Pertanyaan Umum</h2>
        
        <div class="space-y-4" data-aos="fade-up" data-aos-delay="100">
            <details class="bg-white dark:bg-slate-800 rounded-xl border border-gray-200 dark:border-slate-700 overflow-hidden group shadow-lg">
                <summary class="px-6 py-4 cursor-pointer flex items-center justify-between font-medium text-gray-900 dark:text-white hover:bg-gray-50 dark:hover:bg-slate-700">
                    Bagaimana prosedur koordinasi insiden?
                    <svg class="w-5 h-5 text-gray-400 group-open:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </summary>
                <div class="px-6 pb-4 text-gray-600 dark:text-gray-400">
                    Koordinasi dapat dilakukan melalui dashboard internal (tiket), email ke csirt@rri.co.id, atau kontak darurat untuk eskalasi prioritas tinggi.
                </div>
            </details>
            
            <details class="bg-white dark:bg-slate-800 rounded-xl border border-gray-200 dark:border-slate-700 overflow-hidden group">
                <summary class="px-6 py-4 cursor-pointer flex items-center justify-between font-medium text-gray-900 dark:text-white hover:bg-gray-50 dark:hover:bg-slate-700">
                    Apa yang dikategorikan sebagai insiden critical?
                    <svg class="w-5 h-5 text-gray-400 group-open:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </summary>
                <div class="px-6 pb-4 text-gray-600 dark:text-gray-400">
                    Insiden critical meliputi: serangan ransomware, kebocoran data sensitif, akses tidak sah ke sistem produksi, dan gangguan layanan siaran.
                </div>
            </details>
            
            <details class="bg-white dark:bg-slate-800 rounded-xl border border-gray-200 dark:border-slate-700 overflow-hidden group">
                <summary class="px-6 py-4 cursor-pointer flex items-center justify-between font-medium text-gray-900 dark:text-white hover:bg-gray-50 dark:hover:bg-slate-700">
                    Berapa lama waktu respons untuk laporan insiden?
                    <svg class="w-5 h-5 text-gray-400 group-open:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </summary>
                <div class="px-6 pb-4 text-gray-600 dark:text-gray-400">
                    Untuk insiden critical: maksimal 1 jam. Untuk insiden high: maksimal 4 jam. Untuk insiden medium/low: maksimal 24 jam kerja.
                </div>
            </details>
        </div>
    </div>
</section>
