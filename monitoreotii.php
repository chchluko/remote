<? 
$tb= 'monitoreoti'; //tabla referencia
$pk=4;            //paketes por PING
$timer = 3000;
$range = 150;   //rango de ms en alerta
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">

<!--<!DOCTYPE html PUBLIC "-//IETF//DTD HTML 2.0//EN">-->
	<meta http-equiv="refresh" content="3600">
	
	<title>.:: Server Monitor :..</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/basico.css" rel="stylesheet">
<!-- <style>
  .selected {
    color: black;
    background: red;
      -webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.0);
-moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.0);
box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.0);
  }
    .check {
    color: black;
    background: #006400;
      -webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.50);
-moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.50);
box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.50);
  }
      .recheck {
    color: black;
   background: #FFFF00;
      -webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.25);
-moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.25);
box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.25);
  }
    .timeout {
    color: white;
    background: black;
      -webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.0);
-moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.0);
box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.0);
  }
  
      .outrange {
    color: white;
    background: orange;
      -webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.25);
-moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.25);
box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.25);
  }
        .reincen {
    color: black;
    background: white;
      -webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.25);
-moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.25);
box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.25);
  }
  
  
  ul
{
float: left;
list-style-type: none;
padding-right: 20px;
padding-bottom: 20px;
/*width: 30%;
height: 20%;*/
}
ul
 {
  /*border: 1px solid #90bade;*/
 }
img{
  width: 50px;
  height: 50px;
}
th{
  border: 0pt;
  text-align: center;
  
}
table {
  border-style: solid;
    border-width: 5px;
  width: 400px; 
  height:270px;
  
background: rgba(212,228,239,1);
background: -moz-radial-gradient(center, ellipse cover, rgba(212,228,239,1) 0%, rgba(134,174,204,1) 100%);
background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, rgba(212,228,239,1)), color-stop(100%, rgba(134,174,204,1)));
background: -webkit-radial-gradient(center, ellipse cover, rgba(212,228,239,1) 0%, rgba(134,174,204,1) 100%);
background: -o-radial-gradient(center, ellipse cover, rgba(212,228,239,1) 0%, rgba(134,174,204,1) 100%);
background: -ms-radial-gradient(center, ellipse cover, rgba(212,228,239,1) 0%, rgba(134,174,204,1) 100%);
background: radial-gradient(ellipse at center, rgba(212,228,239,1) 0%, rgba(134,174,204,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#d4e4ef', endColorstr='#86aecc', GradientType=1 );

  -webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
-moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
}
h2{
	font-size: 35px;
	font-weight: bold;
}

    .bs-example{
    	margin: 20px;
    }
 body{
 	background-color: #87CEFA;
 }
  #menufijo {

position: fixed; 
bottom: 20px;
right:20px;
z-index: -88;
}
 #menufijo img{
 	  width: 150px;
  height: 150px;
 }
 .to{
 	font-size: 2em;
 }
</style>-->


    
<script type="text/javascript" src="jquery-latest.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/rating.js"></script>
<link rel="stylesheet" type="text/css" href="css/rating.css" />

</head><body>	
	
	 <div>
	 	
  <p><font color="#003366" size="6" face="Verdana, Arial, Helvetica, sans-serif"><em><strong>Monitoreo Sucursales<span id="livedate"> <?php echo date("d-m-Y"); ?></span><span id="liveclock"></span></strong></em></font></p>
  <p><font face="Verdana, Arial, Helvetica, sans-serif"><!--<img src="server.jpg">--></font></p><p></p> <font face="Verdana, Arial, Helvetica, sans-serif">
<?php
$system = ini_get('system');
$win  = (bool)  $windows;
$count = 1;

include("funciones.php");

connect_to_db();


$rs = mysql_query("SELECT MAX(id) AS a FROM $tb");
if ($row = mysql_fetch_row($rs)) {
$a = trim($row[0]);
	}


$result = mysql_query("select id, ip_sucursal as host, nombre_sucursal as services from $tb");


// Put them in array
//for($i = 0; $array[$i] = mysql_fetch_assoc($result); $i++) ;
    
