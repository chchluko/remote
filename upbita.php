<?php
$id =$_POST["id"];
$media =$_POST["mdia"];
$tb =$_POST["tb"];

include("funciones.php");

connect_to_db();

$resultado = mysql_query("UPDATE $tb SET media=$media, timeout=NOW() WHERE id=$id");
	if (!$resultado) {
    die('Consulta no válida: ' . mysql_error());
	}

?>