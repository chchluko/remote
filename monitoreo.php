<!DOCTYPE html PUBLIC "-//IETF//DTD HTML 2.0//EN">
<html><head><title>.:: Server Monitor :..</title>

 <style>
  .selected {
    color: black;
    background: yellow;
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


   </style>


</head> <div>
  <p><font color="#003366" size="6" face="Verdana, Arial, Helvetica, sans-serif"><em><strong>Monitoreo de Enlaces<span id="livedate"> <?php echo date("d-m-Y"); ?></span><span id="liveclock"></span></strong></em></font></p>
  <p><font face="Verdana, Arial, Helvetica, sans-serif"><!--<img src="server.jpg">--></font></p><p></p> <font face="Verdana, Arial, Helvetica, sans-serif">
<?php
$system = ini_get('system');
$win  = (bool)  $windows;
$count = 1;

include("funciones.php");

connect_to_db();


$rs = mysql_query("SELECT MAX(id) AS a FROM chksoporte");
if ($row = mysql_fetch_row($rs)) {
$a = trim($row[0]);
//$a = 1; where id<2
}


$result = mysql_query("select id, ip_sucursal as host, nombre_sucursal as services  from chksoporte");

while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
$host[$row[0]] = $row["host"];
$services[$row[0]] = $row["services"];
}

mysql_free_result($result);

echo "<div id='navcontainer'>";
foreach ( $host as $value) 
{

  echo "<ul id='navlist'>";
  echo "<table border=\"1\" width=\"250px\" height=\"150px\">";
  $counter = $counter + 1;

  echo '<tr>';
  echo "<th colspan=\"2\" id='out$counter' class=\"titulo\">
  <h2>".$services[$counter]."</h2>
  </th>";
  echo "</tr>";
  echo "<tr>";
  echo "<th rowspan=\"2\">
  <span id=\"online$counter\"><img src=\"up.png\" /></span>
  <span id=\"timeout$counter\"><img src=\"down.jpg\" /></span>
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

</font>
<script type="text/javascript" src="jquery-latest.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    function getRandValue(a){
        value = $('#value').text();
        var idx = a;
        var online ='online'+idx;
        var timeout ='timeout'+idx;
        var out ='out'+idx;
        var target ='target'+idx;
        var value ='media'+idx;
        var dataString = 'id='+ idx;
        $.ajax({
            type: "POST",
            url: "monitoreoajax.php",
            data: dataString,
            success: function(data) {
              //console.log(data);
                $( "#"+value).text(data);
                 if(data == false)
                            {
                                $( "#"+timeout).show();
                                $( "#"+online).hide();
                                $( "#"+target).html('<p>Timeout...</p>');
                                travel(a);
                            }
                            else{
                                $( "#"+online).html('<p><img src="up.png" /></p>');
                                $( "#"+online).show();
                                $( "#"+timeout).hide();
                                $( "#"+target).hide();
                                $( "#"+out).removeClass( "selected" );
                            }
                         }
                    });
                }
var a = '<?php echo $a ?>';
var i = setInterval(timer, 1000);

function timer() {
    getRandValue(a);
    if (a < 2) {
        a = '<?php echo $a ?>';
        return;
    }
    a -= 1;
}

function travel(a){

        var idx = a;
        var online ="online"+idx;
        var timeout ='timeout'+idx;
        var value ='media'+idx;
        var out ='out'+idx;
        var target ='target'+idx;
        var dataString = 'id='+ idx;
                                 $.ajax({
                                                                type: "POST",
                                                                url: "monitoreoajax.php",
                                                                data: dataString,
                                                                success: function(data) {
                                                                    $( "#"+value).text(data);
                                                                    if(data == false)
                                                                                {
                                                                                    $( "#"+out).addClass( "selected" );
                                                                                    $( "#"+target).html('<p>Timeout...</p>');
                                                                                  }
                                                                                else{
                                                                                    $( "#"+online).html('<p><img src="up.png" /></p>');
                                                                                    $( "#"+online).show();
                                                                                    $( "#"+timeout).hide();
                                                                                    $( "#"+target).hide();
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