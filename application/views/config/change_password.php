<?= form_open(); ?>
<div class="flex justify-center items-center min-h-[calc(100vh-8rem)] px-4">
    <div class="w-full max-w-md">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden border border-gray-200 dark:border-gray-700">
            <!-- Card Header -->
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white"><?= $title; ?></h3>
                <div class="flex items-center space-x-2">
                    <button type="button" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                        <i class="fas fa-minus"></i>
                    </button>
                    <a href="<?= base_url('dashboard'); ?>" class="text-sm px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        Cancel
                    </a>
                </div>
            </div>
            
            <!-- Card Body -->
            <div class="p-6">
                <?php if($this->session->flashdata('msg')): ?>
                    <div class="mb-4 p-3 rounded-lg bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                        <?= $this->session->flashdata('msg'); ?>
                    </div>
                <?php endif; ?>
                
                <?= form_open('', ['class' => 'space-y-4']); ?>
                
                <div>
                    <label for="old_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Old Password</label>
                    <input type="password" name="old_password" id="old_password" 
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" 
                           placeholder="Old Password">
                    <?= form_error('old_password', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                </div>
                
                <div>
                    <label for="new_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">New Password</label>
                    <input type="password" name="new_password" id="new_password" 
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" 
                           placeholder="New Password">
                    <?= form_error('new_password', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                </div>
                
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Re-type Password</label>
                    <input type="password" name="password" id="password" 
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" 
                           placeholder="Re-type Password">
                    <?= form_error('password', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                </div>
                
                <button type="submit" class="w-full mt-6 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Save Changes
                </button>
                
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>
<?= form_close(); ?>