<?php
error_reporting(NONE);
include '../constants.php';
mysql_select_db(MYSQLDB, mysql_connect(MYSQLHOST, MYSQLUSER, MYSQLPASS));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html" charset="UTF-8" />

<title>Chemie - Fundgrube | Adminbereich</title>
<LINK REL="SHORTCUT ICON" HREF="icon.ico">
<link href="http://chemie-fundgrube.de/960_12_col.css" rel="stylesheet" type="text/css" />
<link href="http://chemie-fundgrube.de/default.css.php" rel="stylesheet" type="text/css"/>
<link type="text/css" href="http://chemie-fundgrube.de/jquery/css/fundgrube_theme/jquery-ui-1.10.2.custom.css.php" rel="Stylesheet" media='screen'/>
<link rel="icon" type="image/png" href="/icons/fsr_kolben2.png">
<script type="text/javascript" src="http://chemie-fundgrube.de/jquery/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="http://chemie-fundgrube.de/jquery/js/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="http://chemie-fundgrube.de/jquery/js/jquery-ui-1.10.3.custom.js"></script>
</head>


<body>
<div id="fixiert">
       <div id="menue" class='container_12'>
                 <ul>
                        <li class='grid_4'></li>
                        <li class='grid_4'><a href="index.php">Adminbereich</a></li>
                        <li class='grid_4'></li>
                </ul>
                <img src='/icons/color.ico' id='color_picker_icon' title='Farbschema wählen' alt='Farbschema Symbol' onclick="$('#color_picker_container').toggleClass('visible', {effect:'easeInQuad', duration:300});">
		</div>
</div>

<!-- start wrapper -->
<div id='wrapper' class='container_12'>

<!-- start header -->
<div id="header">
		<div id='color_picker_container'><span class='color_picker_choose <? if($_COOKIE["color-scheme"]=='green'){echo "active";} ?>' id='color_picker_green' onclick='change_color("green");'></span><span class='color_picker_choose <? if($_COOKIE["color-scheme"]=='blue'){echo "active";} ?>' id='color_picker_blue' onclick='change_color("blue");'></span><span class='color_picker_choose <? if($_COOKIE["color-scheme"]=='red'){echo "active";} ?>' id='color_picker_red' onclick='change_color("red");'></span><span class='color_picker_choose <? if($_COOKIE["color-scheme"]=='orange'){echo "active";} ?>' id='color_picker_orange' onclick='change_color("orange");'></span><span class='color_picker_choose <? if($_COOKIE["color-scheme"]=='yellow'){echo "active";} ?>' id='color_picker_yellow' onclick='change_color("yellow");'></span><span class='color_picker_choose <? if($_COOKIE["color-scheme"]=='purple'){echo "active";} ?>' id='color_picker_purple' onclick='change_color("purple");'></span><span class='color_picker_choose <? if($_COOKIE["color-scheme"]=='lightblue'){echo "active";} ?>' id='color_picker_lightblue' onclick='change_color("lightblue");'></span><span class='color_picker_choose <? if($_COOKIE["color-scheme"]=='gray'){echo "active";} ?>' id='color_picker_gray' onclick='change_color("gray");'></span></div>
        <div id="logo" class='grid_4'><div id='login' style='display:none; background: #000000; float: right; z-index: 3; padding: 15pt; border: 1pt solid #FFC900; margin:5pt;'><form action='index.php' target='_self' method='post'><input type='text' placeholder='Username' name='user'><br><input type='password' name='pass' placeholder='Passwort'><br><br><input type='submit' name='login' value='Login'> <input type='reset'></form></div>
	<div id='user' style='display:none; background: #000000; float: right; z-index: 3; padding: 15pt; border: 1pt solid #FFC900; margin:5pt; text-align:center; position:fixed; margin-left:100px;'><? if ($user_level >= 1) { echo "<a href='user.php?id=".$user_id."'>Mein Profil</a><br /><br />"; } ?><a href='/bookmarks.php'>Bookmarks</a><br/><br/><a href='index.php?a=logout'>Logout</a></div></div>
        <div id="headline" class='grid_8'>Chemie Fundgrube</div>
        <div id="headmsg" class='grid_8'>powered by <a href='http://www.uni-leipzig.de/~fsrchem/' target='_blank'><img src='http://chemie-fundgrube.de/icons/fsr_logo.png' id='fsr_logo'></a></div>
