<?php
// views/dashboard.php
if (!isset($user) || !isset($bookings)) {
    header('Location: index.php?controller=auth&action=login');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kost Kurnia - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container py-5">
        <div class="text-center mb-4">
            <a href="index.php" class="btn btn-info mb-3 w-100 w-md-auto">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda
            </a>
            <h2 class="mb-5 fw-bold">Dashboard Pengguna</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="auth-card shadow-sm p-4">
                    <h3 class="card-title fs-4 mb-3">Daftar Pemesanan</h3>
                    <?php if (empty($bookings)): ?>
                        <p class="text-muted">Belum ada pemesanan.</p>
                    <?php else: ?>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tipe Kamar</th>
                                    <th>Harga</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($bookings as $booking): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($booking['id']); ?></td>
                                        <td><?php echo htmlspecialchars($booking['tipe']); ?></td>
                                        <td>Rp <?php echo number_format($booking['harga'], 0, ',', '.'); ?></td>
                                        <td><?php echo htmlspecialchars($booking['tanggal_mulai']); ?></td>
                                        <td><?php echo htmlspecialchars($booking['status']); ?></td>
                                        <td>
                                            <?php if ($booking['status'] == 'pending'): ?>
                                                <a href="index.php?controller=booking&action=cancel&id=<?php echo $booking['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin membatalkan pemesanan ini?');">Batalkan</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                    <a href="index.php?controller=auth&action=profile" class="btn btn-primary w-100 mt-4">Kembali ke Profil</a>
                </div>
            </div>
        </div>
    </div>
    <footer class="text-center py-4">
        <p>© Copyright 2025 Kost Kurnia. All Rights Reserved</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>