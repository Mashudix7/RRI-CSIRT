<!-- =====================================================
     Dashboard Main View - Enhanced with Color Accents & Dark Mode
     ===================================================== -->

<!-- Welcome Banner -->
<div class="mb-8 p-6 rounded-2xl bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="dash-grid" width="30" height="30" patternUnits="userSpaceOnUse">
                    <path d="M 30 0 L 0 0 0 30" fill="none" stroke="white" stroke-width="0.5"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#dash-grid)"/>
        </svg>
    </div>
    <div class="relative z-10">
        <h1 class="text-2xl font-bold mb-2">Selamat Datang, <?= $user['username'] ?? 'Admin' ?>!</h1>
        <p class="text-blue-100">Pantau dan kelola insiden keamanan siber dari dashboard ini.</p>
    </div>
    <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/10 rounded-full"></div>
    <div class="absolute -right-5 -bottom-5 w-24 h-24 bg-white/10 rounded-full"></div>
</div>

<!-- Stats Cards with Gradient Accents -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Incidents -->
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm dark:shadow-none p-6 border border-gray-100 dark:border-slate-700 hover:shadow-md dark:hover:border-slate-600 transition-all relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 to-blue-600"></div>
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Total Insiden</p>
                <p class="text-3xl font-bold text-gray-900 dark:text-white"><?= $stats['total_incidents'] ?? 0 ?></p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
        </div>
        <p class="text-xs text-gray-400 dark:text-gray-500 mt-3">Sepanjang waktu</p>
    </div>
    
    <!-- Active Incidents -->
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm dark:shadow-none p-6 border border-gray-100 dark:border-slate-700 hover:shadow-md dark:hover:border-slate-600 transition-all relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-red-500 to-red-600"></div>
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Insiden Aktif</p>
                <p class="text-3xl font-bold text-red-600 dark:text-red-400"><?= $stats['active_incidents'] ?? 0 ?></p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center shadow-lg">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
        </div>
        <p class="text-xs text-gray-400 dark:text-gray-500 mt-3">Perlu penanganan</p>
    </div>
    
    <!-- Resolved Today -->
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm dark:shadow-none p-6 border border-gray-100 dark:border-slate-700 hover:shadow-md dark:hover:border-slate-600 transition-all relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-green-500 to-emerald-500"></div>
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Selesai Hari Ini</p>
                <p class="text-3xl font-bold text-green-600 dark:text-green-400"><?= $stats['resolved_today'] ?? 0 ?></p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl flex items-center justify-center shadow-lg">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
        </div>
        <p class="text-xs text-gray-400 dark:text-gray-500 mt-3"><?= date('d M Y') ?></p>
    </div>
    
    <!-- Avg Response Time -->
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm dark:shadow-none p-6 border border-gray-100 dark:border-slate-700 hover:shadow-md dark:hover:border-slate-600 transition-all relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-purple-500 to-violet-500"></div>
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Rata-rata Respons</p>
                <p class="text-3xl font-bold text-purple-600 dark:text-purple-400"><?= $stats['avg_response_time'] ?? '-' ?></p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-violet-500 rounded-xl flex items-center justify-center shadow-lg">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <p class="text-xs text-gray-400 dark:text-gray-500 mt-3">Waktu respons pertama</p>
    </div>
</div>

