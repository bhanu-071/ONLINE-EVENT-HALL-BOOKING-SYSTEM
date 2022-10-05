<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
  
$email=$_POST["reemail"];
$halldet=$_POST["halls"];
$ticamount=$_POST["ticketamount"]; 
$eventpurpose=$_POST["eventpurpose"];
$eventname=$_POST["eventname"];
$cur=DATE('Y-m-d');
session_start();
$_SESSION['halldet']=$halldet;
$_SESSION['ticamount']=$ticamount;
$_SESSION['eventpurpose']=$eventpurpose;
$_SESSION['eventname']=$eventname;
$fdate=strtotime($_SESSION['fromdate']);
$stime=$_SESSION['starttime'];
$tdate=strtotime($_SESSION['todate']);
$etime=$_SESSION['endtime'];
$diff=$tdate-$fdate;

$diff=round($diff / (60 * 60 * 24));
$diff=$diff+1;
$fdate=$_SESSION['fromdate'];
$tdate=$_SESSION['todate'];
if($_SESSION['login']){
$status="successful";
$host = "localhost";  
$user = "root";  
$pass = "";
$db="eventhall";  
$conn = mysqli_connect($host,$user,$pass,$db);  
if($conn )  
{ }
else{
   die('Could not connect: ' . mysqli_connect_error());  
} 
$ssql="select * from bookinghalls";
$sresult=mysqli_query($conn,$ssql);
if (mysqli_num_rows($sresult) > 0) {
  while($dat= mysqli_fetch_assoc($sresult)) {
  $halln="$dat[hallname]".","."$dat[address]";
  if($halln==$halldet){
$hallname=$dat['hallname'];
$address=$dat['address'];
$abc=$dat['emailid'];
$_SESSION['owneremail']=$abc;
$x=$dat['amount'];
$x=$x*$diff;
$y=$dat['capacity'];
$insql="Update events SET capacity='$dat[capacity]',halldetails='$halldet',eventpurpose='$eventpurpose',eventname='$eventname',amount='$ticamount',status='$status' WHERE emailid='$email' AND halldetails=''";
$inresult=mysqli_query($conn,$insql);
$sqls="UPDATE hallsavailaccdate SET hallname='$dat[hallname]',halladdress='$dat[address]',hallid='$dat[hallid]',availability='Not Available' 
WHERE hallname='' AND halladdress='' AND availability='Available'";
mysqli_query($conn,$sqls);
}}} 
$_SESSION['amount']=$x;
echo '<h1 style="margin-left:550px; font-size:40px;"><b>Hall Booked Successfully</b></h1>';
  echo "<p style='margin-left:250px; font-size:30px;'><b>Email:</b>$email</br></p>";
  echo "<p style='margin-left:250px; font-size:30px;'><b>Event Name:</b>$eventname</br></p>";
  echo "<p style='margin-left:250px; font-size:30px;'><b>Event Purpose:</b>$eventpurpose</br></p>";
  echo "<p style='margin-left:250px; font-size:30px;'><b>From Date:</b>$fdate</br></p>";
  echo "<p style='margin-left:250px; font-size:30px;'><b>Start Time:</b>$stime</br></p>";
  echo "<p style='margin-left:250px; font-size:30px;'><b>To Date:</b>$tdate</br></p>";
  echo "<p style='margin-left:250px; font-size:30px;'><b>End Time:</b>$etime</br></p>";
echo "<p style='margin-left:250px; font-size:30px;'><b>Halldetails:</b>$halldet</br></p>";
echo "<p style='margin-left:250px; font-size:30px;'><b>Capacity:</b>$y</br></p>";
echo "<p style='margin-left:250px; font-size:30px;'><b>Amount per ticket:</b>$ticamount</br></p>";
echo "<p style='margin-left:250px; font-size:30px;'><b>Amount to be paid:</b>$x</br></p>";
echo "</br><a href='http://localhost:8080/organiserrecipt.php'><button
style='background-color:LightBlue; float:left; margin-left:260px;border-radius:25px;'><h2><b>Download</b></h2></button></a>";
echo "</br><a href='http://localhost:8080/logout.php'><button
style='background-color:LightBlue; float:right; margin-right:260px;border-radius:25px;'><h2><b>Logout</b></h2></button></a>";
$curdat=date('Y-m-d');
$psql="select * from events";
$rsl=mysqli_query($conn,$psql);
if(mysqli_num_rows($rsl) > 0){
 while($sdat=mysqli_fetch_assoc($rsl)){
 if($sdat['fromdate'] < $curdat)
 {$sqlp="delete from events where halldetails='$sdat[halldetails]'";
  mysqli_query($conn,$sqlp);}}} 
$qsql="select * from hallsavailaccdate";
$qrsl=mysqli_query($conn,$qsql);
if(mysqli_num_rows($qrsl) > 0){
 while($qdat=mysqli_fetch_assoc($qrsl)){
 if($qdat['fromdate'] < $curdat)
 {$sqlq="delete from hallsavailaccdate where halladdress='$qdat[halladdress]'";
  mysqli_query($conn,$sqlq);}}} 
mysqli_close($conn);
if($_SESSION['count']==0){
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
    $mail->addAddress($abc);
    $mail->isHTML(true);                                  
    $mail->Subject = 'YOUR HALL IS BOOKED!';
    $mail->Body    = "<b>Hello! mr/mrs Owner of ".$halldet.".Your hall is booked by organiser whose emailid is ".$email.".He/She has to paid 
amount of RS.".$x."The type of event is ".$eventpurpose." and event nane is ".$eventname."The event should be held from ".$fdate." at ".$stime." to ".$tdate." at ".$etime.".If he/she doesnt pay you on two days before event,you can set available of your hall on those days according to timeperiod through Owner login 
by your credentials.</b>";
    $mail->AltBody = 'mesg from admin eventhall';
    $mail->send();
$mail->smtpClose(); 
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}}}
$_SESSION['count']=1;
?>