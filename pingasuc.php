<!DOCTYPE html PUBLIC "-//IETF//DTD HTML 2.0//EN">

<?php
if (isset($_GET["id"]));
    {
     $id = (isset($_GET["id"])) ? $_GET["id"] : 0;
     $_SESSION['usuario'] = $id;
    }

$system = ini_get('system');
$win  = (bool)  $windows;
$count = 1;

include("funciones.php");

connect_to_db();

$result = mysql_query("select id, ip_sucursal as host, nombre_sucursal as services, referencia, sitio  from monitoreo where id='".$_SESSION['usuario']."'");
while ($row = mysql_fetch_object($result)) {
    $id=$row->id;
      $host= $row->host;
     $services= $row->services;
    $referencia= $row->referencia;
     //$dias= json_decode($row->dias);
     $sitio= $row->sitio;
}mysql_free_result($result);
?>

<html>
<head>
<title>.:: Server Monitor :..</title>
</head>
<div align="center">
<p>
<font color="#003366" size="6" face="Verdana, Arial, Helvetica, sans-serif"><em><strong><? echo $services ?>
</strong></em>
</font>
</p>
<p>
<font face="Verdana, Arial, Helvetica, sans-serif"><img src="server.jpg"></font>
</p>
<font face="Verdana, Arial, Helvetica, sans-serif">
  
  <span id="value2"><img src="up.png" /></span> <span id="value"></span>
  <span id="value3"><img src="down.jpg" /> Timeout...</span>

</font></div>

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  $( "#value2" ).hide();
  $( "#value3" ).hide();
    function getRandValue(){
        value = $('#value').text();

var host = '<?php echo $host ?>';

var dataString = 'host='+ host;
//var $contenidoAjax = $('#value2').html('<p><img src="down.jpg" /></p>');

        $.ajax({
            type: "POST",
            url: "pingtoid.php",
            //data: dataString,
            data: dataString,
            success: function(data) {
                $('#value').text(data);
                //$('#value2').html('<p><img src="up.png" /></p>');

            if(data == false)
                            {
                                //$('#value2').html('<p><img src="down.jpg" /></p>');
                                $( "#value3" ).show();
                                $( "#value2" ).hide();
                            }
                            else{
                                $('#value2').html('<p><img src="up.png" /></p>');
                                $( "#value2" ).show();
                                $( "#value3" ).hide();
                            }
                         }
                    });
                }

    setInterval(getRandValue, 3000);
});
</script>