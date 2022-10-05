<?php
session_start();
$email=$_POST['email'];
$fromdate=$_POST['fromdate'];
$todate=$_POST['todate']; 
$eventtype=$_POST['eventtype'];
$starttime=$_POST['starttime'];
$endtime=$_POST['endtime'];
$_SESSION['email']=$email;
$_SESSION['fromdate']=$fromdate;
$_SESSION['todate']=$todate;
$_SESSION['starttime']=$starttime;
$_SESSION['endtime']=$endtime;
$_SESSION['count']=0;
if($_SESSION['username']==$email){
echo "
<html>
<head>
<title>hallbookingorgpage2
</title>
<style>

tr:nth-child(even) {background-color: #f2f2f2;}
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
  animation-duration: 13s;
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
if($fromdate > $todate){
echo "<b>Please enter the dates correctly</b>";}
else{
$currdate=date('Y-m-d');
if($fromdate < $currdate){
echo "<b>Please enter the date from today!</b>";}
if(($fromdate==$todate)&&($starttime >= $endtime)){
echo "<b>Please enter the time correctly</b>";}
else{
echo "<p> <b>Note:</b>choose a hall dropdown shows available halls only i.e you dont
need check for available halls in table.But you have see the amount to be paid and check hallcapacity 
and Hall location inorder to book a hall</p></br>";
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
$sql = "SELECT * FROM bookinghalls";
$result=mysqli_query($conn,$sql);
echo "</br></br>";
echo "

<table border='2' cellspacing='0' cellpadding='10' style='margin-left:600px;' id='myTable'>
<tr>
<td colspan='5'><center><b>AVAILABLE HALLS</b></center></td></tr>
 <tr>
    <th>S.NO</th>
    <th>HallName</th>
    <th>Capacity</th>
    <th>Amount</th>
    <th>Halladdress</th>
  </tr>";
 $sn=1;
if (mysqli_num_rows($result) > 0) {
 
 while($data = mysqli_fetch_assoc($result)){
$flag=1;
$psql="select * FROM hallsavailaccdate";
$pres=mysqli_query($conn,$psql);
if(mysqli_num_rows($pres) > 0){
 while($pdat=mysqli_fetch_assoc($pres)){
   $pt=date("Y-m-d",strtotime($pdat['fromdate']));
   $ptt=date("Y-m-d",strtotime($pdat['todate']));
  if(($pdat['hallname']==$data['hallname'])&&($pdat['halladdress']==$data['address'])){
  if((($pt <= $fromdate)&& ($fromdate <= $ptt))||(($pt <= $todate)&&($todate <= $ptt))||(($pt > $fromdate)&&($ptt < $todate))) {
    $flag=0; 
    break;
     }}
    }}
if($flag==1){
echo "<tr>
   <td>$sn</td>
   <td>$data[hallname]</td>
   <td>$data[capacity]</td>
   <td>$data[amount]</td>
   <td>$data[address]</td>
 </tr>";
  $sn++;}}}
if ($sn==1){ 
  echo "<tr>
     <td colspan='5'>ALL HALLS ARE NOT AVAILABLE</td>
    </tr>
</table> </br></br>";}
$asql="SELECT * FROM bookinghalls";
$aresult=mysqli_query($conn,$asql);
echo "</br><form action='hallbookconfirmorg.php' method='post'><center><label for='halls'>Choose a Hall:</label>
<select name='halls' id='halls' required>
  <option value=''>SELECT</option>";
 if (mysqli_num_rows($aresult) > 0) {
  while($dat= mysqli_fetch_assoc($aresult)) {
$rflag=1; 
$rpsql="select * FROM hallsavailaccdate";
$rpres=mysqli_query($conn,$psql);
if(mysqli_num_rows($rpres) > 0){
 while($rpdat=mysqli_fetch_assoc($rpres)){
   $rpt=date("Y-m-d",strtotime($rpdat['fromdate']));
   $rptt=date("Y-m-d",strtotime($rpdat['todate']));
  if(($rpdat['hallname']==$dat['hallname'])&&($rpdat['halladdress']==$dat['address'])){
  if((($rpt <= $fromdate)&& ($fromdate <= $rptt))||(($rpt <= $todate)&&($todate <= $rptt))||(($rpt > $fromdate)&&($rptt < $todate))) {
    $rflag=0; 
    break;}}}}
if($rflag==1){
  $halln="$dat[hallname]".","."$dat[address]";
 echo "<option value='$halln'>$halln</option>";
}
}}
echo "</select></br></br>
</br><label>Registered Emailid:</label>
<input type='email' id='reemail' name='reemail' value='$email' readonly/></br></br>";
if($eventtype=="Professional"){
echo "</br><label>amount for ticket:</label>
<input type='number' id='ticketamount' name='ticketamount'/></br></br></br>
<label>Eventpurpose:</label>
<select id='eventpurpose' name='eventpurpose' required>
<option value=''>SELECT</option>
<option value='seminar'>seminar</option>
<option value='cultural events'>cultural Events</option>
<option value='Other events'>Other Events</option>
</select></br></br>";}
else{
echo "</br><label>amount for ticket:</label>
<input type='number' id='ticketamount' value=0 name='ticketamount' readonly/></br></br>
</br><label>Eventpurpose:</label>
<select id='eventpurpose' name='eventpurpose' required>
<option value=''>SELECT</option>
<option value='Birthday'>Birthday</option>
<option value='Marriage'>Marriage</option>
<option value='Other functions'>Other functions</option>
</select></br></br>";}
echo "</br><label>Eventname:</label>
<input type='text' id='eventname' name='eventname'/></br></br></br>
<a href='#'><button
style='background-color:LightBlue; float:right; margin-right:540px;border-radius:25px;'><h2><b>Book</b></h2></button></a></br></br></br></br>
</center></form></body></div>
</html>";
$sqlin = "INSERT INTO events(emailid,eventtype,fromdate,todate,starttime,endtime) VALUES ('$email','$eventtype','$fromdate','$todate','$starttime','$endtime')"; 
$resultin=mysqli_query($conn,$sqlin);
$sqls="INSERT INTO hallsavailaccdate (fromdate,todate,availability) VALUES(
'$fromdate','$todate','Available')";
$res=mysqli_query($conn,$sqls);
mysqli_close($conn);}}}
else{
echo "<b>PLEASE ENTER REGISTERED EMAILID</b>";}
echo "
<input type='text' style='margin-left:900px;' id='myInput' onkeyup='myFunction()' placeholder='Search for halladdress..'>
</br></br><script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById('myInput');
  filter = input.value.toUpperCase();
  table = document.getElementById('myTable');
  tr = table.getElementsByTagName('tr');
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName('td')[4];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = '';
      } else {
        tr[i].style.display = 'none';
      }
    }       
  }
}
</script>
";
?>