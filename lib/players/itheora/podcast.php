<?
include ("admin/config/player.php");
include ("lib/fonctions.php");

$rep=getp('dir');
$ihost = $_SERVER['SERVER_NAME']; // domaine ou se trouve ITheora
$pscript = str_replace("admin/", "", $_SERVER['SCRIPT_NAME']); // chemin vers podcast.php
$iscript = str_replace("podcast", "index", $pscript); // chemin vers podcast.php
$ipath = dirname($iscript).'/';
$document_root=rtrim($_SERVER['DOCUMENT_ROOT'],"/"); // chemin pour les fichier de l'arborescence du serveur

if($rep=="") { $rep=$ipath.'data';}

$dpath = $document_root.'/'.$rep.'/';
$dopen = @opendir($dpath);

while ($file=readdir($dopen)) {
	if (substr($file,0,1)!="." && substr($file, -4, 3)=='.og') {
		$j=true;
		for($i=1; $i<count($languages); $i++) {
			if(strstr($file, '.'.$languages[$i].'.') || strstr($file, '.hd.')) {
				$j=false;
			} 
		}
		if($j) {
		$files[]=array(filectime($dpath.$file),$file);	
		}
	}
}
closedir($dopen);
echo '<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0"  >
<channel>
	<title>'.$title.' - Podcast</title>
	<link>http://'.$ihost.$_SERVER['REQUEST_URI'].'</link>';

if ($files) {
	rsort($files);
	foreach ($files as $file) {
		$data = implode("",file('http://'.$ihost.$iscript.'?v='.$rep.'/'.$file[1].'&out=xml')) or die("could not open XML input file");
		$xml = xmlize($data); 
		$ith_xml = $xml["itheora"]["#"]["video"];
		
		echo '
	<item>
		<title><![CDATA[';
		if($ith_xml[0]["#"]["title"][0]["#"]=="") {
			echo url_to_file($ith_xml[0]["#"]["url"][0]["#"]);
		} else {
			echo $ith_xml[0]["#"]["title"][0]["#"];
		}
		echo ']]></title>
		<link>http://'.$ihost.$iscript.'?v='.$rep.'/'.$file[1].'&amp;out=link</link>
		<description><![CDATA['.$ith_xml[0]["#"]["description"][0]["#"].']]></description>
		';
		if($ith_xml[0]["#"]["podcast"][0]["#"]!="") {
			echo '<enclosure url="'.$ith_xml[0]["#"]["podcast"][0]["#"].'" type="bittorrent" />';
		} elseif ($ith_xml[0]["#"]["height"][0]["#"]=="") {
			echo '<enclosure url="'.$ith_xml[0]["#"]["url"][0]["#"].'" type="audio/ogg" />';
		} else {
			echo '<enclosure url="'.$ith_xml[0]["#"]["url"][0]["#"].'" type="video/ogg" />';
		}
		if($ith_xml[0]["#"]["picture"][0]["#"]!="") {
		echo '
		<image>
			<url>'.$ith_xml[0]["#"]["picture"][0]["#"].'</url>
			<title><![CDATA['.$ith_xml[0]["#"]["title"][0]["#"].']]></title>
		</image>';
		}
		echo '
		<author>'.$ith_xml[0]["#"]["artist"][0]["#"].'</author>
		<guid>http://'.$ihost.$iscript.'?v='.$rep.'/'.$file[1].'&amp;out=link</guid>
	</item>';
}}
echo '
</channel>
</rss>';

?>