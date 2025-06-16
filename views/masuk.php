<?php
// views/masuk.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kost Kurnia - Masuk</title>
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
                <h3 class="mb-1">Masuk</h3>
                <p class="text-muted">Khusus Akun Pemilik Kos</p>
            </div>
            <form class="needs-validation" novalidate method="POST" action="index.php?controller=auth&action=login">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">
                <div class="mb-3">
                    <label class="form-label">Nama Pengguna</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" name="username" placeholder="Masukkan nama pengguna" required>
                        <div class="invalid-feedback">Harap masukkan nama pengguna</div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kata Sandi</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" name="password" placeholder="Masukkan kata sandi" required>
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            <i class="fas fa-eye"></i>
                        </button>
                        <div class="invalid-feedback">Harap masukkan kata sandi</div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Masuk</button>
                <p class="text-center mt-3">Lupa kata sandi? <a href="index.php?controller=auth&action=forgotPassword" class="text-primary">Klik disini</a></p>
                <p class="text-center mt-1">Belum punya akun? <a href="index.php?controller=auth&action=register" class="text-primary">Buat akun sekarang</a></p>
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