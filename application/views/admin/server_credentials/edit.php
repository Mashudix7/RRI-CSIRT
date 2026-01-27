<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white"><?= $title ?></h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">Edit data server</p>
        </div>
        <a href="<?= base_url('admin/server_credentials') ?>" class="px-4 py-2 bg-gray-100 dark:bg-slate-700 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-slate-600 transition-colors">
            Kembali
        </a>
    </div>

    <!-- Form -->
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 p-6">
        <?= form_open('admin/server_credentials_update/' . $credential['id'], ['class' => 'space-y-6']) ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- VM Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">VM Name</label>
                    <input type="text" name="vm_name" value="<?= htmlspecialchars($credential['vm_name']) ?>" class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500">
                </div>
                
                <!-- IP Address -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">IP Address</label>
                    <input type="text" name="ip_address" value="<?= htmlspecialchars($credential['ip_address']) ?>" class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Username -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Username</label>
                    <input type="text" name="username" value="<?= htmlspecialchars($credential['username']) ?>" class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Password</label>
                    <input type="text" name="password" value="<?= htmlspecialchars($credential['password']) ?>" class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Domain -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Domain</label>
                    <input type="text" name="domain" value="<?= htmlspecialchars($credential['domain']) ?>" class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Description -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Keterangan</label>
                    <textarea name="description" rows="3" class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500"><?= htmlspecialchars($credential['description']) ?></textarea>
                </div>
            </div>

            <div class="flex justify-end pt-6">
                <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                    Update Data
                </button>
            </div>
        <?= form_close() ?>
    </div>
</div>
