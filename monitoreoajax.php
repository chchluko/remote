<?php
$id =$_POST["id"];

$system = ini_get('system');
$win  = (bool)  $windows;
$count = 2;

include("funciones.php");

connect_to_db();

$result = mysql_query("select id, ip_sucursal as host, nombre_sucursal as services, referencia, sitio  from chksoporte where id='$id'");
while ($row = mysql_fetch_object($result)) {
    $id=$row->id;
    $host= $row->host;
    $services= $row->services;
    $referencia= $row->referencia;
    //$dias= json_decode($row->dias);
    $sitio= $row->sitio;
}mysql_free_result($result);

$ip =$host;

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