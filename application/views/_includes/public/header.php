<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= $title; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
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
                            50: '#f5f3ff',
                            100: '#ede9fe',
                            200: '#ddd6fe',
                            300: '#c4b5fd',
                            400: '#a78bfa',
                            500: '#8b5cf6',
                            600: '#7c3aed',
                            700: '#6d28d9',
                            800: '#5b21b6',
                            900: '#4c1d95',
                        },
                        accent: {
                            50: '#fef2f2',
                            100: '#fee2e2',
                            200: '#fecaca',
                            300: '#fca5a5',
                            400: '#f87171',
                            500: '#ef4444',
                            600: '#dc2626',
                            700: '#b91c1c',
                            800: '#991b1b',
                            900: '#7f1d1d',
                        },
                        dark: {
                            800: '#1e293b',
                            900: '#0f172a',
                        }
                    },
                    fontFamily: {
                        sans: ['"Inter"', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            display: none;
            background-color: #f8fafc;
        }
        .dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        .gradient-text {
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            background-image: linear-gradient(90deg, #0ea5e9, #8b5cf6);
        }
    </style>
</head>

<body class="font-sans antialiased">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="<?= base_url(); ?>" class="text-2xl font-bold gradient-text">
                        TIM4 NEWS
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-primary-600 focus:outline-none transition-colors" id="mobile-menu-button">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>

                <!-- Desktop Navigation -->
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="<?= base_url() ?>" class="text-gray-600 hover:text-primary-600 transition-colors font-medium text-sm uppercase tracking-wider">
                        Home
                    </a>

                    <!-- Category Dropdown -->
                    <div class="relative dropdown">
                        <button class="text-gray-600 hover:text-primary-600 transition-colors font-medium text-sm uppercase tracking-wider flex items-center">
                            Category
                            <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="absolute left-0 mt-2 w-48 bg-white rounded-lg shadow-xl py-1 z-50 dropdown-menu opacity-0 invisible transform -translate-y-1 transition-all duration-200 border border-gray-100">
                            <?php foreach (get_category() as $category) : ?>
                                <a href="<?= base_url('post/index') . '?category=' . $category->category_id . '&search=' ?>" class="block px-4 py-2 text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors">
                                    <?= $category->category_name; ?>
                                </a>
                            <?php endforeach; ?>
                            <div class="border-t border-gray-100 my-1"></div>
                            <a href="<?= base_url() ?>" class="block px-4 py-2 text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors">
                                Show All
                            </a>
                        </div>
                    </div>

                    <!-- Search -->
                    <form action="<?= base_url('post/index'); ?>" method="get" class="relative">
                        <input type="hidden" name="category" value="<?= set_value('category', $selected_category); ?>">
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" name="search" class="pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 w-64 text-sm placeholder-gray-400" placeholder="Search articles...">
                        </div>
                    </form>

                    <!-- User Area -->
                    <div class="flex items-center space-x-4">
                        <?php if (userdata()) : ?>
                            <!-- User Dropdown -->
                            <div class="relative dropdown">
                                <button class="flex items-center space-x-2 focus:outline-none group">
                                    <?php if (userdata()->avatar) : ?>
                                        <img src="<?= base_url('assets/dist/img/users/') . userdata()->avatar ?>" class="h-8 w-8 rounded-full object-cover border-2 border-white group-hover:border-primary-200 transition-colors shadow-sm">
                                    <?php else : ?>
                                        <div class="h-8 w-8 rounded-full bg-gradient-to-r from-primary-500 to-secondary-500 text-white flex items-center justify-center font-medium shadow-sm">
                                            <?= user_initial(userdata()->fullname); ?>
                                        </div>
                                    <?php endif; ?>
                                    <span class="hidden lg:inline text-gray-600 text-sm font-medium"><?= userdata()->fullname; ?></span>
                                    <svg class="h-4 w-4 text-gray-400 group-hover:text-primary-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl py-1 z-50 dropdown-menu opacity-0 invisible transform -translate-y-1 transition-all duration-200 border border-gray-100">
                                    <?php if (userdata()->role != "member") : ?>
                                        <a href="<?= base_url('dashboard'); ?>" class="block px-4 py-2 text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors text-sm">
                                            <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                                        </a>
                                        <div class="border-t border-gray-100 my-1"></div>
                                    <?php endif; ?>
                                    <a href="<?= base_url('configuration/account') ?>" class="block px-4 py-2 text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors text-sm">
                                        <i class="fas fa-user-cog mr-2"></i> My Account
                                    </a>
                                    <a href="<?= base_url('signout'); ?>" class="block px-4 py-2 text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors text-sm">
                                        <i class="fas fa-sign-out-alt mr-2"></i> Sign Out
                                    </a>
                                </div>
                            </div>
                        <?php else : ?>
                            <a href="<?= base_url('signin') ?>" class="px-4 py-2 bg-gradient-to-r from-primary-500 to-secondary-500 text-white rounded-lg shadow-sm hover:shadow-md transition-all text-sm font-medium">
                                Sign In
                            </a>
                        <?php endif; ?>
                    </div>
                </nav>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="md:hidden hidden bg-white" id="mobile-menu">
            <div class="px-2 pt-2 pb-4 space-y-2 sm:px-3 border-t border-gray-100">
                <a href="<?= base_url() ?>" class="block px-3 py-2 text-gray-700 hover:bg-primary-50 hover:text-primary-600 rounded-md transition-colors">Home</a>
                
                <div class="px-3 py-2">
                    <button class="w-full text-left flex justify-between items-center text-gray-700 hover:text-primary-600" id="mobile-category-toggle">
                        Category
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="hidden mt-2 pl-4 space-y-1" id="mobile-category-menu">
                        <?php foreach (get_category() as $category) : ?>
                            <a href="<?= base_url('post/index') . '?category=' . $category->category_id . '&search=' ?>" class="block px-3 py-2 text-gray-600 hover:bg-primary-50 hover:text-primary-600 rounded-md transition-colors text-sm">
                                <?= $category->category_name; ?>
                            </a>
                        <?php endforeach; ?>
                        <div class="border-t border-gray-100 my-1"></div>
                        <a href="<?= base_url() ?>" class="block px-3 py-2 text-gray-600 hover:bg-primary-50 hover:text-primary-600 rounded-md transition-colors text-sm">
                            Show All
                        </a>
                    </div>
                </div>

                <form action="<?= base_url('post/index'); ?>" method="get" class="px-3">
                    <input type="hidden" name="category" value="<?= set_value('category', $selected_category); ?>">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" name="search" class="pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 w-full text-sm placeholder-gray-400" placeholder="Search articles...">
                    </div>
                </form>

                <?php if (!userdata()) : ?>
                    <a href="<?= base_url('signin') ?>" class="block px-3 py-2 mt-2 text-center bg-gradient-to-r from-primary-500 to-secondary-500 text-white rounded-lg shadow-sm text-sm font-medium">
                        Sign In
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">