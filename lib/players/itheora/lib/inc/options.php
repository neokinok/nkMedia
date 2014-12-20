<?php
if($function_options) { 
//// ----------------------------------------------------- Insertion du menu AUTRES MODES DE LECTURE
	$ecran_play_message = '<div class="msg_error"><div class="msg"><p>'.txt($txt_play_message).'</p></div></div>';

$function_play_neolao='';$link_play_neolao='';
if($ecran_code_neolao!='') { // Si flash
	$function_play_neolao='
		function play_neolao() { document.getElementById(\'vid\').innerHTML = \''.txtjs($ecran_code_neolao).txtjs($ecran_play_message).txtjs($ecran_end_neolao).'\' ; bouton=\'\' }';
	$link_play_neolao='
		<tr><td><a href="javascript:play_neolao()">'.txt($txt_play_neolao).'</a></td></tr>';
};

echo '
	<script type="text/javascript"><!--
		function play_browser() { document.getElementById(\'vid\').innerHTML = \''.txtjs($ecran_code_browser).txtjs($ecran_play_message).txtjs($ecran_end_browser).'\' ; bouton=\'\'}
		function play_plugin() { document.getElementById(\'vid\').innerHTML = \''.txtjs($ecran_code_plugin).txtjs($ecran_play_message).txtjs($ecran_end_plugin).'\' ; bouton=\'\' }';
if(ereg("MSIE", getenv("HTTP_USER_AGENT"))) {  // Modes de lecture pour IE
	echo '
		function play_VLC() { document.getElementById(\'vid\').innerHTML = \''.txtjs($ecran_code_VLC).txtjs($ecran_play_message).txtjs($ecran_end_VLC).'\' ; bouton=\'\' }
		function play_WMP() { document.getElementById(\'vid\').innerHTML = \''.txtjs($ecran_code_WMP).txtjs($ecran_play_message).txtjs($ecran_end_WMP).'\' ; bouton=\'\'}
		function play_RealP() { document.getElementById(\'vid\').innerHTML = \''.txtjs($ecran_code_RealP).txtjs($ecran_play_message).txtjs($ecran_end_RealP).'\' ; bouton=\'\'}';
}
echo '		
		function play_cortado() { document.getElementById(\'vid\').innerHTML = \''.txtjs($ecran_code_cortado).txtjs($ecran_play_message).txtjs($ecran_end_cortado).'\' ; bouton=\'\'}'.$function_play_neolao.'
	//--></script>';

if(ereg("MSIE", getenv("HTTP_USER_AGENT"))) {  // Modes de lecture pour IE
	$ecran_option_play_plugin = '
	<tr><td>'.txt($txt_play_plugin).'
		<ul>
			<li><a href="javascript:play_VLC()">VLC</a></li>
			<li><a href="javascript:play_plugin()">Quicktime</a></li>
			<li><a href="javascript:play_RealP()">Real Player</a></li>
			<li><a href="javascript:play_WMP()">Windows Media Player</a></li>
		</ul>
	</td></tr>';
} else {
	$ecran_option_play_plugin = '
	<tr><td><a href="javascript:play_plugin()">'.txt($txt_play_plugin).'</a></td></tr>';
}

	$ecran_options_menu = '
	<h1>'.txt($txt_play_menu).'</h1>
	<table>
	<tr><td><a href="javascript:play_browser()">'.txt($txt_play_browser).'</a></td></tr>'.$ecran_option_play_plugin.'
	<tr><td><a href="javascript:play_cortado()">'.txt($txt_play_cortado).'</a></td></tr>
	<tr><td><a href="lib/export_xspf.php?file='.ep($vogx.$st.$sn.'&p='.$image, 3).'" onclick="window.open(this.href); return false;">'.$txt_play_local.'</a></td><tr>'.$link_play_neolao.'
	</table>';

//// ------------------------------------------------- Insertion du menu OUTILS	
echo '
	<script type="text/javascript"><!--
		function player_out() {
				popup=window.open(\''.$_SERVER['REQUEST_URI'].'\', \'ITheora\', \'toolbar=0,location=0,directories=0,status=0,scrollbars=0,copyhistory=0,menuBar=0,width='.$wplay.',height='.$hplay.'\'); 
				popup.focus();
				return false;
		}		
	//--></script>';

$opt_download=''; $opt_share=''; $opt_fullscreen='';
if($function_download) { $opt_download='<tr class="tool_download"><td><a href="javascript:b_download()">'.txt($bt_download).'</a></td></tr>';}
if($function_share) {	$opt_share='<tr class="tool_share"><td><a href="javascript:b_share()">'.txt($bt_share).'</a></td></tr>';}
if($function_fullscreen) { $opt_fullscreen='<tr class="tool_fullscreen"><td><a href="javascript:void(0);" onclick="ff=window.open(\'http://'.$ihost.$iscript.'?v='.$sv.$st.$ss.$sp.$sb.'&d='.$disable.'k'.$sx.$sf.$sl.'\', \'ITheora - Fullscreen\', \'status=0,toolbar=0,location=0,directories=0,scrollbars=0,copyhistory=0,menuBar=0,width=\'+ (screen.width) +\',height=\'+ (screen.height) +\'\'); ff.focus(); stop(); return(false)">'.txt($bt_fullscreen).'</a></td></tr>';}

$ecran_options_tools = '
	<h1>'.txt($txt_tools_menu).'</h1>
	<table>
	'.$opt_download.$opt_share.'
	<tr class="tool_out"><td><a href="javascript:void(0);" onclick="player_out()">'.txt($txt_player_out).'</a></td></tr>
	'.$opt_fullscreen.'
	</table>
	';
	
//// ----------------------------------------------------- Insertion du menu ABOUT
	if(isset($Ogg->Streams['summary'])) { $video_infos = nl2br(txt($Ogg->Streams['summary'])); } else { $video_infos ="" ;}
	if($video_infos!="") {
	$ecran_about = '<div class="msg_info"><div class="msg">'.$video_infos.'</div></div>';
echo '
	<script type="text/javascript"><!--
		function about() { document.getElementById(\'vid\').innerHTML = \''.txtjs($ecran_about).'\' ; bouton=\'\'}
	//--></script>';
	
	$ecran_options_about = '
	<h1>'.txt($txt_about_menu).'</h1>
	<table>
	<tr><td><a href="javascript:about()">'.txt($txt_about_infos).'</a></td></tr>
	</table>
	';
	} else {
	$ecran_options_about = '';
	};
	
$ecran_options = '<div class="msg_options"><div class="msg">'.$ecran_options_tools.$ecran_options_menu.$ecran_options_about.'</div></div>' ;

echo '
<script type="text/javascript"><!--
	function options() { document.getElementById(\'vid\').innerHTML = \''.txtjs($ecran_options).'\' ; }
	function b_options() {if(bouton==\'options\') {stop();} else {options(); bouton=\'options\';}}	
//--></script>

<div class="options">
	<a href="javascript:b_options()" '.linktitle(txt($bt_options)).' ></a>
</div>'; 
}
?>