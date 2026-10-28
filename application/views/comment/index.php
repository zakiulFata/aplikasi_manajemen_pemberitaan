<?php if ($this->session->flashdata('pesan')) : ?>
    <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
        <?= $this->session->flashdata('pesan'); ?>
    </div>
<?php endif; ?>

<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-gray-200 dark:border-gray-700 overflow-hidden">
    <!-- Card Header -->
    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white">All <?= $title; ?></h3>
        <button type="button" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
            Actions
        </button>
    </div>

    <!-- Comment List -->
    <div class="divide-y divide-gray-200 dark:divide-gray-700">
        <?php if ($comment) : ?>
            <?php 
            $perPage = 5;
            $totalPages = ceil(count($comment) / $perPage);
            $currentPage = isset($_GET['page']) ? max(1, min($totalPages, (int)$_GET['page'])) : 1;
            $offset = ($currentPage - 1) * $perPage;
            $paginatedComments = array_slice($comment, $offset, $perPage);
            ?>
            
            <?php foreach ($paginatedComments as $row) : ?>
                <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <?php $avatar = $row->avatar ? $row->avatar : $this->config->item('user_avatar_default'); ?>
                            <img src="<?= base_url('assets/dist/img/users/') . $avatar ?>" 
                                 alt="User Image" 
                                 class="h-12 w-12 rounded-full object-cover border border-gray-200 dark:border-gray-600">
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-sm font-medium text-gray-800 dark:text-white"><?= $row->fullname; ?></p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400"><?= $row->comment_date; ?></p>
                                </div>
                                <div class="flex space-x-2">
                                    <?php $view = base_url("post/view/") . $row->post_slug . "#c" . $row->comment_id; ?>
                                    <a target="_blank" href="<?= $view; ?>" 
                                       class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 p-1 rounded-md hover:bg-blue-50 dark:hover:bg-blue-900/30">
                                        <i class="fas fa-eye mr-1"></i>
                                    </a>
                                    <a href="<?= base_url('comment/delete/') . $row->comment_id; ?>" 
                                       onclick="return confirm('Confirm Delete?');" 
                                       class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 p-1 rounded-md hover:bg-red-50 dark:hover:bg-red-900/30">
                                        <i class="fas fa-trash mr-1"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                                <?= $row->comment_body; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Pagination -->
            <?php if ($totalPages > 1) : ?>
                <div class="px-6 py-4 flex items-center justify-between border-t border-gray-200 dark:border-gray-700">
                    <div class="flex-1 flex justify-between sm:hidden">
                        <?php if ($currentPage > 1) : ?>
                            <a href="?page=<?= $currentPage - 1 ?>" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-600">
                                Previous
                            </a>
                        <?php endif; ?>
                        <?php if ($currentPage < $totalPages) : ?>
                            <a href="?page=<?= $currentPage + 1 ?>" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-600">
                                Next
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700 dark:text-gray-300">
                                Showing <span class="font-medium"><?= $offset + 1 ?></span> to <span class="font-medium"><?= min($offset + $perPage, count($comment)) ?></span> of <span class="font-medium"><?= count($comment) ?></span> comments
                            </p>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                <?php if ($currentPage > 1) : ?>
                                    <a href="?page=<?= $currentPage - 1 ?>" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-600">
                                        <span class="sr-only">Previous</span>
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                <?php endif; ?>

                                <?php 
                                $startPage = max(1, $currentPage - 2);
                                $endPage = min($totalPages, $currentPage + 2);
                                
                                if ($startPage > 1) {
                                    echo '<a href="?page=1" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-600">1</a>';
                                    if ($startPage > 2) {
                                        echo '<span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">...</span>';
                                    }
                                }
                                
                                for ($i = $startPage; $i <= $endPage; $i++) {
                                    $active = $i == $currentPage ? 'bg-blue-50 border-blue-500 text-blue-600 dark:bg-blue-900/30 dark:border-blue-700 dark:text-blue-300' : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-600';
                                    echo '<a href="?page='.$i.'" class="relative inline-flex items-center px-4 py-2 border text-sm font-medium '.$active.'">'.$i.'</a>';
                                }
                                
                                if ($endPage < $totalPages) {
                                    if ($endPage < $totalPages - 1) {
                                        echo '<span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">...</span>';
                                    }
                                    echo '<a href="?page='.$totalPages.'" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-600">'.$totalPages.'</a>';
                                }
                                ?>

                                <?php if ($currentPage < $totalPages) : ?>
                                    <a href="?page=<?= $currentPage + 1 ?>" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-600">
                                        <span class="sr-only">Next</span>
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                <?php endif; ?>
                            </nav>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php else : ?>
            <div class="p-8 text-center">
                <p class="text-gray-500 dark:text-gray-400">No comments found.</p>
            </div>
        <?php endif; ?>
    </div>
</div>