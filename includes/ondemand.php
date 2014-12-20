<?
include_once "db.php";
include "load_channel.php";

$_GET['w']=$chn['player_width'];
$_GET['h']=$chn['player_height'];
$_GET['l']=$chn['player_lang'];

//load media
$sel = "select * from nkm_media where id='{$_GET['v']}'";
$result = mysql_query($sel);
if (!$result) {echo mysql_error().$sel;exit;}
$video=mysql_fetch_array($result);
if ($video['channel']=="."||$video['channel']==".."||$video['channel']=="thumb") die ("No videos");

if ($url=="") $url = "http://www.experimentaltv.org/mediabase/".$video['channel']."/";

// count views
$video['views']=$video['views']+1;
$sel = "update nkm_media set views='".$video['views']."' WHERE id='{$_GET['v']}'";
$result = mysql_query($sel);
if (!$result) {echo mysql_error().$sel;exit;}

/*function reemplaza_param($str,$param) {
	$p1 = substr($str,0,strpos($param,$str)+strlen($param)+2);
	$p2 = substr($str,strrpos(
}*/

//show player
echo "<div id=\"experimentaltv_player\">";

if ($video['platform']=="embed") {
//	echo str_replace("width  	$chn['player_height']
	echo $video['file'];
} else if ($chn['main_player_type']=="HTML5"||$video['platform']=="url") { 
	// HTML5
	if ($video['platform']=="url") $url_video=$video['file'];
	else $url_video="http://www.experimentaltv.org/mediabase/".$_GET['u']."/".$video['file'];

	include "lib/players/html5/player.php";
} else { 
	// ITHEORA

if ($_GET['v']=="") $_GET['v']=$first;
?><iframe src="/lib/players/itheora/index.php?l=<?=$chn['player_lang']?>&v=<?=$url?><?=$video['file']?>&amp;w=<?=$_GET['w']?>&amp;h=<?=$_GET['h']?>&amp;t=5&amp;n=<?=$_SESSION['username']?> mediabase&amp;s=<?=$chn['player_type']?>&amp;p=<?=$chn['standby_pic']?>&amp;d=<?=$_GET['d']?>" style="width:<?=$_GET['w']?>px; height:<?=$_GET['h']?>px;" allowtransparency="true" frameborder="0"></iframe>

<div style='color:#<?=$chn['font_color']?>'>
<b><?=strip_tags($chn['lowtext1_mb'],"span")?></b>
<br>playing on demand <?=$video['title']?><br><br><?=strip_tags($video['description'],"span")?></b>
<? $url="http://www.experimentaltv.org/mediabase/".$_GET['u']."/".$_GET['v']; ?>
<a href="<?=$url?>"><?=$url?></a>
</div>
<?
} // ELSE
/* $('#ondemand_player').load("/includes/ondemand.php?l=<?=$chn['player_lang']?>&v="+v+"&w=<?=$chn['player_width']?>&h=<?=$chn['player_height']?>&u=<?=$_GET['u']?>&d="+d);
*/
echo "</div>"; //player
?>
