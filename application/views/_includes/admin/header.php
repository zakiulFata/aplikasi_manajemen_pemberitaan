<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?> | TIM4 NEWS Admin</title>

    <!-- Favicons -->
    <link href="<?= base_url() ?>assets/images/logo/favicon.png" rel="icon">
    <link href="<?= base_url() ?>assets/profile/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        },
                        secondary: {
                            500: '#8b5cf6',
                            600: '#7c3aed',
                            700: '#6d28d9',
                        },
                        dark: {
                            800: '#1e293b',
                            900: '#0f172a',
                        }
                    },
                    boxShadow: {
                        'glow': '0 0 15px rgba(59, 130, 246, 0.3)',
                    }
                }
            }
        }
    </script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Datatables -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <!-- Summernote -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/summernote/summernote-bs4.min.css">
    <!-- Datepicker -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/gijgo/css/gijgo.min.css">
    <!-- jQuery -->
    <script src="<?= base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
    
    <style>
        [x-cloak] { display: none !important; }
        .sidebar-collapse {
            width: 5rem;
        }
        .sidebar-collapse .sidebar-text,
        .sidebar-collapse .brand-text,
        .sidebar-collapse .user-info,
        .sidebar-collapse .nav-header {
            opacity: 0;
            width: 0;
            height: 0;
            overflow: hidden;
            position: absolute;
        }
        .nav-item.active {
            position: relative;
        }
        .nav-item.active:after {
            content: '';
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 60%;
            background-color: #0ea5e9;
            border-radius: 3px 0 0 3px;
        }
        .dropdown-menu {
            transition: all 0.2s ease-out;
        }
    </style>
</head>

