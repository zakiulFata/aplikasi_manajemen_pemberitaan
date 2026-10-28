<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= $title; ?></title>
    
    <!-- Tailwind CSS dengan dark mode class -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    
    <style>
        body {
            background-color: #f8fafc;
        }
        .dark body {
            background-color: #0f172a;
        }
    </style>
</head>

<body class="dark:bg-gray-900">
    <!-- Script untuk mengikuti preferensi dark mode dari dashboard -->
    <script>
        // Cek preferensi dark mode dari localStorage saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            const darkMode = localStorage.getItem('mode') === 'dark';
            if (darkMode) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        });
    </script>

    <!-- Loading Overlay -->
    <div id="page-loader" class="fixed inset-0 z-50 flex items-center justify-center bg-white dark:bg-gray-900 transition-opacity duration-500">
        <div class="flex flex-col items-center">
            <div class="w-12 h-12 border-4 border-blue-600 border-t-transparent rounded-full animate-spin mb-3"></div>
            <p class="text-gray-600 dark:text-gray-300 text-sm font-medium animate-pulse">Loading...</p>
        </div>
    </div>

    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white">News Website</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-2">by <span class="font-semibold">TIM4</span></p>
            </div>
            
            <?= form_open('', ['class' => 'bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden p-8']); ?>
                <?php if($this->session->flashdata('msg')): ?>
                    <div class="mb-4 p-3 rounded-lg bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                        <?= $this->session->flashdata('msg'); ?>
                    </div>
                <?php endif; ?>
                
                <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-white mb-6">Sign in to your account</h2>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Username</label>
                    <input autofocus onfocus="this.select()" value="<?= set_value('username'); ?>" name="username" type="text" 
                           class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" 
                           placeholder="Enter Username">
                    <?= form_error('username', '<p class="mt-1 text-sm text-red-600 dark:text-red-400">', '</p>'); ?>
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Password</label>
                    <div class="relative">
                        <input name="password" type="password" 
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" 
                               placeholder="Password" autocomplete="off">
                        <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-500 dark:hover:text-gray-300" onclick="togglePassword(this)">
                            <i class="far fa-eye"></i>
                        </button>
                    </div>
                    <?= form_error('password', '<p class="mt-1 text-sm text-red-600 dark:text-red-400">', '</p>'); ?>
                </div>
                
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                    Sign In
                </button>
            <?= form_close(); ?>
            
            <p class="text-center text-gray-500 dark:text-gray-400 mt-6">
                Don't have an account yet? 
                <a href="<?= base_url("signup"); ?>" class="text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300">Sign up</a>
            </p>
        </div>
    </div>

    <script>
        // Fungsi toggle password
        function togglePassword(button) {
            const input = button.previousElementSibling;
            const icon = button.querySelector('i');
            if (input.type === "password") {
                input.type = "text";
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = "password";
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
        
        // Hide loader
        window.addEventListener('load', () => {
            const loader = document.getElementById('page-loader');
            loader.classList.add('opacity-0');
            setTimeout(() => {
                loader.style.display = 'none';
            }, 500);
        });
    </script>
</body>
</html>