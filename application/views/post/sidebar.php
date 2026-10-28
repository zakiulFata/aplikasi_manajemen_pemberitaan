<!-- Recent Posts Card -->
<div class="bg-white rounded-lg shadow-sm mb-6 overflow-hidden border border-gray-200">
    <!-- Card Header -->
    <div class="px-4 py-3 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <h5 class="text-lg font-semibold text-gray-800">
                Recent Posts
            </h5>
            <div class="text-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 12c2 -2.96 0 -7 -1 -8c0 3.038 -1.762 4.383 -2.989 5.642c-1.226 1.26 -2.011 2.598 -2.011 4.358a6 6 0 1 0 12 0c0 -1.532 -.77 -2.94 -1.714 -4c-1.786 3 -3.077 3 -4.286 2z" />
                </svg>
            </div>
        </div>
    </div>
    
    <!-- Posts List -->
    <div class="divide-y divide-gray-200">
        <?php foreach ($recent_posts as $rp) : ?>
            <a href="<?= base_url('post/view/') . $rp->post_slug; ?>" class="block px-4 py-3 hover:bg-gray-50 transition-colors duration-150">
                <div>
                    <h3 class="text-base font-medium text-gray-800 mb-1 hover:text-blue-600 transition-colors">
                        <?= $rp->post_title; ?>
                    </h3>
                    <div class="flex items-center text-xs text-gray-500 space-x-3">
                        <span class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <rect x="4" y="5" width="16" height="16" rx="2" />
                                <line x1="16" y1="3" x2="16" y2="7" />
                                <line x1="8" y1="3" x2="8" y2="7" />
                                <line x1="4" y1="11" x2="20" y2="11" />
                                <rect x="8" y="15" width="2" height="2" />
                            </svg>
                            <?= custom_date('d M Y', $rp->post_date); ?>
                        </span>
                        <span class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M11 3l9 9a1.5 1.5 0 0 1 0 2l-6 6a1.5 1.5 0 0 1 -2 0l-9 -9v-4a4 4 0 0 1 4 -4h4" />
                                <circle cx="9" cy="9" r="2" />
                            </svg>
                            <?= $rp->category_name; ?>
                        </span>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>

<!-- Recent Comments Card -->
<div class="bg-white rounded-lg shadow-sm mb-6 overflow-hidden border border-gray-200">
    <!-- Card Header -->
    <div class="px-4 py-3 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <h5 class="text-lg font-semibold text-gray-800">
                Recent Comments
            </h5>
            <div class="text-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4" />
                    <line x1="12" y1="11" x2="12" y2="11.01" />
                    <line x1="8" y1="11" x2="8" y2="11.01" />
                    <line x1="16" y1="11" x2="16" y2="11.01" />
                </svg>
            </div>
        </div>
    </div>
    
    <!-- Comments List -->
    <div class="divide-y divide-gray-200">
        <?php foreach ($recent_comments as $rc) : ?>
            <a href="<?= base_url('post/view/') . $rc->post_slug . '#c' . $rc->comment_id; ?>" class="block px-4 py-3 hover:bg-gray-50 transition-colors duration-150">
                <div>
                    <p class="text-sm text-gray-700 mb-2 italic">"<?= $rc->comment_body; ?>"</p>
                    <div class="flex items-center text-xs text-gray-500">
                        <?php if ($rc->avatar) : ?>
                            <img src="<?= base_url('assets/dist/img/users/') . $rc->avatar ?>" class="w-5 h-5 rounded-full mr-2 object-cover">
                        <?php else : ?>
                            <span class="flex items-center justify-center w-5 h-5 rounded-full bg-blue-100 text-blue-800 text-xs font-medium mr-2">
                                <?= user_initial($rc->fullname); ?>
                            </span>
                        <?php endif; ?>
                        <span>
                            <span class="font-semibold text-gray-700"><?= $rc->fullname; ?></span> on 
                            <span class="font-semibold"><?= custom_date('d F Y', $rc->comment_date); ?></span>
                        </span>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>