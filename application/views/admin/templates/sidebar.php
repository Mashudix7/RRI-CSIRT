<!-- =====================================================
     Admin Sidebar - Navy Gradient Theme
     ===================================================== -->
<aside id="sidebar" class="fixed lg:static inset-y-0 left-0 z-40 w-64 bg-gradient-to-b from-slate-900 via-slate-900 to-slate-950 text-white transform -translate-x-full lg:translate-x-0 transition-transform duration-300">
    <div class="flex flex-col h-full">
        <!-- Logo -->
        <div class="h-16 flex items-center gap-3 px-5 border-b border-white/10">
            <div class="w-9 h-9 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center shadow-lg">
                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                </svg>
            </div>
            <div>
                <span class="text-lg font-bold text-white">CSIRT</span>
                <span class="text-lg font-bold text-blue-400"> RRI</span>
            </div>
        </div>
        
        <!-- Navigation -->
        <nav class="flex-1 px-3 py-4 overflow-y-auto sidebar-scroll">
            <!-- Main Menu -->
            <div class="mb-6">
                <p class="px-3 mb-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">Menu Utama</p>
                <ul class="space-y-1">
                    <li>
                        <a href="<?= base_url('dashboard') ?>" 
                           class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors <?= (!isset($page) || $page === 'dashboard') ? 'bg-blue-600/20 text-blue-400 border-l-2 border-blue-400' : 'text-slate-300 hover:bg-white/5' ?>">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                            </svg>
                            <span>Dashboard</span>
                        </a>
                    </li>
                </ul>
            </div>
            

            
            <!-- Content Management -->
            <div class="mb-6">
                <p class="px-3 mb-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">Konten</p>
                <ul class="space-y-1">
                    <li>
                        <a href="<?= base_url('admin/articles') ?>" 
                           class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors <?= (isset($page) && $page === 'articles') ? 'bg-blue-600/20 text-blue-400 border-l-2 border-blue-400' : 'text-slate-300 hover:bg-white/5' ?>">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                            <span>Manajemen Artikel</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('admin/teams') ?>" 
                           class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors <?= (isset($page) && $page === 'teams') ? 'bg-blue-600/20 text-blue-400 border-l-2 border-blue-400' : 'text-slate-300 hover:bg-white/5' ?>">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            <span>Manajemen Tim</span>
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Infrastructure -->
            <div class="mb-6">
                <p class="px-3 mb-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">Infrastruktur</p>
                <ul class="space-y-1">
                    <!-- Network -->
                    <li x-data="{ open: <?= (isset($page) && strpos($page, 'network_') === 0 || in_array($page, ['ip_management', 'vpn_management'])) ? 'true' : 'false' ?> }">
                        <button @click="open = !open" 
                                class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg transition-colors <?= (isset($page) && (strpos($page, 'network_') === 0 || in_array($page, ['ip_management', 'vpn_management']))) ? 'bg-blue-600/20 text-blue-400 border-l-2 border-blue-400' : 'text-slate-300 hover:bg-white/5' ?>">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                </svg>
                                <span>Network</span>
                            </div>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <ul x-show="open" x-transition class="pl-11 pr-3 mt-1 space-y-1">
                            <!-- Manajemen IP Dropdown -->
                            <li x-data="{ openIP: <?= (in_array($page, ['ip_management', 'ip_private', 'vpn_management'])) ? 'true' : 'false' ?> }">
                                <button @click="openIP = !openIP" 
                                        class="w-full flex items-center justify-between px-3 py-2 rounded-lg text-sm transition-colors <?= (in_array($page, ['ip_management', 'ip_private', 'vpn_management'])) ? 'text-blue-400 bg-white/10' : 'text-slate-300 hover:text-white hover:bg-white/10' ?>">
                                    <span class="flex items-center gap-2">
                                        Manajemen IP
                                    </span>
                                    <svg class="w-3 h-3 transition-transform duration-200" :class="{'rotate-180': openIP}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                                <ul x-show="openIP" x-transition class="pl-4 mt-1 space-y-1 border-l border-white/10 ml-3">
                                    <li>
                                        <a href="<?= base_url('admin/ip-management') ?>" 
                                           class="block px-3 py-2 rounded-lg text-sm transition-colors <?= (isset($page) && $page === 'ip_management') ? 'text-blue-400' : 'text-slate-400 hover:text-slate-200' ?>">
                                            IP Public
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('admin/ip-private') ?>" 
                                           class="block px-3 py-2 rounded-lg text-sm transition-colors <?= (isset($page) && $page === 'ip_private') ? 'text-blue-400' : 'text-slate-400 hover:text-slate-200' ?>">
                                            IP Private
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('admin/vpn-management') ?>" 
                                           class="block px-3 py-2 rounded-lg text-sm transition-colors <?= (isset($page) && $page === 'vpn_management') ? 'text-blue-400' : 'text-slate-400 hover:text-slate-200' ?>">
                                            IP VPN
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/network-traffic-mrtg') ?>" 
                                   class="block px-3 py-2 rounded-lg text-sm transition-colors <?= (isset($page) && $page === 'network_traffic_mrtg') ? 'text-blue-400 bg-white/10' : 'text-slate-300 hover:text-white hover:bg-white/10' ?>">
                                    Traffic MRTG
                                </a>
                            </li>
                             <li>
                                <a href="<?= base_url('admin/network-traffic-ap') ?>" 
                                   class="block px-3 py-2 rounded-lg text-sm transition-colors <?= (isset($page) && $page === 'network_traffic_ap') ? 'text-blue-400 bg-white/10' : 'text-slate-300 hover:text-white hover:bg-white/10' ?>">
                                    Traffic Access Point
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Data Center -->
                    <li x-data="{ open: <?= (isset($page) && strpos($page, 'datacenter_') === 0) ? 'true' : 'false' ?> }">
                        <button @click="open = !open" 
                                class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg transition-colors <?= (isset($page) && strpos($page, 'datacenter_') === 0) ? 'bg-blue-600/20 text-blue-400 border-l-2 border-blue-400' : 'text-slate-300 hover:bg-white/5' ?>">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"/>
                                </svg>
                                <span>Data Center</span>
                            </div>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <ul x-show="open" x-transition class="pl-11 pr-3 mt-1 space-y-1">
                            <li>
                                <a href="<?= base_url('admin/datacenter-resource-server') ?>" 
                                   class="block px-3 py-2 rounded-lg text-sm transition-colors <?= (isset($page) && $page === 'datacenter_resource_server') ? 'text-blue-400 bg-white/10' : 'text-slate-300 hover:text-white hover:bg-white/10' ?>">
                                    Resource Server
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/datacenter-traffic-vm') ?>" 
                                   class="block px-3 py-2 rounded-lg text-sm transition-colors <?= (isset($page) && $page === 'datacenter_traffic_vm') ? 'text-blue-400 bg-white/10' : 'text-slate-300 hover:text-white hover:bg-white/10' ?>">
                                    Traffic Virtual Machine
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Security -->
                    <li x-data="{ open: <?= (isset($page) && strpos($page, 'security_') === 0) ? 'true' : 'false' ?> }">
                        <button @click="open = !open" 
                                class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg transition-colors <?= (isset($page) && strpos($page, 'security_') === 0) ? 'bg-blue-600/20 text-blue-400 border-l-2 border-blue-400' : 'text-slate-300 hover:bg-white/5' ?>">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                                <span>Security</span>
                            </div>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <ul x-show="open" x-transition class="pl-11 pr-3 mt-1 space-y-1">
                            <li>
                                <a href="<?= base_url('admin/security-fortigate') ?>" 
                                   class="block px-3 py-2 rounded-lg text-sm transition-colors <?= (isset($page) && $page === 'security_fortigate') ? 'text-blue-400 bg-white/10' : 'text-slate-300 hover:text-white hover:bg-white/10' ?>">
                                    Fortigate
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/security-safeline') ?>" 
                                   class="block px-3 py-2 rounded-lg text-sm transition-colors <?= (isset($page) && $page === 'security_safeline') ? 'text-blue-400 bg-white/10' : 'text-slate-300 hover:text-white hover:bg-white/10' ?>">
                                    Safe Line
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Satellite -->
                    <li x-data="{ open: <?= (isset($page) && strpos($page, 'satellite_') === 0) ? 'true' : 'false' ?> }">
                        <button @click="open = !open" 
                                class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg transition-colors <?= (isset($page) && strpos($page, 'satellite_') === 0) ? 'bg-blue-600/20 text-blue-400 border-l-2 border-blue-400' : 'text-slate-300 hover:bg-white/5' ?>">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                                <span>Satelite</span>
                            </div>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <ul x-show="open" x-transition class="pl-11 pr-3 mt-1 space-y-1">
                            <li>
                                <a href="<?= base_url('admin/satellite-starlink') ?>" 
                                   class="block px-3 py-2 rounded-lg text-sm transition-colors <?= (isset($page) && $page === 'satellite_starlink') ? 'text-blue-400 bg-white/10' : 'text-slate-300 hover:text-white hover:bg-white/10' ?>">
                                    Starlink
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/satellite-broadcast-audio') ?>" 
                                   class="block px-3 py-2 rounded-lg text-sm transition-colors <?= (isset($page) && $page === 'satellite_broadcast_audio') ? 'text-blue-400 bg-white/10' : 'text-slate-300 hover:text-white hover:bg-white/10' ?>">
                                    Broadcast Audio
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            
            <!-- Reports -->
            <div class="mb-6">
                <p class="px-3 mb-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">Laporan</p>
                <ul class="space-y-1">
                    <li>
                        <a href="<?= base_url('admin/reports') ?>" 
                           class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors <?= (isset($page) && $page === 'reports') ? 'bg-blue-600/20 text-blue-400 border-l-2 border-blue-400' : 'text-slate-300 hover:bg-white/5' ?>">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span>Laporan</span>
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Administration (Admin Only) -->
            <?php if (isset($user['role']) && $user['role'] === 'admin'): ?>
            <div class="mb-6">
                <p class="px-3 mb-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">Administrasi</p>
                <ul class="space-y-1">
                    <li>
                        <a href="<?= base_url('admin/users') ?>" 
                           class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors <?= (isset($page) && $page === 'users') ? 'bg-blue-600/20 text-blue-400 border-l-2 border-blue-400' : 'text-slate-300 hover:bg-white/5' ?>">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m9 5.197v-1"/>
                            </svg>
                            <span>Pengguna</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('admin/audit') ?>" 
                           class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors <?= (isset($page) && $page === 'audit') ? 'bg-blue-600/20 text-blue-400 border-l-2 border-blue-400' : 'text-slate-300 hover:bg-white/5' ?>">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                            </svg>
                            <span>Audit Log</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('admin/settings') ?>" 
                           class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors <?= (isset($page) && $page === 'settings') ? 'bg-blue-600/20 text-blue-400 border-l-2 border-blue-400' : 'text-slate-300 hover:bg-white/5' ?>">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>Pengaturan</span>
                        </a>
                    </li>
                </ul>
            </div>
            <?php endif; ?>
        </nav>
        
        <!-- User Info -->
        <div class="p-4 border-t border-white/10 bg-slate-950/50">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                    <span class="text-white font-semibold"><?= strtoupper(substr($user['username'] ?? 'U', 0, 1)) ?></span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-white truncate"><?= $user['username'] ?? 'User' ?></p>
                    <p class="text-xs text-slate-400 truncate"><?= $user['role_name'] ?? ucfirst($user['role'] ?? 'Pengguna') ?></p>
                </div>
            </div>
            <a href="<?= base_url('auth/logout') ?>" 
               class="flex items-center gap-2 w-full px-3 py-2 text-slate-400 hover:text-white hover:bg-white/5 rounded-lg transition-colors text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Keluar
            </a>
        </div>
    </div>
