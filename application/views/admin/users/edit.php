<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white"><?= $title ?></h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">Edit data pengguna</p>
        </div>
        <a href="<?= base_url('admin/users') ?>" class="px-4 py-2 bg-gray-100 dark:bg-slate-700 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-slate-600 transition-colors">
            Kembali
        </a>
    </div>

    <!-- Form -->
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 p-6">
        <?= form_open_multipart('admin/user_update/' . $user_edit['id'], ['class' => 'space-y-6']) ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Username (Readonly) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Username</label>
                    <input type="text" value="<?= $user_edit['username'] ?>" disabled class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg bg-gray-100 dark:bg-slate-700/50 text-gray-500 cursor-not-allowed">
                </div>
                
                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label>
                    <input type="email" name="email" value="<?= $user_edit['email'] ?>" required class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Password</label>
                    <input type="password" name="password" class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500">
                    <p class="mt-1 text-xs text-gray-500">Biarkan kosong jika tidak ingin mengubah password.</p>
                </div>

                <!-- Role -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Role</label>
                    <select name="role" class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500">
                        <option value="admin" <?= ($user_edit['role'] == 'admin') ? 'selected' : '' ?>>Admin</option>
                        <option value="management" <?= ($user_edit['role'] == 'management') ? 'selected' : '' ?>>Management</option>
                        <option value="auditor" <?= ($user_edit['role'] == 'auditor') ? 'selected' : '' ?>>Auditor</option>
                    </select>
                </div>

                <!-- Avatar Upload -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Foto Profil</label>
                    <div class="flex items-center gap-4">
                        <div id="preview-container" class="w-20 h-20 rounded-full overflow-hidden border border-gray-200 dark:border-slate-700">
                            <!-- Display existing avatar or default -->
                            <?php $avatar_url = isset($user_edit['avatar']) && $user_edit['avatar'] ? base_url('uploads/avatars/' . $user_edit['avatar']) : base_url('assets/img/default_avatar.png'); ?>
                            <img id="preview" src="<?= $avatar_url ?>" alt="Preview" class="w-full h-full object-cover" onerror="this.src='https://ui-avatars.com/api/?name=<?= $user_edit['username'] ?>'" loading="lazy">
                        </div>
                        <label class="cursor-pointer">
                            <span class="px-4 py-2 bg-white dark:bg-slate-700 border border-gray-300 dark:border-slate-600 rounded-lg text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-600 transition-colors">
                                Ganti Foto
                            </span>
                            <input type="file" name="avatar" class="hidden" accept="image/*" onchange="previewImage(this)">
                        </label>
                        <span class="text-xs text-gray-500 dark:text-gray-400">JPG, PNG, WEBP (Max 2MB)</span>
                    </div>
                </div>
            </div>

            <script>
                function previewImage(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            document.getElementById('preview').src = e.target.result;
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }
            </script>

            <div class="flex justify-end pt-6">
                <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                    Update Pengguna
                </button>
            </div>
        <?= form_close() ?>
    </div>
</div>
