<?
$sel="select * from nkm_channels where status='online'";
$result=mysql_query($sel);
include "list-channels.php";
?>