</div>
<? if($_SERVER["REMOTE_USER"] == "FSRChemie")
{
echo "
<script type='text/javascript'>

function setcss()
{
	var cssLink = document.createElement('link') 
	cssLink.href = '/admin/stats.css.php'; 
	cssLink.rel = 'stylesheet'; 
	cssLink.type = 'text/css'; 
	frames['stats'].document.body.appendChild(cssLink);
}

function change_color(color)
{
	exp_date = new Date(new Date().getTime()+15811200000);
	exp_date2 = exp_date.toGMTString();
	document.cookie = 'color-scheme='+color+'; expires='+exp_date2+'; path=/;';
	$('#color_picker_container').toggleClass('visible', {effect:'easeInQuad', duration:300});
	window.setTimeout('window.location.reload()',500);
}
//HERE
function getfach(value)
{
var ajaxRequest;  // The variable that makes Ajax possible!	
try{
	// Opera 8.0+, Firefox, Safari
	ajaxRequest = new XMLHttpRequest();
} catch (e){
	// Internet Explorer Browsers
	try{
		ajaxRequest = new ActiveXObject('Msxml2.XMLHTTP');
	} catch (e) {
		try{
			ajaxRequest = new ActiveXObject('Microsoft.XMLHTTP');
		} catch (e){
			// Something went wrong
			alert('Your browser broke!');
			return false;
		}
	}
}
ajaxRequest.open('GET', 'get_fach.php?sem=' + value, true);
ajaxRequest.send(null); 

document.getElementById('fach').disabled = '';
// Create a function that will receive data sent from the server
ajaxRequest.onreadystatechange = function(){
	if(ajaxRequest.readyState == 4){
		var ajaxDisplay = document.getElementById('fach')
		ajaxDisplay.innerHTML = ajaxRequest.responseText;
	}
}
}

function getfach_user_upload(id)
{
var ajaxRequest;  // The variable that makes Ajax possible!	
try{
	// Opera 8.0+, Firefox, Safari
	ajaxRequest = new XMLHttpRequest();
} catch (e){
	// Internet Explorer Browsers
	try{
		ajaxRequest = new ActiveXObject('Msxml2.XMLHTTP');
	} catch (e) {
		try{
			ajaxRequest = new ActiveXObject('Microsoft.XMLHTTP');
		} catch (e){
			// Something went wrong
			alert('Your browser broke!');
			return false;
		}
	}
}
ajaxRequest.open('GET', 'get_fach.php?sem=' + document.getElementById('semester_'+id).value, true);
ajaxRequest.send(null); 

document.getElementById('fach_'+id).disabled = '';
// Create a function that will receive data sent from the server
ajaxRequest.onreadystatechange = function(){
	if(ajaxRequest.readyState == 4){
		var ajaxDisplay = document.getElementById('fach_'+id);
		ajaxDisplay.innerHTML = ajaxRequest.responseText;
		NeuerEintrag = new Option('anderes', 'other', false, false);
  		ajaxDisplay.options[ajaxDisplay.length] = NeuerEintrag;
  		ajaxDisplay.options[ajaxDisplay.length-1].disabled = 'true';
		for(var i=0; i<= ajaxDisplay.length; i++)
		{
			if(ajaxDisplay.options[i].value == suggested_fach[id]) {ajaxDisplay.selectedIndex = i;}
		}
		if(ajaxDisplay.selectedIndex == null)
		{
			ajaxDisplay.selectedIndex = ajaxDisplay.length;
		}
	}
}
}

function getaltklausuren(value)
{
var ajaxRequest;  // The variable that makes Ajax possible!	
try{
	// Opera 8.0+, Firefox, Safari
	ajaxRequest = new XMLHttpRequest();
} catch (e){
	// Internet Explorer Browsers
	try{
		ajaxRequest = new ActiveXObject('Msxml2.XMLHTTP');
	} catch (e) {
		try{
			ajaxRequest = new ActiveXObject('Microsoft.XMLHTTP');
		} catch (e){
			// Something went wrong
			alert('Your browser broke!');
			return false;
		}
	}
}
ajaxRequest.open('GET', 'handle_altklausuren.php?action=show&fach=' + value, true);
ajaxRequest.send(null); 

document.getElementById('fach').disabled = '';
// Create a function that will receive data sent from the server
ajaxRequest.onreadystatechange = function(){
	if(ajaxRequest.readyState == 4){
		var ajaxDisplay = document.getElementById('altklausuren');
		ajaxDisplay.innerHTML = ajaxRequest.responseText;
	}
}
}

function update_altklausur(id, text)
{
document.getElementById('loading').style.display = 'block';
var ajaxRequest;  // The variable that makes Ajax possible!	
try{
	// Opera 8.0+, Firefox, Safari
	ajaxRequest = new XMLHttpRequest();
} catch (e){
	// Internet Explorer Browsers
	try{
		ajaxRequest = new ActiveXObject('Msxml2.XMLHTTP');
	} catch (e) {
		try{
			ajaxRequest = new ActiveXObject('Microsoft.XMLHTTP');
		} catch (e){
			// Something went wrong
			alert('Your browser broke!');
			return false;
		}
	}
}
var text=encodeURIComponent(text);
id=id.substr(6, id.length);
var parameters='file='+id+'&name='+text;
ajaxRequest.open('POST', 'handle_altklausuren.php?action=update', true);
ajaxRequest.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
ajaxRequest.send(parameters);
// Create a function that will receive data sent from the server
ajaxRequest.onreadystatechange = function(){
	if(ajaxRequest.readyState == 4){
		document.getElementById('loading').style.display = 'none';
		var ajaxDisplay = document.getElementById(id);
		ajaxDisplay.innerHTML = ajaxRequest.responseText;
	}
}
}

function update_altklausur_user_upload(id, text)
{
document.getElementById('loading').style.display = 'block';
var ajaxRequest;  // The variable that makes Ajax possible!	
try{
	// Opera 8.0+, Firefox, Safari
	ajaxRequest = new XMLHttpRequest();
} catch (e){
	// Internet Explorer Browsers
	try{
		ajaxRequest = new ActiveXObject('Msxml2.XMLHTTP');
	} catch (e) {
		try{
			ajaxRequest = new ActiveXObject('Microsoft.XMLHTTP');
		} catch (e){
			// Something went wrong
			alert('Your browser broke!');
			return false;
		}
	}
}
var text=encodeURIComponent(text);
id=id.substr(6, id.length);
var parameters='file='+id+'&name='+text;
ajaxRequest.open('POST', 'handle_altklausuren.php?action=update_user_upload', true);
ajaxRequest.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
ajaxRequest.send(parameters);
// Create a function that will receive data sent from the server
ajaxRequest.onreadystatechange = function(){
	if(ajaxRequest.readyState == 4){
		document.getElementById('loading').style.display = 'none';
		var ajaxDisplay = document.getElementById(id);
		ajaxDisplay.innerHTML = ajaxRequest.responseText;
	}
}
}

function upload_altklausuren()
{

error = false;
if(document.getElementById('new_file_1').value != '')
{
	if(document.getElementById('new_name_1').value == '')
	{
		document.getElementById('new_name_1').style.border = '1px solid #FF0000';
		error = true;
	}
	else
	{
		document.getElementById('new_name_1').style.border = '';
	}
}
if(document.getElementById('new_file_2').value != '')
{
	if(document.getElementById('new_name_2').value == '')
	{
		document.getElementById('new_name_2').style.border = '1px solid #FF0000';
		error = true;
	}
	else
	{
		document.getElementById('new_name_2').style.border = '';
	}
}
if(document.getElementById('new_file_3').value != '')
{
	if(document.getElementById('new_name_3').value == '')
	{
		document.getElementById('new_name_3').style.border = '1px solid #FF0000';
		error = true;
	}
	else
	{
		document.getElementById('new_name_3').style.border = '';
	}
}
if(document.getElementById('new_file_4').value != '')
{
	if(document.getElementById('new_name_4').value == '')
	{
		document.getElementById('new_name_4').style.border = '1px solid #FF0000';
		error = true;
	}
	else
	{
		document.getElementById('new_name_4').style.border = '';
	}
}
if(document.getElementById('new_file_5').value != '')
{
	if(document.getElementById('new_name_5').value == '')
	{
		document.getElementById('new_name_5').style.border = '1px solid #FF0000';
		error = true;
	}
	else
	{
		document.getElementById('new_name_5').style.border = '';
	}
}
if(document.getElementById('new_file_1').value == '' && document.getElementById('new_file_2').value == '' && document.getElementById('new_file_3').value == '' && document.getElementById('new_file_4').value == '' && document.getElementById('new_file_5').value == '')
{
error = true;
}

if(error == true)
{
	return false;
}

document.getElementById('loading').style.display = 'block';

var ajaxRequest;  // The variable that makes Ajax possible!	
try{
	// Opera 8.0+, Firefox, Safari
	ajaxRequest = new XMLHttpRequest();
} catch (e){
	// Internet Explorer Browsers
	try{
		ajaxRequest = new ActiveXObject('Msxml2.XMLHTTP');
	} catch (e) {
		try{
			ajaxRequest = new ActiveXObject('Microsoft.XMLHTTP');
		} catch (e){
			// Something went wrong
			alert('Your browser broke!');
			return false;
		}
	}
}

var formElement = document.getElementById('upload_altklausuren');
ajaxRequest.open('POST', 'handle_altklausuren.php?action=upload', true);
ajaxRequest.send(new FormData(formElement));

ajaxRequest.onreadystatechange = function(){
	if(ajaxRequest.readyState == 4){
		document.getElementById('loading').style.display = 'none';
		document.getElementById('altklausuren').innerHTML = ajaxRequest.responseText;
	}
}
}

function make_editable(id)
{
	id2 = 'input_'+id;
	if(!document.getElementById(id2))
	{
		document.getElementById(id).innerHTML = '<input type=\'text\' id=\\'input_' + id + '\\' value=\\'' + document.getElementById(id).innerHTML + '\\' class=\\'altklausur_input\\' onblur=\\'update_altklausur(this.id, this.value);\\'>';	
		document.getElementById(id2).addEventListener('keypress', function(e){if(e.keyCode == 13) { update_altklausur(id2, document.getElementById(id2).value); } }, false);
		document.getElementById(id2).focus();
	}
}
//HERE
function make_editable_faecher(id)
{
	id2 = 'input_'+id.substr(10, id.length);
	id3 = 'fach_'+id.substr(10, id.length);
	id4 = 'fach_text_'+id.substr(10, id.length);
	if(!document.getElementById(id2))
	{
		document.getElementById(id3).innerHTML = '<input type=\\'text\\' id=\\'input_' + id.substr(10, id.length) + '\\' value=\\'' + document.getElementById(id4).innerHTML + '\\' class=\'altklausur_input\\' onblur=\\'update_fach(this.id, this.value);\\'>';	
		document.getElementById(id2).addEventListener('keypress', function(e){if(e.keyCode == 13) { update_fach(id2, document.getElementById(id2).value); } }, false);
		document.getElementById(id2).focus();
	}
}

function make_editable_user_upload(id)
{
	id2 = 'input_'+id;
	if(!document.getElementById(id2))
	{
		document.getElementById(id).innerHTML = '<input type=\\'text\\' id=\\'input_' + id + '\\' value=\\'' + document.getElementById(id).innerHTML + '\\' class=\\'altklausur_input\\' onblur=\\'update_altklausur_user_upload(this.id, this.value);\\'>';	
		document.getElementById(id2).addEventListener('keypress', function(e){if(e.keyCode == 13) { update_altklausur(id2, document.getElementById(id2).value); } }, false);
		document.getElementById(id2).focus();
	}
}

function delete_altklausur(id)
{
	id = id.substr(4,id.length);
	if(confirm('Die Datei \'' + document.getElementById(id).innerHTML + '\' wirklich löschen?'))
	{
		document.getElementById('loading').style.display = 'block';
		var ajaxRequest;  // The variable that makes Ajax possible!	
		try{
			// Opera 8.0+, Firefox, Safari
			ajaxRequest = new XMLHttpRequest();
		} catch (e){
			// Internet Explorer Browsers
			try{
				ajaxRequest = new ActiveXObject('Msxml2.XMLHTTP');
			} catch (e) {
				try{
					ajaxRequest = new ActiveXObject('Microsoft.XMLHTTP');
				} catch (e){
					// Something went wrong
					alert('Your browser broke!');
					return false;
				}
			}
		}
		var parameters='file='+id
		ajaxRequest.open('POST', 'handle_altklausuren.php?action=delete', true);
		ajaxRequest.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		ajaxRequest.send(parameters);
		id=id.substr(6, id.length);
		// Create a function that will receive data sent from the server
		ajaxRequest.onreadystatechange = function(){
			if(ajaxRequest.readyState == 4){
				document.getElementById('loading').style.display = 'none';
				var ajaxDisplay = document.getElementById('altklausuren')
				ajaxDisplay.innerHTML = ajaxRequest.responseText;
			}
		}
	}
	else
	{
		return false;
	}
}

function delete_altklausur_user_upload(id)
{
	id = id.substr(4,id.length);
	if(confirm('Die Datei \'' + document.getElementById(id).innerHTML + '\' wirklich löschen?'))
	{
		document.getElementById('loading').style.display = 'block';
		var ajaxRequest;  // The variable that makes Ajax possible!	
		try{
			// Opera 8.0+, Firefox, Safari
			ajaxRequest = new XMLHttpRequest();
		} catch (e){
			// Internet Explorer Browsers
			try{
				ajaxRequest = new ActiveXObject('Msxml2.XMLHTTP');
			} catch (e) {
				try{
					ajaxRequest = new ActiveXObject('Microsoft.XMLHTTP');
				} catch (e){
					// Something went wrong
					alert('Your browser broke!');
					return false;
				}
			}
		}
		var parameters='file='+id
		ajaxRequest.open('POST', 'handle_altklausuren.php?action=delete_user_upload', true);
		ajaxRequest.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		ajaxRequest.send(parameters);
		// Create a function that will receive data sent from the server
		ajaxRequest.onreadystatechange = function(){
			if(ajaxRequest.readyState == 4){
				document.getElementById('loading').style.display = 'none';
				if(ajaxRequest.responseText == 'ok')
				{
					$('#altklausur_' + id).hide('drop', {direction:'down', duration:300});
					document.getElementById('total_uploads').innerHTML = document.getElementById('total_uploads').innerHTML-1;
				}
				else
				{
					alert(\"Es ist ein Fehler aufgetreten.\\nBitte versuche es erneut!\");
				}
			}
		}
	}
	else
	{
		return false;
	}
}


function save_faecher(event, ui, sem_id)
{
//	alert(ui.item.attr('id') + ';' + sem_id);
	document.getElementById('loading').style.display = 'block';
	var ajaxRequest;  // The variable that makes Ajax possible!	
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject('Msxml2.XMLHTTP');
		} catch (e) {
			try{
				ajaxRequest = new ActiveXObject('Microsoft.XMLHTTP');
			} catch (e){
				// Something went wrong
				alert('Your browser broke!');
				return false;
			}
		}
	}
	sem_id = sem_id.substr(12,sem_id.length);
	fach = ui.item.attr('id').substr(5,ui.item.attr('id').length);
	var parameters='sem='+sem_id+'&fach='+fach;
	ajaxRequest.open('POST', 'handle_fach.php?action=newsem', true);
	ajaxRequest.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	ajaxRequest.send(parameters);

	// Create a function that will receive data sent from the server
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			document.getElementById('loading').style.display = 'none';
			if(ajaxRequest.responseText != 'true')
			{
				document.getElementById('faecher_sem_'+sem_id).innerHTML = '<div class=\\'altklausur error\\'>Das Fach konnte nicht verschoben werden</div>' + document.getElementById('faecher_sem_'+sem_id).innerHTML;
			}
		}
	}
}
//HERE
function update_fach(id, text)
{
document.getElementById('loading').style.display = 'block';
var ajaxRequest;  // The variable that makes Ajax possible!	
try{
	// Opera 8.0+, Firefox, Safari
	ajaxRequest = new XMLHttpRequest();
} catch (e){
	// Internet Explorer Browsers
	try{
		ajaxRequest = new ActiveXObject('Msxml2.XMLHTTP');
	} catch (e) {
		try{
			ajaxRequest = new ActiveXObject('Microsoft.XMLHTTP');
		} catch (e){
			// Something went wrong
			alert('Your browser broke!');
			return false;
		}
	}
}
id=id.substr(6, id.length);
var parameters='fach='+id+'&name='+text;
ajaxRequest.open('POST', 'handle_fach.php?action=update', true);
ajaxRequest.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
ajaxRequest.send(parameters);
id = 'fach_' + id;
// Create a function that will receive data sent from the server
ajaxRequest.onreadystatechange = function(){
	if(ajaxRequest.readyState == 4){
		document.getElementById('loading').style.display = 'none';
		var ajaxDisplay = document.getElementById(id);
		ajaxDisplay.innerHTML = ajaxRequest.responseText;
	}
}
}
//HERE
function new_fach(sem)
{
document.getElementById('loading').style.display = 'block';
var ajaxRequest;  // The variable that makes Ajax possible!	
try{
	// Opera 8.0+, Firefox, Safari
	ajaxRequest = new XMLHttpRequest();
} catch (e){
	// Internet Explorer Browsers
	try{
		ajaxRequest = new ActiveXObject('Msxml2.XMLHTTP');
	} catch (e) {
		try{
			ajaxRequest = new ActiveXObject('Microsoft.XMLHTTP');
		} catch (e){
			// Something went wrong
			alert('Your browser broke!');
			return false;
		}
	}
}
var text = document.getElementById('new_fach_' + sem).value;
var parameters='sem='+sem+'&name='+text;
ajaxRequest.open('POST', 'handle_fach.php?action=new', true);
ajaxRequest.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
ajaxRequest.send(parameters);

// Create a function that will receive data sent from the server
ajaxRequest.onreadystatechange = function(){
	if(ajaxRequest.readyState == 4){
		document.getElementById('loading').style.display = 'none';
		var ajaxDisplay = document.getElementById('faecher_sem_'+sem);
		content_length = ajaxDisplay.innerHTML.length-439;
		content = ajaxDisplay.innerHTML.substr(0, content_length);
		ajaxDisplay.innerHTML = content;
		ajaxDisplay.innerHTML += ajaxRequest.responseText;
		ajaxDisplay.innerHTML += '<div class=\\'altklausur fach_new\\'><input type=\\'text\\' id=\\'new_fach_' + sem + '\\' name=\\'new_fach_' + sem + '\\' class=\\'altklausur_input new\\' placeholder=\\'neues Fach\\'><span class=\\'altklausur_delete\\' onclick=\\'new_fach(\\'' + sem + '\\');\\'><img src=\\'../icons/upload.png\\' height=\\'25px\\' style=\\'margin-top:2px;\\' title=\\'Fach hinzufügen\\'></div>';
	}
}
}

