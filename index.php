<?php
// Tambahkan header keamanan
header('X-Frame-Options: DENY');
header('X-Content-Type-Options: nosniff');
header('X-XSS-Protection: 1; mode=block');

require_once 'config/session.php'; // Mulai sesi
require_once 'config/database.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/RoomController.php';
require_once 'controllers/BookingController.php';
require_once 'controllers/PaymentController.php';

$database = new Database();
$db = $database->connect();

$controller = isset($_GET['controller']) ? $_GET['controller'] : 'room';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

switch ($controller) {
    case 'auth':
        $controller = new AuthController($db);
        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            echo 'Action tidak ditemukan.';
        }
        break;
    case 'room':
        $controller = new RoomController($db);
        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            echo 'Action tidak ditemukan.';
        }
        break;
    case 'booking':
        $controller = new BookingController($db);
        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            echo 'Action tidak ditemukan.';
        }
        break;
    case 'payment':
        $controller = new PaymentController($db);
        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            echo 'Action tidak ditemukan.';
        }
        break;
    default:
        $controller = new RoomController($db);
        $controller->index();
}
?>