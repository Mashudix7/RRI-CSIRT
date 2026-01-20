<!-- =====================================================
     Team Page - Organizational Chart Style
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
            Tim Kami
        </span>
        <h1 class="text-3xl md:text-5xl font-bold text-white mb-4">
            Tim <span class="text-blue-200 dark:text-blue-400">CSIRT RRI</span>
        </h1>
        <p class="text-blue-100 dark:text-blue-200/80 max-w-2xl mx-auto">
            Para profesional yang berdedikasi untuk menjaga keamanan siber RRI
        </p>
    </div>
</section>

<!-- Team Members with Tabs -->
<section class="py-20 bg-gradient-to-b from-blue-50 to-white dark:from-slate-900 dark:to-slate-900" x-data="{ activeTab: 'media-baru' }">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Tab Buttons -->
        <div class="flex flex-wrap justify-center gap-4 mb-16">
            <button @click="activeTab = 'media-baru'" 
                    :class="activeTab === 'media-baru' ? 'bg-blue-600 text-white shadow-lg' : 'bg-white dark:bg-slate-800 text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-slate-700 hover:bg-blue-50 dark:hover:bg-slate-700'"
                    class="px-6 py-3 rounded-xl font-semibold transition-all duration-300">
                <span class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Tim Teknologi Media Baru
                </span>
            </button>
            <button @click="activeTab = 'it'" 
                    :class="activeTab === 'it' ? 'bg-blue-600 text-white shadow-lg' : 'bg-white dark:bg-slate-800 text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-slate-700 hover:bg-blue-50 dark:hover:bg-slate-700'"
                    class="px-6 py-3 rounded-xl font-semibold transition-all duration-300">
                <span class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                    </svg>
                    Tim IT
                </span>
            </button>
        </div>
        
        <!-- Tim Teknologi Media Baru - Org Chart Style (1-7 Structure) -->
        <div x-show="activeTab === 'media-baru'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0">
            
            <!-- Row 1: Leader -->
            <div class="flex justify-center mb-0">
                <div class="bg-white dark:bg-slate-800 rounded-xl p-5 border-2 border-blue-500 dark:border-blue-400 shadow-lg dark:shadow-none text-center w-56">
                    <div class="w-20 h-20 mx-auto mb-3 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>
                    <span class="inline-block px-2 py-0.5 bg-blue-100 dark:bg-blue-900/50 text-blue-700 dark:text-blue-300 text-xs font-semibold rounded-full mb-2">KEPALA TIM</span>
                    <h3 class="font-bold text-gray-900 dark:text-white mb-1">Ahmad Fauzi</h3>
                    <p class="text-blue-600 dark:text-blue-400 text-xs font-medium">Kepala Tim Media Baru</p>
                </div>
            </div>
            
            <!-- Connector Line: Level 1 to Level 2 (7 members) -->
            <div class="flex justify-center">
                <div class="w-0.5 h-8 bg-blue-300 dark:bg-blue-600"></div>
            </div>
            <div class="flex justify-center">
                <div class="w-[850px] h-0.5 bg-blue-300 dark:bg-blue-600"></div>
            </div>
            <div class="flex justify-center">
                <div class="flex justify-between w-[850px]">
                    <div class="w-0.5 h-8 bg-blue-300 dark:bg-blue-600"></div>
                    <div class="w-0.5 h-8 bg-blue-300 dark:bg-blue-600"></div>
                    <div class="w-0.5 h-8 bg-blue-300 dark:bg-blue-600"></div>
                    <div class="w-0.5 h-8 bg-blue-300 dark:bg-blue-600"></div>
                    <div class="w-0.5 h-8 bg-blue-300 dark:bg-blue-600"></div>
                    <div class="w-0.5 h-8 bg-blue-300 dark:bg-blue-600"></div>
                    <div class="w-0.5 h-8 bg-blue-300 dark:bg-blue-600"></div>
                </div>
            </div>
            
            <!-- Row 2: Team Members (7 members) -->
            <div class="flex justify-center gap-3 flex-wrap">
                <div class="bg-white dark:bg-slate-800 rounded-xl p-4 border border-gray-200 dark:border-slate-700 shadow-md dark:shadow-none text-center w-28">
                    <div class="w-12 h-12 mx-auto mb-2 bg-gradient-to-br from-purple-400 to-purple-500 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 dark:text-white text-xs mb-1">Siti Rahayu</h3>
                    <p class="text-purple-600 dark:text-purple-400 text-[10px]">Web Dev Lead</p>
                </div>
                
                <div class="bg-white dark:bg-slate-800 rounded-xl p-4 border border-gray-200 dark:border-slate-700 shadow-md dark:shadow-none text-center w-28">
                    <div class="w-12 h-12 mx-auto mb-2 bg-gradient-to-br from-purple-400 to-purple-500 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 dark:text-white text-xs mb-1">Budi Santoso</h3>
                    <p class="text-purple-600 dark:text-purple-400 text-[10px]">Content Lead</p>
                </div>
                
                <div class="bg-white dark:bg-slate-800 rounded-xl p-4 border border-gray-200 dark:border-slate-700 shadow-md dark:shadow-none text-center w-28">
                    <div class="w-12 h-12 mx-auto mb-2 bg-gradient-to-br from-blue-100 to-blue-50 dark:from-slate-700 dark:to-slate-600 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-400 dark:text-slate-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 dark:text-white text-xs mb-1">Dewi Pertiwi</h3>
                    <p class="text-blue-600 dark:text-blue-400 text-[10px]">UI/UX Designer</p>
                </div>
                
                <div class="bg-white dark:bg-slate-800 rounded-xl p-4 border border-gray-200 dark:border-slate-700 shadow-md dark:shadow-none text-center w-28">
                    <div class="w-12 h-12 mx-auto mb-2 bg-gradient-to-br from-blue-100 to-blue-50 dark:from-slate-700 dark:to-slate-600 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-400 dark:text-slate-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 dark:text-white text-xs mb-1">Rudi Hermawan</h3>
                    <p class="text-blue-600 dark:text-blue-400 text-[10px]">Web Developer</p>
                </div>
                
                <div class="bg-white dark:bg-slate-800 rounded-xl p-4 border border-gray-200 dark:border-slate-700 shadow-md dark:shadow-none text-center w-28">
                    <div class="w-12 h-12 mx-auto mb-2 bg-gradient-to-br from-blue-100 to-blue-50 dark:from-slate-700 dark:to-slate-600 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-400 dark:text-slate-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 dark:text-white text-xs mb-1">Rina Wulandari</h3>
                    <p class="text-blue-600 dark:text-blue-400 text-[10px]">Video Producer</p>
                </div>
                
                <div class="bg-white dark:bg-slate-800 rounded-xl p-4 border border-gray-200 dark:border-slate-700 shadow-md dark:shadow-none text-center w-28">
                    <div class="w-12 h-12 mx-auto mb-2 bg-gradient-to-br from-blue-100 to-blue-50 dark:from-slate-700 dark:to-slate-600 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-400 dark:text-slate-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 dark:text-white text-xs mb-1">Agus Prasetyo</h3>
                    <p class="text-blue-600 dark:text-blue-400 text-[10px]">Podcast Mgr</p>
                </div>
                
                <div class="bg-white dark:bg-slate-800 rounded-xl p-4 border border-gray-200 dark:border-slate-700 shadow-md dark:shadow-none text-center w-28">
                    <div class="w-12 h-12 mx-auto mb-2 bg-gradient-to-br from-blue-100 to-blue-50 dark:from-slate-700 dark:to-slate-600 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-400 dark:text-slate-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 dark:text-white text-xs mb-1">Maya Kusuma</h3>
                    <p class="text-blue-600 dark:text-blue-400 text-[10px]">Social Media</p>
                </div>
            </div>
        </div>
        
        <!-- Tim IT - Org Chart Style (1-7 Structure) -->
        <div x-show="activeTab === 'it'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0">
            
            <!-- Row 1: Leader -->
            <div class="flex justify-center mb-0">
                <div class="bg-white dark:bg-slate-800 rounded-xl p-5 border-2 border-emerald-500 dark:border-emerald-400 shadow-lg dark:shadow-none text-center w-56">
                    <div class="w-20 h-20 mx-auto mb-3 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>
                    <span class="inline-block px-2 py-0.5 bg-emerald-100 dark:bg-emerald-900/50 text-emerald-700 dark:text-emerald-300 text-xs font-semibold rounded-full mb-2">KEPALA TIM</span>
                    <h3 class="font-bold text-gray-900 dark:text-white mb-1">Hendra Wijaya</h3>
                    <p class="text-emerald-600 dark:text-emerald-400 text-xs font-medium">Kepala Tim IT</p>
                </div>
            </div>
            
            <!-- Connector Line: Level 1 to Level 2 (7 members) -->
            <div class="flex justify-center">
                <div class="w-0.5 h-8 bg-emerald-300 dark:bg-emerald-600"></div>
            </div>
            <div class="flex justify-center">
                <div class="w-[850px] h-0.5 bg-emerald-300 dark:bg-emerald-600"></div>
            </div>
            <div class="flex justify-center">
                <div class="flex justify-between w-[850px]">
                    <div class="w-0.5 h-8 bg-emerald-300 dark:bg-emerald-600"></div>
                    <div class="w-0.5 h-8 bg-emerald-300 dark:bg-emerald-600"></div>
                    <div class="w-0.5 h-8 bg-emerald-300 dark:bg-emerald-600"></div>
                    <div class="w-0.5 h-8 bg-emerald-300 dark:bg-emerald-600"></div>
                    <div class="w-0.5 h-8 bg-emerald-300 dark:bg-emerald-600"></div>
                    <div class="w-0.5 h-8 bg-emerald-300 dark:bg-emerald-600"></div>
                    <div class="w-0.5 h-8 bg-emerald-300 dark:bg-emerald-600"></div>
                </div>
            </div>
            
            <!-- Row 2: Team Members (7 members) -->
            <div class="flex justify-center gap-3 flex-wrap">
                <div class="bg-white dark:bg-slate-800 rounded-xl p-4 border border-gray-200 dark:border-slate-700 shadow-md dark:shadow-none text-center w-28">
                    <div class="w-12 h-12 mx-auto mb-2 bg-gradient-to-br from-teal-400 to-teal-500 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 dark:text-white text-xs mb-1">Eko Nugroho</h3>
                    <p class="text-teal-600 dark:text-teal-400 text-[10px]">Infra Lead</p>
                </div>
                
                <div class="bg-white dark:bg-slate-800 rounded-xl p-4 border border-gray-200 dark:border-slate-700 shadow-md dark:shadow-none text-center w-28">
                    <div class="w-12 h-12 mx-auto mb-2 bg-gradient-to-br from-teal-400 to-teal-500 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 dark:text-white text-xs mb-1">Dian Pratama</h3>
                    <p class="text-teal-600 dark:text-teal-400 text-[10px]">Security Lead</p>
                </div>
                
                <div class="bg-white dark:bg-slate-800 rounded-xl p-4 border border-gray-200 dark:border-slate-700 shadow-md dark:shadow-none text-center w-28">
                    <div class="w-12 h-12 mx-auto mb-2 bg-gradient-to-br from-emerald-100 to-emerald-50 dark:from-slate-700 dark:to-slate-600 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-emerald-400 dark:text-slate-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 dark:text-white text-xs mb-1">Fitri Handayani</h3>
                    <p class="text-emerald-600 dark:text-emerald-400 text-[10px]">Security Analyst</p>
                </div>
                
                <div class="bg-white dark:bg-slate-800 rounded-xl p-4 border border-gray-200 dark:border-slate-700 shadow-md dark:shadow-none text-center w-28">
                    <div class="w-12 h-12 mx-auto mb-2 bg-gradient-to-br from-emerald-100 to-emerald-50 dark:from-slate-700 dark:to-slate-600 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-emerald-400 dark:text-slate-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 dark:text-white text-xs mb-1">Gunawan Setiadi</h3>
                    <p class="text-emerald-600 dark:text-emerald-400 text-[10px]">DBA</p>
                </div>
                
                <div class="bg-white dark:bg-slate-800 rounded-xl p-4 border border-gray-200 dark:border-slate-700 shadow-md dark:shadow-none text-center w-28">
                    <div class="w-12 h-12 mx-auto mb-2 bg-gradient-to-br from-emerald-100 to-emerald-50 dark:from-slate-700 dark:to-slate-600 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-emerald-400 dark:text-slate-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 dark:text-white text-xs mb-1">Indra Lesmana</h3>
                    <p class="text-emerald-600 dark:text-emerald-400 text-[10px]">IT Support</p>
                </div>
                
                <div class="bg-white dark:bg-slate-800 rounded-xl p-4 border border-gray-200 dark:border-slate-700 shadow-md dark:shadow-none text-center w-28">
                    <div class="w-12 h-12 mx-auto mb-2 bg-gradient-to-br from-emerald-100 to-emerald-50 dark:from-slate-700 dark:to-slate-600 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-emerald-400 dark:text-slate-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 dark:text-white text-xs mb-1">Joko Widodo</h3>
                    <p class="text-emerald-600 dark:text-emerald-400 text-[10px]">Cloud Eng</p>
                </div>
                
                <div class="bg-white dark:bg-slate-800 rounded-xl p-4 border border-gray-200 dark:border-slate-700 shadow-md dark:shadow-none text-center w-28">
                    <div class="w-12 h-12 mx-auto mb-2 bg-gradient-to-br from-emerald-100 to-emerald-50 dark:from-slate-700 dark:to-slate-600 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-emerald-400 dark:text-slate-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 dark:text-white text-xs mb-1">Kartika Sari</h3>
                    <p class="text-emerald-600 dark:text-emerald-400 text-[10px]">DevOps</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Join Team CTA -->
<section class="py-16 bg-gradient-to-r from-blue-600 to-blue-800 dark:from-slate-800/50 dark:to-slate-800/50 relative overflow-hidden">
    <!-- Grid pattern -->
    <div class="absolute inset-0 opacity-10">
        <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="join-grid" width="30" height="30" patternUnits="userSpaceOnUse">
                    <path d="M 30 0 L 0 0 0 30" fill="none" stroke="white" stroke-width="0.5"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#join-grid)"/>
        </svg>
    </div>
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-2xl font-bold text-white mb-4">Bergabung dengan Tim Kami?</h2>
        <p class="text-blue-100 dark:text-gray-400 mb-6">Kami selalu mencari talenta terbaik untuk memperkuat tim CSIRT RRI</p>
        <a href="<?= base_url('kontak') ?>" 
           class="inline-flex items-center gap-2 px-6 py-3 bg-white text-blue-700 font-medium rounded-lg hover:bg-blue-50 shadow-lg transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            Hubungi Kami
        </a>
    </div>
</section>
