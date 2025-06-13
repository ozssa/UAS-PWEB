<?php
// controllers/BookingController.php
require_once 'models/Booking.php';
require_once 'models/Room.php';

class BookingController {
    private $booking;
    private $room;

    public function __construct($db) {
        $this->booking = new Booking($db);
        $this->room = new Room($db);
    }

    public function create() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'user_id' => $_SESSION['user_id'],
                'room_id' => $_POST['room_id'],
                'tanggal_mulai' => $_POST['tanggal_mulai']
            ];
            $booking_id = $this->booking->create($data);
            if ($booking_id) {
                header("Location: index.php?controller=payment&action=create&booking_id={$booking_id}");
            } else {
                echo 'Pemesanan gagal.';
            }
        } else {
            if (!isset($_GET['room_id'])) {
                header('Location: index.php');
                exit;
            }
            $room_id = $_GET['room_id'];
            $room = $this->room->getById($room_id);
            if (!$room) {
                echo 'Kamar tidak ditemukan.';
                exit;
            }
            require_once 'views/booking.php';
        }
    }
}
?>