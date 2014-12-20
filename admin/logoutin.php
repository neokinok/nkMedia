<?
session_start();
$_SESSION['username']="NOVALID";
$_SESSION['password']="NOVALID";
$_SESSION['logged']=false;
$_SESSION['channel']=false;
header ("location: http://".$_SERVER['HTTP_HOST']."/".$_GET['u']."/admin");
?>
