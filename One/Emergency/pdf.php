<?php
 $raw=$_POST['raw'];
 $name=$_POST['Full_Name'];
  $mobile=$_POST['number'];
  $email=$_POST['email'];
  $servername = "localhost";
  $username = "root";
  $fn = $email.$_FILES["filetoupload"]["name"];
  $password = "inno";
  $last_id="";
  $db="resume";
  $filter=$raw.trim(" ");
$arr=explode("\n",$filter);
$count=sizeof($arr);
//echo($count);
//echo $arr;
$subs=array();
$help=array();
for($i=0;$i<$count;$i++)
{
  //$arr[$i]=$arr[$i].trim('.');
  $val=explode("|",$arr[$i]);
  if(isset($val[0]) && isset($val[1]))
 {
  if(!empty($val[0]) && !empty($val[1]))
  {array_push($subs,$val[1]);
  array_push($help,$val[0]);
}
}
}
  $conn = new mysqli($servername, $username, $password,$db);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
   } 
   else
   {

   	$pr=("SELECT ID FROM Students WHERE Email LIKE '.$email.'");
   	$res=$conn->query($pr);
   //	$row=mysql_fetch_assoc($res);
   	$row = $res->fetch_assoc();
    
        //load all returned rows into an array
    $last_id = $row['ID'];
    

   // $last_id = mysqli_result($res);

    
    //echo $last_id;
   }
class Pdf{


function __construct($last_id,$mobile,$email,$name,$fn,$subs,$help)
{
require('fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,"{$name}");
$pdf->Image('Pictures/'.$fn,100,10,30);
$pdf->Ln(10);
$pdf->Cell(80,10,"Mobile No:-{$mobile}",0,1);
$pdf->Ln(10);
$pdf->Cell(80,10,"Email:-{$email}",0,1);
$pdf->Ln(10);
$pdf->Cell(80,10,"Marks",0,1);
$pdf->Ln(10);
foreach($help as $hel)
        $pdf->Cell(40,7,$hel,1);
    $pdf->Ln();
foreach($subs as $sub)
        $pdf->Cell(40,7,$sub,1);
    $pdf->Ln();
    
//$pdf->Output('F',"/var/www/html/One/Resume/{$last_id}.pdf");


$pdf->Output("/var/www/html/One/Resume/{$last_id}.pdf","F");
//$pdf->Output('D',"docu2.pdf");
}

}
$obj=new Pdf($last_id,$mobile,$email,$name,$fn,$subs,$help);


?>