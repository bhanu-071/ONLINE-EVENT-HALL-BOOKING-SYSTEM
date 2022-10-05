<?php 
$host = "localhost";  
$user = "root";  
$password ="";
$db ="eventhall";  
$conn = mysqli_connect($host,$user,$password,$db);  
if($conn )  
{ 
}
else{
   die('Could not connect: ' . mysqli_connect_error());  
}  
 	$firstname = $_POST['firstname'];
        $middlename = $_POST['middlename'];
	$lastname = $_POST['lastname'];
	$phonenum = $_POST['phonenum'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$confirmpassword = $_POST['confirmpassword'];
        $image=$_FILES["image"]["name"];
        $address=$_POST['address'];
        $secure=$_POST['food'];
$c=$firstname." ".$middlename." ".$lastname;
if($password!=$confirmpassword){
echo "error:please enter password and confirmpassword as same";}
else if(preg_match('/^[0-9]{10}+$/', $phonenum)){
   $sql="INSERT INTO owner(firstname,middlename,lastname,phonenum,email,password,
confirmpassword,imgsign,address,securityquestion) values ('$firstname','$middlename','$lastname','$phonenum',
'$email','$password','$confirmpassword','$image','$address','$secure')";
$query=mysqli_query($conn,$sql);
if($query)
    {move_uploaded_file($_FILES['image']['tmp_name'],"imgorgown/$image");
echo '<h1 style="margin-left:550px; font-size:40px;"><b>Registration Details</b></h1><br/>';
  echo "<p style='margin-left:250px; font-size:30px;'><b>Name:</b>$c</br></p>";
  echo "<p style='margin-left:250px; font-size:30px;'><b>Phonenumber:</b>$phonenum</br></p>";
  echo "<p style='margin-left:250px; font-size:30px;'><b>Emailid:</b>$email</br></p>";
  echo "<p style='margin-left:250px; font-size:30px;'><b>Password:</b>$password</br></p>";
  echo "<p style='margin-left:250px; font-size:30px;'><b>Address:</b>$address</br></p>";
  echo "<p style='margin-left:250px; font-size:30px;'><b>Securityques_ans:</b>$secure</br></p>";
echo "<h2><p style='margin-left:250px; font-size:30px;'>click the proceed button to book an available hall</p></h2>";
echo "</br><a href='http://localhost:8080/loginformowner.html'><button
style='background-color:LightBlue; float:right; margin-right:260px;border-radius:25px;'><h2><b>Proceed</b></h2></button></a>";}
}
else{echo "error:Enter phone number correctly";}
mysqli_close($conn); 
?>
