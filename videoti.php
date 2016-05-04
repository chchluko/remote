<? 
$tb= 'videoconferencia'; //tabla referencia
$pk=4;            //paketes por PING
?>

<!DOCTYPE html PUBLIC "-//IETF//DTD HTML 2.0//EN">
<html><head>
	<meta http-equiv="refresh" content="3600">
	
	<title>.:: Server Monitor :..</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
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
  width: 270px; 
  height:220px;
}
h2{
	font-size: 22px;
}

    .bs-example{
    	margin: 20px;
    }
</style>


    
<script type="text/javascript" src="jquery-latest.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</head><body>	<div>
  <p><font color="#003366" size="6" face="Verdana, Arial, Helvetica, sans-serif"><em><strong>Monitoreo Video Conferencia<span id="livedate"> <?php echo date("d-m-Y"); ?></span><span id="liveclock"></span></strong></em></font></p>
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
  <h2>".$services[$counter]."</h2>
  </th>";
  echo '</tr>';
  echo '<tr>';
    echo "<th>
  <span id=\"online$counter\"><img src=\"correcto.png\"/></span>
  </th>";
  echo "</tr>";
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
        $("#"+online).html('<img src="ajax-loader.gif"/>');
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
                                //$( "#"+target).html('<p>Timeout...</p>');
                                travel(a,c,p);
                            }
                            else{
                                //$( "#"+online).html('<a data-toggle="modal" data-id="<?php echo $a ?>" title="Add this item" class="open-AddBookDialog btn btn-link" href="#addBookDialog"><p><img src="correcto.png" /></p></a>');
                                $( "#"+online).html('<p><img src="correcto.png" /></p>');
                                //$( "#"+online).show();
                               // $( "#"+timeout).hide();
                                //$( "#"+target).hide();
                                $( "#"+out).removeClass( "selected" );
                            }
                         }
                    });
                }
var a = '<?php echo $a ?>';
var i = setInterval(timer, 10000);
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
                                                                                    //$( "#"+target).html('<p>Timeout...</p>');
                                                                                    $( "#"+online).html('<p><img src="mal.png" /></p>');
                                                                                  }
                                                                                else{
                                                                                    $( "#"+online).html('<p><img src="correcto.png" /></p>');
                                                                                    //$( "#"+online).show();
                                                                                    //$( "#"+timeout).hide();
                                                                                    //$( "#"+target).hide();
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