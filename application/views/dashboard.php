<!-- Loading Overlay (Tailwind Only) -->
<div id="page-loader" class="fixed inset-0 z-50 flex items-center justify-center bg-white transition-opacity duration-500">
    <div class="flex flex-col items-center">
        <div class="w-12 h-12 border-4 border-blue-600 border-t-transparent rounded-full animate-spin mb-3"></div>
        <p class="text-gray-600 text-sm font-medium animate-pulse">Loading...</p>
    </div>
</div>

<div class="space-y-4"> <!-- Reduced space between sections -->
    <!-- 4 Cards - Compact Version -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4"> <!-- Reduced gap -->
        <!-- Category Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden border-l-4 border-green-500"> <!-- Changed to shadow-sm -->
            <div class="p-4 flex justify-between items-start"> <!-- Reduced padding -->
                <div>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Category</p> <!-- Smaller text -->
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white mt-1"><?= count($category); ?></h3> <!-- Smaller heading -->
                </div>
                <div class="bg-green-100 dark:bg-green-900/30 p-2 rounded-full text-green-600 dark:text-green-400"> <!-- Smaller icon container -->
                    <i class="fas fa-newspaper text-md"></i> <!-- Smaller icon -->
                </div>
            </div>
            <a href="<?= base_url('category'); ?>" class="block px-4 py-2 text-xs bg-gray-50 dark:bg-gray-700/50 font-medium text-green-600 dark:text-green-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"> <!-- Smaller text and padding -->
                More info <i class="fas fa-arrow-circle-right ml-1"></i>
            </a>
        </div>

        <!-- Repeat similar compact styling for other 3 cards -->
        <!-- Posts Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden border-l-4 border-blue-500">
            <div class="p-4 flex justify-between items-start">
                <div>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Posts</p>
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white mt-1"><?= count($posts); ?></h3>
                </div>
                <div class="bg-blue-100 dark:bg-blue-900/30 p-2 rounded-full text-blue-600 dark:text-blue-400">
                    <i class="fas fa-clone text-md"></i>
                </div>
            </div>
            <a href="<?= base_url('post/data'); ?>" class="block px-4 py-2 text-xs bg-gray-50 dark:bg-gray-700/50 font-medium text-blue-600 dark:text-blue-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                More info <i class="fas fa-arrow-circle-right ml-1"></i>
            </a>
        </div>

        <!-- Members Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden border-l-4 border-yellow-500">
            <div class="p-4 flex justify-between items-start">
                <div>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Members</p>
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white mt-1"><?= count($members); ?></h3>
                </div>
                <div class="bg-yellow-100 dark:bg-yellow-900/30 p-2 rounded-full text-yellow-600 dark:text-yellow-400">
                    <i class="fas fa-users text-md"></i>
                </div>
            </div>
            <a href="<?= base_url('member'); ?>" class="block px-4 py-2 text-xs bg-gray-50 dark:bg-gray-700/50 font-medium text-yellow-600 dark:text-yellow-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                More info <i class="fas fa-arrow-circle-right ml-1"></i>
            </a>
        </div>

        <!-- Comments Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden border-l-4 border-red-500">
            <div class="p-4 flex justify-between items-start">
                <div>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Comments</p>
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white mt-1"><?= count($comments); ?></h3>
                </div>
                <div class="bg-red-100 dark:bg-red-900/30 p-2 rounded-full text-red-600 dark:text-red-400">
                    <i class="fas fa-comments text-md"></i>
                </div>
            </div>
            <a href="<?= base_url('comment'); ?>" class="block px-4 py-2 text-xs bg-gray-50 dark:bg-gray-700/50 font-medium text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                More info <i class="fas fa-arrow-circle-right ml-1"></i>
            </a>
        </div>
    </div>

    <!-- Compact Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4"> <!-- Reduced gap -->
        <!-- Comparison Chart -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden">
            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700"> <!-- Reduced padding -->
                <h3 class="text-sm font-semibold text-gray-800 dark:text-white">Data Comparison</h3> <!-- Smaller heading -->
            </div>
            <div class="p-3"> <!-- Reduced padding -->
                <canvas id="comparisonChart" height="180"></canvas> <!-- Reduced height -->
            </div>
        </div>

        <!-- Activity Chart -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden">
            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-sm font-semibold text-gray-800 dark:text-white">Monthly Activity</h3>
            </div>
            <div class="p-3">
                <canvas id="activityChart" height="180"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Comparison Chart
    const comparisonCtx = document.getElementById('comparisonChart').getContext('2d');
    new Chart(comparisonCtx, {
        type: 'bar',
        data: {
            labels: ['Categories', 'Posts', 'Members', 'Comments'],
            datasets: [{
                data: [
                    <?= count($category); ?>,
                    <?= count($posts); ?>,
                    <?= count($members); ?>,
                    <?= count($comments); ?>
                ],
                backgroundColor: [
                    'rgba(16, 185, 129, 0.7)',
                    'rgba(59, 130, 246, 0.7)',
                    'rgba(234, 179, 8, 0.7)',
                    'rgba(239, 68, 68, 0.7)'
                ],
                borderColor: [
                    'rgba(16, 185, 129, 1)',
                    'rgba(59, 130, 246, 1)',
                    'rgba(234, 179, 8, 1)',
                    'rgba(239, 68, 68, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: { enabled: true }
            },
            scales: {
                y: { beginAtZero: true, grid: { display: false } },
                x: { grid: { display: false } }
            }
        }
    });

    // Activity Chart
    const activityCtx = document.getElementById('activityChart').getContext('2d');
    new Chart(activityCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [
                {
                    label: 'New Posts',
                    data: [12, 19, 15, 27, 34, 42],
                    borderColor: 'rgba(59, 130, 246, 1)',
                    backgroundColor: 'rgba(59, 130, 246, 0.05)',
                    tension: 0.3,
                    borderWidth: 2,
                    pointRadius: 3
                },
                {
                    label: 'New Comments',
                    data: [8, 12, 16, 14, 19, 23],
                    borderColor: 'rgba(239, 68, 68, 1)',
                    backgroundColor: 'rgba(239, 68, 68, 0.05)',
                    tension: 0.3,
                    borderWidth: 2,
                    pointRadius: 3
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { 
                    position: 'top',
                    labels: { boxWidth: 12, padding: 10 }
                }
            },
            scales: {
                y: { beginAtZero: true, grid: { display: false } },
                x: { grid: { display: false } }
            }
        }
    });
});
window.addEventListener('load', () => {
        const loader = document.getElementById('page-loader');
        loader.classList.add('opacity-0');
        setTimeout(() => {
            loader.style.display = 'none';
        }, 500); // Durasi sama dengan transition
    });
</script>