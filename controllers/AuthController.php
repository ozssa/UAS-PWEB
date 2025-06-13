<?php
// controllers/AuthController.php
require_once 'models/User.php';

class AuthController {
    private $user;

    public function __construct($db) {
        $this->user = new User($db);
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nama_lengkap' => htmlspecialchars(trim($_POST['nama_lengkap'])),
                'nomor_telepon' => htmlspecialchars(trim($_POST['nomor_telepon'])),
                'email' => htmlspecialchars(trim($_POST['email'])),
                'alamat' => htmlspecialchars(trim($_POST['alamat'])),
                'username' => htmlspecialchars(trim($_POST['username'])),
                'password' => $_POST['password']
            ];
            if ($this->user->register($data)) {
                header('Location: index.php?controller=auth&action=login');
            } else {
                echo 'Pendaftaran gagal.';
            }
        } else {
            require_once 'views/buat-akun.php';
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = htmlspecialchars(trim($_POST['username']));
            $password = $_POST['password'];
            $user = $this->user->login($username, $password);
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                header('Location: index.php?controller=auth&action=profile');
            } else {
                echo 'Login gagal.';
            }
        } else {
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
            $data = [
                'nama_lengkap' => htmlspecialchars(trim($_POST['nama_lengkap'])),
                'nomor_telepon' => htmlspecialchars(trim($_POST['nomor_telepon'])),
                'email' => htmlspecialchars(trim($_POST['email'])),
                'alamat' => htmlspecialchars(trim($_POST['alamat'])),
                'username' => htmlspecialchars(trim($_POST['username']))
            ];
            if ($this->user->update($_SESSION['user_id'], $data)) {
                header('Location: index.php?controller=auth&action=profile');
            } else {
                echo 'Gagal memperbarui profil.';
            }
        } else {
            $user = $this->user->getById($_SESSION['user_id']);
            require_once 'views/edit-profil-akun.php';
        }
    }

    public function forgotPassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = htmlspecialchars(trim($_POST['email']));
            $user = $this->user->resetPassword($email);
            if ($user) {
                // Simulasi pengiriman kode verifikasi (di dunia nyata gunakan email API)
                $_SESSION['reset_email'] = $email;
                header('Location: index.php?controller=auth&action=verify');
            } else {
                echo 'Email tidak ditemukan.';
            }
        } else {
            require_once 'views/lupa-kata-sandi.php';
        }
    }

    public function verify() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Simulasi verifikasi kode
            header('Location: index.php?controller=auth&action=login');
        } else {
            require_once 'views/verifikasi-sandi.php';
        }
    }

    public function logout() {
        session_destroy();
        header('Location: index.php');
    }
}
?>