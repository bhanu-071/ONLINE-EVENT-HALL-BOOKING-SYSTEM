<?php
  
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
  
require 'vendor/autoload.php';
  
try {
$mail = new PHPMailer;
 $mail->isSMTP(); 
$mail->Host= 'smtp.gmail.com';
    $mail->SMTPDebug = 0;  
    $mail->SMTPAuth   = true;                             
    $mail->Username   = 'bhanuprakashbobba833@gmail.com';                 
    $mail->Password   = 'wyjiwhpsrpjnegni';                        
    $mail->SMTPSecure = 'TLS';                              
    $mail->Port       = 587; 
  $mail->Port       = 587; 
$mail->SMTPSecure = '';
$mail->smtpConnect([
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    ]
]);
    $mail->setFrom('bhanuprakashbobba833@gmail.com', 'Bhanu B');           
    $mail->addAddress('bbhanuprakash.19.cse@anits.edu.in');
    $mail->isHTML(true);                                  
    $mail->Subject = 'EVENTHALL';
    $mail->Body    = 'HTML message body in <b>HII</b> ';
    $mail->AltBody = 'mesg from admin eventhall';
    $mail->send();
    echo "Mail has been sent successfully!";

$mail->smtpClose(); 
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
  
?>