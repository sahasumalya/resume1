<?php
$name=$_POST['Full_Name'];
$target ="Pictures/";
$upload=0;
$viewimage=null;
$filename="";
$marks="";
$mobile="";
$email="";
$target_name=$target.basename($_FILES["filetoupload"]["name"]);
$imagetype=strtolower(pathinfo($target_name,PATHINFO_EXTENSION));
echo $imagetype;
if($imagetype=="jpg" || $imagetype=='png')
$upload=1;
if($upload==1)
 { if(move_uploaded_file($_FILES["filetoupload"]["tmp_name"], $target_name))
  	{
    $filename=$_FILES["filetoupload"]["name"];
    echo "Image uploaded Successfully";




}

else
echo "error";
}
else
	echo "file is not of the required type";

if($upload==1)
{
  $marks=$_POST['raw'];
  $mobile=$_POST['number'];
  $email=$_POST['email'];
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
   	$m=("INSERT INTO Students (imgid,Mobile,Email,Subjects,name) VALUES ('.$filename.','.$mobile.','.$email.','.$marks.','.$name.');");
   	
   	if($conn->query($m))
   		echo "Data Recorded Successfully";
   	else
   		echo "Problem in data recording";


   }

} 
else
	echo "Some problem in image upload";
    


?>