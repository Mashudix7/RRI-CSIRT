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

<!-- Team Chart Section -->
<section class="py-20 bg-gradient-to-b from-blue-50 to-white dark:from-slate-900 dark:to-slate-950 relative overflow-hidden">
    <!-- Decorative background elements -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-blue-100/50 dark:bg-blue-600/5 rounded-full blur-3xl -mr-48 -mt-24"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-purple-100/50 dark:bg-purple-600/5 rounded-full blur-3xl -ml-48 -mb-24"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <?php if (!$director && !$main_head && empty($grouped_teams)): ?>
            <div class="text-center py-20" data-aos="fade-up">
                <div class="w-20 h-20 mx-auto bg-gray-100 dark:bg-slate-800 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4.354l1.1 3.393h3.566l-2.885 2.096 1.1 3.393L12 11.14l-2.885 2.096 1.1-3.393-2.885-2.096h3.565L12 4.354z"></path></svg>
                </div>
                <p class="text-gray-500 font-medium">Data tim belum tersedia.</p>
            </div>
        <?php else: ?>

            <!-- Level 1: Kepala Direktur -->
            <div class="flex justify-center mb-16 relative" data-aos="zoom-in">
                <?php if ($director): ?>
                    <div class="relative group">
                        <!-- Connecting Line Down -->
                        <div class="absolute left-1/2 -bottom-16 w-0.5 h-16 bg-gray-300 dark:bg-slate-600 hidden lg:block"></div>
                        
                        <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 border border-gray-200 dark:border-slate-700 shadow-xl text-center w-64 md:w-72 transform transition-all duration-500 hover:scale-105">
                            <div class="w-28 h-28 mx-auto mb-4 p-1 rounded-full border-4 border-white dark:border-slate-700 shadow-sm overflow-hidden">
                                <?php if (!empty($director['photo'])): ?>
                                    <img src="<?= base_url(strpos($director['photo'], 'assets') !== false ? $director['photo'] : 'assets/uploads/' . $director['photo']) ?>" class="w-full h-full object-cover">
                                <?php else: ?>
                                    <div class="w-full h-full bg-amber-600 flex items-center justify-center text-white text-4xl font-black">
                                        <?= substr($director['name'], 0, 1) ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white leading-tight mb-1"><?= htmlspecialchars($director['name']) ?></h3>
                            <p class="text-amber-600 dark:text-amber-500 text-sm font-medium"><?= htmlspecialchars($director['position']) ?></p>
                            <p class="text-[10px] text-gray-400 mt-1 uppercase tracking-widest">Pimpinan Tertinggi</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Level 2 & 3: Divisions Layout -->
            <div class="relative">
                <!-- Horizontal Connecting Line (Desktop) -->
                <div class="absolute top-0 left-1/4 right-1/4 h-0.5 bg-blue-300 dark:bg-blue-700 hidden lg:block"></div>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-8">
                    
                    <?php 
                    $divisions = ['Tim Teknologi Media Baru', 'Tim IT'];
                    foreach ($divisions as $divIdx => $divName): 
                        $members = $grouped_teams[$divName] ?? [];
                        $leader = null;
                        $staff = [];
                        foreach ($members as $m) {
                            if (($m['role'] ?? '') === 'leader') $leader = $m;
                            else $staff[] = $m;
                        }
                    ?>
                    <!-- Division Column -->
                    <div class="relative space-y-12">
                        <!-- Vertical line from horizontal line to leader -->
                        <div class="absolute top-0 left-1/2 -ml-[1px] w-0.5 h-12 bg-blue-300 dark:bg-blue-700 hidden lg:block"></div>

                        <!-- Division Leader -->
                        <div class="flex justify-center pt-8 md:pt-12" data-aos="fade-up" data-aos-delay="<?= $divIdx * 100 ?>">
                            <?php if ($leader): ?>
                            <div class="bg-white dark:bg-slate-800 rounded-2xl p-5 border-2 border-blue-400 dark:border-blue-900/50 shadow-xl text-center w-56 transform transition-all hover:scale-105 relative">
                                <div class="absolute -top-3 left-1/2 -translate-x-1/2 px-3 py-0.5 bg-blue-100 dark:bg-blue-500/20 text-blue-700 dark:text-blue-300 text-[9px] font-black uppercase rounded-full border border-blue-200 dark:border-blue-800/50">
                                    Ketua <?= ($divIdx == 0) ? 'TMB' : 'IT' ?>
                                </div>
                                <div class="w-16 h-16 mx-auto mb-3 rounded-full overflow-hidden ring-4 ring-blue-50 dark:ring-blue-900/20">
                                    <?php if (!empty($leader['photo'])): ?>
                                        <img src="<?= base_url(strpos($leader['photo'], 'assets') !== false ? $leader['photo'] : 'assets/uploads/' . $leader['photo']) ?>" class="w-full h-full object-cover">
                                    <?php else: ?>
                                        <div class="w-full h-full bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center text-blue-600 dark:text-blue-400 text-xl font-bold">
                                            <?= substr($leader['name'], 0, 1) ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <h4 class="font-bold text-gray-900 dark:text-white text-sm leading-tight"><?= htmlspecialchars($leader['name']) ?></h4>
                                <p class="text-[10px] text-gray-500 dark:text-gray-400 font-medium mt-1"><?= htmlspecialchars($leader['position']) ?></p>
                            </div>
                            <?php else: ?>
                            <div class="w-48 h-20 border-2 border-dashed border-gray-200 dark:border-gray-800 rounded-2xl flex items-center justify-center text-gray-400 text-xs italic">
                                Ketua Belum Ditentukan
                            </div>
                            <?php endif; ?>
                        </div>

                        <!-- Division Staff Grid -->
                        <div class="bg-blue-50/30 dark:bg-slate-800/30 rounded-3xl p-6 md:p-8" data-aos="fade-up" data-aos-delay="<?= $divIdx * 150 + 100 ?>">
                            <div class="text-center mb-6">
                                <h5 class="text-xs font-black text-gray-400 dark:text-gray-500 uppercase tracking-[0.2em]">Anggota Tim <?= ($divIdx == 0) ? 'TMB' : 'IT' ?></h5>
                                <div class="w-8 h-1 bg-blue-500/20 mx-auto mt-2 rounded-full"></div>
                            </div>

                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                                <?php if (empty($staff)): ?>
                                    <div class="col-span-full py-4 text-center text-xs text-gray-400 italic">Belum ada anggota</div>
                                <?php else: ?>
                                    <?php foreach ($staff as $sIdx => $s): ?>
                                    <div class="text-center group">
                                        <div class="w-12 h-12 md:w-16 md:h-16 mx-auto mb-2 rounded-2xl overflow-hidden ring-2 ring-transparent group-hover:ring-blue-400 dark:group-hover:ring-blue-500 transition-all shadow-sm">
                                            <?php if (!empty($s['photo'])): ?>
                                                <img src="<?= base_url(strpos($s['photo'], 'assets') !== false ? $s['photo'] : 'assets/uploads/' . $s['photo']) ?>" class="w-full h-full object-cover">
                                            <?php else: ?>
                                                <div class="w-full h-full bg-gray-100 dark:bg-slate-700 flex items-center justify-center text-gray-400 dark:text-gray-500 text-lg font-bold">
                                                    <?= substr($s['name'], 0, 1) ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <h6 class="text-[10px] md:text-xs font-bold text-gray-800 dark:text-gray-200 line-clamp-1 h-3.5"><?= htmlspecialchars($s['name']) ?></h6>
                                        <p class="text-[8px] md:text-[9px] text-gray-500 dark:text-gray-500 line-clamp-1"><?= htmlspecialchars($s['position']) ?></p>
                                    </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>

                </div>
            </div>

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
