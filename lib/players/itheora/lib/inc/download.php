<?php
if($function_download) { 

if(!empty($torrent)) {
	$ecran_first_download='
	<tr>
		<td class="center">
			<div class="big_Torrent">
			<a href="'.$torrent.'" onclick="return(false);"></a>
			</div>
		</td>
		<td class="center">
			<div class="big_O'.substr($vext_ogx, 2).'">
			<a href="'.get_coral($vurl_ogx).'" onclick="return(false);"></a>
			</div>
		</td>
	</tr><tr>
		<td class="center"><p>'.$alt_bittorrent.'</p></td>
		<td class="center"><p>'.txt($alt_coral).'</p></td>
	</tr>';
} else {
	$ecran_first_download='
	<tr>
		<td	colspan="2">
			<div class="big_O'.substr($vext_ogx, 2).'">
			<a href="'.$vurl_ogx.'" onclick="return(false);"></a>
			</div>
		</td>
	</tr><tr>
		<td	colspan="2" style="text-align : center"><p>'.url_to_file($vurl_ogx).'</p></td>
	</tr>';
}

$ecran_download = '
	<div class="msg_download"><div class="msg">
	<p>'.txt($txt_download).'</p>
	<table>
	'.$ecran_first_download.'
	</table>
	<div id="alt_downloads"><div class="loader"></div>
	</div>
	</div></div> 
';
$message_download = '
	<p>'.txt($txt_download).'</p>
	<table>
	'.$ecran_first_download.'
	</table>';
echo '
<script type="text/javascript"><!--';
if($function_alt_download) {
echo '
	var jaxadii = null; 
	if (window.XMLHttpRequest) {
		jaxadii = new XMLHttpRequest();
	} else if (window.ActiveXObject) {
		jaxadii = new ActiveXObject("Microsoft.XMLHTTP");
	}

	function alt_downloadsii() {
		var divrc = document.getElementById("alt_downloads");
		jaxadii.open("GET", "lib/ajax/alt_downloads.php?url='.$vurl_ogx.'&l='.$lang.'", true); 
		jaxadii.onreadystatechange = function() {
			if (jaxadii.readyState == 4) {
				divrc.innerHTML = jaxadii.responseText;
				msg_alt_downloads = divrc.innerHTML;
			}
		}
		jaxadii.send(null);
	}';
}
echo '
	function download() {
		document.getElementById(\'vid\').innerHTML = \''.txtjs($ecran_download).'\';
		if(!alt_downloads_loaded) {
			alt_downloadsii();
		} else {
			document.getElementById(\'alt_downloads\').innerHTML = msg_alt_downloads;
		}
		
	};
	function b_download() {if(bouton==\'download\') {stop();} else {download(); bouton=\'download\'; }}	
//--></script>
	
<div class="download">
	<a href="javascript:b_download()" '.linktitle(txt($bt_download)).'></a>
</div>
';
}
?>