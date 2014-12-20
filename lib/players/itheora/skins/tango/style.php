<?php 
//------------------------------------------------------------------//
//                                                                  //
//     "Tango" skin v. 3.0 for ITheora v. 2.x by mischamajskij      //
//                                                                  //
//      A semi-transparent skin in a simple plain Tango style       //
//                                                                  //
//--------------------------------- mischamajskij.deviantart.com ---//

//----------------------Zone a modifier (valeurs en pixels)----------------//
	$wskin=4; // epaisseur du skin en largeur (ce qu'il y a en plus par rapport a la largeur de la video)
	$hskin=31; // epaisseur du skin en hauteur (ce qu'il y a en plus par rapport a la hauteur de la video)
//-------------------------------Fin de zone a modifier-----------------------//
	
	header("Content-type: text/css");
	// $spath est l'emplacement du skin (utilise pour definir l'emplacement des images)
	$spath=substr($_SERVER['SCRIPT_NAME'], 0, -9); 
	
	// $wplay et $hplay sont les largeur et hauteur du player
	$wplay = isset( $_GET['w'] ) ? $_GET['w'] : 320+$wskin;
	$hplay = isset( $_GET['h'] ) ? $_GET['h'] : 80+$hskin;
	// $wvid et $hvid sont les largeur et hauteur de la video
	// Ils sont calcules en fonction de $wskin et $hskin
	$wvid = $wplay-$wskin; $hvid=$hplay-$hskin;

//---------------------- Le reste est modifiable, c'est une feuille de style (presque) traditionnelle ----------------// 

//------- Table des couleurs --------//
	$color_player_bg="transparent";		// couleur générale du lecteur
	$color_link="#d3d7cf";		// liens
	$color_visited="#d3d7cf";	// liens visités
	$color_hover="#fbfbef";		// liens au passage da la souris
	$color_pltitle="#fbfbef";	// titre de la playlist et des options
	$color_msg="#eeeeec";		// messages de texte
	$color_msg_bg="transparent";	// arrière plan des fenetres
//	$color_msg_bg="#d3d7cf"; //
	$color_codebox_bg="#eeeeec";	// arrière plan du "codebox"
	$color_code_border="#babdb6";	// bord du code
	$color_code="#555753";		// texte du code
	$color_code_bg="#d3d7cf";	// arrière plan du code
	$color_info="#000000";          // texte des infobulles
	$color_title="#000000";         // titre de la vidéo
	$color_video_bg="transparent";  // arrière plan de la vidéo
//	$color_video_bg="#555753"; //
//------- Fin de table des couleurs --------//

?>
body {
	width: 100%; height: 100%;
	font-family: "Lucida grande",Verdana,Lucida,Helvetica,sans-serif;
	font-size: 13px;
}

h1, h1 a {font-size : 13px} 

a { text-decoration: none ;}
a:link {color:<?php echo $color_link;?>;}
a:visited {color:<?php echo $color_visited;?>;}
a:hover {color : <?php echo $color_hover;?>;}

a b { display: none;}
/* a:hover b { position:absolute; margin-left: 50px; display: inline; z-index : 4; } /* Vignettes, pochettes album dans playlist */
a:hover b { display: none;}

p {margin : 5px; }
img { border: none; vertical-align:middle; }
h1, .playlist_title, h1 a { text-align : center; font-weight : bold; color : <?php echo $color_pltitle;?>; }

.msg_playlist, .msg_error, .msg_share, 
.msg_download, .msg_options, .msg_info { /* Texte dans video */
	position: absolute;
	width: <?php echo $wvid;?>px; height: <?php echo $hvid;?>px;
	text-align: justify;
	overflow: auto;
/* reminder for <?php echo $color_msg_bg;?> in next line */
	background : url(<?php echo $spath; ?>/player/background.png) repeat <?php echo $color_msg_bg;?>;
	z-index :3;
}

