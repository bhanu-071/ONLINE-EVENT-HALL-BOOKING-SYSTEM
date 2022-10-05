<?php 
$host = "localhost";  
$user = "root";  
$password ="";
$db ="eventhall";  
$conn = mysqli_connect($host,$user,$password,$db);  
if($conn )  
{ 
}
else{
   die('Could not connect: ' . mysqli_connect_error());  
}  
$email=$_POST['reemail'];
$eventname=$_POST['eventname'];
$eventpurpose=$_POST['eventpurpose'];
$tick=$_POST['tickets'];
$fdate=$_POST['fromdate'];
$tdate=$_POST['todate'];
$stime=$_POST['starttime'];
$etime=$_POST['endtime'];
session_start();
$tot=$_SESSION['amount'];
$tot=$tot*$tick;
$_SESSION['tot']=$tot;
$halldeta=$_SESSION['halldetails'];
$cap=$_SESSION['capacity'];
if($tick<=0){
echo "<b>Please enter the no of tickets correctly</b>";}
else{
if($tick>1){
$s="seat".$cap." - seat";}
else{
$s="seat";}
$cap=$cap-$tick+1;
$s=$s.$cap;
$cap=$cap-1;
$onlinflag=$_SESSION['onlintickflag'];
if($onlinflag==0){
$_SESSION['seats']=$s;
$onlin=$_SESSION['onlinetickets'];
$onlin=$onlin+$tick;
$_SESSION['onlinetickets']=$onlin;
$psql="UPDATE events SET capacity='$cap',onlinetickets='$onlin' where eventtype='Professional' and halldetails='$halldeta' and fromdate='$fdate'";
$esult=mysqli_query($conn,$psql);
$_SESSION['onlintickflag']=1;}
echo '<h1 style="margin-left:550px; font-size:40px;"><b>Tickets Booked Successfully</b></h1>';
  echo "<p style='margin-left:250px; font-size:30px;'><b>Email:</b>$email</br></p>";
  echo "<p style='margin-left:250px; font-size:30px;'><b>Event Name:</b>$eventname</br></p>";
  echo "<p style='margin-left:250px; font-size:30px;'><b>Event Purpose:</b>$eventpurpose</br></p>";
  echo "<p style='margin-left:250px; font-size:30px;'><b>From Date:</b>$fdate</br></p>";
  echo "<p style='margin-left:250px; font-size:30px;'><b>Start Time:</b>$stime</br></p>";
  echo "<p style='margin-left:250px; font-size:30px;'><b>To Date:</b>$tdate</br></p>";
  echo "<p style='margin-left:250px; font-size:30px;'><b>End Time:</b>$etime</br></p>";
echo "<p style='margin-left:250px; font-size:30px;'><b>Halldetails:</b>$halldeta</br></p>";
  echo "<p style='margin-left:250px; font-size:30px;'><b>Total amount to be paid:</b>$tot</br></p>";
echo "<p style='margin-left:250px; font-size:30px;'><b>Seat Numbers:</b>$s</br></p>";
echo "</br><a href='http://localhost:8080/participantrecipt.php'><button
style='background-color:LightBlue; float:left; margin-left:260px;border-radius:25px;'><h2><b>Download</b></h2></button></a>";
echo "</br><a href='http://localhost:8080/logout.php'><button
style='background-color:LightBlue; float:right; margin-right:260px;border-radius:25px;'><h2><b>Logout</b></h2></button></a>";
}
?>
