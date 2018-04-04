<?php
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
	array_push($subs,$val[1]);
	array_push($help,$val[0]);
}



echo ' <p style="text-align:center;border:1px solid;margin:0%"> Marks </p> ';

echo '<table style="width:100%">';
echo '<tr >';
for($i=0;$i<$count;$i++)
{
  echo '<td style="border:1px solid black;text-align:center">'.$help[$i].'</td>';
}
echo '</tr>';
echo '<tr>';
for($i=0;$i<$count;$i++)
{
  echo '<td style="border:1px solid black;text-align:center">'.$subs[$i].'</td>';
}
echo '</tr>';
echo '</table>';


?>