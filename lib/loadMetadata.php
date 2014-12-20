<?

//read file

include "includes/configuration.php";
include "includes/db.php";
$sel="select * from nkm_media where id=".$_GET['v'];
$res=mysql_query($sel);
$row=mysql_fetch_array($res);
$vid=$row['file'];

if ($_GET['v']!="") {
$vid=substr($vid,0,strlen($vid)-4);
$file=$base_path."/mediabase/".$_GET['u']."/metadata/".$vid.".xml";

$fp=fopen($file,"r");
echo "<div id=\"metadata_index\" class=\"box\" style=\"color:#000\"><h3>Metadata Index</h3><ul class='index'>";
if ($fp) { 
$data="";while(!feof($fp)) { $data.=fgets($fp); }
fclose($fp);
$media = new SimpleXMLElement($data);
$i=0;
//turn xml into array (need for sorting)
$cp = array(); foreach ($media->cuepoints[0]->cue as $cue) { $cp[] = $cue; }
// sort array by time position
usort ($cp, function($a,$b) { if (intval($a['pos'])<intval($b['pos'])) return 0; else return 1; });
// show cuepoints
for ($j=0;$j<count($cp);$j++) {
		$s=$cp[$j]['pos'];$time=sprintf('%02d:%02d:%02d', ($s/3600),($s/60%60), $s%60);
		echo "<li onclick=\"setCurTime(".$s.")\">".$time." : ".$cp[$j]."</li>";
}
echo "</ul>";
} else {

echo "This video has no metadata, click 'add metadata' to add it.";
}
} 
echo "</div>";
?>

