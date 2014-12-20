<?php
include("../fonctions.php");
session_start();

$ihost = $_SERVER['SERVER_NAME']; // domaine ou se trouve ITheora
$iscript = str_replace("lib/ajax/tab_playlist.php", "index.php", $_SERVER['SCRIPT_NAME']); // chemin vers index.php
$lang=getp('l');
require("../../lang/en/player.php"); // Initialise en anglais
if(file_exists( "../../lang/".$lang."/player.php") && $lang!="en") {require("../../lang/".$lang."/player.php");}; // Traduction si message defini

$playlist=getp('url');

$x=getp('w');
$y=getp('h');
$ss="&s=".getp('s');

if(url_exists($playlist, "xml")) {
	if(isset($_SESSION[$playlist])) {
		echo $_SESSION[$playlist];
	} elseif(substr($playlist, -5, 5)==".xspf") { // Playlist XSPF
	
	$data = implode("",file($playlist)) or die("could not open XML input file");
        $xml = xmlize($data); 
	$plsxml = $xml["playlist"]["#"]["trackList"][0]["#"]["track"];
	
$out_playlist = '
<table><tr>
	<td class="playlist_title" colspan="4" >';
		$out_playlist .= (!empty($xml["playlist"]["#"]["title"][0]["#"])) ?  txt($xml["playlist"]["#"]["title"][0]["#"]) : txt($bt_playlist);
		$out_playlist .= '
	</td>
</tr>';
	for($i=0; $i< sizeof($plsxml); $i++) {
	// Liste des variables
		$p_location = $plsxml[$i]["#"]["location"][0]["#"];
		$p_duration = isset($plsxml[$i]["#"]["duration"][0]["#"]) ? substr($plsxml[$i]["#"]["duration"][0]["#"], 0, -3) : "";
		$p_title = isset($plsxml[$i]["#"]["title"][0]["#"]) ? $plsxml[$i]["#"]["title"][0]["#"] : url_to_file($p_location) ;
		$p_creator = isset($plsxml[$i]["#"]["creator"][0]["#"]) ? $plsxml[$i]["#"]["creator"][0]["#"] : "";
		$p_image = isset($plsxml[$i]["#"]["image"][0]["#"]) ? $plsxml[$i]["#"]["image"][0]["#"] : "";
		
		$out_playlist .= '
<tr>
	<td>'; // Numero de la piste
	$out_playlist .= ($i<9) ? '0'.($i+1) : ($i+1);
	$out_playlist .= '
	</td><td>
		<a href="http://'.$ihost.$iscript.'?v='.$p_location.'&t='.$p_duration.'&n=';
	$out_playlist .= (!empty($p_creator)) ? txt($p_creator).' - ' : "";
	$out_playlist .= txt($p_title).$ss;
	$out_playlist .= (!empty($p_image)) ? '&p='.$p_image: "";
	$out_playlist .= ($y<85) ? '&d=m' : ""; // Lecture auto si audio
	$out_playlist .= '&x='.$playlist.'">';
		if(isset($plsxml[$i]["#"]["image"][0]["#"])) {
			$out_playlist .= '<b><br /><img src="'.$p_image.'" alt="" '; // ...image...
			$out_playlist .= ($y<85) ? 'style="width : '.($y/1.5).'px; height :'.($y/1.5).'px;"></b>' :'style="width : '.($x/3).'px; height :'.($y/3).'px;"></b>';
		}
	$out_playlist .= txt($p_title).'</a>
	</td><td>'.txt($p_creator).'</td><td>'.s_to_h($p_duration).'</td>
</tr>';
	};
$out_playlist .= '</table>';

$tab_tools = '
	<table class="tab_tools">
	<tr>
		<td><p><a '.linktitle(txt($txt_xspf)).' href="lib/export_xspf.php?file='.$playlist.'" onclick="window.open(this.href); return false;">'.txt($txt_xspf).'</a></p></td>
		<td>
			<div class="Xspf">
				<a '.linktitle(txt($txt_xspf)).' href="lib/export_xspf.php?file='.$playlist.'" onclick="window.open(this.href); return false;"></a>
			</div>
		</td>
	</tr>
	<tr>
		<td><p><a href="javascript:share_playlist();">'.txt($txt_share_playlist).'</a></p></td>
		<td>
			<div class="Share_Playlist">
				<a href="javascript:share_playlist();"></a>
			</div>
		</td>
	</tr>
	</table>';

	$out_playlist .= txtjs($tab_tools);
	$_SESSION[$playlist]=$out_playlist;
	echo $out_playlist;

	} elseif(substr($playlist, -5, 5)!=".xspf") { // PODCAST
	
	$data = implode("",file($playlist)) or die("could not open XML input file");
	$xml = xmlize($data); 
	$plsxml = $xml["rss"]["#"]["channel"][0]["#"]["item"]  ;
	
$out_playlist = '
<table><tr>
	<td class="playlist_title" colspan="4" >';
		$out_playlist .= (isset($xml["rss"]["#"]["channel"][0]["#"]["title"][0]["#"])) ? txt($xml["rss"]["#"]["channel"][0]["#"]["title"][0]["#"]) : txt($bt_playlist);
		$out_playlist .='
	</td>
</tr>';
	for($i=0; $i< sizeof($plsxml); $i++) {
	// Liste des variables
		if(strstr($playlist, "blip.tv/rss")) {
			$p_location=""; 
			if(isset($plsxml[$i]["#"]["media:group"][0]["#"]["media:content"])) {
				for($j=0; $j<count($plsxml[$i]["#"]["media:group"][0]["#"]["media:content"]); $j++) { 
					if(isset($plsxml[$i]["#"]["media:group"][0]["#"]["media:content"][$j]["@"]["url"])) {
						if(substr($plsxml[$i]["#"]["media:group"][0]["#"]["media:content"][$j]["@"]["url"], -4, 3)==".og") {
							$p_location = $plsxml[$i]["#"]["media:group"][0]["#"]["media:content"][$j]["@"]["url"];
						}
					}
				}
			}
		} else {
		$p_location = isset($plsxml[$i]["#"]["enclosure"][0]["@"]["url"]) ? $plsxml[$i]["#"]["enclosure"][0]["@"]["url"] : "" ;
		}
		$p_duration = isset($plsxml[$i]["#"]["duration"][0]["#"]) ? $plsxml[$i]["#"]["duration"][0]["#"] : "";
		$ttime= h_to_s($p_duration);
		$p_title = isset($plsxml[$i]["#"]["title"][0]["#"]) ? $plsxml[$i]["#"]["title"][0]["#"] : url_to_file($p_location) ;
		$p_image = isset($plsxml[$i]["#"]["image"][0]["#"]["url"][0]["#"]) ? $plsxml[$i]["#"]["image"][0]["#"]["url"][0]["#"] : "";
		if(substr($p_location,-4,3)==".og") {		
		$out_playlist .= '<tr>
	<td>'; // Numero de la piste
		$out_playlist .= ($i<9) ? '0'.($i+1) : ($i+1);
	$out_playlist .= '
	</td><td>
		<a href="http://'.$ihost.$iscript.'?v='.$p_location.'&t='.$ttime.'&n='.txt($p_title).$ss;
	$out_playlist .= ($y<85) ? '&d=m' : "";
	$out_playlist .= '&x='.$playlist.'">';
	if (isset($plsxml[$i]["#"]["image"][0]["#"]["url"][0]["#"])) {
		$out_playlist .= '<b><br /><img src="'.$p_image.'" alt="" '; // ...image...
		$out_playlist .= ($y<85) ? 'style="width : '.($y/1.5).'px; height :'.($y/1.5).'px;"></b>' : 'style="width : '.($x/3).'px; height :'.($y/3).'px;"></b>';
	} elseif(strstr($p_location, "http://blip.tv/")) {
		$out_playlist .= '<b><br /><img src="'.$p_location.'.jpg" alt="" '; // ...image...
		$out_playlist .= ($y<85) ? 'style="width : '.($y/1.5).'px; height :'.($y/1.5).'px;"></b>' : 'style="width : '.($x/3).'px; height :'.($y/3).'px;"></b>';
	}
	$out_playlist .= txt($p_title).'</a></td>'; // ...titre.
	$out_playlist .= (!empty($p_duration)) ? '<td>'.$p_duration.'</td>' : "" ;
	$out_playlist .= '</tr>';
		}
	}
$out_playlist .= '</table>';

$tab_tools = '
	<table class="tab_tools">
	<tr>
		<td><p><a href="'.$playlist.'" onclick="window.open(this.href); return false;">'.txt($txt_rss).'</a></p></td>
		<td>
			<div class="RSS">
				<a href="'.$playlist.'" onclick="window.open(this.href); return false;"></a>
			</div>
		</td>
	</tr>
	<tr>
		<td><p><a href="http://subscribe.getmiro.com/?url1='.ep($playlist, 0).'" onclick="window.open(this.href); return false;">'.txt($txt_miro).'</a></p></td>
		<td>
			<div class="Miro">
				<a href="http://subscribe.getmiro.com/?url1='.ep($playlist, 0).'" onclick="window.open(this.href); return false;"></a>
			</div>
		</td>
	</tr>
	<tr>
		<td><p><a href="javascript:share_playlist();">'.txt($txt_share_playlist).'</a></p></td>
		<td>
			<div class="Share_Playlist">
				<a href="javascript:share_playlist();"></a>
			</div>
		</td>
	</tr>
	</table>';

	$out_playlist .= txtjs($tab_tools);
	$_SESSION[$playlist]=$out_playlist;
	echo $out_playlist;

}
}
?>