// Delete last empty one
/*array_pop($array);
echo '<pre>';
print_r($array);
echo '</pre>';*/

 while ($row = mysql_fetch_array($result, MYSQL_ASSOC) ) {

	echo "<div id='navcontainer'>";
  echo "<ul id=\"navlist\">";
  
 for($y=1; $y<=1; $y++){
 
 	$index=$row["id"];
	$tgt=$row["id"];
	$host[$row[y]] = $row["host"];
	$services[$row[y]] = $row["services"];
 


  echo "<table id=\"out$index\" >";
  echo "<tr>";
  echo "<th class=\"titulo\">
  <h2>".utf8_encode($services[$row[y]])."</h2>
  </th>";
  echo '</tr>';
  
  echo '<tr>';

  echo '<th><h2><a data-toggle="modal" data-id="'.$host[$row[y]].'"';
  echo 'title="Add this item" class="titulo open-AddBookDialog btn-link" href="#addBookDialog">'.$host[$row[y]].'</a></h2></th>';
    
  echo '</tr>';

  echo "<th>
    <span class=\"to\" id=\"media$index\"></span>
  <span id=\"target$index\"></span>
  <div id=\"star$index\" class=\"rating\">&nbsp;</div>
  </th>";
  
   echo "</table>";
  
 }
 
 
 echo "</ul>";
echo "</div>";
	
 }?>




</font>
<!--<script type="text/javascript" src="jquery-1.4.2.min.js"></script>-->
<script type="text/javascript">



$(document).ready(function() {
	
	/*$('#star1').rating('votar.php', {maxvalue: 5, curvalue:1, id:20});
	$('#star2').rating('votar.php', {maxvalue: 5, curvalue:3, id:20});*/
	
	
    function getRandValue(a,c,p){
        value = $('#value').text();
        var idx = a;
        var pk = p;
        var tb = c;
        var online ='online'+idx;
        var timeout ='timeout'+idx;
        var out ='out'+idx;
        var star = 'star'+idx;
        var target ='target'+idx;
        var value ='media'+idx;
        //var dataString = 'id='+ idx;
        var dataString = 'id='+ idx  + '&pk=' + pk + '&tb=' + tb;
        $("#"+out).addClass( "check" );
		$( "#"+out).removeClass( "recheck" );
		$( "#"+out).removeClass( "selected" );
		$( "#"+out).removeClass( "timeout" );
		$( "#"+out).removeClass( "outrange" );       
        
        //$("#"+online).html('<img src="ajax-loader.gif"/>');
        $.ajax({
            type: "POST",
            url: "ajaxout.php",
            data: dataString,
            success: function(data) {
              //console.log(data);
                $( "#"+value).text('Media '+data+' ms');
               /* if (parseInt(data) > 100){
                	$( "#"+value).text('Error');
                }*/
                
				//numero = parseInt(data);
                 if(data == false)
                            {
                               // $( "#"+timeout).show();
                               // $( "#"+online).hide();
                                $( "#"+online).html('<p><img src="mal.png"/></p>');
                                $( "#"+out).removeClass( "check" );
                                //$( "#"+target).html('<p>Timeout...</p>');
                                travel(a,c,p);
                            }
                            else{
                                //$( "#"+online).html('<a data-toggle="modal" data-id="<?php echo $a ?>" title="Add this item" class="open-AddBookDialog btn btn-link" href="#addBookDialog"><p><img src="correcto.png" /></p></a>');
                                $( "#"+online).html('<p><img src="correcto.png" /></p>');
                                //$( "#"+online).show();
                               // $( "#"+timeout).hide();
                                //$( "#"+target).hide();
                                $( "#"+out).removeClass( "check" );
                                $( "#"+out).removeClass( "selected" );
                                $( "#"+out).removeClass( "timeout" );
                              //  $("#"+star).rating('votar.php', {maxvalue: 5, curvalue:3, id:20});
                                if (parseInt(data) > rng){
					                	$("#"+out).addClass( "outrange" );
					                	
					                	var dataString = 'id='+ idx + '&mdia=' + parseInt(data);
				                         $.ajax({
				                         type: "POST",
				                         url: "slowlog.php",
				                         data: dataString, 
				                         success: function(data) {
				                         	}
				                         	
											});

					                }else{
					                	$( "#"+out).removeClass( "outrange" );
					                }
				                    var dataString = 'id='+ idx + '&mdia=' + parseInt(data);
				                         $.ajax({
				                         type: "POST",
				                         url: "updatebita.php",
				                         data: dataString
				                			});
                            }
                         }
                    });
                }
var a = '<?php echo $a ?>';
var i = setInterval(timer, <?php echo $timer ?>);
var c = '<?php echo $tb?>';
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
        //var dataString = 'id='+ idx;
        $("#"+out).addClass( "recheck" );
        //$( "#"+online).html('<p><img src="ajax-loader.gif" /></p>');
                                 $.ajax({
                                                                type: "POST",
                                                                url: "ajaxout.php",
                                                                data: dataString,
                                                                success: function(data) {
                                                                    //$( "#"+value).text(data);
                                                                    $( "#"+value).text('Media '+data+' ms');
                                                                    if(data == false)
                                                                                {
                                                                                    $( "#"+out).addClass( "selected" );
                                                                                    $( "#"+out).removeClass( "recheck" );
                                                                                    //$( "#"+target).html('<p>Timeout...</p>');
                                                                                    $( "#"+online).html('<p><img src="mal.png" /></p>');
                                                                                                                                                                        
                                                                                    
                                                                                    var dataString = 'id='+ idx;
                                                                                    $.ajax({type: "POST",url: "inserbita.php",data: dataString,
                                                                                    success: function(data) { $( "#"+value).text(data); console.log(data); if(data == false)  {    }  else{ 
                                                                                    	$( "#"+out).removeClass( "recheck" );
                                                                                    	$( "#"+out).removeClass( "selected" ); 
                                                                                    	$( "#"+out).addClass( "timeout" );
                                                                                    	}}
                                                                                    });

                                                                                  }
                                                                                else{
                                                                                    $( "#"+online).html('<p><img src="correcto.png" /></p>');
                                                                                    //$( "#"+online).show();
                                                                                    //$( "#"+timeout).hide();
                                                                                    //$( "#"+target).hide();
                                                                                    $( "#"+out).removeClass( "recheck" );
                                                                                    $( "#"+out).removeClass( "selected" );
                                                                                    $( "#"+out).removeClass( "timeout" );
                                                                                    if (parseInt(data) > rng){
																	                	$( "#"+out).addClass( "outrange" );
																	                }else{
																		                	$( "#"+out).removeClass( "outrange" );
																		                }
                                                          							var dataString = 'id='+ idx;
                                                                                    $.ajax({
								                                                                type: "POST",
								                                                                url: "updatebita.php",
								                                                                data: dataString
                                                                                     			});
                                                                                }
                                                                             }
                                                                        });
                                                                 }
});
</script>
<script type="text/javascript">
function startTime(){
today=new Date();
h=today.getHours();
m=today.getMinutes();
s=today.getSeconds();
m=checkTime(m);
s=checkTime(s);
document.getElementById('reloj').innerHTML=h+":"+m+":"+s;
t=setTimeout('startTime()',500);}
function checkTime(i)
{if (i<10) {i="0" + i;}return i;}
window.onload=function(){startTime();}
</script>
<div id="reloj" style="font-size:20px;"></div>
<script language="JavaScript" type="text/javascript">
 <!--

