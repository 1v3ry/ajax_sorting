<?
//error_reporting(NONE);
include '../constants.php';
mysql_connect(MYSQLHOST, MYSQLUSER, MYSQLPASS); 
mysql_select_db(MYSQLDB); 
switch($_GET["action"])
{
	case 'update':
			if(!mysql_query("UPDATE `fach` SET name='".$_POST["name"]."' WHERE ID = '".$_POST["fach"]."'"))
			{
				echo "Der Name des Faches konnte nicht geändert werden.";
			}
			else
			{
				$new_name = mysql_result(mysql_query("SELECT name FROM `fach` WHERE ID = ".$_POST["fach"]),0);
				echo "<div id='fach_text_".$_POST["fach"]."' class='altklausur_name' onclick='make_editable_faecher(this.id);' title='Namen von \"".$new_name."\" bearbeiten'>".$new_name."</div><span class='altklausur_delete' id='del_".$_POST["fach"]."' onclick='delete_fach(this.id);'><img src='../icons/error.png' height='25px' title='\"".$new_name."\" löschen'></span>";
			}
		break;
	case 'new':
			switch($_POST["sem"])
			{
				case '1': $stuga = 'bsc'; break;
				case '2': $stuga = 'bsc'; break;
				case '3': $stuga = 'bsc'; break;
				case '4': $stuga = 'bsc'; break;
				case '5': $stuga = 'bsc'; break;
				case '6': $stuga = 'bsc'; break;
				case 'w': $stuga = 'msc'; break;
				case 's': $stuga = 'msc'; break;
			}
			if(!mysql_query("INSERT INTO `fach` (name, sem, stuga) VALUES ('".$_POST["name"]."', '".$_POST["sem"]."', '".$stuga."')"))
			{
				echo "<div class='altklausur error'>Das Fach konnte nicht hinzugefügt werden.</div>";
			}
			else
			{
				$fach = mysql_result(mysql_query('SELECT ID FROM `fach` ORDER BY ID DESC LIMIT 1'),0);
				mkdir("/www/htdocs/chemie/altklausuren/".$_POST["sem"]."/".$fach, 0777);
				$new_name = mysql_result(mysql_query("SELECT name FROM `fach` ORDER BY ID DESC LIMIT 1"),0);
				$id = mysql_result(mysql_query("SELECT ID FROM `fach` ORDER BY ID DESC LIMIT 1"),0);
				echo "<div class='altklausur fach' id='fach_".$id."'><div id='fach_text_".$id."' class='altklausur_name' onclick='make_editable_faecher(this.id);' title='Namen von \"".$new_name."\" bearbeiten'>".$new_name."</div><span class='altklausur_delete' id='del_".$id."' onclick='delete_fach(this.id);'><img src='../icons/error.png' height='25px' title='\"".$new_name."\" löschen'></span></div>";
			}
		break;
	case 'delete':
			$sem = mysql_result(mysql_query('SELECT sem FROM `fach` WHERE ID = "'.$_POST["fach"].'"'),0);
			if(mysql_query("DELETE FROM `fach` WHERE ID = '".$_POST["fach"]."' LIMIT 1") && rmdir("/www/htdocs/chemie/altklausuren/".$sem."/".$_POST["fach"]))
			{
				echo "true";
			}
			else
			{
				echo "false";
			}
		break;
	case 'newsem':
			$query = mysql_query("SELECT * FROM `material` WHERE fach = '".$_POST["fach"]."'");
			$sem = mysql_result(mysql_query('SELECT sem FROM `fach` WHERE ID = "'.$_POST["fach"].'"'),0);
			if(!mkdir("/www/htdocs/chemie/altklausuren/".$_POST["sem"]."/".$_POST["fach"], 0755))
				{
					$error = "error";
				}
				else
				{
					$error = "true";
				}
			while($row = mysql_fetch_array($query))
			{
				if(!mysql_query("UPDATE `fach` SET sem = '".$_POST["sem"]."' WHERE ID = '".$_POST["fach"]."' LIMIT 1") || !copy("/www/htdocs/chemie/altklausuren/".$sem."/".$_POST["fach"]."/".$row["filename"],"/www/htdocs/chemie/altklausuren/".$_POST["sem"]."/".$_POST["fach"]."/".$row["filename"]) || !unlink("/www/htdocs/chemie/altklausuren/".$sem."/".$_POST["fach"]."/".$row["filename"]) )
				{
					$error = "error";
				}
				else
				{
					$error = "true";
				}
			}
			if(!rmdir("/www/htdocs/chemie/altklausuren/".$sem."/".$_POST["fach"]))
			{
				$error .= "error";
			}
			else
			{
				$error .= "true";
			}
			if(preg_match('/error/', $error) == 1)
			{
				echo "error";
			}
			else
			{
				echo "true";
			}
		break;
}
?>