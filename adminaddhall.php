<?php  
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
  
$hallname=$_POST["hallname"];
$capacity=$_POST["capacity"];
$email=$_POST["email"];
$amount=$_POST["amount"];
$mobile=$_POST["mobile"];
$image=$_FILES["image"]["name"];
$address=$_POST["address"];
$host = "localhost";  
$user = "root";  
$pass = "";
$db="eventhall";  
$conn = mysqli_connect($host,$user,$pass,$db);  
if($conn)  
{  
   
}
else{
   die('Could not connect: ' . mysqli_connect_error());  
}  
$inssql="INSERT INTO bookinghalls(hallname,capacity,emailid,amount,phonenum,imghall,address) values(
'$hallname','$capacity','$email','$amount','$mobile','$image','$address')";
$delsql="DELETE FROM requestaddhall WHERE emailid='$email' and address='$address'
and phonenum='$mobile'";
$block=mysqli_query($conn,$inssql);
if($block)
{move_uploaded_file($_FILES['image']['tmp_name'],"imgorgown/$image");
echo "<b>Hall add successfully!\r\n</b>";

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
    $mail->Subject = 'YOUR HALL IS ACTIVE FROM NOW!';
    $mail->Body    = "<b>Hello! mr/mrs Owner of ".$hallname." in "
.$address.".Your request is accepted.Your hall is active.Your hall may get bookings
from now.Please,update availability and amount status according to timeperiod through Owner login 
by your credentials.</b>";
    $mail->AltBody = 'mesg from admin eventhall';
    $mail->send();
    echo "Mail has been sent successfully!";

$mail->smtpClose(); 
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}}
$nblock=mysqli_query($conn,$delsql);

?>

 