function show5(){
if (!document.layers&&!document.all&&!document.getElementById)
return

 var Digital=new Date()
 var hours=Digital.getHours()
 var minutes=Digital.getMinutes()
 var seconds=Digital.getSeconds()

var dn="PM"
if (hours<12)
dn="AM"
if (hours>12)
hours=hours-12
if (hours==0)
hours=12

 if (minutes<=9)
 minutes="0"+minutes
 if (seconds<=9)
 seconds="0"+seconds
//change font size here to your desire
myclock="<font size='5' face='Arial' ><b><font size='3'>&nbsp;&nbsp;&nbsp;&nbsp;</font>"+hours+":"+minutes+":"
 +seconds+" "+dn+"</b></font>"
if (document.layers){
document.layers.liveclock.document.write(myclock)
document.layers.liveclock.document.close()
}
else if (document.all)
liveclock.innerHTML=myclock
else if (document.getElementById)
document.getElementById("liveclock").innerHTML=myclock
setTimeout("show5()",1000)
 }


window.onload=show5
 //-->
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
       
        function pingset(){
        	 var id = $("#bookId").val();
        //console.log(id);
    $.ajax({
    //	var id = $("#bookId").val();
    //	var dataString = 'id='+ idx;
    //	console.log(dataString);
            type: "POST",
            url: "pingext.php?cmd=ping%20"+id,
           // data: dataString,
            success: function(data) {
             //console.log(data);
             $('#modal').html(data);
               //$( "#"+value).text(data);
              }
              });
   }     
                </script>
         </div>


          
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" onClick="return pingunset( )">Cerrar</button>
                    <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                            <script>
       
        function pingunset(){

             $('#modal').html(' ');
                       
                 }     
                 </script>
                </div>
            </div>
        </div>
    </div>







     

<script>$(document).on("click", ".open-AddBookDialog", function () {
     var myBookId = $(this).data('id');
     $(".modal-body #bookId").val( myBookId );
});
</script>

<a href="index.html" id="menufijo"><img src="images/admin.png"></a>

</body> </html>