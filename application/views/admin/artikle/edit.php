<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white"><?= $title ?></h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">Edit artikel yang sudah ada</p>
        </div>
        <a href="<?= base_url('admin/articles') ?>" class="px-4 py-2 bg-gray-100 dark:bg-slate-700 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-slate-600 transition-colors">
            Kembali
        </a>
    </div>

    <!-- Form -->
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 p-6">
        <form action="<?= base_url('admin/articles/update/' . $article['id']) ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
            <!-- Title -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Judul Artikel</label>
                <input type="text" name="title" value="<?= $article['title'] ?>" required class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Category -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kategori</label>
                    <select name="category" class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500">
                        <option value="Berita" <?= ($article['category'] == 'Berita') ? 'selected' : '' ?>>Berita</option>
                        <option value="Panduan" <?= ($article['category'] == 'Panduan') ? 'selected' : '' ?>>Panduan</option>
                        <option value="Keamanan" <?= ($article['category'] == 'Keamanan') ? 'selected' : '' ?>>Keamanan</option>
                        <option value="Pengumuman" <?= ($article['category'] == 'Pengumuman') ? 'selected' : '' ?>>Pengumuman</option>
                    </select>
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                    <select name="status" class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500">
                        <option value="published" <?= ($article['status'] == 'published') ? 'selected' : '' ?>>Published</option>
                        <option value="draft" <?= ($article['status'] == 'draft') ? 'selected' : '' ?>>Draft</option>
                    </select>
                </div>
            </div>

            <!-- Content -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Konten</label>
                <textarea name="content" rows="10" class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500"><?= $article['content'] ?></textarea>
            </div>

            <!-- Thumbnail -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Thumbnail Image</label>
                <div class="flex items-start gap-4">
                    <div class="w-32 h-20 bg-gray-200 rounded-lg overflow-hidden flex-shrink-0">
                         <div class="w-full h-full flex items-center justify-center text-gray-500 text-sm">
                            Current Image
                        </div>
                    </div>
                    <div class="flex-1">
                         <input type="file" name="thumbnail" accept="image/*" class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                         <p class="mt-1 text-xs text-gray-500">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-6">
                 <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                    Update Artikel
                </button>
            </div>
        </form>
    </div>
</div>
