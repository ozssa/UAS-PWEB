<?php
// models/Payment.php
class Payment {
    private $conn;
    private $table = 'payments';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($data) {
        $query = "INSERT INTO {$this->table} (booking_id, external_id, amount, status, xendit_invoice_id) VALUES (?, ?, ?, 'PENDING', ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('isds', $data['booking_id'], $data['external_id'], $data['amount'], $data['xendit_invoice_id']);
        return $stmt->execute();
    }

    public function updateStatus($external_id, $status) {
        $query = "UPDATE {$this->table} SET status = ? WHERE external_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('ss', $status, $external_id);
        return $stmt->execute();
    }
}
?>