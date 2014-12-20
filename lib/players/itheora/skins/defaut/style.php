<?php 
//----------------------Zone a modifier (valeurs en pixels)----------------//
	$wskin=20; // epaisseur du skin en largeur (ce qu'il y a en plus par rapport a la largeur de la video)
	$hskin=40; // epaisseur du skin en hauteur (ce qu'il y a en plus par rapport a la hauteur de la video)
//-------------------------------Fin de zone a modifier-----------------------//
	
	header("Content-type:text/css");
	// $spath est l'emplacement du skin (utilise pour definir l'emplacement des images)
	$spath=substr($_SERVER['SCRIPT_NAME'], 0, -10); 
	
	// $wplay et $hplay sont les largeur et hauteur du player
	$wplay = isset( $_GET['w'] ) ? $_GET['w']:320+$wskin;
	$hplay = isset( $_GET['h'] ) ? $_GET['h']:80+$hskin;
	// $wvid et $hvid sont les largeur et hauteur de la video
	// Ils sont calcules en fonction de $wskin et $hskin
	$wvid = $wplay-$wskin; $hvid=$hplay-$hskin;

//---------------------- Le reste est modifiable, c'est une feuille de style (presque) traditionnelle ----------------// 
?>
body {
	width:100%; height:100%;
	font-family:"Lucida grande",Verdana,Lucida,Helvetica,sans-serif;
	font-size:13px;
}

h1, h1 a {font-size:13px} 

