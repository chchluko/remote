<?
$tb = 'enlacesti'; //tabla referencia
$pk = 4;           //paketes por PING
$timer = 3000;
$range = 225;      //rango de ms en alerta
?>

<!DOCTYPE html>
<html lang="es">
    <head>
	    <meta charset="utf-8">
		<meta http-equiv="refresh" content="3600">
		
		<title>.:: Server Monitor :..</title>

		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/basico.css" rel="stylesheet">   
		
		<script type="text/javascript" src="jquery-latest.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		
		<link rel="stylesheet" href="css/font-awesome.min.css">

	</head>
	
	<body>	
	<div>
	<p><font color="#003366" size="6" face="Verdana, Arial, Helvetica, sans-serif"><em><strong>Monitoreo de Enlaces <span id="livedate"> <?php echo date("d-m-Y"); ?></span><span id="liveclock"></span></strong></em></font></p>
  	<p><font face="Verdana, Arial, Helvetica, sans-serif"></font></p>
  	
  <!--	<font face="Verdana, Arial, Helvetica, sans-serif">-->

		<?php
		$system = ini_get('system');
		$win = (bool)$windows;
		$count = 1;
		include ("funciones.php");
		connect_to_db();
		
		$rs = mysql_query("SELECT MAX(id) AS a FROM $tb");
		if ($row = mysql_fetch_row($rs)) {
			$a = trim($row[0]);
		}
		
		$result = mysql_query("select id, ip_sucursal as host, nombre_sucursal as services from $tb order by id");
		
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			echo "<div id='navcontainer'>";
			echo "<ul id=\"navlist\">";
			for ($y = 1; $y <= 1; $y++) {
				$index = $row["id"];
				$tgt = $row["id"];
				$host[$row[y]] = $row["host"];
				$services[$row[y]] = $row["services"];
				echo "<table id=\"out$index\" >";
				echo "<tr>";
				echo "<th class=\"titulo\"><h2>" . utf8_encode($services[$row[y]]) . "</h2></th>";
				echo '</tr>';
				echo '<tr>';
				echo '<th><h2>' . $host[$row[y]] . '</h2></th>';
				echo '</tr>';
				echo "<th><span class=\"to\" id=\"media$index\"></span><span id=\"target$index\"></span></th>";
				echo '<tr>';
				echo "<th><h2 id=\"rate$index\"></h2></th>";
				echo '</tr>';
				echo "</table>";
			}
			echo "</ul>";
			echo "</div>";
		}
		?>

<!--</font>-->
<script type="text/javascript">
	$(document).ready(function() {
    function getRandValue(a,c,p){
        value = $('#value').text();
        var idx = a;
        var pk = p;
        var tb = c;
        var online ='online'+idx;
        var timeout ='timeout'+idx;
        var out ='out'+idx;
        var rate = 'rate'+idx;
        var target ='target'+idx;
        var value ='media'+idx;
        var dataString = 'id='+ idx  + '&pk=' + pk + '&tb=' + tb;
        $("#"+out).addClass( "check" );
		$( "#"+out).removeClass( "recheck" );
		$( "#"+out).removeClass( "selected" );
		$( "#"+out).removeClass( "timeout" );
		$( "#"+out).removeClass( "outrange" );       
        
        $.ajax({
            type: "POST",
            url: "ajaxenl.php",
            data: dataString,
            success: function(data) {
                $( "#"+value).text(data+' ms');
                 if(data == false)
                            {
                                $( "#"+online).html('<p><img src="mal.png"/></p>');
                                $( "#"+out).removeClass( "check" );
                                travel(a,c,p);
                            }
                            else{
                                $( "#"+online).html('<p><img src="correcto.png" /></p>');
                                $( "#"+out).removeClass( "check" );
                                $( "#"+out).removeClass( "selected" );
                                $( "#"+out).removeClass( "timeout" );
                                if (parseInt(data) > rng){
					                	$( "#"+out).addClass( "outrange" );
					                }else{
					                	$( "#"+out).removeClass( "outrange" );
					                	$("#"+rate).html('');
					                }
				                    var dataString = 'id='+ idx + '&tb=' + tb;
				                         $.ajax({
				                         type: "POST",
				                         url: "upbita.php",
				                         data: dataString
				                			});
				                	var dataString = 'id='+ idx + '&mdia=' + parseInt(data) + '&tb=' + tb + '&rng=' + rng;
				                         $.ajax({
				                         type: "POST",
				                         url: "sllog.php",
				                         data: dataString, 
				                         success: function(data) {
				                           	    var text = "";
											    var i = 0;
											    while (i < parseInt(data)) {
											    	console.log('data');
											        text += '<i class="fa fa-times fa-3"></i>';
											        $("#"+rate).html(text);
											        i++;
											    }
				                         	}
				                     	});					                			
                            } 
                         }
                    });
                }
var a = '<?php echo $a ?>';
var i = setInterval(timer,<?php echo $timer ?>);
var c =  '<?php echo $tb?>';
var p = '<?php echo $pk?>';
var rng = '<?php echo $range?>';

	function timer() {
	getRandValue(a,c,p);
	if (a < 2) {
	a = '<?php echo $a ?>';
		return;
		}
		a -= 1;
		}

		function travel(a,c,p){

		var idx = a;
		var pk = p;
		var tb = c;
		var online ="online"+idx;
		var timeout ='timeout'+idx;
		var value ='media'+idx;
		var out ='out'+idx;
		var target ='target'+idx;
		var dataString = 'id='+ idx  + '&pk=' + pk + '&tb=' + tb;
		$("#"+out).addClass( "recheck" );
		$.ajax({
		type: "POST",
		url: "ajaxenl.php",
		data: dataString,
		success: function(data) {
		$( "#"+value).text(data+' ms');
		if(data == false)
		{
		$( "#"+out).addClass( "selected" );
		$( "#"+out).removeClass( "recheck" );
		$( "#"+online).html('<p><img src="mal.png" /></p>');

		var dataString = 'id='+ idx + '&tb=' + tb;
		$.ajax({type: "POST",url: "inbita.php",data: dataString,
		success: function(data) { $( "#"+value).text(data); console.log(data); if(data == false)  {    }  else{
		$( "#"+out).removeClass( "recheck" );
		$( "#"+out).removeClass( "selected" );
		$( "#"+out).addClass( "timeout" );
		}}
		});

		}
		else{
		$( "#"+online).html('<p><img src="correcto.png" /></p>');
		$( "#"+out).removeClass( "recheck" );
		$( "#"+out).removeClass( "selected" );
		$( "#"+out).removeClass( "timeout" );
		if (parseInt(data) > rng){
		$( "#"+out).addClass( "outrange" );
		}else{
		$("#"+out).removeClass( "outrange" );
		}
		var dataString = 'id='+ idx + '&tb=' + tb;
		$.ajax({
		type: "POST",
		url: "upbita.php",
		data: dataString
		});
		}
		}
		});
		}
		});
