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
                
                <?= form_open_multipart('', ['class' => 'space-y-4']); ?>
                
                <div>
                    <label for="fullname" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Name</label>
                    <input type="text" name="fullname" id="fullname" 
                           value="<?= set_value('fullname', userdata()->fullname); ?>"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" 
                           placeholder="Name">
                    <?= form_error('fullname', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                </div>
                
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Username</label>
                    <input type="text" name="username" id="username" 
                           value="<?= set_value('username', userdata()->username); ?>"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" 
                           placeholder="Username">
                    <?= form_error('username', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                </div>
                
                <div>
                    <label for="avatar" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Avatar</label>
                    <div class="relative">
                        <input type="file" name="avatar" id="avatar" 
                               class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                               accept="image/x-png,image/gif,image/jpeg,image/jpg">
                        <div class="flex items-center justify-between px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700">
                            <span id="file-label" class="text-sm text-gray-500 dark:text-gray-400 truncate">Choose file...</span>
                            <span class="text-sm px-3 py-1 bg-gray-100 dark:bg-gray-600 rounded text-gray-700 dark:text-gray-200">Browse</span>
                        </div>
                    </div>
                    <?= form_error('avatar', '<p class="mt-1 text-sm text-red-600">', '</p>'); ?>
                </div>
                
                <button type="submit" class="w-full mt-6 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Save Changes
                </button>
                
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>

<script>
// Update file input label
document.getElementById('avatar').addEventListener('change', function(e) {
    var fileName = e.target.files[0] ? e.target.files[0].name : "Choose file...";
    document.getElementById('file-label').textContent = fileName;
});
</script>