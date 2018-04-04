<?php
  $raw=$_POST['raw'];//raw marks-data
  $name=$_POST['Full_Name'];//full-name
  $mobile=$_POST['number'];//mobile-number
  $email=$_POST['email'];//email-id
  $servername = "localhost";
  $username = "root";
  $fn = $email.$_FILES["filetoupload"]["name"];//concatenating emailid with image name
  $password = "inno";
  $last_id="";
  $db="resume";
  $filter=$raw.trim(" ");
  $arr=explode("\n",$filter);//seperating marks data by new-lines
  $count=sizeof($arr);
//echo($count);
//echo $arr;
  $subs=array();//array for marks for corresponding subject
  $help=array();//arry for names of corresponding subject
  for($i=0;$i<$count;$i++)
  {
  //$arr[$i]=$arr[$i].trim('.');
    $arr[$i]=trim($arr[$i]);
    if($arr[$i]=="")
      continue;
    $val=explode("|",$arr[$i]);
    if(isset($val[0]) && isset($val[1]))
    {
      if(!empty($val[0]) && !empty($val[1]))
      {
        array_push($subs,$val[1]);//pushing marks of corresponding subjects
        array_push($help,$val[0]);//pushing names of corresponding subjects
      }
    }
  } 
  $conn = new mysqli($servername, $username, $password,$db);//database connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    } 
  else
   {

   	$pr=("SELECT ID FROM Students WHERE Email LIKE '.$email.'");//getting the ID from database where the new record is stored
   	$res=$conn->query($pr);
   //	$row=mysql_fetch_assoc($res);
   	$row = $res->fetch_assoc();
    
        //load all returned rows into an array
    $last_id = $row['ID'];//storing the most recent ID in variable $last_id
    

   // $last_id = mysqli_result($res);

    
    //echo $last_id;
   }
  class Pdf{//fpdf class for storing the resume file in server


    function __construct($last_id,$mobile,$email,$name,$fn,$subs,$help){
    
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


    $pdf->Output("/var/www/html/One/final/Resume/{$last_id}.pdf","F");//storing the resume file with name "$last_id.pdf"
//$pdf->Output('D',"docu2.pdf");
    }

  }
  $obj=new Pdf($last_id,$mobile,$email,$name,$fn,$subs,$help);//the fpdf constructor is called.


?>