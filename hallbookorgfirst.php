<?php
echo "<html>
<head>
<title>booking</title>
<style>
tr:nth-child(even) {background-color: #f2f2f2;}
div {
   height:150%;
  background-color: #d2b4ac ;
  animation-name: example;
  animation-duration: 13s;
  animation-iteration-count:infinite;
}
@keyframes example {
  0%   {background-color:#a0d6b4;}
  15%  {background-color: #ff9b94;}
  30%  {background-color: #bc8f8f;}
  45% {background-color: #fffcab;}
  60% {background-color: #D3D3D3;}
  75% {background-color: pink;}
  90% {background-color: #fcdee9;}
}
p{margin-left:200px;
  margin-right:150px;
font-size:20px;}
label{font-size:23px;}

</style>
</head>

<body>
<div>
<a href='http://localhost:8080/logout.php'><button style='border-radius:25px; float:right; margin:15px;'><b style='margin:15px; text-align:center; font-size:25px;'>logout</b></button></a></br></br></br>
<center>
<form action='hallbookorg.php' method='post'>
<h1>HALL BOOKING</h1>
<label>Emailid:</label>
<input type='text' name='email' id='email' required placeholder='enter registered emailid'></br></br>
</br><label>From Date:</label>
<input type='date' name='fromdate' id='fromdate' required placeholder='enter start date'></br></br>
</br><label>Start Time:</label>
<input type='time' name='starttime' id='starttime' required placeholder='enter start time'></br></br>
</br><label>To Date:</label>
<input type='date' name='todate' id='todate' required placeholder='enter end date'></br></br>
</br><label>End Time:</label>
<input type='time' name='endtime' id='endtime' required placeholder='enter end time'></br></br>
</br><label>Event type:</label>
<select name='eventtype' id='eventtype'>
  <option value=''>SELECT</option>
<option value='Professional'>PROFESSIONAL</option>
  <option value='Non Professional'>NON PROFESSIONAL</option>
</select>
<p><b>Note:</b>click on continue button to move further</p>
<a href='#'><button
style='background-color:LightBlue; float:right; margin-right:540px;border-radius:25px;'><h2><b>continue</b></h2></button></a>
</form>";
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
session_start();
$email=$_SESSION['username'];  
$sql = "select * from events where emailid='$email'";
$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) {
echo "<table border='2' cellspacing='0' cellpadding='10' style='margin-left:150px;'>
<tr>
<td colspan='8'><center><b>Bookings table</b></center></td></tr>
 <tr>
    <th>S.NO</th>
    <th>EventName</th>
    <th>Eventpurpose</th>
    <th>Start Date</th>
    <th>End Date</th>
    <th>Hall Details</th>
    <th>Event type</th>
    <th>Total Tickets Booked</th>
  </tr>";
$sn=0;
while($data = mysqli_fetch_assoc($result)) {
$sn=$sn+1;
if($data['eventtype']=="Professional"){
$tc=$data['offlinetickets']+$data['onlinetickets'];}
else{
$tc="NA";}
echo "<tr>
   <td>$sn</td>
   <td>$data[eventname]</td>
   <td>$data[eventpurpose]</td>
   <td>$data[fromdate]</td>
   <td>$data[todate]</td>
   <td>$data[halldetails]</td> 
   <td>$data[eventtype]</td>
   <td>$tc</td> 
 </tr>";}
echo " <form action='cancellation.php' method='post'>
</br></br></br></br><h1>BOOKINGS</h1>
</br><label>Purpose:</label>
<select name='purpose' id='purpose'>
<option>SELECT</option>
<option value='offlineticketsupdation'>offline tickets updation</option>
<option value='cancellation'>cancellation</option>
</select></br></br>
<label>Select an Event:</label>
<select name='usertype' id='usertype'>
  <option>SELECT</option>";
$ssql = "select * from events where emailid='$email'";
$sresult=mysqli_query($conn,$ssql);
if (mysqli_num_rows($sresult) > 0) {
 while($dat = mysqli_fetch_assoc($sresult)){
$val=$dat['eventname']." from ".$dat['fromdate']." to ".$dat['todate']." in ".$dat['halldetails'];
echo "<option value='$val'>$val</option>";}}
echo "</select>
</br></br>
<label>No of tickets:</label>
<input type='number' id='offline' name='offline' placeholder='For cancellation it is optional' style='width:200px;'/></br></br>
<a href='#'><button
style='background-color:LightBlue; float:right; margin-right:560px;border-radius:25px;'><h2><b>Submit</b></h2></button></a>
</br></br></br></br></br>
</center>
</div></body>
</html>";}
mysqli_close($conn);
?>