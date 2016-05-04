<? 
include("funciones.php");

connect_to_db();

$ip = getRealIP();

echo $rest = substr($ip,0, strrpos($ip, '.')).'.';  

$result = mysql_query("SELECT ip_sucursal as host from monitoreoti where ip_sucursal like '$rest%'");

while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
echo $host[$row[0]] = $row["host"];
}

function getRealIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
        return $_SERVER['HTTP_CLIENT_IP'];

    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        return $_SERVER['HTTP_X_FORWARDED_FOR'];

    return $_SERVER['REMOTE_ADDR'];
}
?>