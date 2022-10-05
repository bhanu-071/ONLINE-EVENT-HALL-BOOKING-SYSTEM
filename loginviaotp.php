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
if($conn)  
{  
   
}
else{
   die('Could not connect: ' . mysqli_connect_error());  
}  
$flag=0;
switch ($username) {
  case "organiser":
    $sql = 'select * from organiser'; 
    break;
  case "owner":
    $sql = 'select * from owner'; 
    break;
  case "participant":
    $sql = 'select * from participant'; 
    break;} 
$retval=mysqli_query($conn,$sql);  
  $i=0;
if(mysqli_num_rows($retval) > 0){  
 while($row = mysqli_fetch_assoc($retval)){  
   if($email==$row['email']){
$flag=1;
}}}
if($flag==1){
$x2=rand(10000,99000);
session_start();
$_SESSION['otpp']=$x2;
$_SESSION['utype']=$username;
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
    $mail->Subject = 'YOUR ARE READY TO LOGIN NOW!';
    $mail->Body    = "<b>Hello! ".$username." You are login to VEDHIKA website by verifying this otp: ".$x2."</b>";
    $mail->AltBody = 'mesg from admin eventhall';
    $mail->send();
    echo "";

$mail->smtpClose(); 
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

echo "<!DOCTYPE html>
<html>
<head>
<style>
body {
  /* The image used */
  background-image: url('http://localhost:8080/imageloginviaotp.webp');
  /* Center and scale the image nicely */
  background-attachment:absolute;
  margin:0;
  background-repeat: no-repeat;
  background-size: cover;
  height:100%;
  width:100%;
}
b{font-size:20px;}
form{margin-left:250px:}
</style>
</head>
<body>
  <form style='margin-top:300px;' action='loginviaotpverify.php' method='post'>
   <center><h1>Login</h1>
<label for='otp'><b>Email: </b></label>
    <input type='text' name='email' value='$email'></br></br>   
 <label for='otp'><b>Otp: </b></label>
    <input type='text' placeholder='enter otp' name='otp' required></br></br>
   <button type='submit' style='font-color:white; margin-left:250px; border-radius:25px;'>proceed</button>
  </center></form>
</body>
</html>";
}
else{echo "user is not exist in $username";}
