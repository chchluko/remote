<?php
$id =$_POST["id"];

include("funciones.php");

connect_to_db();

$diif=mysql_query("SELECT (TIMESTAMPDIFF(MINUTE,timeout,now())) as diferencia from monitoreoti WHERE id=$id");
if ($row = mysql_fetch_row($diif)) {
$d=$row[0];
}
if ($d > 10){
    echo $d.' min timeout';
           }
    else 
    {
      return false;
       }
?>