<?php


//require('fpdf.php');
$servername = "localhost";
$username = "root";
$password = "inno";
$db="resume";
$name = $_POST['Full_Name'];

$number=$_POST["number"];
$email=$_POST["email"];
$fn = $email.$_FILES["filetoupload"]["name"];
$raw=$_POST['raw'];
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
  {
  array_push($subs,$val[1]);
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
	$valid=("SELECT ID FROM Students WHERE name LIKE '.$name.' AND Email LIKE '.$email.' AND Mobile LIKE '.$number.' AND Subjects LIKE '.$raw.' AND imgid LIKE '.$fn.';");
	if($uniq=$conn->query($valid))
	{
       if($uniq->num_rows==0)
       {
        
       //	echo "You cannot download after recodring if modified.You need to refresh the page";
        header('Location: download.html');

       }
       else
       {
require('fpdf_protection.php');

$pdf=new FPDF_Protection();
$pdf->SetProtection(array(),'password');
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,"{$name}");
$pdf->Image('Pictures/'.$fn,100,10,30);
$pdf->Ln(10);
$pdf->Cell(80,10,"Mobile No:-{$number}",0,1);
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
$pdf->Output("docu2.pdf","D");


       }
	}
}

?>

