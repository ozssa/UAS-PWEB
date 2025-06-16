<?php
require_once 'models/User.php';
require_once 'utils/Csrf.php';

class AuthController {
    private $user;

    public function __construct($db) {
        $this->user = new User($db);
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['csrf_token']) || !Csrf::validateToken($_POST['csrf_token'])) {
                die('Invalid CSRF token.');
            }
            $data = [
                'nama_lengkap' => htmlspecialchars(trim($_POST['nama_lengkap'])),
                'nomor_telepon' => htmlspecialchars(trim($_POST['nomor_telepon'])),
                'email' => htmlspecialchars(trim($_POST['email'])),
                'alamat' => htmlspecialchars(trim($_POST['alamat'])),
                'username' => htmlspecialchars(trim($_POST['username'])),
                'password' => $_POST['password']
            ];
            // Validasi server-side
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                echo 'Format email tidak valid.';
                return;
            }
            if (!preg_match('/^[0-9]{10,15}$/', $data['nomor_telepon'])) {
                echo 'Nomor telepon tidak valid.';
                return;
            }
            if (strlen($data['password']) < 8) {
                echo 'Kata sandi harus minimal 8 karakter.';
                return;
            }
            if ($this->user->register($data)) {
                header('Location: index.php?controller=auth&action=login');
                exit;
            } else {
                echo 'Pendaftaran gagal.';
            }
        } else {
            $csrf_token = Csrf::generateToken();
            require_once 'views/buat-akun.php';
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['csrf_token']) || !Csrf::validateToken($_POST['csrf_token'])) {
                die('Invalid CSRF token.');
            }
            $username = htmlspecialchars(trim($_POST['username']));
            $password = $_POST['password'];
            $user = $this->user->login($username, $password);
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                header('Location: index.php?controller=auth&action=dashboard');
                exit;
            } else {
                echo 'Login gagal.';
            }
        } else {
            $csrf_token = Csrf::generateToken();
            require_once 'views/masuk.php';
        }
    }

    public function profile() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }
        $user = $this->user->getById($_SESSION['user_id']);
        require_once 'views/profil-akun.php';
    }

    public function editProfile() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['csrf_token']) || !Csrf::validateToken($_POST['csrf_token'])) {
                die('Invalid CSRF token.');
            }
            $data = [
                'nama_lengkap' => htmlspecialchars(trim($_POST['nama_lengkap'])),
                'nomor_telepon' => htmlspecialchars(trim($_POST['nomor_telepon'])),
                'email' => htmlspecialchars(trim($_POST['email'])),
                'alamat' => htmlspecialchars(trim($_POST['alamat'])),
                'username' => htmlspecialchars(trim($_POST['username']))
            ];
            // Validasi server-side
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                echo 'Format email tidak valid.';
                return;
            }
            if (!preg_match('/^[0-9]{10,15}$/', $data['nomor_telepon'])) {
                echo 'Nomor telepon tidak valid.';
                return;
            }
            // Handle file upload
            if (!empty($_FILES['profile_picture']['name'])) {
                $upload = $this->user->uploadProfilePicture($_SESSION['user_id'], $_FILES['profile_picture']);
                if ($upload !== true) {
                    echo $upload; // Error message
                    return;
                }
            }
            if ($this->user->update($_SESSION['user_id'], $data)) {
                header('Location: index.php?controller=auth&action=profile');
                exit;
            } else {
                echo 'Gagal memperbarui profil.';
            }
        } else {
            $user = $this->user->getById($_SESSION['user_id']);
            $csrf_token = Csrf::generateToken();
            require_once 'views/edit-profil-akun.php';
        }
    }

    public function forgotPassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['csrf_token']) || !Csrf::validateToken($_POST['csrf_token'])) {
                die('Invalid CSRF token.');
            }
            $email = htmlspecialchars(trim($_POST['email']));
            $user = $this->user->resetPassword($email);
            if ($user) {
                $_SESSION['reset_email'] = $email;
                header('Location: index.php?controller=auth&action=verify');
                exit;
            } else {
                echo 'Email tidak ditemukan.';
            }
        } else {
            $csrf_token = Csrf::generateToken();
            require_once 'views/lupa-kata-sandi.php';
        }
    }

    public function verify() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['csrf_token']) || !Csrf::validateToken($_POST['csrf_token'])) {
                die('Invalid CSRF token.');
            }
            // Simulasi verifikasi kode
            header('Location: index.php?controller=auth&action=login');
            exit;
        } else {
            $csrf_token = Csrf::generateToken();
            require_once 'views/verifikasi-sandi.php';
        }
    }

    public function logout() {
        session_destroy();
        header('Location: index.php');
        exit;
    }

    public function dashboard() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }
        $user = $this->user->getById($_SESSION['user_id']);
        $bookingController = new BookingController($this->user->getDb());
        $bookings = $bookingController->getUserBookings($_SESSION['user_id']);
        require_once 'views/dashboard.php';
    }
}
?>