<?php 
$host = "localhost";  
$user = "root";  
$password ="";
$db ="eventhall";  
$conn = mysqli_connect($host,$user,$password,$db);  
if($conn )  
{echo 'Connected successfully<br/>'; 
}
else{
   die('Could not connect: ' . mysqli_connect_error());  
}  
        $email = $_POST['email'];
	$pass = $_POST['psw'];
	$confirmpass = $_POST['repsw'];
        $secure=$_POST['secure'];
        $sql = 'select * from organiser';  
        $retval=mysqli_query($conn,$sql);  
        $i=0;
     if(mysqli_num_rows($retval) > 0){  
     while($row = mysqli_fetch_assoc($retval)){  
     if($email==$row['email'] && $secure==$row['securityquestion']){
      $i++;
$sql="UPDATE organiser SET password='$pass',confirmpassword='$confirmpass' WHERE email
='$email'";
$query=mysqli_query($conn,$sql);
if($query)
    {echo 'data updated';}
}
} }
if($i==0){echo "not updated";}
mysqli_close($conn);
?>