</script>

<script type="text/javascript">
	function startTime() {
		today = new Date();
		h = today.getHours();
		m = today.getMinutes();
		s = today.getSeconds();
		m = checkTime(m);
		s = checkTime(s);
		document.getElementById('reloj').innerHTML = h + ":" + m + ":" + s;
		t = setTimeout('startTime()', 500);
	}

	function checkTime(i) {
		if (i < 10) {
			i = "0" + i;
		}
		return i;
	}


	window.onload = function() {
		startTime();
	}
</script>

<div id="reloj" style="font-size:20px;">
</div>

<script language="JavaScript" type="text/javascript">
	function show5() {
		if (!document.layers && !document.all && !document.getElementById)
			return

		var Digital = new Date()
		var hours = Digital.getHours()
		var minutes = Digital.getMinutes()
		var seconds = Digital.getSeconds()

		var dn = "PM"
		if (hours < 12)
			dn = "AM"
		if (hours > 12)
			hours = hours - 12
		if (hours == 0)
			hours = 12

		if (minutes <= 9)
			minutes = "0" + minutes
		if (seconds <= 9)
			seconds = "0" + seconds
		//change font size here to your desire
		myclock = "<font size='5' face='Arial' ><b><font size='3'>&nbsp;&nbsp;&nbsp;&nbsp;</font>" + hours + ":" + minutes + ":" + seconds + " " + dn + "</b></font>"
		if (document.layers) {
			document.layers.liveclock.document.write(myclock)
			document.layers.liveclock.document.close()
		} else if (document.all)
			liveclock.innerHTML = myclock
		else if (document.getElementById)
			document.getElementById("liveclock").innerHTML = myclock
		setTimeout("show5()", 1000)
	}
	window.onload = show5
 </script>



    <div id="addBookDialog" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
 <div class="modal-header">
 	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">PING a Sucursal</h4>
     </div>
    <div class="modal-body">
        <input type="hidden" name="bookId" id="bookId" value=""/>
        <input type="button" class="btn btn-default" value="Enviar PING" onClick="return pingset( )">
        <div id="modal"></div>
        <script>
			function pingset() {
				var id = $("#bookId").val();
				$.ajax({
					type : "POST",
					url : "pingext.php?cmd=ping%20" + id,
					success : function(data) {
						$('#modal').html(data);
					}
				});
			}
                </script>
         </div>


          
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" onClick="return pingunset( )">Cerrar</button>
                    <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                            <script>
								function pingunset() {

									$('#modal').html(' ');

								}
                 			</script>
                </div>
            </div>
        </div>
    </div>

<script>
	$(document).on("click", ".open-AddBookDialog", function() {
		var myBookId = $(this).data('id');
		$(".modal-body #bookId").val(myBookId);
	}); 
</script>

<a href="index<? echo $tb; ?>.html" id="menufijo"><img src="images/admin.png"></a>

                    <div id="abajo">
					<div id="ok">
					  <b>CORRECTO</b>
					</div>
					<div id="ping">
					  <b>PING</b>
					</div>
					<div id="reping">
					  <b>RE-PING</b>
					</div>
					<div id="slow">
					  <b>LENTO > <? echo $range; ?> ms</b>
					</div>
					<div id="outline">
					  <b>CAIDA < 10 MIN</b>
					</div>
					<div id="down">
					  <b>CAIDA > 10 MIN</b>
					</div>
					</div>
</body>
</html>