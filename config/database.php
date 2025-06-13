<?php
// config/database.php
class Database {
    private $host = 'localhost';
    private $db_name = 'kost_kurnia';
    private $username = 'root';
    private $password = '';
    public $conn;

    public function connect() {
        $this->conn = null;
        try {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
            if ($this->conn->connect_error) {
                throw new Exception('Koneksi gagal: ' . $this->conn->connect_error);
            }
            $this->conn->set_charset('utf8mb4');
        } catch (Exception $e) {
            die('Koneksi database gagal: ' . $e->getMessage());
        }
        return $this->conn;
    }
}
?>