<?php
session_start(); // Untuk navbar
$path_prefix_frontend = ""; // Karena file ini di root frontend/
$page_title = "Kontak Kami";
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $page_title; ?> - Lab Terpadu UIN Lampung</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'green-primary': '#059669',
                        'green-secondary': '#10b981',
                        'green-light': '#d1fae5',
                        'green-dark': '#047857'
                    },
                    animation: {
                        'fade-in-up': 'fadeInUp 0.8s ease-out',
                        'fade-in-left': 'fadeInLeft 0.8s ease-out',
                        'fade-in-right': 'fadeInRight 0.8s ease-out',
                        'bounce-slow': 'bounce 2s infinite',
                        'pulse-slow': 'pulse 3s infinite',
                        'float': 'float 6s ease-in-out infinite',
                        'bounce-gentle': 'bounceGentle 2s ease-in-out infinite',
                        'gradient-shift': 'gradientShift 15s ease infinite'
                    },
                    keyframes: {
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(30px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        fadeInLeft: {
                            '0%': { opacity: '0', transform: 'translateX(-30px)' },
                            '100%': { opacity: '1', transform: 'translateX(0)' }
                        },
                        fadeInRight: {
                            '0%': { opacity: '0', transform: 'translateX(30px)' },
                            '100%': { opacity: '1', transform: 'translateX(0)' }
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' }
                        },
                        bounceGentle: {
                            '0%, 20%, 50%, 80%, 100%': { transform: 'translateY(0)' },
                            '40%': { transform: 'translateY(-8px)' },
                            '60%': { transform: 'translateY(-4px)' }
                        },
                        gradientShift: {
                            '0%': { backgroundPosition: '0% 50%' },
                            '50%': { backgroundPosition: '100% 50%' },
                            '100%': { backgroundPosition: '0% 50%' }
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.9);
        }
        .gradient-bg {
            background: linear-gradient(135deg, #ecfdf5 0%, #f0fdf4 50%, #dcfce7 100%);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        .text-shadow {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }
        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: floatShape 20s infinite linear;
        }
        .shape:nth-child(1) {
            width: 120px;
            height: 120px;
            left: 10%;
            animation-delay: 0s;
        }
        .shape:nth-child(2) {
            width: 80px;
            height: 80px;
            left: 80%;
            animation-delay: 5s;
        }
        .shape:nth-child(3) {
            width: 60px;
            height: 60px;
            left: 45%;
            animation-delay: 10s;
        }
        @keyframes floatShape {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100px) rotate(360deg);
                opacity: 0;
            }
        }
    </style>
