<?
/***********************************************
  nkMedia v.1
  experimental.tv open source streaming platform

/**********************************************/

session_start();

// set mediabase path
$base_path = getcwd(); 
$dir =  $base_path."/mediabase/".$_GET['u'];
$url = "http://".$_SERVER['HTTP_HOST']."/mediabase/".$_GET['u']."/";

// db connetion
require "includes/db.php";
// ssh libraries
require "includes/ssh2.php";
// headers
include "includes/headers.php";

// initial home page
if (!isset($_GET['u'])) { 
	//home
	if ($_GET['p']=="") $_GET['p']="active-channels";
	include "includes/top_home.php";
	include "includes/menu_home.php";
} else {

	// load channel 
	include "includes/load_channel.php";
	$_SESSION['opentvid'] = $_GET['u'];
	$pagewidth=900;
	$chatwidth="";
	
	// define channel's start page
	if ($_GET['s']=="index.php"||$_GET['s']=="") {
		if ($chn['start_page']=="") $chn['start_page']="mediabase";
		$_GET['s']=$chn['start_page'];
	}
	?>
	
	<? if ($chn['background_conf']=="Picture")  $fons="background=\"".$chn['background_pic']."\""; ?>
	<body>
	<?
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
	<?  include "includes/".$_GET['s'].".php"; ?>
	</div>
	</td></tr>
	</table>
	</div>
	</td></tr></table>
	<? 
}
include "includes/footer.php"; ?>
</div>
</body>
</html>
