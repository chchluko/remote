<?php
$id =$_POST["id"];
$media =$_POST["mdia"];
$tb =$_POST["tb"];
$rng= $_POST["rng"];

include("funciones.php");

connect_to_db();

$resultado = mysql_query("SELECT rating,media FROM $tb WHERE id=$id");
	if (!$resultado) {
    die('Consulta no válida: ' . mysql_error());
	}
	while ($row = mysql_fetch_object($resultado)) {
    		$mediadb=$row->media;
			$ratingdb=$row->rating;
			}mysql_free_result($resultado);
	
		if($media > $rng && $ratingdb < 5) {
			
			$add = mysql_query("UPDATE $tb SET rating=rating+1 WHERE id=$id");
	}
		if ($media < $rng && $ratingdb > 0){
		
			$rem = mysql_query("UPDATE $tb SET rating=0 WHERE id=$id");
			//$rem = mysql_query("UPDATE monitoreoti SET rating=rating-1 WHERE id=$id");
	}
		
	$rate = mysql_query("SELECT rating FROM $tb WHERE id=$id");
	if (!$rate) {
    die('Consulta no válida: ' . mysql_error());
	}
	while ($row = mysql_fetch_object($rate)) {
    		echo $ratenl=$row->rating;
			}mysql_free_result($rate);
?>