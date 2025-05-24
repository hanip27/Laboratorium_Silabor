<?php
session_start(); // Untuk navbar

// --- KONEKSI DATABASE ---
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "silabor";

$conn_frontend = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn_frontend->connect_error) {
    error_log("Koneksi database gagal di frontend/Berita.php: " . $conn_frontend->connect_error);
    // Tampilkan pesan error umum atau redirect
    die("Terjadi kesalahan pada server. Silakan coba lagi nanti.");
}

$detail_berita = null;
$semua_berita_list = [];
$is_detail_page = false;

// Cek apakah ada parameter id_berita untuk tampilan detail
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $is_detail_page = true;
    $id_berita_lihat = intval($_GET['id']);

    $sql_detail = "SELECT b.id_berita, b.judul, b.isi, b.gambar_thumbnail, b.tanggal_publish, u.username AS pembuat
                   FROM berita b
                   LEFT JOIN users u ON b.id_user_pembuat = u.id_user
                   WHERE b.id_berita = ? 
                   LIMIT 1";
    $stmt_detail = $conn_frontend->prepare($sql_detail);
    $stmt_detail->bind_param("i", $id_berita_lihat);
    $stmt_detail->execute();
    $result_detail = $stmt_detail->get_result();
    if ($result_detail && $result_detail->num_rows > 0) {
        $detail_berita = $result_detail->fetch_assoc();
    }
    $stmt_detail->close();
} else {
    // Jika bukan halaman detail, tampilkan daftar semua berita (dengan pagination sederhana)
    $is_detail_page = false;
    $berita_per_halaman = 6; // Jumlah berita per halaman
    $halaman_aktif = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($halaman_aktif - 1) * $berita_per_halaman;

    // Hitung total berita untuk pagination
    $sql_total_berita = "SELECT COUNT(id_berita) AS total FROM berita";
    $result_total = $conn_frontend->query($sql_total_berita);
    $total_berita = ($result_total && $result_total->num_rows > 0) ? $result_total->fetch_assoc()['total'] : 0;
    $total_halaman = ceil($total_berita / $berita_per_halaman);

    $sql_semua_berita = "SELECT id_berita, judul, isi, gambar_thumbnail, tanggal_publish 
                         FROM berita 
                         ORDER BY tanggal_publish DESC 
                         LIMIT ? OFFSET ?";
    $stmt_semua = $conn_frontend->prepare($sql_semua_berita);
    $stmt_semua->bind_param("ii", $berita_per_halaman, $offset);
    $stmt_semua->execute();
    $result_semua = $stmt_semua->get_result();
    if ($result_semua && $result_semua->num_rows > 0) {
        while ($row = $result_semua->fetch_assoc()) {
            $semua_berita_list[] = $row;
        }
    }
    $stmt_semua->close();
}

