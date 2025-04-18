<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Server settings
require('phpmailer/PHPMailerAutoload.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $flag = $_POST['flag'] ?? '';
    if (isset($_POST['flag']) && $_POST['flag'] == 'bookingEngine') {
        $name     = $_POST['name'] ?? '';
        $phone    = $_POST['phone'] ?? '';
        $checkin  = $_POST['checkin'] ?? '';
        $checkout = $_POST['checkout'] ?? '';
        $rooms    = $_POST['rooms'] ?? '';
        $adults   = $_POST['adults'] ?? '';
        $children = $_POST['children'] ?? '';
    } else if (isset($_POST['flag']) && $_POST['flag'] == 'eventForm') {
        $name     = $_POST['name'] ?? '';
        $phone    = $_POST['phone'] ?? '';
        $email  = $_POST['email'] ?? '';
        $event_type = $_POST['event_type'] ?? '';
        $people    = $_POST['people'] ?? '';
        $event_date   = $_POST['event_date'] ?? '';
        $message = $_POST['message'] ?? '';
    } else if (isset($_POST['flag']) && $_POST['flag'] == 'offerForm') {
        $name     = $_POST['name'] ?? '';
        $phone    = $_POST['phone'] ?? '';
        $email  = $_POST['email'] ?? '';
        $offer = $_POST['offer'] ?? '';
        $message = $_POST['message'] ?? '';
    } else if (isset($_POST['flag']) && $_POST['flag'] == 'contactForm') {
        $name     = $_POST['name'] ?? '';
        $phone    = $_POST['phone'] ?? '';
        $email  = $_POST['email'] ?? '';
        $subject = $_POST['subject'] ?? '';
        $message = $_POST['message'] ?? '';
    }

    try {
        // Server settings
        $mail = new PHPMailer(); // create a new object
        //$mail->IsSMTP(); // enable SMTP
        $mail->SMTPDebug = 2; // debugging: 1 = errors and messages, 2 = messages only
        //$mail->SMTPAuth = true; // authentication enabled
        //$mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = "localhost";
        $mail->Port = 25;
        $mail->IsHTML(true);

        // Sender & Receiver

        switch ($flag) {
            case 'bookingEngine':
                $toEmail = 'avinash8564kumar@gmail.com';  // replace with your email if multiple recipients then add their emails sperate with comma
                $fromEmail = 'avinash.mogulas@gmail.com';  // replace with your email
                $fromName = 'Booking Enquiry in Mohali-Se';
                $subject = 'New Booking Enquiry';
                $fields = [
                    'Name' => $name,
                    'Phone' => $phone,
                    'Check-in' => $checkin,
                    'Check-out' => $checkout,
                    'Rooms' => $rooms,
                    'Adults' => $adults,
                    'Children' => $children,
                ];
                break;
            case 'eventForm':
                $toEmail = 'avinash8564kumar@gmail.com';  // replace with your email if multiple recipients then add their emails sperate with comma
                $fromEmail = 'avinash.mogulas@gmail.com'; // replace with your email
                $fromName = 'Event Enquiry in Mohali-Se';
                $subject = 'New Event Enquiry';
                $fields = [
                    'Name' => $name,
                    'Phone' => $phone,
                    'Email' => $email,
                    'Event Type' => $event_type,
                    'No Of Guest' => $people,
                    'Event Data' => $event_date,
                    'Message' => $message,
                ];
                break;
            case 'offerForm':
                $toEmail = 'avinash8564kumar@gmail.com';  // replace with your email if multiple recipients then add their emails sperate with comma
                $fromEmail = 'avinash.mogulas@gmail.com'; // replace with your email
                $fromName = 'Offer Enquiry in Mohali-Se';
                $subject = 'New Offer Enquiry';
                $fields = [
                    'Name' => $name,
                    'Phone' => $phone,
                    'Email' => $email,
                    'Offer' => $offer,
                    'Message' => $message,
                ];
                break;
            case 'contactForm':
                $toEmail = 'avinash8564kumar@gmail.com';  // replace with your email if multiple recipients then add their emails sperate with comma
                $fromEmail = 'avinash.mogulas@gmail.com'; // replace with your email
                $fromName = 'Contact Enquiry in Mohali-Se';
                $subject = 'New Contact Enquiry';
                $fields = [
                    'Name' => $name,
                    'Phone' => $phone,
                    'Email' => $email,
                    'Subject' => $subject,
                    'Message' => $message,
                ];
                break;
            default:
                echo json_encode(['status' => 'error', 'message' => 'Invalid Form Submit Request']);
                exit;
        }

        $mail->setFrom($fromEmail, $fromName);
        $mail->addAddress($toEmail);

        // if need to send multiple mails, just uncomment below line and add more recipient emails

        // // Convert to array if needed
        // $toEmails = is_array($toEmail) ? $toEmail : explode(',', $toEmail);

        // // Loop and add all addresses
        // foreach ($toEmails as $email) {
        //     $mail->addAddress(trim($email));
        // }  

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $body = "<h2>$subject</h2>";
        $body .= "<table border='1' cellpadding='10' cellspacing='0' style='border-collapse: collapse; width: 100%;'>";
        foreach ($fields as $key => $value) {
            $body .= "
        <tr>
            <th style='background-color: #f2f2f2;'>$key</th>
            <td>$value</td>
        </tr>";
        }
        $body .= "</table>";

        $mail->Body = $body;

        $mail->send();
        echo json_encode(['status' => 'success']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $mail->ErrorInfo]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid Request']);
}
