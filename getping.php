<!DOCTYPE html PUBLIC "-//IETF//DTD HTML 2.0//EN">
<html><head><title>.:: Server Monitor :..</title></head> <div align="center">
  <p><font color="#003366" size="6" face="Verdana, Arial, Helvetica, sans-serif"><em><strong>Monitoreo Infraestructura</strong></em></font></p>
  <p><font face="Verdana, Arial, Helvetica, sans-serif"><img src="images/server.jpg"></font></p><p></p> <font face="Verdana, Arial, Helvetica, sans-serif">



<?php
$system = ini_get('system');
$win  = (bool)  $windows;
$count = 1;



include("funciones.php");

connect_to_db();

$result = mysql_query("select id, ip_sucursal as host, nombre_sucursal as services  from monitoreo where id<60");
/*while ($row = mysql_fetch_object($result)) {
$id=$row->id;
     $ip= $row->ip_sucursal;
     $sucursal= $row->nombre_sucursal;
     $referencia= $row->referencia;
     //$dias= json_decode($row->dias);
     $sitio= $row->sitio;
}*/

while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
    //printf("ID: %s  Nombre: %s", $row["id"], $row["services"]);
  //printf ("ID: %s  Nombre: %s", $row[0], $row["services"]);

$host[$row[0]] = $row["host"];
$services[$row[0]] = $row["services"];

  }

mysql_free_result($result);

echo "<table border=\"0\" align=\"center\">";
foreach ( $host as $value) 
{
   $counter = $counter + 1;
    echo "<tr><td width=120>".$value."</td>"; 
      echo '<body bgcolor="#FFFFFF" text="#000000"></body>';       
      //check target IP or domain
    $pingreply = exec("ping -n $count $value");
    if ( substr($pingreply, -2) == 'ms')
      {
      #echo "<td width=60><strong><font color='#006600'>UP</font></strong></td>";
      echo "<td width=60><img src='up.png'></td>";
      echo "<td width=230><a href='http://localhost/remote/reping.php?id=".$counter."'>".$services[$counter]."</a></td>";
        echo "<td>Respuesta ";
        echo substr($pingreply, -13);
    }
    else 
    {
      #echo "<td width=60><strong><font color='#990000'>DOWN</font></strong></td>";
      echo "<td width=60><img src='down.jpg'></td>";
      echo "<td width=230>". $services[$counter] . "</td>";
        echo "<td>";
      echo "Timeout...";
    }
}
echo "</td></tr></table>";

?>
</font></div>