.msg_playlist .msg, .msg_error .msg, .msg_share .msg, 
.msg_download .msg, .msg_options .msg, .msg_info .msg, 
.msg_share table, .msg_download table, .msg_options table, .msg_error table  {
	width: <?php echo $wvid-20;?>px;
	margin-top: 5px;
	margin-left : auto; margin-right : auto;
	text-align : center;
	color : <?php echo $color_msg;?>;
}

.msg_share .msg table { width : 200px; text-align : left; }

.msg_playlist .msg, .msg_playlist table { width: <?php echo $wvid-20;?>px; text-align:left; }
#tab_playlist .tab_tools {width : 200px; margin-left : auto; margin-right : auto;}

.icons { width : 26px }
.loader {
	position : relative;
	width: 32px; height : 32px;
	margin-top : <?php echo ($hvid)/3 ;?>px;
	margin-left: auto; margin-right : auto;
	background : url(<?php echo $spath; ?>/player/loader.gif) no-repeat; 
}

input {width : 200px; }

.submit {width : 30px; margin-left : 10px;}

form, .center { margin-left : auto; margin-right : auto; text-align : center; }

.codebox { /* Zone en jaune */
	position: relative;
	margin-left : auto; margin-right : auto;
	margin-top: 10px; margin-bottom : 16px;
	width: 200px; height:17px;
	background-color: <?php echo $color_codebox_bg;?>;
	text-align: left;
	overflow : hidden;
}

.code { /* Code de partage */
	position: absolute;
	top: 0px;
	left : 1px;
	width: 3000px; height: 15px;
	clip: rect(0px 198px 15px 0px);
	text-align: left;
	font-size: 90%;
	color: <?php echo $color_code;?>;
	background-color: <?php echo $color_code_bg;?>;
	overflow: hidden;
	border: 1px solid <?php echo $color_code_border;?>;
}

<?php
if($hplay<116) { // Si audio, corrige certaines valeurs par rapport a la feuille de style pour les videos
?>
h1, table, .msg, .codebox, .code {font-size : 10px}
p {margin : 2px; }

.codebox { height : 17px; margin-bottom : 16px;}
.code { height : 14px; }

.audio {
	text-align : left; 
	background-color : <?php echo $color_msg_bg;?>;
}
<?php };  ?>

.player { /* Taille du player */
	position: absolute;
	width: <?php echo $wplay;?>px; height: <?php echo $hplay;?>px;
	background-color: <?php echo $color_player_bg;?>;
}

/*------------------------------------- Contour du player-------------------------------------------- */

.topleft { 
	position: absolute;
	width: 2px; height: 2px;
	background: url(<?php echo $spath; ?>/player/topleft.png) no-repeat; }

.topright {
	position: absolute;
	left: <?php echo $wvid + 2;?>px; 
	width: 2px; height: 2px;
	background: url(<?php echo $spath; ?>/player/topright.png) no-repeat; }

.top {
	position: absolute; 
	left: 2px;
	width: <?php echo $wvid ;?>px; height: 2px;
	background: url(<?php echo $spath; ?>/player/top.png) repeat-x; }

.left {
	position: absolute;
	top: 2px;
	width: 2px; height: <?php echo $hvid ;?>px;
	background: url(<?php echo $spath; ?>/player/left.png) repeat-y; }

.right {
	position: absolute;
	left: <?php echo $wvid + 2;?>px; 
	top: 2px;
	width: 2px; height: <?php echo $hvid ;?>px;
	background: url(<?php echo $spath; ?>/player/right.png) repeat-y; }

.bottomleft {
	position: absolute;
	top: <?php echo $hvid+2;?>px;
	width: 53px;
	height: 29px;
	background: url(<?php echo $spath; ?>/player/bottomleft.png) no-repeat; }

.bottomright {
	position: absolute;
	left: <?php echo $wvid - 96;?>px; 
	top: <?php echo $hvid+2;?>px;
	width: 100px;
	height: 29px;
	background: url(<?php echo $spath; ?>/player/bottomright.png) no-repeat; }

.bottom {
	position: absolute;
	left: 53px;
	top: <?php echo $hvid+2;?>px;
	width: <?php echo $wvid - 149;?>px;
	height: 29px;
	background: url(<?php echo $spath; ?>/player/bottom.png) repeat-x; }

