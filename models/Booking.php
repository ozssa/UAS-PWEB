<?php
// models/Booking.php
class Booking {
    private $conn;
    private $table = 'bookings';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($data) {
        $query = "INSERT INTO {$this->table} (user_id, room_id, tanggal_mulai, status) VALUES (?, ?, ?, 'pending')";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('iis', $data['user_id'], $data['room_id'], $data['tanggal_mulai']);
        return $stmt->execute() ? $this->conn->insert_id : false;
    }

    public function getByUserId($user_id) {
        $query = "SELECT b.*, r.tipe, r.harga, r.gambar FROM {$this->table} b JOIN rooms r ON b.room_id = r.id WHERE b.user_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $user_id);
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

    public function cancel($id) {
        $query = "UPDATE {$this->table} SET status = 'cancelled' WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }
}
?>