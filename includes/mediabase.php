<?
include "db.php";

function notexists($file) {
	$sel = "SELECT file FROM views_clips WHERE file='".$file."'";
	$res = mysql_query($sel);
	$rows = 0;
	while($row = mysql_fetch_array($res)) { 
		 $rows++;
	}
	if ($rows==0) return true; else return false;
}
?>

<table width="<?=$pagewidth?>" border="0" bgcolor="<?=$chn['background_page_color']?>" cellspacing="0" cellpadding="0">
<tr>
<? if ($chn['background_page_color']!="") $sty="padding-left:0px"; else $sty="padding:0px";?>
<td colspan=2 style="<?=$sty?>"><b><div style="padding-bottom:5px"><span style="color:#<?=$chn['font_color']?>"><?=$chn['uptext_mb']?>
</span></div></b></td>
</tr>
<tr>
<td valign="top" width="<?=$chn['player_width']?>" style="<?=$sty?>;padding:0px">
<div id="ondemand_player" style="display:table">
<? 
ob_flush();
flush();
// pre-process videos  
$flog=fopen($base_path."/log/nkmedia.log","a");
fwrite($flog,"\n\nReading media from media directory...\n");
if ($dh = opendir($dir)) {
$i=0;$max=1500;
while (($file = readdir($dh)) !== false&&$i<$max) {
        if ($file!="."&&$file!=".."&&$file!="thumb"&&$file!='metadata'&&$file!='mediabase.log'&&$file!='fail') {
	if (filesize($dir."/".$file)==0) fwrite($flog,"Error processing file ".$file." (file is empty)\n");
        if (!file_exists($dir.'/thumb/'.$file.'.png')&&filesize($dir."/".$file)>0) {

	fwrite($flog,"Processing: ".$file."...");
        $ext=substr($file,strrpos($file,'.')+1);
        ob_start();
	$cmd="ffmpeg -i \"".$dir."/".mysql_real_escape_string($file)."\" 2>&1";
	if (strpos($dir."/".$file," ")) {
		fwrite($flog, " ERROR: Filename can not contain blank spaces. Thumb can not be created\n");
	} else {
	        $res=exec_cmd($cmd,"dkd8de8d8edewWeuDh323jd");
	        $duration = ob_get_contents();
	        ob_end_clean();
	        preg_match('/Duration: (.*?),/', $duration, $matches);
	        $duration = $matches[1];
	//      $duration_array = split(':', $duration);
	//      $duration = $duration_array[0] * 3600 + $duration_array[1] * 60 + $duration_array[2];
	//      $time = $duration * $percent / 100;
	//      $time = intval($time/3600) . ":" . intval(($time-(intval($time/3600)*3600))/60) . ":" . sprintf("%01.3f", ($time-(intval($time/60)*60)));
	        if (!file_exists($dir.'/thumb/'.$file.'.png')) {
		        $instruccio='mkdir -p '.$dir.'/thumb/';
		        exec_cmd($instruccio,"dkd8de8d8edewWeuDh323jd");
		        $instruccio='chmod 777 -R '.$dir.'/thumb/';
		        exec_cmd($instruccio,"dkd8de8d8edewWeuDh323jd");
		        $instruccio='ffmpeg -y -itsoffset -10 -i '.$dir.'/'.$file.' -vcodec mjpeg -vframes 1 -an -f rawvideo -s 360x288 '.$dir.'/thumb/'.$file.'.png';
		        exec_cmd($instruccio,"dkd8de8d8edewWeuDh323jd");
		
		        if (file_exists($dir.'/thumb/'.$file.'.png')) {
		                $insert = "INSERT INTO nkm_media (creation_date,status,thumbnail,title,file,platform,duration,channel,format) VALUES ('".date('Y-m-d H:m:i')."','active','/mediabase/{$_GET['u']}/thumb/{$file}.png','{$file}','{$file}','local','{$duration}','{$_GET['u']}','{$ext}')";
		                $result = mysql_query($insert);
		                if (!$result) {echo mysql_error().$insert;exit;}
				fwrite($flog,"OK\n");
		        } else {
				fwrite($flog,"Thumb can not be created. Moving file to invalid/\n");
				$instruccio='mkdir -p '.$dir.'/invalid/';
				exec_cmd($instruccio,"dkd8de8d8edewWeuDh323jd");
	                        $instruccio='chmod 777 -R '.$dir.'/invalid/';
           	                exec_cmd($instruccio,"dkd8de8d8edewWeuDh323jd");
				$instruccio='mv '.$dir.'/'.$file.' '.$dir.'/invalid/';
	                        exec_cmd($instruccio,"dkd8de8d8edewWeuDh323jd");
			}
		}

       	}
        } // if is file

        $fecha = date ("Y-m-d", filectime($dir."/".$file));
        $i++;
	ob_flush();
	flush();
	}
} // while
fclose($flog);

//ja tenim first, podem cridar ondemand
include "ondemand.php";?>
</div>
</td>

<td  valign="top" style="padding:0px;">
<?
include "lib/loadMetadata.php";
$flog=fopen($base_path."/log/nkmedia.log","a");
fwrite($flog,"\n\nReading media from database...\n");
function maketanom($s) {
	$s=str_replace('.ogg','',$s);
	$s=str_replace('_',' ',$s);
	return $s;
}
$array_videos = array();
$namesarr = array();
echo "<div id=\"mediabase_clips\" class=\"box\" style='background-color:".$chn['background_playlist_color']."'>";
$i=0;
$orderby="creation_date desc";
if ($chn['order_videos']=="ORDERBY"||$chn['order_videos']=="creation date") $orderby="creation_date desc"; 
else if ($chn['order_videos']=="predefined order") $orderby="order_number";
else if ($chn['order_videos']=="title") $orderby="title";
else if ($chn['order_videos']=="most viewed") $orderby="views";

$sel = "select * from nkm_media where status='active' and channel='{$_GET['u']}' order by ".$orderby;
$result = mysql_query($sel);
if (!$result) {echo mysql_error().$sel;exit;}
$first="";
while ($video=mysql_fetch_array($result)) {
if ($first=="") $first=$video['id'];
if ($video['description']!="") $video['description']="<div style='color:#".$chn['font_color'].";padding-top:3px'>".$video['description']."</div>";
if ($video['creation_date']=="0000-00-00 00:00:00") $date=""; else $date=date('d-m-Y',strtotime($video['creation_date']));
$time="<div style='font-size:9px;color:#".$chn['font_color'].";padding-top:3px'>".substr($video['duration'],0,8)." &middot; ".$date." &middot; ".$video['views']." views</div>";
$furl = $dir.'/thumb/'.$video['file'].'.png';
$url = '/mediabase/'.$_GET['u'];
        if (!file_exists($dir."/".$video['file'])) {
                fwrite($flog,"File ".$dir."/".$video['file']." not found: updated status to inactive\n");
                $update="UPDATE nkm_media set status='inactive' where file=\"".$video['file']."\"";
		fwrite($flog,$update."\n");
                $res_update = mysql_query($update);
	}
	if (file_exists($furl)&&filesize($furl)>0) $img="<img width=80 height=60 src='".$url."/thumb/".$video['file'].".png' border=0 alt='NO THUMB' title=''>"; 
	else if (substr($video['thumbnail'],0,4)=="http") $img="<img width=80 height=60 src='".$video['thumbnail']."'>";
	else $img="<img width=80 height=60 src='/lib/players/itheora/skins/tango/null.jpg'>";

	$vidarr = array ($file=>"<div style='padding:0px;border:0px solid #".$chn['font_color'].";background-color:transparent;width:94%;float:left;margin:3px'><table width=100%><tr><td width=80><a href='#' onclick='playvideo(\"".$video['id']."\",\"m\")'>{$img}</a></td><td valign=top style='vertical-align:top;padding-top:5px;text-align:left'><a href='#' onclick='playvideo(\"".$video['id']."\",\"m\")' style='text-align:left'><b>".$video['title']."</b></a>".$video['description']."<div style='padding-top:0px'>".$time."</div></td></tr></table></div>");
	array_push ($namesarr,$file);
	array_push ($array_videos,$vidarr);
}

   foreach ($array_videos as $key=>$val){
       echo $val[$namesarr[$i]]."<br><br>";
       $i++;
   }

   if ($i==0) echo "<br><div style='text-align:right;padding-right:10px'><font color='#".$chn['font_color']."'>No videos found in mediabase.</font></div>";
   closedir($dh);
   echo "</div>";

} else {
	chmod ($dir,0777);
	echo "<br><center><font color='#".$chn['font_color']."'>--no videos found in mediabase--<font></center>";
}

fclose($flog);
?>
</td></tr>
</table>
<script language="javascript">
function playvideo(v,d) {
<? if ($chn['main_player_type']=="HTML5") {  ?>
 document.location='/<?=$_GET['u']?>/mediabase/'+v;
<? } else { ?>
if (v==undefined||v=="") {v='<?=$first?>';d='t';}
 $('#ondemand_player').load("/includes/ondemand.php?l=<?=$chn['player_lang']?>&v="+v+"&w=<?=$chn['player_width']?>&h=<?=$chn['player_height']?>&u=<?=$_GET['u']?>&d="+d);
<? } ?>

}
</script>
