<?php
// views/buat-akun.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kost Kurnia - Buat Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="d-flex justify-content-center align-items-center min-vh-100 bg-light">
        <div class="auth-card p-4 shadow-sm">
            <div class="text-center mb-4">
                <a href="index.php" class="btn btn-info mb-3 w-100">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda
                </a>
                <h3 class="mb-1">Buat Akun Baru</h3>
                <p class="text-muted">Khusus Akun Pemilik Kos</p>
            </div>
            
            <form class="needs-validation" novalidate method="POST" action="index.php?controller=auth&action=register">
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" name="nama_lengkap" placeholder="Masukkan nama lengkap" required>
                        <div class="invalid-feedback">
                            Harap masukkan nama lengkap
                        </div>
                    </div>
                </div>
                
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Nomor Telepon</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            <input type="tel" class="form-control" name="nomor_telepon" placeholder="Masukkan nomor telepon" required>
                            <div class="invalid-feedback">
                                Harap masukkan nomor telepon
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" class="form-control" name="email" placeholder="Masukkan email" required>
                            <div class="invalid-feedback">
                                Harap masukkan email
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Alamat Lengkap</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-home"></i></span>
                        <textarea class="form-control" name="alamat" placeholder="Masukkan alamat lengkap" rows="2" required></textarea>
                        <div class="invalid-feedback">
                            Harap masukkan alamat lengkap
                        </div>
                    </div>
                </div>
                
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Username</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-at"></i></span>
                            <input type="text" class="form-control" name="username" placeholder="Buat username" required>
                            <div class="invalid-feedback">
                                Harap masukkan username
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Kata Sandi</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" name="password" placeholder="Buat kata sandi" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </button>
                            <div class="invalid-feedback">
                                Harap masukkan kata sandi
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" id="terms" required>
                    <label class="form-check-label small" for="terms">
                        Saya menyetujui <a href="#" class="text-primary">Syarat & Ketentuan</a> dan <a href="#" class="text-primary">Kebijakan Privasi</a>
                    </label>
                    <div class="invalid-feedback">
                        Harap setujui syarat dan ketentuan
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary w-100 py-2 mb-3">Daftar Akun</button>
                
                <div class="text-center mt-3">
                    <p class="mb-0">Sudah punya akun? <a href="index.php?controller=auth&action=login" class="text-primary fw-bold">Masuk sekarang</a></p>
                </div>
            </form>
        </div>
    </div>
    
    <footer class="text-center py-4">
        <p>© Copyright 2025 Kost Kurnia. All Rights Reserved</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>