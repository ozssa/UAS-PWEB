<?php
require_once 'models/Booking.php';
require_once 'models/Room.php';
require_once 'utils/Csrf.php';

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
            if (!isset($_POST['csrf_token']) || !Csrf::validateToken($_POST['csrf_token'])) {
                die('Invalid CSRF token.');
            }
            $data = [
                'user_id' => $_SESSION['user_id'],
                'room_id' => isset($_POST['room_id']) ? (int)$_POST['room_id'] : 0,
                'tanggal_mulai' => $_POST['tanggal_mulai']
            ];
            // Validasi server-side
            if (empty($data['room_id']) || !$this->room->getById($data['room_id'])) {
                echo 'Kamar tidak valid.';
                exit;
            }
            if (strtotime($data['tanggal_mulai']) < strtotime(date('Y-m-d'))) {
                echo 'Tanggal mulai tidak valid.';
                exit;
            }
            $booking_id = $this->booking->create($data);
            if ($booking_id) {
                header("Location: index.php?controller=payment&action=create&booking_id={$booking_id}");
                exit;
            } else {
                echo 'Pemesanan gagal.';
            }
        } else {
            if (!isset($_GET['room_id'])) {
                header('Location: index.php');
                exit;
            }
            $room_id = (int)$_GET['room_id'];
            $room = $this->room->getById($room_id);
            if (!$room) {
                echo 'Kamar tidak ditemukan.';
                exit;
            }
            $csrf_token = Csrf::generateToken();
            require_once 'views/booking.php';
        }
    }

    public function getUserBookings($user_id) {
        return $this->booking->getByUserId($user_id);
    }

    public function cancel($booking_id) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }
        $booking = $this->booking->getById($booking_id);
        if ($booking && $booking['user_id'] == $_SESSION['user_id'] && $booking['status'] == 'pending') {
            if ($this->booking->cancel($booking_id)) {
                header('Location: index.php?controller=auth&action=dashboard');
                exit;
            } else {
                echo 'Gagal membatalkan pemesanan.';
            }
        } else {
            echo 'Pemesanan tidak ditemukan atau tidak dapat dibatalkan.';
        }
    }
}
?>