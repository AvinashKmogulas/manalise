<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name     = $_POST['name'] ?? '';
    $phone    = $_POST['phone'] ?? '';
    $checkin  = $_POST['checkin'] ?? '';
    $checkout = $_POST['checkout'] ?? '';
    $rooms    = $_POST['rooms'] ?? '';
    $adults   = $_POST['adults'] ?? '';
    $children = $_POST['children'] ?? '';

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'avinash.mogulas@gmail.com';
        $mail->Password   = 'npjvobfhyaryrrpg';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Sender & Receiver
        $mail->setFrom('avinash.mogulas@gmail.com', 'Booking Enquiry in Mohali-Se');
        $mail->addAddress('avinash8564kumar@gmail.com', 'Admin');

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = 'New Booking Enquiry';
        $mail->Body    = "
    <h2>New Enquiry</h2>
    <table border='1' cellpadding='10' cellspacing='0' style='border-collapse: collapse; width: 100%;'>
        <tr>
            <th style='background-color: #f2f2f2;'>Name</th>
            <td>$name</td>
        </tr>
        <tr>
            <th style='background-color: #f2f2f2;'>Phone</th>
            <td>$phone</td>
        </tr>
        <tr>
            <th style='background-color: #f2f2f2;'>Check-in</th>
            <td>$checkin</td>
        </tr>
        <tr>
            <th style='background-color: #f2f2f2;'>Check-out</th>
            <td>$checkout</td>
        </tr>
        <tr>
            <th style='background-color: #f2f2f2;'>Rooms</th>
            <td>$rooms</td>
        </tr>
        <tr>
            <th style='background-color: #f2f2f2;'>Adults</th>
            <td>$adults</td>
        </tr>
        <tr>
            <th style='background-color: #f2f2f2;'>Children</th>
            <td>$children</td>
        </tr>
    </table>
";

        $mail->send();
        echo json_encode(['status' => 'success']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $mail->ErrorInfo]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid Request']);
}
