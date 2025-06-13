<?php
// views/index.php
// Pastikan variabel $rooms tersedia dari RoomController
if (!isset($rooms)) {
    $rooms = []; // Fallback jika tidak ada data
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kost Kurnia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Header dengan Navbar Responsif -->
    <header class="bg-dark py-2 sticky-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <div class="container-fluid">
                    <a class="navbar-brand fw-bold" href="index.php">
                        <img src="assets/images/logo.png" alt="Logo Kost Kurnia" class="logo-img me-2" style="width: 32px; height: 32px;">
                        KOST KURNIA
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item"><a class="nav-link" href="#beranda">Beranda</a></li>
                            <li class="nav-item"><a class="nav-link" href="#daftar-kamar">Daftar Kamar</a></li>
                            <li class="nav-item"><a class="nav-link" href="#lokasi">Lokasi</a></li>
                            <li class="nav-item"><a class="nav-link" href="#testimoni">Testimoni</a></li>
                            <li class="nav-item"><a class="nav-link" href="#tentang-kita">Tentang Kita</a></li>
                            <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Akun
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="index.php?controller=auth&action=register">Buat Akun</a></li>
                                    <li><a class="dropdown-item" href="index.php?controller=auth&action=login">Masuk</a></li>
                                    <li><a class="dropdown-item" href="index.php?controller=auth&action=profile">Profil Akun</a></li>
                                    <li><a class="dropdown-item" href="index.php?controller=auth&action=logout">Keluar</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <!-- Hero Section Responsif -->
    <section id="beranda" class="text-white py-5 position-relative">
        <div class="container position-relative z-1 d-flex align-items-center justify-content-center">
            <div class="text-center p-4 bg-dark bg-opacity-75 rounded">
                <h2 class="display-4 fw-bold mb-3">Kamu Butuh Kost? <br> KOST KURNIA Solusinya!</h2>
                <p class="lead fs-5 mb-4">Kost Kurnia menyediakan kamar yang nyaman untuk semua orang dengan harga yang terjangkau. Tunggu apa lagi? Temukan kamar idealmu sekarang juga!</p>
                <a href="#daftar-kamar" class="btn btn-primary btn-lg px-5 py-3">Pesan Sekarang</a>
            </div>
        </div>
    </section>

    <!-- Daftar Kamar dengan Grid Responsif dan Live Search -->
    <section id="daftar-kamar" class="py-5 bg-white">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">DAFTAR KAMAR</h2>
            <div class="mb-3">
                <input type="text" id="searchInput" class="form-control" placeholder="Cari kamar berdasarkan tipe atau harga...">
            </div>
            <div class="row g-4 justify-content-center" id="roomList">
                <?php foreach ($rooms as $room): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="auth-card h-100 border-0 overflow-hidden">
                            <div class="position-relative">
                                <img src="assets/images/<?php echo htmlspecialchars($room['gambar']); ?>" class="card-img-top img-fluid" alt="<?php echo htmlspecialchars($room['tipe']); ?>" style="height: 300px; object-fit: cover;">
                                <div class="position-absolute bottom-0 start-0 bg-primary text-white py-1 px-3">
                                    Rp <?php echo number_format($room['harga'], 0, ',', '.'); ?>/bulan
                                </div>
                            </div>
                            <div class="card-body">
                                <h3 class="card-title h5"><?php echo htmlspecialchars($room['tipe']); ?></h3>
                                <p><?php echo htmlspecialchars($room['deskripsi']); ?></p>
                                <a href="index.php?controller=room&action=detail&id=<?php echo $room['id']; ?>" class="btn btn-primary w-100">Pesan Sekarang</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Lokasi Kost dengan Layout Responsif -->
    <section id="lokasi" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">LOKASI KOST</h2>
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="map-container rounded shadow overflow-hidden">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.2111841525225!2d110.41189197403658!3d-6.984385468395102!2m3!1f0!2f0!3d0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708b0357e3eed3%3A0x2710bdacc60a617c!2sKost%20kurnia!5e0!3m2!1sen!2sid!4v1748872741705!5m2!1sen!2sid"
                            width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="auth-card p-4">
                        <h3 class="h4 mb-4">Jarak Tempat Dekat Kost</h3>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-school me-2 text-primary"></i>
                                    <p class="mb-0">Adis Siliwangi: <span class="fw-bold">2.4 km (15 menit)</span></p>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-school me-2 text-primary"></i>
                                    <p class="mb-0">SMAN 3: <span class="fw-bold">450 m (3 menit)</span></p>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-shopping-cart me-2 text-primary"></i>
                                    <p class="mb-0">Paragon Mall: <span class="fw-bold">240 m (15 menit)</span></p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-store me-2 text-primary"></i>
                                    <p class="mb-0">Mei Gascon Veteran: <span class="fw-bold">900 m (8 menit)</span></p>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-school me-2 text-primary"></i>
                                    <p class="mb-0">SMK 7: <span class="fw-bold">900 m (7 menit)</span></p>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-university me-2 text-primary"></i>
                                    <p class="mb-0">UDINUS: <span class="fw-bold">900 m (15 menit)</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <h4 class="h5 mb-3">Fasilitas Terdekat</h4>
                            <div class="d-flex flex-wrap gap-2">
                                <span class="badge bg-primary">Alfamart: 300 m</span>
                                <span class="badge bg-primary">Rumah Sakit: 1.2 km</span>
                                <span class="badge bg-primary">ATM: 250 m</span>
                                <span class="badge bg-primary">Restoran: 150 m</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimoni dengan Carousel Responsif -->
    <section id="testimoni" class="py-5 bg-white">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">TESTIMONI</h2>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div id="testimoniCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="auth-card p-4">
                                    <div class="card-body text-center">
                                        <div class="mb-3">
                                            <i class="fas fa-quote-left fa-2x text-primary opacity-25"></i>
                                        </div>
                                        <p class="card-text fst-italic">"Aman tempatnya, sesuai lokasi, recommended. Fasilitas lengkap dan pemiliknya ramah."</p>
                                        <div class="mt-4">
                                            <img src="https://randomuser.me/api/portraits/men/32.jpg" class="rounded-circle mb-2" width="60" alt="Gunawan">
                                            <h5 class="mb-0">Gunawan</h5>
                                            <div class="text-warning">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="auth-card p-4">
                                    <div class="card-body text-center">
                                        <div class="mb-3">
                                            <i class="fas fa-quote-left fa-2x text-primary opacity-25"></i>
                                        </div>
                                        <p class="card-text fst-italic">"Bisa terima paket online tiap hari. Pelayanan sangat membantu untuk saya yang sering belanja online."</p>
                                        <div class="mt-4">
                                            <img src="https://randomuser.me/api/portraits/women/44.jpg" class="rounded-circle mb-2" width="60" alt="Sinta">
                                            <h5 class="mb-0">Sinta</h5>
                                            <div class="text-warning">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="auth-card p-4">
                                    <div class="card-body text-center">
                                        <div class="mb-3">
                                            <i class="fas fa-quote-left fa-2x text-primary opacity-25"></i>
                                        </div>
                                        <p class="card-text fst-italic">"Tempatnya sangat nyaman, sangat cocok untuk istirahat setelah seharian bekerja. Lingkungannya tenang."</p>
                                        <div class="mt-4">
                                            <img src="https://randomuser.me/api/portraits/men/62.jpg" class="rounded-circle mb-2" width="60" alt="Gerry">
                                            <h5 class="mb-0">Gerry</h5>
                                            <div class="text-warning">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#testimoniCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#testimoniCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="#" class="btn btn-outline-dark">Lihat Lebih Banyak Testimoni</a>
            </div>
        </div>
    </section>

    <!-- Tentang Kita dengan Layout Responsif -->
    <section id="tentang-kita" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">TENTANG KITA</h2>
            <div class="row g-5 align-items-center">
                <div class="col-lg-5 text-center">
                    <div class="about-image position-relative">
                        <img src="assets/images/about.png" alt="Tentang Kost Kurnia" class="img-fluid rounded shadow" style="width: 343px; height: 343px; object-fit: cover;">
                        <div class="position-absolute top-0 end-0 bg-primary text-white p-2 rounded-circle shadow">
                            <i class="fas fa-home fa-2x"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="auth-card p-4">
                        <h3 class="h4 mb-3">Profil dan Sejarah Singkat</h3>
                        <p class="mb-4">Kost Kurnia didirikan pada tahun 2010 dengan misi memberikan tempat tinggal yang nyaman dan terjangkau bagi mahasiswa dan pekerja. Nama "Kurnia" diambil dari nama pendiri, Bapak Kurniawan, yang ingin memberikan kenyamanan sebagai anugerah bagi penghuninya.</p>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h4 class="h5 mb-3"><i class="fas fa-eye me-2 text-primary"></i> Visi</h4>
                                <p>Menyediakan tempat tinggal yang nyaman, aman, dan strategis dengan harga terjangkau bagi semua kalangan.</p>
                            </div>
                            <div class="col-md-6">
                                <h4 class="h5 mb-3"><i class="fas fa-bullseye me-2 text-primary"></i> Misi</h4>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-check me-2 text-success"></i> Menyediakan fasilitas lengkap dan bersih</li>
                                    <li><i class="fas fa-check me-2 text-success"></i> Meningkatkan kenyamanan penghuni</li>
                                    <li><i class="fas fa-check me-2 text-success"></i> Pelayanan ramah dan profesional</li>
                                </ul>
                            </div>
                        </div>
                        <h4 class="h5 mb-3"><i class="fas fa-crown me-2 text-primary"></i> Keunggulan Kost</h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-start mb-2">
                                    <i class="fas fa-parking me-2 text-primary mt-1"></i>
                                    <div>
                                        <h5 class="h6 mb-0">Tempat Parkir Luas</h5>
                                        <p class="small mb-0">Parkir aman untuk motor dan sepeda</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-start mb-2">
                                    <i class="fas fa-wifi me-2 text-primary mt-1"></i>
                                    <div>
                                        <h5 class="h6 mb-0">WiFi Cepat</h5>
                                        <p class="small mb-0">Internet 24 jam kecepatan tinggi</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-start mb-2">
                                    <i class="fas fa-shield-alt me-2 text-primary mt-1"></i>
                                    <div>
                                        <h5 class="h6 mb-0">Keamanan 24 Jam</h5>
                                        <p class="small mb-0">CCTV dan penjaga 24 jam</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-start mb-2">
                                    <i class="fas fa-utensils me-2 text-primary mt-1"></i>
                                    <div>
                                        <h5 class="h6 mb-0">Dapur Bersama</h5>
                                        <p class="small mb-0">Dapur lengkap untuk memasak</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kontak Kita dengan Form Responsif -->
    <section id="kontak" class="py-5 bg-white">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">KONTAK KITA</h2>
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="auth-card p-4">
                        <h3 class="h4 mb-4">Informasi Kontak</h3>
                        <div class="d-flex align-items-start mb-4">
                            <div class="bg-primary p-3 rounded-circle me-3">
                                <i class="fas fa-map-marker-alt fa-lg text-white"></i>
                            </div>
                            <div>
                                <h4 class="h6 mb-0">Alamat</h4>
                                <p class="mb-0">Jl. Kurnia No. 123, Semarang, Jawa Tengah 50123</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start mb-4">
                            <div class="bg-primary p-3 rounded-circle me-3">
                                <i class="fas fa-phone-alt fa-lg text-white"></i>
                            </div>
                            <div>
                                <h4 class="h6 mb-0">Telepon</h4>
                                <p class="mb-0">(024) 7654321</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start mb-4">
                            <div class="bg-primary p-3 rounded-circle me-3">
                                <i class="fab fa-whatsapp fa-lg text-white"></i>
                            </div>
                            <div>
                                <h4 class="h6 mb-0">WhatsApp</h4>
                                <p class="mb-0">0812-3456-7890</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start mb-4">
                            <div class="bg-primary p-3 rounded-circle me-3">
                                <i class="fas fa-envelope fa-lg text-white"></i>
                            </div>
                            <div>
                                <h4 class="h6 mb-0">Email</h4>
                                <p class="mb-0">kostkurnia@gmail.com</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start">
                            <div class="bg-primary p-3 rounded-circle me-3">
                                <i class="fas fa-clock fa-lg text-white"></i>
                            </div>
                            <div>
                                <h4 class="h6 mb-0">Jam Operasional</h4>
                                <p class="mb-0">Senin - Minggu: 08:00 - 20:00 WIB</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="auth-card p-4">
                        <h3 class="h4 mb-4">Kirim Pesan</h3>
                        <form class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" placeholder="Masukkan nama lengkap" required>
                                <div class="invalid-feedback">Harap masukkan nama lengkap</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" placeholder="Masukkan email" required>
                                <div class="invalid-feedback">Harap masukkan email</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Subjek</label>
                                <input type="text" class="form-control" placeholder="Masukkan subjek pesan" required>
                                <div class="invalid-feedback">Harap masukkan subjek</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pesan</label>
                                <textarea class="form-control" rows="4" placeholder="Masukkan pesan Anda" required></textarea>
                                <div class="invalid-feedback">Harap masukkan pesan</div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Kirim Pesan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Galeri Foto Responsif -->
    <section id="galeri" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">GALERI FOTO KOST</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="gallery-item overflow-hidden rounded shadow">
                        <img src="assets/images/gallery1.png" class="img-fluid w-100" alt="Area Bersama" style="height: 250px; object-fit: cover;">
                        <div class="overlay text-white p-3">
                            <h5 class="mb-0">Area Bersama</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="gallery-item overflow-hidden rounded shadow">
                        <img src="assets/images/room1.png" class="img-fluid w-100" alt="Kamar Tipe A" style="height: 250px; object-fit: cover;">
                        <div class="overlay text-white p-3">
                            <h5 class="mb-0">Kamar Tipe A</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="gallery-item overflow-hidden rounded shadow">
                        <img src="assets/images/room2.png" class="img-fluid w-100" alt="Kamar Tipe B" style="height: 250px; object-fit: cover;">
                        <div class="overlay text-white p-3">
                            <h5 class="mb-0">Kamar Tipe B</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="gallery-item overflow-hidden rounded shadow">
                        <img src="assets/images/room3.png" class="img-fluid w-100" alt="Kamar Tipe C" style="height: 250px; object-fit: cover;">
                        <div class="overlay text-white p-3">
                            <h5 class="mb-0">Kamar Tipe C</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="gallery-item overflow-hidden rounded shadow">
                        <img src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2" class="img-fluid w-100" alt="Kamar Mandi" style="height: 250px; object-fit: cover;">
                        <div class="overlay text-white p-3">
                            <h5 class="mb-0">Kamar Mandi Bersih</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="gallery-item overflow-hidden rounded shadow">
                        <img src="https://images.unsplash.com/photo-1584132967334-10e028bd69f7" class="img-fluid w-100" alt="Dapur Bersama" style="height: 250px; object-fit: cover;">
                        <div class="overlay text-white p-3">
                            <h5 class="mb-0">Dapur Bersama</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="#" class="btn btn-outline-dark">Lihat Galeri Lengkap</a>
            </div>
        </div>
    </section>

    <!-- Footer Responsif -->
    <footer class="text-center py-4 bg-light">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <h3 class="h5 mb-4">Kost Kurnia</h3>
                    <p class="small">Menyediakan kamar kost nyaman dengan fasilitas lengkap di lokasi strategis Semarang. Harga terjangkau untuk mahasiswa dan pekerja.</p>
                    <div class="d-flex gap-3 mt-4 justify-content-center">
                        <a href="#" class="fs-5"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="fs-5"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="fs-5"><i class="fab fa-whatsapp"></i></a>
                        <a href="#" class="fs-5"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <h3 class="h5 mb-4">Tautan Cepat</h3>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="#beranda" class="text-decoration-none">Beranda</a></li>
                        <li class="mb-2"><a href="#daftar-kamar" class="text-decoration-none">Daftar Kamar</a></li>
                        <li class="mb-2"><a href="#lokasi" class="text-decoration-none">Lokasi</a></li>
                        <li class="mb-2"><a href="#tentang-kita" class="text-decoration-none">Tentang Kami</a></li>
                        <li class="mb-2"><a href="#kontak" class="text-decoration-none">Kontak</a></li>
                        <li class="mb-2"><a href="syarat-ketentuan.html" class="text-decoration-none">Syarat & Ketentuan</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h3 class="h5 mb-4">Kontak Kami</h3>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> Jl. Kurnia No. 123, Semarang</li>
                        <li class="mb-2"><i class="fas fa-phone-alt me-2"></i> (024) 7654321</li>
                        <li class="mb-2"><i class="fab fa-whatsapp me-2"></i> 0812-3456-7890</li>
                        <li class="mb-2"><i class="fas fa-envelope me-2"></i> kostkurnia@gmail.com</li>
                    </ul>
                    <div class="mt-4">
                        <a href="#kontak" class="btn btn-primary">Hubungi Kami</a>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center">
                <p class="small mb-0">© 2025 Kost Kurnia. Hak Cipta Dilindungi.</p>
                <p class="small mb-0">Dibuat dengan <i class="fas fa-heart text-danger"></i> untuk kenyamanan Anda</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script>
        // Live Search untuk Daftar Kamar
        document.getElementById('searchInput').addEventListener('input', function() {
            const keyword = this.value;
            fetch(`index.php?controller=room&action=search&keyword=${encodeURIComponent(keyword)}`)
                .then(response => response.json())
                .then(data => {
                    const roomList = document.getElementById('roomList');
                    roomList.innerHTML = '';
                    data.forEach(room => {
                        roomList.innerHTML += `
                            <div class="col-md-6 col-lg-4">
                                <div class="auth-card h-100 border-0 overflow-hidden">
                                    <div class="position-relative">
                                        <img src="assets/images/${room.gambar}" class="card-img-top img-fluid" alt="${room.tipe}" style="height: 300px; object-fit: cover;">
                                        <div class="position-absolute bottom-0 start-0 bg-primary text-white py-1 px-3">
                                            Rp ${room.harga.toLocaleString('id-ID')}/bulan
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h3 class="card-title h5">${room.tipe}</h3>
                                        <p>${room.deskripsi}</p>
                                        <a href="index.php?controller=room&action=detail&id=${room.id}" class="btn btn-primary w-100">Pesan Sekarang</a>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
</body>
</html>