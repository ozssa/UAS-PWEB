<?php
// views/payment.php
// Asumsi variabel $payment tersedia dari PaymentController
if (!isset($payment)) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kost Kurnia - Status Pembayaran</title>
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
            <h2 class="mb-5 fw-bold">Status Pembayaran</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="auth-card shadow-sm p-4">
                    <h3 class="card-title fs-4 mb-3">Detail Pembayaran</h3>
                    <p><strong>ID Transaksi:</strong> <?php echo htmlspecialchars($payment['external_id']); ?></p>
                    <p><strong>Jumlah:</strong> Rp <?php echo number_format($payment['amount'], 0, ',', '.'); ?></p>
                    <p><strong>Status:</strong> <?php echo htmlspecialchars($payment['status']); ?></p>
                    <?php if ($payment['status'] === 'PENDING'): ?>
                        <p class="text-muted">Silakan selesaikan pembayaran melalui tautan yang dikirim ke email Anda.</p>
                    <?php elseif ($payment['status'] === 'PAID'): ?>
                        <p class="text-success">Pembayaran berhasil! Pemesanan Anda telah dikonfirmasi.</p>
                    <?php else: ?>
                        <p class="text-danger">Pembayaran gagal. Silakan coba lagi.</p>
                    <?php endif; ?>
                    <a href="index.php" class="btn btn-primary w-100 mt-4">Kembali ke Beranda</a>
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