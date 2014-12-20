<?
$sel="select * from nkm_channels where status='online' and id=89";
$result=mysql_query($sel);
include "list-channels.php";
?>
