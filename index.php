<?
/*******************************
   Experimental.TV project

/*******************************/

// iniciem sessio 
session_start();
// set mediabase path
$base_path = getcwd(); 
$dir =  $base_path."/mediabase/".$_GET['u'];
$url = "http://".$_SERVER['HTTP_HOST']."/mediabase/".$_GET['u']."/";
// connexio a base de dades

require "includes/db.php";
// llibreries ssh per connectar amb el sistema
require "includes/ssh2.php";
include "includes/headers.php";
if (!isset($_GET['u'])) { 
	//home
	if ($_GET['p']=="") $_GET['p']="active-channels";
	include "includes/top_home.php";
	include "includes/menu_home.php";
	include "includes/footer.php";
	exit;
}

include "includes/load_channel.php";
$_SESSION['opentvid'] = $_GET['u'];
// headers de la pagina
include "includes/headers.php";
$pagewidth=900;

if ($_GET['s']=="index.php"||$_GET['s']=="") {
	if ($chn['start_page']=="") $chn['start_page']="mediabase";
	$_GET['s']=$chn['start_page'];
}
?>

<? if ($chn['background_conf']=="Picture")  $fons="background=\"".$chn['background_pic']."\""; ?>

<body>
<?
$chatwidth = "";
?>
<? // ------------- top ----------------- ?>
<? 
include "includes/headers.php";

include "includes/top.php"; 
include "includes/streamtop.php";
include "includes/menu.php";

?>
<? //--------------- page ----------------?>
<div class="page" id="contents">
<? 
include "includes/".$_GET['s'].".php"; 
?>
</div>
<script language="javascript">
function golive() {
document.getElementById('mediaChat').src = "/lib/xat/?u=<?=$_GET['u']?>";
}

function startproducer() {
 document.getElementById('mediaChat').src = "/producer.php?u=<?=$_GET['u']?>";
  //admin/playerconf.php
 <? $htm= "<table width=95%><tr><td>Emision is offline : <a href=\'#\'><b>GO LIVE</b></a></td><td align=\'right\'>Online users: 0</td></tr></table><br>"; ?>
 $('#botvideo').html("<?=$htm?>");
}

function startmediabase() {
  document.getElementById('mediaChat').src = "/mediabase.php?u=<?=$_GET['u']?>";
}

function startabout() {
  document.getElementById('mediaChat').src = "/about.php?u=<?=$_GET['u']?>";
}

</script>


</td></tr>
</table>
</div>
</td></tr></table>
<? include "includes/footer.php"; ?>
</div>
</body>
</html>
