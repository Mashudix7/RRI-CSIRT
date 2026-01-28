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

    
    <!-- Horizontal Category Navigation (Sticky) -->
    <div class="sticky top-[72px] lg:top-[88px] z-10 bg-gray-50/80 dark:bg-slate-900/80 backdrop-blur-md -mx-4 lg:-mx-6 px-4 lg:px-6 py-3 border-b border-gray-200 dark:border-slate-800 mb-8 overflow-x-auto no-scrollbar shadow-sm">
        <nav class="flex items-center gap-2 min-w-max" id="settings-nav">
            <?php 
            $groups = array_keys($settings_grouped);
            foreach($groups as $index => $group): 
                $label = ucfirst($group);
                $activeClass = ($index === 0) ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/20' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-slate-800';
            ?>
            <a href="#group-<?= $group ?>" class="nav-link px-5 py-2 rounded-full text-sm font-semibold transition-all <?= $activeClass ?>" onclick="setActiveNav(this)">
                <?= $label ?>
            </a>
            <?php endforeach; ?>
        </nav>
    </div>

    <form id="settingsForm" action="<?= base_url('admin/settings_update') ?>" method="POST">
        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
        
        <div class="space-y-12">
            <?php foreach($settings_grouped as $group => $items): ?>
            <section id="group-<?= $group ?>" class="scroll-mt-48">
                <div class="flex items-center gap-4 mb-6">
                    <h3 class="text-xl font-extrabold text-gray-900 dark:text-white capitalize tracking-tight flex items-center gap-3">
                         <span class="w-2 h-8 bg-blue-600 rounded-full"></span>
                         <?= $group ?> Settings
                    </h3>
                    <div class="flex-1 h-px bg-gradient-to-r from-gray-200 dark:from-slate-700 to-transparent"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach($items as $item): ?>
                    <div class="bg-white dark:bg-slate-800 p-5 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700 hover:shadow-md transition-all duration-300 group <?= ($item['input_type'] == 'textarea') ? 'md:col-span-2 lg:col-span-3' : '' ?>">
                        <div class="flex items-center justify-between mb-3">
                            <label for="<?= $item['setting_key'] ?>" class="block text-sm font-bold text-gray-700 dark:text-gray-300">
                                <?= ucwords(str_replace('_', ' ', $item['setting_key'])) ?>
                            </label>
                            <span class="px-2 py-0.5 rounded-md text-[9px] font-mono bg-gray-50 dark:bg-slate-900 text-gray-400 dark:text-gray-500 uppercase"><?= $item['setting_key'] ?></span>
                        </div>
                        
                        <?php if ($item['input_type'] == 'textarea'): ?>
                            <textarea name="<?= $item['setting_key'] ?>" id="<?= $item['setting_key'] ?>" rows="4" class="w-full rounded-xl border-gray-100 dark:border-slate-600 bg-gray-50/50 dark:bg-slate-900/50 text-sm text-gray-900 dark:text-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all p-4"><?= $item['setting_value'] ?></textarea>
                        
                        <?php elseif ($item['input_type'] == 'toggle' || $item['input_type'] == 'boolean'): ?>
                            <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-slate-900/50 rounded-xl border border-dashed border-gray-200 dark:border-slate-700">
                                <span class="text-xs text-gray-400 dark:text-gray-500 font-medium">Aktifkan Fitur</span>
                                <div class="flex bg-gray-200 dark:bg-slate-700 p-1 rounded-lg">
                                    <input type="radio" name="<?= $item['setting_key'] ?>" id="<?= $item['setting_key'] ?>_on" value="1" <?= $item['setting_value'] == '1' ? 'checked' : '' ?> class="hidden peer/on">
                                    <label for="<?= $item['setting_key'] ?>_on" class="px-4 py-1.5 text-[10px] font-black rounded-md cursor-pointer transition-all peer-checked/on:bg-emerald-500 peer-checked/on:text-white peer-checked/on:shadow-sm text-gray-500">ON</label>
                                    
                                    <input type="radio" name="<?= $item['setting_key'] ?>" id="<?= $item['setting_key'] ?>_off" value="0" <?= $item['setting_value'] == '0' ? 'checked' : '' ?> class="hidden peer/off">
                                    <label for="<?= $item['setting_key'] ?>_off" class="px-4 py-1.5 text-[10px] font-black rounded-md cursor-pointer transition-all peer-checked/off:bg-rose-500 peer-checked/off:text-white peer-checked/off:shadow-sm text-gray-500">OFF</label>
                                </div>
                            </div>
                        
                        <?php else: ?>
                            <input type="<?= $item['input_type'] ?>" name="<?= $item['setting_key'] ?>" id="<?= $item['setting_key'] ?>" value="<?= $item['setting_value'] ?>" class="w-full rounded-xl border-gray-100 dark:border-slate-600 bg-gray-50/50 dark:bg-slate-900/50 text-sm text-gray-900 dark:text-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all py-3 px-4">
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </section>
            <?php endforeach; ?>
        </div>
    </form>
</div>

<style>
.no-scrollbar::-webkit-scrollbar { display: none; }
.no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<script>
function setActiveNav(element) {
    document.querySelectorAll('.nav-link').forEach(link => {
        link.classList.remove('bg-blue-600', 'text-white', 'shadow-lg', 'shadow-blue-500/20');
        link.classList.add('text-gray-600', 'dark:text-gray-400', 'hover:bg-gray-200', 'dark:hover:bg-slate-800');
    });
    element.classList.remove('text-gray-600', 'dark:text-gray-400', 'hover:bg-gray-200', 'dark:hover:bg-slate-800');
    element.classList.add('bg-blue-600', 'text-white', 'shadow-lg', 'shadow-blue-500/20');
}

window.addEventListener('scroll', () => {
    let current = '';
    const sections = document.querySelectorAll('section');
    sections.forEach(section => {
        const sectionTop = section.offsetTop;
        if (pageYOffset >= sectionTop - 250) {
            current = section.getAttribute('id');
        }
    });

    if (current) {
        document.querySelectorAll('.nav-link').forEach(link => {
            link.classList.remove('bg-blue-600', 'text-white', 'shadow-lg', 'shadow-blue-500/20');
            link.classList.add('text-gray-600', 'dark:text-gray-400', 'hover:bg-gray-200', 'dark:hover:bg-slate-800');
            if (link.getAttribute('href').includes(current)) {
                link.classList.remove('text-gray-600', 'dark:text-gray-400', 'hover:bg-gray-200', 'dark:hover:bg-slate-800');
                link.classList.add('bg-blue-600', 'text-white', 'shadow-lg', 'shadow-blue-500/20');
            }
        });
    }
});
</script>
