<?php
 $raw=$_POST['raw'];//raw marks data
 $name=$_POST['Full_Name'];//full name
  $mobile=$_POST['number'];//mobile number
  $email=$_POST['email'];//email
  $servername = "localhost";
  $username = "root";
  $fn =$email.$_FILES["filetoupload"]["name"];//concatenating email-id to filename to uniquely identify an image file
  $password = "inno";
  $last_id="";
  $db="resume";
  $filter=$raw.trim(" ");
  $arr=explode("\n",$filter);//seperating the raw data by new lines
  $count=sizeof($arr);
//echo($count);
//echo $arr;
  $subs=array();//the array of marks
  $help=array();//the array of subjects
for($i=0;$i<$count;$i++)
{
  //$arr[$i]=$arr[$i].trim('.');
   $arr[$i]=trim($arr[$i]);
   if($arr[$i]=="")
     continue;
   $val=explode("|",$arr[$i]);
  if(isset($val[0]) && isset($val[1]))//checking the empty fields
 {
  if(!empty($val[0]) && !empty($val[1]))
  {
  array_push($subs,$val[1]);//pushing marks of corresponding subject
  array_push($help,$val[0]);//pushing name of each subject
}
}
}
  $conn = new mysqli($servername, $username, $password,$db);
  if ($conn->connect_error) { //database connected
    die("Connection failed: " . $conn->connect_error);
   } 
   else
   {

   	$pr=("SELECT ID FROM Students WHERE Email LIKE '.$email.'");//finding the ID  of person whose data has  been updated
   	$res=$conn->query($pr);
   //	$row=mysql_fetch_assoc($res);
   	if($row = $res->fetch_assoc())
   { 
        //load all returned rows into an array
    $last_id = $row['ID'];//unique ID stored in variable $last_id

    //$up=("INSERT INTO Students ()WHERE ")

  }
    else
      echo "error";

   // $last_id = mysqli_result($res);

    
    //echo $last_id
   }
class Pdf{//the fpdf class which updates the resume file in server


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


$pdf->Output("/var/www/html/One/final/Resume/{$last_id}.pdf","F"); //resume file stored in server with name "$last=id.pdf"
//$pdf->Output('D',"docu2.pdf");
}

}
$obj=new Pdf($last_id,$mobile,$email,$name,$fn,$subs,$help);//the object constructer called.


?>