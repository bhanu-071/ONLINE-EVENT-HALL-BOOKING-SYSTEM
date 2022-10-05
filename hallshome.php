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
echo "<html><head><style>
p{font-size:25px;
 margin-left:40%;}
body{background-color:#C5C6D0;}
</style>
</head><body><center><h1><u>HALLS</u></h1></center></br></br>";
$sql = 'select * from bookinghalls';
$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) {
  while($data = mysqli_fetch_assoc($result)) {
  $x=$data['imghall'];
$y="imgorgown/".$x;
   echo"<center><img src='$y'/></center></br></br>
   <p><b>Hall Name: </b>$data[hallname]</br> 
<b>Hall Capacity: </b>$data[capacity]</br>
<b>Hall Address: </b>$data[address]</br></br></br></p>
";
}}
echo "</body></html>";
mysqli_close($conn);
?>