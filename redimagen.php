<? 
$tb= 'redimagen'; //tabla referencia
$pk=4;            //paketes por PING
?>
<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="utf-8">
	<meta http-equiv="refresh" content="3600">
	
	<title>.:: Server Monitor :..</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>
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
</style>



    
<script type="text/javascript" src="jquery-latest.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</head><body>	<div>
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
//$a = 1; where id<2
}


$result = mysql_query("select id, ip_sucursal as host, nombre_sucursal as services from $tb");

while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
$host[$row[0]] = $row["host"];
$services[$row[0]] = $row["services"];
}

mysql_free_result($result);

echo "<div id='navcontainer'>";
foreach ( $host as $value) 
{
/*
  echo "<ul id='navlist'>";
  echo "<table border=\"0\" width=\"250px\" height=\"150px\">";
  $counter = $counter + 1;

  echo '<tr>';
  echo "<th colspan=\"2\" id='out$counter' class=\"titulo\">
  <h2>".$services[$counter]."</h2>
  </th>";
  echo "</tr>";
  echo "<tr>";
  echo "<th>
  <span id=\"online$counter\"><img src=\"correcto.png\" /></span>
  <span id=\"timeout$counter\"><img src=\"mal.png\" /></span>
  </th>";
  echo "<th>".$value."</th>";
  echo "</tr>";
  echo "<tr>";
  echo "<th scope=\"row\">
  <span id=\"media$counter\"></span>
  <span id=\"target$counter\"></span>
  </th>";
  echo "</tr>";
  echo "</table>";
  echo "</ul>";
 }
echo "</div>";?>
*/


  echo "<ul id=\"navlist\">";
  $counter = $counter + 1;
  echo "<table id=\"out$counter\" >";
  
  echo "<tr>";
   echo "<th class=\"titulo\">
  <h2>".utf8_encode($services[$counter])."</h2>
  </th>";
  echo '</tr>';
  echo '<tr>';
  echo "<th>".$value."</th>";
  echo '</tr>';
   /*echo '<tr>';
   echo "<th>
  <span id=\"online$counter\"><img src=\"correcto.png\"/></span>
  </th>";
  echo "</tr>";*/
  
  
    echo "<th>
  <span id=\"media$counter\"></span>
  <span id=\"target$counter\"></span>
  </th>";
  
  
  echo "</table>";
  echo "</ul>";
 }
echo "</div>";?>

<!--<span id=\"timeout$counter\"><img src=\"mal.png\" /></span>-->

</font>
<script type="text/javascript" src="jquery-latest.min.js"></script>
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
        var target ='target'+idx;
        var value ='media'+idx;
        //var dataString = 'id='+ idx;
        var dataString = 'id='+ idx  + '&pk=' + pk + '&tb=' + tb;
        $("#"+out).addClass( "check" );
        //$("#"+online).html('<img src="ajax-loader.gif"/>');
        $.ajax({
            type: "POST",
            url: "ajaxall.php",
            data: dataString,
            success: function(data) {
              //console.log(data);
                $( "#"+value).text(data);

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
                            }
                         }
                    });
                }
var a = '<?php echo $a ?>';
var i = setInterval(timer, 1000);
var c = '<?php echo $tb?>';
var p = '<?php echo $pk?>';

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
                                                                url: "ajaxall.php",
                                                                data: dataString,
                                                                success: function(data) {
                                                                    $( "#"+value).text(data);
                                                                    if(data == false)
                                                                                {
                                                                                    $( "#"+out).addClass( "selected" );
                                                                                    $( "#"+out).removeClass( "recheck" );
                                                                                    //$( "#"+target).html('<p>Timeout...</p>');
                                                                                    $( "#"+online).html('<p><img src="mal.png" /></p>');
                                                                                  }
                                                                                else{
                                                                                    $( "#"+online).html('<p><img src="correcto.png" /></p>');
                                                                                    //$( "#"+online).show();
                                                                                    //$( "#"+timeout).hide();
                                                                                    //$( "#"+target).hide();
                                                                                    $( "#"+out).removeClass( "recheck" );
                                                                                    $( "#"+out).removeClass( "selected" );
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
                    <h4 class="modal-title">Datos de sucursal</h4>
     </div>
    <div class="modal-body">
        <p>Identificador</p>
        <input type="text" name="bookId" id="bookId" value=""/>
    </div>


          
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                </div>
            </div>
        </div>
    </div>







     

<script>$(document).on("click", ".open-AddBookDialog", function () {
     var myBookId = $(this).data('id');
     $(".modal-body #bookId").val( myBookId );
});
</script>

</body> </html>