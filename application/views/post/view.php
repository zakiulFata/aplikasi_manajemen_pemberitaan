<div class="flex flex-wrap -mx-4">
    <!-- Main Content Column -->
    <div class="w-full lg:w-2/3 px-4">
        <!-- Breadcrumb Card -->
        <div class="bg-white rounded-lg shadow-sm mb-4">
            <div class="p-4">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-2">
                        <li class="flex items-center">
                            <a href="<?= base_url(); ?>" class="flex items-center text-gray-700 hover:text-blue-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <polyline points="5 12 3 12 12 3 21 12 19 12" />
                                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                </svg>
                                Home
                            </a>
                        </li>
                        <li class="flex items-center">
                            <svg class="h-4 w-4 text-gray-400 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                            <a href="#" class="text-gray-700 hover:text-blue-600"><?= $post->category_name; ?></a>
                        </li>
                        <li class="flex items-center" aria-current="page">
                            <svg class="h-4 w-4 text-gray-400 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-gray-500"><?= $post->post_title; ?></span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Main Post Card -->
        <div class="bg-white rounded-lg shadow-sm mb-6">
            <div class="p-6">
                <!-- Category Badge -->
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M11 3l9 9a1.5 1.5 0 0 1 0 2l-6 6a1.5 1.5 0 0 1 -2 0l-9 -9v-4a4 4 0 0 1 4 -4h4" />
                        <circle cx="9" cy="9" r="2" />
                    </svg>
                    <?= $post->category_name; ?>
                </span>

                <!-- Post Title -->
                <h1 class="text-2xl font-bold capitalize mb-4"><?= $post->post_title; ?></h1>

                <!-- Post Meta -->
                <div class="flex flex-wrap items-center gap-2 mb-4">
                    <a href="#" class="inline-flex items-center px-2 py-1 text-sm rounded hover:bg-gray-100">
                        <?php if ($post->avatar) : ?>
                            <img src="<?= base_url('assets/dist/img/users/') . $post->avatar ?>" class="w-6 h-6 rounded-full mr-2 object-cover">
                        <?php else : ?>
                            <span class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-100 text-blue-800 text-xs font-medium mr-2">
                                <?= user_initial($post->fullname); ?>
                            </span>
                        <?php endif; ?>
                        <?= $post->fullname; ?>
                    </a>
                    <button type="button" class="inline-flex items-center px-2 py-1 text-sm rounded hover:bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <rect x="4" y="5" width="16" height="16" rx="2" />
                            <line x1="16" y1="3" x2="16" y2="7" />
                            <line x1="8" y1="3" x2="8" y2="7" />
                            <line x1="4" y1="11" x2="20" y2="11" />
                            <rect x="8" y="15" width="2" height="2" />
                        </svg>
                        <?= custom_date('d M Y', $post->post_date); ?>
                    </button>
                    <button type="button" class="inline-flex items-center px-2 py-1 text-sm rounded hover:bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M3 20l1.3 -3.9a9 8 0 1 1 3.4 2.9l-4.7 1" />
                            <line x1="12" y1="12" x2="12" y2="12.01" />
                            <line x1="8" y1="12" x2="8" y2="12.01" />
                            <line x1="16" y1="12" x2="16" y2="12.01" />
                        </svg>
                        <?= $this->comment->number_of_comments($post->post_id); ?> Comments
                    </button>
                </div>

                <hr class="my-4 border-gray-200">

                <!-- Thumbnail -->
                <?php if ($post->post_thumbnail) : ?>
                    <img src="<?= base_url('assets/dist/img/posts/') . $post->post_thumbnail ?>" class="w-full rounded-lg mb-4">
                <?php endif; ?>

                <!-- Post Content -->
                <div class="prose max-w-none">
                    <?= $post->post_body; ?>
                </div>
            </div>

            <!-- Social Sharing -->
            <div class="px-6 py-4 border-t border-gray-200 flex flex-wrap items-center gap-2">
                <button class="inline-flex items-center px-3 py-1 text-sm rounded hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <circle cx="6" cy="12" r="3" />
                        <circle cx="18" cy="6" r="3" />
                        <circle cx="18" cy="18" r="3" />
                        <line x1="8.7" y1="10.7" x2="15.3" y2="7.3" />
                        <line x1="8.7" y1="13.3" x2="15.3" y2="16.7" />
                    </svg>
                    Share
                </button>
                <a href="#" class="inline-flex items-center px-3 py-1 text-sm text-white bg-blue-600 rounded hover:bg-blue-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" />
                    </svg>
                    Facebook
                </a>
                <a href="#" class="inline-flex items-center px-3 py-1 text-sm text-white bg-blue-400 rounded hover:bg-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M22 4.01c-1 .49 -1.98 .689 -3 .99c-1.121 -1.265 -2.783 -1.335 -4.38 -.737s-2.643 2.06 -2.62 3.737v1c-3.245 .083 -6.135 -1.395 -8 -4c0 0 -4.182 7.433 4 11c-1.872 1.247 -3.739 2.088 -6 2c3.308 1.803 6.913 2.423 10.034 1.517c3.58 -1.04 6.522 -3.723 7.651 -7.742a13.84 13.84 0 0 0 .497 -3.753c-.002 -.249 1.51 -2.772 1.818 -4.013z" />
                    </svg>
                    Twitter
                </a>
                <a href="#" class="inline-flex items-center px-3 py-1 text-sm text-white bg-red-600 rounded hover:bg-red-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <rect x="3" y="5" width="18" height="14" rx="4" />
                        <path d="M10 9l5 3l-5 3z" />
                    </svg>
                    Pinterest
                </a>
            </div>
        </div>

        <!-- Comments Section -->
        <?php $this->load->view('comment/box'); ?>
    </div>

    <!-- Sidebar Column -->
    <div class="w-full lg:w-1/3 px-4">
        <?php $this->load->view('post/sidebar'); ?>
    </div>
</div>