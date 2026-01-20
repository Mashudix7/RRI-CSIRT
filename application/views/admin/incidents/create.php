<!-- =====================================================
     Create Incident Form
     Form untuk melaporkan insiden baru
     ===================================================== -->

<div class="max-w-4xl mx-auto">
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm dark:shadow-none border border-gray-100 dark:border-slate-700 overflow-hidden">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-rri-blue to-blue-800">
            <h2 class="text-lg font-semibold text-white">Formulir Pelaporan Insiden</h2>
            <p class="text-white/70 text-sm mt-1">Isi detail insiden dengan lengkap untuk penanganan yang lebih cepat.</p>
        </div>
        
        <!-- Form -->
        <form action="<?= base_url('incidents/store') ?>" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            <!-- CSRF Token -->
            <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
            
            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Judul Insiden <span class="text-red-500">*</span>
                </label>
                <input type="text" id="title" name="title" required
                       class="w-full px-4 py-3 border border-gray-200 dark:border-slate-600 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 bg-white dark:bg-slate-900 text-gray-900 dark:text-white"
                       placeholder="Contoh: Percobaan akses tidak sah ke server mail">
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Berikan judul singkat yang menggambarkan insiden.</p>
            </div>
            
            <!-- Category & Severity Row -->
            <div class="grid md:grid-cols-2 gap-6">
                <!-- Category -->
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <select id="category" name="category" required
                            class="w-full px-4 py-3 border border-gray-200 dark:border-slate-600 rounded-lg focus:outline-none focus:border-blue-500 bg-white dark:bg-slate-900 text-gray-900 dark:text-white">
                        <option value="">Pilih kategori...</option>
                        <?php foreach ($category_options as $value => $label): ?>
                            <option value="<?= $value ?>"><?= $label ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <!-- Severity -->
                <div>
                    <label for="severity" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Tingkat Keparahan <span class="text-red-500">*</span>
                    </label>
                    <select id="severity" name="severity" required
                            class="w-full px-4 py-3 border border-gray-200 dark:border-slate-600 rounded-lg focus:outline-none focus:border-blue-500 bg-white dark:bg-slate-900 text-gray-900 dark:text-white">
                        <option value="">Pilih severity...</option>
                        <?php foreach ($severity_options as $value => $label): ?>
                            <option value="<?= $value ?>"><?= $label ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            
            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Deskripsi Insiden <span class="text-red-500">*</span>
                </label>
                <textarea id="description" name="description" rows="5" required
                          class="w-full px-4 py-3 border border-gray-200 dark:border-slate-600 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 resize-none bg-white dark:bg-slate-900 text-gray-900 dark:text-white"
                          placeholder="Jelaskan detail insiden: apa yang terjadi, kapan terdeteksi, bagaimana terdeteksi..."></textarea>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Sertakan informasi sebanyak mungkin untuk membantu analisis.</p>
            </div>
            
            <!-- Affected Systems -->
            <div>
                <label for="affected_systems" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Sistem yang Terdampak
                </label>
                <input type="text" id="affected_systems" name="affected_systems"
                       class="w-full px-4 py-3 border border-gray-200 dark:border-slate-600 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 bg-white dark:bg-slate-900 text-gray-900 dark:text-white"
                       placeholder="Contoh: mail.rri.co.id, server-db-01">
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Pisahkan dengan koma jika lebih dari satu sistem.</p>
            </div>
            
            <!-- Detection Time -->
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label for="detection_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Tanggal Terdeteksi
                    </label>
                    <input type="date" id="detection_date" name="detection_date" value="<?= date('Y-m-d') ?>"
                           class="w-full px-4 py-3 border border-gray-200 dark:border-slate-600 rounded-lg focus:outline-none focus:border-blue-500 bg-white dark:bg-slate-900 text-gray-900 dark:text-white">
                </div>
                <div>
                    <label for="detection_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Waktu Terdeteksi
                    </label>
                    <input type="time" id="detection_time" name="detection_time" value="<?= date('H:i') ?>"
                           class="w-full px-4 py-3 border border-gray-200 dark:border-slate-600 rounded-lg focus:outline-none focus:border-blue-500 bg-white dark:bg-slate-900 text-gray-900 dark:text-white">
                </div>
            </div>
            
            <!-- Initial Assessment -->
            <div>
                <label for="initial_assessment" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Penilaian Awal
                </label>
                <textarea id="initial_assessment" name="initial_assessment" rows="3"
                          class="w-full px-4 py-3 border border-gray-200 dark:border-slate-600 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 resize-none bg-white dark:bg-slate-900 text-gray-900 dark:text-white"
                          placeholder="Dugaan penyebab atau tipe serangan berdasarkan observasi awal..."></textarea>
            </div>
            
            <!-- File Attachment -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Bukti Pendukung
                </label>
                <div class="border-2 border-dashed border-gray-200 dark:border-slate-600 rounded-lg p-6 text-center hover:border-blue-400 dark:hover:border-blue-400 transition-colors bg-white dark:bg-slate-900">
                    <svg class="w-10 h-10 mx-auto text-gray-400 dark:text-gray-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                    </svg>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Drag & drop file atau klik untuk upload</p>
                    <p class="text-xs text-gray-400 dark:text-gray-500">Screenshot, log file, atau dokumen pendukung (max 10MB)</p>
                    <input type="file" name="attachments[]" multiple 
                           class="mt-4 text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 dark:file:bg-blue-500/20 file:text-blue-700 dark:file:text-blue-400 hover:file:bg-blue-100 dark:hover:file:bg-blue-500/30">
                </div>
                <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Format: jpg, png, pdf, txt, log, zip. Maksimal 5 file.</p>
            </div>
            
            <!-- Contact Info -->
            <div class="bg-gray-50 dark:bg-slate-700/50 rounded-lg p-4">
                <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Informasi Pelapor</h3>
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label for="contact_name" class="block text-xs text-gray-500 dark:text-gray-400 mb-1">Nama</label>
                        <input type="text" id="contact_name" name="contact_name" 
                               value="<?= $user['username'] ?? '' ?>" readonly
                               class="w-full px-3 py-2 bg-gray-100 dark:bg-slate-800 border border-gray-200 dark:border-slate-600 rounded-lg text-gray-600 dark:text-gray-400 text-sm">
                    </div>
                    <div>
                        <label for="contact_phone" class="block text-xs text-gray-500 dark:text-gray-400 mb-1">Nomor Telepon (opsional)</label>
                        <input type="tel" id="contact_phone" name="contact_phone"
                               class="w-full px-3 py-2 border border-gray-200 dark:border-slate-600 rounded-lg text-sm focus:outline-none focus:border-blue-500 bg-white dark:bg-slate-900 text-gray-900 dark:text-white"
                               placeholder="08xxxxxxxxxx">
                    </div>
                </div>
            </div>
            
            <!-- Submit Buttons -->
            <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100 dark:border-slate-700">
                <a href="<?= base_url('incidents') ?>" 
                   class="px-6 py-3 text-gray-600 dark:text-gray-400 font-medium hover:text-gray-800 dark:hover:text-gray-200 transition-colors">
                    Batal
                </a>
                <button type="submit" 
                        class="px-8 py-3 bg-gradient-to-r from-rri-gold to-yellow-500 text-rri-navy font-semibold rounded-lg 
                               hover:shadow-lg transition-all duration-200 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                    <span>Kirim Laporan</span>
                </button>
            </div>
        </form>
    </div>
</div>
