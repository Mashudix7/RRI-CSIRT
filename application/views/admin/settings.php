<div x-data="{ activeGroup: '<?= array_keys($settings_grouped)[0] ?? 'general' ?>' }" class="min-h-screen pb-20">
    <!-- Header Section -->
    <div class="mb-8" data-aos="fade-down">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                    Pengaturan Sistem
                </h1>
                <p class="text-slate-500 dark:text-slate-400 mt-1 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                    Konfigurasi global dan parameter aplikasi
                </p>
            </div>
            <div class="flex items-center gap-3">
                <?php if ($this->session->userdata('role') === 'admin'): ?>
                <button type="submit" form="settingsForm" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl font-semibold transition-all shadow-lg shadow-blue-500/25 hover:shadow-blue-500/40 flex items-center gap-2 active:scale-95">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                    <span>Simpan Perubahan</span>
                </button>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Main Settings Layout -->
    <div class="flex flex-col lg:flex-row gap-8 items-start">
        
        <!-- Left Navigation Sidebar (Sticky) -->
        <aside class="w-full lg:w-72 flex-shrink-0 lg:sticky lg:top-24 space-y-1" data-aos="fade-right">
            <?php 
            $groups = array_keys($settings_grouped);
            foreach($groups as $group): 
                $label = ucfirst($group);
                $icon = 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z'; // Default Gear
                
                if (strtolower($group) === 'general') $icon = 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6';
                if (strtolower($group) === 'security') $icon = 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z';
                if (strtolower($group) === 'social') $icon = 'M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1';
                if (strtolower($group) === 'peraturan' || strtolower($group) === 'rules') $icon = 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z';
            ?>
            <button 
                @click="activeGroup = '<?= $group ?>'; document.getElementById('group-<?= $group ?>').scrollIntoView({behavior: 'smooth', block: 'start'})"
                :class="activeGroup === '<?= $group ?>' ? 'bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 border-blue-600 dark:border-blue-400' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 border-transparent'"
                class="w-full flex items-center gap-3 px-4 py-3 rounded-xl border-l-4 text-sm font-semibold transition-all group"
            >
                <svg class="w-5 h-5 flex-shrink-0 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?= $icon ?>"/></svg>
                <span><?= $label ?></span>
                <svg x-show="activeGroup === '<?= $group ?>'" class="ml-auto w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </button>
            <?php endforeach; ?>
        </aside>

        <!-- Settings Form Area -->
        <div class="flex-1 w-full" data-aos="fade-up">
            <?php $isDisabled = ($this->session->userdata('role') === 'auditor') ? 'disabled' : ''; ?>
            <form id="settingsForm" action="<?= base_url('admin/settings_update') ?>" method="POST">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                
                <div class="space-y-16">
                    <?php foreach($settings_grouped as $group => $items): 
                        $isPeraturan = (strtolower($group) === 'peraturan' || strtolower($group) === 'rules');
                    ?>
                    <section id="group-<?= $group ?>" class="scroll-mt-32 group/section">
                        <!-- Group Header -->
                        <div class="flex items-end justify-between mb-8">
                            <div>
                                <h3 class="text-2xl font-bold text-slate-900 dark:text-white capitalize flex items-center gap-3">
                                    <?= $group ?>
                                    <span class="px-2 py-0.5 rounded-lg bg-blue-100 dark:bg-blue-900/30 text-[10px] text-blue-600 dark:text-blue-400 uppercase font-bold tracking-widest"><?= count($items) ?> items</span>
                                </h3>
                                <div class="w-12 h-1 bg-blue-600 rounded-full mt-2 transition-all group-hover/section:w-24"></div>
                            </div>
                        </div>

                        <?php if ($isPeraturan): ?>
                            <!-- Special Professional List Layout for 'Peraturan' -->
                            <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl dark:shadow-none border border-slate-200 dark:border-slate-700 overflow-hidden">
                                <div class="divide-y divide-slate-100 dark:divide-slate-700/50">
                                    <?php foreach($items as $index => $item): ?>
                                    <div class="p-6 lg:p-8 hover:bg-slate-50/50 dark:hover:bg-slate-900/30 transition-colors">
                                        <div class="flex flex-col md:flex-row gap-6">
                                            <div class="w-12 h-12 flex-shrink-0 bg-slate-900 dark:bg-white text-white dark:text-slate-900 rounded-2xl flex items-center justify-center font-black text-lg shadow-lg">
                                                <?= str_pad($index + 1, 2, '0', STR_PAD_LEFT) ?>
                                            </div>
                                            <div class="flex-1 space-y-4">
                                                <div class="flex items-center justify-between">
                                                    <label for="<?= $item['setting_key'] ?>" class="text-lg font-bold text-slate-900 dark:text-white leading-tight">
                                                        <?= ucwords(str_replace(['_', 'rules', 'peraturan'], [' ', '', ''], $item['setting_key'])) ?>
                                                    </label>
                                                    <span class="text-[10px] font-mono text-slate-400 dark:text-slate-500 uppercase tracking-tighter"><?= $item['setting_key'] ?></span>
                                                </div>

                                                <?php if($item['input_type'] === 'textarea'): ?>
                                                    <div class="relative group/field">
                                                        <textarea <?= $isDisabled ?> name="<?= $item['setting_key'] ?>" id="<?= $item['setting_key'] ?>" rows="6" 
                                                                  class="w-full bg-slate-50 dark:bg-slate-950/50 border-slate-200 dark:border-slate-700 rounded-2xl p-5 text-slate-700 dark:text-slate-300 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all font-medium leading-relaxed"
                                                                  placeholder="Masukkan konten <?= $item['setting_key'] ?>..."><?= $item['setting_value'] ?></textarea>
                                                        <div class="absolute bottom-4 right-4 text-[10px] text-slate-400 font-bold uppercase pointer-events-none opacity-0 group-hover/field:opacity-100 transition-opacity">Editable Area</div>
                                                    </div>
                                                <?php else: ?>
                                                    <input <?= $isDisabled ?> type="<?= $item['input_type'] ?>" name="<?= $item['setting_key'] ?>" id="<?= $item['setting_key'] ?>" value="<?= $item['setting_value'] ?>" 
                                                           class="w-full bg-slate-50 dark:bg-slate-950/50 border-slate-200 dark:border-slate-700 rounded-2xl px-6 py-4 text-slate-800 dark:text-slate-200 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all font-semibold">
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <!-- Standard Premium Grid Layout for Other Settings -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <?php foreach($items as $item): 
                                    $colSpan = ($item['input_type'] == 'textarea') ? 'md:col-span-2' : '';
                                ?>
                                <div class="group/card relative bg-white dark:bg-slate-800 p-6 rounded-3xl shadow-sm hover:shadow-xl dark:shadow-none border border-slate-100 dark:border-slate-700 transition-all duration-300 <?= $colSpan ?>">
                                    <div class="flex flex-col h-full gap-4">
                                        <div class="flex items-center justify-between">
                                            <label for="<?= $item['setting_key'] ?>" class="text-sm font-bold text-slate-700 dark:text-slate-300 tracking-tight">
                                                <?= ucwords(str_replace('_', ' ', $item['setting_key'])) ?>
                                            </label>
                                            <div class="flex items-center gap-2">
                                                <span class="px-2 py-0.5 rounded text-[8px] font-mono bg-slate-100 dark:bg-slate-900 text-slate-400 dark:text-slate-500 border border-slate-200/50 dark:border-slate-700/50 uppercase italic"><?= $item['setting_key'] ?></span>
                                            </div>
                                        </div>

                                        <div class="flex-1">
                                            <?php if ($item['input_type'] == 'textarea'): ?>
                                                <textarea <?= $isDisabled ?> name="<?= $item['setting_key'] ?>" id="<?= $item['setting_key'] ?>" rows="4" 
                                                          class="w-full bg-slate-50 dark:bg-slate-950/30 border-slate-200 dark:border-slate-700 rounded-2xl p-4 text-sm text-slate-700 dark:text-slate-300 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all leading-relaxed"><?= $item['setting_value'] ?></textarea>
                                            
                                            <?php elseif ($item['input_type'] == 'toggle' || $item['input_type'] == 'boolean'): ?>
                                                <div class="flex items-center justify-between p-4 bg-slate-50 dark:bg-slate-900 rounded-2xl border border-dashed border-slate-200 dark:border-slate-700">
                                                    <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">Status Fitur</span>
                                                    <div class="flex items-center gap-1 p-1 bg-slate-200 dark:bg-slate-800 rounded-xl overflow-hidden shadow-inner">
                                                        <input <?= $isDisabled ?> type="radio" name="<?= $item['setting_key'] ?>" id="<?= $item['setting_key'] ?>_on" value="1" <?= $item['setting_value'] == '1' ? 'checked' : '' ?> class="hidden peer/on">
                                                        <label for="<?= $item['setting_key'] ?>_on" class="px-4 py-2 text-[10px] font-black rounded-lg cursor-pointer transition-all peer-checked/on:bg-emerald-500 peer-checked/on:text-white peer-checked/on:shadow-lg text-slate-500 whitespace-nowrap">ENABLE</label>
                                                        
                                                        <input <?= $isDisabled ?> type="radio" name="<?= $item['setting_key'] ?>" id="<?= $item['setting_key'] ?>_off" value="0" <?= $item['setting_value'] == '0' ? 'checked' : '' ?> class="hidden peer/off">
                                                        <label for="<?= $item['setting_key'] ?>_off" class="px-4 py-2 text-[10px] font-black rounded-lg cursor-pointer transition-all peer-checked/off:bg-rose-500 peer-checked/off:text-white peer-checked/off:shadow-lg text-slate-500 whitespace-nowrap">DISABLE</label>
                                                    </div>
                                                </div>
                                            
                                            <?php else: ?>
                                                <div class="relative group">
                                                    <input <?= $isDisabled ?> type="<?= $item['input_type'] ?>" name="<?= $item['setting_key'] ?>" id="<?= $item['setting_key'] ?>" value="<?= $item['setting_value'] ?>" 
                                                           class="w-full bg-slate-50 dark:bg-slate-950/30 border-slate-200 dark:border-slate-700 rounded-2xl pl-12 pr-4 py-3.5 text-sm text-slate-800 dark:text-slate-200 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all font-semibold italic">
                                                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </section>
                    <?php endforeach; ?>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Custom Scrollbar for the main content area */
::-webkit-scrollbar {
    width: 6px;
}
::-webkit-scrollbar-track {
    background: transparent;
}
::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 10px;
}
::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}

[x-cloak] { display: none !important; }

/* Smooth Scroll */
html {
    scroll-behavior: smooth;
}

/* Animations */
@keyframes slideIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.animate-card {
    animation: slideIn 0.3s ease-out forwards;
}
</style>

<script>
window.addEventListener('scroll', () => {
    let current = '';
    const sections = document.querySelectorAll('section');
    const scrollPos = window.scrollY || document.documentElement.scrollTop;

    sections.forEach(section => {
        const sectionTop = section.offsetTop;
        const sectionHeight = section.offsetHeight;
        if (scrollPos >= sectionTop - 150) {
            current = section.getAttribute('id').replace('group-', '');
        }
    });

    if (current) {
        window.dispatchEvent(new CustomEvent('update-active-group', { detail: current }));
    }
});

// Sync Alpine state with scroll
document.addEventListener('update-active-group', (e) => {
    const alpineEl = document.querySelector('[x-data]');
    if (alpineEl && alpineEl.__x) {
        alpineEl.__x.$data.activeGroup = e.detail;
    }
});
</script>
