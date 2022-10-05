<?php  
$hallname=$_POST["hallname"];
$email=$_POST["email"];
$avail=$_POST["avail"];
$fromdate=$_POST["fromdate"];
$todate=$_POST["todate"];
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
$sql="SELECT * FROM bookinghalls WHERE hallname='$hallname'
 AND emailid='$email' AND address='$address'"; 
$result=mysqli_query($conn,$sql);
$sn=0;
if (mysqli_num_rows($result) > 0) {
 $sn++;
$ssql="SELECT * FROM hallsavailaccdate WHERE hallname='$hallname'
 AND date='$date' AND halladdress='$address'"; 
$ressult=mysqli_query($conn,$ssql);
if (mysqli_num_rows($ressult) > 0) {
$upsql="UPDATE hallsavailaccdate SET availability='$avail',fromdate='$fromdate',todate='$todate' WHERE hallname='$hallname'
 AND halladdress='$address'";
$blockk=mysqli_query($conn,$upsql);
if($blockk)
{echo "<b>availability of hall updated successfully\n</b>";}}
else{
$inssql="INSERT INTO hallsavailaccdate (hallname,halladdress,fromdate,todate,availability) VALUES ('$hallname','$address','$fromdate','$todate','$avail')";  
$block=mysqli_query($conn,$inssql);
if($block)
{echo "<b>availability of hall updated successfully\n</b>";}}}
else{echo "no data exist";}
mysqli_close($conn);
?>
