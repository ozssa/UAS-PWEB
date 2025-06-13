<?php
// controllers/RoomController.php
require_once 'models/Room.php';

class RoomController {
    private $room;

    public function __construct($db) {
        $this->room = new Room($db);
    }

    public function index() {
        $rooms = $this->room->getAll();
        require_once 'views/index.php';
    }

    public function search() {
        if (isset($_GET['keyword'])) {
            $keyword = htmlspecialchars(trim($_GET['keyword']));
            $rooms = $this->room->search($keyword);
            header('Content-Type: application/json');
            echo json_encode($rooms);
            exit;
        }
    }

    public function detail() {
        if (isset($_GET['id'])) {
            $room = $this->room->getById($_GET['id']);
            require_once 'views/kamar-tipe-b.php';
        } else {
            header('Location: index.php');
        }
    }
}
?>