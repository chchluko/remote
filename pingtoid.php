<?php
$ip =$_POST["host"];
$count=1;

$pingreply = exec("ping -n $count $ip");
    if ( substr($pingreply, -2) == 'ms')
 {
        echo substr($pingreply, -13);
           }
    else 
    {
      return false;
       }
?>