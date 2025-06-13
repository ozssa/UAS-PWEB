<?php
// index.php
session_start();
require_once 'config/database.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/RoomController.php';
require_once 'controllers/BookingController.php';
require_once 'controllers/PaymentController.php';

$database = new Database();
$db = $database->connect();

$controller = isset($_GET['controller']) ? $_GET['controller'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

switch ($controller) {
    case 'auth':
        $authController = new AuthController($db);
        if (method_exists($authController, $action)) {
            $authController->$action();
        } else {
            header('Location: index.php');
        }
        break;
    case 'room':
        $roomController = new RoomController($db);
        if (method_exists($roomController, $action)) {
            $roomController->$action();
        } else {
            header('Location: index.php');
        }
        break;
    case 'booking':
        $bookingController = new BookingController($db);
        if (method_exists($bookingController, $action)) {
            $bookingController->$action();
        } else {
            header('Location: index.php');
        }
        break;
    case 'payment':
        $paymentController = new PaymentController($db);
        if (method_exists($paymentController, $action)) {
            $paymentController->$action();
        } else {
            header('Location: index.php');
        }
        break;
    default:
        require_once 'views/index.php';
        break;
}
?>