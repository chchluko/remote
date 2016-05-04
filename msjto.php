<?php
echo $txt = $_GET["txt"];
$id =$_GET["id"];
//$tb=$_GET["monitoreoti"];

$tb='monitoreoti';

include("funciones.php");

connect_to_db();

$result = mysql_query("select id, ip_sucursal as host, nombre_sucursal as services, referencia, sitio  from $tb where id='$id'");
while ($row = mysql_fetch_object($result)) {
    $id=$row->id;
    $host= $row->host;
    $services= $row->services;
    $referencia= $row->referencia;
    $sitio= $row->sitio;
}mysql_free_result($result);
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">

<!--<!DOCTYPE html PUBLIC "-//IETF//DTD HTML 2.0//EN">-->
	<meta http-equiv="refresh" content="3600">
	
	<title>.:: Server Monitor :..</title>
	<script type="text/javascript" src="jquery-latest.min.js"></script>
	</head>
	<body>
	<script>
	var host = '<?php echo $host ?>';
	var services = '<?php echo $services ?>';
				var dataString = 'txt='+ 'falla' + '&host='+ host + '&services='+ services;
                                     $.ajax({
								        type: "GET",
								        url: "envio.php",
								       data: dataString
                                      });

	</script>
</body>
				                	