a {text-decoration:none ;}
a:link {color:#ffffff;}
a:visited {color:#bfe0f8;}

a b {display:none;}
a:hover b {position:absolute; margin-left:50px; display:inline; z-index:4;} /* Vignettes, pochettes album dans playlist */

p {margin:5px;}
img {border:none; vertical-align:middle;}
h1, .playlist_title, h1 a {text-align:center; font-weight:bold; color:#bfe0f8;}

.msg_playlist, .msg_error, .msg_share, 
.msg_download, .msg_options, .msg_info {/* Texte dans video */
	position:absolute;
	width:<?php echo $wvid;?>px; height:<?php echo $hvid;?>px;
	text-align:justify;
	overflow:auto;
	opacity:.90;
	z-index:3;
}

.msg_playlist .msg, .msg_error .msg, .msg_share .msg, 
.msg_download .msg, .msg_options .msg, .msg_info .msg, 
.msg_share table, .msg_download table, .msg_options table, .msg_error table  {
	width:290px;
	margin-top:5px;
	margin-left:auto; margin-right:auto;
	text-align:left;
	color:#ffffff;
}

.msg_playlist .msg, .msg_playlist table {width:<?php echo $wvid-15;?>px;}
#tab_playlist .tab_tools {width:200px; margin-left:auto; margin-right:auto;}

.icons {width:26px }
.loader {
	position:relative;
	width:32px; height:32px;
	margin-top:<?php echo ($hvid)/4 ;?>px;
	margin-left:auto; margin-right:auto;
	background:url(<?php echo $spath; ?>/player/loader.gif) no-repeat; 
}

input {width:200px;}

.submit {width:30px; margin-left:10px;}

form, .center {margin-left:auto; margin-right:auto; text-align:center;}

.codebox {/* Zone en jaune */
	position:relative;
	margin-left:auto; margin-right:auto;
	margin-top:5px; margin-bottom:20px;
	width:290px; height:20px;
	background-color:#fffff5;
	text-align:left;
	overflow:hidden;
}

.code {/* Code de partage */
	position:relative;
	margin-top:2px;
	margin-left:2px;
	width:2000px; height:16px;
	text-align:left;
	color:#000000;
	overflow:hidden;
	border:none; 
}

<?php
if($hplay<125) {// Si audio, corrige certaines valeurs par rapport a la feuille de style pour les videos
?>
h1, table, .msg, .codebox, .code {font-size:10px}
p {margin:2px;}

.codebox {height:18px; margin-bottom:18px;}
.code {height:14px;}

.audio {
	text-align:left; 
	background-color:#dddddd;
/*	opacity:.90; */
}
<?php };  ?>

.player {/* Taille du player */
	position:absolute;
	width:<?php echo $wvid + 20;?>px; height:<?php echo $hvid + 40;?>px;
}

/*------------------------------------- Contour du player-------------------------------------------- */
.topleft, .topright, .bottomleft, .bottomright {position:absolute;
	background:url(<?php echo $spath; ?>/player/corner.png) no-repeat;}
.topleft {width:70px; height:30px;
	background-position:top left;}
.topright {left:<?php echo $wvid - 12;?>px; 
	width:32px; height:30px;
	background-position:top right;}
.bottomleft {top:<?php echo $hvid + 30;?>px;
	width:10px; height:10px;
	background-position:bottom left;}
.bottomright {left:<?php echo $wvid + 10;?>px; 
	top:<?php echo $hvid + 30;?>px;
	width:10px; height:10px;
	background-position:bottom right;}

.top, .bottom {position:absolute;
	background:url(<?php echo $spath; ?>/player/x-border.png) repeat-x;}
.top {left:70px;
	width:<?php echo $wvid-82 ;?>px; height:30px;
	background-position:top;}
.bottom {left:10px;	top:<?php echo $hvid + 30;?>px;
	width:<?php echo $wvid;?>px; height:10px;
	background-position:bottom;}
	
.left, .right {position:absolute;
	background:url(<?php echo $spath; ?>/player/y-border.png) repeat-y;}
.left {top:30px; width:10px; height:<?php echo $hvid ;?>px;
	background-position:left;}
.right {left:<?php echo $wvid + 10;?>px; top:30px;
	width:10px; height:<?php echo $hvid ;?>px;
	background-position:right;}

/* --------------------------------------------------------- Textes------------------------------------*/ 
.info {
<?php   // largeur minimale pour l'affichage de l'infobulle 
	if($wvid<250) {echo "display:none;";}?> 
	position:absolute; top:10px; left:72px;
	width:<?php echo $wvid - 109;?>px; height:16px;
	text-align:center; color:#000000; }

<?php 
if($hplay<125) {// Adaptation pour l'affichage du titre en mode audio, l'affichage est permanent
?>
.titleon, .titleoff {
	position:absolute;
	top:<?php echo $hvid/2-12;?>px; left:<?php echo $hvid+10;?>px;
	height:<?php echo $hvid;?>px; width: <?php echo $wvid-$hvid-8;?>px;
	text-align:left; padding-left:4px ; padding-right:4px ;
	overflow:hidden; z-index:2;}
<?php } else {// Si video, l'affichage passe de "titleon" a "titleoff" au bout de 2 secondes?>
.titleon {
	position:absolute; overflow:hidden; z-index:2;
	top:<?php echo $hvid-25; ?>px ; left:-5px;
	height:20px; width: <?php echo $wvid - 8;?>px;
	text-align:left; padding-left:4px ; padding-right:4px ;
	background-color: #FFFFFF; -moz-opacity:0.6;opacity: 0.6;}
.titleoff {display:none;}
<?php } ?>

/* ".titleon span, titleoff span {display:none;}" pour masquer "| 01:23" */
.time, .title {display:none}

/*--------------------------------------------------------------- Icones -------------------------------------------------*/
.big_Java, .big_VLC, .big_Wikipedia, .big_Email, .big_TS {
	position:relative; width:32px; height:32px;
	margin-left:auto; margin-right:auto;
	background:url(<?php echo $spath; ?>/icones/icones.png) no-repeat;}

.big_Java a, .big_VLC a, .big_Wikipedia a, .big_Email a, .big_TS a {
	position:absolute; width:32px; height:32px;}

.big_Java {background-position:0px 0px;}
.big_VLC {background-position:-32px 0px;}
.big_Wikipedia {background-position:-64px 0px;}
.big_Email {background-position:-96px 0px;}
.big_TS {background-position:-128px 0px;}

/* --------------------------------------------Icones Telechargements / Liste de Lecture -------------------------------------------- */
.big_Ogv, .big_Ogg, .big_Ogm, .big_Oga, .big_Torrent {
	position:relative; width:32px; height:32px;
	margin-left:auto; margin-right:auto; text-align:left;
	background:url(<?php echo $spath; ?>/icones/icones.png) no-repeat;}

.big_Ogv a, .big_Ogg a, .big_Ogm a, .big_Oga a, .big_Torrent a {
	position:absolute; cursor:move;
	width:32px; height:32px;}

.Ogv, .Ogg, .Ogm, .Oga, .Srt, .Torrent, .Miro, .RSS, .Xspf, .Share_Playlist {
	position:relative; width:24px; height:24px;
	margin-left:auto; margin-right:auto;  text-align:left;
	background:url(<?php echo $spath; ?>/icones/icones.png) no-repeat;}

.Ogv a, .Ogg a, .Ogm a, .Oga a, .Srt a, .Torrent a, .Miro a, .RSS a, .Xspf a, .Share_Playlist a {
	position:absolute; cursor:move;
	width:24px; height:24px;}

.Miro a, .RSS a, .Xspf a, .Share_Playlist a {cursor:pointer;}

.RSS {background-position:0px -40px;}
.Share_Playlist {background-position:-32px -40px;}
.Miro {background-position:-64px -40px;}
.Xspf {background-position:-96px -40px;}
.Srt {background-position:-128px -40px;}
.big_Torrent {background-position:-160px 0px;}
.Torrent {background-position:-160px -40px;}
.big_Ogg, .big_Oga {background-position:-192px 0px;}
.Ogg, .Oga {background-position:-192px -40px;}
.big_Ogv, .big_Ogm {background-position:-224px 0px;}
.Ogv, .Ogm {background-position:-224px -40px;}

/*----------------------------------------------------------------Boutons---------------------------*/
.big_Play a {
	position:absolute; /* A l'interireur de video */
	left:<?php echo $wvid/2-25?>px; 
	top:<?php echo $hvid/2-25?>px;
	width:50px; height:50px;
	background:url(<?php echo $spath; ?>/boutons/big_Play.png) no-repeat 0% -50px;
	z-index:1;
}
.big_Play a:hover {background-position:0% 0%;}

.back a, .playlist a, .share a, .download a {
	position:absolute; top:8px; width:20px; height:20px;
	background:url(<?php echo $spath; ?>/boutons/boutons.png) no-repeat;}

.fullscreen a, .close a, .options a {
	position:absolute; top:10px; width:21px; height:17px;
	background:url(<?php echo $spath; ?>/boutons/boutons.png) no-repeat;}	

.back a {left:10px; background-position:0px -20px; }
.back a:hover {background-position:0px 0px;}
.playlist a {left:10px; background-position: -20px -20px;}
.playlist a:hover {background-position:-20px 0px;}
.download a {left:30px; background-position:-40px -20px;}
.download a:hover {background-position:-40px 0px;}
.share a {left:50px; background-position: -60px -20px;}
.share a:hover {background-position:-60px 0px;}

.fullscreen a{
	left:<?php echo $wvid - 35; ?>px;
	background-position:-80px -20px;}
.close a {
	left:<?php echo $wvid - 35; ?>px;
	background-position:-80px 0px;}
.options a {
	left:<?php echo $wvid - 12; ?>px;
	background-position:-104px 0px;}

.tool_download, .tool_share, .tool_fullscreen {display:none } /* Dans Options */

/*------------------------------------------------------ Place et taille de la video-----------------------------*/

.video {
	position:absolute;
	top:30px; 
	left:10px;
	width:<?php echo $wvid;?>px; height:<?php echo $hvid;?>px;
	background:url(<?php echo $spath; ?>/player/background.jpg) repeat-y #000000;
}
<?php
// SI IE
// Corrections ou ajouts dans la feuille de style 
// pour rattraper les bevues de ce stupide "Internet Explorer" 
if (ereg("MSIE", getenv("HTTP_USER_AGENT"))) {

echo '
.msg_playlist .msg, .msg_error .msg, .msg_share .msg, 
.msg_download .msg, .msg_options .msg, .msg_info .msg {
	width:280px;
	margin-left:'.(($wvid-290)/2).'px; 
}
.code {margin-top:0px;}
';
if($hplay<125) {// audio 
echo '
table {font-size:10px;}
.titleon, .titleoff {width: '.($wvid-$hvid).'px ;}
';
} else {// video 
echo '
table {
	font-family:"Lucida grande",Verdana,Lucida,Helvetica,sans-serif;
	font-size:13px;
	color:#ffffff;
}
.titleon {width:'.($wvid+8).'px ; filter:alpha(opacity=60);}
';
}

	// SI IE 6
	// Corrections ou ajouts supplementaires
	// pour rattraper les bevues d'Internet Explorer 6
	if (ereg("MSIE 6", getenv("HTTP_USER_AGENT"))) {// SI IE 6 
echo ' 
.titleon {background:#ffffff;}';
	}
	
}?>