<!-- Main Content Grid -->
<div class="grid lg:grid-cols-3 gap-6">
    <!-- Recent Incidents (Left - 2 columns) -->
    <div class="lg:col-span-2 bg-white dark:bg-slate-800 rounded-xl shadow-sm dark:shadow-none border border-gray-100 dark:border-slate-700">
        <div class="px-6 py-4 border-b border-gray-100 dark:border-slate-700 flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Insiden Terbaru</h2>
            <a href="<?= base_url('incidents') ?>" class="text-sm text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-medium">
                Lihat Semua →
            </a>
        </div>
        
        <div class="divide-y divide-gray-100 dark:divide-slate-700">
            <?php if (!empty($recent_incidents)): ?>
                <?php foreach ($recent_incidents as $incident): ?>
                    <div class="px-6 py-4 hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors">
                        <div class="flex items-start gap-4">
                            <!-- Severity Indicator -->
                            <div class="mt-1">
                                <?php
                                $severity_colors = [
                                    'critical' => 'bg-red-500',
                                    'high' => 'bg-orange-500',
                                    'medium' => 'bg-yellow-500',
                                    'low' => 'bg-green-500'
                                ];
                                $color = $severity_colors[$incident['severity']] ?? 'bg-gray-400';
                                ?>
                                <div class="w-3 h-3 <?= $color ?> rounded-full"></div>
                            </div>
                            
                            <!-- Content -->
                            <div class="flex-1 min-w-0">
                                <a href="<?= base_url('incidents/' . $incident['id']) ?>" 
                                   class="text-gray-900 dark:text-white font-medium hover:text-blue-600 dark:hover:text-blue-400 transition-colors block truncate">
                                    <?= htmlspecialchars($incident['title']) ?>
                                </a>
                                <div class="flex items-center gap-3 mt-1 text-sm text-gray-500 dark:text-gray-400">
                                    <span>Dilaporkan oleh <?= htmlspecialchars($incident['reporter']) ?></span>
                                    <span>•</span>
                                    <span><?= date('d M Y, H:i', strtotime($incident['created_at'])) ?></span>
                                </div>
                            </div>
                            
                            <!-- Status Badge -->
                            <div>
                                <?php
                                $status_styles = [
                                    'reported' => 'bg-amber-100 text-amber-700 dark:bg-amber-500/20 dark:text-amber-300',
                                    'validated' => 'bg-blue-100 text-blue-700 dark:bg-blue-500/20 dark:text-blue-300',
                                    'in_progress' => 'bg-purple-100 text-purple-700 dark:bg-purple-500/20 dark:text-purple-300',
                                    'mitigated' => 'bg-teal-100 text-teal-700 dark:bg-teal-500/20 dark:text-teal-300',
                                    'recovered' => 'bg-green-100 text-green-700 dark:bg-green-500/20 dark:text-green-300',
                                    'closed' => 'bg-gray-100 text-gray-700 dark:bg-gray-500/20 dark:text-gray-300'
                                ];
                                $status_labels = [
                                    'reported' => 'Dilaporkan',
                                    'validated' => 'Divalidasi',
                                    'in_progress' => 'Ditangani',
                                    'mitigated' => 'Dimitigasi',
                                    'recovered' => 'Dipulihkan',
                                    'closed' => 'Ditutup'
                                ];
                                $style = $status_styles[$incident['status']] ?? 'bg-gray-100 text-gray-700 dark:bg-gray-500/20 dark:text-gray-300';
                                $status_label = $status_labels[$incident['status']] ?? $incident['status'];
                                ?>
                                <span class="inline-flex px-2.5 py-1 text-xs font-medium rounded-full <?= $style ?>">
                                    <?= $status_label ?>
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                    <svg class="w-12 h-12 mx-auto text-gray-300 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <p>Belum ada insiden yang dilaporkan.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Right Sidebar (1 column) -->
    <div class="space-y-6">
        <!-- Severity Distribution -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm dark:shadow-none border border-gray-100 dark:border-slate-700 p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Distribusi Severity</h3>
            
            <div class="space-y-4">
                <?php
                $severity_config = [
                    'critical' => ['label' => 'Critical', 'gradient' => 'from-red-500 to-red-600', 'bg' => 'bg-red-100 dark:bg-red-500/20'],
                    'high' => ['label' => 'High', 'gradient' => 'from-orange-500 to-orange-600', 'bg' => 'bg-orange-100 dark:bg-orange-500/20'],
                    'medium' => ['label' => 'Medium', 'gradient' => 'from-yellow-500 to-yellow-600', 'bg' => 'bg-yellow-100 dark:bg-yellow-500/20'],
                    'low' => ['label' => 'Low', 'gradient' => 'from-green-500 to-green-600', 'bg' => 'bg-green-100 dark:bg-green-500/20']
                ];
                $total = array_sum($severity_stats ?? []);
                ?>
                
                <?php foreach ($severity_config as $key => $config): ?>
                    <?php 
                    $count = $severity_stats[$key] ?? 0;
                    $percentage = $total > 0 ? round(($count / $total) * 100) : 0;
                    ?>
                    <div>
                        <div class="flex items-center justify-between text-sm mb-1">
                            <span class="font-medium text-gray-700 dark:text-gray-300"><?= $config['label'] ?></span>
                            <span class="text-gray-500 dark:text-gray-400"><?= $count ?></span>
                        </div>
                        <div class="w-full h-2.5 <?= $config['bg'] ?> rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r <?= $config['gradient'] ?> rounded-full transition-all duration-500" 
                                 style="width: <?= $percentage ?>%"></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm dark:shadow-none border border-gray-100 dark:border-slate-700 p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Aksi Cepat</h3>
            
            <div class="space-y-3">
                <a href="<?= base_url('incidents/create') ?>" 
                   class="flex items-center gap-3 px-4 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-medium rounded-xl hover:from-blue-700 hover:to-blue-800 shadow-md transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Lapor Insiden Baru</span>
                </a>
                
                <a href="<?= base_url('incidents?status=in_progress') ?>" 
                   class="flex items-center gap-3 px-4 py-3 bg-purple-50 dark:bg-purple-500/20 text-purple-700 dark:text-purple-300 font-medium rounded-xl hover:bg-purple-100 dark:hover:bg-purple-500/30 border border-purple-100 dark:border-purple-500/30 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    <span>Insiden Dalam Proses</span>
                </a>
                
                <a href="<?= base_url('admin/reports') ?>" 
                   class="flex items-center gap-3 px-4 py-3 bg-gray-50 dark:bg-slate-700 text-gray-700 dark:text-gray-300 font-medium rounded-xl hover:bg-gray-100 dark:hover:bg-slate-600 border border-gray-100 dark:border-slate-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span>Lihat Laporan</span>
                </a>
            </div>
        </div>
        
        <!-- System Status -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm dark:shadow-none border border-gray-100 dark:border-slate-700 p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Status Sistem</h3>
            
            <div class="space-y-3">
                <div class="flex items-center justify-between p-3 bg-green-50 dark:bg-green-500/10 rounded-lg">
                    <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">Monitoring</span>
                    <span class="flex items-center gap-1.5 text-sm text-green-600 dark:text-green-400 font-medium">
                        <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                        Aktif
                    </span>
                </div>
                <div class="flex items-center justify-between p-3 bg-green-50 dark:bg-green-500/10 rounded-lg">
                    <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">Database</span>
                    <span class="flex items-center gap-1.5 text-sm text-green-600 dark:text-green-400 font-medium">
                        <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                        Online
                    </span>
                </div>
                <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-slate-700 rounded-lg">
                    <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">Backup Terakhir</span>
                    <span class="text-sm text-gray-500 dark:text-gray-400"><?= date('d M, H:i') ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
