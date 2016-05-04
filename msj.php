<?php
define('BOT_TOKEN','194877874:AAGkYYzrDBd4UVWPnRcajp0Rf1NHQfTRh4s');
define('CHAT_ID','34585160');
define('API_URL','https://api.telegram.org/bot'.BOT_TOKEN.'/');
$txt = $_GET["txt"];
$id =$_GET["id"];

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

$msj= $txt.' de la ip '.$host.' correspondiente a '.$services;

enviar_telegram ($msj);

function enviar_telegram($msj){
	$queryArray = array(
        'chat_id' => urlencode(CHAT_ID),
        'text' => $msj
    );
$url = 'https://api.telegram.org/bot'.BOT_TOKEN.'/sendMessage?'.http_build_query($queryArray);
$result = file_get_contents($url);
}
?>


