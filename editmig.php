<?php
$dbhost="localhost";
$dbname="director";
$dbuser="root";
$dbpass="W3bmy5ql";
$db = new mysqli($dbhost,$dbuser,$dbpass,$dbname);

if (isset($_POST) && count($_POST)>0)
{
	if ($db->connect_errno) 
	{
		die ("<span class='ko'>Fallo al conectar a MySQL: (" . $db->connect_errno . ") " . $db->connect_error."</span>");
	}
	else
	{
		$query=$db->query("update monitoreoti set ".$_POST["campo"]."='".$_POST["valor"]."' where id='".intval($_POST["id"])."' limit 1");
		if ($query) echo "<span class='ok'>Valores modificados correctamente.</span>";
		else echo "<span class='ko'>".$db->error."</span>";
	}
}

if (isset($_GET) && count($_GET)>0)
{
	if ($db->connect_errno) 
	{
		die ("<span class='ko'>Fallo al conectar a MySQL: (" . $db->connect_errno . ") " . $db->connect_error."</span>");
	}
	else
	{
		$query=$db->query("select * from monitoreoti order by id asc");
		//$query=$db->query("select * from editinplace order by idusuario asc");
		$datos=array();
		while ($usuarios=$query->fetch_array())
		{
		$datos[]=array(	"id"=>$usuarios["id"],
							"nombre"=>utf8_encode($usuarios["nombre_sucursal"]),
							"apellidos"=>$usuarios["ip_sucursal"],
							"email"=>$usuarios["referencia"],
							"telefono"=>$usuarios["sitio"],
							"tipo"=>$usuarios["tipo"]
							);

		}
		echo json_encode($datos);
	}
}
?>