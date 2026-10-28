<?php if (userdata()) : ?>
    <?= form_open('comment/add', '', ['post_id' => $post_id]); ?>
    <div class="bg-white rounded-lg shadow-sm mb-6 overflow-hidden border border-gray-200">
        <div class="px-6 py-4">
            <h3 class="text-lg font-semibold text-gray-800 mb-3">Type a Comment</h3>
            <textarea class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                      rows="4" name="comment_body" placeholder="Share your thoughts..."></textarea>
            <?= form_open('comment_body'); ?>
        </div>
        <div class="px-6 py-3 bg-gray-50 text-right border-t border-gray-200">
            <button type="reset" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 mr-2 transition-colors">
                Clear
            </button>
            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 flex items-center transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <line x1="10" y1="14" x2="21" y2="3" />
                    <path d="M21 3l-6.5 18a0.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a0.55 .55 0 0 1 0 -1l18 -6.5" />
                </svg>
                Publish
            </button>
        </div>
    </div>
    <?= form_close(); ?>
<?php else : ?>
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-center mb-6">
        <p class="text-blue-800 mb-2">Sign in to write comment.</p>
        <a href="<?= base_url('signin'); ?>" class="inline-block text-sm font-semibold text-blue-600 hover:text-blue-800 transition-colors">
            Sign in
        </a>
    </div>
<?php endif; ?>

<!-- Comments Section -->
<div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200 mb-6" id="comment-box">
    <div class="px-6 py-4">
        <h5 class="text-lg font-semibold text-gray-800 mb-4 text-center flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M3 20l1.3 -3.9a9 8 0 1 1 3.4 2.9l-4.7 1" />
                <line x1="12" y1="12" x2="12" y2="12.01" />
                <line x1="8" y1="12" x2="8" y2="12.01" />
                <line x1="16" y1="12" x2="16" y2="12.01" />
            </svg>
            <?= $this->comment->number_of_comments($post->post_id); ?> Comments
        </h5>
        
        <?php if (!$comments) : ?>
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 text-center text-yellow-800">
                No comments yet. Be the first to comment!
            </div>
        <?php else : ?>
            <div class="space-y-1">
                <?php foreach ($comments as $c) : ?>
                    <div class="border-l-2 border-blue-200 pl-4" id="c<?= $c->comment_id; ?>">
                        <div class="flex items-start space-x-4">
                            <!-- Avatar -->
                            <div class="flex-shrink-0">
                                <?php if ($c->avatar) : ?>
                                    <img src="<?= base_url('assets/dist/img/users/') . $c->avatar ?>" class="h-10 w-10 rounded-full object-cover">
                                <?php else : ?>
                                    <span class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-blue-100 text-blue-800 font-medium">
                                        <?= user_initial($c->fullname); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                            
                            <!-- Comment Content -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center space-x-2">
                                    <h4 class="text-sm font-semibold text-gray-900">
                                        <?= $c->fullname ? $c->fullname : "Anonymous"; ?>
                                    </h4>
                                    <span class="text-xs text-gray-500">
                                        <?= custom_date('d M Y', $c->comment_date); ?>
                                    </span>
                                </div>
                                <p class="mt-1 text-sm text-gray-700"><?= $c->comment_body; ?></p>
                                
                                <!-- Actions -->
                                <div class="mt-3 flex items-center space-x-4">
                                    <?php if (userdata()) : ?>
                                        <button class="text-xs font-medium text-blue-600 hover:text-blue-800 transition-colors" 
                                                type="button" 
                                                data-toggle="collapse" 
                                                data-target="#reply-box-<?= $c->comment_id; ?>">
                                            Reply
                                        </button>
                                        <?php if (userdata()->user_id == $c->user_id || userdata()->role == "admin") : ?>
                                            <a onclick="return confirm('Confirm Delete?')" 
                                               href="<?= base_url('comment/delete/' . $c->comment_id); ?>" 
                                               class="text-xs font-medium text-red-600 hover:text-red-800 transition-colors">
                                                Delete
                                            </a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                
                                <!-- Reply Form -->
                                <?php if (userdata()) : ?>
                                    <div class="collapse mt-0" id="reply-box-<?= $c->comment_id; ?>">
                                        <?= form_open('comment/add', '', ['post_id' => $post_id, 'comment_parent' => $c->comment_id]); ?>
                                        <div class="bg-gray-50 rounded-lg p-1 border border-gray-200">
                                            <h5 class="text-sm font-semibold text-gray-800 mb-2">Write a Reply</h5>
                                            <textarea class="w-full px-3 py-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm" 
                                                      rows="1" name="comment_body" placeholder="Type your reply..."></textarea>
                                            <div class="mt-1 text-right">
                                                <button type="reset" class="px-3 py-1 text-xs font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 mr-2 transition-colors">
                                                    Clear
                                                </button>
                                                <button type="submit" class="px-3 py-1 text-xs font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 flex items-center transition-colors">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <line x1="10" y1="14" x2="21" y2="3" />
                                                        <path d="M21 3l-6.5 18a0.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a0.55 .55 0 0 1 0 -1l18 -6.5" />
                                                    </svg>
                                                    Send
                                                </button>
                                            </div>
                                        </div>
                                        <?= form_close(); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <!-- Replies -->
                        <?php if (!empty($replies[$c->comment_id])) : ?>
                            <div class="mt-4 pl-6 space-y-4 border-l-2 border-gray-200">
                                <?php foreach ($replies[$c->comment_id] as $reply) : ?>
                                    <div class="pt-4" id="c<?= $reply->comment_id; ?>">
                                        <div class="flex items-start space-x-4">
                                            <!-- Reply Avatar -->
                                            <div class="flex-shrink-0">
                                                <?php if ($reply->avatar) : ?>
                                                    <img src="<?= base_url('assets/dist/img/users/') . $reply->avatar ?>" class="h-8 w-8 rounded-full object-cover">
                                                <?php else : ?>
                                                    <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-blue-100 text-blue-800 text-xs font-medium">
                                                        <?= user_initial($reply->fullname); ?>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                            
                                            <!-- Reply Content -->
                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-center space-x-2">
                                                    <h4 class="text-xs font-semibold text-gray-900">
                                                        <?= $reply->fullname ? $reply->fullname : "Anonymous"; ?>
                                                    </h4>
                                                    <span class="text-xs text-gray-500">
                                                        <?= custom_date('d M Y', $reply->comment_date); ?>
                                                    </span>
                                                </div>
                                                <p class="mt-1 text-xs text-gray-700"><?= $reply->comment_body; ?></p>
                                                
                                                <!-- Reply Actions -->
                                                <?php if (userdata() && (userdata()->user_id == $reply->user_id || userdata()->role == "admin")) : ?>
                                                    <div class="mt-2">
                                                        <a onclick="return confirm('Confirm Delete?')" 
                                                           href="<?= base_url('comment/delete/' . $reply->comment_id); ?>" 
                                                           class="text-xs font-medium text-red-600 hover:text-red-800 transition-colors">
                                                            Delete
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>