</aside>

<!-- Sidebar Overlay (Mobile) -->
<div id="sidebarOverlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/50 z-30 hidden lg:hidden"></div>

<!-- Main Content Wrapper -->
<div class="flex-1 flex flex-col min-w-0 h-screen overflow-hidden">
    <!-- Top Header - Fixed at top -->
    <header class="h-16 flex-shrink-0 bg-white dark:bg-slate-800 border-b border-gray-200 dark:border-slate-700 flex items-center justify-between px-4 lg:px-6 transition-colors duration-300">
        <!-- Mobile Menu Toggle -->
        <button onclick="toggleSidebar()" class="lg:hidden p-2 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700 rounded-lg transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
        
        <!-- Page Title -->
        <h1 class="text-lg font-semibold text-gray-900 dark:text-white hidden lg:block"><?= $title ?? 'Dashboard' ?></h1>
        
        <!-- Right Actions -->
        <div class="flex items-center gap-3">
            <!-- View Site -->
            <a href="<?= base_url() ?>" target="_blank" 
               class="hidden sm:flex items-center gap-2 px-3 py-2 text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700 rounded-lg transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                Lihat Situs
            </a>
            
            <!-- Theme Toggle Button -->
            <button @click="adminDarkMode = !adminDarkMode" 
                    class="p-2.5 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700 transition-colors"
                    title="Toggle Theme">
                <!-- Sun Icon (shown in dark mode) -->
                <svg x-show="adminDarkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                <!-- Moon Icon (shown in light mode) -->
                <svg x-show="!adminDarkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                </svg>
            </button>
            
            <!-- Notifications -->
            <button class="p-2 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700 rounded-lg relative transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
                <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full"></span>
            </button>
        </div>
    </header>
    
    <!-- Page Content - Scrollable independently -->
    <main class="flex-1 p-4 lg:p-6 overflow-y-auto bg-gray-50 dark:bg-slate-900 transition-colors duration-300">
