<?php  
$hallname=$_POST["hallname"];
$capacity=$_POST["capacity"];
$email=$_POST["email"];
$amount=$_POST["amount"];
$mobile=$_POST["mobile"];
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
$inssql="INSERT INTO requestaddhall(hallname,capacity,emailid,amount,phonenum,address) values(
'$hallname','$capacity','$email','$amount','$mobile','$address')";
$block=mysqli_query($conn,$inssql);
if($block)
{echo "<b>Request added Successfully.Your hall willbe active within 3 days.we intimate you when your hall is active</b>";}

 