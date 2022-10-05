<?php  
$hallname=$_POST["hallname"];
$email=$_POST["email"];
$amount=$_POST["amount"];
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
$inssql="UPDATE bookinghalls SET amount='$amount' WHERE hallname='$hallname'
 AND emailid='$email' AND address='$address'";  
$block=mysqli_query($conn,$inssql);
if($block)
{echo "'$sn' rows updated successfully!\n";}}
else{echo "no data exist";}
mysqli_close($conn);
?>
