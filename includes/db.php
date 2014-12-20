<?
//if (!file_exists('includes/configuration.php')&&!file_exists('configuration.php')) die ('Error: file includes/configuration.php not found');
include "configuration.php";
$link= mysql_connect(DB_HOST, DB_USER, DB_PASS);
if (!$link) die("Error: can't connect to database server ".DB_HOST);
mysql_select_db (DB_NAME,$link);
?>
