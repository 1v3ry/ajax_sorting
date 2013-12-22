<?
include '../constants.php';
mysql_connect(MYSQLHOST, MYSQLUSER, MYSQLPASS); 
mysql_select_db(MYSQLDB); 
$befehl = "SELECT * FROM `fach` WHERE sem = '".$_GET["sem"]."'"; 
$faecher = mysql_query($befehl); 
$output = "<option value='0' disabled='disabled' selected='selected'>---</option>";
while ($row = mysql_fetch_array($faecher)) 
{$output .= "<option value='$row[ID]'>".$row[name]."</option>";}
echo $output;
?>