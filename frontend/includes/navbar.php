<?php
// frontend/includes/navbar.php

// Dapatkan nama file saat ini untuk menentukan menu aktif
$current_page_frontend = basename($_SERVER['PHP_SELF']);

// Pastikan session sudah dimulai di halaman pemanggil sebelum include file ini
// jika belum, tambahkan: if (session_status() == PHP_SESSION_NONE) { session_start(); }
// Tapi lebih baik session_start() ada di paling atas halaman utama.

// Definisikan path prefix. Untuk frontend, biasanya kosong jika semua file di root frontend/
// Jika ada file di subfolder frontend yang menggunakan navbar ini, Anda perlu logika path prefix
$path_prefix_frontend = $path_prefix_frontend ?? ""; // Default ke string kosong jika tidak di-set

// Cek apakah mahasiswa sudah login (variabel dari halaman pemanggil)
$is_mahasiswa_loggedin = isset($_SESSION['mahasiswa_loggedin']) && $_SESSION['mahasiswa_loggedin'] === true;
$nama_mahasiswa_display = $is_mahasiswa_loggedin ? htmlspecialchars(explode(" ", $_SESSION['nama_mahasiswa'])[0]) : '';

?>
<nav class="bg-gradient-to-r from-green-600 via-green-700 to-green-800 shadow-lg fixed top-0 left-0 right-0 z-50 backdrop-blur-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo dan Brand -->
            <div class="flex items-center space-x-3">
                <a href="<?php echo $path_prefix_frontend; ?>index.php" class="flex items-center space-x-3 hover:opacity-90 transition-opacity duration-200">
                    <img src="<?php echo $path_prefix_frontend; ?>img/logo.jpg" alt="Logo" class="w-10 h-10 rounded-full ring-2 ring-white/20">
                    <div class="text-white">
                        <span class="text-lg font-medium">Labterpadu</span>
                        <span class="text-lg font-bold">Uinril</span>
                    </div>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-1">
                    <a href="<?php echo $path_prefix_frontend; ?>index.php" 
                       class="<?php echo ($current_page_frontend == 'index.php') ? 'bg-green-900 text-white' : 'text-green-100 hover:bg-green-800 hover:text-white'; ?> px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200">
                        Beranda
                    </a>
                    <a href="<?php echo $path_prefix_frontend; ?>Profil.php" 
                       class="<?php echo ($current_page_frontend == 'Profil.php') ? 'bg-green-900 text-white' : 'text-green-100 hover:bg-green-800 hover:text-white'; ?> px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200">
                        Profil
                    </a>
                    <a href="<?php echo $path_prefix_frontend; ?>Berita.php" 
                       class="<?php echo ($current_page_frontend == 'Berita.php') ? 'bg-green-900 text-white' : 'text-green-100 hover:bg-green-800 hover:text-white'; ?> px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200">
                        Berita
                    </a>
                    <a href="<?php echo $path_prefix_frontend; ?>kontak.php" 
                       class="text-green-100 hover:bg-green-800 hover:text-white px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200">
                        Kontak
                    </a>
                </div>
            </div>

            <!-- User Menu & Actions -->
            <div class="flex items-center space-x-4">
                <?php if ($is_mahasiswa_loggedin): ?>
                    <!-- User Dropdown -->
                    <div class="relative group">
                        <button class="flex items-center space-x-2 text-green-100 hover:text-white bg-green-800/50 hover:bg-green-800 px-4 py-2 rounded-lg transition-all duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                            </svg>
                            <span class="text-sm font-medium">Halo, <?php echo $nama_mahasiswa_display; ?></span>
                            <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                            <div class="py-2">
                                <a href="<?php echo $path_prefix_frontend; ?>../backend/mahasiswa/dashboard.php" 
                                   class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-green-50 hover:text-green-800 transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2h2a2 2 0 002-2"/>
                                    </svg>
                                    Dashboard Saya
                                </a>
                                <a href="<?php echo $path_prefix_frontend; ?>../backend/mahasiswa/peminjaman_saya.php" 
                                   class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-green-50 hover:text-green-800 transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                    </svg>
                                    Peminjaman Saya
                                </a>
                                <hr class="my-2 border-gray-200">
                                <a href="<?php echo $path_prefix_frontend; ?>../backend/mahasiswa/logout.php" 
                                   class="flex items-center px-4 py-3 text-sm text-red-600 hover:bg-red-50 hover:text-red-800 transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Logout
                                </a>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- Login & Register Buttons -->
                    <div class="flex items-center space-x-3">
                        <a href="<?php echo $path_prefix_frontend; ?>../backend/login_mahasiswa.php" 
                           class="flex items-center space-x-2 text-green-100 hover:text-white border border-green-400 hover:border-white px-4 py-2 rounded-lg transition-all duration-200 text-sm font-medium">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            <span>Login Silabor</span>
                        </a>
                        <a href="<?php echo $path_prefix_frontend; ?>../backend/registrasi_mahasiswa.php" 
                           class="flex items-center space-x-2 bg-white text-green-700 hover:bg-green-50 px-4 py-2 rounded-lg transition-all duration-200 text-sm font-medium shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                            </svg>
                            <span>Daftar</span>
                        </a>
                    </div>
                <?php endif; ?>

                <!-- Admin Link -->
                <div class="hidden lg:block">
                    <a href="<?php echo $path_prefix_frontend; ?>../backend/index.php" 
                       class="flex items-center space-x-1 text-green-200 hover:text-white text-xs opacity-75 hover:opacity-100 transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>Admin</span>
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-green-100 hover:text-white p-2 rounded-lg hover:bg-green-800 transition-colors duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="md:hidden hidden bg-green-800/95 backdrop-blur-sm rounded-lg mt-2 mb-4 shadow-xl">
            <div class="px-4 py-4 space-y-2">
                <a href="<?php echo $path_prefix_frontend; ?>index.php" 
                   class="<?php echo ($current_page_frontend == 'index.php') ? 'bg-green-900 text-white' : 'text-green-100'; ?> block px-4 py-3 rounded-lg text-sm font-medium hover:bg-green-900 hover:text-white transition-all duration-200">
                    Beranda
                </a>
                <a href="<?php echo $path_prefix_frontend; ?>Profil.php" 
                   class="<?php echo ($current_page_frontend == 'Profil.php') ? 'bg-green-900 text-white' : 'text-green-100'; ?> block px-4 py-3 rounded-lg text-sm font-medium hover:bg-green-900 hover:text-white transition-all duration-200">
                    Profil
                </a>
                <a href="<?php echo $path_prefix_frontend; ?>Layanan.php" 
                   class="<?php echo ($current_page_frontend == 'Layanan.php') ? 'bg-green-900 text-white' : 'text-green-100'; ?> block px-4 py-3 rounded-lg text-sm font-medium hover:bg-green-900 hover:text-white transition-all duration-200">
                    Layanan
                </a>
                <a href="<?php echo $path_prefix_frontend; ?>Berita.php" 
                   class="<?php echo ($current_page_frontend == 'Berita.php') ? 'bg-green-900 text-white' : 'text-green-100'; ?> block px-4 py-3 rounded-lg text-sm font-medium hover:bg-green-900 hover:text-white transition-all duration-200">
                    Berita
                </a>
                <a href="<?php echo $path_prefix_frontend; ?>index.php#kontak" 
                   class="text-green-100 block px-4 py-3 rounded-lg text-sm font-medium hover:bg-green-900 hover:text-white transition-all duration-200">
                    Kontak
                </a>
                
                <!-- Mobile Admin Link -->
                <div class="pt-4 border-t border-green-700">
                    <a href="<?php echo $path_prefix_frontend; ?>../backend/index.php" 
                       class="text-green-200 flex items-center space-x-2 px-4 py-2 text-sm opacity-75">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>Admin</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- JavaScript untuk Mobile Menu -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!mobileMenuButton.contains(event.target) && !mobileMenu.contains(event.target)) {
                mobileMenu.classList.add('hidden');
            }
        });
    }
});
</script>