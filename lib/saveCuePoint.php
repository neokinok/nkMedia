<?
require "../includes/configuration.php";
require "../includes/db.php";
$sel="select * from nkm_media where id=".$_GET['vid'];
$res=mysql_query($sel);
$row=mysql_fetch_array($res);
$filename=$row['file'];
$filename=substr($filename,0,strlen($filename)-4);
if (!file_exists("/var/www/vhosts/experimentaltv.org/httpdocs/mediabase/".$_GET['chn']."/metadata")) mkdir("/var/www/vhosts/experimentaltv.org/httpdocs/mediabase/".$_GET['chn']."/metadata",777);
$file="/var/www/vhosts/experimentaltv.org/httpdocs/mediabase/".$_GET['chn']."/metadata/".$filename.".xml";
echo $file;
if (file_exists($file)) {
	//APPEND
	$fp=fopen($file,"r");
	$data="";while(!feof($fp)) { $data.=fgets($fp); }
	fclose($fp);
	$fp=fopen($file,"w");
	$data=str_replace("\n\t</cuepoints>","\n\t\t<cue pos=\"".$_GET['p']."\" type=\"".$_GET['type']."\">".$_GET['val']."</cue>\n\t</cuepoints>",$data);
	fwrite($fp,$data);
        fclose($fp);
} else {
	//CREATE
	$fp=fopen($file,"w");
	if ($fp) { 
	$data="<?xml version='1.0' standalone='yes'?>\n<media>\n\t<metadata>";
	$data.="\n\t\t<file>".$_GET['vid']."</file>";
	$data.="\n\t\t<title></title>";
	$data.="\n\t\t<subtitle></subtitle>";
	$data.="\n\t\t<description></description>";
	$data.="\n\t\t<duration></duration>";
	$data.="\n\t\t<author></author>";
	$data.="\n\t\t<tags></tags>";
	$data.="\n\t</metadata>";
	$data.="\n\t<cuepoints>";
	$data.="\n\t\t<cue pos=\"".$_GET['p']."\" type=\"".$_GET['type']."\">".$_GET['val']."</cue>";
	$data.="\n\t</cuepoints>";
	$data.="\n</media>\n";
	fwrite($fp,$data);
	fclose($fp);
	} else {
	echo "error writing $file";
	}
}	
?>
