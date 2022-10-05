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
$cur=date('Y-m-d');
session_start();
$y=$_SESSION['orgemail'];
$sql="select * from organiser";
$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) {
  while($dat= mysqli_fetch_assoc($result)) {
echo "$y";
if ($dat['email']==$y){
$img=$dat['imgsign'];
echo "$img";}}}
$x="imgorgown/".$img;
ob_start();
require('fpdf.php');
$pdf= new FPDF();
$pdf->Addpage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'TICKET BOOKING RECIEPT',0,0,'C');
$pdf->Ln(20);
$pdf->Cell(25,5,'Date:',0,0);
$pdf->Cell(52,5,$cur,0,0);
$pdf->Ln(20);
$pdf->Cell(55,5,'Emailid:',0,0);
$pdf->Cell(58,5,$_SESSION['emailid'],0,0);
$pdf->Ln(20);
$pdf->Cell(55,5,'Event Name:',0,0);
$pdf->Cell(58,5,$_SESSION['eventname'],0,0);
$pdf->Ln(20);
$pdf->Cell(55,5,'Event Purpose:',0,0);
$pdf->Cell(58,5,$_SESSION['eventpurpose'],0,0);
$pdf->Ln(20);
$pdf->Cell(55,5,'Hall Details:',0,0);
$pdf->Cell(58,5,$_SESSION['halldetails'],0,0);
$pdf->Ln(20);
$pdf->Cell(55,5,'Start Date:',0,0);
$pdf->Cell(58,5,$_SESSION['fromdate'],0,0);
$pdf->Ln(20);
$pdf->Cell(0,5,'at '. $_SESSION['starttime'],0,0,'C');
$pdf->Ln(20);
$pdf->Cell(55,5,'End Date:',0,0);
$pdf->Cell(58,5,$_SESSION['todate'],0,0);
$pdf->Ln(20);
$pdf->Cell(0,5,'at '. $_SESSION['endtime'],0,0,'C');
$pdf->Ln(20);
$pdf->Cell(55,5,'tickets:',0,0);
$pdf->Cell(58,5,$_SESSION['seats'],0,0);
$pdf->Ln(20);
$pdf->Cell(55,5,'Amount per Ticket:',0,0);
$pdf->Cell(58,5,$_SESSION['amount'],0,0);
$pdf->Ln(20);
$pdf->Cell(55,5,'Amount to be paid:',0,0);
$pdf->Cell(58,5,$_SESSION['tot'],0,0);
$pdf->Ln(20);
$pdf->Cell(150,5,'Signature:',0,0,'R');
$pdf->Ln(10);
$pdf->image($x,135,260,30);
$pdf->Output();
ob_end_flush(); 
?>