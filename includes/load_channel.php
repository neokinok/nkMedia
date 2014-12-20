<?
$sel="select * from nkm_channels where username='{$_GET['u']}'";
$result=mysql_query($sel);
if (!$result) { header('Location: http://www.experimentaltv.org'); } 
$chn=mysql_fetch_array($result);
?>
