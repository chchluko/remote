<?php 
$count=30;
 $count1=0;
$count2=0; 
 $r = fmod($count, 2); 
 echo $r;
if ($r == 1){
$count1=22;
$count2=33;
}
echo $count1;
echo $count2;

?>