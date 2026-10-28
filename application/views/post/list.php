<!-- Loading Overlay (Tailwind Only) -->
<div id="page-loader" class="fixed inset-0 z-50 flex items-center justify-center bg-white transition-opacity duration-500">
    <div class="flex flex-col items-center">
        <div class="w-12 h-12 border-4 border-blue-600 border-t-transparent rounded-full animate-spin mb-3"></div>
        <p class="text-gray-600 text-sm font-medium animate-pulse">Loading...</p>
    </div>
</div>
<!-- Modern Page Header -->
<div class="mb-8">
    <div class="flex items-center">
        <div class="flex-1">
            <!-- Page pre-title -->
            <div class="text-sm font-medium text-gray-500 mb-1">
                Home
            </div>
            <h2 class="text-2xl font-bold text-gray-800">
                <?= $selected_category ? "Category: " . get_category($selected_category) : "All Posts"; ?>
            </h2>
        </div>
    </div>
</div>

<!-- No Posts Found Message -->
<?php if (!$posts) : ?>
    <div class="flex justify-center">
        <div class="w-full max-w-md text-center p-6 rounded-lg bg-yellow-50 border border-yellow-200">
            <p class="text-yellow-800 mb-3">Post not found.</p>
            <a href="<?= base_url(); ?>" class="inline-block px-3 py-1 text-sm font-medium text-white bg-red-600 rounded-full hover:bg-red-700 transition-colors">Show All</a>
        </div>
    </div>
<?php endif; ?>

<!-- Modern Post Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php foreach ($posts as $post) : 
        $thumbnail = $post->post_thumbnail ? $post->post_thumbnail : $this->config->item('post_thumbnail_default');
    ?>
        <div class="group relative flex flex-col h-full bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow overflow-hidden">
            <!-- Thumbnail with hover effect -->
            <a href="<?= base_url('post/view/') . $post->post_slug; ?>" class="block overflow-hidden">
                <img src="<?= base_url('assets/dist/img/posts/') . $thumbnail ?>" 
                     class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105">
            </a>
            
            <!-- Content -->
            <div class="flex-1 p-5">
                <!-- Category Badge -->
                <span class="inline-flex items-center px-3 py-1 mb-3 text-xs font-medium text-blue-700 bg-blue-100 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M11 3l9 9a1.5 1.5 0 0 1 0 2l-6 6a1.5 1.5 0 0 1 -2 0l-9 -9v-4a4 4 0 0 1 4 -4h4"/>
                        <circle cx="9" cy="9" r="2"/>
                    </svg>
                    <?= $post->category_name; ?>
                </span>
                
                <!-- Title -->
                <a href="<?= base_url('post/view/') . $post->post_slug; ?>" class="block mb-2">
                    <h3 class="text-lg font-bold text-gray-900 hover:text-blue-600 transition-colors line-clamp-2">
                        <?= $post->post_title; ?>
                    </h3>
                </a>
            </div>
            
            <!-- Footer with Author Info -->
            <div class="px-5 pb-5 pt-3 border-t border-gray-100">
                <div class="flex items-center">
                    <!-- Avatar -->
                    <?php if ($post->avatar) : ?>
                        <img src="<?= base_url('assets/dist/img/users/') . $post->avatar ?>" 
                             class="w-8 h-8 rounded-full mr-3 object-cover">
                    <?php else : ?>
                        <span class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 text-blue-800 font-medium mr-3">
                            <?= user_initial($post->fullname); ?>
                        </span>
                    <?php endif; ?>
                    
                    <!-- Author and Date -->
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">
                            <?= $post->fullname; ?>
                        </p>
                        <p class="text-xs text-gray-500">
                            <?= custom_date('d F Y', $post->post_date); ?>
                        </p>
                    </div>
                    
                    <!-- Comment Count -->
                    <div class="flex items-center text-gray-500 hover:text-blue-600 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4"/>
                            <line x1="8" y1="9" x2="16" y2="9"/>
                            <line x1="8" y1="13" x2="14" y2="13"/>
                        </svg>
                        <span class="text-xs font-medium">
                            <?= $this->comment->number_of_comments($post->post_id); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- Pagination -->
<div class="mt-8 flex justify-center">
    <div class="flex items-center space-x-1">
        <?= str_replace(
            ['<div class="pagination">', '<a', '</div>', '<span', '<strong'],
            ['<div class="flex space-x-1">', '<a class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-100 hover:text-gray-900 transition-colors duration-200"', '', '<span class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white"', '<strong class="px-4 py-2 border border-blue-600 rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-200"'],
            $this->pagination->create_links()
        ); ?>
    </div>
</div>
<script>
    window.addEventListener('load', () => {
        const loader = document.getElementById('page-loader');
        loader.classList.add('opacity-0');
        setTimeout(() => {
            loader.style.display = 'none';
        }, 500); // Durasi sama dengan transition
    });
</script>