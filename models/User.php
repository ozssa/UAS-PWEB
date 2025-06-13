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
}
?>