</head>
<body class="gradient-bg min-h-screen">

    <?php include 'includes/navbar.php'; // Panggil Navbar ?>

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('img/background.jpg')"></div>
        
        <!-- Animated Overlay -->
        <div class="absolute inset-0 bg-gradient-to-br from-green-500/80 via-green-600/70 to-green-700/80 animate-gradient-shift bg-[length:400%_400%]"></div>
        
        <!-- Floating Shapes -->
        <div class="floating-shapes">
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
        
        <!-- Overlay -->
        <div class="absolute inset-0 bg-black/20"></div>

        <!-- Content -->
        <div class="relative z-10 text-center max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-16">
            <div class="animate-fade-in">
                <h1 class="text-6xl md:text-8xl font-black text-white text-shadow mb-6 animate-bounce-gentle">
                    KONTAK
                </h1>
                <div class="w-32 h-1 bg-white mx-auto rounded-full animate-pulse-slow mb-8"></div>
                <p class="text-xl md:text-2xl text-green-100 font-light">
                    Hubungi Laboratorium Terpadu
                </p>
                <p class="text-lg text-green-200 mt-4 font-light">
                    Fakultas Tarbiyah dan Keguruan - UIN Raden Intan Lampung
                </p>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <svg class="w-6 h-6 text-white animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </section>

    <!-- Content Section with Breadcrumb -->
    <div class="py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Breadcrumb -->
            <nav class="mb-8 animate-fade-in-up">
                <ol class="flex items-center space-x-2 text-sm text-gray-600">
                    <li>
                        <a href="index.php" class="hover:text-green-primary transition-colors duration-200 flex items-center">
                            <i class="bi bi-house-door mr-1"></i>
                            Beranda
                        </a>
                    </li>
                    <li class="flex items-center">
                        <i class="bi bi-chevron-right mx-2 text-gray-400"></i>
                        <span class="text-green-primary font-medium">Kontak Kami</span>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <main class="px-4 sm:px-6 lg:px-8 pb-20">
        <div class="max-w-7xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-12 items-start">
                
                <!-- Contact Information -->
                <div class="animate-fade-in-left">
                    <div class="glass-effect rounded-3xl p-8 shadow-2xl card-hover border border-green-100">
                        <div class="flex items-center mb-8">
                            <div class="w-12 h-12 bg-gradient-to-r from-green-primary to-green-secondary rounded-full flex items-center justify-center mr-4 animate-pulse-slow">
                                <i class="bi bi-info-circle text-white text-xl"></i>
                            </div>
                            <h2 class="text-3xl font-bold text-gray-900">Informasi Kontak</h2>
                        </div>
                        
                        <div class="space-y-8">
                            <!-- Location -->
                            <div class="flex items-start group hover:bg-green-light/30 p-4 rounded-2xl transition-all duration-300">
                                <div class="w-14 h-14 bg-green-primary/10 rounded-2xl flex items-center justify-center mr-6 group-hover:bg-green-primary group-hover:scale-110 transition-all duration-300 animate-float">
                                    <i class="bi bi-geo-alt-fill text-2xl text-green-primary group-hover:text-white"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Lokasi Utama</h3>
                                    <p class="text-gray-600 leading-relaxed">
                                        Gedung Lab Terpadu Fakultas Tarbiyah dan Keguruan,<br>
                                        UIN Raden Intan Lampung
                                    </p>
                                </div>
                            </div>

                            <!-- Instagram -->
                            <div class="flex items-start group hover:bg-green-light/30 p-4 rounded-2xl transition-all duration-300">
                                <div class="w-14 h-14 bg-green-primary/10 rounded-2xl flex items-center justify-center mr-6 group-hover:bg-green-primary group-hover:scale-110 transition-all duration-300 animate-float" style="animation-delay: 1s;">
                                    <i class="bi bi-instagram text-2xl text-green-primary group-hover:text-white"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Instagram</h3>
                                    <a href="https://www.instagram.com/lab.terpaduuinril/" target="_blank" 
                                       class="text-green-primary hover:text-green-dark font-medium hover:underline transition-all duration-200 inline-flex items-center">
                                        @lab.terpaduuinril
                                        <i class="bi bi-arrow-up-right ml-1"></i>
                                    </a>
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="flex items-start group hover:bg-green-light/30 p-4 rounded-2xl transition-all duration-300">
                                <div class="w-14 h-14 bg-green-primary/10 rounded-2xl flex items-center justify-center mr-6 group-hover:bg-green-primary group-hover:scale-110 transition-all duration-300 animate-float" style="animation-delay: 2s;">
                                    <i class="bi bi-telephone-fill text-2xl text-green-primary group-hover:text-white"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Telepon</h3>
                                    <a href="tel:(0721)780887" class="text-gray-600 hover:text-green-primary font-medium transition-colors duration-200">
                                        (0721) 780887
                                    </a>
                                </div>
                            </div>

                            <!-- Full Address -->
                            <div class="flex items-start group hover:bg-green-light/30 p-4 rounded-2xl transition-all duration-300">
                                <div class="w-14 h-14 bg-green-primary/10 rounded-2xl flex items-center justify-center mr-6 group-hover:bg-green-primary group-hover:scale-110 transition-all duration-300 animate-float" style="animation-delay: 3s;">
                                    <i class="bi bi-pin-map-fill text-2xl text-green-primary group-hover:text-white"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Alamat Lengkap</h3>
                                    <p class="text-gray-600 leading-relaxed">
                                        Jl. Letnan Kolonel H. Endro Suratmin, Sukarame, Kec. Sukarame, 
                                        Kota Bandar Lampung, Lampung 35131
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Map Section -->
                <div class="animate-fade-in-right">
                    <div class="glass-effect rounded-3xl p-8 shadow-2xl card-hover border border-green-100">
                        <div class="flex items-center mb-8">
                            <div class="w-12 h-12 bg-gradient-to-r from-green-primary to-green-secondary rounded-full flex items-center justify-center mr-4 animate-pulse-slow">
                                <i class="bi bi-map text-white text-xl"></i>
                            </div>
                            <h3 class="text-3xl font-bold text-gray-900">Temukan Kami</h3>
                        </div>
                        
                        <div class="relative overflow-hidden rounded-2xl shadow-lg group">
                            <div class="aspect-video">
                                <iframe 
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3972.270480310328!2d105.3015793749336!3d-5.375700994627601!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40db5b76061255%3A0xda8d0dd733511d75!2sUniversitas%20Islam%20Negeri%20Raden%20Intan%20Lampung!5e0!3m2!1sid!2sid!4v1716000000000!5m2!1sid!2sid" 
                                    class="w-full h-full border-0 group-hover:scale-105 transition-transform duration-500"
                                    allowfullscreen="" 
                                    loading="lazy" 
                                    referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-green-primary/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
                        </div>
                        
                        <div class="mt-6 text-center">
                            <p class="text-gray-600 mb-4">
                                Klik pada peta untuk navigasi atau melihat lebih detail di Google Maps
                            </p>
                            <a href="https://maps.google.com" target="_blank" 
                               class="inline-flex items-center px-6 py-3 bg-green-primary text-white rounded-full hover:bg-green-dark transition-all duration-300 hover:shadow-lg hover:scale-105 font-medium">
                                <i class="bi bi-navigation mr-2"></i>
                                Buka di Google Maps
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="mt-20 text-center animate-fade-in-up">
                <div class="glass-effect rounded-3xl p-12 shadow-2xl border border-green-100 max-w-4xl mx-auto">
                    <div class="mb-8">
                        <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-r from-green-primary to-green-secondary rounded-full mb-6 animate-bounce-slow">
                            <i class="bi bi-chat-dots-fill text-4xl text-white"></i>
                        </div>
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                            Siap Membantu Anda
                        </h2>
                        <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                            Tim kami siap memberikan dukungan terbaik untuk kebutuhan laboratorium dan riset Anda
                        </p>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                        <a href="https://www.instagram.com/lab.terpaduuinril/" target="_blank"
                           class="inline-flex items-center px-8 py-4 bg-green-primary text-white rounded-full hover:bg-green-dark transition-all duration-300 hover:shadow-lg hover:scale-105 font-medium text-lg">
                            <i class="bi bi-instagram mr-3"></i>
                            Follow Instagram Kami
                        </a>
                        <a href="tel:(0721)780887"
                           class="inline-flex items-center px-8 py-4 bg-white text-green-primary border-2 border-green-primary rounded-full hover:bg-green-primary hover:text-white transition-all duration-300 hover:shadow-lg hover:scale-105 font-medium text-lg">
                            <i class="bi bi-telephone-fill mr-3"></i>
                            Hubungi Langsung
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-green-primary to-green-dark text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <div class="mb-6">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 rounded-full mb-4">
                        <i class="bi bi-building text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-2">Lab Terpadu UIN Lampung</h3>
                </div>
                <p class="text-green-light mb-4 text-lg">
                    © Copyright © <?php echo date("Y"); ?> Universitas Islam Negeri Raden Intan Lampung, All rights reserved.
                </p>
                <p class="text-green-light/80">
                    Jl. Letnan Kolonel H. Endro Suratmin, Sukarame, Kota Bandar Lampung, 35131
                </p>
            </div>
        </div>
    </footer>

    <script>
        // Add scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('opacity-100');
                    entry.target.classList.remove('opacity-0');
                }
            });
        }, observerOptions);

        // Observe all animated elements
        document.addEventListener('DOMContentLoaded', () => {
            const animatedElements = document.querySelectorAll('[class*="animate-"]');
            animatedElements.forEach(el => {
                el.classList.add('opacity-0');
                observer.observe(el);
            });
        });

        // Add floating animation delay for contact icons
        document.querySelectorAll('.animate-float').forEach((el, index) => {
            el.style.animationDelay = `${index * 0.5}s`;
        });
    </script>
</body>
</html>