/* --------------------------------------------------------- Textes------------------------------------*/ 
.info {
<?php   // largeur minimale pour l'affichage de l'infobulle 
	if($wvid<410) { echo "display: none;";}?> 
	position: absolute;
	top: <?php echo $hvid + 7;?>px;
	left: 84px;
	width: <?php echo $wvid - 253;?>px;
	height: 16px;
	text-align:center;
	color : <?php echo $color_info;?>;
}

<?php 
if($hplay<116) { // Adaptation pour l'affichage du titre en mode audio, l'affichage est permanent
?>
.titleon, .titleoff {
	position: absolute;
	top: -2px ;
	left : <?php echo $hvid - 2;?>px;
	height: <?php echo $hvid/2+12;?>px;
	width:  <?php echo $wvid-$hvid-20;?>px;
	white-space: pre;
	overflow: auto;
	text-align: left;
	padding-top:<?php echo $hvid/2-12;?>px;
	padding-left :10px ;
	padding-right : 10px ;
	cursor: default;
	color:<?php echo $color_msg;?>;
	background : url(<?php echo $spath; ?>/player/background.png) repeat <?php echo $color_msg_bg;?>;
	z-index :2;
}

.time {
	position: absolute;
	left:<?php echo $wvid - 162; ?>px;
	top: <?php echo $hvid+10?>px;
	width: 50px;
	height: 16px;
	line-height: 11px;
	padding-left: 17px;
	cursor : default;
	font-size: 85%;
	background: url(<?php echo $spath; ?>/icones/Time.png) no-repeat;
}

<?php } else { // Si video, l'affichage passe de "titleon" a "titleoff" au bout de 2 secondes ?>
.titleon {
	position: absolute;
	left: -5px;
	top: <?php echo $hvid -53; ?>px ;
	width:  <?php echo $wvid-8;?>px;
	height: 46px;
	overflow: hidden;
	text-align:center;
	padding-top : 2px ;
	padding-left : 4px ;
	padding-right : 4px ;
	line-height: 14px;
	font-weight: bold ;
	cursor : default;
	color : <?php echo $color_title;?>;
	background : url(<?php echo $spath; ?>/player/hover.png) repeat-x;
	z-index : 2;
}

.titleoff {
	position: absolute;
	left: -5px;
	top: <?php echo $hvid -58; ?>px ;
	width:  <?php echo $wvid-8;?>px;
	height: 48px;
	padding-top: 5px;
	display : none;
}

.time {
	position: absolute;
	left:<?php echo $wvid - 162; ?>px;
	top: <?php echo $hvid+10?>px;
	width: 53px;
	height: 16px;
	line-height: 5px;
	padding-left: 14px;
	font-size: 85%;
	cursor : default;
	background: url(<?php echo $spath; ?>/icones/Time.png) no-repeat;
}

<?php } ?>
.titleon span, .titleoff span { display : none } /* pour masquer "| 01:23" */
.title {display : none}


/*--------------------------------------------------------------- Icones -------------------------------------------------*/
.big_Java, .big_VLC, .big_Wikipedia, .big_Email, .big_TS {
	text-align : left;
	position : relative;
	width: 32px; height : 32px;
	margin-left: auto; margin-right : auto;
}

.big_Java a, .big_VLC a, .big_Wikipedia a, .big_Email a, .big_TS a {
	position : absolute;
	width: 32px; height : 32px;
}


.big_Java { background : url(<?php echo $spath; ?>/icones/big_Java.png) no-repeat; }
.big_VLC { background : url(<?php echo $spath; ?>/icones/big_VLC.png) no-repeat; }
.big_Wikipedia { background : url(<?php echo $spath; ?>/icones/big_Wikipedia.png) no-repeat; }
.big_Email { background : url(<?php echo $spath; ?>/icones/big_Email.png) no-repeat; }
.big_TS { background : url(<?php echo $spath; ?>/icones/big_TS.png) no-repeat; }

