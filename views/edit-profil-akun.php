<?php
// views/edit-profil-akun.php
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
    <title>Kost Kurnia - Edit Profil Akun</title>
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
                <h3 class="mb-1">Edit Profil Akun</h3>
                <p class="text-muted">Khusus Akun Pemilik Kos</p>
            </div>
            <form class="needs-validation" novalidate method="POST" action="index.php?controller=auth&action=editProfile" enctype="multipart/form-data">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">
                <div class="mb-3">
                    <label class="form-label">Foto Profil</label>
                    <div class="input-group">
                        <input type="file" class="form-control" name="profile_picture" id="profile_picture" accept="image/*">
                        <div class="invalid-feedback">Harap pilih file gambar.</div>
                    </div>
                    <?php if (!empty($user['profile_picture'])): ?>
                        <img src="uploads/profile/<?php echo htmlspecialchars($user['profile_picture']); ?>" class="img-fluid mt-2" style="max-width: 100px;" alt="Profile Picture">
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" name="nama_lengkap" value="<?php echo htmlspecialchars($user['nama_lengkap']); ?>" required>
                        <div class="invalid-feedback">Harap masukkan nama lengkap</div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-home"></i></span>
                        <input type="text" class="form-control" name="alamat" value="<?php echo htmlspecialchars($user['alamat']); ?>" required>
                        <div class="invalid-feedback">Harap masukkan alamat</div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nomor Telepon</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        <input type="tel" class="form-control" name="nomor_telepon" value="<?php echo htmlspecialchars($user['nomor_telepon']); ?>" required>
                        <div class="invalid-feedback">Harap masukkan nomor telepon</div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat E-Mail</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                        <div class="invalid-feedback">Harap masukkan email</div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Pengguna</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                        <div class="invalid-feedback">Harap masukkan nama pengguna</div>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <a href="index.php?controller=auth&action=profile" class="btn btn-secondary w-50">Batal</a>
                    <button type="submit" class="btn btn-primary w-50">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    <footer class="text-center py-4">
        <p>© Copyright 2025 Kost Kurnia. All Rights Reserved</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script>
        document.getElementById('profile_picture').addEventListener('change', function(e) {
            const formData = new FormData();
            formData.append('profile_picture', e.target.files[0]);
            formData.append('csrf_token', '<?php echo htmlspecialchars($csrf_token); ?>');
            
            fetch('index.php?controller=auth&action=editProfile', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Foto profil berhasil diunggah!');
                    location.reload();
                } else {
                    alert('Gagal mengunggah foto: ' + data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
</body>
</html>