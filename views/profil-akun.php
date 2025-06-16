<?php
// views/profil-akun.php
if (!isset($user)) {
    header('Location: index.php?controller=auth&action=login');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kost Kurnia - Profil Akun</title>
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
                <h3 class="mb-1">Profil Akun</h3>
                <p class="text-muted">Khusus Akun Pemilik Kos</p>
                <?php if (!empty($user['profile_picture'])): ?>
                    <img src="uploads/profile/<?php echo htmlspecialchars($user['profile_picture']); ?>" class="img-fluid rounded-circle mb-3" style="max-width: 100px;" alt="Profile Picture">
                <?php else: ?>
                    <i class="fas fa-user-circle fa-5x mb-3 text-muted"></i>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($user['nama_lengkap']); ?>" readonly>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-home"></i></span>
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($user['alamat']); ?>" readonly>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Nomor Telepon</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($user['nomor_telepon']); ?>" readonly>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat E-Mail</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" readonly>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Pengguna</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($user['username']); ?>" readonly>
                </div>
            </div>
            <a href="index.php?controller=auth&action=editProfile" class="btn btn-primary w-100">Edit</a>
            <a href="index.php?controller=auth&action=dashboard" class="btn btn-secondary w-100 mt-2">Dashboard</a>
        </div>
    </div>
    <footer class="text-center py-4">
        <p>© Copyright 2025 Kost Kurnia. All Rights Reserved</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>