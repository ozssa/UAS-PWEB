<?php
// controllers/PaymentController.php
require_once 'models/Payment.php';

class PaymentController {
    private $payment;
    private $xendit_api_key = 'xnd_development_XL6dv5G4fAi6Et4nas1hU7f0VRdGArje5CTpNs5uZRK3IoDGUN6DAxT7ZhwFifz';
    public function __construct($db) {
        $this->payment = new Payment($db);
    }

    public function create() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }
        if (isset($_GET['booking_id'])) {
            $booking_id = $_GET['booking_id'];
            // Simulasi data pemesanan
            $amount = 800000; // Contoh harga kamar Tipe B
            $external_id = 'kost_kurnia_' . time();

            // Integrasi Xendit
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://api.xendit.co/v2/invoices',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => [
                    'Authorization: Basic ' . base64_encode($this->xendit_api_key . ':'),
                    'Content-Type: application/json'
                ],
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => json_encode([
                    'external_id' => $external_id,
                    'amount' => $amount,
                    'payer_email' => 'customer@example.com',
                    'description' => 'Pembayaran pemesanan kamar Kost Kurnia'
                ])
            ]);
            $response = curl_exec($curl);
            curl_close($curl);
            $result = json_decode($response, true);

            if (isset($result['id'])) {
                $data = [
                    'booking_id' => $booking_id,
                    'external_id' => $external_id,
                    'amount' => $amount,
                    'xendit_invoice_id' => $result['id']
                ];
                $this->payment->create($data);
                header('Location: ' . $result['invoice_url']);
            } else {
                echo 'Gagal membuat invoice.';
            }
        }
    }

    public function callback() {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);
        if ($data['status'] === 'PAID') {
            $this->payment->updateStatus($data['external_id'], 'PAID');
        }
        http_response_code(200);
    }
}
?>