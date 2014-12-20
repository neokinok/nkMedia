<?
session_start();
require "auth.php";
header ("location: http://".$_SERVER['HTTP_HOST']."/".$_SESSION['username']);
?>