/* --------------------------------------------Icones Telechargements / Liste de Lecture -------------------------------------------- */
.big_Ogv, .big_Ogg, .big_Torrent {
	text-align : left;
	position : relative;
	width: 32px; height : 32px;
	margin-left: auto; margin-right : auto;
}
.big_Ogv a, .big_Ogg a, .big_Torrent a { 
	position : absolute;
	width: 32px; height : 32px;
	cursor : default;
}

.big_Ogv { background : url(<?php echo $spath; ?>/icones/big_Ogv.png) no-repeat; }
.big_Ogg { background : url(<?php echo $spath; ?>/icones/big_Ogg.png) no-repeat; }
.big_Torrent { background : url(<?php echo $spath; ?>/icones/big_Torrent.png) no-repeat; }

.Ogv, .Ogg, .Srt, .Sub, .Torrent, .Miro, .RSS, .Xspf, .Share_Playlist {
	text-align : left;
	position : relative;
	width: 24px; height : 24px;
	margin-left: auto; margin-right : auto;
}

.Ogv a, .Ogg a, .Srt a, .Sub a, .Torrent a, .Miro a, .RSS a, .Xspf a, .Share_Playlist a { 
	position : absolute;
	width: 24px; height : 24px;
	cursor : default;
}

.Miro a, .RSS a, .Xspf a, .Share_Playlist a { cursor : pointer; }

.Ogv { background : url(<?php echo $spath; ?>/icones/Ogv.png) no-repeat; }
.Ogg { background : url(<?php echo $spath; ?>/icones/Ogg.png) no-repeat; }
.Srt { background : url(<?php echo $spath; ?>/icones/Srt.png) no-repeat; }
.Sub { background : url(<?php echo $spath; ?>/icones/Sub.png) no-repeat; }
.Torrent { background : url(<?php echo $spath; ?>/icones/Torrent.png) no-repeat; }
.Miro { background : url(<?php echo $spath; ?>/icones/Miro.png) no-repeat; }
.RSS { background : url(<?php echo $spath; ?>/icones/RSS.png) no-repeat; }
.Xspf { background : url(<?php echo $spath; ?>/icones/Xspf.png) no-repeat; }
.Share_Playlist { background : url(<?php echo $spath; ?>/icones/Share_Playlist.png) no-repeat; }

/*----------------------------------------------------------------Boutons---------------------------*/
.big_Play a {
	position: absolute; /* A l'interireur de video */
	left: <?php echo $wvid/2-32?>px; 
	top: <?php echo $hvid/2-32?>px;
	width:64px;
	height:64px;
	background : url(<?php echo $spath; ?>/boutons/off_big_Play.png) no-repeat;
	z-index : 1;
}
.big_Play a:hover { background : url(<?php echo $spath; ?>/boutons/big_Play.gif) no-repeat; }

.play a, .stop a, .playlist a, .fullscreen a, .close a {
	color: transparent;
	position: absolute;
	top: <?php echo $hvid+5?>px;
	width: 22px;
	height : 22px;
}	

/* ".back a" removed here */

.share a, .torrent a, .download a, .options a {
	color: transparent;
	position: absolute;
	top: <?php echo $hvid+10?>px;
	width: 16px;
	height : 16px;
}	

.play a {
	left:8px;
	background : url(<?php echo $spath; ?>/boutons/off_play.png) no-repeat;
}

.stop a {
	left:34px;
	background : url(<?php echo $spath; ?>/boutons/off_stop.png) no-repeat;
}

.playlist a {
	left:60px;
	background : url(<?php echo $spath; ?>/boutons/off_playlist.png) no-repeat;
}

/*
.back a {
	left:<?php echo $wvid - 116; ?>px;
	background : url(<?php echo $spath; ?>/boutons/off_back.png) no-repeat;
}
*/

