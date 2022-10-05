<?php
session_start();
$otp=$_POST['otp'];
$name=$_POST['email'];
$cotp=$_SESSION['otpp'];
$user=$_SESSION['utype'];
$_SESSION['username']=$name;
$_SESSION['login']=true;
if($otp==$cotp){
echo "success";
switch ($user) {
  case "organiser":
    echo "hii";
    header("Location: http://localhost:8080/hallbookorgfirst.php"); 
    break;
  case "owner":
    echo "ii";
    header("Location: http://localhost:8080/requesthallowner.html");
    break;
  case "participant":
echo "i";
    header("Location: http://localhost:8080/participantseatbook.php");
    break;} }
?>