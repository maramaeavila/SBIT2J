<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'smtpConfig.php';

if (isset($_POST["send"])) {

    /* Customer Acknowledgement Message */

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = 'smtp.gmail.com';
    $mail->Username = 'romero.markkevin.malapit5@gmail.com';
    $mail->Password = 'layo xocc vanh yblt';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('romero.markkevin.malapit5@gmail.com');
    $mail->addAddress($_POST["email"]);
    $mail->isHTML(false);
    $mail->Subject = 'Acknowledgement of Your Inquiry';
    $customerMessage = "Dear " . $_POST['name'] . ",\n\n";
    $customerMessage .= "Thank you for contacting us. We've received your message and are currently reviewing it. We'll get back to you shortly.\n\n";
    $customerMessage .= "Best regards,\nRenz and Co."; 

    $mail->Body = $customerMessage;

    /* Customer Message Received By Admin*/

    $adminMail = new PHPMailer(true);
    $adminMail->isSMTP();
    $adminMail->SMTPAuth = true;
    $adminMail->Host = 'smtp.gmail.com';
    $adminMail->Username = 'romero.markkevin.malapit5@gmail.com';
    $adminMail->Password = 'layo xocc vanh yblt';
    $adminMail->SMTPSecure = 'ssl';
    $adminMail->Port = 465;

    $adminMail->setFrom($_POST["email"]);
    $adminMail->addAddress('romero.markkevin.malapit5@gmail.com');
    $adminMail->isHTML(false);
    $adminMail->Subject = 'Customer Contact Us Messages';
    $adminMail->Body = $_POST["message"];



    if ($mail->send() && $adminMail->send()) {
        echo "
                <script>
                    alert('Sent Successfully');  
                    window.location.href = 'contactus.php';
                </script>
            ";
    } else {
        echo "
            <script>
                alert('Not sent');  
                window.location.href = 'contactus.php';
            </script>
        ";
    }
}
