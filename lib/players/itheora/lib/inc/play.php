<?php 
$ecran_code_jar = ($n==0) ? 'cortado.jar' : 'cortado_url.jar' ;
	
if (ereg("MSIE", getenv("HTTP_USER_AGENT"))) { // Utilisation du lecteur java (code IE)
	$ecran_code_cortado = '
	<object classid="clsid:8AD9C840-044E-11D1-B3E9-00805F499D93" width="'.$x.'" height="'.$y.'" class="ecran" >
		<param name="code" value="com.fluendo.player.Cortado.class" />
		<param name="archive" value="lib/'.$ecran_code_jar.'" />
		<param name="url" value="'.$vogx.'"/>
		<param name="keepaspect" value="true"/>
		<param name="local" value="false"/>
		<param name="statusHeight" value="18"/>
		<param name="seekable" value="true"/>
		<param name="duration" value="'.$time.'"/>
	';
} else { // Utilisation du lecteur java (code !IE)
	$ecran_code_cortado = '
	<object classid="java:com.fluendo.player.Cortado.class" type="application/x-java-applet"  width="'.$x.'" height="'.$y.'" class="ecran" archive="lib/'.$ecran_code_jar.'" >
		<param name="archive" value="lib/'.$ecran_code_jar.'" />
		<param name="url" value="'.$vogx.'"/>
		<param name="keepaspect" value="true"/>
		<param name="local" value="false"/>
		<param name="statusHeight" value="18"/>
		<param name="seekable" value="true"/>
		<param name="duration" value="'.$time.'"/>
	';
}
$ecran_end_cortado = '</object>';

$ecran_code_neolao = ''; $ecran_end_neolao = '';
if(!empty($vflv)) { // Utilisation du lecteur flash si le fichier flv existe
	$ecran_code_neolao = '
	<object type="application/x-shockwave-flash" data="lib/neolao.swf" width="'.$x.'" height="'.$y.'" class="ecran">
		<param name="movie" value="lib/neolao.swf" />
		<param name="FlashVars" value="flv='.$vflv.'&amp;autoplay=1&amp;width='.$x.'&amp;height='.$y.'&amp;margin=0" />
	';
	$ecran_end_neolao = '</object>';
}

// Code plugin
$ecran_code_plugin = '
	<object data="'.$vogx.'" type="application/x-ogg" width="'.$x.'" height="'.$y.'" class="ecran" >
';
$ecran_end_plugin = '</object>';

// Code VLC pour IE
$ecran_code_VLC = '
	<object classid="clsid:9BE31822-FDAD-461B-AD51-BE1D1C159921" 
		codebase="http://downloads.videolan.org/pub/videolan/vlc/latest/win32/axvlc.cab" 
		width="'.$x.'" height="'.$y.'" class="ecran" >
		<param name="Src" value="'.$vogx.'" />
		<param name="ShowDisplay" value="True" />
		<param name="AutoLoop" value="False" />
		<param name="AutoPlay" value="True" />
';
$ecran_end_VLC = '</object>';

// Code RealPlayer pour IE
$ecran_code_RealP = '
	<object id="RVOCX" classid="clsid:CFCDAA03-8BE4-11cf-B84B-0020AFBBCCFA"
		width="'.$x.'" height="'.$y.'" class="ecran">
		<param name="SRC" value="'.$vogx.'" />
		<param name="LOOP" value="False" />
		<param name="AUTOSTART" value="False" />
';
$ecran_end_RealP = '</object>';

// Code WMP pour IE
$ecran_code_WMP = '
	<object id="mediaPlayer" classid="CLSID:22d6f312-b0f6-11d0-94ab-0080c74c7e95"
		width="'.$x.'" height="'.$y.'" class="ecran">
		CODEBASE="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=5,1,52,701"
		STANDBY="Loading Microsoft Windows Media Player components..."
		TYPE="application/x-oleobject">
	<param name="fileName" value="'.$vogx.'">
	<param name="animationatStart" value="true" />
	<param name="transparentatStart" VALUE="true" />
	<param name="autoStart" value="false" />
	<param name="showControls" value="true" />
';
$ecran_end_WMP = '</object>';

// Code browser
$ecran_code_browser = '
	<video autoplay controls src="'.$vogx.'" width="'.$x.'" height="'.$y.'" class="ecran" >
';
$ecran_end_browser = '</video>';

