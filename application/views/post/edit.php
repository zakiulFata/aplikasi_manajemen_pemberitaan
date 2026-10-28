<?= form_open_multipart('', ['class' => 'space-y-6 bg-gray-50 dark:bg-gray-900 p-6']); ?>
<div class="max-w-6xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">Edit Post</h1>
        <div class="flex justify-between items-center">
            <div class="text-sm text-gray-600 dark:text-gray-400">
                <span class="font-medium">Administrator's admin</span>
            </div>
            <div class="flex space-x-3">
                <a href="<?= base_url('post/data'); ?>" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700">
                    <i class="fas fa-arrow-left mr-2"></i> Back
                </a>
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                    <i class="fas fa-save mr-2"></i> Save Changes
                </button>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-3 space-y-6">
            <!-- Post Content Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Post Content</h2>
                </div>
                <div class="p-6 space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Post Title</label>
                        <input type="text" name="post_title" value="<?= set_value('post_title', $post->post_title); ?>" 
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" 
                               placeholder="Post Title..." autocomplete="off">
                        <?= form_error('post_title', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Post Content</label>
                        <textarea name="post_body" rows="12"
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" 
                               placeholder="Write your post content here..."><?= set_value('post_body', $post->post_body); ?></textarea>
                        <?= form_error('post_body', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar - Image Upload Only -->
        <div class="space-y-6">
            <!-- Image Upload Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Post Thumbnail</h2>
                </div>
                <div class="p-6 space-y-6">
                    <?php if ($post->post_thumbnail) : ?>
                    <div class="mb-3">
                        <img src="<?= base_url('assets/dist/img/posts/') . $post->post_thumbnail; ?>" 
                             alt="Current Thumbnail" class="w-full h-auto rounded border border-gray-200 dark:border-gray-600">
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Current Image</p>
                    </div>
                    <?php endif; ?>
                    
                    <div class="mt-1 flex items-center">
                        <label class="cursor-pointer">
                            <span class="inline-block px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                Choose New Image
                            </span>
                            <input name="post_thumbnail" type="file" class="sr-only" accept="image/*">
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= form_close(); ?>