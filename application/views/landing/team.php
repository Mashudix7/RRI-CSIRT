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
<section class="py-20 bg-gradient-to-b from-blue-50 to-white dark:from-slate-900 dark:to-slate-900" 
         x-data="{ activeTab: '<?= !empty($grouped_teams) ? slugify(array_key_first($grouped_teams)) : '' ?>' }">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <?php
        // Helper to slugify string
        function slugify($text) {
            return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $text)));
        }
        ?>

        <?php if (empty($grouped_teams)): ?>
            <div class="text-center py-10" data-aos="fade-up">
                <p class="text-gray-500">Belum ada data tim.</p>
            </div>
        <?php else: ?>
            <!-- Tab Buttons -->
            <div class="flex flex-wrap justify-center gap-4 mb-16" data-aos="fade-up">
                <?php foreach ($grouped_teams as $division => $members): ?>
                    <?php $tabId = slugify($division); ?>
                    <button @click="activeTab = '<?= $tabId ?>'" 
                            :class="activeTab === '<?= $tabId ?>' ? 'bg-blue-600 text-white shadow-lg' : 'bg-white dark:bg-slate-800 text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-slate-700 hover:bg-blue-50 dark:hover:bg-slate-700'"
                            class="px-6 py-3 rounded-xl font-semibold transition-all duration-300">
                        <span class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            <?= $division ?>
                        </span>
                    </button>
                <?php endforeach; ?>
            </div>
            
            <!-- Dynamic Content -->
            <?php foreach ($grouped_teams as $division => $members): ?>
                <?php 
                    $tabId = slugify($division); 
                    // Separate Leader (level = leader or first one)
                    $leader = null;
                    $staff = [];
                    foreach ($members as $m) {
                        if (($m['level'] ?? '') === 'leader' && !$leader) {
                            $leader = $m;
                        } else {
                            $staff[] = $m;
                        }
                    }
                    if (!$leader && !empty($members)) {
                        $leader = array_shift($staff);
                    }
                ?>
                <div x-show="activeTab === '<?= $tabId ?>'" 
                     x-transition:enter="transition ease-out duration-300" 
                     x-transition:enter-start="opacity-0 transform translate-y-4" 
                     x-transition:enter-end="opacity-100 transform translate-y-0">
                    
                    <!-- Row 1: Leader -->
                    <?php if ($leader): ?>
                    <div class="flex justify-center mb-0">
                        <div class="bg-white dark:bg-slate-800 rounded-xl p-5 border-2 border-blue-500 dark:border-blue-400 shadow-lg dark:shadow-none text-center w-56 hover-lift" data-aos="zoom-in">
                            <div class="w-20 h-20 mx-auto mb-3 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center overflow-hidden">
                                <?php if (!empty($leader['photo'])): ?>
                                    <img src="<?= base_url($leader['photo']) ?>" class="w-full h-full object-cover">
                                <?php else: ?>
                                    <span class="text-white font-bold text-2xl"><?= substr($leader['name'], 0, 1) ?></span>
                                <?php endif; ?>
                            </div>
                            <span class="inline-block px-2 py-0.5 bg-blue-100 dark:bg-blue-900/50 text-blue-700 dark:text-blue-300 text-xs font-semibold rounded-full mb-2">KEPALA TIM</span>
                            <h3 class="font-bold text-gray-900 dark:text-white mb-1"><?= $leader['name'] ?></h3>
                            <p class="text-blue-600 dark:text-blue-400 text-xs font-medium"><?= $leader['position'] ?? 'Leader' ?></p>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($staff)): ?>
                        <!-- Connector Lines (Visual Only) -->
                        <div class="flex justify-center flex-col items-center">
                            <div class="w-0.5 h-8 bg-blue-300 dark:bg-blue-600"></div>
                            <div class="w-3/4 h-0.5 bg-blue-300 dark:bg-blue-600"></div>
                            <div class="flex justify-between w-3/4">
                                <?php for($i=0; $i<count($staff); $i++): ?>
                                    <div class="relative flex justify-center w-full">
                                        <div class="w-0.5 h-8 bg-blue-300 dark:bg-blue-600"></div>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>

                        <!-- Row 2: Staff -->
                        <div class="flex justify-center gap-4 flex-wrap mt-[-2px]">
                            <?php foreach ($staff as $index => $member): ?>
                            <div class="bg-white dark:bg-slate-800 rounded-xl p-4 border border-gray-200 dark:border-slate-700 shadow-md dark:shadow-none text-center w-32 hover-lift"
                                 data-aos="fade-up" data-aos-delay="<?= $index * 50 ?>">
                                <div class="w-14 h-14 mx-auto mb-2 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-slate-700 dark:to-slate-600 rounded-full flex items-center justify-center overflow-hidden">
                                    <?php if (!empty($member['photo'])): ?>
                                        <img src="<?= base_url($member['photo']) ?>" class="w-full h-full object-cover">
                                    <?php else: ?>
                                        <span class="text-gray-500 font-bold"><?= substr($member['name'], 0, 1) ?></span>
                                    <?php endif; ?>
                                </div>
                                <h3 class="font-semibold text-gray-900 dark:text-white text-xs mb-1 line-clamp-1"><?= $member['name'] ?></h3>
                                <p class="text-gray-500 dark:text-gray-400 text-[10px] line-clamp-1"><?= $member['position'] ?? 'Staff' ?></p>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        
    </div>
</section>

<!-- Join Team CTA -->
<section class="py-16 bg-gradient-to-r from-blue-600 to-blue-800 dark:from-slate-800/50 dark:to-slate-800/50 relative overflow-hidden" data-aos="fade-in">
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
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="zoom-in">
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
