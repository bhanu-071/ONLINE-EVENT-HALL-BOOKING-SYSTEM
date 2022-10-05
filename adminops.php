<?php
 echo "<html>
<head>
<title>admin operations
</title>
<style>
div {
   height:333%;
  background-color: #d2b4ac;
  margin:0;
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
tr:nth-child(even) {background-color: #f2f2f2;}
p{margin-left:200px;
  margin-right:150px;
font-size:20px;}
label{font-size:23px;}
option{font-size:20px;}
select{width:150px;}
</style>
</head>
<body>
<div>";
session_start();
if($_SESSION['login']){
echo "
<a href='http://localhost:8080/logout.php'><button style='border-radius:25px; float:right; margin:15px;'><b style='margin:15px; text-align:center; font-size:25px;'>logout</b></button></a></br></br></br>
<p> <b>Note:</b>There are tables like block table,request to add hall table as shown below. click the add hall button to add hall and click the block button to block an user
,click the unblock button to unblock an blocked user by seeing the contents of required table.Take block table as reference to block/unblock user,take halls table
as reference to Request table to add hall.</p>";
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
$sql = 'select * from blockusers';
$result=mysqli_query($conn,$sql);
echo "</br></br>";
echo "<table border='2' cellspacing='0' cellpadding='10' style='margin-left:500px;'>
<tr>
<td colspan='6'><center><b>block table</b></center></td></tr>
 <tr>
    <th>S.NO</th>
    <th>Name</th>
    <th>Emailid</th>
    <th>Mobile No</th>
    <th>usertype</th>
    <th>Address</th>
  </tr>";
if (mysqli_num_rows($result) > 0) {
  $sn=1;
  while($data = mysqli_fetch_assoc($result)) {
echo "<tr>
   <td>$sn</td>
   <td>$data[name]</td>
   <td>$data[Emailid]</td>
   <td>$data[phonenum]</td>
   <td>$data[usertype]</td>
   <td>$data[address]</td> 
 </tr>";
  $sn++;}} 
if (mysqli_num_rows($result)== 0){ 
  echo "<tr>
     <td colspan='6'>No data found</td>
    </tr>
</table> </br></br></br>";}
$reqsql = 'select * from requestaddhall';
$hallresult=mysqli_query($conn,$reqsql);
echo "</br></br>";
echo "<table border='2' cellspacing='0' cellpadding='10' style='margin-left:500px;'>
<tr>
<td colspan='7'><center><b>Request table to addhall</b></center></td></tr>
 <tr>
    <th>S.NO</th>
    <th>Hall_Name</th>
    <th>capacity</th>
    <th>Emailid</th>
    <th>amount</th>
    <th>Phone_num</th>
    <th>Address</th>
  </tr>";
if (mysqli_num_rows($hallresult) > 0) {
  $s=1;
  while($dat = mysqli_fetch_assoc($hallresult)) {
echo "<tr>
   <td>$s</td>
   <td>$dat[hallname]</td>
   <td>$dat[capacity]</td>
   <td>$dat[emailid]</td>
   <td>$dat[amount]</td>
   <td>$dat[phonenum]</td>
   <td>$dat[address]</td> 
 </tr>";
  $s++;}} 
if (mysqli_num_rows($hallresult)== 0){ 
  echo "<tr>
     <td colspan='7'>No data found</td>
    </tr>
</table></br></br>";}
echo "<h1><center>Block user</center></h1>
<form action='block.php' method='post'><center>
<label>Emailid:</label>
<input type='text' name='email' id='email' required placeholder='Required'></br></br>
<label>Usertype:</label>
<select name='usertype' id='usertype'>
  <option>select</option>
  <option value='organiser'>organiser</option>
  <option value='participant'>participant</option>
  <option value='owner'>owner</option>
</select></br></br>
<a href='#'><button
style='background-color:LightBlue; float:right; margin-right:560px;border-radius:25px;'><h2><b>block</b></h2></button></a>
</br></br></center></form>
</br></br><h1><center>Unblock user</center></h1>
<form action='unblock.php' method='post'><center>
<label>Emailid:</label>
<input type='text' name='email' id='email' required placeholder='Required'></br></br>
<label>Usertype:</label>
<select name='usertype' id='usertype'>
  <option>select</option>
  <option value='organiser'>organiser</option>
  <option value='participant'>participant</option>
  <option value='owner'>owner</option>
</select></br></br>
<a href='#'><button
style='background-color:LightBlue; float:right; margin-right:540px;border-radius:25px;'><h2><b>unblock</b></h2></button></a>
</br></br></center></form>
</br></br>";
$addsql = 'select * from bookinghalls';
$halladdresult=mysqli_query($conn,$addsql);
echo "</br></br>";
echo "<table border='2' cellspacing='0' cellpadding='10' style='margin-left:500px;'>
<tr>
<td colspan='8'><center><b>Bookinghalls</b></center></td></tr>
 <tr>
    <th>S.NO</th>
    <th>Hall_Name</th>
    <th>capacity</th>
    <th>Emailid</th>
    <th>amount</th>
    <th>Phone_num</th>
    <th>Address</th>
    
  </tr>";
if (mysqli_num_rows($halladdresult) > 0) {
  $si=1;
  while($datas = mysqli_fetch_assoc($halladdresult)) {
echo "<tr>
   <td>$si</td>
   <td>$datas[hallname]</td>
   <td>$datas[capacity]</td>
   <td>$datas[emailid]</td>
   <td>$datas[amount]</td>
   <td>$datas[phonenum]</td>
   <td>$datas[address]</td> 
 </tr>";
  $si++;}} 
if (mysqli_num_rows($halladdresult)== 0){ 
  echo "<tr>
     <td colspan='7'>No data found</td>
    </tr>
</table>";}
echo "<h1><center>Add Hall</center></h1>
<form action='adminaddhall.php' method='post' enctype='multipart/form-data'><center>
<label>Hall Name:</label>
<input type='text' name='hallname' id='hallname' required placeholder='Required'></br>
</br><label>Capacity:</label>
<input type='number' name='capacity' id='capacity' required placeholder='Required'></br>
</br><label>owner emailid:</label>
<input type='email' name='email' id='email' required placeholder='Required'/></br>
</br><label>owner mobile_no:</label>
<input type='number' name='mobile' id='mobile' required placeholder='Required'/></br>
</br><label>Amount:</label>
<input type='number' name='amount' id='amount' required placeholder='Required'/></br>
</br><label for='image'>Upload Hall image:</label>
<input type='file' id='image' name='image' accept='image/*' required/></br> 
</br><label for='address'>Address:</label></br>
<textarea rows='8' cols='65' id='address' name='address' required placeholder='Required'>
</textarea></br></br>
<a href='#'><button
style='background-color:LightBlue; float:right; margin-right:540px;border-radius:25px;'><h2><b>Add Hall</b></h2></button></a>
</br></br></br></br>
</center></form>
</br></br>";

echo "<h1><center>Remove Hall</center></h1>
<form action='adminremovehall.php' method='post'><center>
<label>Hall Name:</label>
<input type='text' name='hallname' id='hallname' required placeholder='Required'></br>
</br><label>Capacity:</label>
<input type='number' name='capacity' id='capacity' required placeholder='Required'></br>
</br><label>owner emailid:</label>
<input type='email' name='email' id='email' required placeholder='Required'/></br>
</br><label for='address'>Address:</label></br>
<textarea rows='8' cols='65' id='address' name='address' required placeholder='Required'>
</textarea></br></br>
<a href='#'><button
style='background-color:LightBlue; float:right; margin-right:540px;border-radius:25px;'><h2><b>Remove Hall</b></h2></button></a>
</br></br></br></br>
</center></form>
</div>
</body>
</html>";
mysqli_close($conn);}
else{
echo "successfully logout and session has ended </br>";
echo "Login Again";}
?>              