<?php
 echo "<html>
<head>
<title>seat booking
</title>
<style>
div {
   height:310%;
  background-color: #ff8d85;
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
<div>
<p> <b>Note:</b>There is a table about upcoming events. You can select a hall by seeing the contents of table. </p>";
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
$sql = "select * from events where eventtype='Professional'";
$result=mysqli_query($conn,$sql);
echo "</br></br>";
echo "<table border='2' cellspacing='0' cellpadding='10' style='margin-left:230px;' id='myTable'>
<tr>
<td colspan='9'><center><b>Upcoming Events</b></center></td></tr>
 <tr>
    <th>S.NO</th>
    <th>Event Name</th>
    <th>Event Purpose</th>
    <th>From Date</th>
    <th>Start Time</th>
    <th>To Date</th>
    <th>End Time</th>
    <th>Hall Details</th>
    <th>Ticket Amount</th>    
  </tr>";
if (mysqli_num_rows($result) > 0) {
  $sn=1;
  while($data = mysqli_fetch_assoc($result)) {
echo "<tr>
   <td>$sn</td>
   <td>$data[eventname]</td>
   <td>$data[eventpurpose]</td>
   <td>$data[fromdate]</td>
   <td>$data[starttime]</td>
   <td>$data[todate]</td>
   <td>$data[endtime]</td>
    <td>$data[halldetails]</td>
   <td>$data[amount]</td>
 </tr>";
  $sn++;}} 
if (mysqli_num_rows($result)== 0){ 
  echo "<tr>
     <td colspan='9'>No data found</td>
    </tr>
</table> </br></br></br>";}
$ssql = "select * from events where eventtype='Professional'";
$rsult=mysqli_query($conn,$ssql);
echo "</br><form action='seatbookconfirmorg.php' method='post'><center>
<label>Registered Emailid:</label>
<input type='email' id='email' name='email' required placeholder='Enter Registered Emailid'/></br></br>
<label for='events'>Choose an Event:</label>
<select name='events' id='events' required>
  <option value=''>SELECT</option>";
 if (mysqli_num_rows($rsult) > 0) {
 $t=date('H:i');
$d=date('Y-m-d');
  while($dat= mysqli_fetch_assoc($rsult)) {
if(($d < $dat['fromdate']) || (($d==$dat['fromdate'])&&($t < $dat['starttime'])))
{$eve=$dat['eventname']." in ".$dat['halldetails']." on ".$dat['fromdate'];
 echo "<option value='$eve'>$eve</option>";
 } }}
echo "</select></br></br>
<a href='#'><button
style='background-color:LightBlue; float:right; margin-right:540px;border-radius:25px;'><h2><b>Book</b></h2></button></a></br></br></br></br>
</center></form></body></div>
<input type='text' style='margin-left:900px;' id='myInput' onkeyup='myFunction()' placeholder='Search for halldetails..'>
</br></br><script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById('myInput');
  filter = input.value.toUpperCase();
  table = document.getElementById('myTable');
  tr = table.getElementsByTagName('tr');
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName('td')[7];
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