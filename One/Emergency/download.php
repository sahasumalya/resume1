<?php
$name=$_POST['Full_Name'];
$target ="Pictures/";
$upload=0;//the flag to check whether image is uploaded or not
$viewimage=null;
$filename="";
$marks="";
$mobile="";
$email=$_POST['email'];

$rows=array();
$target_name=$target.$email.basename($_FILES["filetoupload"]["name"]);
//$target_name=$target_name+
$imagetype=strtolower(pathinfo($target_name,PATHINFO_EXTENSION));
//echo $imagetype;
if($imagetype=="jpg" || $imagetype=='png')
$upload=1;

if($upload==1)
 { if(move_uploaded_file($_FILES["filetoupload"]["tmp_name"], $target_name))
  	{
    $filename=$email.$_FILES["filetoupload"]["name"];
   // echo "Image uploaded Successfully";




}
 else
 {
  echo "Problem in image loading";
  $upload=0;
 }


}


if($upload==1)//if the image is valid
{
 $flag=0;//the flag to check all the conditions except image
 $mobile=$_POST['number'];//mobile-number checking begins
 
 $arr=str_split($mobile);
 if($arr[0]=='+' && $arr[1]=='9' && $arr[2]=='1')
  $flag=1;
 if($flag==1)
 {
  $flag=0;
  $val=substr($mobile,3);
  if(is_numeric($val))
  {
       if(strlen($val)==10)
        $flag=1;
       else
        echo $val;
  }
  else
    echo "Number must be valid";

 }
 else
  echo "Only Indian users are allowed";//mobile-number checking ends
  if($flag==1)
  {
  $flag=0;
  $marks=$_POST['raw'];//marks-format checking begins
  $marks=rtrim($marks);
  $lines=explode("\n",$marks);
  for($i=0;$i<sizeof($lines);$i++)
  {
     $lines[$i]=trim($lines[$i]);
     $words=explode("|",$lines[$i]);
     if(sizeof($words)==2)
     {
     if(checksub($words[0])==1 && checknum($words[1])==1)
     $flag=1;
     else
     {
      echo "Incorrect format";
      $flag=0;
      break;
     }
   }
    else
    {
      echo "Incorrect format";
      $flag=0;
      break;
    }
  }
 // if($flag==1)
  }//marks-format checking ends
  if($flag==1)
  {
  $flag=0;
  $email=$_POST['email'];//email-check starts
  if(filter_var($email,FILTER_VALIDATE_EMAIL))
    $flag=1;
  else
  {
    echo "Invalid Email";
    $flag=0;
  }
  }//email-check ends
  if($flag==1) 
  {
    $flag=0;
    $name=trim($name); //name-checking starts
    $namarr=explode(" ",$name);
    if(sizeof($namarr)==2)
    {
       if(checksub($namarr[0])==1 && checksub($namarr[1])==1)
        $flag=1;
       else
       {
        $flag=0;
        echo "Invalid Name/2 words";
      }
    }
    else
    {
      echo "Invalid Name";
      $flag=0;  
    }
  }
  if($flag==1)
    //name-checking ends
{
  $servername = "localhost"; 
  $username = "root";
  $password = "inno";
  $db="resume";
  $conn = new mysqli($servername, $username, $password,$db);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
   } 
   else
   {

    $exist=("SELECT Email FROM Students WHERE Email LIKE '.$email.'");
    $res=$conn->query($exist);
    if($res->num_rows ==0)
    {
   	$m=("INSERT INTO Students (imgid,Mobile,Email,Subjects,name) VALUES ('.$filename.','.$mobile.','.$email.','.$marks.','.$name.');");
   	
   	if($conn->query($m))
   		{
        $last_id = $conn->insert_id;
        echo "Ok";
      }
    }
    else
    {
      //$row = $res->fetch_assoc();
    
        //load all returned rows into an array
    //$rows= $row['Email'];
    $filename=$email.$_FILES["filetoupload"]["name"];
    $up=("UPDATE Students SET name='.$name.',imgid='.$filename.',Mobile='.$mobile.',Subjects='.$marks.' WHERE Email LIKE '.$email.' ");
    if($conn->query($up))
      echo "Updated";
    else
      echo "Fail";

    }
   	


   }
   }
   else
    echo "False";
} 
else
{
  echo "False";
}

function checksub($subjects)
{
  $subs=trim($subjects);
  $flag=0;
  $arr=str_split($subs);
  //if((words.charCodeAt(j)>=65 && words.charCodeAt(j)<=90) || (words.charCodeAt(j)>=97 && words.charCodeAt(j)<=122))
  for($i=0;$i<sizeof($arr);$i++)
  {
    if((ord($arr[$i])>=65 && ord($arr[$i])<=90) || (ord($arr[$i])>=97 && ord($arr[$i])<=122))
      $flag=1;
    else
    {
      $flag=0;
      return $flag;
    }
  }
  return $flag;
}
function checknum($number)
{
   $num=trim($number);
   if(is_numeric($num))
   return 1;
   else
   return 0;
}
?>