<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title . ' | ' : '' ?>Dashboard - CSIRT RRI</title>
    <link rel="icon" type="image/png" href="<?= base_url('assets/img/favicon.png') ?>">
    
    <!-- CRITICAL: Apply dark mode IMMEDIATELY to prevent flash - Default to DARK -->
    <script>
        // Default to dark mode if not set
        if (localStorage.getItem('adminDarkMode') === null) {
            localStorage.setItem('adminDarkMode', 'true');
        }
        if (localStorage.getItem('adminDarkMode') === 'true') {
            document.documentElement.classList.add('dark');
        }
    </script>
    
    <!-- Alpine.js for interactions -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* Custom scrollbar - Light mode */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        
        /* Custom scrollbar - Dark mode */
        .dark ::-webkit-scrollbar-track { background: #1e293b; }
        .dark ::-webkit-scrollbar-thumb { background: #475569; }
        .dark ::-webkit-scrollbar-thumb:hover { background: #64748b; }
        
        /* Sidebar scrollbar */
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); }
        
        /* Status badges */
        .badge-critical { background: #fef2f2; color: #b91c1c; }
        .badge-high { background: #fff7ed; color: #c2410c; }
        .badge-medium { background: #fefce8; color: #a16207; }
        .badge-low { background: #f0fdf4; color: #15803d; }
        
        .dark .badge-critical { background: rgba(239, 68, 68, 0.2); color: #fca5a5; }
        .dark .badge-high { background: rgba(249, 115, 22, 0.2); color: #fdba74; }
        .dark .badge-medium { background: rgba(234, 179, 8, 0.2); color: #fde047; }
        .dark .badge-low { background: rgba(34, 197, 94, 0.2); color: #86efac; }
        .dark .badge-low { background: rgba(34, 197, 94, 0.2); color: #86efac; }

        /* Page Transition & AOS Defaults */
        body { opacity: 0; transition: opacity 0.15s ease-out; }
        body.loaded { opacity: 1; }

        /* Modern Sidebar Animations - Smart Animate Style */
        @keyframes slideInLeft {
            0% { opacity: 0; transform: translateX(-12px) scale(0.95); }
            100% { opacity: 1; transform: translateX(0) scale(1); }
        }

        .nav-item {
            position: relative;
            /* Smooth 'Spring' easing for organic feel */
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            transform-origin: center left;
        }

        .nav-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 20%;
            bottom: 20%;
            width: 4px;
            background: #60a5fa; /* blue-400 */
            border-top-right-radius: 4px;
            border-bottom-right-radius: 4px;
            
            /* Animate properties */
            opacity: 0;
            transform: scaleY(0.5) translateX(-4px);
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        /* Active State */
        .nav-item-active {
            background: linear-gradient(90deg, rgba(37,99,235,0.12) 0%, rgba(37,99,235,0.02) 100%);
            color: #60a5fa !important; /* blue-400 */
            animation: slideInLeft 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        }
        
        .nav-item-active::before {
            opacity: 1;
            transform: scaleY(1) translateX(0);
        }

        /* Hover State - Smooth float */
        .nav-item:hover:not(.nav-item-active) {
            background: rgba(255, 255, 255, 0.04);
            transform: translateX(6px);
            color: #f8fafc; /* slate-50 */
        }

        /* Press Effect - Tactile Feedback */
        .nav-item:active {
            transform: scale(0.97) translateX(4px);
            transition-duration: 0.1s; /* Fast response for click */
        }

        /* Reusable Generic Button Press Effect */
        .btn-press-anim {
            transition: transform 0.2s cubic-bezier(0.34, 1.56, 0.64, 1); /* Springy return */
        }
        .btn-press-anim:active {
            transform: scale(0.96);
            transition-duration: 0.1s; /* Snappy press */
        }
    </style>
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<body x-data="{ adminDarkMode: localStorage.getItem('adminDarkMode') === 'true', sidebarOpen: false }" 
      x-init="$watch('adminDarkMode', val => { localStorage.setItem('adminDarkMode', val); document.documentElement.classList.toggle('dark', val) })"
      class="font-sans antialiased bg-gray-50 dark:bg-slate-900 text-gray-900 dark:text-white transition-colors duration-300"
      onload="document.body.classList.add('loaded')">

<!-- Main Layout Container -->
<div class="h-screen flex overflow-hidden">