<body class="h-full bg-gray-50 dark:bg-gray-900" 
      x-data="{ 
          sidebarCollapsed: false, 
          darkMode: localStorage.getItem('mode') === 'dark',
          openDropdown: null 
      }" 
      x-init="$watch('darkMode', value => { 
          localStorage.setItem('mode', value ? 'dark' : 'light'); 
          document.documentElement.classList.toggle('dark', value); 
      })" 
      :class="{ 'dark': darkMode }">
    
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="bg-gradient-to-b from-primary-800 to-primary-900 text-white shadow-lg transition-all duration-300 ease-in-out" 
               :class="sidebarCollapsed ? 'w-20' : 'w-64'">
            <!-- Brand Logo -->
            <div class="flex items-center justify-between p-4 border-b border-primary-700">
                <a href="<?= base_url('dashboard') ?>" class="flex items-center space-x-3">
                    <img src="<?= base_url(); ?>assets/dist/img/AdminLTELogo.jpg" alt="Logo" class="h-8 w-8 rounded-full">
                    <span class="brand-text text-white font-bold text-lg tracking-wide">TIM4 NEWS</span>
                </a>
                <button @click="sidebarCollapsed = !sidebarCollapsed" class="text-primary-200 hover:text-white transition-colors">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <!-- User Panel -->
            <div class="p-4 border-b border-primary-700">
                <div class="flex items-center space-x-3">
                    <div class="flex-shrink-0">
                        <?php $avatar = userdata()->avatar ? userdata()->avatar : $this->config->item('user_avatar_default'); ?>
                        <img src="<?= base_url('assets/dist/img/users/') . $avatar ?>" class="h-10 w-10 rounded-full border-2 border-primary-500">
                    </div>
                    <div class="user-info overflow-hidden">
                        <div class="font-medium truncate"><?= userdata()->fullname; ?></div>
                        <div class="text-primary-200 text-xs flex items-center">
                            <i class="fas fa-circle text-green-400 mr-1 text-xs"></i>
                            <span class="truncate"><?= userdata()->role; ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="p-3 space-y-1">
                <?php if (userdata()->role == "admin") : ?>
                    <div class="nav-header text-primary-300 uppercase text-xs font-bold px-3 py-2 tracking-wider">Main Menu</div>
                    <ul class="space-y-1">
                        <li class="nav-item <?= active_menu('dashboard') ? 'active' : '' ?>">
                            <a href="<?= base_url('dashboard'); ?>" class="flex items-center px-3 py-3 rounded-md transition-colors <?= active_menu('dashboard') ? 'bg-primary-700 text-white shadow-md' : 'text-primary-100 hover:bg-primary-800' ?>">
                                <i class="fas fa-tachometer-alt w-6 text-center text-lg"></i>
                                <span class="sidebar-text ml-3 font-medium">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item <?= active_menu('category') ? 'active' : '' ?>">
                            <a href="<?= base_url('category'); ?>" class="flex items-center px-3 py-3 rounded-md transition-colors <?= active_menu('category') ? 'bg-primary-700 text-white shadow-md' : 'text-primary-100 hover:bg-primary-800' ?>">
                                <i class="fas fa-tags w-6 text-center text-lg"></i>
                                <span class="sidebar-text ml-3 font-medium">Category</span>
                            </a>
                        </li>
                        <li class="nav-item <?= active_menu('post') ? 'active' : '' ?>">
                            <a href="<?= base_url('post/data'); ?>" class="flex items-center px-3 py-3 rounded-md transition-colors <?= active_menu('post') ? 'bg-primary-700 text-white shadow-md' : 'text-primary-100 hover:bg-primary-800' ?>">
                                <i class="fas fa-newspaper w-6 text-center text-lg"></i>
                                <span class="sidebar-text ml-3 font-medium">Post</span>
                            </a>
                        </li>
                        <li class="nav-item <?= active_menu('member') ? 'active' : '' ?>">
                            <a href="<?= base_url('member'); ?>" class="flex items-center px-3 py-3 rounded-md transition-colors <?= active_menu('member') ? 'bg-primary-700 text-white shadow-md' : 'text-primary-100 hover:bg-primary-800' ?>">
                                <i class="fas fa-users w-6 text-center text-lg"></i>
                                <span class="sidebar-text ml-3 font-medium">Members</span>
                            </a>
                        </li>
                        <li class="nav-item <?= active_menu('comment') ? 'active' : '' ?>">
                            <a href="<?= base_url('comment'); ?>" class="flex items-center px-3 py-3 rounded-md transition-colors <?= active_menu('comment') ? 'bg-primary-700 text-white shadow-md' : 'text-primary-100 hover:bg-primary-800' ?>">
                                <i class="fas fa-comments w-6 text-center text-lg"></i>
                                <span class="sidebar-text ml-3 font-medium">Comments</span>
                            </a>
                        </li>
                    </ul>
                <?php endif; ?>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Navbar -->
            <header class="bg-white dark:bg-gray-800 shadow-sm z-10">
                <div class="flex items-center justify-between px-6 py-3">
                    <!-- Left Side -->
                    <div class="flex items-center space-x-4">
                        <a target="_blank" href="<?= base_url(); ?>" class="flex items-center text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                            <i class="fas fa-external-link-alt mr-2"></i>
                            <span class="hidden md:inline">View Website</span>
                        </a>
                    </div>

                    <!-- Right Side -->
                    <div class="flex items-center space-x-5">
                        <button class="text-gray-500 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </button>
                        
                        <!-- Notifications -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="text-gray-500 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors relative">
                                <i class="fas fa-bell"></i>
                                <span class="absolute -top-1 -right-1 h-3 w-3 rounded-full bg-red-500 border border-white dark:border-gray-800"></span>
                            </button>
                            <div x-show="open" @click.away="open = false" 
                                 class="absolute right-0 mt-2 w-72 bg-white dark:bg-gray-800 rounded-lg shadow-xl py-1 z-50 border border-gray-200 dark:border-gray-700"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 scale-100"
                                 x-transition:leave-end="opacity-0 scale-95">
                                <div class="px-4 py-2 border-b border-gray-200 dark:border-gray-700">
                                    <h3 class="font-semibold text-gray-800 dark:text-white">Notifications</h3>
                                </div>
                                <div class="max-h-60 overflow-y-auto">
                                    <a href="#" class="block px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700 border-b border-gray-100 dark:border-gray-700">
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0 bg-primary-100 dark:bg-primary-900 rounded-full p-2">
                                                <i class="fas fa-envelope text-primary-600 dark:text-primary-400"></i>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm font-medium text-gray-900 dark:text-white">New message</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">You have 3 new messages</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="block px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700">
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0 bg-green-100 dark:bg-green-900 rounded-full p-2">
                                                <i class="fas fa-user-plus text-green-600 dark:text-green-400"></i>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm font-medium text-gray-900 dark:text-white">New user</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">5 new members joined</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="px-4 py-2 border-t border-gray-200 dark:border-gray-700 text-center">
                                    <a href="#" class="text-sm font-medium text-primary-600 dark:text-primary-400 hover:underline">View all notifications</a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- User Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                                <div class="h-8 w-8 rounded-full bg-primary-500 flex items-center justify-center text-white font-semibold">
                                    <?= substr(userdata()->fullname, 0, 1) ?>
                                </div>
                                <span class="hidden md:inline text-gray-700 dark:text-gray-300 font-medium"><?= userdata()->fullname; ?></span>
                                <i class="fas fa-chevron-down text-xs text-gray-500 dark:text-gray-400"></i>
                            </button>
                            <div x-show="open" @click.away="open = false" 
                                 class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg py-1 z-50 border border-gray-200 dark:border-gray-700"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 scale-100"
                                 x-transition:leave-end="opacity-0 scale-95">
                                <a href="<?= base_url('configuration/account'); ?>" class="block px-4 py-2 text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                    <i class="fas fa-user-circle mr-2 text-gray-500"></i> My Account
                                </a>
                                <a href="<?= base_url('configuration/change_password'); ?>" class="block px-4 py-2 text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                    <i class="fas fa-lock-open mr-2 text-gray-500"></i> Change Password
                                </a>
                                <div class="border-t border-gray-200 dark:border-gray-700 my-1"></div>
                                <a href="#" @click.prevent="$('#logoutModal').modal('show')" class="block px-4 py-2 text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                    <i class="fas fa-sign-out-alt mr-2 text-gray-500"></i> Sign Out
                                </a>
                            </div>
                        </div>
                        
                        <!-- Dark Mode Toggle -->
                        <button @click="darkMode = !darkMode" class="text-gray-500 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                            <i x-show="!darkMode" class="fas fa-moon"></i>
                            <i x-show="darkMode" class="fas fa-sun text-yellow-400"></i>
                        </button>
                    </div>
                </div>
            </header>

            <!-- Content Wrapper -->
            <main class="flex-1 overflow-y-auto p-6 bg-gray-50/50 dark:bg-gray-900/50">
                <!-- Content Header -->
                <div class="mb-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-2"><?= $title; ?></h1>
                            <nav class="flex" aria-label="Breadcrumb">
                                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                                    <li class="inline-flex items-center">
                                        <a href="<?= base_url('dashboard'); ?>" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary-600 dark:text-gray-400 dark:hover:text-white transition-colors">
                                            <i class="fas fa-home mr-2"></i>
                                            Dashboard
                                        </a>
                                    </li>
                                    <li aria-current="page">
                                        <div class="flex items-center">
                                            <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i>
                                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400"><?= $title; ?></span>
                                        </div>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                        <div class="mt-4 sm:mt-0">
                            <!-- Additional header buttons can go here -->
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">