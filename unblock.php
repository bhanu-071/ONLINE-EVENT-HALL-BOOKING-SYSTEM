<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception; 
$email=$_POST["email"];  
$username=$_POST["usertype"];
$host = "localhost";  
$user = "root";  
$pass = "";
$db="eventhall";  
$conn = mysqli_connect($host,$user,$pass,$db);  
if($conn )  
{  
   
}
else{
   die('Could not connect: ' . mysqli_connect_error());  
}  
    $sql = 'select * from blockusers'; 
$retval=mysqli_query($conn,$sql);  
  $i=0;
if(mysqli_num_rows($retval) > 0){  
 while($row = mysqli_fetch_assoc($retval)){  
   if($email==$row['Emailid'] && $username==$row['usertype']){
  $delsql="DELETE FROM blockusers WHERE Emailid='$email' AND usertype='$username'";
$result=mysqli_query($conn,$delsql);
if($result){
echo "unblocked the user successfully!";
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
    $mail->setFrom('bhanuprakashbobba833@gmail.com', 'VEDHIKA');           
    $mail->addAddress($email);
    $mail->isHTML(true);                                  
    $mail->Subject = 'YOUR ARE BLOCKED FROM NOW!';
    $mail->Body    = "<b>Hello! ".$username." You are blocked and not able to do any operations.To unblock contact admin from VEDHIKA website.</b>";
$mail->Subject = 'YOUR ARE UNBLOCKED FROM NOW!';
    $mail->Body    = "<b>Hello! ".$username."Thank you for contacting us. You are unblocked and  able to do any operations.</b>";
$mail->AltBody = 'mesg from admin eventhall';
    $mail->send();
    echo "Mail has been sent successfully!";

$mail->smtpClose(); 
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}}

}}
mysqli_close($conn);
?>