//HERE
function delete_fach(id)
{
	id = id.substr(4,id.length);
	id2 = 'fach_text_' + id;
	if(confirm('Das Fach \'' + document.getElementById(id2).innerHTML + '\' wirklich löschen?'))
	{
		document.getElementById('loading').style.display = 'block';
		var ajaxRequest;  // The variable that makes Ajax possible!	
		try{
			// Opera 8.0+, Firefox, Safari
			ajaxRequest = new XMLHttpRequest();
		} catch (e){
			// Internet Explorer Browsers
			try{
				ajaxRequest = new ActiveXObject('Msxml2.XMLHTTP');
			} catch (e) {
				try{
					ajaxRequest = new ActiveXObject('Microsoft.XMLHTTP');
				} catch (e){
					// Something went wrong
					alert('Your browser broke!');
					return false;
				}
			}
		}
		var parameters='fach='+id
		ajaxRequest.open('POST', 'handle_fach.php?action=delete', true);
		ajaxRequest.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		ajaxRequest.send(parameters);
		// Create a function that will receive data sent from the server
		ajaxRequest.onreadystatechange = function(){
			if(ajaxRequest.readyState == 4){
				document.getElementById('loading').style.display = 'none';
				if(ajaxRequest.responseText == 'true')
				{
					$('#fach_'+id).hide('drop', {direction:'down', duration:300});
				}
				else
				{
					document.getElementById('fach_'+id).innerHTML = 'Das Fach konnte nicht gelöscht werden';
					$('#fach_'+id).addClass('error');	
				}
			}
		}
	}
	else
	{
		return false;
	}
}

