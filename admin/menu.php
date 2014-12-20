<?
include "auth.php";
include "../includes/headers.php";
?>
<body>
<?include "../includes/top.php";?>
<center>
<div style="background-color:#fff;width:900px;margin-top:10px">
<br><center><h1><?=$_SESSION['username']?> administration interface</h1>
<h3><?=$title?></h3>
<br><b><table border="0'" cellpadding="5"><tr><td>You are logged as <?=$_SESSION['username']?></td></tr></table></b>
<br><br><table width="300"><tr><td><ul>
<li><a href="setup.php"><?=_SETUP_?></a><br></li>
<? /*<li><a href="channelconf.php"><?=_CHANNELCONF_?></a><br></li> */?>
<li><a href="media.php"><?=_MEDIABASE_?></a><br></li>
<li><a href="http://<?=$_SERVER['HTTP_HOST']?>/<?=$_SESSION['username']?>">Go to channel <?=$_SESSION['username']?></a></li></ul>
</td></tr></table>
<? 
include "foot.php";
?>
<br><br><br></div></center></body>
