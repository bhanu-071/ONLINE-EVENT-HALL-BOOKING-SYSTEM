<?php  
$name=$_POST["email"];  
$password=$_POST["psw"];
session_start();
$_SESSION['login']=true;
$host = "localhost";  
$user = "root";  
$pass = "";
$db="eventhall";  
$conn = mysqli_connect($host,$user,$pass,$db);  
if($conn )  
{  
   
}
else{
   die('Could not connect: ' . mysqli_connect_error());  
}  
$sql = 'select * from admin';  
$retval=mysqli_query($conn,$sql);  
  $i=0;
if(mysqli_num_rows($retval) > 0){  
 while($row = mysqli_fetch_assoc($retval)){  
   if($name==$row['email'] && $password==$row['password']){
      $i++;
      echo '<h1 style="margin-left:250px;"><b>Login successfully!</b></h1><br/>';
echo "<img src='http://localhost:8080/adminlogin.gif' style='
margin-left:350px;'/>";
echo '<h2><p style="margin-left:250px;">click the proceed button to add a hall and to make modifications</p></h2>';
echo "</br><a href='http://localhost:8080/adminops.php'><button style='background-color:LightBlue; float:right; margin-right:260px;border-radius:25px;'><h2><b>Proceed</b></h2></button></a>";
    } 
  } //end of while  
   
  }
if($i==0){
  echo "Invalid User";
}

mysqli_close($conn);  
?>