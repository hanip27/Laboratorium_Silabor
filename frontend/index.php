<?php
session_start(); // Pastikan session dimulai jika belum (untuk tombol login/logout)

// --- KONEKSI DATABASE ---
// Asumsi file db.php ada di folder backend
// Sesuaikan path jika struktur Anda berbeda
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "silabor";

$conn_frontend = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn_frontend->connect_error) {
    // Sebaiknya tidak menampilkan error detail di frontend
    // die("Koneksi gagal: " . $conn_frontend->connect_error);
    // Mungkin redirect ke halaman error atau tampilkan pesan umum
    error_log("Koneksi database gagal di frontend/index.php: " . $conn_frontend->connect_error);
    // Untuk sementara, kita biarkan, tapi idealnya ada penanganan error yang lebih baik
}

// --- AMBIL DATA BERITA TERBARU (misalnya 6 berita) ---
$berita_list = [];
$sql_get_berita_terbaru = "SELECT id_berita, judul, isi, gambar_thumbnail, tanggal_publish 
                           FROM berita 
                           ORDER BY tanggal_publish DESC 
                           LIMIT 6"; // Ambil 6 berita terbaru
$result_berita_terbaru = $conn_frontend->query($sql_get_berita_terbaru);
if ($result_berita_terbaru && $result_berita_terbaru->num_rows > 0) {
    while ($row = $result_berita_terbaru->fetch_assoc()) {
        $berita_list[] = $row;
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Homepage - Lab Terpadu UIN Lampung</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        }
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.8s ease-in-out',
                        'slide-up': 'slideUp 0.6s ease-out',
                        'slide-down': 'slideDown 0.6s ease-out',
                        'scale-in': 'scaleIn 0.5s ease-out',
                        'float': 'float 3s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': {
                                opacity: '0'
                            },
                            '100%': {
                                opacity: '1'
                            }
                        },
                        slideUp: {
                            '0%': {
                                transform: 'translateY(30px)',
                                opacity: '0'
                            },
                            '100%': {
                                transform: 'translateY(0)',
                                opacity: '1'
                            }
                        },
                        slideDown: {
                            '0%': {
                                transform: 'translateY(-30px)',
                                opacity: '0'
                            },
                            '100%': {
                                transform: 'translateY(0)',
                                opacity: '1'
                            }
                        },
                        scaleIn: {
                            '0%': {
                                transform: 'scale(0.9)',
                                opacity: '0'
                            },
                            '100%': {
                                transform: 'scale(1)',
                                opacity: '1'
                            }
                        },
                        float: {
                            '0%, 100%': {
                                transform: 'translateY(0px)'
                            },
                            '50%': {
                                transform: 'translateY(-10px)'
                            }
                        }
                    }
                }
            }
        }
    </script>

    <style>
        html {
            scroll-behavior: smooth;
        }

        .hero-bg {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.9) 0%, rgba(21, 128, 61, 0.9) 100%),
                url('img/background.jpg') center center / cover no-repeat;
        }

        .glass {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .hover-lift {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hover-lift:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(34, 197, 94, 0.15);
        }

        .gradient-text {
            background: linear-gradient(135deg, #22c55e, #15803d);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .animate-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease-out;
        }

        .animate-on-scroll.animate {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Navbar -->
    <?php include 'includes/navbar.php'; ?>

    <!-- Hero Section -->
    <section class="hero-bg min-h-screen flex items-center justify-center relative overflow-hidden">
        <!-- Floating Elements -->
        <div class="absolute top-20 left-10 w-20 h-20 bg-white/10 rounded-full animate-float"></div>
        <div class="absolute bottom-32 right-16 w-16 h-16 bg-white/10 rounded-full animate-float" style="animation-delay: 1s;"></div>
        <div class="absolute top-1/3 right-20 w-12 h-12 bg-white/10 rounded-full animate-float" style="animation-delay: 2s;"></div>

        <div class="container mx-auto px-6 text-center text-white animate-fade-in">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-5xl md:text-7xl font-bold mb-6 animate-slide-down">
                    Selamat datang di
                    <span class="block text-transparent bg-clip-text bg-gradient-to-r from-green-300 to-emerald-200">
                        Laboratorium Terpadu
                    </span>
                    <span class="text-4xl md:text-6xl font-extrabold">UINRIL</span>
                </h1>
                <p class="text-xl md:text-2xl mb-8 leading-relaxed text-green-100 animate-slide-up">
                    Pusat layanan laboratorium terpadu untuk mendukung kegiatan praktikum, penelitian, dan pengujian.
                    Dilengkapi fasilitas modern dan tenaga profesional yang aman dan terpercaya.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center animate-scale-in">
                    <a href="<?php echo $path_prefix_frontend; ?>Profil.php">
                        <button class="bg-white text-green-700 px-8 py-4 rounded-full font-semibold text-lg hover:bg-green-50 transition-all duration-300 hover:scale-105 shadow-lg">
                            Jelajahi Layanan
                        </button>
                    </a>
                    <a href="<?php echo $path_prefix_frontend; ?>kontak.php">
                        <button class="border-2 border-white text-white px-8 py-4 rounded-full font-semibold text-lg hover:bg-white hover:text-green-700 transition-all duration-300 hover:scale-105">
                            Hubungi Kami
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-20 bg-gradient-to-br from-gray-50 to-green-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 animate-on-scroll">
                <h2 class="text-4xl md:text-5xl font-bold gradient-text mb-4">Layanan Kami</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Fasilitas lengkap untuk mendukung kegiatan akademik dan penelitian Anda
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <!-- Penelitian Card -->
                <div class="group animate-on-scroll hover-lift" style="animation-delay: 0.1s;">
                    <div class="bg-white rounded-3xl p-8 shadow-lg border border-green-100 h-full">
                        <div class="bg-gradient-to-br from-emerald-400 to-emerald-600 w-20 h-20 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <img src="img/penelitian.png" alt="Penelitian" class="w-12 h-12 filter brightness-0 invert">
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Penelitian</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Dosen, mahasiswa, atau mitra eksternal dapat mengajukan permohonan penggunaan lab untuk penelitian atau pengujian sampel.
                        </p>

                    </div>
                </div>

                <!-- Publikasi Card -->
                <div class="group animate-on-scroll hover-lift" style="animation-delay: 0.2s;">
                    <div class="bg-white rounded-3xl p-8 shadow-lg border border-green-100 h-full">
                        <div class="bg-gradient-to-br from-teal-400 to-teal-600 w-20 h-20 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <img src="img/parani.png" alt="Publikasi" class="w-12 h-12 filter brightness-0 invert">
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Publikasi</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Menyediakan dokumentasi kegiatan laboratorium seperti pelatihan, seminar, workshop, dan hasil riset.
                        </p>
                        <div class="mt-6">

                        </div>
                    </div>
                </div>

                <!-- Jadwal Card -->
                <div class="group animate-on-scroll hover-lift" style="animation-delay: 0.3s;">
                    <div class="bg-white rounded-3xl p-8 shadow-lg border border-green-100 h-full">
                        <div class="bg-gradient-to-br from-lime-400 to-lime-600 w-20 h-20 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <img src="img/jadwal.png" alt="Jadwal" class="w-12 h-12 filter brightness-0 invert">
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Jadwal</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Update jadwal penggunaan laboratorium, info ruangan, dan ketersediaan alat secara real-time.
                        </p>
                        <div class="mt-6">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-20 bg-gradient-to-r from-green-600 to-emerald-700 text-white">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="animate-on-scroll">
                    <img src="img/Uinnih.png" alt="UIN Lampung" class="w-full max-w-lg mx-auto rounded-3xl shadow-2xl hover:scale-105 transition-transform duration-500">
                </div>
                <div class="animate-on-scroll">
                    <h2 class="text-4xl md:text-5xl font-bold mb-8">
                        Apa Itu <span class="text-green-300">Laboratorium Terpadu?</span>
                    </h2>
                    <div class="space-y-6 text-lg leading-relaxed">
                        <p class="text-green-100">
                            Laboratorium Terpadu adalah sebuah unit laboratorium yang menggabungkan berbagai jenis laboratorium dari berbagai jurusan atau fakultas dalam satu sistem terintegrasi. Tujuannya adalah untuk memaksimalkan penggunaan fasilitas, meningkatkan efisiensi, dan mendukung kegiatan akademik serta penelitian lintas disiplin.
                        </p>
                        <p class="text-green-100">
                            Di UIN Raden Intan Lampung, Laboratorium Terpadu dirancang sebagai pusat layanan praktikum, riset, dan pengujian ilmiah dengan fasilitas modern dan dukungan tenaga ahli. Laboratorium ini tidak hanya melayani kebutuhan internal kampus, tetapi juga terbuka untuk kerja sama eksternal seperti pengujian sampel atau penelitian bersama.
                        </p>
                    </div>
                    <div class="mt-8">
                        <a href="<?php echo $path_prefix_frontend; ?>Profil.php">
                            <button class="bg-white text-green-700 px-8 py-4 rounded-full font-semibold text-lg hover:bg-green-50 transition-all duration-300 hover:scale-105 shadow-lg">
                                Pelajari Lebih Lanjut
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 animate-on-scroll">
                <h2 class="text-4xl md:text-5xl font-bold gradient-text mb-4">Artikel & Berita Terbaru</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Dapatkan informasi terkini seputar kegiatan dan perkembangan laboratorium
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php if (!empty($berita_list)): ?>
                    <?php foreach ($berita_list as $index => $berita_item): ?>
                        <article class="group hover-lift animate-on-scroll" style="animation-delay: <?php echo $index * 0.1; ?>s;">
                            <div class="bg-white rounded-3xl overflow-hidden shadow-lg border border-gray-100 h-full">
                                <?php
                                $gambar_url = "img/default_berita.jpg";
                                if (!empty($berita_item['gambar_thumbnail'])) {
                                    $gambar_url = "img/berita_thumbnails/" . htmlspecialchars($berita_item['gambar_thumbnail']);
                                }
                                ?>
                                <div class="relative overflow-hidden">
                                    <img src="<?php echo $gambar_url; ?>"
                                        class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-500"
                                        alt="<?php echo htmlspecialchars($berita_item['judul']); ?>">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                                </div>

                                <div class="p-8">
                                    <div class="flex items-center text-green-600 text-sm font-semibold mb-3">
                                        <i class="bi bi-calendar-event mr-2"></i>
                                        <?php echo date('d M Y', strtotime($berita_item['tanggal_publish'])); ?>
                                    </div>

                                    <h3 class="text-xl font-bold text-gray-800 mb-4 line-clamp-2 group-hover:text-green-700 transition-colors">
                                        <?php echo htmlspecialchars($berita_item['judul']); ?>
                                    </h3>

                                    <p class="text-gray-600 leading-relaxed mb-6 line-clamp-3">
                                        <?php
                                        $ringkasan = strip_tags($berita_item['isi']);
                                        if (strlen($ringkasan) > 120) {
                                            $ringkasan = substr($ringkasan, 0, 120) . "...";
                                        }
                                        echo htmlspecialchars($ringkasan);
                                        ?>
                                    </p>

                                    <a href="Berita.php#berita-<?php echo $berita_item['id_berita']; ?>"
                                        class="inline-flex items-center text-green-600 font-semibold hover:text-green-700 transition-colors">
                                        Baca Selengkapnya
                                        <i class="bi bi-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-span-full text-center py-12">
                        <div class="text-gray-400 text-6xl mb-4">
                            <i class="bi bi-newspaper"></i>
                        </div>
                        <p class="text-xl text-gray-500">Belum ada berita terbaru saat ini.</p>
                    </div>
                <?php endif; ?>
            </div>

            <?php if (count($berita_list) >= 6): ?>
                <div class="text-center mt-12 animate-on-scroll">
                    <a href="Berita.php"
                        class="inline-flex items-center bg-gradient-to-r from-green-600 to-emerald-600 text-white px-8 py-4 rounded-full font-semibold text-lg hover:from-green-700 hover:to-emerald-700 transition-all duration-300 hover:scale-105 shadow-lg">
                        Lihat Semua Berita
                        <i class="bi bi-arrow-right ml-2"></i>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 animate-on-scroll">
                <h2 class="text-4xl md:text-5xl font-bold gradient-text mb-4">Hubungi Kami</h2>
                <p class="text-xl text-gray-600">Temukan lokasi kami dan jangan ragu untuk menghubungi</p>
            </div>

            <div class="max-w-4xl mx-auto animate-on-scroll">
                <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-3xl p-8 shadow-xl border border-green-100">
                    <div class="rounded-2xl overflow-hidden shadow-lg">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1404.3906531339483!2d105.30369236518897!3d-5.383915193909608!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40db5b76061255%3A0xda8d0dd733511d75!2sUniversitas%20Islam%20Negeri%20Raden%20Intan%20Lampung!5e0!3m2!1sid!2sid!4v1744550317894!5m2!1sid!2sid"
                            width="100%"
                            height="400"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            class="w-full">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-green-800 to-emerald-900 text-white py-12">
        <div class="container mx-auto px-6 text-center">
            <div class="mb-6">
                <h3 class="text-2xl font-bold mb-2">Laboratorium Terpadu UINRIL</h3>
                <p class="text-green-200">Memajukan pendidikan dan penelitian dengan fasilitas terdepan</p>
            </div>

            <div class="border-t border-green-700 pt-6">
                <p class="text-green-100 mb-2">
                    © Copyright <?php echo date("Y"); ?> Universitas Islam Negeri Raden Intan Lampung, All rights reserved.
                </p>
                <p class="text-sm text-green-300">
                    Jl. Letnan Kolonel H. Endro Suratmin, Sukarame, Kota Bandar Lampung, 35131
                </p>
            </div>
        </div>
    </footer>

    <!-- JavaScript untuk animasi scroll -->
    <script>
        // Intersection Observer untuk animasi saat scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate');
                }
            });
        }, observerOptions);

        // Observe semua elemen dengan class animate-on-scroll
        document.addEventListener('DOMContentLoaded', () => {
            const animateElements = document.querySelectorAll('.animate-on-scroll');
            animateElements.forEach(el => observer.observe(el));
        });

        // Smooth scrolling untuk anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>

</html>
<?php
if (isset($conn_frontend)) {
    $conn_frontend->close(); // Tutup koneksi jika sudah dibuka
}
?>