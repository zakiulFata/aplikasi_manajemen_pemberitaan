<?php if ($this->session->flashdata('msg')) : ?>
    <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
        <?= $this->session->flashdata('msg'); ?>
    </div>
<?php endif; ?>

<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-gray-200 dark:border-gray-700 overflow-hidden">
    <!-- Card Header -->
    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white">List <?= $title; ?></h3>
        <div class="flex items-center space-x-2">
            <a href="<?= base_url('post/create'); ?>" class="inline-flex items-center px-3 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700 transition-colors shadow-sm">
                <i class="fas fa-plus mr-1"></i> New Post
            </a>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">#</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Title</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Author</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Category</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                <?php 
                $perPage = 5;
                $totalPosts = count($post);
                $totalPages = ceil($totalPosts / $perPage);
                $currentPage = isset($_GET['page']) ? max(1, min($totalPages, (int)$_GET['page'])) : 1;
                $offset = ($currentPage - 1) * $perPage;
                $paginatedPosts = array_slice($post, $offset, $perPage);
                
                $n = $offset + 1; 
                foreach ($paginatedPosts as $row) : ?>
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"><?= $n++; ?>.</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"><?= $row->post_date; ?></td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-white"><?= $row->post_title; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"><?= $row->fullname; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"><?= $row->category_name; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end space-x-2">
                                <a href="<?= base_url('post/view/') . $row->post_slug; ?>" target="_blank" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 p-1 rounded-md hover:bg-blue-50 dark:hover:bg-blue-900/30">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?= base_url('post/edit/') . $row->post_id; ?>" class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300 p-1 rounded-md hover:bg-yellow-50 dark:hover:bg-yellow-900/30">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?= base_url('post/delete/') . $row->post_id; ?>" onclick="return confirm('Confirm Delete?');" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 p-1 rounded-md hover:bg-red-50 dark:hover:bg-red-900/30">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <?php if ($totalPages > 1) : ?>
    <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
        <nav class="flex items-center justify-between">
            <div class="text-sm text-gray-700 dark:text-gray-300">
                Showing <span class="font-medium"><?= $offset + 1 ?></span> to <span class="font-medium"><?= min($offset + $perPage, $totalPosts) ?></span> of <span class="font-medium"><?= $totalPosts ?></span> posts
            </div>
            <div class="flex space-x-2">
                <?php if ($currentPage > 1) : ?>
                    <a href="?page=<?= $currentPage - 1 ?>" class="px-3 py-1 rounded-md border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-600">
                        Previous
                    </a>
                <?php endif; ?>
                
                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <a href="?page=<?= $i ?>" class="<?= $i == $currentPage ? 'bg-blue-50 border-blue-500 text-blue-600 dark:bg-blue-900/30 dark:border-blue-700 dark:text-blue-300' : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-600' ?> px-3 py-1 rounded-md border">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>
                
                <?php if ($currentPage < $totalPages) : ?>
                    <a href="?page=<?= $currentPage + 1 ?>" class="px-3 py-1 rounded-md border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-600">
                        Next
                    </a>
                <?php endif; ?>
            </div>
        </nav>
    </div>
    <?php endif; ?>
</div>