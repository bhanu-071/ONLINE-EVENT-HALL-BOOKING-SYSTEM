<?php
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
echo "<html><head>
<style>.bg-img {
  /* The image used */
  /* Center and scale the image nicely */
background-image: url('http://localhost:8080/homepicevent.jpg');
  background-attachment:absolute;
  margin:0;
  background-repeat: no-repeat;
  background-size: cover;
  height:100%;
  width:100%;
}
</style></head><body><div class='bg-img'>";
$sql="select * from events where eventtype='Professional'";
$rsl=mysqli_query($conn,$sql);
if(mysqli_num_rows($rsl) > 0){
$s=0;
 while($dat=mysqli_fetch_assoc($rsl)){
if($s==0){
echo "<h3><p style='color:white; margin-top:25px; font-size:30px;'><b>";}
else{
echo "<h3><p style='color:white; font-size:30px;'><b>";}
$x="** Event name is  ".$dat['eventname']." Conducted from  ".$dat['fromdate']."  at  ".$dat['starttime']."  to  "
.$dat['todate']."  at  ".$dat['endtime']."  in  ".$dat['halldetails'];
echo $x;
echo "</p></h3>     <a href='http://localhost:8080/loginformparticipant.html'><button style='background-color:Blue; float:right; margin-right:160px;border-radius:25px;'><h2 style='color:white;'><b>Book Now</b></h2></button></a>
</br></br></br>";}
echo "</div></body></html>";}
else{
echo "<center><h1>NO EVENTS TO BOOK</h1></center>";
}
mysqli_close($conn);
?>


