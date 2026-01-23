<main class="ml-64 p-8 pt-20" data-aos="fade-up">
    <!-- Header -->
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Pengaturan Sistem</h1>
            <p class="text-gray-500 dark:text-gray-400 mt-1">Kelola konfigurasi aplikasi global.</p>
        </div>
        <div>
             <button type="submit" form="settingsForm" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl font-medium transition-all shadow-lg hover:shadow-blue-500/30 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                Simpan Perubahan
            </button>
        </div>
    </div>

    <!-- Alert Messages -->
    <?php if ($this->session->flashdata('success')): ?>
    <div class="mb-6 p-4 bg-green-50 dark:bg-green-500/10 border border-green-200 dark:border-green-500/20 rounded-xl flex items-center gap-3 text-green-700 dark:text-green-400" role="alert">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <span><?= $this->session->flashdata('success') ?></span>
    </div>
    <?php endif; ?>

    <form id="settingsForm" action="<?= base_url('admin/settings_update') ?>" method="POST">
        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Sidebar Navigation for Groups (Sticky) -->
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 p-4 sticky top-24">
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-4 px-2">Kategori</h3>
                    <nav class="space-y-1">
                        <?php 
                        $groups = array_keys($settings_grouped);
                        foreach($groups as $group): 
                            $label = ucfirst($group);
                            $icon = 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z';
                            
                            if ($group == 'general') $icon = 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6';
                            if ($group == 'security') $icon = 'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z';
                            if ($group == 'social') $icon = 'M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z';
                        ?>
                        <a href="#group-<?= $group ?>" class="flex items-center gap-3 px-3 py-2 text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-slate-700/50 rounded-lg transition-colors group">
                            <svg class="w-5 h-5 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?= $icon ?>"/></svg>
                            <span class="font-medium"><?= $label ?></span>
                        </a>
                        <?php endforeach; ?>
                    </nav>
                </div>
            </div>

            <!-- Forms -->
            <div class="lg:col-span-2 space-y-8">
                <?php foreach($settings_grouped as $group => $items): ?>
                <div id="group-<?= $group ?>" class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 dark:border-slate-700 bg-gray-50 dark:bg-slate-700/30">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white capitalize"><?= $group ?> Settings</h3>
                    </div>
                    <div class="p-6 space-y-6">
                        <?php foreach($items as $item): ?>
                        <div class="form-group">
                            <label for="<?= $item['setting_key'] ?>" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                <?= ucwords(str_replace('_', ' ', $item['setting_key'])) ?>
                            </label>
                            
                            <?php if ($item['input_type'] == 'textarea'): ?>
                                <textarea name="<?= $item['setting_key'] ?>" id="<?= $item['setting_key'] ?>" rows="3" class="w-full rounded-lg border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500"><?= $item['setting_value'] ?></textarea>
                            
                            <?php elseif ($item['input_type'] == 'toggle' || $item['input_type'] == 'boolean'): ?>
                                <select name="<?= $item['setting_key'] ?>" id="<?= $item['setting_key'] ?>" class="w-full rounded-lg border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="1" <?= $item['setting_value'] == '1' ? 'selected' : '' ?>>Enabled</option>
                                    <option value="0" <?= $item['setting_value'] == '0' ? 'selected' : '' ?>>Disabled</option>
                                </select>
                            
                            <?php else: ?>
                                <input type="<?= $item['input_type'] ?>" name="<?= $item['setting_key'] ?>" id="<?= $item['setting_key'] ?>" value="<?= $item['setting_value'] ?>" class="w-full rounded-lg border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <?php endif; ?>
                            
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Key: <?= $item['setting_key'] ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </form>
</main>