// Message d'erreur
$ecran_code_message = '
<div class="msg_error"><div class="msg">
	<p>'.txt($txt_play).'</p>
	<div class="center">
		<div class="big_Java">
		<a href="'.txt($link_java).'" '.linktitle(txt($alt_java)).' onclick="window.open(this.href); return false;"></a>
		</div>
		<div class="big_VLC">
		<a href="'.txt($link_vlc).'"	'.linktitle(txt($alt_vlc)).' onclick="window.open(this.href); return false;"></a>
		</div>
	</div>
	<p>'.txt($txt_wpd).'</p>
	<div class=\"center\">
		<div class="big_Wikipedia">
		<a href="'.txt($link_wpd).'"  '.linktitle(txt($alt_wpd)).' onclick="window.open(this.href); return false;"></a>
		</div>
	</div>
</div></div>';
	
if(ereg("MSIE", getenv("HTTP_USER_AGENT"))) {  // Si IE, tester la presence de plugin sinon, lectures multiples simultanees
	if(!empty($vflv)) {
echo '
<script type="text/javascript"><!--
	function startplay() {
		var Java  = PluginDetect.isMinVersion(\'Java\', \'0\');
		var VLC  = PluginDetect.isMinVersion(\'VLC\', \'0\');
		var Flash  = PluginDetect.isMinVersion(\'Flash\', \'0\');
		if(Flash < 0) {
			if(Java < 0) { 
				if(VLC < 0) { // Quicktime
					document.getElementById(\'vid\').innerHTML = \''.txtjs($ecran_code_plugin).txtjs($ecran_code_message).txtjs($ecran_end_plugin).'\';
				} else { // VLC
					document.getElementById(\'vid\').innerHTML = \''.txtjs($ecran_code_VLC).txtjs($ecran_code_message).txtjs($ecran_end_VLC).'\';
				}
			} else { // Java
				document.getElementById(\'vid\').innerHTML = \''.txtjs($ecran_code_cortado).txtjs($ecran_code_message).txtjs($ecran_end_cortado).'\';
			}
		} else { // Flash
			document.getElementById(\'vid\').innerHTML = \''.txtjs($ecran_code_neolao).txtjs($ecran_end_neolao).'\';
		}
	}
//--></script>
';
	} else {
echo '
<script type="text/javascript"><!--
	function startplay() {
		var Java  = PluginDetect.isMinVersion(\'Java\', \'0\');
		var VLC  = PluginDetect.isMinVersion(\'VLC\', \'0\');
		if(Java < 0) { 
			if(VLC < 0) { // Quicktime
				document.getElementById(\'vid\').innerHTML = \''.txtjs($ecran_code_plugin).txtjs($ecran_code_message).txtjs($ecran_end_plugin).'\';
			} else { // VLC
				document.getElementById(\'vid\').innerHTML = \''.txtjs($ecran_code_VLC).txtjs($ecran_code_message).txtjs($ecran_end_VLC).'\';
			}
		} else { // Java
			document.getElementById(\'vid\').innerHTML = \''.txtjs($ecran_code_cortado).txtjs($ecran_code_message).txtjs($ecran_end_cortado).'\';
		}
	}
//--></script>
';
	}
} else if(ereg("Safari", getenv("HTTP_USER_AGENT"))) { // Si Safari,lecture par Java en premier parce qu'Apple impose la lecture via Quicktime meme s'il nest pas installe
echo '
<script type="text/javascript"><!--
	function startplay() {
		document.getElementById(\'vid\').innerHTML = \''.txtjs($ecran_code_neolao).txtjs($ecran_code_cortado).txtjs($ecran_code_plugin).txtjs($ecran_code_message).txtjs($ecran_end_plugin).txtjs($ecran_end_cortado).txtjs($ecran_end_neolao).'\';
	}
//--></script>
';
} else {
echo '
<script type="text/javascript"><!--	
	function startplay() {
	// eviter le popup qui demande a telecharger ce plugin
	var codeplugin=\'\',fincodeplugin=\'\';
	// si pas ff ou navigateur avec plugin installe on essaie avec plugin
	if ((navigator.userAgent.indexOf("Firefox",0)==-1) || (navigator.mimeTypes["application/ogg"])) 
	    {
		codeplugin=\''.txtjs($ecran_code_browser).txtjs($ecran_code_plugin).'\';
		fincodeplugin=\''.txtjs($ecran_end_plugin).txtjs($ecran_end_browser).'\';
		}
	document.getElementById(\'vid\').innerHTML = codeplugin+\''.txtjs($ecran_code_neolao).txtjs($ecran_code_cortado).txtjs($ecran_code_message).txtjs($ecran_end_cortado).txtjs($ecran_end_neolao).'\'+fincodeplugin;
	}
//--></script>
';
}
?>