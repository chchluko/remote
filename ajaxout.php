<?php

$id =$_POST["id"];
$tb =$_POST["tb"];
$count =$_POST["pk"];
/*
$id =8;
$tb ='monitoreoti';  //forza GET
$count =4;*/

$system = ini_get('system');
$win  = (bool)  $windows;

include("funciones.php");

connect_to_db();

$result = mysql_query("select id, ip_sucursal as host, nombre_sucursal as services, referencia, sitio  from $tb where id='$id'");
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
        //echo substr($pingreply, -13);
      //  echo '<br>';
       // echo $rest = substr($pingreply,0, strrpos($pingreply, ' ')).'.';  
     // echo  $timeout=substr($pingreply, strrpos($pingreply, '= ')+2,-2);  //obtiene solo la media del PING en entero 
	
	$timedata=substr($pingreply, strrpos($pingreply, '= ')+2,-2);
	
	if ($timedata == 0){
		echo $timedata=1;
	}else{
		echo $timedata;
	}
	
	
	//echo $timeout=substr($pingreply, strrpos($pingreply, 'M'));
	
	/*$change = array('key1' => $timedata, 'key2' => $timeout);
	
	echo '<pre>';
	print_r (change);
	echo '</pre>';
		
	echo json_encode($change);*/
	
	
     /*   if ($timeout > 100) {

          echo 'muy lento';
          
        } else {
          echo 'normal';
        }*/
        
           }
    else 
    {
      return false;
       }
?>