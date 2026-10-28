</div>
            </main>

            <!-- Footer -->
            <footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 py-4 px-6">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="text-gray-600 dark:text-gray-300 text-sm mb-3 md:mb-0">
                        <strong class="text-primary-600 dark:text-primary-400">TIM4 NEWS</strong> Admin Dashboard
                    </div>
                    <div class="text-gray-500 dark:text-gray-400 text-sm">
                        Copyright &copy; <?= date('Y') ?> All rights reserved.
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Logout Modal -->
    <div class="modal fade fixed inset-0 overflow-y-auto" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalTitle" aria-hidden="true" style="display: none; z-index: 1050;">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-gray-200 dark:border-gray-700">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white" id="logoutModalTitle">
                        <i class="fas fa-sign-out-alt mr-2 text-primary-500"></i> Sign Out
                    </h3>
                </div>
                <div class="px-6 py-5">
                    <p class="text-gray-700 dark:text-gray-300">Are you sure you want to sign out?</p>
                </div>
                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 flex justify-end space-x-3">
                    <button type="button" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white rounded-md hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors" data-dismiss="modal">
                        Cancel
                    </button>
                    <a href="<?= base_url('signout'); ?>" class="px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700 transition-colors shadow-md hover:shadow-primary-500/30">
                        Sign Out
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Alpine JS -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    <!-- Bootstrap 4 -->
    <script src="<?= base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Datatables -->
    <script src="<?= base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <!-- Datepicker -->
    <script src="<?= base_url(); ?>assets/plugins/gijgo/js/gijgo.min.js"></script>
    <!-- Summernote -->
    <script src="<?= base_url() ?>assets/plugins/summernote/summernote-bs4.min.js"></script>
    
    <script>
        $(function() {
            // Initialize dark mode from localStorage
            if (localStorage.getItem("mode") === "dark") {
                document.documentElement.classList.add('dark');
            }

            // File input
            $('.custom-file-input').on('change', function() {
                let fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass("selected").html(fileName);
            });

            // Tooltip
            $('[data-toggle="tooltip"]').tooltip();

            // Initialize Summernote
            $("#summernote").summernote({
                height: "300px",
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                ],
                callbacks: {
                    onImageUpload: function(image) {
                        uploadImage(image[0]);
                    },
                    onMediaDelete: function(target) {
                        deleteImage(target[0].src);
                    }
                }
            });

            function uploadImage(image) {
                var data = new FormData();
                data.append("image", image);
                $.ajax({
                    url: "<?= base_url('dashboard/upload_image') ?>",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: data,
                    type: "POST",
                    success: function(url) {
                        $("#summernote").summernote("insertImage", url);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            }

            function deleteImage(src) {
                $.ajax({
                    data: {
                        src: src
                    },
                    type: "POST",
                    url: "<?= base_url('dashboard/delete_image') ?>",
                    cache: false,
                    success: function(response) {
                        console.log(response);
                    }
                });
            }

            // Datepicker
            $(".gijgo").datepicker({
                uiLibrary: 'bootstrap4',
                format: 'yyyy-mm-dd',
                footer: true,
                modal: true,
                header: true,
                showRightIcon: false
            });

            // Datatable   
            var table = $(".datatable").DataTable({
                dom: "<'flex flex-col md:flex-row md:items-center md:justify-between mb-4'<'mb-4 md:mb-0'l><'f'>>" +
                    "<'w-full overflow-x-auto'tr>" +
                    "<'flex flex-col md:flex-row md:items-center md:justify-between mt-4'<'mb-4 md:mb-0'i><'p'>>",
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search...",
                },
                columnDefs: [{
                    targets: -1,
                    orderable: false,
                    searchable: false,
                    className: 'text-right'
                }],
                initComplete: function() {
                    $('.dataTables_filter input').addClass('border border-gray-300 rounded-md px-3 py-1 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white');
                    $('.dataTables_length select').addClass('border border-gray-300 rounded-md px-3 py-1 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white');
                }
            });

            // Fix modal backdrop
            $('body').on('hidden.bs.modal', '.modal', function() {
                $('.modal:visible').length && $(document.body).addClass('modal-open');
            });
        });
    </script>
</body>
</html>