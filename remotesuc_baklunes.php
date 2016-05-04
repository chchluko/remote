<!DOCTYPE html PUBLIC "-//IETF//DTD HTML 2.0//EN">
<html><head><title>.:: Server Monitor :..</title>
</head> <div align="center">
  <p><font color="#003366" size="6" face="Verdana, Arial, Helvetica, sans-serif"><em><strong>Monitoreo Infraestructura</strong></em></font></p>
  <p><font face="Verdana, Arial, Helvetica, sans-serif"><img src="server.jpg"></font></p><p></p> <font face="Verdana, Arial, Helvetica, sans-serif">
<?php
$system = ini_get('system');
$win  = (bool)  $windows;
$count = 1;

include("funciones.php");

connect_to_db();


$rs = mysql_query("SELECT MAX(id) AS a FROM monitoreo");
if ($row = mysql_fetch_row($rs)) {
//$a = trim($row[0]);
$a = 3;
}


$result = mysql_query("select id, ip_sucursal as host, nombre_sucursal as services  from monitoreo where id<4");
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
    //$pingreply = exec("ping -n $count $value");
    /*if ( substr($pingreply, -2) == 'ms')
      {
      #echo "<td width=60><strong><font color='#006600'>UP</font></strong></td>";
      echo "<td width=60><img src='up.png'></td>";
      echo "<td width=230><a href='http://localhost/remote/reping.php?id=".$counter."'>".$services[$counter]."</a></td>";
        echo "<td>Respuesta ";
        echo substr($pingreply, -13);
    }
    else 
    {*/
      #echo "<td width=60><strong><font color='#990000'>DOWN</font></strong></td>";
      echo "<td width=260>";
      echo '<span id="online'.$counter.'"><img src="up.png" /></span><span id="media'.$counter.'"></span>';
      echo "</td>";
      echo "<td width=230>". $services[$counter];
      $host= $value;
     // $cuenta=$counter;
            echo '<span id="timeout'.$counter.'"><img src="down.jpg" /> Timeout...</span>';
      echo   "</td>";
      echo "<td>";
     # echo "Timeout...";
   # }
#   echo '<span id="online"><img src="up.png" /></span> <span id="value"></span>';
  #echo echo '<span id="online"><img src="up.png" /></span> <span id="value"></span>';

}
echo "</td></tr></table>";

?>
</font>

<!--
<span id="online"></span>
<span id="timeout"></span>
-->


<!--<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>-->
<script type="text/javascript" src="jquery-latest.min.js"></script>


<script type="text/javascript">
$(document).ready(function() {
  //$( "#online" ).hide();
  //$( "#timeout" ).hide();
    function getRandValue(a){
      //console.log(a);
      //var host = '1';
        value = $('#value').text();
        var idx = a;
        var online ="online"+idx;
        var timeout ='timeout'+idx;
        var value ='media'+idx;
        //var host = '<?php echo $counter ?>';


var dataString = 'id='+ idx;
//var $contenidoAjax = $('#online').html('<p><img src="down.jpg" /></p>');
//console.log(dataString);
        $.ajax({
            type: "POST",
            url: "pingajax.php",
            //data: dataString,
            data: dataString,
            success: function(data) {
                $( "#"+value).text(data);
                //$('#online').html('<p><img src="up.png" /></p>');

            if(data == false)
                            {
                                //$('#online').html('<p><img src="down.jpg" /></p>');
                                $( "#"+timeout).show();
                                $( "#"+online).hide();
/*

                                var reping='1';
                                console.log(reping);

                                  while (reping < 5) {
                                  //var idx = a;*/
                                  //setInterval(travel, 1000);
console.log(a);
                                travel(a);
                                   /*                     reping++;
                                                      }
                                
*/


                            }
                            else{
                                $( "#"+online).html('<p><img src="up.png" /></p>');
                                $( "#"+online).show();
                                $( "#"+timeout).hide();
                                //getRandValue(a);


                            }
                         }
                    });
                }

   // setInterval(getRandValue, 3000);
var a = '<?php echo $a ?>';
var i = setInterval(timer, 10000);

function timer() {
    //setInterval(getRandValue(a), 3000);
    getRandValue(a);
    //console.log(a);
    if (a < 2) {
      console.log(a);
        console.log('Reaching Stop');
        a = '<?php echo $a ?>';
        //clearInterval(i);
        return;
    }
    a -= 1;
}


function travel(a){

console.log(a);
  var idx = a;
  var dataString = 'id='+ idx;
                                console.log(idx);
                                  //var dataString = 'id='+ idx;
                                  console.log(dataString);


   $.ajax({
                                                                type: "POST",
                                                                url: "pingajax.php",
                                                                //data: dataString,
                                                                data: dataString,

                                                                success: function(data) {
                                                                    $( "#"+value).text(data);
                                                                    //$('#online').html('<p><img src="up.png" /></p>');

                                                                if(data == false)
                                                                                {
                                                                                    //$('#online').html('<p><img src="down.jpg" /></p>');
                                                                                    $( "#"+timeout).hide();
                                                                                    $( "#"+online).hide();
                                                                                    $('#online').html('<p>fallo en PING</p>');
                                                                                    //console.log(reping);
                                                                                }
                                                                                else{
                                                                                    //$( "#"+online).html('<p><img src="up.png" /></p>');
                                                                                    //$( "#"+online).show();
                                                                                    //$( "#"+timeout).hide();
                                                                                    //getRandValue(a);
                                                                                    //reping=5;
                                                                                     $('#online').html('<p>Exito en PING</p>');
                                                                                    //console.log(idx);
                                                                                }
                                                                               
                                                                             }
                                                                        });
                                                                 
                                                                 //console.log(reping);
}



});

/*
var a = 100;
var i = setInterval(getRandValue(a), 3000);

function timer() {
    console.log(a);
    if (a < 1) {
        console.log('Reaching Stop');
        clearInterval(i);
        return;
    }
    a -= 1;
}*/



</script>