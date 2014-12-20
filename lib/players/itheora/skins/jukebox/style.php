<?php 
//----------------------Zone a modifier (valeurs en pixels)----------------//
	$wskin=105; // epaisseur du skin en largeur (ce qu'il y a en plus par rapport a la largeur de la video)
	$hskin=100; // epaisseur du skin en hauteur (ce qu'il y a en plus par rapport a la hauteur de la video)
//-------------------------------Fin de zone a modifier-----------------------//

	header("Content-type: text/css");
	// $spath est l'emplacement du skin (utilise pour definir l'emplacement des images)
	$spath=substr($_SERVER['SCRIPT_NAME'], 0, -9); 

	// $wplay et $hplay sont les largeur et hauteur du player
	$wplay = isset( $_GET['w'] ) ? $_GET['w'] : 275+$wskin;
	$hplay = isset( $_GET['h'] ) ? $_GET['h'] : 80+$hskin;
	// $wvid et $hvid sont les largeur et hauteur de la video
	// Ils sont calcules en fonction de $wskin et $hskin
	$wvid = $wplay-$wskin; $hvid=$hplay-$hskin;
	
//---------------------- Le reste est modifiable, c'est une feuille de style (presque) traditionnelle ----------------// 
?>
body {
	width: 100%; height: 100%;
	font-family: "Lucida grande",Verdana,Lucida,Helvetica,sans-serif;
	font-size: 13px;
}

h1, h1 a {font-size : 10px}

