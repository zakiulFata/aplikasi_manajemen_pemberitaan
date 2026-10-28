</div>
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-dark-800 to-dark-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="md:col-span-2">
                    <h3 class="text-2xl font-bold mb-4 gradient-text">TIM4 NEWS</h3>
                    <p class="text-gray-300 text-sm leading-relaxed">
                        
Menyampaikan berita terkini dan paling relevan dengan akurat dan berintegritas. Misi kami adalah membuat Anda tetap terinformasi tentang hal-hal yang paling penting.
                    </p>
                </div>
                
                <div>
                    <h4 class="text-sm font-semibold uppercase tracking-wider text-primary-300 mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="<?= base_url() ?>" class="text-gray-300 hover:text-white transition-colors text-sm">Home</a></li>
                        <li><a href="<?= base_url('post/index') ?>" class="text-gray-300 hover:text-white transition-colors text-sm">All Articles</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors text-sm">About Us</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors text-sm">Contact</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-sm font-semibold uppercase tracking-wider text-primary-300 mb-4">Connect</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-300 hover:text-white transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition-colors">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm">
                    &copy; 2025 TIM4 NEWS. All rights reserved.
                </p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors text-sm">Privacy Policy</a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors text-sm">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Mobile category toggle
        document.getElementById('mobile-category-toggle').addEventListener('click', function() {
            const menu = document.getElementById('mobile-category-menu');
            menu.classList.toggle('hidden');
        });

        // Show body after load
        document.body.style.display = "block";
    </script>
</body>
</html>