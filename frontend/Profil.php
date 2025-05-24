<?php
session_start(); // Untuk navbar
$path_prefix_frontend = ""; // Karena file ini di root frontend/
$page_title = "Kontak Kami";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil - Lab Terpadu FTK</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'fade-in': 'fadeIn 0.8s ease-in-out',
                        'slide-up': 'slideUp 0.6s ease-out',
                        'bounce-gentle': 'bounceGentle 2s infinite',
                        'pulse-slow': 'pulse 3s infinite',
                        'gradient-shift': 'gradientShift 8s ease-in-out infinite',
                        'float': 'float 3s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        slideUp: {
                            '0%': { opacity: '0', transform: 'translateY(50px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        bounceGentle: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' }
                        },
                        gradientShift: {
                            '0%, 100%': { backgroundPosition: '0% 50%' },
                            '50%': { backgroundPosition: '100% 50%' }
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0px) rotate(0deg)' },
                            '33%': { transform: 'translateY(-10px) rotate(2deg)' },
                            '66%': { transform: 'translateY(-5px) rotate(-1deg)' }
                        }
                    },
                    backgroundImage: {
                        'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
                        'hero-pattern': 'linear-gradient(135deg, rgba(16, 185, 129, 0.9) 0%, rgba(5, 150, 105, 0.9) 100%)',
                    }
                }
            }
        }
    </script>
    <style>
        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .text-shadow {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        
        .hover-lift {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .hover-lift:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(16, 185, 129, 0.3);
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #10b981, #059669, #047857);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }
        
        .shape {
            position: absolute;
            background: rgba(16, 185, 129, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }
        
        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }
        
        .shape:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 60%;
            right: 15%;
            animation-delay: 2s;
        }
        
        .shape:nth-child(3) {
            width: 60px;
            height: 60px;
            bottom: 30%;
            left: 70%;
            animation-delay: 4s;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-50 to-green-50 min-h-screen">
    <!-- Modern Navbar -->
    <?php include 'includes/navbar.php'; // MEMANGGIL NAVBAR ?>


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
                    PROFIL
                </h1>
                <div class="w-32 h-1 bg-white mx-auto rounded-full animate-pulse-slow"></div>
                <p class="text-xl md:text-2xl text-green-100 mt-8 font-light">
                    Laboratorium Terpadu Fakultas Tarbiyah dan Keguruan
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

    <!-- Main Content -->
    <main class="relative z-10 -mt-20">
        <!-- Leadership Cards -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
            <div class="grid lg:grid-cols-2 gap-8">
                <!-- Ketua Lab Card -->
                <div class="glass-effect rounded-3xl p-8 hover-lift animate-slide-up">
                    <div class="text-center">
                        <div class="w-24 h-24 bg-gradient-to-br from-green-500 to-green-600 rounded-full mx-auto mb-6 flex items-center justify-center shadow-lg">
                            <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="mb-4">
                            <span class="inline-block bg-green-100 text-green-800 text-sm font-semibold px-4 py-2 rounded-full mb-3">
                                Ketua Laboratorium
                            </span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Dr. H. Mujib, M.Pd</h3>
                        <div class="w-16 h-1 bg-gradient-to-r from-green-500 to-green-600 mx-auto rounded-full"></div>
                    </div>
                </div>

                <!-- Sekretaris Card -->
                <div class="glass-effect rounded-3xl p-8 hover-lift animate-slide-up" style="animation-delay: 0.2s;">
                    <div class="text-center">
                        <div class="w-24 h-24 bg-gradient-to-br from-green-500 to-green-600 rounded-full mx-auto mb-6 flex items-center justify-center shadow-lg">
                            <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="mb-4">
                            <span class="inline-block bg-green-100 text-green-800 text-sm font-semibold px-4 py-2 rounded-full mb-3">
                                Sekretaris
                            </span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Aditia Fradito, M.Pd.I</h3>
                        <div class="w-16 h-1 bg-gradient-to-r from-green-500 to-green-600 mx-auto rounded-full"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Description Section -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
            <div class="bg-white rounded-3xl shadow-xl p-8 md:p-12 hover-lift animate-slide-up" style="animation-delay: 0.4s;">
                <div class="text-center mb-12">
                    <h2 class="text-4xl md:text-5xl font-bold gradient-text mb-6">Tentang Laboratorium</h2>
                    <div class="w-24 h-1 bg-gradient-to-r from-green-500 to-green-600 mx-auto rounded-full"></div>
                </div>
                
                <div class="prose prose-lg mx-auto text-gray-700 leading-relaxed">
                    <p class="text-xl text-center mb-8 font-light">
                        Laboratorium Terpadu FTK UIN Raden Intan Lampung memberikan pelayanan kepada mahasiswa dan dosen untuk pelaksanaan praktikum yang menggunakan laboratorium <span class="font-semibold text-green-600">Biologi, Fisika, Komputer, PAI, Bimbingan Konseling, dan Microteaching</span>.
                    </p>
                    <p class="text-lg text-center">
                        Selain itu, kegiatan <span class="font-semibold text-green-600">PPL (Praktik Pengalaman Lapangan)</span> dan <span class="font-semibold text-green-600">PPI (Praktik Pengamalan Ibadah)</span> juga dikelola di Lab Terpadu khususnya di sekretariat Lab Terpadu.
                    </p>
                </div>
            </div>
        </section>

        <!-- Services Grid -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold gradient-text mb-6">Layanan Laboratorium</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-green-500 to-green-600 mx-auto rounded-full"></div>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Service Cards -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover-lift animate-slide-up" style="animation-delay: 0.1s;">
                    <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Laboratorium Biologi</h3>
                    <p class="text-gray-600">Fasilitas praktikum biologi dengan peralatan modern dan lengkap</p>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-lg hover-lift animate-slide-up" style="animation-delay: 0.2s;">
                    <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Laboratorium Fisika</h3>
                    <p class="text-gray-600">Praktikum fisika dengan teknologi terdepan untuk pembelajaran optimal</p>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-lg hover-lift animate-slide-up" style="animation-delay: 0.3s;">
                    <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2h-2.22l.123.489.804.804A1 1 0 0113 18H7a1 1 0 01-.707-1.707l.804-.804L7.22 15H5a2 2 0 01-2-2V5zm5.771 7H5V5h10v7H8.771z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Laboratorium Komputer</h3>
                    <p class="text-gray-600">Lab komputer dengan software terbaru untuk pembelajaran teknologi</p>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-lg hover-lift animate-slide-up" style="animation-delay: 0.4s;">
                    <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Laboratorium PAI</h3>
                    <p class="text-gray-600">Fasilitas pembelajaran Pendidikan Agama Islam yang komprehensif</p>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-lg hover-lift animate-slide-up" style="animation-delay: 0.5s;">
                    <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Bimbingan Konseling</h3>
                    <p class="text-gray-600">Ruang praktik konseling dengan suasana yang mendukung</p>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-lg hover-lift animate-slide-up" style="animation-delay: 0.6s;">
                    <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Microteaching</h3>
                    <p class="text-gray-600">Studio microteaching untuk latihan mengajar dengan teknologi recording</p>
                </div>
            </div>
        </section>
    </main>

    <!-- Modern Footer -->
    <footer class="bg-gradient-to-r from-green-800 to-green-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid md:grid-cols-3 gap-8 text-center md:text-left">
                <div>
                    <div class="flex items-center justify-center md:justify-start space-x-3 mb-4">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                            </svg>
                        </div>
                        <span class="text-xl font-bold">Lab Terpadu FTK</span>
                    </div>
                    <p class="text-green-200 mb-4">
                        Universitas Islam Negeri<br>
                        Raden Intan Lampung
                    </p>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Navigasi</h4>
                    <div class="space-y-2">
                        <a href="#" class="block text-green-200 hover:text-white transition-colors duration-200">Beranda</a>
                        <a href="#" class="block text-white font-semibold">Profil</a>
                        <a href="#" class="block text-green-200 hover:text-white transition-colors duration-200">Kontak</a>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Alamat</h4>
                    <p class="text-green-200">
                        Jl. Letnan Kolonel H. Endro Suratmin<br>
                        Sukarame, Kota Bandar Lampung<br>
                        35131
                    </p>
                </div>
            </div>
            
            <div class="border-t border-green-700 mt-8 pt-8 text-center">
                <p class="text-green-200">
                    &copy; 2021 Universitas Islam Negeri Raden Intan Lampung. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Add scroll effect to navbar
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('nav');
            if (window.scrollY > 100) {
                navbar.classList.add('bg-white/95');
                navbar.classList.remove('bg-white/80');
            } else {
                navbar.classList.add('bg-white/80');
                navbar.classList.remove('bg-white/95');
            }
        });

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in');
                }
            });
        }, observerOptions);

        // Observe all animated elements
        document.querySelectorAll('.animate-slide-up').forEach(el => {
            observer.observe(el);
        });
    </script>
</body>

</html>