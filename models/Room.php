<?php
// models/Room.php
class Room {
    private $conn;
    private $table = 'rooms';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT * FROM {$this->table}";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function search($keyword) {
        $keyword = "%{$keyword}%";
        $query = "SELECT * FROM {$this->table} WHERE tipe LIKE ? OR deskripsi LIKE ? OR harga LIKE ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('sss', $keyword, $keyword, $keyword);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id) {
        $query = "SELECT * FROM {$this->table} WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
?>