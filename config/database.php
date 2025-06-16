<?php
// config/database.php
class Database {
    private $host = 'localhost';
    private $db_name = 'kost_kurnia';
    private $username = 'root';
    private $password = '';
    private $conn;

    // Konfigurasi API Key
    public $xendit_api_key = 'xnd_development_lSfPAwXeuPlgJIw8GshKhl0GrzUCePIDDeDgqpO2L5AWZsp2pfV5RwXbrwcfE';

    public function connect() {
        $this->conn = null;
        try {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
            if ($this->conn->connect_error) {
                throw new Exception('Koneksi gagal: ' . $this->conn->connect_error);
            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return $this->conn;
    }
}
?>