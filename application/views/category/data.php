<?= $this->session->flashdata('msg') ? '<div class="mb-4 p-4 rounded-lg bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">'.$this->session->flashdata('msg').'</div>' : '' ?>

<!-- Loader -->
<div id="loader" class="hidden fixed inset-0 bg-white bg-opacity-70 flex items-center justify-center z-50">
    <div class="w-12 h-12 border-4 border-blue-500 border-t-transparent rounded-full animate-spin"></div>
</div>

<div class="flex flex-col lg:flex-row gap-6">
    <!-- Form Section -->
    <div class="w-full lg:w-1/3">
        <?= form_open('', '', ['category_id' => '']); ?>
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white" id="form-title">New Category</h3>
                <button type="button" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
            
            <div class="p-6 space-y-4">
                <div>
                    <label for="category_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 required">Category</label>
                    <input value="<?= set_value('category_name'); ?>" type="text" name="category_name" id="category_name" 
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white" 
                           placeholder="Category Name...">
                    <?= form_error('category_name', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                </div>
                
                <div>
                    <label for="category_desc" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                    <textarea name="category_desc" id="category_desc" rows="3" 
                              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white" 
                              placeholder="Category Description..."><?= set_value('category_desc'); ?></textarea>
                    <?= form_error('category_desc', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                </div>
            </div>
            
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 flex justify-end space-x-3">
                <button type="reset" id="btn-cancel" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white rounded-md hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
                    Clear
                </button>
                <button type="submit" class="px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700 transition-colors flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    <span>Save</span>
                </button>
            </div>
        </div>
        <?= form_close(); ?>
    </div>

    <!-- List Section -->
    <div class="w-full lg:w-2/3">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Category List</h3>
                <button type="button" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
            
            <div class="divide-y divide-gray-200 dark:divide-gray-700">
                <?php if ($category) : ?>
                    <?php 
                    $perPage = 5;
                    $totalPages = ceil(count($category) / $perPage);
                    $currentPage = isset($_GET['page']) ? max(1, min($totalPages, (int)$_GET['page'])) : 1;
                    $offset = ($currentPage - 1) * $perPage;
                    $paginatedCategories = array_slice($category, $offset, $perPage);
                    ?>
                    
                    <?php foreach ($paginatedCategories as $row) : ?>
                        <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="text-md font-medium text-gray-800 dark:text-white"><?= $row->category_name; ?></h4>
                                    <?php if ($row->category_desc) : ?>
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-300"><?= $row->category_desc; ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="flex space-x-2">
                                    <button type="button" 
                                            data-id="<?= $row->category_id ?>" 
                                            data-name="<?= $row->category_name ?>" 
                                            data-desc="<?= $row->category_desc ?>" 
                                            class="btn-sm btn-edit text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300 p-1 rounded-md hover:bg-yellow-50 dark:hover:bg-yellow-900/30">
                                        <i class="fas fa-edit mr-1"></i>
                                    </button>
                                    <a href="<?= base_url('category/delete/') . $row->category_id; ?>" 
                                       onclick="return confirm('Are you sure you want to delete this?');" 
                                       class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 p-1 rounded-md hover:bg-red-50 dark:hover:bg-red-900/30">
                                        <i class="fas fa-trash mr-1"></i>
                                    </a>
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
                                        Showing <span class="font-medium"><?= $offset + 1 ?></span> to <span class="font-medium"><?= min($offset + $perPage, count($category)) ?></span> of <span class="font-medium"><?= count($category) ?></span> categories
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
                        <p class="text-gray-500 dark:text-gray-400">No categories found</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Script Section -->
<script type="text/javascript">
    $(document).ready(function() {
        $('body').on('click', '.btn-edit', function() {
            let id = $(this).data('id'),
                name = $(this).data('name'),
                desc = $(this).data('desc');

            $('#form-title').text('Edit Category - ID#' + id);
            $('[name=category_id]').val(id);
            $('#category_name').val(name).select();
            $('#category_desc').val(desc);

            document.querySelector('#form-title').scrollIntoView({
                behavior: 'smooth'
            });
        });

        $('body').on('click', '#btn-cancel', function() {
            $('#form-title').text('New Category');
            $('[name=category_id]').val('');
            $('#category_name').val('').select();
            $('#category_desc').val('');
        });
    });

    // Loader effect
    $(document).on('submit', 'form', function () {
        $('#loader').removeClass('hidden');
    });

    $(document).on('click', 'a[href*="page="]', function () {
        $('#loader').removeClass('hidden');
    });
</script>

<style>
    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    .animate-spin {
        animation: spin 1s linear infinite;
    }
</style>
