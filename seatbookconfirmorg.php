<?php
session_start();
$email=$_POST['email'];
$eventinfo=$_POST['events'];
if($_SESSION['username']==$email){
$_SESSION['emailid']=$email;
echo "<html>
<head>
<title>hallbookingorgpage2
</title>
<style>
p{margin-left:200px;
  margin-right:150px;
font-size:20px;}
label{font-size:23px;}
option{font-size:20px;}
select{width:150px;}
div {
   height:110%;
  background-color: #96c882;
  animation-name: example;
  animation-duration: 10s;
  animation-iteration-count:infinite;
}

@keyframes example {
  0%   {background-color:#a0d6b4;}
  15%  {background-color: #d2b4ac;}
  30%  {background-color: #bc8f8f;}
  45% {background-color: #9ab937;}
  60% {background-color: #D3D3D3;}
  75% {background-color: #afeeee;}
  90% {background-color: #e8f48c;}
}
</style>
</head>
<body>
<div>";
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
$psql = "select * from events where eventtype='Professional'";
$esult=mysqli_query($conn,$psql);
if (mysqli_num_rows($esult) > 0) {
  while($att= mysqli_fetch_assoc($esult))
{$eve=$att['eventname']." in ".$att['halldetails']." on ".$att['fromdate'];
 if($eve==$eventinfo){
$_SESSION['orgemail']=$att['emailid'];
$_SESSION['eventname']=$att['eventname'];
$_SESSION['eventpurpose']=$att['eventpurpose'];
$_SESSION['fromdate']=$att['fromdate'];
$_SESSION['starttime']=$att['starttime'];
$_SESSION['todate']=$att['todate'];
$_SESSION['endtime']=$att['endtime'];
$_SESSION['capacity']=$att['capacity'];
$_SESSION['onlinetickets']=$att['onlinetickets'];
$_SESSION['amount']=$att['amount'];
$_SESSION['halldetails']=$att['halldetails'];
echo "</br><form action='seatconfirm.php' method='post'><center>
<label>Registered Emailid:</label>
<input type='email' id='reemail' name='reemail' value='$email' readonly/></br></br>
</br>
<label>Eventname:</label>
<input type='text' id='eventname' name='eventname' value='$att[eventname]' readonly></br></br></br>
<label>Eventpurpose:</label>
<input type='text' id='eventpurpose' name='eventpurpose' value='$att[eventpurpose]' readonly></br></br></br>
<label>From Date:</label>
<input type='date' id='fromdate' name='fromdate' value='$att[fromdate]' readonly></br></br></br>
<label>Start Time:</label>
<input type='text' id='starttime' name='starttime' value='$att[starttime]' readonly></br></br></br>
<label>To Date:</label>
<input type='date' id='todate' name='todate' value='$att[todate]' readonly></br></br></br>
<label>End Time:</label>
<input type='text' id='endtime' name='endtime' value='$att[endtime]' readonly></br></br></br>
</br><label>Seats:</label>";
if($att['capacity']!=0){
$cap="AVAILABLE-".$att['capacity'];
echo "<b><input type='text' id='avail' name='avail' style='color:green;' value='$cap' readonly/></b></br></br></br>";}
else{
echo "<b><input type='text' id='avail' name='avail' style='color:blue;' value='Not Available' readonly/></b></br></br></br>";}
echo "<label>No of Tickets:</label>
<input type='number' id='tickets' name='tickets'/></br></br></br>
<a href='#'><button
style='background-color:LightBlue; float:right; margin-right:540px;border-radius:25px;'><h2><b>Book</b></h2></button></a></br></br></br></br>
</center></form></body></div>";
 } }}
$_SESSION['onlintickflag']=0;
mysqli_close($conn);}
else{
echo "<b>PLEASE ENTER REGISTERED EMAILID</b>";
}
