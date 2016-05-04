<?php
function connect_to_db()
{
    //localhost
  mysql_connect("localhost","root","password");
  mysql_select_db("director") or die("Cannot select database");


}

function pingtoip ($ip, $count, $nombre, $referencia, $sitio)
{

    echo "<tr><td width=120>$ip </td>"; 
      echo '<body bgcolor="#FFFFFF" text="#000000"></body>';    

  $pingreply = exec("ping -n $count $ip");
    if ( substr($pingreply, -2) == 'ms')
      {
      #echo "<td width=60><strong><font color='#006600'>UP</font></strong></td>";

      echo "<td width=60><img src='up.png'></td>";
      echo "<td width=230> </td>";
        echo "<td>Respuesta ";
        echo substr($pingreply, -13);
    }
    else 
    {
      #echo "<td width=60><strong><font color='#990000'>DOWN</font></strong></td>";
      echo "<td width=60><img src='down.jpg'></td>";
      echo "<td width=230>". $nombre . "</td>";
        echo "<td>";
      echo "Timeout...";
    }
    echo "</tr>"; 

    echo "<br><tr><td width=120>Referencia: ".$referencia."</td></tr>"; 
    echo "<br><tr><td width=120>Sitio: ".$sitio."</td></tr>"; 
}


function pingtoid ($ip, $count, $nombre, $referencia, $sitio)
{
#    echo "<tr><td width=120>$ip </td>"; 
  #    echo '<body bgcolor="#FFFFFF" text="#000000"></body>';    

  $pingreply = exec("ping -n $count $ip");
    if ( substr($pingreply, -2) == 'ms')
      {
      #echo "<td width=60><strong><font color='#006600'>UP</font></strong></td>";

 #     echo "<td width=60><img src='up.png'></td>";
 #     echo "<td width=230> </td>";
  #      echo "<td>Respuesta ";
     #   echo substr($pingreply, -13);
        echo substr($pingreply, -13);
    }
    else 
    {
      #echo "<td width=60><strong><font color='#990000'>DOWN</font></strong></td>";
      #echo "<td width=60><img src='down.jpg'></td>";
      #echo "<td width=230>". $nombre . "</td>";
        #echo "<td>";
      echo "Timeout...";

    }
    #echo "</tr>"; 

    #echo "<br><tr><td width=120>Referencia: ".$referencia."</td></tr>"; 
    #echo "<br><tr><td width=120>Sitio: ".$sitio."</td></tr>"; 
}





?>
