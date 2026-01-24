<div data-aos="fade-up">
    <!-- Header - Sticky with negative margins to counteract sidebar main padding -->
    <div class="sticky -top-4 lg:-top-6 z-20 bg-gray-50/95 dark:bg-slate-900/95 backdrop-blur-sm -mx-4 lg:-mx-6 -mt-4 lg:-mt-6 px-4 lg:px-6 py-4 lg:py-6 border-b border-gray-200 dark:border-slate-800 mb-6 flex flex-col md:flex-row items-start md:items-center justify-between gap-4 shadow-sm">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Pengaturan Sistem</h1>
            <p class="text-gray-500 dark:text-gray-400 mt-1">Kelola konfigurasi aplikasi global.</p>
        </div>
        <div>
             <button type="submit" form="settingsForm" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl font-medium transition-all shadow-lg hover:shadow-blue-500/30 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                <span>Simpan Perubahan</span>
            </button>
        </div>
    </div>

    
    <form id="settingsForm" action="<?= base_url('admin/settings_update') ?>" method="POST">
        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Sidebar Navigation for Groups (Sticky relative to content) -->
            <div class="lg:col-span-3">
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 p-2 sticky top-[88px] transition-all duration-300">
                    <h3 class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-2 px-4 py-2">Kategori</h3>
                    <nav class="space-y-1" id="settings-nav">
                        <?php 
                        $groups = array_keys($settings_grouped);
                        foreach($groups as $index => $group): 
                            $label = ucfirst($group);
                            // Icons mapping
                            $icon = 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z';
                            if ($group == 'general') $icon = 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6';
                            if ($group == 'security') $icon = 'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z';
                            if ($group == 'social') $icon = 'M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z';
                            
                            $activeClass = ($index === 0) ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-slate-700/50';
                        ?>
                        <a href="#group-<?= $group ?>" class="nav-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all group <?= $activeClass ?>" onclick="setActiveNav(this)">
                            <svg class="w-5 h-5 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?= $icon ?>"/></svg>
                            <span class="font-medium"><?= $label ?></span>
                            <svg class="w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                        <?php endforeach; ?>
                    </nav>
                </div>
            </div>

            <!-- Forms -->
            <div class="lg:col-span-9 space-y-8">
                <?php foreach($settings_grouped as $group => $items): ?>
                <div id="group-<?= $group ?>" class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 overflow-hidden scroll-mt-32 transition-all duration-300 hover:shadow-md">
                    <div class="px-8 py-6 border-b border-gray-100 dark:border-slate-700 flex items-center gap-3">
                         <div class="w-1 h-6 bg-blue-500 rounded-full"></div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white capitalize"><?= $group ?> Settings</h3>
                    </div>
                    <div class="p-8 space-y-8">
                        <?php foreach($items as $item): ?>
                        <div class="form-group group">
                            <label for="<?= $item['setting_key'] ?>" class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-2 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-400 transition-colors">
                                <?= ucwords(str_replace('_', ' ', $item['setting_key'])) ?>
                            </label>
                            
                            <?php if ($item['input_type'] == 'textarea'): ?>
                                <textarea name="<?= $item['setting_key'] ?>" id="<?= $item['setting_key'] ?>" rows="4" class="w-full rounded-xl border-gray-200 dark:border-slate-600 bg-gray-50/50 dark:bg-slate-900/50 text-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all p-4"><?= $item['setting_value'] ?></textarea>
                            
                            <?php elseif ($item['input_type'] == 'toggle' || $item['input_type'] == 'boolean'): ?>
                                <div class="relative">
                                    <select name="<?= $item['setting_key'] ?>" id="<?= $item['setting_key'] ?>" class="w-full appearance-none rounded-xl border-gray-200 dark:border-slate-600 bg-gray-50/50 dark:bg-slate-900/50 text-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all py-3 px-4 pr-10 cursor-pointer">
                                        <option value="1" <?= $item['setting_value'] == '1' ? 'selected' : '' ?>>Enabled</option>
                                        <option value="0" <?= $item['setting_value'] == '0' ? 'selected' : '' ?>>Disabled</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                    </div>
                                </div>
                            
                            <?php else: ?>
                                <input type="<?= $item['input_type'] ?>" name="<?= $item['setting_key'] ?>" id="<?= $item['setting_key'] ?>" value="<?= $item['setting_value'] ?>" class="w-full rounded-xl border-gray-200 dark:border-slate-600 bg-gray-50/50 dark:bg-slate-900/50 text-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all py-3 px-4">
                            <?php endif; ?>
                            
                            <p class="mt-2 text-xs text-gray-400 dark:text-gray-500 font-mono bg-gray-100 dark:bg-slate-700/50 inline-block px-2 py-1 rounded">Key: <?= $item['setting_key'] ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </form>
</div>

<script>
function setActiveNav(element) {
    // Reset all links
    document.querySelectorAll('.nav-link').forEach(link => {
        link.classList.remove('bg-blue-50', 'text-blue-600', 'dark:bg-blue-900/20', 'dark:text-blue-400');
        link.classList.add('text-gray-600', 'dark:text-gray-400', 'hover:bg-gray-50', 'dark:hover:bg-slate-700/50');
    });
    
    // Set active
    element.classList.remove('text-gray-600', 'dark:text-gray-400', 'hover:bg-gray-50', 'dark:hover:bg-slate-700/50');
    element.classList.add('bg-blue-50', 'text-blue-600', 'dark:bg-blue-900/20', 'dark:text-blue-400');
}
</script>
