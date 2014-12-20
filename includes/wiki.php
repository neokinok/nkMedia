<div style="padding:10px">
<h2>nkMedia v.1.0</h2>
<ul>
<li><a href="/?p=wiki&f=README">About nkMedia</a></li>
<li><a href="/?p=wiki&f=LICENSE">License</a></li>
<li><a href="/?p=wiki&f=INSTALL">Installation</a></li>
<li><a href="https://github.com/neokinok/nkMedia">Download</a></li>
</ul>
<?
if ($_GET['f']!="") {
$filename=$_GET['f'];
$fp=fopen($filename,"r");
$contents = fread($fp, filesize($filename));
fclose($fp);
echo "<pre style='color:#000'>".$contents."</pre>";

}
?>
</div>