function move_user_upload(id)
{
	id = id.substr(5,id.length);
	document.getElementById('loading').style.display = 'block';
	var ajaxRequest;  // The variable that makes Ajax possible!	
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject('Msxml2.XMLHTTP');
		} catch (e) {
			try{
				ajaxRequest = new ActiveXObject('Microsoft.XMLHTTP');
			} catch (e){
				// Something went wrong
				alert('Your browser broke!');
				return false;
			}
		}
	}
	var sem = document.getElementById('semester_'+id).value;
	var fach = document.getElementById('fach_'+id).value;
	var parameters='file='+id+'&sem='+sem+'&fach='+fach;
	ajaxRequest.open('POST', 'handle_altklausuren.php?action=move_user_upload', true);
	ajaxRequest.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	ajaxRequest.send(parameters);
	// Create a function that will receive data sent from the server
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			document.getElementById('loading').style.display = 'none';
			if(ajaxRequest.responseText == 'ok')
			{
				$('#altklausur_' + id).hide('drop', {direction:'down', duration:300});
				document.getElementById('total_uploads').innerHTML = document.getElementById('total_uploads').innerHTML-1;
			}
			else
			{
				alert('Es ist ein Fehler aufgetreten.\\nBitte versuche es erneut!');
			}
		}
	}
}";
}
?>
</script>


