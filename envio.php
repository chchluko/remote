<?php
define('BOT_TOKEN','194877874:AAGkYYzrDBd4UVWPnRcajp0Rf1NHQfTRh4s');
define('CHAT_ID','34585160');
define('API_URL','https://api.telegram.org/bot'.BOT_TOKEN.'/');
$txt = $_GET["txt"];
$host=$_GET["host"];
$services=$_GET["services"];

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


