<!DOCTYPE html PUBLIC "-//IETF//DTD HTML 2.0//EN">

<?php

if (isset($_GET["id"]));
    {
     $id = (isset($_GET["id"])) ? $_GET["id"] : 0;
    }


include("funciones.php");

connect_to_db();

$result = mysql_query("select id, ip_sucursal as host, nombre_sucursal as services, referencia, sitio  from monitoreo where id=$id");
while ($row = mysql_fetch_object($result)) {
    $id=$row->id;
      $host= $row->host;
     $services= $row->services;
    $referencia= $row->referencia;
     //$dias= json_decode($row->dias);
     $sitio= $row->sitio;
}

/*while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
    //printf("ID: %s  Nombre: %s", $row["id"], $row["services"]);
  //printf ("ID: %s  Nombre: %s", $row[0], $row["services"]);

$host[$row[0]] = $row["host"];
$services[$row[0]] = $row["services"];*/

mysql_free_result($result);
?>


<html><head><title>.:: Server Monitor :..</title></head> <div align="center">
  <p><font color="#003366" size="6" face="Verdana, Arial, Helvetica, sans-serif"><em><strong><? echo $services ?></strong></em></font></p>
  <p><font face="Verdana, Arial, Helvetica, sans-serif"><img src="server.jpg"></font></p><p></p> <font face="Verdana, Arial, Helvetica, sans-serif">


<?
pingtoip($host,1,$services,$referencia,$sitio);
?>
</font></div>