<!-- start page -->
<!-- start sidebars -->
        <div class="grid_3">               
                                <ul class="left_altklausuren">
                                	<? if($_SERVER["REMOTE_USER"] == "FSRChemie")
									{
                                	echo"	<a href='index.php' ><div class='klausur_semester ";
                                	 if($_GET["action"]==''){echo "master";}
                                	 echo "'>Shoutbox</div></a>
                                        <a href='index.php?action=altklausuren'><div class='klausur_semester ";
                                     if($_GET["action"]=='altklausuren'){echo "master";}
                                     echo "'>Altklausuren</div></a>
                                        <a href='index.php?action=user_upload'><div class='klausur_semester ";
                                     if($_GET["action"]=='user_upload'){echo "master";}
                                     echo "'>User Upload <span class='altklausuren_nr' id='total_uploads' style='height:15px; margin-topn:-2px; border:1px solid black; float:right;'>";
                                     echo mysql_num_rows(mysql_query("SELECT * FROM user_upload"));
                                     echo "</span></div></a>
                                        <a href='index.php?action=faecher'><div class='klausur_semester ";
                                     if($_GET["action"]=='faecher'){echo "master";}
                                     echo "'>Fächer</div></a>
                                        <a href='index.php?action=klausurtermine'><div class='klausur_semester ";
                                     if($_GET["action"]=='klausurtermine'){echo "master";}
                                     echo "'>Klausurtermine</div></a>";
                                     }
                                     	echo "<a href='index.php?action=rechtskunde'><div class='klausur_semester ";
                                     	if($_GET["action"]=='rechtskunde'){echo "master";}
                                     	echo "'>Rechtskunde</div></a>";
                                     if($_SERVER["REMOTE_USER"] == "FSRChemie")
									 {
                                     echo "  <a href='index.php?action=stats'><div class='klausur_semester ";
                                     if($_GET["action"]=='stats'){echo "master";}
                                     echo "'>Statistiken</div></a>";
                                     }
                                	?>
                                </ul>
        </div>
        <!-- end sidebars -->


        <!-- start content -->
        <div class='grid_9'>
			<?	echo "<div id='loading'>
								</div>";
				switch($_GET["action"])
				{
					case 'altklausuren':
							if($_SERVER["REMOTE_USER"] == "FSRChemie")
							{
								echo "
									<div id='selection'>
										<span id='semester_selection'>
											1.<br>
											<select name='semester' id='semester' onchange='getfach(this.value);' autofocus='autofocus' tabindex='1'>
												<option value='0' disabled='true' selected='true'>---</option>
												<option value='1'>1. FS B. Sc.</option>
												<option value='2'>2. FS B. Sc.</option>
												<option value='3'>3. FS B. Sc.</option>
												<option value='4'>4. FS B. Sc.</option>
												<option value='5'>5. FS B. Sc.</option>
												<option value='6'>6. FS B. Sc.</option>
												<option value='w'>WS M. Sc.</option>
												<option value='s'>SS M. Sc.</option>
											</select>
										</span>
										<span id='fach_selection'>
											2.<br>
											<select name='fach' id='fach' disabled='disabled' onchange='getaltklausuren(this.value);' tabindex='2'>
												<option value='0'>---</option>
											</select>
										</span>
									</div>
									<div id='altklausuren'>
									</div>
										";
							}
						break;
					case 'user_upload':
							if($_SERVER["REMOTE_USER"] == "FSRChemie")
							{
								echo "<script type='text/javascript'> var suggested_fach = new Array();</script>";
								$altklausuren = mysql_query("SELECT * FROM `user_upload`");
								if(mysql_num_rows($altklausuren) == 0)
								{
								echo "<div class='altklausur' style='text-align:center;'>Keine Dateien vorhanden</div>";
								}
								else
								{
									while($row = mysql_fetch_array($altklausuren))
									{
										if($row["sem"] == '1') {$sem1 = "selected";} else {$sem1 = "";}
										if($row["sem"] == '2') {$sem2 = "selected";} else {$sem2 = "";}
										if($row["sem"] == '3') {$sem3 = "selected";} else {$sem3 = "";}
										if($row["sem"] == '4') {$sem4 = "selected";} else {$sem4 = "";}
										if($row["sem"] == '5') {$sem5 = "selected";} else {$sem5 = "";}
										if($row["sem"] == '6') {$sem6 = "selected";} else {$sem6 = "";}
										if($row["sem"] == 'w') {$semw = "selected";} else {$semw = "";}
										if($row["sem"] == 's') {$sems = "selected";} else {$sems = "";}
										if($row["sem"] == 'other') {$semother = "selected";} else {$semother = "";}
										$size = round(intval($row["size"])/1024,1);
										echo "<div class='altklausur' id='altklausur_".$row["id"]."'><div id='".$row["id"]."' class='altklausur_name' onclick='make_editable_user_upload(this.id)' title='Namen von \"".$row["name"]."\" bearbeiten'>".$row["name"]."</div><span class='altklausur_delete' id='del_".$row["id"]."' onclick='delete_altklausur_user_upload(this.id);'><img src='../icons/error.png' height='25px' title='\"".$row["name"]."\" löschen'></span><a href='/altklausuren/user_upload/".$row["filename"]."' target='_blank'><span class='altklausur_link' title='\"".$row["name"]."\" in neuem Tab öffnen'></span></a><span class='altklausur_size'>$size KB</span><br/>
										<span class='user_upload_help'><span class='suggested'>
											<select name='semester' id='semester_".$row["id"]."' onchange='getfach_user_upload(".$row["id"].");' autofocus='autofocus' tabindex='1'>
												<option value='1' $sem1>1. FS B. Sc.</option>
												<option value='2' $sem2>2. FS B. Sc.</option>
												<option value='3' $sem3>3. FS B. Sc.</option>
												<option value='4' $sem4>4. FS B. Sc.</option>
												<option value='5' $sem5>5. FS B. Sc.</option>
												<option value='6' $sem6>6. FS B. Sc.</option>
												<option value='w' $semw>WS M. Sc.</option>
												<option value='s' $sems>SS M. Sc.</option>
												<option value='other' disabled  $semother>anderes</option>
											</select>
											<select name='fach' id='fach_".$row["id"]."' disabled='disabled' onload='getfach_user_upload();' tabindex='2'>
											</select>
											<script type='text/javascript'>getfach_user_upload('".$row["id"]."'); suggested_fach[".$row["id"]."] = '".$row["fach"]."';</script>
											</span><span class='user_upload_comment' title='Userbeschreibung: \n\"".$row["comment"]."\"'></span><input type='button' class='move_user_upload_button' value='Verschieben' id='move_".$row["id"]."' onclick='move_user_upload(this.id);'></span></div>";
									}
								}
							}
						break;
					case 'faecher': //HERE
							if($_SERVER["REMOTE_USER"] == "FSRChemie")
							{
								 $bsc_faecher[1] = mysql_query("SELECT * FROM fach WHERE `sem` = '1' ORDER BY `name`");
								 $bsc_faecher[2] = mysql_query("SELECT * FROM fach WHERE `sem` = '2' ORDER BY `name`");
								 $bsc_faecher[3] = mysql_query("SELECT * FROM fach WHERE `sem` = '3' ORDER BY `name`");
								 $bsc_faecher[4] = mysql_query("SELECT * FROM fach WHERE `sem` = '4' ORDER BY `name`");
								 $bsc_faecher[5] = mysql_query("SELECT * FROM fach WHERE `sem` = '5' ORDER BY `name`");
								 $bsc_faecher[6] = mysql_query("SELECT * FROM fach WHERE `sem` = '6' ORDER BY `name`");
								 for($i = 1; $i <= 6; $i++)
								 {
									echo "<div class='topnav'>$i. FS B. Sc. Chemie</div>
											<div class='faecher_sem' id='faecher_sem_".$i."'>";
									while($row = mysql_fetch_array($bsc_faecher[$i]))
									{
										echo "<div class='altklausur fach' id='fach_".$row["ID"]."'><div id='fach_text_".$row["ID"]."' class='altklausur_name' onclick='make_editable_faecher(this.id);' title='Namen von \"".$row["name"]."\" bearbeiten'>".$row["name"]."</div><span class='altklausur_delete' id='del_".$row["ID"]."' onclick='delete_fach(this.id);'><img src='../icons/error.png' height='25px' title='\"".$row["name"]."\" löschen'></span></div>";                         	
									}
									echo "<div class='altklausur fach_new'><input type='text' id='new_fach_".$i."' name='new_fach_".$i."' class='altklausur_input new' placeholder='neues Fach' onfocus='this.addEventListener(\"keypress\", function(e){if(e.keyCode == 13) { new_fach(\"".$i."\"); } }, false);'><span class='altklausur_delete' onclick='new_fach(\"".$i."\");'><img src='../icons/upload.png' height='25px' style='margin-top:2px;' title='Fach hinzufügen [Enter]'></div>";
									echo "</div>";
									unset($row);
								 } 
								 $msc_faecher[1] = mysql_query("SELECT * FROM fach WHERE `sem` = 'w' ORDER BY `name`");
								 $msc_faecher[2] = mysql_query("SELECT * FROM fach WHERE `sem` = 's' ORDER BY `name`");
								echo "<div class='topnav master'>WS M. Sc. Chemie</div>
										<div class='faecher_sem' id='faecher_sem_w'>";
								while($row = mysql_fetch_array($msc_faecher[1]))
								{
									echo "<div class='altklausur fach' id='fach_".$row["ID"]."'><div id='fach_text_".$row["ID"]."' class='altklausur_name' onclick='make_editable_faecher(this.id);' title='Namen von \"".$row["name"]."\" bearbeiten'>".$row["name"]."</div><span class='altklausur_delete' id='del_".$row["ID"]."' onclick='delete_fach(this.id);'><img src='../icons/error.png' height='25px' title='\"".$row["name"]."\" löschen'></span></div>";                         	
								}
								echo "<div class='altklausur fach_new'><input type='text' id='new_fach_w' name='new_fach_w' class='altklausur_input new' placeholder='neues Fach' onfocus='this.addEventListener(\"keypress\", function(e){if(e.keyCode == 13) { new_fach(\"w\"); } }, false);'><span class='altklausur_delete' onclick='new_fach(\"w\");'><img src='../icons/upload.png' height='25px' style='margin-top:2px;' title='Fach hinzufügen [Enter]'></div>";
								echo "</div>";
								unset($row);   
										echo "<div class='topnav master'>SS M. Sc. Chemie</div>
										<div class='faecher_sem' id='faecher_sem_s'>";
								while($row = mysql_fetch_array($msc_faecher[2]))
								{
									echo "<div class='altklausur fach' id='fach_".$row["ID"]."'><div id='fach_text_".$row["ID"]."' class='altklausur_name' onclick='make_editable_faecher(this.id);' title='Namen von \"".$row["name"]."\" bearbeiten'>".$row["name"]."</div><span class='altklausur_delete' id='del_".$row["ID"]."' onclick='delete_fach(this.id);'><img src='../icons/error.png' height='25px' title='\"".$row["name"]."\" löschen'></span></div>";                        	
								}
								echo "<div class='altklausur fach_new'><input type='text' id='new_fach_s' name='new_fach_s' class='altklausur_input new' placeholder='neues Fach' onfocus='this.addEventListener(\"keypress\", function(e){if(e.keyCode == 13) { new_fach(\"s\"); } }, false);'><span class='altklausur_delete' onclick='new_fach(\"s\");'><img src='../icons/upload.png' height='25px' style='margin-top:2px;' title='Fach hinzufügen [Enter]'></div>";
								echo "</div>";
								unset($row); 
								echo "<script type='text/javascript'>$(\".faecher_sem\").sortable({ connectWith:\".faecher_sem\", receive: function(event, ui) {save_faecher(event,ui,this.id);}, items:'.fach:not(.fach_new)', axis:'y', dropOnEmpty:false, distance: 10, tolerance: 'intersect;'});</script>"; 
							}
						break;
					case 'klausurtermine': 
							if($_SERVER["REMOTE_USER"] == "FSRChemie")
							{
								if($_POST["new_klausurtermin"])
								{
									if($_POST["fach"] != '0')
									{
										if($_POST["klausurtermin_h"] <= 9 && strlen($_POST["klausurtermin_h"]) < 2)
										{
											$time = '0'; 
											$time .= $_POST["klausurtermin_h"];
											$time .= ':';
										}
										else
										{
											$time = $_POST["klausurtermin_h"];
											$time .= ':';
										}
										if($_POST["klausurtermin_m"] <= 9 && strlen($_POST["klausurtermin_m"]) < 2)
										{
											$time .= '0'; 
											$time .= $_POST["klausurtermin_m"];
										}
										else
										{
											$time .= $_POST["klausurtermin_m"];
										}
										if($_POST["klausurtermin_nk"] == true)
										{
											$nk = '1';
										}
										else
										{
											$nk = '0';
										}
										if(mysql_query("INSERT INTO `klausurtermine` (fach, date, time, ort, nk) VALUES ('".$_POST["klausurtermin_fach"]."', '".$_POST["klausurtermin_d"]."', '".$time."', '".$_POST["klausurtermin_ort"]."', '".$nk."')"))
										{
											echo "<div class='altklausur'>Der Termin wurde erfolgreich eingetragen.</div>";
										}
										else
										{
											echo "<div class='altklausur error'>Der Termin konnte nicht eingetragen werden.</div>";	
										}
									}
									else
									{
										echo "<div class='altklausur error'>Bitte Fach angeben <a href='#' onclick='history.back();'>Zurück</a></div>";
									}
								}
								echo "<form action='index.php?action=klausurtermine' method='post' target='_self'>Fach: <select name='klausurtermin_fach'>";
									echo "<option disabled='true' selected='true'>--- 1. FS B.SC. Chemie ---</option>";
									$query = mysql_query("SELECT * FROM fach WHERE `sem` = '1' AND `stuga` = 'bsc'");
									while($row = mysql_fetch_array($query))
									{
										echo "<option value='".$row["ID"]."'>".$row["name"]."</option>";	
									}
									echo "<option disabled='true'>--- 2. FS B.SC. Chemie ---</option>";
									$query = mysql_query("SELECT * FROM fach WHERE `sem` = '2' AND `stuga` = 'bsc'");
									while($row = mysql_fetch_array($query))
									{
										echo "<option value='".$row["ID"]."'>".$row["name"]."</option>";	
									}
									echo "<option disabled='true'>--- 3. FS B.SC. Chemie ---</option>";
									$query = mysql_query("SELECT * FROM fach WHERE `sem` = '3' AND `stuga` = 'bsc'");
									while($row = mysql_fetch_array($query))
									{
										echo "<option value='".$row["ID"]."'>".$row["name"]."</option>";	
									}
									echo "<option disabled='true'>--- 4. FS B.SC. Chemie ---</option>";
									$query = mysql_query("SELECT * FROM fach WHERE `sem` = '4' AND `stuga` = 'bsc'");
									while($row = mysql_fetch_array($query))
									{
										echo "<option value='".$row["ID"]."'>".$row["name"]."</option>";	
									}
									echo "<option disabled='true'>--- 5. FS B.SC. Chemie ---</option>";
									$query = mysql_query("SELECT * FROM fach WHERE `sem` = '5' AND `stuga` = 'bsc'");
									while($row = mysql_fetch_array($query))
									{
										echo "<option value='".$row["ID"]."'>".$row["name"]."</option>";	
									}
									echo "<option disabled='true'>--- 6. FS B.SC. Chemie ---</option>";
									$query = mysql_query("SELECT * FROM fach WHERE `sem` = '6' AND `stuga` = 'bsc'");
									while($row = mysql_fetch_array($query))
									{
										echo "<option value='".$row["ID"]."'>".$row["name"]."</option>";	
									}
									echo "<option disabled='true'>--- WS M.SC. Chemie ---</option>";
									$query = mysql_query("SELECT * FROM fach WHERE `sem` = 'w' AND `stuga` = 'msc'");
									while($row = mysql_fetch_array($query))
									{
										echo "<option value='".$row["ID"]."'>".$row["name"]."</option>";	
									}
									echo "<option disabled='true'>--- SS M.SC. Chemie ---</option>";
									$query = mysql_query("SELECT * FROM fach WHERE `sem` = 's' AND `stuga` = 'msc'");
									while($row = mysql_fetch_array($query))
									{
										echo "<option value='".$row["ID"]."'>".$row["name"]."</option>";	
									}
								echo "</select><br><br>";
								echo "<span style='float:left;'>Datum:  <div id='datepicker'></div><input type='hidden' id='klausurtermin_d' name='klausurtermin_d' maxlength='10'></span>";
								echo "<span style='float:left; padding-left:10px;'>Uhrzeit:<br><input type='number' name='klausurtermin_h' min='0' max='23' step='1' value='0'>:<input type='number' name='klausurtermin_m' min='0' max='59' step='1' value='0'><br><br>";
								echo "Räume:<br><textarea name='klausurtermin_ort' rows='3' style='width:100%;'></textarea><br><br>";
								echo "Nachklausur? <input type='checkbox' name='klausurtermin_nk'></span>";
								echo "<input type='submit' class='rechtskunde_button' name='new_klausurtermin' value='Eintragen' style='margin-top:100px;'></form>";
								echo "<script type='text/javascript'> $('#datepicker').datepicker({ altField: '#klausurtermin_d', altFormat:'@', numberOfMonths: 2, firstDay: 1, minDate: '+1d' });
									$('#datepicker table a').removeClass('ui-state-active ui-state-hover');</script>";
							}
						break;
					case 'rechtskunde':
							if($_POST["new_rechtskunde"]) 
							{
								if($_POST["a_loes"] == true)
								{$a_loes = '1';} else {$a_loes = '0';}
								if($_POST["b_loes"] == true)
								{$b_loes = '1';} else {$b_loes = '0';}
								if($_POST["c_loes"] == true)
								{$c_loes = '1';} else {$c_loes = '0';}
								if($_POST["d_loes"] == true)
								{$d_loes = '1';} else {$d_loes = '0';}
								if($_POST["biozid"] == true)
								{$biozid = '1';} else {$biozid = '0';}
								if(mysql_query("INSERT INTO `rechtskunde`(`gfk`, `nr`, `frage_nr`, `frage`, `a`, `b`, `c`, `d`, `a_loes`, `b_loes`, `c_loes`, `d_loes`, `biozid`) VALUES ('I','".$_POST["nr"]."','".$_POST["frage_nr"]."','".$_POST["frage"]."','".$_POST["a"]."','".$_POST["b"]."','".$_POST["c"]."','".$_POST["d"]."',$a_loes,$b_loes,$c_loes,$d_loes,$biozid)"))
								{
									echo "<div class='altklausur'>Die Frage wurde erfolgreich hinzugefügt.</div>";
								}
								else
								{
									echo "<div class='altklausur error'>Die Frage konnte nicht hinzugefügt werden.</div>";
								}
							}
							if($_POST["nr"] == '1')
							{$nr_1 = "selected='selected'";} else {$nr_1 = "";}
							if($_POST["nr"] == '2')
							{$nr_2 = "selected='selected'";} else {$nr_2 = "";}
							if($_POST["nr"] == '3')
							{$nr_3 = "selected='selected'";} else {$nr_3 = "";}
							if($_POST["nr"] == '4')
							{$nr_4 = "selected='selected'";} else {$nr_4 = "";}
							if($_POST["nr"] == '5')
							{$nr_5 = "selected='selected'";} else {$nr_5 = "";}
							if($_POST["nr"] == '6')
							{$nr_6 = "selected='selected'";} else {$nr_6 = "";}
							if($_POST["nr"] == '7')
							{$nr_7 = "selected='selected'";} else {$nr_7 = "";}
							if($_POST["nr"] == '8')
							{$nr_8 = "selected='selected'";} else {$nr_8 = "";}
							if($_POST["nr"] == '9')
							{$nr_9 = "selected='selected'";} else {$nr_9 = "";}
							if($_POST["frage_nr"])
							{$nxt_nr = $_POST["frage_nr"]+1;} else {$nxt_nr = '1';}
							echo "<font color='red' size='3'>Bei falschen Einträgen bitte eine E-Mail mit der Nummer der Frage und dem Fehler <a href='mailto:oliver.schoenefeld@me.com?subject=Fehler in Rechtskunde-Frage GFK I #####'>senden</a>.<br/><form action='index.php?action=rechtskunde' method='post' target='_self'></font><br><br>
									Frage Nr.: GFK I 
									<select name='nr'>
										<option $nr_1>1</option>
										<option $nr_2>2</option>
										<option $nr_3>3</option>
										<option $nr_4>4</option>
										<option $nr_5>5</option>
										<option $nr_6>6</option>
										<option $nr_7>7</option>
										<option $nr_8>8</option>
										<option $nr_9>9</option>
									</select> 
									<input type='number' name='frage_nr' min='1' value='$nxt_nr' max='90' style='width:40px;'><br>
									<textarea name='frage' style='width:100%; height:50px; margin-top:10px; margin-bottom:10px;' placeholder='Frage' required tabindex=1></textarea><br>
									<input type='checkbox' name='a_loes' style='top:-13px; position:relative;' tabindex=6> <textarea name='a' style='width:300px; height:30px;' placeholder='Antwort a' required tabindex=2></textarea><br>
									<input type='checkbox' name='b_loes' style='top:-13px; position:relative;' tabindex=7> <textarea name='b' style='width:300px; height:30px;' placeholder='Antwort b' required tabindex=3></textarea><br>
									<input type='checkbox' name='c_loes' style='top:-13px; position:relative;' tabindex=8> <textarea name='c' style='width:300px; height:30px;' placeholder='Antwort c' required tabindex=4></textarea><br>
									<input type='checkbox' name='d_loes' style='top:-13px; position:relative;' tabindex=9> <textarea name='d' style='width:300px; height:30px;' placeholder='Antwort d' required tabindex=5></textarea><br><br>
									<input type='checkbox' name='biozid' style='position:relative;'  tabindex=10> Biozid-Frage<br><br>
									<input type='submit' name='new_rechtskunde' value='Eintragen'> <input type='reset'>
								</form>";
						break;
					case 'stats':
							if($_SERVER["REMOTE_USER"] == "FSRChemie")
							{
								echo "<iframe id='stats' src='/usage/index.html' height='800px' width='700px' onload='setcss();' frameborder='0'></iframe>";
							}
						break;
					default: 
							if($_POST["new_shoutbox"])
							{
								if($_POST["shoutbox_text"])
								{
									if(mysql_query("INSERT INTO `shoutbox` (date, text) VALUES ('".time()."', '".$_POST["shoutbox_text"]."')"))
										{
											echo "<div class='altklausur'>Du hast erfolgreich geshoutet.</div>";
										}
										else
										{
											echo "<div class='altklausur error'>Leider war deine Stimme zu leise. Bitte versuche erneut zu shouten.</div>";	
										}
								}
								else
								{
									echo "<div class='altklausur error'>Bitte gib einen Text ein!</div>";	
								}
							}
							if($_SERVER["REMOTE_USER"] == "FSRChemie")
							{
							echo "<form action='index.php' method='post'>
									<textarea rows='5' cols='50' name='shoutbox_text' style='margin-left:350px;'></textarea><br/>
									<input type='submit' name='new_shoutbox' value='Shout!' class='rechtskunde_button'>
								</form>"; 
							}
						break;
				}
			?>
		</div>     

        <div style="clear: both;">&nbsp;</div>
        

<!-- end page -->
      
</div>
<!-- end wrapper-->

<div id="footer" class='container_12'>
        <p class="copyright">&copy;&nbsp;&nbsp;2013 Chemie Fundgrube &nbsp;&bull;&nbsp; <a href="mailto:fsrchemie@uni-leipzig.de">Mail</a></p>
</div>


</body>
</html>