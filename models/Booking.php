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
}
?>