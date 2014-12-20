<?php

include("../fonctions.php");

$url=getp('url');

$lang=getp('l');
require("../../lang/en/player.php"); // Initialise en anglais
if(file_exists( "../../lang/".$lang."/player.php") && $lang!="en") {require("../../lang/".$lang."/player.php");}; // Traduction si message defini

if(!strstr($url, 'http://blip.tv/') && !strstr($url, 'http://upload.wikimedia.org/')) { // Ne cherche rien si video de blip.tv ou wikimedia
//------------------------------------------------- Detection d'un fichier HD
$hd_ogx=substr($url, 0, -4).'.hd'.substr($url, -4, 4);
if(url_exists($hd_ogx, "ogg")) {
	$hd_torrent=get_torrent($hd_ogx);
	if(!empty($hd_torrent)) {
		$alt_download_hd='
	<tr>
		<td>'.$txt_hd.'</td>
		<td class="icons">
			<div class="Torrent">
			<a href="'.get_torrent($hd_ogx).'" onclick="return(false);"></a>
			</div>
		</td>
		<td class="icons">
			<div class="O'.substr($url, -2, 2).'">
			<a href="'.get_coral($hd_ogx).'" onclick="return(false);"></a>
			</div>
		</td>
	</tr>';
	} else {
		$alt_download_hd='
	<tr>
		<td>'.$txt_hd.'</td>
		<td class="icons"></td>
		<td class="icons">
			<div class="O'.substr($url, -2, 2).'">
			<a href="'.$hd_ogx.'" onclick="return(false);"></a>
			</div>
		</td>
	</tr>';
	}
}
echo '<table>'.$alt_download_hd.'</table>';


// -------------------------------------------- Detection des sous-titres
// Premiere ligne soutitre non masquee
$alt_download_lang_subtitles="";

if(url_exists(substr($url, 0, -4).'.'.$lang.'.srt', "ext") || url_exists(substr($url, 0, -4).'.'.$lang.'.sub', "ext")) { // Il y a au moins un sous-titre
	$lang_subtitle_srt='<td class="icons"></td>'; $lang_subtitle_sub='<td class="icons"></td>';
	
	if(url_exists(substr($url, 0, -4).'.'.$lang.'.srt', "ext")) { // Fichier SUB
		$lang_subtitle_sub='
		<td class="icons">
			<div class="Sub">
			<a href="'.substr($url, 0, -4).'.'.$lang.'.sub" onclick="return(false);"></a>
			</div>
		</td>';
	}
	if(url_exists(substr($url, 0, -4).'.'.$lang.'.srt', "ext")) { // Fichier SRT
		$lang_subtitle_srt='
		<td class="icons">
			<div class="Srt">
			<a href="'.substr($url, 0, -4).'.'.$lang.'.srt" onclick="return(false);"></a>
			</div>
		</td>';
	}
	
	$alt_download_lang_subtitles='
	<table>
	<tr>
		<td>'.$txt_subtitles.' '.$lang.'</td>'.$lang_subtitle_srt.$lang_subtitle_sub.'
	</tr>';
}

// Liste des autres sous-titres
$alt_download_other_subtitles="";
for ($i=1; $i<=count($languages); $i++) {
	if((url_exists(substr($url, 0, -4).'.'.$languages[$i].'.srt', "ext") || url_exists(substr($url, 0, -4).'.'.$languages[$i].'.sub', "ext")) && $languages[$i]!=$lang) { // Il y a au moins un sous-titre
	if(empty($alt_download_other_subtitles)) { 
		$alt_download_other_subtitles='
		<tr>
			<td colspan="3" style="text-align : right; font-size : x-small;"><a href="javascript:void(0);" onclick="var replydisplay=document.getElementById(\'Subtitles\').style.display ? \'\' : \'none\'; document.getElementById(\'Subtitles\').style.display = replydisplay;">'.$txt_all_subtitles.'</a></td>
		</tr>
		</table>
		<table id="Subtitles" style="display:none">';		
	}
	$lang_subtitle_srt='<td class="icons"></td>'; $lang_subtitle_sub='<td class="icons"></td>';
	if(url_exists(substr($url, 0, -4).'.'.$languages[$i].'.sub', "ext")) { // Fichier SUB
		$lang_subtitle_sub='
		<td class="icons">
			<div class="Sub">
			<a href="'.substr($url, 0, -4).'.'.$languages[$i].'.sub" onclick="return(false);"></a>
			</div>
		</td>';
	}
	
	if(url_exists(substr($url, 0, -4).'.'.$languages[$i].'.srt', "ext")) { // Fichier SRT
		$lang_subtitle_srt='
		<td class="icons">
			<div class="Srt">
			<a href="'.substr($url, 0, -4).'.'.$languages[$i].'.srt" onclick="return(false);"></a>
			</div>
		</td>';
	}
	
	$alt_download_other_subtitles=$alt_download_other_subtitles.'
	<tr>
		<td>'.$txt_subtitles.' '.$languages[$i].'</td>'.$lang_subtitle_srt.$lang_subtitle_sub.'
	</tr>';
	}
}

if(empty($alt_download_lang_subtitles) && !empty($alt_download_other_subtitles)) {
$alt_download_lang_subtitles='
	<table>
	<tr>
		<td colspan="3">'.$txt_no_subtitle.'</td>
	</tr>';
}

if(!empty($alt_download_lang_subtitles)) {
	$alt_download_subtitles=$alt_download_lang_subtitles.$alt_download_other_subtitles.'</table>';
	echo $alt_download_subtitles;
}

// -------------------------------------------- Detection des doublages
// Premiere ligne doublage non masquee
$alt_download_lang_dubbing="";

$lang_ogx=substr($url, 0, -4).'.'.$lang.substr($url, -4, 4);
if(url_exists($lang_ogx, "ogg")) {
	$lang_torrent=get_torrent($lang_ogx);
	if(!empty($lang_torrent)) { // P2P
		$alt_download_lang_dubbing='
	<table>
	<tr>
		<td>'.$txt_dubbing.' '.$lang.'</td>
		<td class="icons">
			<div class="Torrent">
			<a href="'.get_torrent($lang_ogx).'" onclick="return(false);"></a>
			</div>
		</td>
		<td class="icons">
			<div class="O'.substr($url, -2, 2).'">
			<a href="'.get_coral($lang_ogx).'" onclick="return(false);"></a>
			</div>
		</td>
	</tr>';
	} else { // Pas de P2P
		$alt_download_lang_dubbing='
	<table>
	<tr>
		<td>'.$txt_dubbing.' '.$lang.'</td>
		<td class="icons"></td>
		<td class="icons">
			<div class="O'.substr($url, -2, 2).'">
			<a href="'.$lang_ogx.'" onclick="return(false);"></a>
			</div>
		</td>
	</tr>';
	}
}

// Liste des autres doublages
$alt_download_other_dubbing="";
for ($i=1; $i<=count($languages); $i++) {
	$lang_ogx=substr($url, 0, -4).'.'.$languages[$i].substr($url, -4, 4);

	if(url_exists($lang_ogx, "ogg") && $languages[$i]!=$lang) { // Il y a au moins une autre version doublee
		if(empty($alt_download_other_dubbing)) { 
			$alt_download_other_dubbing='
			<tr>
				<td colspan="3" style="text-align : right; font-size : x-small;"><a href="javascript:void(0);" onclick="var replydisplay=document.getElementById(\'Dubbing\').style.display ? \'\' : \'none\'; document.getElementById(\'Dubbing\').style.display = replydisplay;">'.$txt_all_dubbing.'</a></td>
			</tr>
			</table>
			<table id="Dubbing" style="display:none">';		
		}

		$lang_torrent=get_torrent($lang_ogx);
		if(!empty($lang_torrent)) { // P2P
			$alt_download_other_dubbing=$alt_download_other_dubbing.'
		<tr>
			<td>'.$txt_dubbing.' '.$languages[$i].'</td>
			<td class="icons">
				<div class="Torrent">
				<a href="'.get_torrent($lang_ogx).'" onclick="return(false);"></a>
				</div>
			</td>
			<td class="icons">
				<div class="O'.substr($url, -2, 2).'">
				<a href="'.get_coral($lang_ogx).'" onclick="return(false);"></a>
				</div>
			</td>
		</tr>';
		} else { // Pas de P2P
			$alt_download_other_dubbing=$alt_download_other_dubbing.'
		<tr>
			<td>'.$txt_dubbing.' '.$languages[$i].'</td>
			<td class="icons"></td>
			<td class="icons">
				<div class="O'.substr($url, -2, 2).'">
				<a href="'.$lang_ogx.'" onclick="return(false);"></a>
				</div>
			</td>
		</tr>';
		}
	}
}

if(empty($alt_download_lang_dubbing) && !empty($alt_download_other_dubbing)) {
$alt_download_lang_dubbing='
	<table>
	<tr>
		<td colspan="3">'.$txt_no_dubbing.'</td>
	</tr>';
}

if(!empty($alt_download_lang_dubbing)) {
	$alt_download_dubbing=$alt_download_lang_dubbing.$alt_download_other_dubbing.'</table>';
	echo $alt_download_dubbing;
}
}
?>