a { text-decoration: none ;}
a:link {color:#ffffff;}
a:visited {color:#bfe0f8;}

a b { display: none;}
a:hover b { position:absolute; margin-left: 10px; display: inline;  }

p {margin : 5px; }
img { border: none; vertical-align:middle; }

h1, .playlist_title, h1 a { text-align : center; font-weight : bold; color : #bfe0f8; }

.msg_playlist, .msg_error, .msg_share, 
.msg_download, .msg_options, .msg_info { /* Texte dans video */
	position: absolute;
	width: <?php echo $wvid;?>px; height: <?php echo $hvid;?>px;
	text-align: justify;
	overflow: auto;
	background : url(<?php echo $spath; ?>player/background.jpg) repeat-y #000000;
	z-index :3;
}

.msg_playlist .msg, .msg_error .msg, .msg_share .msg, 
.msg_download .msg, .msg_options .msg, .msg_info .msg, 
.msg_share table, .msg_download table, .msg_options table, .msg_error table  {
	width: 250px;
	margin-top: 5px;
	margin-left : auto; margin-right : auto;
	text-align : left;
	color : #ffffff;
}

.msg_playlist .msg, .msg_playlist table { width: <?php echo $wvid-15;?>px; }
#tab_playlist .tab_tools {width : 200px; margin-left : auto; margin-right : auto;}

.icons { width : 26px }
.loader {
	position : relative;
	width: 32px; height : 32px;
	margin-top : <?php echo ($hvid)/3 ;?>px;
	margin-left: auto; margin-right : auto;
	background : url(<?php echo $spath; ?>player/loader.gif) no-repeat; 
}

input {width : 200px; }

.submit {width : 30px; margin-left : 10px;}

form, .center { margin-left : auto; margin-right : auto; text-align : center; }

.codebox { /* Zone en jaune */
	position: relative;
	margin-left : auto; margin-right : auto;
	margin-top: 5px; margin-bottom : 20px;
	width: 250px; height:20px;
	background-color: #fffff5;
	text-align: left;
	overflow : hidden;
}

.code { /* Code de partage */
	position: relative;
	margin-top: 2px;
	margin-left : 2px;
	width: 2000px; height: 16px;
	text-align: left;
	color: #000000;
	overflow: hidden;
	border : none; 
}

<?php
if($hplay<185) { // Si audio, corrige certaines valeurs par rapport a la feuille de style pour les videos
?>
h1, table, .msg, .codebox, .code {font-size : 10px;}
p {margin : 2px; }

.codebox { height : 18px; margin-bottom : 18px;}
.code { height : 14px; }

.audio {display : none;}
<?php };  ?>

.player { /* Taille du player */
	position: absolute;
	width: <?php echo $wplay;?>px;
	height: <?php echo $hplay;?>px;
}

/*------------------------------------- Contour du player-------------------------------------------- */
.topleft { 
	position: absolute;
	width: 10px;
	height: 30px;
	background: url(<?php echo $spath; ?>player/topleft.png) no-repeat; }

.topright {
	position: absolute;
	left: <?php echo $wvid + 10+85;?>px; 
	width: 10px;
	height: 30px;
	background: url(<?php echo $spath; ?>player/topright.png) no-repeat; }

.bottomleft {
	position: absolute;
	top: <?php echo $hvid + 30;?>px;
	width: 10px;
	height: 10px;
	background: url(<?php echo $spath; ?>player/bottomleft.png) no-repeat; }

.bottomright {
	position: absolute;
	left: <?php echo $wvid + 10+85;?>px; 
	top: <?php echo $hvid + 30;?>px;
	width: 10px;
	height: 10px;
	background: url(<?php echo $spath; ?>player/bottomright.png) no-repeat; }

.top {
	position: absolute; 
	left: 10px;
	top: 0px;
	width: <?php echo $wvid +85;?>px;
	height: 30px;
	background: url(<?php echo $spath; ?>player/top.png) repeat-x; }

.left {
	position: absolute;
	top: 30px;
	width: 100px;
	height: <?php echo $hvid ;?>px;
	background: url(<?php echo $spath; ?>player/left.png) repeat-y; }

.right {
	position: absolute;
	left: <?php echo $wvid + 10+85;?>px; 
	top: 30px;
	width: 10px;
	height: <?php echo $hvid ;?>px;
	background: url(<?php echo $spath; ?>player/right.png) repeat-y; }

.bottom {
	position: absolute;
	left: 10px;
	top: <?php echo $hvid + 30;?>px;
	width: <?php echo $wvid +85;?>px;
	height: 10px;
	background: url(<?php echo $spath; ?>player/bottom.png) repeat-x; }

/* --------------------------------------------------------- Textes------------------------------------*/ 
.info {
<?php   // largeur minimale pour l'affichage de l'infobulle 
	if($wvid<250) { echo "display: none;";}?> 
	position: absolute;
	top: 10px;
	left: 70px;
	width: <?php echo $wvid - 105+95+23;?>px;
	height: 16px;
	text-align:center;
	color: #000000;
}

.titleon, .titleoff, .title, .time {display : none;}

/*--------------------------------------------------------------- Icones -----------------------------*/
.big_Java, .big_VLC, .big_Wikipedia, .big_Email, .big_TS {
	position : relative;
	width: 32px; height : 32px;
	margin-left: auto; margin-right : auto;
	text-align: left ;
}

.big_Java a, .big_VLC a, .big_Wikipedia a, .big_Email a, .big_TS a {
	position : absolute;
	width: 32px; height : 32px;
}

.big_Java { background : url(<?php echo $spath; ?>icones/big_Java.png) no-repeat; }
.big_VLC { background : url(<?php echo $spath; ?>icones/big_VLC.png) no-repeat; }
.big_Wikipedia { background : url(<?php echo $spath; ?>icones/big_Wikipedia.png) no-repeat; }
.big_Email { background : url(<?php echo $spath; ?>icones/big_Email.png) no-repeat; }
.big_TS { background : url(<?php echo $spath; ?>icones/big_TS.png) no-repeat; }

/* --------------------------------------------Icones Telechargements / Liste de Lecture -------------------------------------------- */
.big_Ogv, .big_Ogg, .big_Torrent {
	position : relative;
	width: 32px; height : 32px;
	margin-left: auto; margin-right : auto;
	text-align: left ;
}
.big_Ogv a, .big_Ogg a, .big_Torrent a { 
	position : absolute;
	width: 32px; height : 32px;
	cursor : move;
}

.big_Ogv { background : url(<?php echo $spath; ?>icones/big_Ogv.png) no-repeat; }
.big_Ogg { background : url(<?php echo $spath; ?>icones/big_Ogg.png) no-repeat; }
.big_Torrent { background : url(<?php echo $spath; ?>icones/big_Torrent.png) no-repeat; }

.Ogv, .Ogg, .Srt, .Sub, .Torrent, .Miro, .RSS, .Xspf, .Share_Playlist {
	position : relative;
	width: 24px; height : 24px;
	margin-left: auto; margin-right : auto;
	text-align: left ;
}

.Ogv a, .Ogg a, .Srt a, .Sub a, .Torrent a, .Miro a, .RSS a, .Xspf a, .Share_Playlist a { 
	position : absolute;
	width: 24px; height : 24px;
	cursor : move;
}

.Miro a, .RSS a, .Xspf a, .Share_Playlist a { cursor : pointer; }

.Ogv { background : url(<?php echo $spath; ?>icones/Ogv.png) no-repeat; }
.Ogg { background : url(<?php echo $spath; ?>icones/Ogg.png) no-repeat; }
.Srt { background : url(<?php echo $spath; ?>icones/Srt.png) no-repeat; }
.Sub { background : url(<?php echo $spath; ?>icones/Sub.png) no-repeat; }
.Torrent { background : url(<?php echo $spath; ?>icones/Torrent.png) no-repeat; }
.Miro { background : url(<?php echo $spath; ?>icones/Miro.png) no-repeat; }
.RSS { background : url(<?php echo $spath; ?>icones/RSS.png) no-repeat; }
.Xspf { background : url(<?php echo $spath; ?>icones/Xspf.png) no-repeat; }
.Share_Playlist { background : url(<?php echo $spath; ?>icones/Share_Playlist.png) no-repeat; }

/*----------------------------------------------------------------Boutons---------------------------*/
.big_Play a {
	position: absolute; /* A l'interireur de video */
	left: <?php echo $wvid/2-25?>px; 
	top: <?php echo $hvid/2-25?>px;
	width:50px; height:50px;
	background : url(<?php echo $spath; ?>boutons/off_big_Play.png) no-repeat;
	z-index : 1;
}
.big_Play a:hover { background : url(<?php echo $spath; ?>boutons/big_Play.png) no-repeat; }

.back a, .playlist a, .share a, .download a, .fullscreen a, .close a, .options a {
	position: absolute;
	top: 7px;
	width: 20px; height : 20px;
}	

.back a {
	left:10px;
	background : url(<?php echo $spath; ?>boutons/off_back.png) no-repeat;
}
.playlist a {
	left:10px;
	background : url(<?php echo $spath; ?>boutons/off_playlist.png) no-repeat;
}

.download a {
	left:30px;
	background : url(<?php echo $spath; ?>boutons/off_download.png) no-repeat;
}
.share a {
	left:50px;
	background : url(<?php echo $spath; ?>boutons/off_share.png) no-repeat;
}

.fullscreen a, .close a {
	left:<?php echo $wvid - 34; ?>px;
	width: 21px; height : 21px;
	background : url(<?php echo $spath; ?>boutons/fullscreen.png) no-repeat;
}
.close a { background : url(<?php echo $spath; ?>boutons/close.png) no-repeat;}

.options a {
	left:<?php echo $wvid +75; ?>px;
	width: 21px; height : 21px;
	background : url(<?php echo $spath; ?>boutons/options.png) no-repeat;
}

.back a:hover { background : url(<?php echo $spath; ?>boutons/back.png) no-repeat; }
.playlist a:hover {	background : url(<?php echo $spath; ?>boutons/playlist.png) no-repeat; }
.share a:hover { background : url(<?php echo $spath; ?>boutons/share.png) no-repeat; }
.download a:hover { background : url(<?php echo $spath; ?>boutons/download.png) no-repeat; }

.tool_download, .tool_share, .tool_fullscreen { display : none } /* Dans Options */

/*------------------------------------------------------ Place et taille de la video-----------------------------*/
.album {
	position: absolute;
	left : 10px;
	top : <?php echo ($hvid-80)/2+30?>px;
	width : 80px;
	height : 80px;
}

.albums {
	width : 50px;
	height : 50px;
	margin : 2px;
}

#container{
    position : absolute;
    top: <?php echo $hvid + 42;?>px;
    left : 10px;
    width: <?php echo $wplay -25;?>px;
    height: 62px;
    overflow: auto;
    margin: 0 auto;
    overflow-x: hidden;
    overflow-y: hidden;
}

.slider{
    height: 60px;
}

.video {
	position: absolute;
	top: 30px;
	left: 95px;
	width:<?php echo $wvid;?>px;
	height:<?php echo $hvid;?>px;
	color: #ffffff;
	background-color: #000000;
}
<?php
// SI IE
// Corrections ou ajouts dans la feuille de style 
// pour rattraper les bevues de ce stupide "Internet Explorer" 
if (ereg("MSIE", getenv("HTTP_USER_AGENT"))) {

echo '
.msg_playlist .msg, .msg_error .msg, .msg_share .msg, 
.msg_download .msg, .msg_options .msg, .msg_info .msg {
	width : 280px;
	margin-left : '.(($wvid-290)/2).'px; 
}
.code { margin-top: 0px; }
';
if($hplay<185) { // audio 
echo '
table { font-size: 10px; }
';
} else { // video 
echo '
table { 
	font-family: "Lucida grande",Verdana,Lucida,Helvetica,sans-serif;
	font-size: 13px;
	color : #ffffff;
}
';
}

	// SI IE 6
	// Corrections ou ajouts supplementaires
	// pour rattraper les bevues d'Internet Explorer 6
	if (ereg("MSIE 6", getenv("HTTP_USER_AGENT"))) {// SI IE 6 
		if($hplay<185) { // audio 
		echo ' 
.titleon, .titleoff { width:  '.($wvid-$hvid).'px ; }
';
		} else {
		echo ' 
.titleon { width: '.($wvid).'px ;background : #ffffff; }';
		}
	}
}?>