$page_title = $is_detail_page && $detail_berita ? htmlspecialchars($detail_berita['judul']) : "Berita & Informasi Laboratorium";
?>
<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $page_title; ?> - Lab Terpadu UIN Lampung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body { 
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            min-height: 100vh;
        }
        
        .navbar { 
            background: linear-gradient(135deg, #166534 0%, #15803d 100%) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(21, 128, 61, 0.2);
        }
        
        .navbar-brand img {
            width: 50px; 
            height: 50px;
            transition: transform 0.3s ease;
        }
        
        .navbar-brand:hover img {
            transform: scale(1.1);
        }
        
        .main-content {
            min-height: calc(100vh - 160px);
        }
        
        .footer { 
            background: linear-gradient(135deg, #166534 0%, #15803d 100%);
            color: white;
        }
        
        .news-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(34, 197, 94, 0.1);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .news-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.05) 0%, rgba(21, 128, 61, 0.05) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: inherit;
        }
        
        .news-card:hover::before {
            opacity: 1;
        }
        
        .news-card:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(34, 197, 94, 0.25);
            border-color: rgba(34, 197, 94, 0.3);
        }
        
        .news-card-img {
            transition: transform 0.4s ease;
        }
        
        .news-card:hover .news-card-img {
            transform: scale(1.1);
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #166534 0%, #22c55e 100%);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .btn-gradient {
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            border: none;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-gradient::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }
        
        .btn-gradient:hover::before {
            left: 100%;
        }
        
        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(34, 197, 94, 0.3);
        }
        
        .fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }
        
        .slide-up {
            animation: slideUp 0.8s ease-out forwards;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .stagger-1 { animation-delay: 0.1s; }
        .stagger-2 { animation-delay: 0.2s; }
        .stagger-3 { animation-delay: 0.3s; }
        .stagger-4 { animation-delay: 0.4s; }
        .stagger-5 { animation-delay: 0.5s; }
        .stagger-6 { animation-delay: 0.6s; }
        
        .breadcrumb-modern {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(34, 197, 94, 0.1);
        }
        
        .detail-content {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(34, 197, 94, 0.1);
        }
        
        .pagination-modern .page-link {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(34, 197, 94, 0.2);
            color: #166534;
            transition: all 0.3s ease;
        }
        
        .pagination-modern .page-link:hover {
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            color: white;
            transform: translateY(-2px);
        }
        
        .pagination-modern .page-item.active .page-link {
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            border-color: #16a34a;
        }
        
        .floating-elements {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }
        
        .floating-circle {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(34, 197, 94, 0.1) 0%, transparent 70%);
            animation: float 6s ease-in-out infinite;
        }
        
        .floating-circle:nth-child(1) {
            width: 300px;
            height: 300px;
            top: 10%;
            right: 10%;
            animation-delay: 0s;
        }
        
        .floating-circle:nth-child(2) {
            width: 200px;
            height: 200px;
            bottom: 20%;
            left: 5%;
            animation-delay: 2s;
        }
        
        .floating-circle:nth-child(3) {
            width: 150px;
            height: 150px;
            top: 60%;
            right: 30%;
            animation-delay: 4s;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-20px) rotate(120deg); }
            66% { transform: translateY(10px) rotate(240deg); }
        }
        
        /* Hero Section Styles */
        .text-shadow {
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .animate-gradient-shift {
            animation: gradient-shift 8s ease infinite;
        }
        
        @keyframes gradient-shift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        
        .animate-bounce-gentle {
            animation: bounce-gentle 3s ease-in-out infinite;
        }
        
        @keyframes bounce-gentle {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        
        .animate-pulse-slow {
            animation: pulse-slow 3s ease-in-out infinite;
        }
        
        @keyframes pulse-slow {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        
        .animate-fade-in {
            animation: fade-in-hero 1.5s ease-out forwards;
        }
        
        @keyframes fade-in-hero {
            from { 
                opacity: 0; 
                transform: translateY(30px); 
            }
            to { 
                opacity: 1; 
                transform: translateY(0); 
            }
        }
        
        .floating-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }
        
        .floating-shapes .shape {
            position: absolute;
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float-shapes 15s infinite linear;
        }
        
        .floating-shapes .shape:nth-child(1) {
            left: 10%;
            animation-delay: 0s;
            animation-duration: 20s;
        }
        
        .floating-shapes .shape:nth-child(2) {
            left: 50%;
            animation-delay: 5s;
            animation-duration: 25s;
            width: 150px;
            height: 150px;
        }
        
        .floating-shapes .shape:nth-child(3) {
            left: 80%;
            animation-delay: 10s;
            animation-duration: 18s;
            width: 80px;
            height: 80px;
        }
        
        @keyframes float-shapes {
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

<body class="relative">
    <!-- Floating Background Elements -->
    <div class="floating-elements">
        <div class="floating-circle"></div>
        <div class="floating-circle"></div>
        <div class="floating-circle"></div>
    </div>

    <!-- Navbar (Sama seperti di index.php) -->
    <?php include 'includes/navbar.php'; // MEMANGGIL NAVBAR ?>

    <!-- Akhir Navbar -->

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
                <?php if ($is_detail_page && $detail_berita): ?>
                    <h1 class="text-5xl md:text-7xl font-black text-white text-shadow mb-6 animate-bounce-gentle">
                        BERITA
                    </h1>
                    <div class="w-32 h-1 bg-white mx-auto rounded-full animate-pulse-slow mb-8"></div>
                    <p class="text-xl md:text-2xl text-green-100 font-light max-w-3xl mx-auto leading-relaxed">
                        <?php echo htmlspecialchars($detail_berita['judul']); ?>
                    </p>
                <?php else: ?>
                    <h1 class="text-6xl md:text-8xl font-black text-white text-shadow mb-6 animate-bounce-gentle">
                        BERITA
                    </h1>
                    <div class="w-32 h-1 bg-white mx-auto rounded-full animate-pulse-slow mb-8"></div>
                    <p class="text-xl md:text-2xl text-green-100 font-light">
                        Informasi Terkini Laboratorium Terpadu
                    </p>
                    <p class="text-lg text-green-200 mt-4 font-light">
                        Fakultas Tarbiyah dan Keguruan - UIN Raden Intan Lampung
                    </p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <svg class="w-6 h-6 text-white animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </section>

    <main class="container mx-auto px-4 py-8 main-content relative z-10">
        <?php if ($is_detail_page): ?>
            <?php if ($detail_berita): ?>
                <!-- Breadcrumb Modern -->
                <nav class="mb-8 fade-in">
                    <div class="breadcrumb-modern rounded-2xl px-6 py-4 shadow-lg">
                        <ol class="flex items-center space-x-2 text-sm font-medium">
                            <li><a href="index.php" class="text-green-600 hover:text-green-800 transition-colors duration-300">🏠 Beranda</a></li>
                            <li class="text-green-400">/</li>
                            <li><a href="Berita.php" class="text-green-600 hover:text-green-800 transition-colors duration-300">📰 Berita</a></li>
                            <li class="text-green-400">/</li>
                            <li class="text-gray-600 truncate max-w-xs"><?php echo htmlspecialchars($detail_berita['judul']); ?></li>
                        </ol>
                    </div>
                </nav>

                <!-- Detail Article -->
                <article class="detail-content rounded-3xl p-8 shadow-2xl fade-in" id="berita-<?php echo $detail_berita['id_berita']; ?>">
                    <div class="mb-6">
                        <h1 class="text-4xl md:text-5xl font-bold gradient-text mb-6 leading-tight"><?php echo htmlspecialchars($detail_berita['judul']); ?></h1>
                        
                        <div class="flex flex-wrap items-center gap-6 text-gray-600 text-sm">
                            <div class="flex items-center gap-2 bg-green-50 px-4 py-2 rounded-full">
                                <i class="bi bi-calendar-event text-green-600"></i>
                                <span><?php echo date('d F Y, H:i', strtotime($detail_berita['tanggal_publish'])); ?></span>
                            </div>
                            <?php if(!empty($detail_berita['pembuat'])): ?>
                                <div class="flex items-center gap-2 bg-green-50 px-4 py-2 rounded-full">
                                    <i class="bi bi-person-fill text-green-600"></i>
                                    <span>Oleh: <?php echo htmlspecialchars($detail_berita['pembuat']); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="w-full h-px bg-gradient-to-r from-transparent via-green-300 to-transparent mb-8"></div>

                    <?php if (!empty($detail_berita['gambar_thumbnail'])): ?>
                        <div class="mb-8 text-center">
                            <div class="relative inline-block rounded-2xl overflow-hidden shadow-2xl">
                                <img src="img/berita_thumbnails/<?php echo htmlspecialchars($detail_berita['gambar_thumbnail']); ?>" 
                                     alt="<?php echo htmlspecialchars($detail_berita['judul']); ?>" 
                                     class="max-w-full h-auto max-h-96 object-cover transition-transform duration-500 hover:scale-105">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="prose prose-lg max-w-none" style="text-align: justify; line-height: 1.8;">
                        <div class="text-gray-700 text-lg leading-relaxed">
                            <?php echo nl2br(htmlspecialchars($detail_berita['isi'])); ?>
                        </div>
                    </div>
                </article>

                <div class="mt-8 fade-in">
                    <a href="Berita.php" class="inline-flex items-center gap-3 btn-gradient text-white px-8 py-4 rounded-2xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300">
                        <i class="bi bi-arrow-left text-lg"></i>
                        <span>Kembali ke Daftar Berita</span>
                    </a>
                </div>

            <?php else: ?>
                <div class="text-center py-16 fade-in">
                    <div class="bg-yellow-50 border-2 border-yellow-200 rounded-3xl p-12 shadow-xl">
                        <div class="text-6xl mb-6">📰</div>
                        <h2 class="text-2xl font-bold text-yellow-800 mb-4">Berita Tidak Ditemukan</h2>
                        <p class="text-yellow-700 mb-8">Maaf, berita yang Anda cari tidak dapat ditemukan atau mungkin telah dihapus.</p>
                        <a href="Berita.php" class="btn-gradient text-white px-8 py-4 rounded-2xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300">
                            Lihat Semua Berita
                        </a>
                    </div>
                </div>
            <?php endif; ?>

        <?php else: // Tampilan daftar semua berita ?>
            <!-- Breadcrumb Modern -->
            <nav class="mb-8 fade-in">
                <div class="breadcrumb-modern rounded-2xl px-6 py-4 shadow-lg">
                    <ol class="flex items-center space-x-2 text-sm font-medium">
                        <li><a href="index.php" class="text-green-600 hover:text-green-800 transition-colors duration-300">🏠 Beranda</a></li>
                        <li class="text-green-400">/</li>
                        <li class="text-gray-600">📰 Semua Berita</li>
                    </ol>
                </div>
            </nav>

            <!-- Header Section -->
            <div class="text-center mb-12 fade-in">
                <h1 class="text-5xl md:text-6xl font-bold gradient-text mb-6">Berita & Informasi</h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                    Dapatkan informasi terkini seputar kegiatan dan perkembangan Laboratorium Terpadu UIN Raden Intan Lampung
                </p>
                <div class="w-24 h-1 bg-gradient-to-r from-green-400 to-green-600 mx-auto mt-6 rounded-full"></div>
            </div>

            <?php if (!empty($semua_berita_list)): ?>
                <!-- News Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                    <?php $delay = 1; foreach ($semua_berita_list as $berita_item): ?>
                        <div class="news-card rounded-3xl overflow-hidden shadow-xl relative slide-up stagger-<?php echo min($delay, 6); ?>" 
                             id="berita-<?php echo $berita_item['id_berita']; ?>">
                            
                            <div class="relative overflow-hidden h-56">
                                <?php 
                                    $gambar_url = "img/default_berita.jpg"; 
                                    if (!empty($berita_item['gambar_thumbnail'])) {
                                        $gambar_url = "img/berita_thumbnails/" . htmlspecialchars($berita_item['gambar_thumbnail']);
                                    }
                                ?>
                                <img src="<?php echo $gambar_url; ?>" 
                                     class="news-card-img w-full h-full object-cover" 
                                     alt="<?php echo htmlspecialchars($berita_item['judul']); ?>">
                                
                                <div class="absolute top-4 right-4">
                                    <div class="bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-semibold text-green-700 shadow-lg">
                                        <i class="bi bi-calendar-event mr-1"></i>
                                        <?php echo date('d M Y', strtotime($berita_item['tanggal_publish'])); ?>
                                    </div>
                                </div>

                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                            
                            <div class="p-6 relative z-10">
                                <h3 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2 leading-tight">
                                    <?php echo htmlspecialchars($berita_item['judul']); ?>
                                </h3>
                                
                                <p class="text-gray-600 mb-6 line-clamp-3 leading-relaxed">
                                    <?php 
                                        $ringkasan = strip_tags($berita_item['isi']);
                                        if (strlen($ringkasan) > 120) {
                                            $ringkasan = substr($ringkasan, 0, 120) . "...";
                                        }
                                        echo htmlspecialchars($ringkasan);
                                    ?>
                                </p>
                                
                                <a href="Berita.php?id=<?php echo $berita_item['id_berita']; ?>" 
                                   class="inline-flex items-center gap-2 text-green-600 font-semibold hover:text-green-800 transition-colors duration-300 group">
                                    <span>Baca Selengkapnya</span>
                                    <i class="bi bi-arrow-right transform group-hover:translate-x-1 transition-transform duration-300"></i>
                                </a>
                            </div>
                        </div>
                    <?php $delay++; endforeach; ?>
                </div>

                <!-- Modern Pagination -->
                <?php if ($total_halaman > 1): ?>
                <nav class="flex justify-center fade-in">
                    <ul class="flex items-center space-x-2 pagination-modern">
                        <?php if ($halaman_aktif > 1): ?>
                            <li>
                                <a href="Berita.php?page=<?php echo $halaman_aktif - 1; ?>" 
                                   class="page-link flex items-center gap-2 px-4 py-3 rounded-xl font-medium">
                                    <i class="bi bi-chevron-left"></i>
                                    <span class="hidden sm:inline">Sebelumnya</span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $total_halaman; $i++): ?>
                            <li class="page-item <?php if ($i == $halaman_aktif) echo 'active'; ?>">
                                <a href="Berita.php?page=<?php echo $i; ?>" 
                                   class="page-link flex items-center justify-center w-12 h-12 rounded-xl font-semibold">
                                    <?php echo $i; ?>
                                </a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($halaman_aktif < $total_halaman): ?>
                            <li>
                                <a href="Berita.php?page=<?php echo $halaman_aktif + 1; ?>" 
                                   class="page-link flex items-center gap-2 px-4 py-3 rounded-xl font-medium">
                                    <span class="hidden sm:inline">Berikutnya</span>
                                    <i class="bi bi-chevron-right"></i>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
                <?php endif; ?>

            <?php else: ?>
                <div class="text-center py-16 fade-in">
                    <div class="bg-gray-50 border-2 border-gray-200 rounded-3xl p-12 shadow-xl">
                        <div class="text-6xl mb-6">📰</div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Belum Ada Berita</h2>
                        <p class="text-gray-600">Belum ada berita yang dipublikasikan saat ini. Silakan kembali lagi nanti.</p>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </main>

    <!-- Modern Footer -->
    <footer class="footer mt-16 py-12 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-green-800/10 to-green-900/10"></div>
        <div class="container mx-auto px-4 text-center relative z-10">
            <div class="mb-4">
                <h3 class="text-xl font-semibold mb-2">Laboratorium Terpadu UIN Raden Intan Lampung</h3>
                <p class="text-green-100 mb-4">Mengembangkan ilmu pengetahuan melalui penelitian dan inovasi</p>
            </div>
            <div class="w-full h-px bg-gradient-to-r from-transparent via-green-300/30 to-transparent mb-6"></div>
            <div class="space-y-2">
                <p class="text-green-100 font-medium">© Copyright <?php echo date("Y"); ?> Universitas Islam Negeri Raden Intan Lampung, All rights reserved.</p>
                <p class="text-green-200 text-sm">Jl. Letnan Kolonel H. Endro Suratmin, Sukarame, Kota Bandar Lampung, 35131</p>
            </div>
        </div>
        
        <!-- Footer Decoration -->
        <div class="absolute -bottom-20 -right-20 w-40 h-40 bg-green-400/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-10 -left-20 w-32 h-32 bg-green-500/10 rounded-full blur-2xl"></div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Add smooth scrolling and enhanced animations
        document.addEventListener('DOMContentLoaded', function() {
            // Intersection Observer for animation triggers
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.animationPlayState = 'running';
                    }
                });
            }, observerOptions);

            // Observe all elements with animation classes
            document.querySelectorAll('.fade-in, .slide-up').forEach(el => {
                el.style.animationPlayState = 'paused';
                observer.observe(el);
            });

            // Enhanced hover effects for news cards
            document.querySelectorAll('.news-card').forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-12px) scale(1.02)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });

            // Smooth scroll for navigation links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
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
        });
    </script>
</body>
</html>
<?php
if (isset($conn_frontend)) {
    $conn_frontend->close();
}
?>