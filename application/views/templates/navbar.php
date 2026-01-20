<!-- =====================================================
     Navigation Bar - Underline Animation Style
     ===================================================== -->
<nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 bg-white/90 dark:bg-slate-900/95 backdrop-blur-md border-b border-gray-100 dark:border-slate-800 shadow-md dark:shadow-lg dark:shadow-black/20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <a href="<?= base_url() ?>" class="flex items-center gap-3 group">
                <div class="w-10 h-10 btn-gradient rounded-lg flex items-center justify-center 
                            group-hover:scale-110 transition-transform duration-300 shadow-md">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                    </svg>
                </div>
                <div>
                    <span class="text-xl font-bold gradient-text">CSIRT</span>
                    <span class="text-xl font-bold text-gray-700 dark:text-white"> RRI</span>
                </div>
            </a>
            
            <!-- Desktop Navigation with Underline Animation -->
            <div class="hidden md:flex items-center gap-8">
                <a href="<?= base_url() ?>" 
                   class="nav-link text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-medium transition-colors <?= $this->uri->segment(1) == '' ? 'active' : '' ?>">
                    Beranda
                </a>
                <a href="<?= base_url('artikel') ?>" 
                   class="nav-link text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-medium transition-colors <?= $this->uri->segment(1) == 'artikel' ? 'active' : '' ?>">
                    Artikel
                </a>
                <a href="<?= base_url('tentang') ?>" 
                   class="nav-link text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-medium transition-colors <?= $this->uri->segment(1) == 'tentang' ? 'active' : '' ?>">
                    Tentang
                </a>
                <a href="<?= base_url('tim') ?>" 
                   class="nav-link text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-medium transition-colors <?= $this->uri->segment(1) == 'tim' ? 'active' : '' ?>">
                    Tim
                </a>
                <a href="<?= base_url('kontak') ?>" 
                   class="nav-link text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-medium transition-colors <?= $this->uri->segment(1) == 'kontak' ? 'active' : '' ?>">
                    Kontak
                </a>
            </div>
            
            <div class="hidden md:flex items-center gap-3">
                <!-- Theme Toggle -->
                <button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)" 
                        class="p-2.5 rounded-full bg-gray-100 dark:bg-slate-800 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-slate-700 transition-colors">
                    <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                </button>
                
                <!-- Login Button -->
                <a href="<?= base_url('auth/login') ?>" 
                   class="px-5 py-2.5 btn-gradient text-white font-semibold rounded-lg 
                          shadow-md hover:shadow-lg transition-all duration-300">
                    Login
                </a>
            </div>
            
            <!-- Mobile Menu Button -->
            <div class="flex items-center gap-2 md:hidden">
                <button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)" 
                        class="p-2 rounded-full bg-gray-100 dark:bg-slate-800 text-gray-600 dark:text-gray-300">
                    <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                </button>
                
                <button onclick="toggleMobileMenu()" class="text-gray-700 dark:text-white p-2 hover:bg-gray-100 dark:hover:bg-slate-800 rounded-lg transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden md:hidden pb-4">
            <div class="bg-white dark:bg-slate-800 rounded-xl p-4 space-y-1 shadow-lg border border-gray-100 dark:border-slate-700">
                <a href="<?= base_url() ?>" class="block px-4 py-3 text-gray-700 dark:text-white hover:bg-blue-50 dark:hover:bg-slate-700 rounded-lg transition-colors">
                    Beranda
                </a>
                <a href="<?= base_url('artikel') ?>" class="block px-4 py-3 text-gray-700 dark:text-white hover:bg-blue-50 dark:hover:bg-slate-700 rounded-lg transition-colors">
                    Artikel
                </a>
                <a href="<?= base_url('tentang') ?>" class="block px-4 py-3 text-gray-700 dark:text-white hover:bg-blue-50 dark:hover:bg-slate-700 rounded-lg transition-colors">
                    Tentang
                </a>
                <a href="<?= base_url('tim') ?>" class="block px-4 py-3 text-gray-700 dark:text-white hover:bg-blue-50 dark:hover:bg-slate-700 rounded-lg transition-colors">
                    Tim
                </a>
                <a href="<?= base_url('kontak') ?>" class="block px-4 py-3 text-gray-700 dark:text-white hover:bg-blue-50 dark:hover:bg-slate-700 rounded-lg transition-colors">
                    Kontak
                </a>
                <a href="<?= base_url('auth/login') ?>" 
                   class="block px-4 py-3 btn-gradient text-white font-semibold rounded-lg text-center mt-2">
                    Login
                </a>
            </div>
        </div>
    </div>
</nav>
