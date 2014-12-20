<?php  
// Version d'ITheora
$itheoraversion="2.2"; 
// Variables concernant ITheora
$ihost = $_SERVER['SERVER_NAME']; // domaine ou se trouve ITheora
$iscript = str_replace("admin/", "", $_SERVER['SCRIPT_NAME']); // chemin vers index.php
$ipath = dirname($iscript).'/';
$document_root=rtrim($_SERVER['DOCUMENT_ROOT'],"/"); // chemin pour les fichier de l'arborescence du serveur
//Dossier cache 
$cacheogg=dirname($_SERVER['SCRIPT_FILENAME'])."/cache";

// --------------------------MODE INCLUSION via PHP 
//--------------------------pour appel en php sans connaitre aucun parametre
if (isset($par)&& isset($itheora)) {
	parse_str($par,$pars);
	if(!isset($pars['t']) || !isset($pars['w']) || !isset($pars['h'])) {
		// path relatif et non absolu par rapport a la racine web, on converti en absolu
		if ($pars['v'][0]!='/' && !strpos($pars['v'],"://")) {
			$pars['v']=dirname($_SERVER['PHP_SELF'])."/".$pars['v'];
		}
		
		require_once ("lib/ogg.class.php");
		if (!strpos($pars['v'],"://")) {
			$Ogg=new Ogg($document_root.$pars['v'],UTF8,dirname($itheora)."/cache");
		} else {
			$Ogg=new Ogg($pars['v'],UTF8,dirname($itheora)."/cache");
		}
		if (!isset($pars['t'])&&isset($Ogg->Streams['duration'])) $pars['t']=$Ogg->Streams['duration'];	
		if (!isset($pars['w']) || !isset($pars['h']))
			{
			$skin=isset($pars['s'])?$pars['s']:"defaut";
			if(!file_exists( 'skins/'.$skin.'/style.php') ) { $skin="defaut"; };
			if (is_resource($style=fopen(dirname($itheora).'/skins/'.$skin.'/style.php',"r")))
				{
				$dataskin=fread($style,1024);
				fclose($style);
				if (preg_match("|[$]wskin=(\d*);|",$dataskin,$wskin)) $wskin=$wskin[1];
				if (preg_match("|[$]hskin=(\d*);|",$dataskin,$hskin)) $hskin=$hskin[1];
				}
			else { $wskin=20; $hskin=40; }
			}
		if (!isset($pars['w'])) $pars['w']=$wskin+(isset($Ogg->Streams['theora'])?$Ogg->Streams['theora']['width']:320);
		if (!isset($pars['h'])) $pars['h']=$hskin+(isset($Ogg->Streams['theora'])?$Ogg->Streams['theora']['height']:80);
		$par="?";
		foreach ($pars as $key => $val) $par.="$key=$val&amp;";
		$par=substr($par,0,-5);
	} else {
		$par = '?'.$par;
		$par = str_replace('&', '&amp;', $par);
	}
	
	// Nettoie w= et h= si correponde à la taille de la video
	$par = str_replace('&amp;w='.$pars['w'], '', $par);
	$par = str_replace('&amp;h='.$pars['h'], '', $par);
	
	// Nettoie v=
	if(strstr($par, 'v=http://'.$ihost)) { $par=str_replace('v=http://'.$ihost, 'v=', $par); }
	if(strstr($par, 'v='.$ipath.'data/')) { $par=str_replace('v='.$ipath.'data/', 'v=', $par); }
	if(strstr($par, 'v=/'.$ipath.'data/')) { $par=str_replace('v=/'.$ipath.'data/', 'v=', $par); }
	if(strstr($par, 'v=/')) { $par=str_replace('v=/', 'v=', $par); }
	if(strstr($par, 'v=/')) { $par=str_replace('v=/', 'v=', $par); }
	
	if(isset($itheora_code)) {
		$par = str_replace('&', '&amp;', $par);
		if(isset($ihost) && isset($iscript)) {
	echo '<p style="margin: 0; padding : 0; color : green;">&lt;object data="http://'.$ihost.$iscript.$par.'" type="application/xhtml+xml" style="width:'.$pars['w'].'px; height:'.$pars['h'].'px;"&gt;</p>
<p style="margin: 0; padding : 0; text-indent:20px; color :#808000;">&lt;!--[if IE]&gt;</p>
<p style="margin: 0; padding : 0; text-indent:40px; color :#808000;">&lt;iframe src="http://'.$ihost.$iscript.$par.'" style="width:'.$pars['w'].'px; height:'.$pars['h'].'px;" allowtransparency="true" frameborder="0" &gt;</p>
<p style="margin: 0; padding : 0; text-indent:40px; color :#808000;">&lt;/iframe&gt;</p>
<p style="margin: 0; padding : 0; text-indent:20px; color :#808000;">&lt;![endif]--&gt; </p>
<p style="margin: 0; padding : 0; color : green;">&lt;/object&gt;</p>';
		} else {
	echo '<p style="margin: 0; padding : 0; color : green;">&lt;object data="'.$itheora.$par.'" type="application/xhtml+xml" style="width:'.$pars['w'].'px; height:'.$pars['h'].'px;"&gt;</p>
<p style="margin: 0; padding : 0; text-indent:20px; color :#808000;">&lt;!--[if IE]&gt;</p>
<p style="margin: 0; padding : 0; text-indent:40px; color :#808000;">&lt;iframe src="'.$itheora.$par.'" style="width:'.$pars['w'].'px; height:'.$pars['h'].'px;" allowtransparency="true" frameborder="0" &gt;</p>
<p style="margin: 0; padding : 0; text-indent:40px; color :#808000;">&lt;/iframe&gt;</p>
<p style="margin: 0; padding : 0; text-indent:20px; color :#808000;">&lt;![endif]--&gt; </p>
<p style="margin: 0; padding : 0; color : green;">&lt;/object&gt;</p>';
		}
	unset($itheora_code);
	} else {
	echo '<object data="'.$itheora.$par.'" type="application/xhtml+xml" style="width:'.$pars['w'].'px; height:'.$pars['h'].'px;">
	<!--[if IE]> 
		<iframe src="'.$itheora.$par.'" style="width:'.$pars['w'].'px; height:'.$pars['h'].'px;" allowtransparency="true" frameborder="0" ></iframe> 
	<![endif]--> 
</object>';
	}
	unset($itheora);
	

} else {
//--------------------------------------------MODE INCLUSION via CODE HTML
//--------------------------------------------le webmaster connait tout les parametres
//error_reporting(E_ALL);

require_once ("lib/fonctions.php");
include ("admin/config/player.php");
$extra_query=get_extra_query();

$time = getp('t') ? getp('t') : '0';
$playlist = getp('x') ? getp('x') : '0'; // Liste de lecture .xspf
$picture = getp('p') ? getp('p') : '0';
$bittorrent = getp('b') ? getp('b') : '0';
$flash = getp('f') ? getp('f') : '0';

if(getp('n')) {
   $name = !isUTF8(getp('n')) ? utf8_encode(str_replace("\\", '',getp('n')))  : str_replace("\\", '',getp('n')) ;
} else { 
	$name = '0' ;
}
$skin = getp('s') ? getp('s') : 'defaut';
$verror= (file_exists( 'skins/'.$skin.'/error.ogv')) ? 'http://'.$ihost.$ipath.'skins/'.$skin.'/error.ogv' : 'http://'.$ihost.$ipath.'skins/defaut/error.ogv' ;

if(getp('v')) {
	if(url_exists(getp('v'), "html")) { // v est une page html
		$video = $verror;
	} else {
		$video = (strstr( getp('v') ,".")) ? getp('v') : getp('v').".ogg" ;
	}
} else { 
	// There no param v so we load the local podcast page like an home page
	$video = 'http://'.$ihost.$ipath.'podcast.php';
	$_GET['out']="link";
};

$wplay = getp('w') ? getp('w') : 'auto';
$hplay = getp('h') ? getp('h') : 'auto';
if(getp('l')) {
	$lang = getp('l');
} else { 
	$lang = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']) : "en";
	$lang = substr($lang[0], 0, 2);
}

$disable = getp('d') ? getp('d') : ''; // Parametre pour desactiver ponctuellement certaines fonctions 
if(stristr($disable,"m")) { $function_manual_play=false; } // active la lecture auto
if(stristr($disable,"i")) { $function_info=false; } // desactive les infobulles
if(stristr($disable,"d")) { $function_download=false;} // desactive le telechargement
if(stristr($disable,"s")) { $function_share=false;} // desactive le partage 
if(stristr($disable,"t")) { $function_ts=false;} // supprime l'icone TheoraSea
if(stristr($disable,"o")) { $function_options=false;} // desactive les options
if(stristr($disable,"f")) { $function_fullscreen=false;} // desactive le plein ecran
if(stristr($disable,"n")) { $function_name=false;} // desactive le titre

// ----------------------------------------------------- Gestion des langues
require("lang/en/player.php"); // Initialise en anglais
if(file_exists( "lang/".$lang."/player.php") && $lang!="en") {require("lang/".$lang."/player.php");}; // Traduction si message defini

// ----------------------------------------------------- Gestion de la liste de lecture
if((substr($video, -5, 5)==".xspf") ) { // playlist passee par v
	$playlist=$video;
} elseif(substr($video, -4, 3)!=".og" && substr($video, -4, 4)!=".flv" && strstr($video, "tp://")) { // URL sans extention ogg ou flv... probablement un podcast !
	$playlist=$video;
}
$playlist=$playlist.$extra_query;

if($playlist!='0' && substr($video, -5, 5)==".xspf"){  // Playlist XSPF passee par v=
if(!strstr($playlist, "tp://")) { // playlist locale
	if(substr($playlist, 0, 1)!="/"){ // $playlist!='0', racine ou data ?
		if (file_exists($document_root.$ipath."data/".$playlist)) {
			$playlist="http://".$ihost.$ipath."data/".$playlist;
		} else {
			$playlist="http://".$ihost."/".$playlist;
		}
	} else {
		if (file_exists($document_root.$ipath."data/".$playlist)){
			$playlist="http://".$ihost.$ipath."data/".$playlist;
		} else {
			$playlist="http://".$ihost.$playlist;
		}
	}
}
	if(url_exists($playlist, "xml")) {
		// Detection de la premiere video
		$video_from_playlist = get_first_video($playlist, "xspf");
		$video = $video_from_playlist[0];
		$name = $video_from_playlist[1];
	} else {
		$video=$verror;
	}
} elseif($playlist!='0' && substr($video, -5, 5)!=".xspf" && substr($video, -4, 3)!=".og" && substr($video, -4, 4)!=".flv" && strstr($video, "tp://")) { // PODCAST passe par v=
	if(url_exists($playlist, "xml")) {
	// Detection de la premiere video
		$video_from_playlist = get_first_video($playlist, "podcast");
		$video = $video_from_playlist[0];
		$name = $video_from_playlist[1];
	} else {
		$video=$verror;
	}
} elseif ($playlist!='0' && substr($playlist, -5, 5)==".xspf") { // Playlist XSPF passee par x=
	if(!strstr($playlist, "tp://")) { // playlist locale
	if(substr($playlist, 0, 1)!="/"){ // $playlist!='0', racine ou data ?
		if (file_exists($document_root.$ipath."data/".$playlist)) {
			$playlist="http://".$ihost.$ipath."data/".$playlist;
		} else {
			$playlist="http://".$ihost."/".$playlist;
		}
	} else {
		if (file_exists($document_root.$ipath."data/".$playlist)){
			$playlist="http://".$ihost.$ipath."data/".$playlist;
		} else {
			$playlist="http://".$ihost.$playlist;
		}
	}
}
}
// -----------------------------------------------------  Gestion des fichiers video
$r=0; $n=0;
if(strstr($video, "tp://")) { // url distante 
	$vinfos = parse_url ($video);
	$vhost = $vinfos['host']; // domaine du site
	$vport =  isset($vinfos['port']) ? ':'.$vinfos['port'] : ''; // port pour streaming live (du type :8080)
	$vpath = $vinfos['path']; // chemin vers la video depuis la racine
	$vprot = $vinfos['scheme'].'://'; // protocole utilise
	$n = !empty( $vport ) ? 2 : 1;
} else { // url locale
	$vhost = $ihost;
	$vprot = "http://";
	$vport = "";
	$vith = $ipath."data/";
	if(file_exists( $document_root.$vith.$video )) { 
		$vpath = $vith.$video ; // defini la video depuis la racine
		$vdata = $video;
		$r=1;
	} else {
		if(substr($video, 0,1)=="/") { $vpath = $video;} else {$vpath = "/".$video;} // racine avec '/'
		$r=2;
	}
}

// A partir de cet endroit, tout les fichiers sont de la forme
// [protocole][nom de domaine][port][chemin vers la video][extension]
$vext = '.'.url_to_ext($vpath);  // extension
$vpath=str_replace($vext, "", $vpath); // supprime l'extension

$vfile = $document_root.$vpath;
$vurl = $vprot.$vhost.$vpath; 

$vext_ogx="";
// Filtre l'extension
if($vext==".flv") {
	$vflv = $vurl.".flv";
	// Detection du fichier ogx associe
	if(file_exists($vfile.".ogv")) { // Tests locaux d'abord
		$vext_ogx = ".ogv";
	} else if (file_exists($vfile.".ogg")) {
		$vext_ogx = ".ogg";
	} else if (file_exists($vfile.".oga"))  {
		$vext_ogx = ".oga";
	} else if (file_exists($vfile.".ogm"))  {
		$vext_ogx = ".ogm";
	} else if(url_exists($vurl.".ogv", "ogg")) { // Tests distants
		$vext_ogx = ".ogv";
	} else if (url_exists($vurl.".ogg", "ogg")) {
		$vext_ogx = ".ogg";
	} else if (url_exists($vurl.".oga", "ogg"))  {
		$vext_ogx = ".oga";
	} else if (url_exists($vurl.".ogm", "ogg"))  {
		$vext_ogx = ".ogm";
	} else { // Pas de fichier ogx associe
		$vext_ogx = "0";
	}
} elseif (substr($vext, 0, 3)==".og") {
	$vext_ogx = $vext;
}
// url complete du fichier .ogx pour lecture, telechargement, etc
if(url_exists($vprot.$vhost.$vport.$vpath.'.'.$lang.$vext_ogx, "ogg")) {
	$vogx = $vprot.$vhost.$vport.$vpath.'.'.$lang.$vext_ogx;
} else { 
	$vogx = $vprot.$vhost.$vport.$vpath.$vext_ogx; 
}
// fichier .ogx pour tests locaux
$vfile_ogx = $document_root.$vpath.$vext_ogx;
// url .ogx pour tester jpg et torrent
$vurl_ogx = $vprot.$vhost.$vpath.$vext_ogx;
if($n==0) {
$vcache = $vfile_ogx;
} else {
$vcache = $vurl_ogx;
}

// ----------------------------------------------------- Importation de class.ogg.php 
require_once ("lib/ogg.class.php");
$Ogg=new Ogg($vcache,UTF8,dirname($_SERVER['SCRIPT_FILENAME'])."/cache");

$vartist=""; $vtitle=""; $vdesc=""; $vlicense="";
if (isset($Ogg->Streams['vorbis']['comments'])) { // Recherche infos dans tags vorbis
	for($i=0 ; $i < count($Ogg->Streams['vorbis']['comments']); $i++ ) {
		if(strstr($Ogg->Streams['vorbis']['comments'][$i], "ARTIST=")) {
			$vartist=str_replace("ARTIST=", "", $Ogg->Streams['vorbis']['comments'][$i]);
		}
		if(strstr($Ogg->Streams['vorbis']['comments'][$i], "TITLE=")) {
			$vtitle=str_replace("TITLE=", "", $Ogg->Streams['vorbis']['comments'][$i]);
		}
		if(strstr($Ogg->Streams['vorbis']['comments'][$i], "DESCRIPTION=")) {
			$vdesc=str_replace("DESCRIPTION=", "", $Ogg->Streams['vorbis']['comments'][$i]);
		}
		if(strstr($Ogg->Streams['vorbis']['comments'][$i], "LICENSE=")) {
			$vlicense=str_replace("LICENSE=", "", $Ogg->Streams['vorbis']['comments'][$i]);
		}
	}
}
if (isset($Ogg->Streams['theora']['comments'])) { // Recherche infos dans tags theora et remplace si c'est mieux
	for($i=0 ; $i < count($Ogg->Streams['theora']['comments']); $i++ ) {
		if(strstr($Ogg->Streams['theora']['comments'][$i], "ARTIST=")) {
			$vartist=str_replace("ARTIST=", "", $Ogg->Streams['theora']['comments'][$i]);
		}
		if(strstr($Ogg->Streams['theora']['comments'][$i], "TITLE=")) {
			$vtitle=str_replace("TITLE=", "", $Ogg->Streams['theora']['comments'][$i]);
		}
		if(strstr($Ogg->Streams['theora']['comments'][$i], "DESCRIPTION=")) {
			$vdesc=str_replace("DESCRIPTION=", "", $Ogg->Streams['theora']['comments'][$i]);
		}
		if(strstr($Ogg->Streams['theora']['comments'][$i], "LICENSE=")) {
			$vlicense=str_replace("LICENSE=", "", $Ogg->Streams['theora']['comments'][$i]);
		}
	}
}

if($name=='0' && $function_name) {
	if($vartist=="" || $vtitle=="") {
		$name=$vartist.$vtitle;
	} else {
		$name=$vartist.' - '.$vtitle;
	}
	if($name=="") { $name="0"; }
}

// ----------------------------------------------------- Gestion des donnees ogg
if( $time=='0') {
	$time=(isset($Ogg->Streams['duration']) && $time==0) ? $Ogg->Streams['duration'] : 0;	
}

// Verification du skin
// Lecture des parametres $wksin, $hskin et $info dans la feuille de style
if(!file_exists( 'skins/'.$skin.'/style.php') ) { $skin="defaut"; };
	
if ($handle = @fopen('skins/'.$skin.'/style.php', "r")) {
	$dataskin=@fread($handle, 1024); // ce qu'on cherche est au debut du fichier
	fclose($handle);
	$masque1 = '#wskin=(.*?);#i'; preg_match_all("$masque1",$dataskin,$out1,PREG_SET_ORDER);
	$masque2 = '#hskin=(.*?);#i'; preg_match_all("$masque2",$dataskin,$out2,PREG_SET_ORDER);
	$wskin = (isset($out1[0][1])) ? $out1[0][1] : $wskin=20;
	$hskin = (isset($out2[0][1])) ? $out2[0][1] : $hskin=40;
}

// Calcule la largeur du player et de la video
if($wplay=='auto') { 
	if(isset($Ogg->Streams['theora'])) {
		$wvid=$Ogg->Streams['theora']['width']; $wplay=$wvid+$wskin;
	} else {
		$wvid=320; $wplay=$wvid+$wskin; 
	}
} else { 
	$wvid=$wplay-$wskin;
};
// Calcule la hauteur du player et de la video
if($hplay=='auto') { 
	if(isset($Ogg->Streams['theora'])) {
		$hvid=$Ogg->Streams['theora']['height']; $hplay=$hvid+$hskin;
	} else {
		$hvid=80; $hplay=$hvid+$hskin; 
	}
} else { 
	$hvid=$hplay-$hskin;
};

$x=$wvid; // variable importee
$y=$hvid; // variable importee
if($y<85) { $function_fullscreen=false; } // desactive le pelin ecran si audio

// ----------------------------------------------------- Lecture du cache pour jpg et torrent
$pcache = (isset($Ogg->Streams['p'])) ? $Ogg->Streams['p'] : NULL;
$bcache = (isset($Ogg->Streams['b'])) ? $Ogg->Streams['b'] : NULL;
$fcache = (isset($Ogg->Streams['f'])) ? $Ogg->Streams['f'] : NULL;

if ($picture!='0') { // Image par p=, pas de test, l'auteur sait ce qu'il fait
	if(substr($picture, 0, 1)!="/" && !strstr($picture, "tp://") ){
		$image="/".$picture;
	} else {
		$image=$picture;
	}
} else { // Detection auto de l'image
	if($pcache!=NULL) {
		$image=$pcache;
	} else {
		$image=get_jpg($vurl_ogx);
		if(!$image && $Ogg->Streams['picturable']) {
			if ($extracted_image=$Ogg->GetPicture(intval($Ogg->Streams['theora']['framecount']/2)))
			$image=str_replace($document_root, "http://".$ihost, $extracted_image);
			// ecriture du resultat dans le cache
			$Ogg->Streams['p'] = $image;
			$Ogg->CacheUpdate();
		}
		if(!$image) {
			$image="http://".$ihost.$ipath.'skins/'.$skin.($y<85 ? '/vorbis.jpg' : '/null.jpg'); 
		} else {
			// ecriture du resultat dans le cache
			$Ogg->Streams['p'] = $image;
			$Ogg->CacheUpdate();
		}
	}
}

// ----------------------------------------------------- Gestion de l'auto detection du fichier torrent
$torrent="";
if ($bittorrent!='0') { // pas de test, l'auteur sait ce qu'il fait
	if(substr($bittorrent, 0, 1)!="/" && strstr($bittorrent, "tp://")){
		$torrent="/".$bittorrent;
	} else {
		$torrent=$bittorrent;
	}
} else {
	if(isset($bcache)){
		if($bcache!=NULL) {
			$torrent=$bcache;
		}
	} else {
		$torrent = get_torrent($vurl_ogx);
		// ecriture du resultat dans le cache
		$Ogg->Streams['b'] = $torrent;
		$Ogg->CacheUpdate();
	}
}

// ----------------------------------------------------- Gestion de l'auto detection du fichier flv
if ($flash!='0') { // pas de test, l'auteur sait ce qu'il fait
	if(substr($flash, 0, 1)!="/" && !strstr($flash, "tp://")){
		$vflv="/".$flash;
	} else {
		$vflv=$flash;
	}
} else {
	if(isset($fcache)){
		if($fcache!=NULL) {
			$vflv=$fcache;
		}
	} else {
		$vflv = get_flv($vurl_ogx);
		// ecriture du resultat dans le cache
		$Ogg->Streams['f'] = $vflv;
		$Ogg->CacheUpdate();
	}
}

if(getp('out')=="xml") {
// ------------------------------------------------------------------------------------------ //
// -----------------------Sortie XML--------------------------------------------------- //
// ------------------------------------------------------------------------------------------ //
$vduration = isset($Ogg->Streams['duration']) ? $Ogg->Streams['duration'] : "";
$vwidth = isset($Ogg->Streams['theora']['width']) ? $Ogg->Streams['theora']['width'] : "";
$vheight = isset($Ogg->Streams['theora']['height']) ? $Ogg->Streams['theora']['height'] : "";
echo '<?xml version="1.0" encoding="UTF-8"?>
<itheora version="'.$itheoraversion.'">
	<video>
		<title>'.txt($vtitle).'</title>
		<url>'.$vogx.'</url>
		<artist>'.txt($vartist).'</artist>
		<description>'.txt($vdesc).'</description>
		<license>'.txt($vlicense).'</license>
		<duration>'.$vduration.'</duration>
		<width>'.$vwidth.'</width>
		<height>'.$vheight.'</height>
		<picture>'.$image.'</picture>
		<podcast>'.$torrent.'</podcast>
	</video>
</itheora>
';
} else if (getp('out')=="link") {

// ------------------------------------------------------------------------------------------ //
// -----------Sortie Lien (propre)--------------------------------------------------- //
// ------------------------------------------------------------------------------------------ //

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="'.$lg.'" lang="'.$lg.'">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" type="text/css" media="all" href="http://'.$ihost.$ipath.'lib/scroll/scroll.css" />
	<script type="text/javascript" src="lib/jquery.js"></script>
	<script type="text/javascript" src="lib/scroll/scroll.js"></script>
	<script type="text/javascript">
		$(function() {
		    $(".jMyCarousel").jMyCarousel({
		        visible: \'100%\'
		    });
		});
	</script>
	<title>';
	if ($name!='0') { echo txt($name); }
echo '</title>
	<style  type="text/css">
	body {
		text-align : center;
		background: url(admin/images/fond_article.png) repeat-x;
	}
	h1{
		font-family: Arial,Helvetica,sans-serif;
		font-size: 18px;
		color: #3399d8;
	}
	p {
		font-family:Arial, Geneva, Helvetica, sans-serif;
		font-size:12px;
		color:#4C4C4C;
	}
	img {
		border : none; 
		vertical-align : middle
	}
	</style>';
if($function_podcast) {
	if($vhost==$ihost) { // Podcast local
		echo '
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="http://'.$ihost.$ipath.'podcast.php?dir='.rtrim(str_replace(url_to_file($vpath), '', $vpath), '/').'"/>';
	} else if ($vhost=="blip.tv") { // Podcast de blip.tv
		$url_ex=explode('-', str_replace("http://blip.tv/file/get/", "", $vogx));
		$username=$url_ex[0];
		echo '
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="http://'.strtolower($username).'.blip.tv/rss" />';	
	}
}
echo '</head>
<body>
	<h1>';
	if ($name!='0') { echo txt($name); $parn="&n=".$name; } else { echo txt($title); $parn=""; }
echo '</h1>
	<div><br />';
	if ($playlist!='0') { $parx="&x=".$playlist; } else { $parx=""; }
	$parv="v=".$vogx;
	$par=$parv.$parn.$parx;
	include ($itheora="index.php");
	echo '
	<br /><br />';
	include('lib/scroll/scroll.php');
echo '
		<p>'.$powered_by.' <a href="http://itheora.org"><img src="http://theorasea.org/itheora.png" alt="ITheora" /></a></p>
	</div>
</body>
</html>
';
} else {

// ------------------------------------------------------------------------------------------ //
// ---------------------Sortie HTML--------------------------------------------------- //
// ------------------------------------------------------------------------------------------ //

// ----------------------------------------------------- Insertion de l'entete
echo '<!-- ITheora '.$itheoraversion.' player video ogg/theora; plus d\'informations sur http://itheora.org -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="'.$lg.'" lang="'.$lg.'">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<meta name="robots" content="noindex"/>';

// ----------------------------------------------------- Feuille de style
echo '
	<link rel="stylesheet" type="text/css" media="all" href="http://'.$ihost.$ipath.'skins/'.$skin.'/style.php?w='.$wplay.'&amp;h='.$hplay.'" />

	<title>'.txt($title).'</title>

	<style type="text/css">
		html {
			overflow : auto;
			border : none;
		}
		body {
			position: absolute; 
			margin: 0; 
			padding: 0; 
			background-color: transparent; 
			overflow:hidden;
		}
		.ecran {position:absolute; left:0px; top:0px;}
	</style>
';

// ----------------------------------------------------- Verification que la video existe bien
if($n!=0) { 
	if(!file_exists("lib/cortado_url.jar")) { // les urls ne sont pas autorisees
		$vogx=$verror;
	}
} elseif(!file_exists($vfile_ogx)) { // le fichier local .ogx n'existe pas
	$vogx=$verror;
}

if($vext==".flv" || !empty($vflv)) { // Verification si flv  
	if(!file_exists("lib/neolao.swf")) { // les fichiers flv ne sont pas autorises
		$vogx=$verror;
	} elseif(($r!=0) && !file_exists($vfile.".flv")) { // le fichier local .flv n'existe pas
		$vogx=$verror;
	}
}
if(!getp('f')) {
	if(($vext==".flv" || $flash!="0") && $vext_ogx=="0") { // v=video.flv  (flv ou ogg n'existe pas (redirigee?) mais c'est pour du flash alors ca m'est egal)
		$vogx=$verror;
	}
}
if($vogx=='http://'.$ihost) {$vogx=$verror;}


 // Liste blanche
$whitelisted = true;
for($i=0; $i<count($whitelist); $i++) { // Verifie si la liste est vide, si oui alors la video est dans la liste blanche
	if($whitelist[$i]!="") {$whitelisted = false;} 
}
if($whitelisted == false) { // Sinon, on verifie que le domaine appartient bien a la liste blanche
	for($i=0; $i<count($whitelist); $i++) {
		if($whitelist[$i]!="") {
			if(strstr($vhost, $whitelist[$i])) { $whitelisted=true; }
		}
	}
}
if($whitelisted == false) {$vogx=$verror;}
// Liste noire (
for($i=0; $i<count($blacklist); $i++) {
	if($blacklist[$i]!="") {
		if(strstr($vogx, $blacklist[$i])) { $vogx=$verror;}
	}
}

// Fonctions d'analyse des parametres
function clear_video($param, $host, $path) {
	if(strstr($param, 'http://'.$host)) { // param local mais specifiee comme url
		$param = str_replace('http://'.$host, '',$param);
		if(strstr($param, substr($path, 0, -9).'data/')) { // param locale data mais specifiee comme racine
			$param = str_replace(substr($path, 0, -9).'data/', '',$param);
		}
	} elseif(!strstr($param, 'tp://')) { 
		if(strstr($param, substr($path, 0, -9).'data/')) { // param locale data mais specifiee comme racine
			$param = str_replace(substr($path, 0, -9).'data/', '',$param);		
		}
	}
	return $param;
}

function clear_param($param, $host) {
	if(strstr($param, 'http://'.$host)) { // param locale racine mais specifiee comme url
		$param = str_replace('http://'.$host.'/', '',$param);
	}
	return $param;
}

//---------------------------------------------------------Simplification des variables (partage + plein ecran)
$sv= $video;

$st = ($time!='0') ? "&t=".$time : "";
$ss = (file_exists( "skins/$skin/style.php")) ? "&s=".$skin : "";

$sp = ($picture!='0') ? "&p=".clear_param($picture, $ihost) : ""; 
$sb = ($bittorrent!='0') ? "&b=".clear_param($bittorrent, $ihost) : "";
$sn = ($name!='0') ? "&n=".$name : "";
$sd = ($disable!='') ? "&d=".$disable : "";

if ($playlist!='0') { $sx="&x=".$playlist; } else { $sx=""; }
$sf = (getp('f')) ? "&f=".getp('f') : "";
$sl = (getp('l')) ? "&l=".getp('l') : "";

$sw = "&w=".($x+20); 
$sh = "&h=".($y+40); 
				
echo '
<script type="text/javascript"><!--
var bouton=0;';
//----------------------------------------------------------- Affichage du titre
echo '
	function display_title(load) {
		if(load==0) {load=\'off\' ;} else { load=\'on\';};
		if(document.getElementById(\'hover\')!=null) {
		if(document.getElementById(\'hover\').innerHTML!="") {
		document.getElementById(\'hover\').innerHTML = \'';
			if($name!="0") {
				echo '<p class="title\'+load+\'">'.txt($name);
				if($time!="0") {
						echo '<span> | '.s_to_h($time).'</span><p>';
				}
			}	
		echo '\'}
		};
	}
	
	function infobulle(text) {
		if(text==null) { text= " ";}
		document.getElementById(\'info\').innerHTML = text;';
if(!$function_info) {  // Modification de la feuille de style pour desactiver les infobulles si ce n'est pas deja le cas
	echo '
		document.getElementById(\'info\').style.display=\'none\';';
}
	echo '
	}';

// ----------------------------------------------------- Fonction STOP
if($name!="0" && $time!="0") {
	$ecran_hover = '<div id="hover" ><p class="titleoff">'.txt($name).'<span> | '.s_to_h($time).'</span></p></div>';
	} elseif($name!="0") {
	$ecran_hover = '<div id="hover" ><p class="titleoff">'.txt($name).'</p></div>';
	} else {
	$ecran_hover = '<div id="hover" ></div>';
}

	if($y<85) { // audio
		$ecran_stop = '
			<div class="audio">
				<a href="javascript:startplay()" '.linktitle(txt($bt_play)).'>
				<img src="'.$image.'" style="width: '.$y.'px; height: '.$y.'px;" alt="" 
					onmouseover="display_title(1)" 
					onmouseout="setTimeout(\'display_title(0)\',2000)" />
				</a>
			</div>';
	} else { // video
	// ----------------------------------------------------- Insertion du bouton BIG_PLAY
	$ecran_big_Play= '
		<div class="big_Play">
			<a href="javascript:startplay()" '.linktitle(txt($bt_play)).'></a>
		</div>';

	$ecran_stop = '
		<div>
			<img src="'.$image.'" style="width: '.$x.'px; height: '.$y.'px;" alt="" 
				onmouseover="display_title(1)" 
				onmouseout="setTimeout(\'display_title(0)\',2000)" />'.$ecran_big_Play.'
		</div>';
	};

if($function_alt_download) {
echo '
	var alt_downloads_loaded = false;
	var jax = null; 
	if (window.XMLHttpRequest) {
		jax = new XMLHttpRequest();
	} else if (window.ActiveXObject) {
		jax = new ActiveXObject("Microsoft.XMLHTTP");
	}
	function alt_downloads() {
		if(!alt_downloads_loaded) {
		jax.open("GET", "lib/ajax/alt_downloads.php?url='.$vurl_ogx.'&l='.$lang.'", true); 
		jax.onreadystatechange = function() {
			if (jax.readyState == 4) {
				msg_alt_downloads = jax.responseText;
				alt_downloads_loaded = true;
			}
		}
		jax.send(null);
		}
	}
';
} else {
echo '
	var alt_downloads_loaded = true;
	var msg_alt_downloads = null;
	function alt_downloads() {};
';
}
echo ' 
	function stop() { document.getElementById(\'vid\').innerHTML = \''.txtjs($ecran_stop).txtjs($ecran_hover).'\'; bouton=0;}
';
if($function_error_but) {
	$ecran_error_but = '
		<p>'.$error_but.'</p>
		<br />
		<form action="http://'.$ihost.$iscript.'" method="post"><div>
			<input type="text" name="v" maxlength="500" />
			<input type="hidden" name="w" value="'.$wplay.'" />
			<input type="hidden" name="h" value="'.$hplay.'" />
			<input type="submit" class="submit" value="OK" />
		</div></form>';
		
} else { $ecran_error_but = ''; }
echo ' 
	function error() { document.getElementById(\'vid\').innerHTML = \'<div class="msg_error"><div class="msg"><p>'.txtjs($error).'</p>'.txtjs($ecran_error_but).'</div></div>\'; bouton=0;}
';
	
echo '//--></script>';
 
// ----------------------------------------------------- Fonction PLAYLIST
include ("lib/inc/playlist.php");

//-----------------------------------------------------------Script de dection du plugin java pour "stupid IE"
if (ereg("MSIE", getenv("HTTP_USER_AGENT"))) {
echo '
<script  type="text/javascript" src="lib/JavaIEDetect.js"></script>
';
// si Java >= 0 alors plugin existe
}
if (ereg("Konqueror", getenv("HTTP_USER_AGENT"))) {
echo '<script type="text/javascript"><!--
	function recharger() { }; function redimensionner() { };
//--></script>';
} else {
echo '<script type="text/javascript"><!--';
	if(getp('reload') && $wplay!=10) {
echo '
	function recharger() { };';
	} else {
echo '
	function recharger() {
		if(wpage!='.$wplay.' || hpage!='.$hplay.') {
			window.location.href=url_resized;
		}
	};';
	}
echo '
	function redimensionner() {
		window.location.href="'.str_replace("&reload=1", "", $_SERVER['REQUEST_URI']).'";
	};
//--></script>';
}
echo '</head>';
// ----------------------------------------------------- Insertion Javascript / HTML du corps (play, stop, download, share)
if($vogx==$verror) {
	echo '<body onload="recharger(); error(); alt_downloads();" onresize="redimensionner()">'; 
}elseif($playlist!='0' && empty($vogx)) {
	echo '<body onload="b_playlist(); alt_downloads();">';
} elseif($playlist!='0' && ( ($y<85) || (!getp('x')) )) {
	if(!$function_manual_play)  { 
		echo '<body onload="recharger(); startplay(); alt_downloads();" onresize="redimensionner()">'; 
	} else { 
		echo '<body onload="recharger(); b_playlist(); alt_downloads();" onresize="redimensionner()">'; 
	}
} else if(!$function_manual_play) { 
	echo '<body onload="recharger(); startplay(); at_downloads();" onresize="redimensionner()">'; 
} else {
	echo '<body onload="recharger(); stop(); alt_downloads();" onresize="redimensionner()">'; 
}

//-----------------------------------Gestion de la taille du player
echo '<script type="text/javascript"><!-- ';
if (ereg("Safari", getenv("HTTP_USER_AGENT"))) {
	echo '
	wpage=window.innerWidth; hpage=window.innerHeight;';
} else {
	echo '
	if (document.body) {
		wpage=document.body.clientWidth; hpage=document.body.clientHeight;
	} else {
		wpage=window.innerWidth; hpage=window.innerHeight;
	}';
}
echo '
if(wpage==undefined) { wpage='.$wplay.';}; if(hpage==undefined) { hpage='.$hplay.';} 
url_resized = "http://'.$ihost.$iscript.'?v='.$sv.$st.$ss.$sd.$sp.$sb.$sn.$sx.$sf.$sl.'&w="+ wpage +"&h="+ hpage +"&reload=1";
//--></script>';

echo '<div class="player">
	<div class="topleft"></div>
	<div class="top"></div>
	<div class="topright"></div>
	<div class="left"></div>
	<div class="right"></div>	
	<div class="bottomleft"></div>
	<div class="bottom"></div>
	<div class="bottomright"></div>
';
	
// ----------------------------------------------------- Fonction PLAY
include ("lib/inc/play.php");


// ----------------------------------------------------- Insertion du bouton PLAY s'il existe


echo '
<div class="play">
	<a href="javascript:startplay()" '.linktitle(txt($bt_play)).'></a>
</div>
';

// ----------------------------------------------------- Insertion du bouton STOP ou du bouton BACK

echo '
<div class="stop">
	<a href="javascript:stop()" '.linktitle(txt($bt_stop)).'></a>
</div>
';
echo '
<div class="back">
	<a href="javascript:stop()" '.linktitle(txt($bt_back)).'></a>
</div>
';

// ----------------------------------------------------- Insertion du bouton PLAYLIST s'il existe
echo $bouton_playlist;

$message_download = ' '; // Decoupage pour mode sans javascript

if($vogx!=$verror) { // Desactivation des fonctions "accessoires" si erreur
// --------------------------------------------------- Insertion des fonctions
include ( "lib/inc/fullscreen.php");
include ( "lib/inc/options.php");
include ( "lib/inc/share.php");
include ( "lib/inc/download.php");

if($time!='0') {
echo '<div class="time"><p>'.s_to_h($time).'</p></div>';
}
if($name!="0") {
echo '<div class="title"><p>'.txt($name).'</p></div>';
}
}
// ----------------------------------------------------- Zones titre + infobulle + video
echo '<div id="info" class="info"></div>';

echo '<div id="vid" class="video">
		<div class="msg_error"><div class="msg"><p>'.txt($txt_js).'</p>'.$message_download.'</div></div>
	</div>';
echo '</div>';

// ----------------------------------------------------- Insertion d'un ADD ON s'il existe
if(file_exists( 'skins/'.$skin.'/addon.php' )) { 
	include('skins/'.$skin.'/addon.php');
}

echo '
</body>
</html>';
}
}
?>
