<?
require "auth.php";
include "../includes/db.php";
include "../includes/functions.php";
include "../includes/headers.php";

function getDBFields($id) {
	if ($id=="") $select="select * from nkm_media limit 1"; else $select="select * from nkm_media where channel='{$_SESSION['username']}' and id='{$id}'";
        $result=mysql_query($select);
        $fields=Array();
        $i=0;
        while ($i < mysql_num_fields($result)) {
            $meta = mysql_fetch_field($result, $i);
            array_push($fields,$meta->name);
            $i++;
        }
        mysql_free_result($result);
	return $fields;
}

?>
<body>
<?include "../includes/top.php";?>

<center>
<div style="background-color:#fff;width:900px;margin-top:10px;padding:10px">
<h1><?=$_SESSION['username']?> Media</h1>
<?
 include "tiny_menu.php";

?>
<input style="margin-left:10px;float:left" type="button" value="Add" onclick="document.location='http://<?=$_SERVER['HTTP_HOST']?>/admin/media.php?_=i'"><br><br><br>
<?
if ($_GET['_']=="d") {
	message("video deleted successfuly.");
	$query="delete from nkm_media where id=".$_GET['id'];
	$result=mysql_query($query);
	if (!$result) echo "error:".mysql_error($result); else   include "media_browser.php";

} else if ($_GET['_']=="e") {
	include "media_editor.php";
} else if ($_GET['_']=="i") {
        include "media_editor.php";

} else if ($_POST['action']=="save") {
	$fields=getDBFields($_GET['id']);
	if ($_POST['platform']=="embed") $_POST['format']="embed";
	for ($i=0;$i<count($fields);$i++) {
		$str.="`".$fields[$i]."`=\"".mysql_escape_string($_POST[$fields[$i]])."\",";
	}	
	
	$str=substr($str,0,strlen($str)-1);
	$update = "UPDATE nkm_media SET {$str} where id=".$_POST['id'];
	$result=mysql_query($update);
	if (!$result) echo "error:".mysql_error($result)."<br>".$update; else   include "media_browser.php";
} else if ($_POST['action']=="insert") {
        $dbfields=getDBFields();
	$_POST['creation_date']=date('Y-m-d H:i:s');
	$_POST['channel']=$_SESSION['username'];
	if ($_POST['platform']=="url") $_POST['format']=substr($_POST['file'],strrpos($_POST['file'],".")+1);
	else if ($_POST['platform']=="embed") $_POST['format']="embed";
        for ($i=0;$i<count($dbfields);$i++) {
		$fields.="`".$dbfields[$i]."`,";
		$values.="\"".mysql_escape_string($_POST[$dbfields[$i]])."\",";
        }
	$fields=substr($fields,0,strlen($fields)-1);
	$values=substr($values,0,strlen($values)-1);
        $insert = "INSERT INTO nkm_media ({$fields}) VALUES ({$values})";
        $result=mysql_query($insert);
	if (!$result) echo mysql_error($result);
	echo "<br>New media has been inserted successfuly.<br><br>";
} else {
  include "media_browser.php";

}

include "foot.php"; ?>
<br><br></div></center></body>
