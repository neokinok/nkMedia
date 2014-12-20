<?
require "auth.php";
include "../includes/db.php";
include "../includes/headers.php";
?>
<body>
<center>
<?

	$hidden=Array("id","channel");
	if ($_GET['_']=="e") $readonly=Array("weight","duration","views","upload_date","platform","format","file");
        else if ($_GET['_']=="i") $readonly=Array("weight","creation_date","order_number","duration","views","upload_date","format");

	$fields=getDBFields($_GET['id']);

	if ($_GET['_']=="e") {
	$select="select * from nkm_media where channel='{$_SESSION['username']}' and id='{$_GET['id']}'";
	} else if ($_GET['_']=="i") {
	$select="select * from nkm_media limit 1";
	}
	$result=mysql_query($select);
	$row=mysql_fetch_array($result);


        echo "<form method='post' action='media.php' ><table border=1 cellpadding=5 cellspacing=5 style='border:1px solid #aaa'>";


	if ($_GET['_']=="e") {	echo "<input type='hidden' name='action' value='save'>"; } else if ($_GET['_']=="i") { echo "<input type='hidden' name='action' value='insert'>"; }

	foreach ($row as $i => $valor) {   

	  if ($_GET['_']=="i") $valor="";
	  if ($fields[$i]!="") {
	  if (in_array($fields[$i],$hidden)) $type="hidden"; else $type="text";
	  if (in_array($fields[$i],$readonly)) $add=" readonly style='background-color:#eee'"; else $add=""; 
	  if ($_GET['_']=="i"&&in_array($fields[$i],$readonly)) { 
          } else {
	   if ($_GET['_']=="i"&&$fields[$i]=="file") $fields[$i]="url/embed";
	   if ($type!="hidden") echo "<tr><td>".$fields[$i]."</td><td>"; 
	   if ($fields[$i]=="file") { 


		if ($platform=="local") {
	     echo " <object data=\"http://".$_SERVER['HTTP_HOST']."/lib/players/itheora/index.php?v=http://".$_SERVER['HTTP_HOST']."/mediabase/{$_SESSION['username']}/{$valor}&amp;t=5&amp;n= mediabase&amp;d=m\" type=\"application/xhtml+xml\" style=\"width: 400px; height: 300px;\"></object><br> ";
	     echo "<input type=\"hidden\" name=\"file\" value=\"{$valor}\"><a href=\"http://".$_SERVER['HTTP_HOST']."/mediabase/{$_SESSION['username']}/{$valor}\">{$valor}</a>";
		} else if ($platform=="url") {
		echo "<video tabindex=\"0\" style=\"image-fit: fill;\" controls=\"controls\" autobuffer=\"autobuffer\" preload=\"auto\" width=\"400\" height=\"auto\">
<source type=\"video/webm\" width=\"100%\" src=\"{$valor}\">Your browser does not support the video tag. </video>";
		echo "<br><input type=\"text\" size=\"50\" name=\"file\" value=\"{$valor}\"><br><a style=\"font-size:10px\" href=\"{$valor}\">video url</a>";
		} else if ($platform=="embed") {
			echo $valor;
		echo "<br><textarea rows=5 cols=39 name=\"file\">{$valor}</textarea>";
		}



	 } else if ($fields[$i]=="url/embed") {
		echo "<textarea rows=5 cols=39 name=\"file\"></textarea>";
	    } else if ($fields[$i]=='status') { echo "<select name='status'><option value='active' "; if ($valor=="active") echo "selected"; echo ">active</option>";
					      echo "<option value='inactive' "; if ($valor=="inactive") echo "selected"; echo ">inactive</option></select>"; 
	    } else if ($fields[$i]=='platform') { 
						$platform=$valor;
						echo "<select name='platform'>";
////						echo "<option value='local' "; if ($valor=="local") echo "selected"; echo ">local</option>";
                                              echo "<option value='url' "; if ($valor=="url") echo "selected"; echo ">url</option>";
						 echo "<option value='embed' "; if ($valor=="embed") echo "selected"; echo ">embed</option>";
						echo "</select> <span style='color:#000;font-size:10px'>You also can put your videos into /mediabase/{$_SESSION['username']}/ directory</span>";
	    } else if ($fields[$i]=='thumbnail') {
				if ($_GET['_']=="e") echo "<img src='{$valor}' width=100><br><input type=\"text\" size=\"50\" name=\"thumbnail\" value=\"{$valor}\">"; 
				else echo "<input name='thumbnail' value='http://' size=50>";

	
		}  else  echo "<input size=50 type='{$type}' name='{$fields[$i]}' value='{$valor}'{$add}>";
	   if ($type!="hidden") echo "</td></tr>";
	   }
  	 }
	  

	}
	if ($_GET['_']=="e") {
		echo "</table>
		 <br><br><input class='button' type='button' style='margin-left: 0px' value='Cancel' onclick=\"document.location='/admin/media.php'\">
		 <input class='button' type='submit' style='margin-left: 170px' value='Save'>";
		echo "<input class='button' type='button' value='delete this video' style='color:#f00;border:1px solid #f00;float:right;margin-right:185px' onclick=\"location.href='?_=d&id={$row['id']}'\">";
	} else if ($_GET['_']=="i") {
		echo "</table><br><br><input type='submit' style='' value='Insert'>";

	}
	echo "</form><br><br>";
?>
