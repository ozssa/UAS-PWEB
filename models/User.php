<?php
// models/User.php
class User {
    private $conn;
    private $table = 'users';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function register($data) {
        $query = "INSERT INTO {$this->table} (nama_lengkap, nomor_telepon, email, alamat, username, password) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $hashed_password = password_hash($data['password'], PASSWORD_BCRYPT);
        $stmt->bind_param('ssssss', $data['nama_lengkap'], $data['nomor_telepon'], $data['email'], $data['alamat'], $data['username'], $hashed_password);
        return $stmt->execute();
    }

    public function login($username, $password) {
        $query = "SELECT * FROM {$this->table} WHERE username = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        if ($result && password_verify($password, $result['password'])) {
            return $result;
        }
        return false;
    }

    public function getById($id) {
        $query = "SELECT * FROM {$this->table} WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function update($id, $data) {
        $query = "UPDATE {$this->table} SET nama_lengkap = ?, nomor_telepon = ?, email = ?, alamat = ?, username = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('sssssi', $data['nama_lengkap'], $data['nomor_telepon'], $data['email'], $data['alamat'], $data['username'], $id);
        return $stmt->execute();
    }

    public function resetPassword($email) {
        $query = "SELECT * FROM {$this->table} WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function uploadProfilePicture($user_id, $file) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $max_size = 2 * 1024 * 1024; // 2MB
        if (!in_array($file['type'], $allowed_types)) {
            return 'Tipe file tidak diizinkan. Gunakan JPEG, PNG, atau GIF.';
        }
        if ($file['size'] > $max_size) {
            return 'Ukuran file terlalu besar. Maksimum 2MB.';
        }
        $filename = 'profile_' . $user_id . '_' . time() . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
        $destination = 'uploads/profile/' . $filename;
        if (move_uploaded_file($file['tmp_name'], $destination)) {
            $query = "UPDATE {$this->table} SET profile_picture = ? WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param('si', $filename, $user_id);
            return $stmt->execute() ? true : 'Gagal menyimpan gambar ke database.';
        }
        return 'Gagal mengunggah gambar.';
    }

    public function getDb() {
        return $this->conn;
    }
}
?>