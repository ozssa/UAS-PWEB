<?php
// views/lupa-kata-sandi.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kost Kurnia - Lupa Kata Sandi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="d-flex justify-content-center align-items-center min-vh-100 bg-light">
        <div class="auth-card p-4 shadow-sm">
            <div class="text-center mb-4">
                <a href="index.php" class="btn btn-info mb-3 w-50">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda
                </a>
                <h3 class="mb-1">Lupa Kata Sandi</h3>
                <p class="text-muted">Khusus untuk Akun Pemilik Kos</p>
            </div>
            <form class="needs-validation" novalidate method="POST" action="index.php?controller=auth&action=forgotPassword">
                <div class="mb-3">
                    <label class="form-label">Alamat E-mail</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" class="form-control" name="email" placeholder="Masukkan alamat e-mail" required>
                        <div class="invalid-feedback">Harap masukkan email</div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Kirim</button>
                <a href="index.php?controller=auth&action=login" class="btn btn-info w-100 mt-2">Kembali ke Masuk</a>
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