<?php 
if($hplay<116) { // Affichage de l'icone de partage en mode audio
?>

.share a {
	left:<?php echo $wvid - 96; ?>px;
	background : url(<?php echo $spath; ?>/boutons/off_share_audio.png) no-repeat;
}

.share a:hover { background : url(<?php echo $spath; ?>/boutons/share_audio.png) no-repeat; }

<?php } else { // Affichage de l'icone de partage en mode video ?>

.share a {
	left:<?php echo $wvid - 96; ?>px;
	background : url(<?php echo $spath; ?>/boutons/off_share_video.png) no-repeat;
}

.share a:hover { background : url(<?php echo $spath; ?>/boutons/share_video.png) no-repeat; }

<?php } ?>

.download a, .torrent a {
	left:<?php echo $wvid - 76; ?>px;
	background : url(<?php echo $spath; ?>/boutons/off_download.png) no-repeat;
}

.options a {
	left:<?php echo $wvid - 56; ?>px;
	background : url(<?php echo $spath; ?>/boutons/off_options.png) no-repeat;
}

.fullscreen a {
	left:<?php echo $wvid - 26; ?>px;
	background : url(<?php echo $spath; ?>/boutons/off_fullscreen.png) no-repeat;
}

.close a { 
	left:<?php echo $wvid - 26; ?>px;
	background : url(<?php echo $spath; ?>/boutons/off_close.png) no-repeat;
}

.play a:hover { background : url(<?php echo $spath; ?>/boutons/play.png) no-repeat; }
.stop a:hover { background : url(<?php echo $spath; ?>/boutons/stop.png) no-repeat; }
.playlist a:hover {	background : url(<?php echo $spath; ?>/boutons/playlist.png) no-repeat; }
.back a:hover { background : url(<?php echo $spath; ?>/boutons/back.png) no-repeat; }
.download a:hover, .torrent a:hover { background : url(<?php echo $spath; ?>/boutons/download.png) no-repeat; }
.options a:hover { background : url(<?php echo $spath; ?>/boutons/options.png) no-repeat; }
.fullscreen a:hover { background : url(<?php echo $spath; ?>/boutons/fullscreen.png) no-repeat; }
.close a:hover { background : url(<?php echo $spath; ?>/boutons/close.png) no-repeat; }

.tool_download, .tool_share, .tool_fullscreen { display : none } /* Dans Options */

/*------------------------------------------------------ Place et taille de la video-----------------------------*/

.video {
	position: absolute;
	top: 2px; 
	left: 2px;
	width:<?php echo $wvid;?>px;
	height:<?php echo $hvid;?>px;
	color: transparent;	
	background-color: <?php echo $color_video_bg;?>;
}
<?php
// SI IE
// Corrections ou ajouts dans la feuille de style 
// pour rattraper les bevues de ce stupide "Internet Explorer" 
if (ereg("MSIE", getenv("HTTP_USER_AGENT"))) {

echo '
.big_Java, .big_VLC, .big_Wikipedia, .big_Email, .big_TS, 
.big_Ogv, .big_Ogg, .big_Torrent, 
.Ogv, .Ogg, .Srt, .Sub, .Torrent, .Miro, .RSS, .Xspf, .Share_Playlist {
	text-align: left ;
}

.msg_playlist .msg, .msg_error .msg, .msg_share .msg, 
.msg_download .msg, .msg_options .msg, .msg_info .msg {
	width : 280px;
	margin-left : '.(($wvid-290)/2).'px; 
}
.code { margin-top: 0px; }
';
if($hplay<116) { // audio 
echo '
table { font-size: 10px; }
.titleon, .titleoff { width:  '.($wvid-$hvid).'px ; }
';
} else { // video 
echo '
table { 
	font-family: "Lucida grande",Verdana,Lucida,Helvetica,sans-serif;
	font-size: 13px;
	color : #ffffff;
}
.titleon { width: '.($wvid+8).'px ;}
';
}

	// SI IE 6
	// Corrections ou ajouts supplementaires
	// pour rattraper les bevues d'Internet Explorer 6
	if (ereg("MSIE 6", getenv("HTTP_USER_AGENT"))) {// SI IE 6 
echo ' 
.titleon { background : #ffffff; }';
	}
	
}?>
