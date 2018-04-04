
<?php
$target ="Pictures/";
$upload=1;
$viewimage=null;
$target_name=$target . basename($_FILES["filetoupload"]["name"]);
$imagetype=strtolower(pathinfo($target_name,PATHINFO_EXTENSION));
if($imagetype=="jpg" || $imagetype=='png')
$upload=0;
if($upload==0)
 { if(move_uploaded_file($_FILES["filetoupload"]["tmp_name"], $target_name))
  	{
    $fl=$_FILES["filetoupload"]["name"];
    echo '<img src = "Pictures/'.$fl.'">';
    echo '<br>';
    echo $fl;




}

else
echo "error";
}
else
	echo "file is not of the required type";


?>


