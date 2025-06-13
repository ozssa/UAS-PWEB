<?php
// views/kamar-tipe.php
if (!isset($room)) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kost Kurnia - Detail Kamar <?php echo htmlspecialchars($room['tipe']); ?></title>
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
            <h2 class="mb-5 fw-bold">Detail Kamar <?php echo htmlspecialchars($room['tipe']); ?></h2>
        </div>
        <div class="row">
            <div class="col-md-6">
                <img src="assets/images/<?php echo htmlspecialchars($room['gambar']); ?>" class="img-fluid rounded shadow-sm mb-4" alt="Kamar Tipe <?php echo htmlspecialchars($room['tipe']); ?>" style="height: 300px; object-fit: cover; width: 100%;">
            </div>
            <div class="col-md-6">
                <div class="auth-card shadow-sm p-4">
                    <h3 class="card-title fs-4 mb-3"><?php echo htmlspecialchars($room['tipe']); ?></h3>
                    <p class="card-text fw-bold mb-3">Harga Bulanan: Rp <?php echo number_format($room['harga'], 0, ',', '.'); ?></p>
                    <h5 class="fw-bold mb-2">Fasilitas Kamar:</h5>
                    <ul class="list-unstyled">
                        <?php
                        $fasilitas = explode(', ', $room['deskripsi']);
                        foreach ($fasilitas as $fas) {
                            echo "<li><i class=\"fas fa-check me-2 text-primary\"></i>" . htmlspecialchars($fas) . "</li>";
                        }
                        ?>
                        <li><i class="fas fa-check me-2 text-primary"></i>WiFi Berkecepatan Tinggi</li>
                        <li><i class="fas fa-check me-2 text-primary"></i>Kamar Mandi Dalam</li>
                    </ul>
                    <a href="index.php?controller=booking&action=create&room_id=<?php echo $room['id']; ?>" class="btn btn-primary w-100 mt-4">Pesan Sekarang</a>
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